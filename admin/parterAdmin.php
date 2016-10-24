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
}elseif($_REQUEST['act'] == 'parter_info')
{
    $smarty->assign('ur_here', '合作商基本信息');
    $partersInfo = get_parters($_SESSION['admin_id']);
    $smarty->assign('rbc_parter', $partersInfo);
    $smarty->assign('readonly', 'readonly');
    $smarty->display('parter\rbc_parter_info.htm');
}

?>
