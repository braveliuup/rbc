<?php
ob_start(); 
header("Content-Type: text/html; charset=utf-8");
include_once('GongYingShang_RBC.php');
//判断是Get还是Post;
$Array;
$s = !empty($_GET);
if($s == true)
{
	$Array = $_GET;
}
else 
{
	$Array = $_POST;
}

//创建供应商类;
$gys = new GongYingShang_RBC();

//根据form判断执行的操作;
ob_clean();
switch($Array['form'])
{
	case "添加供应商基本信息":
		echo $gys->AddGongYingShang($Array);
		break;
	case "修改供应商基本信息":
		echo $gys->UpdateGongYingShang($Array);
		break;
	case '供应商提交银行信息':
		echo $gys->UploadBankInfo($Array);
		break;
	case "查询订单信息":
		echo $gys->SelectOrderInfo($Array);
		break;
	case "提交物流信息":
		echo $gys->UploadLogisticsInfo($Array);
		break;
	case "更改物流状态":
		echo $gys->UploadLogisticsStatus($Array);
		break;
	case "供应商列表":
		echo $gys->GongYingShangLieBiao();
		break;
		case "查询订单商品信息":
	echo $gys->GetDingDanShangPin($Array);
		break;
	default:
		echo 'error:协议错误';
		break;
}
exit;
?>