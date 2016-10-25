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
require_once(ROOT_PATH . '/' . ADMIN_PATH . '/includes/lib_parter.php');
require_once(ROOT_PATH . '/' . ADMIN_PATH . '/includes/cls_pingyin.php');
$exc = new exchange('rbc_parter', $db, 'id', 'parter_code');
if(!empty($_REQUEST['act']) && $_REQUEST['act'] == 'register'){
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
    if(count($errfields) > 0 ){
        $sql = "SELECT COLUMN_NAME,  COLUMN_COMMENT FROM information_schema.columns WHERE table_name = 'rbc_parter'";
        $row = $GLOBALS['db']->getAll($sql);
        $ary = array();
        foreach($row as $key => $value){
            $ary[$value['COLUMN_NAME']] = $value['COLUMN_COMMENT'];
        }
        foreach($errfields as $key=>$value){
            echo '['.$ary[$value].']'."不能为空";
            echo '<br>';
        }
       echo "<br><a href='rbc_parter_register.htm' style='font-size:24px;'>回到注册页面</a>";
    }else{
        $sql = 'insert into rbc_parter ('.$fields.') values ('.$values.')';
        $result = $GLOBALS['db']->query($sql);
        if($result){
            echo '<h1>注册信息已经提交到后台，账号目前为【待审核】状态。</h1><br><a href="parterAdmin.php" style="font-size:24px;">点击进入合作商后台登录页面</a>';
        }else{
            print_r($result);
        }
    }


}
else if($_REQUEST['act'] == 'list') {

    /* pageheader 赋值*/
    $smarty->assign('ur_here', $_LANG['parter_list']);
    $action_link = array('href' => 'rbc_parter_register.htm', 'target'=>'_blank', 'text' => '生成合作商注册链接');
    $smarty->assign('action_link',  $action_link);

    /* 列表赋值*/
    $parters_list = parters_list();
    $smarty->assign('parters_list',   $parters_list['parters']);
    $smarty->assign('filter', $parters_list['filter']);
    $smarty->assign('record_count', $parters_list['record_count']);
    $smarty->assign('page_count',   $parters_list['page_count']);
    $smarty->assign('full_page', 1);

    /* 查询性能监控 */
    assign_query_info();
    $smarty->display('parter_list.htm');
}
else if($_REQUEST['act'] == 'query'){
    $parters_list = parters_list();
    $smarty->assign('parters_list',   $parters_list['parters']);
    $smarty->assign('filter', $parters_list['filter']);
    $smarty->assign('record_count', $parters_list['record_count']);
    $smarty->assign('page_count',   $parters_list['page_count']);
    $smarty->assign('full_page', 0);
    assign_query_info();
    make_json_result($smarty->fetch('parter_list.htm'),'',
        array('filter' => $parters_list['filter'], 'page_count' => $parters_list['page_count']));

}
else if($_REQUEST['act'] == 'valid'){
    valid_parter();
}
else if($_REQUEST['act'] == 'detail'){
    $smarty->assign('ur_here', '合作商详细信息');
    $action_link = array('href' => 'parter.php?act=list', 'text' => '合作商列表');
    $smarty->assign('action_link',  $action_link);
    $partersInfo = get_parters($_REQUEST['id']);
    $smarty->assign('rbc_parter', $partersInfo);
    $smarty->assign('readonly', 'readonly');
    $smarty->assign('act', 'detail');

    $smarty->display('parters_info.htm');
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
?>