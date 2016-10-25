<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-10-20
 * Time: 17:13
 */

/**
 * 供应商管理
 * ============================================================================
 */

define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . '/' . ADMIN_PATH . '/includes/cls_pingyin.php');
require_once(ROOT_PATH . '/' . ADMIN_PATH . '/includes/lib_supplier.php');
include_once(ROOT_PATH . '/includes/cls_image.php');
$image = new cls_image($_CFG['bgcolor']);
$exc = new exchange('rbc_parter', $db, 'id', 'parter_code');
if(!empty($_REQUEST['act']) && $_REQUEST['act'] == 'add'){
//    $fields;
//    $values;
//    $errfields = array();
//    $v =0;
//    foreach($_POST as $key=>$value){
//        if($v != 0){
//            $fields .= ',';
//            $values .=',';
//        }
//        if(is_array($value)){
//            foreach($value as $k=>$val){
//                if($val == ''){
//                    array_push($errfields, $key);
//                    break;
//                }
//            }
//            $value = implode('#', $value);
//        }
//        if($value == ''){
//            array_push($errfields, $key);
//        }
//        $fields .= $key;
//        $values .= '\''.$value.'\'';
//        $v = 1;
//    }
//    if(count($errfields) > 0 ){
//        $sql = "SELECT COLUMN_NAME,  COLUMN_COMMENT FROM information_schema.columns WHERE table_name = 'rbc_parter'";
//        $row = $GLOBALS['db']->getAll($sql);
//        $ary = array();
//        foreach($row as $key => $value){
//            $ary[$value['COLUMN_NAME']] = $value['COLUMN_COMMENT'];
//        }
//        foreach($errfields as $key=>$value){
//            echo '['.$ary[$value].']'."不能为空";
//            echo '<br>';
//        }
//       echo "<br><a href='rbc_parter_register.htm' style='font-size:24px;'>回到注册页面</a>";
//    }else{
//        $sql = 'insert into rbc_parter ('.$fields.') values ('.$values.')';
//        $result = $GLOBALS['db']->query($sql);
//        if($result){
//            echo '<h1>注册信息已经提交到后台，账号目前为【待审核】状态。</h1><br><a href="parterAdmin.php" style="font-size:24px;">点击进入合作商后台登录页面</a>';
//        }else{
//            print_r($result);
//        }
//    }

    $smarty->assign('ur_here', '添加供应商');
    $action_link = array('href' => 'supplier.php?act=list',  'text' => '供应商列表');
    $smarty->assign('action_link',  $action_link);
    $smarty->assign('form_act',  'insert');

    $smarty->display('supplier_info.htm');

}
else if($_REQUEST['act'] == 'list') {

    /* pageheader 赋值*/
    $smarty->assign('ur_here', '供应商列表');
    $action_link = array('href' => 'supplier.php?act=add',  'text' => '添加供应商');
    $smarty->assign('action_link',  $action_link);

    /* 列表赋值*/
    $list = suppliers_list();
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 1);

    /* 查询性能监控 */
    assign_query_info();
    $smarty->display('supplier_list.htm');
}
else if($_REQUEST['act'] == 'query'){
    /* 列表赋值*/
    $list = suppliers_list();
    $smarty->assign('list',   $list['list']);
    $smarty->assign('filter', $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page', 0);

    make_json_result($smarty->fetch('supplier_list.htm'),'',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));

}
else if($_REQUEST['act'] == 'valid'){
    valid_parter();
}
else if($_REQUEST['act'] == 'detail'){
    $smarty->assign('ur_here', '供应商详细信息');
    $action_link = array('href' => 'supplier.php?act=list', 'text' => '供应商列表');
    $smarty->assign('action_link',  $action_link);
    $obj = get_supplier($_REQUEST['id']);
    $smarty->assign('obj', $obj);
    $smarty->assign('readonly', 'readonly');
    $smarty->assign('form_act', 'detail');

    /* 图片列表 */
    $sql = "SELECT * FROM rbc_supplier_attach WHERE supplier_id = {$_REQUEST['id']}";
    $img_list = $db->getAll($sql);
    $smarty->assign('img_list', $img_list);

    $smarty->display('supplier_info.htm');
}
else if($_REQUEST['act'] == 'edit'){
    $smarty->assign('ur_here', '修改合作商信息');
    $action_link = array('href' => 'parter.php?act=list', 'text' => '合作商列表');
    $smarty->assign('action_link',  $action_link);
    $partersInfo = get_parters($_REQUEST['id']);
    $smarty->assign('rbc_parter', $partersInfo);
    $smarty->assign('readonly', '');
    $smarty->assign('act', 'edit');

    $smarty->display('parters_info.htm');
}
else if($_REQUEST['act'] == 'update'){
    // 管理员更新合作商信息，审核通过，自动生成合作商代码
    /*
     * 通过审核后，自动启用，系统分配合作商编号：
     * 规则J+区号+公司名首字母缩写例：惠普-HP，如有重复-判断J+区号+公司名首字母是否有重复，系统自动添加丛01序号自增长
     * */
    if($_REQUEST['check_state'] == '审核' && $_REQUEST['parter_code'] == ''){
        $tel = $_REQUEST['leaderTel'];
        $ary = explode('#', $tel);
        $zoneNum = $ary[0];
        $PingYing = new GetPingYing();
        // 公司名字首字母缩写
        $cpname_ab = $PingYing->getFirstPY($_REQUEST['partnersName']);
        $cpcode = 'J'.$zoneNum.$cpname_ab;
        $PingYing = null;
        $sql = "select count(*) count from rbc_parter where parter_code = '{$cpcode}' ";
        $result = $db->getOne($sql);
        if($result != 0){
            $cpcode .= $result;
        }
        $_POST['parter_code'] = $cpcode;
    }

    $fields;
    $values;
    $errfields = array();
    $v =0;
    foreach($_POST as $key=>$value){
        if($v != 0){
            $fields .= ',';
            $values .=',';
        }
        if(is_array($value)){
            foreach($value as $k=>$val){
                if($val == ''){
                    array_push($errfields, $key);
                    break;
                }
            }
            $value = implode('#', $value);
        }
        if($value == ''){
            array_push($errfields, $key);
        }
        $fields .= $key;
        $values .= '\''.$value.'\'';
        $v = 1;
    }
    $sql = "delete from rbc_parter where id = {$_REQUEST['id']}";
    if($db->query($sql)){
        $sql = 'insert into rbc_parter ('.$fields.') values ('.$values.')';
        $result = $GLOBALS['db']->query($sql);
        if($result){
            /* 提示页面 */
            $link = array();
            $link[0] = array('href' => 'parter.php?act=list');
            sys_msg('修改成功', 0, $link);
        }else{
            sys_msg('数据更新失败', 1);
        }
    }else{
        sys_msg('数据更新失败', 1);
    }
}
else if($_REQUEST['act'] == 'insert')
{
    //先判断上传的文件是否正确
    $file_desc_ary = $_POST['file_desc'];
    $file_ary = $_FILES['file_url'];
    for($i=0; $i < count($file_desc_ary); $i++){
        if($file_ary['name'][$i] == '')
        {
            continue;
        }
        $upload = array(
            'name' => $file_ary['name'][$i],
            'type' => $file_ary['type'][$i],
            'tmp_name' => $file_ary['tmp_name'][$i],
            'size' => $file_ary['size'][$i],
        );
        if(!$image->check_file_type($upload['type'])){
            sys_msg('合作协议文件格式不正确',1);
        }
        if($upload['size'] > 2500000){
            sys_msg('合作协议文件大小超过最大限制',1);
        }
    }

    for($i=0; $i < count( $_POST['img_desc']); $i++){
        if($_FILES['img_url']['name'][$i] == '')
        {
            continue;
        }
        $upload = array(
            'name' => $_FILES['img_url']['name'][$i],
            'type' => $_FILES['img_url']['type'][$i],
            'tmp_name' => $_FILES['img_url']['tmp_name'][$i],
            'size' => $_FILES['img_url']['size'][$i],
        );
        if(!$image->check_picture_type($upload['type'])){
            sys_msg('上传的图片文件格式不正确',1);
        }
        if($upload['size'] > 2500000){
            sys_msg('上传的图片文件大小超过最大限制',1);
        }

    }

    //  开始插入数据
    $fields="";
    $values="";
    $errfields = array();
    foreach($_POST as $key=>$value){
        if(is_array($value) || $key == 'act'){
            continue;
        }
        if($value == ''){
            array_push($errfields, $key);
        }
        $fields .= $key.',';
        $values .= '\''.$value.'\''.',';
    }

    $sql = 'insert into rbc_supplier ('.substr($fields,0,-1).') values ('.substr($values,0,-1).')';
    $result = $db->query($sql);
    $last_supplier_id = $db->insert_id();

    $sql = "select user_code from ecs_admin_user where user_id= {$_SESSION['admin_id']}";
    $user_code = $db->getOne($sql);

    $supplierID = $user_code.$last_supplier_id;
    $sql = "update rbc_supplier set supplierID = '{$supplierID}' where id = {$last_supplier_id}";
    $result = $db->query($sql);
    /*合作协议*/
    $file_desc_ary = $_POST['file_desc'];
    $file_ary = $_FILES['file_url'];
    for($i=0; $i < count($file_desc_ary); $i++){
        if($file_ary['name'][$i] == '')
        {
            continue;
        }

            $upload = array(
            'name' => $file_ary['name'][$i],
            'type' => $file_ary['type'][$i],
            'tmp_name' => $file_ary['tmp_name'][$i],
            'size' => $file_ary['size'][$i],
        );
        if (isset($file_ary['error']))
        {
            $upload['error'] = $file_ary['error'][$i];
        }
        $image_origin = $image->upload_image($upload);
        if($image->error_msg() != ''){
            sys_msg($image->error_msg(),1);
        }
        $sql = "INSERT INTO rbc_supplier_attach (supplier_id, attach_url, attach_desc,type) " .
            "VALUES ('$last_supplier_id', '$image_origin', '$file_desc_ary[$i]', 'file')";
        $GLOBALS['db']->query($sql);
    }

    /*企业资质*/
    for($i=0; $i < count( $_POST['img_desc']); $i++){
        if($_FILES['img_url']['name'][$i] == '')
        {
            continue;
        }
        $upload = array(
            'name' => $_FILES['img_url']['name'][$i],
            'type' => $_FILES['img_url']['type'][$i],
            'tmp_name' => $_FILES['img_url']['tmp_name'][$i],
            'size' => $_FILES['img_url']['size'][$i],
        );
        if (isset($_FILES['img_url']['error']))
        {
            $upload['error'] = $_FILES['img_url']['error'][$i];
        }
        $image_origin = $image->upload_image($upload);
        if($image->error_msg() != ''){
            sys_msg($image->error_msg(),1);
        }
        $sql = "INSERT INTO rbc_supplier_attach (supplier_id, attach_url, attach_desc,type) " .
            "VALUES ('$last_supplier_id', '$image_origin', '".$_POST['img_desc'][$i]."','img')";
        $GLOBALS['db']->query($sql);
    }

    sys_msg('信息已提交', 0, array(array('href'=>'supplier.php?act=list')));
}
?>