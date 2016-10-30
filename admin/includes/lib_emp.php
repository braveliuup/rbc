<?php
/**
 * Created by PhpStorm.
 * User: yong
 * Date: 2016/10/30
 * Time: 3:54
 */
if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

function get_parter_emp(){
    $sql = "select * from rbc_parter_staff_info where id = '{$_SESSION['admin_id']}'";
    $return_array = $GLOBALS['db']->getRow($sql);
    return $return_array;

}

function udpate_emp(){
    $sql = "update rbc_parter_staff_info set phone = '{$_POST["phone"]}' where id  ={$_POST['id']}";
    $result = $GLOBALS['db']->query($sql);
    make_json_result($result);
}

function emp_user_list()
{
    $where = " where parter_emp_id = {$_SESSION['admin_id']} ";
    foreach($_POST as $k=>$v){
        if(substr($k,0,7) != 'kfilter')
            continue;
        if($v == '')
            continue;
        $ary = explode('-', substr($k,7));
        $where .= ' and (';
        $temps='';
        foreach($ary as $idx=>$field){
            if($idx == 0){
                $temps .= $field." LIKE '%" . mysql_like_quote($v) . "%'";
            }else{
                $temps .= " OR ".$field." LIKE '%" .stripslashes( mysql_like_quote($v)) . "%'" ;
            }
        }
        $where .= $temps .' ) ';
    }
    $where = stripslashes($where);
    /* 记录总数 */
    $sql = "SELECT COUNT(*) FROM ecs_users AS g ".$where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);
    /* 分页大小 */
    $filter = page_and_size($filter);
    $sql = "select * from ecs_users " .$where. " LIMIT " . $filter['start'] . ",$filter[page_size]";;

    $row = $GLOBALS['db']->getAll($sql);

    return array('list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}