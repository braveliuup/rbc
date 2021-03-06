<?php
/**
 * ECSHOP 控制台首页
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: index.php 17217 2011-01-19 06:29:08Z liubo $
*/

define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init_supplier.php');
require(dirname(__FILE__) . '/includes/lib_supplier.php');
/*------------------------------------------------------ */
//-- 框架
/*------------------------------------------------------ */
/*------------------------------------------------------ */
//-- 退出登录
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'logout')
{
    $sess->destroy_session();
    exit('<script>top.location.href="templates/supplier/supplier_login.htm"</script>');
 }
if ($_REQUEST['act'] == '' || $_REQUEST['act'] == 'login')
{
    if(isset($_SESSION['admin_id']) && $_SESSION['admin_id'] > 0){
        $smarty->display('supplier\supplier_index.htm');
        exit;
    }
    header('location:templates\supplier\supplier_login.htm');

}
elseif($_REQUEST['act'] == 'signin'){
    $_POST['username'] = isset($_POST['username']) ? trim($_POST['username']) : '';
    /* 检查密码是否正确 */
    $sql = "SELECT id,supplierID,supplierLoginName, supplierName".
        " FROM rbc_supplier" .
        " WHERE supplierLoginName = '{$_POST['username']}' and supplierLoginPassword = '{$_POST['pwd']}'" ;

    $row = $GLOBALS['db']->getRow($sql);
    if ($row)
    {
        // 登录成功
        $_SESSION['admin_id']    = $row['id'];
        $_SESSION['admin_name']  = $row['supplierName'];
        $_SESSION['admin_code']  = $row['supplierID'];

        ecs_header("Location: ./supplierAdmin.php\n");
        exit;
    }
    else
    {
        sys_msg('供应商登录名或密码不存在', 1);
    }
}
/*------------------------------------------------------ */
//-- 顶部框架的内容
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'top')
{
    // 获得管理员设置的菜单
    $lst = array();
    $smarty->display('supplier\supplier_top.htm');
}
/*------------------------------------------------------ */
//-- 左边的框架
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'menu')
{
    $smarty->assign('admin_id', $_SESSION['admin_id']);
    $smarty->display('supplier\supplier_menu.htm');
}
/*------------------------------------------------------ */
//-- 主窗口，起始页
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'main')
{
    $smarty->display('supplier\supplier_start.htm');
}
elseif($_REQUEST['act'] == 'rbc_supplier_info')
{
    $smarty->assign('ur_here', '供应商信息');
    $obj = get_supplier($_SESSION['admin_id']);
    $smarty->assign('obj', $obj);
    $smarty->assign('readonly', 'disabled');
    $smarty->assign('form_act', 'detail');

    /* 图片列表 */
    $sql = "SELECT * FROM rbc_supplier_attach WHERE supplier_id = {$_SESSION['admin_id']}";
    $img_list = $db->getAll($sql);
    $smarty->assign('img_list', $img_list);

    $smarty->display('supplier\rbc_supplier_info.htm');
}
else if($_REQUEST['act'] =='delivery_confirm'){
    $sql = "update ecs_order_info set shipping_status = 1 , shipping_id = '{$_POST["shipId"]}' , shipping_name = '{$_POST["shipName"]}', invoice_no = '{$_POST['invoiceNo']}' where order_id = {$_POST['orderId']}";
    if($db->query($sql)){
        make_json_result('success');
    }
}
elseif($_REQUEST['act'] == 'rbc_supplier_finance'){
    $list = get_supplier_order_goods($_SESSION['admin_id']);
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 1);
    $smarty->assign('year_list', get_year_list());
    $smarty->assign('month_list', get_month_list());
    $smarty->assign('settlement_day', get_settlement_day($_SESSION['admin_id']));
    $smarty->display('supplier\rbc_supplier_finance.htm');
}
elseif($_REQUEST['act'] == 'rbc_supplier_finance_query'){
    $list = get_supplier_order_goods($_SESSION['admin_id']);
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 0);
    make_json_result($smarty->fetch('supplier\rbc_supplier_finance.htm'),'',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
elseif($_REQUEST['act'] == 'rbc_supplier_pwd_reset'){
    $smarty->display('supplier\rbc_supplier_pwd_reset.htm');
}
elseif($_REQUEST['act'] == 'rbc_supplier_order_list'){
    $list = get_supplier_order_list($_SESSION['admin_id']);
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 1);

    $ship_list = get_shipname_list();
    $smarty->assign('ship_list', $ship_list);
    $smarty->assign('ship_status_dic',array('0'=>'未发货','1'=>'已发货','2'=>'已收货','4'=>'退货'));

    $smarty->display('supplier\rbc_supplier_order_list.htm');
}
elseif($_REQUEST['act'] == 'query_order'){
    $list = get_supplier_order_list($_SESSION['admin_id']);
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 0);

    $ship_list = get_shipname_list();
    $smarty->assign('ship_list', $ship_list);

    make_json_result($smarty->fetch('supplier\rbc_supplier_order_list.htm'),'',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
elseif($_REQUEST['act'] == 'rbc_supplier_mail'){
    exit('<h2>站内信暂未实现</h2>');
}
elseif($_REQUEST['act'] =='reset_supplier_pwd'){
    $sql = "select count(*) from rbc_supplier where supplierID = '{$_SESSION["admin_code"]}' and  supplierLoginPassword = '{$_POST["old_pwd"]}'";
    $result = $db->getOne($sql);
    if($result == 0){
        sys_msg('旧密码错误');
    }else{
        $sql ="update rbc_supplier set supplierLoginPassword = '{$_POST["new_pwd"]}' where supplierID = '{$_SESSION["admin_code"]}'";
        if($db->query($sql)){
//            ecs_header('location:supplierAdmin.php?act=logout');
            sys_msg('密码修改成功,请重新登录',0, array(array('href'=>'supplierAdmin.php?act=logout')));
        }
    }
}
elseif($_REQUEST['act'] =='rbc_supplier_consume_list'){
    $smarty->assign('full_page', 1);

    $smarty->display('supplier\rbc_supplier_consume_list.htm');
}
else if($_REQUEST['act'] == 'rbc_supplier_user_list')
{
    /* pageheader 赋值*/
    $smarty->assign('ur_here', '用户信息管理');
    /* 列表赋值*/
    $list = supplier_user_list($_SESSION['admin_id']);
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 1);
    $smarty->display('supplier\rbc_supplier_user_list.htm');
}
else if($_REQUEST['act'] == 'query_user')
{
    $list = supplier_user_list($_SESSION['admin_id']);
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 0);
    make_json_result($smarty->fetch('supplier\rbc_supplier_user_list.htm'),'',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
else if($_REQUEST['act'] == 'delivery_address')
{
    /* 取得国家列表、商店所在国家、商店所在国家的省列表 */
    $smarty->assign('country_list',       get_regions());
    $smarty->assign('shop_province_list', get_regions(1, $_CFG['shop_country']));

    $list = get_consignee_addr_list();
    $smarty->assign('consignee_list', $list);
    $smarty->assign('consignee_list_count', count($list));
    $smarty->display('supplier\rbc_supplier_delivery_add.htm');
}
else if($_REQUEST['act'] == 'delete_delivery_addr')
{
    $sql = "delete from ecs_user_address where address_id = {$_REQUEST['id']}";
    if($db->query($sql)){
        ecs_header('location:supplierAdmin.php?act=delivery_address');
    }
}
else if($_REQUEST['act'] == 'delivery_addr_edit')
{
    $obj = get_consignee_addr($_REQUEST['id']);
    $smarty->assign('consignee', $obj);

    $smarty->assign('country_list',       get_regions());
    $smarty->assign('shop_province_list', get_regions(1, $obj['country']));
    $smarty->assign('shop_city_list', get_regions(2, $obj['province']));
    $smarty->assign('shop_district_list', get_regions(3, $obj['city']));

    $list = get_consignee_addr_list();
    $smarty->assign('consignee_list', $list);
    $smarty->assign('consignee_list_count', count($list));

    $smarty->display('supplier\rbc_supplier_delivery_edit.htm');
}
else if($_REQUEST['act'] == 'update_delivery_address'){
    $address_id = $_REQUEST['id'];
    $user_id = $_SESSION['admin_code'];
    $sql = "delete from ecs_user_address where address_id = {$address_id}";
    if($db->query($sql)){
        $fields="";
        $values="";
        foreach($_POST as $k=>$v){
            $fields.=$k.",";
            $values.="'{$v}'".",";
        }
        $fields .= "user_id,address_id";
        $values .= "'{$user_id}',{$address_id}";
        $sql = "insert into ecs_user_address ({$fields}) values ({$values})";

        if($db->query($sql)){
            if($_POST['is_default'] == '1'){
                // update other is_default = 0
                $sql = "update ecs_user_address set is_default = 0 where user_id = '{$_SESSION["admin_code"]}' and address_id != {$db->insert_id()}";
                $db->query($sql);
            }
            ecs_header('location:supplierAdmin.php?act=delivery_address');
        }
    }
}
else if($_REQUEST['act'] == 'add_delivery_address')
{
    $fields="";
    $values="";
    foreach($_POST as $k=>$v){
        $fields.=$k.",";
        $values.="'{$v}'".",";
    }
    $fields .= "user_id";
    $values .= "(select supplier_code from rbc_supplier where id = {$_SESSION['admin_id']} )";
    $sql = "insert into ecs_user_address ({$fields}) values ({$values})";

    if($db->query($sql)){
        if($_POST['is_default'] == '1'){
            // update other is_default = 0
            $sql = "update ecs_user_address set is_default = 0 where user_id = '{$_SESSION["admin_code"]}' and address_id != {$db->insert_id()}";
            $db->query($sql);
        }
        ecs_header('location:supplierAdmin.php?act=delivery_address');
    }
}
else if($_REQUEST['act'] == 'rbc_supplier_emp_list')
{
    /* pageheader 赋值*/
    $smarty->assign('ur_here', '员工列表');
    $action_link = array('href' => 'supplierAdmin.php?act=add_supplier_emp',  'text' => '添加员工');
    $smarty->assign('action_link',  $action_link);

    /* 列表赋值*/
    $list = supplier_emp_list($_SESSION['admin_id']);
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 1);
    $smarty->display('supplier\rbc_supplier_emp_list.htm');
}
else if($_REQUEST['act'] == 'query')
{
    $list = supplier_emp_list($_SESSION['admin_id']);
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 0);
    make_json_result($smarty->fetch('supplier\rbc_supplier_emp_list.htm'),'',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
else if($_REQUEST['act'] == 'valid')
{
    $sql = "update rbc_supplier_staff_info set state = CASE WHEN state = '可用' then '停用' WHEN  state = '停用' then  '可用' end where id = {$_REQUEST['id']}";
    $ret = $GLOBALS['db']->query($sql) or make_json_error($GLOBALS['db']->error());
    make_json_result($ret);
}
else if($_REQUEST['act'] == 'add_supplier_emp')
{
    $smarty->assign('ur_here', '添加员工');
    $action_link = array('href' => 'supplierAdmin.php?act=rbc_supplier_emp_list',  'text' => '员工列表');
    $smarty->assign('action_link',  $action_link);

    $smarty->assign('supplier_id',$_SESSION['admin_id']);
    $smarty->assign('act','add');
    $smarty->display('supplier\rbc_supplier_emp_info.htm');
}
else if($_REQUEST['act'] =='validateAccount')
{
    $login_id = $_REQUEST['login_id'];
    $sql = "select count(*) from rbc_supplier_staff_info where loginID = '{$login_id}'";
    $rows = $db->getOne($sql);
    if($rows > 0){
        make_json_error('账号已存在');
    }else{
        make_json_result('账号可以用');
    }
}
else if($_REQUEST['act'] =='edit_supplier_emp')
{
    $smarty->assign('ur_here', '修改员工');
    $action_link = array('href' => 'supplierAdmin.php?act=rbc_supplier_emp_list',  'text' => '员工列表');
    $smarty->assign('action_link',  $action_link);

    $smarty->assign('act','edit');
    $smarty->assign('rbc_supplier_emp', get_supplier_emp($_REQUEST['id']));
    $smarty->display('supplier\rbc_supplier_emp_info.htm');
}
else if($_REQUEST['act'] =='add_update_emp'){
    $fields="";
    $values= "";
    $insertFlag =$_POST['id'] == '' ? true: false;
    $v =0;
    foreach($_POST as $key=>$value){
        if($insertFlag){
            if($key == 'id' || $key == 'staffID')continue;
        }
        if($v != 0){
            $fields .= ',';
            $values .=',';
        }
        $fields .= $key;
        $values .= '\''.$value.'\'';
        $v = 1;
    }
    if($insertFlag){
        $sql = "insert into rbc_supplier_staff_info (".$fields.") values(".$values.")";
        if($db->query($sql)){
            $last_id = $db->insert_id();
            $sql = "select supplier_code from rbc_supplier where id = {$_POST['supplier_id']}";
            $supplier_code = $db->getOne($sql);
            $sql = 'update rbc_supplier_staff_info set staffID = \''.$supplier_code.$last_id.'\' where id ='.$last_id;
            if($db->query($sql)){
                sys_msg('创建成功', 0, array(array('href' => 'supplierAdmin.php?act=rbc_supplier_emp_list')));
            }else{
                sys_msg('数据插入失败', 1);
            }
        }
    }else{
        $sql = "delete from rbc_supplier_staff_info where id = '{$_POST['id']}'";
        if($db->query($sql)){
            $sql = "insert into rbc_supplier_staff_info (".$fields.") values(".$values.")";
            if($db->query($sql)){
                sys_msg('修改成功', 0, array(array('href' => 'supplierAdmin.php?act=rbc_supplier_emp_list')));
            }else{
                sys_msg('数据修改失败', 1);
            }
        }
    }
}
?>
