<?php

define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init_emp.php');
require(dirname(__FILE__) . '/includes/lib_emp.php');

$emp_tbl = 'rbc_parter_staff_info';

if ($_REQUEST['act'] == 'logout')
{
    $sess->destroy_session();
    $_SESSION = array();
    exit('<script>top.location.href="templates/emp/emp_login.htm"</script>');
}
if ($_REQUEST['act'] == '' || $_REQUEST['act'] == 'login')
{
    if(isset($_SESSION['admin_id']) && $_SESSION['admin_id'] > 0){
        $smarty->display('emp\emp_index.htm');
        exit;
    }
    header('location:templates\emp\emp_login.htm');

}
elseif($_REQUEST['act'] == 'signin'){
    $_POST['username'] = isset($_POST['username']) ? trim($_POST['username']) : '';
    /* 检查密码是否正确 */
    $sql = "SELECT id,staffID,staffName".
        " FROM {$emp_tbl}" .
        " WHERE loginID = '{$_POST['username']}' and password = '{$_POST['pwd']}'" ;

    $row = $GLOBALS['db']->getRow($sql);
    if ($row)
    {
        // 登录成功
        $_SESSION['admin_id']    = $row['id'];
        $_SESSION['admin_name']  = $row['staffName'];
        $_SESSION['admin_code']  = $row['staffID'];

        ecs_header("Location: ./parterEmpAdmin.php\n");
        exit;
    }
    else
    {
        sys_msg('员工登录名或密码不存在', 1);
    }
}
/*------------------------------------------------------ */
//-- 顶部框架的内容
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'top')
{
    // 获得管理员设置的菜单
    $lst = array();


    $smarty->display('emp\emp_top.htm');
}
/*------------------------------------------------------ */
//-- 左边的框架
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'menu')
{
    $smarty->assign('admin_id', $_SESSION['admin_id']);
    $smarty->display('emp\emp_menu.htm');
}
/*------------------------------------------------------ */
//-- 主窗口，起始页
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'main')
{
    $smarty->display('emp\emp_start.htm');
}

elseif($_REQUEST['act'] == 'rbc_emp_pwd_reset'){
    $smarty->display('emp\rbc_emp_pwd_reset.htm');
}
elseif($_REQUEST['act'] == 'reset_emp_pwd'){
    $sql = "select count(*) from {$emp_tbl} where id = '{$_SESSION["admin_id"]}' and  password = '{$_POST["old_pwd"]}'";
    $result = $db->getOne($sql);
    if($result == 0){
        sys_msg('旧密码错误');
    }else{
        $sql ="update {$emp_tbl} set password = '{$_POST["new_pwd"]}' where id = '{$_SESSION["admin_id"]}'";
        if($db->query($sql)){
            sys_msg('密码修改成功,请重新登录',0, array(array('href'=>'parterEmpAdmin.php?act=logout')));
        }
    }
}
