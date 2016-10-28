<?php

/**
 *  管理中心合作商相关函数
 * ============================================================================

 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}


function suppliers_list()
{
    $where = " where 1=1 ";
    $filter['keyword']          = empty($_REQUEST['keyword']) ? '' : trim($_REQUEST['keyword']);
    $filter['partnersAddress']          = empty($_REQUEST['partnersAddress']) ? '' : trim($_REQUEST['partnersAddress']);
    $filter['check_state']          = empty($_REQUEST['check_state']) ? '' : trim($_REQUEST['check_state']);
    $filter['signAgreement']          = empty($_REQUEST['signAgreement']) ? '' : trim($_REQUEST['signAgreement']);
    $filter['operator_keyword']          = empty($_REQUEST['operator_keyword']) ? '' : trim($_REQUEST['operator_keyword']);
    $filter['auditor_keyword']          = empty($_REQUEST['auditor_keyword']) ? '' : trim($_REQUEST['auditor_keyword']);
    $filter['valid_state']          = empty($_REQUEST['valid_state']) ? '' : trim($_REQUEST['valid_state']);

    /* 关键字 */
    if (!empty($filter['keyword']))
    {
        $where .= " and (parter_code LIKE '%" . mysql_like_quote($filter['keyword']) . "%' OR partnersName LIKE '%" . mysql_like_quote($filter['keyword']) . "%' OR partnersLoginName LIKE '%" . mysql_like_quote($filter['keyword']) . "%' OR leaderName LIKE '%" . mysql_like_quote($filter['keyword']) . "%'OR leaderPhone LIKE '%" . mysql_like_quote($filter['keyword']) . "%')";
    }
    if (!empty($filter['partnersAddress']))
    {
        $where .= " AND (partnersAddress LIKE '%" . mysql_like_quote($filter['partnersAddress']) . "%')";
    }
    if (!empty($filter['check_state']))
    {
        $where .= " AND (check_state ='".$filter['check_state']."')";
    }
    if (!empty($filter['operator_keyword']))
    {
        $where .= " AND (operator LIKE '%" . mysql_like_quote($filter['operator_keyword']) . "%' OR operator_name LIKE '%" . mysql_like_quote($filter['operator_keyword']) . "%')";
    }
    if (!empty($filter['auditor_keyword']))
    {
        $where .= " AND (auditor LIKE '%" . mysql_like_quote($filter['auditor_keyword']) . "%' OR auditor_name LIKE '%" . mysql_like_quote($filter['auditor_keyword']) . "%')";
    }
    if (!empty($filter['signAgreement']))
    {
        $where .= " AND (signAgreement = '".$filter['signAgreement']."'')";
    }
    if (!empty($filter['valid_state']))
    {
        $where .= " AND (valid_state = '".$filter['valid_state']."'')";
    }
    /* 记录总数 */
    $sql = "SELECT COUNT(*) FROM rbc_supplier AS g ".$where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);
    /* 分页大小 */
    $filter = page_and_size($filter);
    $sql = "select * from rbc_supplier " .$where. " LIMIT " . $filter['start'] . ",$filter[page_size]";;

    $row = $GLOBALS['db']->getAll($sql);

    return array('list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

function valid_parter(){
    $sql = "update rbc_supplier set valid_state = CASE WHEN valid_state = '可用' then    '停用' WHEN  valid_state = '停用' then  '可用' end where id = {$_REQUEST['id']}";
     $ret = $GLOBALS['db']->query($sql) or make_json_error($GLOBALS['db']->error());
    make_json_result($ret);
}

function get_shipname_list(){
    $sql = 'select shipping_id, shipping_name from ecs_shipping';
    $result = $GLOBALS['db']->getAll($sql);
    $ary = array();
    if (count($result) > 0)
    {
        foreach ($result as $ship)
        {
            $ary[$ship['shipping_id']] = $ship['shipping_name'];
        }
    }
    return $ary;
}

function get_supplier_order_list($supplier_id){

    $where = " where supplier_id = {$supplier_id} ";
    $filter['order_sn'] = empty($_REQUEST['order_sn']) ? '' : trim($_REQUEST['order_sn']);
    $filter['start_time'] =  empty($_REQUEST['start_time']) ? '' : (strpos($_REQUEST['start_time'], '-') > 0 ?  local_strtotime($_REQUEST['start_time']) : $_REQUEST['start_time']);
    $filter['end_time'] = empty($_REQUEST['end_time']) ? '' : (strpos($_REQUEST['end_time'], '-') > 0 ?  local_strtotime($_REQUEST['end_time']) : $_REQUEST['end_time']);
    $filter['shipping_status']  = $_REQUEST['shipping_status'];

//
//    /* 关键字 */

    if (!empty($filter['order_sn']))
    {
        $where .= " and (order_sn = '" . mysql_like_quote($filter['order_sn']) . "') ";
    }
    if (!empty($filter['start_time']))
    {
        $where .= " AND (add_time >= '".$filter['start_time']."')";
    }
    if (!empty($filter['end_time']))
    {
        $where .= " AND (add_time <= '".$filter['end_time']."')";
    }
    if (isset($filter['shipping_status']))
    {
        $where .= " and (shipping_status = '" . mysql_like_quote($filter['shipping_status']) . "') ";
    }
    /* 记录总数 */
    $sql = "SELECT COUNT(*) FROM ecs_order_info AS g ".$where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);
    /* 分页大小 */
    $filter = page_and_size($filter);
    $sql = "select order_id, order_sn, add_time, consignee, mobile, zipcode,address,goods_amount,shipping_fee,shipping_status from ecs_order_info " .$where. " LIMIT " . $filter['start'] . ",$filter[page_size]";;

    $row = $GLOBALS['db']->getAll($sql);

    return array('list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
    return $result;
}

function get_supplier($id){
    $sql = "select * from rbc_supplier where id = '{$id}'";
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