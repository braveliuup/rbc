<?php

/**
 *  管理中心合作商相关函数
 * ============================================================================

 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}


function parters_list()
{
    /* 过滤条件 */
//    $param_str = '-' . $is_delete . '-' . $real_goods;
//    $result = get_filter($param_str);
//    if ($result === false)
//    {
//        $day = getdate();
//        $today = local_mktime(23, 59, 59, $day['mon'], $day['mday'], $day['year']);
//
//        $filter['cat_id']           = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);
//        $filter['seller_id']           = empty($_REQUEST['seller_id']) ? 0 : intval($_REQUEST['seller_id']);//by wang 商家入住
//        $filter['intro_type']       = empty($_REQUEST['intro_type']) ? '' : trim($_REQUEST['intro_type']);
//        $filter['is_promote']       = empty($_REQUEST['is_promote']) ? 0 : intval($_REQUEST['is_promote']);
//        $filter['stock_warning']    = empty($_REQUEST['stock_warning']) ? 0 : intval($_REQUEST['stock_warning']);
//        $filter['brand_id']         = empty($_REQUEST['brand_id']) ? 0 : intval($_REQUEST['brand_id']);
//        $filter['keyword']          = empty($_REQUEST['keyword']) ? '' : trim($_REQUEST['keyword']);
//        $filter['suppliers_id'] = isset($_REQUEST['suppliers_id']) ? (empty($_REQUEST['suppliers_id']) ? '' : trim($_REQUEST['suppliers_id'])) : '';
//        $filter['is_on_sale'] = isset($_REQUEST['is_on_sale']) ? ((empty($_REQUEST['is_on_sale']) && $_REQUEST['is_on_sale'] === 0) ? '' : trim($_REQUEST['is_on_sale'])) : '';
//        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
//        {
//            $filter['keyword'] = json_str_iconv($filter['keyword']);
//        }
//        $filter['sort_by']          = empty($_REQUEST['sort_by']) ? 'goods_id' : trim($_REQUEST['sort_by']);
//        $filter['sort_order']       = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
//        $filter['extension_code']   = empty($_REQUEST['extension_code']) ? '' : trim($_REQUEST['extension_code']);
//        $filter['is_delete']        = $is_delete;
//        $filter['real_goods']       = $real_goods;
//
//        $where = $filter['cat_id'] > 0 ? " AND " . get_children($filter['cat_id']) : '';
//
//        /*wang 商家入驻*/
//        if(isset($_REQUEST['status'])&&intval($_REQUEST['status'])<3)
//        {
//            $where .=" and check_status=".intval($_REQUEST['status']);
//        }
//
//        if(isset($_REQUEST['seller_id'])&&intval($_REQUEST['seller_id'])<3)
//        {
//            $filter['seller_id']           = empty($_REQUEST['seller_id']) ? 0 : intval($_REQUEST['seller_id']);//by wang 商家入住
//            if(intval($_REQUEST['seller_id'])>0)
//            {
//                $where .=" and seller_id>0 ";
//            }
//            else
//            {
//                $where .=" and seller_id=0";
//            }
//        }
//        /*wang 商家入驻*/
//
//        /* 推荐类型 */
//        switch ($filter['intro_type'])
//        {
//            case 'is_best':
//                $where .= " AND is_best=1";
//                break;
//            case 'is_hot':
//                $where .= ' AND is_hot=1';
//                break;
//            case 'is_new':
//                $where .= ' AND is_new=1';
//                break;
//            case 'is_promote':
//                $where .= " AND is_promote = 1 AND promote_price > 0 AND promote_start_date <= '$today' AND promote_end_date >= '$today'";
//                break;
//            case 'all_type';
//                $where .= " AND (is_best=1 OR is_hot=1 OR is_new=1 OR (is_promote = 1 AND promote_price > 0 AND promote_start_date <= '" . $today . "' AND promote_end_date >= '" . $today . "'))";
//        }
//
//        /* 库存警告 */
//        if ($filter['stock_warning'])
//        {
//            $where .= ' AND goods_number <= warn_number ';
//        }
//
//        /* 品牌 */
//        if ($filter['brand_id'])
//        {
//            $where .= " AND brand_id='$filter[brand_id]'";
//        }
//
//        /* 扩展 */
//        if ($filter['extension_code'])
//        {
//            $where .= " AND extension_code='$filter[extension_code]'";
//        }
//

//
//        if ($real_goods > -1)
//        {
//            $where .= " AND is_real='$real_goods'";
//        }
//
//        /* 上架 */
//        if ($filter['is_on_sale'] !== '')
//        {
//            $where .= " AND (is_on_sale = '" . $filter['is_on_sale'] . "')";
//        }
//
//        /* 供货商 */
//        if (!empty($filter['suppliers_id']))
//        {
//            $where .= " AND (suppliers_id = '" . $filter['suppliers_id'] . "')";
//        }
//
//        $where .= $conditions;

//        /* 记录总数 */
//        $sql = "SELECT COUNT(*) FROM rbc_parter AS g ";
//        $filter['record_count'] = $GLOBALS['db']->getOne($sql);
//
//        /* 分页大小 */
//        $filter = page_and_size($filter);
//
//        $sql = "SELECT goods_id, goods_name, goods_type, goods_sn, shop_price, is_on_sale, is_best, is_new, is_hot, sort_order, goods_number, integral,check_status,check_cause, " .
//            " (promote_price > 0 AND promote_start_date <= '$today' AND promote_end_date >= '$today') AS is_promote ".
//            " FROM " . $GLOBALS['ecs']->table('goods') . " AS g WHERE is_delete='$is_delete' $where" .
//            " ORDER BY $filter[sort_by] $filter[sort_order] ".
//            " LIMIT " . $filter['start'] . ",$filter[page_size]";
//
//        $filter['keyword'] = stripslashes($filter['keyword']);
//        set_filter($filter, $sql, $param_str);
//    }
//    else
//    {
//        $sql    = $result['sql'];
//        $filter = $result['filter'];
//    }
    $where = " where 1=1 ";
    $filter['keyword']          = empty($_REQUEST['keyword']) ? '' : trim($_REQUEST['keyword']);
    $filter['partnersAddress']          = empty($_REQUEST['partnersAddress']) ? '' : trim($_REQUEST['partnersAddress']);
    $filter['check_state']          = empty($_REQUEST['check_state']) ? '' : trim($_REQUEST['check_state']);
    $filter['check_man_keyword']          = empty($_REQUEST['check_man_keyword']) ? '' : trim($_REQUEST['check_man_keyword']);
    $filter['parter_share_percent']          = empty($_REQUEST['parter_share_percent']) ? '' : trim($_REQUEST['parter_share_percent']);
    $filter['valid_state']          = empty($_REQUEST['valid_state']) ? '' : trim($_REQUEST['valid_state']);

    /* 关键字 */
    if (!empty($filter['keyword']))
    {
        $where .= " and (parter_code LIKE '%" . mysql_like_quote($filter['keyword']) . "%' OR partnersName LIKE '%" . mysql_like_quote($filter['keyword']) . "%' OR partnersLoginName LIKE '%" . mysql_like_quote($filter['keyword']) . "%' OR leaderName LIKE '%" . mysql_like_quote($filter['keyword']) . "%'OR leaderPhone LIKE '%" . mysql_like_quote($filter['keyword']) . "%')";
    }
    if (!empty($filter['partnersAddress']))
    {
//        $tempary = explode('#',$filter['partnersAddress']);
//        $tempfilter = "";
//        for($i = 0 ; $i < count($tempary) ; $i++){
//
//            if($i == 0){
//                $tempfilter .= ' and (';
//            }
//            if($i != 0 ){
//                $tempfilter .= ' or ';
//            }
//            $tempfilter .=" partnersAddress LIKE '%" . ($tempary[$i]) . "%' ";
//            if($i == count($tempary) - 1){
//                $tempfilter .= ')';
//            }
//        }
//        $where .= $tempfilter;
        $where .= " AND (partnersAddress LIKE '%" . mysql_like_quote($filter['partnersAddress']) . "%')";
    }
    if (!empty($filter['check_state']))
    {
        $where .= " AND (check_state ='".$filter['check_state']."')";
    }
    if (!empty($filter['check_man_keyword']))
    {
        $where .= " AND (check_man LIKE '%" . mysql_like_quote($filter['check_man_keyword']) . "%' OR check_man_code LIKE '%" . mysql_like_quote($filter['check_man_keyword']) . "%')";
    }
    if (!empty($filter['parter_share_percent']))
    {
        $where .= " AND (parter_share_percent = '".$filter['parter_share_percent']."'')";
    }
    if (!empty($filter['valid_state']))
    {
        $where .= " AND (valid_state = '".$filter['valid_state']."'')";
    }
    /* 记录总数 */
    $sql = "SELECT COUNT(*) FROM rbc_parter AS g ".$where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);
    /* 分页大小 */
    $filter = page_and_size($filter);
    $sql = "select * from rbc_parter " .$where. " LIMIT " . $filter['start'] . ",$filter[page_size]";;

    $row = $GLOBALS['db']->getAll($sql);

    return array('parters' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

function valid_parter(){
    $sql = "update rbc_parter set valid_state = CASE WHEN valid_state = '可用' then    '停用' WHEN  valid_state = '停用' then  '可用' end where id = {$_REQUEST['id']}";
     $ret = $GLOBALS['db']->query($sql) or make_json_error($GLOBALS['db']->error());
    make_json_result($ret);
}
function change_socre(){
    $sql = "update ecs_users set vip = vip + {$_REQUEST['score']} where user_id = {$_REQUEST['userId']}";
    make_json_result($GLOBALS['db']->query($sql));
}
function assign_emp_to_user(){
    $sql = "update ecs_users set parter_emp_id = {$_REQUEST['empId']},parter_emp_name = (select staffName from rbc_parter_staff_info where id = {$_REQUEST['empId']}) where user_id = {$_REQUEST['userId']}";
    make_json_result($GLOBALS['db']->query($sql));
}
function ajax_parter_emp_list(){
    $where=" where parter_id = {$_SESSION['admin_id']} and state = '可用' ";
    if (!empty($_REQUEST['keyword']))
    {
        $where .= " and (staffID LIKE '%" . mysql_like_quote($_REQUEST['keyword']) . "%' OR loginID LIKE '%" . mysql_like_quote($_REQUEST['keyword']) . "%' OR staffName LIKE '%" . mysql_like_quote($_REQUEST['keyword']) . "%' OR phone LIKE '%" . mysql_like_quote($_REQUEST['keyword']) . "%')";
    }
    $sql = "select id,staffID,loginID,staffName,sex,phone,commission from rbc_parter_staff_info ".$where;
    return $GLOBALS['db']->getAll($sql);
}

function get_parter_uservip_count($id){
    $sql = "select count(1) from ecs_users where parter_id = {$id}";
    return $GLOBALS['db']->getOne($sql);
}

function get_parter_user_amount($parter_id,$paymentDate){
    $where = "";
    if($paymentDate){
        $start_time = get_round_start($paymentDate);
        $end_time = strtotime('+1 month', $start_time);
        $where = " and t1.pay_time >= {$start_time} and t1.pay_time <= {$end_time}";
    }
    $sql = "select sum(money_paid) total_amount from ecs_order_info t1,ecs_users t2 where t1.user_id = t2.user_id and t2.parter_id =  {$parter_id}".$where;
    $result = $GLOBALS['db']->getOne($sql);
    return $result;
}

function get_parter_share($parter_id,$paymentDate){
    $where = "";
    if($paymentDate){
        $start_time = get_round_start($paymentDate);
        $end_time = strtotime('+1 month', $start_time);
        $where = " and t1.pay_time >= {$start_time} and t1.pay_time <= {$end_time}";
    }
    $sql = "select sum(money_paid) total_amount from ecs_order_info t1,ecs_users t2 where t1.user_id = t2.user_id and t2.parter_id =  {$parter_id}".$where;
    $result = $GLOBALS['db']->getOne($sql);
    return $result;
}

function get_parter_emp_share($parter_id,$paymentDate){
    $where = "";
    if($paymentDate){
        $start_time = get_round_start($paymentDate);
        $end_time = strtotime('+1 month', $start_time);
        $where = " and t1.pay_time >= {$start_time} and t1.pay_time <= {$end_time}";
    }

    $sql = "select cast(round(SUM(t3.commission*t1.money_paid*0.01), 2) as DECIMAL(10,2)) rbc_parter_emp_share from ecs_order_info t1, ecs_users t2, rbc_parter_staff_info t3 where t2.parter_emp_id = t3.id and t1.user_id = t2.user_id and t3.parter_id = {$parter_id}".$where;
    $result = $GLOBALS['db']->getOne($sql);
    return $result;
}

function get_round_start($day){
    $round_start = strtotime(Date('Y').'-'.Date('m').'-'.$day);
    if(Date('d') < $day){
        $round_start = strtotime('-1 month', $round_start);
    }
    return $round_start;
}

function get_parters($id){
    $sql = "select * from rbc_parter where id = '{$id}'";
    $return_array = $GLOBALS['db']->getRow($sql);
    return $return_array;
}
function parter_emp_finance_list(){
    $where = " where parter_id = {$_SESSION['admin_id']}";

    $filter['order_sn'] = empty($_REQUEST['order_sn']) ? '' : trim($_REQUEST['order_sn']);
    $filter['start_time'] =  empty($_REQUEST['start_time']) ? '' : (strpos($_REQUEST['start_time'], '-') > 0 ?  local_strtotime($_REQUEST['start_time']) : $_REQUEST['start_time']);
    $filter['end_time'] = empty($_REQUEST['end_time']) ? '' : (strpos($_REQUEST['end_time'], '-') > 0 ?  local_strtotime($_REQUEST['end_time']) : $_REQUEST['end_time']);
    $filter['settle_start_time'] = empty($_REQUEST['settle_start_time']) ? '' : (strpos($_REQUEST['settle_start_time'], '-') > 0 ?  local_strtotime($_REQUEST['settle_start_time']) : $_REQUEST['settle_start_time']);
    $filter['settle_end_time'] = empty($_REQUEST['settle_end_time']) ? '' : (strpos($_REQUEST['settle_end_time'], '-') > 0 ?  local_strtotime($_REQUEST['settle_end_time']) : $_REQUEST['settle_end_time']);
    $filter['settlement_status']  = empty($_REQUEST['settlement_status']) ? '' : trim($_REQUEST['settlement_status']);
    $filter['user_keyword']  =empty($_REQUEST['user_keyword']) ? '' : trim($_REQUEST['user_keyword']);
////
////    /* 关键字 */
//
    if (!empty($filter['order_sn']))
    {
        $where .= " and (order_sn = '" . mysql_like_quote($filter['order_sn']) . "' or goods_name like '%".mysql_like_quote($filter['order_sn']) ."%') ";
    }
    if (!empty($filter['user_keyword']))
    {
        $where .= " and (user_name like '%" . mysql_like_quote($filter['user_keyword']) . "%') ";
    }

    if (!empty($filter['start_time']))
    {
        $where .= " AND (order_time >= '".$filter['start_time']."')";
    }
    if (!empty($filter['end_time']))
    {
        $where .= " AND (order_time <= '".$filter['end_time']."')";
    }
    if (!empty($filter['settle_start_time']))
    {
        $where .= " AND (order_time >= '".$filter['settle_start_time']."')";
    }
    if (!empty($filter['settle_end_time']))
    {
        $where .= " AND (order_time <= '".$filter['settle_end_time']."')";
    }
    if (!empty($filter['settlement_status']))
    {
        $where .= " and (settlement_status = '" . mysql_like_quote($filter['settlement_status']) . "') ";
    }

    /* 记录总数 */
    $sql = "SELECT count(1) FROM ecs_order_goods  ".$where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);
    /* 分页大小 */
    $filter = page_and_size($filter);
    $sql = "SELECT
            rec_id,
            order_sn,
            goods_name,
            order_time,
            user_name,
            emp_name,
            parter_name,
            single_price,
            goods_number,
            single_price * goods_number total,
            shipping_cost,
            goods_price,
            xprice,
            company_shipping_cost,
            net_profit,
            parter_share_percent,
            parter_share,
            parter_residual_income,
            emp_share_percent,
            emp_share,
            settlement_status
        FROM
            ecs_order_goods".$where. " LIMIT " . $filter['start'] . ",$filter[page_size]";
    $row = $GLOBALS['db']->getAll($sql);
    return array('list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

function get_nochecked_daifu_coutn(){
    $sql = "SELECT count(1) FROM rbc_pay_for_another where parter_id = {$_SESSION['admin_id']} and pay_status = '未审核代付'";
    return $GLOBALS['db']->getOne($sql);
}
function help_pay_user_list(){
    $where = " where parter_id = {$_SESSION['admin_id']}";
    $filter['daifu_status']  = empty($_REQUEST['daifu_status']) ? '' : trim($_REQUEST['daifu_status']);
    if (!empty($filter['daifu_status']))
    {
        $where .= " and (pay_status = '" . mysql_like_quote($filter['daifu_status']) . "') ";
    }

    /* 记录总数 */
    $sql = "SELECT count(1) FROM rbc_pay_for_another  ".$where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);
    /* 分页大小 */
    $filter = page_and_size($filter);
    $sql = "SELECT * FROM rbc_pay_for_another".$where. " LIMIT " . $filter['start'] . ",$filter[page_size]";
    $row = $GLOBALS['db']->getAll($sql);
    return array('list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

function parter_finance_list(){
    $where = " where parter_id = {$_SESSION['admin_id']}";

     $filter['order_sn'] = empty($_REQUEST['order_sn']) ? '' : trim($_REQUEST['order_sn']);
    $filter['start_time'] =  empty($_REQUEST['start_time']) ? '' : (strpos($_REQUEST['start_time'], '-') > 0 ?  local_strtotime($_REQUEST['start_time']) : $_REQUEST['start_time']);
    $filter['end_time'] = empty($_REQUEST['end_time']) ? '' : (strpos($_REQUEST['end_time'], '-') > 0 ?  local_strtotime($_REQUEST['end_time']) : $_REQUEST['end_time']);
    $filter['settle_start_time'] = empty($_REQUEST['settle_start_time']) ? '' : (strpos($_REQUEST['settle_start_time'], '-') > 0 ?  local_strtotime($_REQUEST['settle_start_time']) : $_REQUEST['settle_start_time']);
    $filter['settle_end_time'] = empty($_REQUEST['settle_end_time']) ? '' : (strpos($_REQUEST['settle_end_time'], '-') > 0 ?  local_strtotime($_REQUEST['settle_end_time']) : $_REQUEST['settle_end_time']);
    $filter['settlement_status']  = empty($_REQUEST['settlement_status']) ? '' : trim($_REQUEST['settlement_status']);
    $filter['user_keyword']  =empty($_REQUEST['user_keyword']) ? '' : trim($_REQUEST['user_keyword']);
    $filter['emp_keyword']  = empty($_REQUEST['emp_keyword']) ? '' : trim($_REQUEST['emp_keyword']);
////
////    /* 关键字 */
//
    if (!empty($filter['order_sn']))
    {
        $where .= " and (order_sn = '" . mysql_like_quote($filter['order_sn']) . "' or goods_name like '%".mysql_like_quote($filter['order_sn']) ."%') ";
    }
    if (!empty($filter['user_keyword']))
    {
        $where .= " and (user_name like '%" . mysql_like_quote($filter['user_keyword']) . "%') ";
    }
    if (!empty($filter['emp_keyword']))
    {
        $where .= " and (emp_name like '%".mysql_like_quote($filter['emp_keyword']) ."%') ";
    }
    if (!empty($filter['start_time']))
    {
        $where .= " AND (order_time >= '".$filter['start_time']."')";
    }
    if (!empty($filter['end_time']))
    {
        $where .= " AND (order_time <= '".$filter['end_time']."')";
    }
    if (!empty($filter['settle_start_time']))
    {
        $where .= " AND (order_time >= '".$filter['settle_start_time']."')";
    }
    if (!empty($filter['settle_end_time']))
    {
        $where .= " AND (order_time <= '".$filter['settle_end_time']."')";
    }
    if (!empty($filter['settlement_status']))
    {
        $where .= " and (settlement_status = '" . mysql_like_quote($filter['settlement_status']) . "') ";
    }

    /* 记录总数 */
    $sql = "SELECT count(1) FROM ecs_order_goods  ".$where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);
    /* 分页大小 */
    $filter = page_and_size($filter);
    $sql = "SELECT
            rec_id,
            order_sn,
            goods_name,
            order_time,
            user_name,
            emp_name,
            parter_name,
            single_price,
            goods_number,
            single_price * goods_number total,
            shipping_cost,
            goods_price,
            xprice,
            company_shipping_cost,
            net_profit,
            parter_share_percent,
            parter_share,
            parter_residual_income,
            emp_share_percent,
            emp_share,
            settlement_status
        FROM
            ecs_order_goods".$where. " LIMIT " . $filter['start'] . ",$filter[page_size]";
    $row = $GLOBALS['db']->getAll($sql);
    return array('list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

function parter_consume_list(){
    $where = " and t1.parter_id = {$_SESSION['admin_id']}";

    $filter['goods_name'] = empty($_REQUEST['goods_name']) ? '' : trim($_REQUEST['goods_name']);
    $filter['parter_emp_name'] = empty($_REQUEST['parter_emp_name']) ? '' : trim($_REQUEST['parter_emp_name']);
    $filter['sex'] = empty($_REQUEST['sex']) ? '' : trim($_REQUEST['sex']);
    $filter['is_assign'] = empty($_REQUEST['is_assign']) ? '' : trim($_REQUEST['is_assign']);
    $filter['start_amount'] = empty($_REQUEST['start_amount']) ? '' : trim($_REQUEST['start_amount']);
    $filter['end_amount'] = empty($_REQUEST['end_amount']) ? '' : trim($_REQUEST['end_amount']);
    $filter['start_time'] =  empty($_REQUEST['start_time']) ? '' : (strpos($_REQUEST['start_time'], '-') > 0 ?  local_strtotime($_REQUEST['start_time']) : $_REQUEST['start_time']);
    $filter['end_time'] = empty($_REQUEST['end_time']) ? '' : (strpos($_REQUEST['end_time'], '-') > 0 ?  local_strtotime($_REQUEST['end_time']) : $_REQUEST['end_time']);

    if (!empty($filter['goods_name']))
    {
        $where .= " and (b.order_sn = '" . mysql_like_quote($filter['order_sn']) . "' or a.goods_name like '%".mysql_like_quote($filter['order_sn']) ."%') ";
    }
    if (!empty($filter['parter_emp_name']))
    {
        $where .= " and (t2.parter_emp_name like '%" . mysql_like_quote($filter['parter_emp_name']) . "%') ";
    }
    if (!empty($filter['sex']))
    {
        $where .= " and (t2.sex = '" . mysql_like_quote($filter['sex']) . "') ";
    }
    if (!empty($filter['is_assign']))
    {
        $where .= " and (t1.is_assign = '" . mysql_like_quote($filter['is_assign']) . "' ) ";
    }
    if (!empty($filter['start_amount']))
    {
        $where .= " and (t1.goods_amount >= {$filter['start_amount']} ) ";
    }
    if (!empty($filter['end_amount']))
    {
        $where .= " and (t1.end_amount >= {$filter['end_amount']} ) ";
    }
    if (!empty($filter['start_time']))
    {
        $where .= " AND (t1.add_time >= '".$filter['start_time']."')";
    }
    if (!empty($filter['end_time']))
    {
        $where .= " AND (t1.add_time <= '".$filter['end_time']."')";
    }

    /* 记录总数 */
    $sql = "SELECT
           count(1)
        FROM
            ecs_order_info t1,
            ecs_users t2
        WHERE
         t1.user_id = t2.user_id ".$where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);
    /* 分页大小 */
    $filter = page_and_size($filter);
    $sql = "SELECT
            t1.order_id,
            t1.order_sn,
            t2.name,
            t2.mobile_phone,
            t2.parter_emp_name,
            t1.goods_amount,
            t1.rbc_pay_way,
            FROM_UNIXTIME(t1.add_time) add_time,
            t1.seperate_status
        FROM
            ecs_order_info t1,
            ecs_users t2
        WHERE
         t1.user_id = t2.user_id".$where. " LIMIT " . $filter['start'] . ",$filter[page_size]";
    $row = $GLOBALS['db']->getAll($sql);
    return array('list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
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
    $sql = "select * from rbc_parter_staff_info " .$where. " LIMIT " . $filter['start'] . ",$filter[page_size]";

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
    $where = " where 1 = 1 and parter_emp_id in (select id from rbc_parter_staff_info where parter_id  = '{$parter_id}') ";
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
function move_image_file($source, $dest)
{
    if (@copy($source, $dest))
    {
        @unlink($source);
        return true;
    }
    return false;
}
function get_consignee_addr($id){
    $sql = "select * from ecs_user_address where address_id = {$id}";
    $row = $GLOBALS['db']->getRow($sql);
    return $row;
}
/*收件人地址列表*/
function get_consignee_addr_list(){
    $sql = "select *,(case when concat(tel_prefix,'-',tel_main,'-',tel_suffix) = '--' then '' else  concat(tel_prefix,'-',tel_main,'-',tel_suffix) end) telconcat,(select group_concat(region_name SEPARATOR ' ') from ecs_region where region_id = t.country or region_id = t.province or region_id = t.city or region_id = t.district) as region from ecs_user_address t where user_id = '{$_SESSION["admin_code"]}' order by is_default desc";
    $result = $GLOBALS['db']->getAll($sql);
    return $result;
}

function get_year_list(){
    $ary = array();
    $y = Date("Y");
    for($i = 0; $i < 5; $i++){
        $ary[$y-$i] = $y-$i;
    }
    return $ary;

}
function get_month_list(){
    $ary = array();
    $i = 0 ;
    while($i<12){
        $i++;
        $ary[$i] = $i;
    }
    return $ary;
}
function get_settlement_day($id){
    $sql = "select paymentDate from rbc_parter where id = {$id}";
    return $GLOBALS['db']->getOne($sql);
}

?>