<?php

/**
 *  管理中心合作商相关函数
 * ============================================================================

 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}


function ecs_admin_user_list()
{
    $where = " where 1=1 ";
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
                $temps .= " OR ".$field." LIKE '%" . mysql_like_quote($v) . "%'" ;
           }
        }
        $where .= $temps .' ) ';
    }

    /* 记录总数 */
    $sql = "SELECT COUNT(*) FROM ecs_admin_user AS g ".$where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);
    /* 分页大小 */
    $filter = page_and_size($filter);
    $sql = "select * from ecs_admin_user ".$where. " LIMIT " . $filter['start'] . ",$filter[page_size]";;

    $row = $GLOBALS['db']->getAll($sql);

    return array('list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

function valid_parter(){
    $sql = "update rbc_supplier set valid_state = CASE WHEN valid_state = '可用' then    '停用' WHEN  valid_state = '停用' then  '可用' end where id = {$_REQUEST['id']}";
     $ret = $GLOBALS['db']->query($sql) or make_json_error($GLOBALS['db']->error());
    make_json_result($ret);
}

function get_ecs_admin_user($id){
    $id_field = 'id';
    if(isset($_REQUEST['pri'])){
        $id_field = $_REQUEST['pri'];
    }
    $sql = "select * from ecs_admin_user where ".$id_field." = '{$id}'";
    $return_array = $GLOBALS['db']->getRow($sql);
    return $return_array;
}

function parter_emp_list($id){
    $where = " where  1=1 ";
    $filter['keyword']          = empty($_REQUEST['keyword']) ? '' : trim($_REQUEST['keyword']);
    $filter['sex']          = empty($_REQUEST['sex']) ? '' : trim($_REQUEST['sex']);
    $filter['state']          = empty($_REQUEST['state']) ? '' : trim($_REQUEST['state']);

      /* 关键字 */
    if (!empty($filter['keyword']))
    {
        $where .= " and (staffID LIKE '%" . mysql_like_quote($filter['keyword']) . "%' OR loginID LIKE '%" . mysql_like_quote($filter['keyword']) . "%' OR staffName LIKE '%" . mysql_like_quote($filter['keyword']) . "%' OR phone LIKE '%" . mysql_like_quote($filter['keyword']) . "%')";
    }
    if (!empty($filter['sex']))
    {
        $where .= " AND (sex = '".$filter['sex']."')";
    }
    if (!empty($filter['state']))
    {
        $where .= " AND (state = '".$filter['state']."')";
    }
    /* 记录总数 */
    $sql = "SELECT COUNT(*) FROM rbc_parter_staff_info AS g ".$where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);
    /* 分页大小 */
    $filter = page_and_size($filter);
    $sql = "select * from rbc_parter_staff_info " .$where. " LIMIT " . $filter['start'] . ",$filter[page_size]";;

    $row = $GLOBALS['db']->getAll($sql);

    return array('list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

function get_parter_emp($id){
    $sql = "select * from rbc_parter_staff_info where id = {$id}";
    $row = $GLOBALS['db']->getRow($sql);
    return $row;
}

function parter_user_list($parter_id)
{
    $where = ' where 1 = 1 ';
    /* 记录总数 */
    $sql = "SELECT COUNT(*) FROM ecs_users AS g ".$where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);
    /* 分页大小 */
    $filter = page_and_size($filter);
    $sql = "select * from ecs_users " .$where. " LIMIT " . $filter['start'] . ",$filter[page_size]";;

    $row = $GLOBALS['db']->getAll($sql);

    return array('list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}
function move_image_file($source, $dest)
{
    if (@copy($source, $dest))
    {
        @unlink($source);
        return true;
    }
    return false;
}

?>