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
require(dirname(__FILE__) . '/includes/init_parter.php');
require(dirname(__FILE__) . '/includes/lib_parter.php');
/*------------------------------------------------------ */
//-- 框架
/*------------------------------------------------------ */
/*------------------------------------------------------ */
//-- 退出登录
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'logout')
{
    $sess->destroy_session();
     $_REQUEST['act'] = 'login';
 }
if ($_REQUEST['act'] == '' || $_REQUEST['act'] == 'login')
{
    if(isset($_SESSION['admin_id']) && $_SESSION['admin_id'] > 0){
        $smarty->display('parter\parter_index.htm');
        exit;
    }
    header('location:templates\parter\parter_login.htm');

}
elseif($_REQUEST['act'] == 'signin'){
    $_POST['username'] = isset($_POST['username']) ? trim($_POST['username']) : '';
    /* 检查密码是否正确 */
    $sql = "SELECT id,partnersLoginName, partnersName".
        " FROM rbc_parter" .
        " WHERE partnersLoginName = '{$_POST['username']}' and pwd = '{$_POST['pwd']}'" ;

    $row = $GLOBALS['db']->getRow($sql);
    if ($row)
    {
        // 登录成功
        $_SESSION['admin_id']    = $row['id'];
        $_SESSION['admin_name']  = $row['partnersName'];

        ecs_header("Location: ./parterAdmin.php\n");
        exit;
    }
    else
    {
        sys_msg('合作商登录名或密码不存在', 1);
    }
}
/*------------------------------------------------------ */
//-- 顶部框架的内容
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'top')
{
    // 获得管理员设置的菜单
    $lst = array();


    $smarty->display('parter\parter_top.htm');
}
/*------------------------------------------------------ */
//-- 左边的框架
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'menu')
{
    $smarty->assign('admin_id', $_SESSION['admin_id']);
    $smarty->display('parter\parter_menu.htm');
}
/*------------------------------------------------------ */
//-- 主窗口，起始页
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'main')
{
    $smarty->display('parter\parter_start.htm');
}
elseif($_REQUEST['act'] == 'parter_info')
{
    $smarty->assign('ur_here', '合作商基本信息');
    $partersInfo = get_parters($_SESSION['admin_id']);
    $smarty->assign('rbc_parter', $partersInfo);
    $smarty->assign('readonly', 'readonly');
    $smarty->display('parter\rbc_parter_info.htm');
}
else if($_REQUEST['act'] == 'rbc_parter_user_list')
{
    /* pageheader 赋值*/
    $smarty->assign('ur_here', '用户信息管理');
    /* 列表赋值*/
    $list = parter_user_list($_SESSION['admin_id']);
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 1);
    $smarty->display('parter\rbc_parter_user_list.htm');
}
else if($_REQUEST['act'] == 'query_user')
{
    $list = parter_user_list($_SESSION['admin_id']);
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 0);
    make_json_result($smarty->fetch('parter\rbc_parter_user_list.htm'),'',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
else if($_REQUEST['act'] == 'rbc_parter_emp_list')
{
    /* pageheader 赋值*/
    $smarty->assign('ur_here', '员工列表');
    $action_link = array('href' => 'parterAdmin.php?act=add_parter_emp',  'text' => '添加员工');
    $smarty->assign('action_link',  $action_link);

    /* 列表赋值*/
    $list = parter_emp_list($_SESSION['admin_id']);
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 1);
    $smarty->display('parter\rbc_parter_emp_list.htm');
}
else if($_REQUEST['act'] == 'query')
{
    $list = parter_emp_list($_SESSION['admin_id']);
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 0);
    make_json_result($smarty->fetch('parter\rbc_parter_emp_list.htm'),'',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
else if($_REQUEST['act'] == 'valid')
{
    $sql = "update rbc_parter_staff_info set state = CASE WHEN state = '可用' then '停用' WHEN  state = '停用' then  '可用' end where id = {$_REQUEST['id']}";
    $ret = $GLOBALS['db']->query($sql) or make_json_error($GLOBALS['db']->error());
    make_json_result($ret);
}
else if($_REQUEST['act'] == 'add_parter_emp')
{
    $smarty->assign('ur_here', '添加员工');
    $action_link = array('href' => 'parterAdmin.php?act=rbc_parter_emp_list',  'text' => '员工列表');
    $smarty->assign('action_link',  $action_link);

    $smarty->assign('parter_id',$_SESSION['admin_id']);
    $smarty->assign('act','add');
    $smarty->display('parter\rbc_parter_emp_info.htm');
}
else if($_REQUEST['act'] =='validateAccount')
{
    $login_id = $_REQUEST['login_id'];
    $sql = "select count(*) from rbc_parter_staff_info where loginID = '{$login_id}'";
    $rows = $db->getOne($sql);
    if($rows > 0){
        make_json_error('账号已存在');
    }else{
        make_json_result('账号可以用');
    }
}
else if($_REQUEST['act'] =='edit_parter_emp')
{
    $smarty->assign('ur_here', '修改员工');
    $action_link = array('href' => 'parterAdmin.php?act=rbc_parter_emp_list',  'text' => '员工列表');
    $smarty->assign('action_link',  $action_link);

    $smarty->assign('act','edit');
    $smarty->assign('rbc_parter_emp', get_parter_emp($_REQUEST['id']));
    $smarty->display('parter\rbc_parter_emp_info.htm');
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
        $sql = "insert into rbc_parter_staff_info (".$fields.") values(".$values.")";
        if($db->query($sql)){
            $last_id = $db->insert_id();
            $sql = "select parter_code from rbc_parter where id = {$_POST['parter_id']}";
            $parter_code = $db->getOne($sql);
            $sql = 'update rbc_parter_staff_info set staffID = \''.$parter_code.$last_id.'\' where id ='.$last_id;
            if($db->query($sql)){
                sys_msg('创建成功', 0, array(array('href' => 'parterAdmin.php?act=rbc_parter_emp_list')));
            }else{
                sys_msg('数据插入失败', 1);
            }
        }
    }else{
        $sql = "delete from rbc_parter_staff_info where id = '{$_POST['id']}'";
        if($db->query($sql)){
            $sql = "insert into rbc_parter_staff_info (".$fields.") values(".$values.")";
            if($db->query($sql)){
                sys_msg('修改成功', 0, array(array('href' => 'parterAdmin.php?act=rbc_parter_emp_list')));
            }else{
                sys_msg('数据修改失败', 1);
            }
        }
    }
}
?>
