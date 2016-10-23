<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-10-21
 * Time: 12:04
 */
define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');

if($_REQUEST['act'] == 'province'){
    $sql = "select code, province as name  from rbc_nation where parent = 1";
    $row = $GLOBALS['db']->getAll($sql);
    make_json_result( $row );
}else if($_REQUEST['act'] == 'city'){
    if($_REQUEST['code'] == '110000' || $_REQUEST['code'] == '120000' || $_REQUEST['code'] == '310000' || $_REQUEST['code'] == '500000'){
        $sql = "select code, city as name from rbc_nation where code = '{$_REQUEST['code']}'";
    }else{
        $sql = "select code, city as name from rbc_nation where parent = (select id from rbc_nation where code = '{$_REQUEST['code']}')";
    }
    $row = $GLOBALS['db']->getAll($sql);
    make_json_result( $row );
}else if($_REQUEST['act'] == 'region'){
    $sql = "select code, district as name from rbc_nation where parent = (select id from rbc_nation where code = '{$_REQUEST['code']}')";
    $row = $GLOBALS['db']->getAll($sql);
    make_json_result( $row );
}
else if($_REQUEST['act'] == 'parse_code'){
    $ary = explode('#',urldecode($_REQUEST['code']));
    $sql = "select group_concat(name separator  ' ') addr from 
      (select province name from rbc_nation where code = '{$ary[0]}' union all select city name from rbc_nation where  code = '{$ary[1]}' union all select district name from rbc_nation where code = '{$ary[2]}') as g
    ";
    $result = $GLOBALS['db']->getOne($sql);
    make_json_result( $result );
}