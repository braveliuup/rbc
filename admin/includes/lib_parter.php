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
        $where .= " AND (valid_state = '".$filter['check_state']."'')";
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

function get_parters($id){
    $sql = "select * from rbc_parter where id = '{$id}'";
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