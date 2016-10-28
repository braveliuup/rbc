<?php
ob_start(); 
header('Content-Type: text/html; charset=utf-8');
include_once('Base/RBC.php');
include_once('Base/Examine.php');
class GongYingShang_RBC extends RBC
{
    public function __construct() 
	{  
    }
	
	//修改供应商基本信息;
	function UpdateGongYingShang($_MARRAY)
	{
		$username = $this->GetUserName();
		if($username == null)
		{
			return 'error:尚未登录';
		}
		$ex = new Examine();
		$tempArray = array('Name','AccountUumber','addr_4','ShengChanShangName','YeWuRen_Name',
		'YeWuRen_Phone','DingDanRen_Name','DingDanRen_Phone','addr_1','addr_2','addr_3','FPhoneNumber_1','FPhoneNumber_2','FPhoneNumber_3',
		'QQ','YouXiang','ShiFouHeZuo','BeiZhu','firstPart','freight','add','addFee','JieKuanRi');
		if($ex->ExamineDataArrayIsExists($_MARRAY, $tempArray) == false)
		{
			return 'error:没有关键数据';
		}
		
		$error = null;
		if($error == null)
			$error = $ex->ExamineData("供应商名称","C_Len",$_MARRAY['Name'],3,50, false);
		if($error == null)
			$error = $ex->ExamineData("供应商登录名","AccountNumber",$_MARRAY['AccountUumber'],3,8, false);
		if($error == null)
			$error = $ex->ExamineData("供应商详细地址","C_Len",$_MARRAY['addr_4'],3,50, false);
		if($error == null)
			$error = $ex->ExamineData("生产商名称","C_Len",$_MARRAY['ShengChanShangName'],3,50, false);
		if($error == null)
			$error = $ex->ExamineData("业务联系人名称","C_Len",$_MARRAY['YeWuRen_Name'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("业务联系人手机","PhoneNumber",$_MARRAY['YeWuRen_Phone'],1,12, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人名称","C_Len",$_MARRAY['DingDanRen_Name'],1,12, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人手机","C_Len",$_MARRAY['DingDanRen_Phone'],1,12, false);
		if($error == null)
			$error = $ex->ExamineData("供应商发货地","Int",$_MARRAY['addr_1'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("供应商发货地","Int",$_MARRAY['addr_2'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("供应商发货地","Int",$_MARRAY['addr_3'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人座机区号","Int",$_MARRAY['FPhoneNumber_1'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人座机电话号","Int",$_MARRAY['FPhoneNumber_2'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人座机分机号","Int",$_MARRAY['FPhoneNumber_3'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人QQ","Number",$_MARRAY['QQ'],1,20, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人邮箱","NULL",$_MARRAY['YouXiang'],1,25, false);
		if($error == null)
			$error = $ex->ExamineData("是否签定合作协议","NULL",$_MARRAY['ShiFouHeZuo'],1,1, false);
		if($error == null)
			$error = $ex->ExamineData("首件","Double",$_MARRAY['firstPart'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("运费","Double",$_MARRAY['freight'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("续件","Double",$_MARRAY['add'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("续费","Double",$_MARRAY['addFee'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("结款日","Int",$_MARRAY['JieKuanRi'],1,8, false);
		
		if($error != null)
		{
			return 'error:'.$error;
		}
		
		$JieKuanRi = $_MARRAY['JieKuanRi'];
		$tempValue = intval($JieKuanRi);
		if($tempValue == 0)
		{
			$Error = $ex->Number($_MARRAY['JieKuanRi_Default'],1,8,false);
			if(is_string($Error) == true)
			{
				$err = $this->Get_ERROR_Json("AddUserInfo","-1",$Error);
				$res = $this->Get_MyJson("false",$err,null);
				return $res;
			}
			$tempValue = intval($_MARRAY['JieKuanRi_Default']);
			if($tempValue <=0 || $tempValue >31)
			{
				return 'error:结款日不正确';
			}
			$tempValue += 100;
			$_MARRAY['JieKuanRi'] = $tempValue;
		}
		$supplierShoppingAddress = $_MARRAY['addr_1'].'-'.$_MARRAY['addr_2'].'-'.$_MARRAY['addr_3'];
		$orderContactTel = $_MARRAY['FPhoneNumber_1'].'-'.$_MARRAY['FPhoneNumber_2'].'-'.$_MARRAY['FPhoneNumber_3'];
		
		//整理供应商基本信息Sql语句;
		
		$q = "`supplierName`='".$_MARRAY['Name']."',`supplierLoginName`='".$_MARRAY['AccountUumber']."',`supplierDetailAddress`='".$_MARRAY['addr_4']
		."',`manufacturer`='".$_MARRAY['ShengChanShangName']."',`businessContactName`='".$_MARRAY['YeWuRen_Name']."',`businessContacPhone`='".$_MARRAY['YeWuRen_Phone']
		."',`orderContactName`='".$_MARRAY['DingDanRen_Name']."',`orderContactPhone`='".$_MARRAY['DingDanRen_Phone']
		."',`supplierShoppingAddress`='".$supplierShoppingAddress."',`orderContactTel`='".$orderContactTel."',`orderContactQQ`='".$_MARRAY['QQ']
		."',`orderContactEmail`='".$_MARRAY['YouXiang']."',`signAgreement`='".$_MARRAY['ShiFouHeZuo']."',`remark`='".$_MARRAY['BeiZhu']
		."',`firstPart`='".$_MARRAY['firstPart']."',`freight`='".$_MARRAY['freight']."',`add`='".$_MARRAY['add']."',`addFee`='".$_MARRAY['addFee']."',`PaymentDate`='".$_MARRAY['JieKuanRi']."'";
		
		date_default_timezone_set('PRC'); 
		$sql = "update supplier_info set ".$q;
		
		$sql .= " where `supplierLoginName`='".$_POST["AccountUumber"]."' and `supplierID`='".$_POST["Id"]."'";
		
		//连接数据库;
		if($this->ConnectDataBase() == false)
		{
			return 'error:数据库连接失败';
		}
		
		//提交供应商基本信息;
		$rownum = $this->RunSql($sql);
		if($rownum < 0)
		{
			return "error:数据提交失败";
		}
		
		//删除旧的供应商图片;
		$sql = "delete from supplier_image where `supplierID`='".$_POST["Id"]."'";
		$this->RunSql($sql);
		
		//提交协议图片;
		if(isset($_POST['xieyi_data']) == true && $_POST['xieyi_data'] != '')
		{
			$imgSql = "insert into supplier_image(image_data,supplierID,type)values('".$_POST["xieyi_data"]."','".$_POST["Id"]."','2');";
			
			if($this->RunSql($imgSql) <= 0)
			{
				$this->CloseDataBase();
            	$this->DeleteGongYingShang($supplierID);
				return "error:企业协议图片数据提交失败";
			}
		}
		
		//提交的企业资质图片;
		for($i = 1;$i<=10;$i++)
		{
			$key = "zizhi" . $i . "_data";
			if(isset($_POST[$key]) == true && $_POST[$key] != '')
			{
				$imgSql = "insert into supplier_image(image_data,supplierID,type)values('".$_POST[$key]."','".$_POST["Id"]."','1');";
				if($this->RunSql($imgSql) <= 0)
				{
					$this->CloseDataBase();
            		$this->DeleteGongYingShang($supplierID);
					return "error:企业资质图片数据提交失败";
				}
			}
		}
		
		
		return "修改完成";
	}
	
	//添加供应商基本信息;
	function AddGongYingShang($_MARRAY)
	{
		$username = $this->GetUserName();
		if($username == null)
		{
			$err = $this->Get_ERROR_Json("AddGongYingShang","-1","尚未登录");
			$res = $this->Get_MyJson("false",$err,null);
			return $res;
		}
		$ex = new Examine();
		$tempArray = array('Id','Name','AccountUumber','PassWord','addr_4','ShengChanShangName','YeWuRen_Name',
		'YeWuRen_Phone','DingDanRen_Name','DingDanRen_Phone','addr_1','addr_2','addr_3','FPhoneNumber_1','FPhoneNumber_2','FPhoneNumber_3',
		'QQ','YouXiang','ShiFouHeZuo','BeiZhu','firstPart','freight','add','addFee','JieKuanRi');
		if($ex->ExamineDataArrayIsExists($_MARRAY, $tempArray) == false)
		{
			$err = $this->Get_ERROR_Json("AddUserInfo","-1","没有关键数据");
			$res = $this->Get_MyJson("false",$err,null);
			return $res;
		}
		
		$error = null;
		if($error == null)
			$error = $ex->ExamineData("供应商编号","Int",$_MARRAY['Id'],6,12, false);
		if($error == null)
			$error = $ex->ExamineData("供应商名称","C_Len",$_MARRAY['Name'],3,50, false);
		if($error == null)
			$error = $ex->ExamineData("供应商登录名","AccountNumber",$_MARRAY['AccountUumber'],3,8, false);
		if($error == null)
			$error = $ex->ExamineData("供应商详细地址","C_Len",$_MARRAY['addr_4'],3,50, false);
		//if($error == null)
			//$error = $ex->ExamineData("生产商名称","C_Len",$_MARRAY['ShengChanShangName'],3,50, false);
		if($error == null)
			$error = $ex->ExamineData("业务联系人名称","C_Len",$_MARRAY['YeWuRen_Name'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("业务联系人手机","PhoneNumber",$_MARRAY['YeWuRen_Phone'],1,12, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人名称","C_Len",$_MARRAY['DingDanRen_Name'],1,12, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人手机","C_Len",$_MARRAY['DingDanRen_Phone'],1,12, false);
		if($error == null)
			$error = $ex->ExamineData("供应商发货地","Int",$_MARRAY['addr_1'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("供应商发货地","Int",$_MARRAY['addr_2'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("供应商发货地","Int",$_MARRAY['addr_3'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人座机区号","Int",$_MARRAY['FPhoneNumber_1'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人座机电话号","Int",$_MARRAY['FPhoneNumber_2'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人座机分机号","Int",$_MARRAY['FPhoneNumber_3'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人QQ","Number",$_MARRAY['QQ'],1,20, false);
		if($error == null)
			$error = $ex->ExamineData("订单联系人邮箱","NULL",$_MARRAY['YouXiang'],1,25, false);
		if($error == null)
			$error = $ex->ExamineData("是否签定合作协议","NULL",$_MARRAY['ShiFouHeZuo'],1,1, false);
		if($error == null)
			$error = $ex->ExamineData("首件","Double",$_MARRAY['firstPart'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("运费","Double",$_MARRAY['freight'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("续件","Double",$_MARRAY['add'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("续费","Double",$_MARRAY['addFee'],1,8, false);
		if($error == null)
			$error = $ex->ExamineData("结款日","Int",$_MARRAY['JieKuanRi'],1,8, false);
		
		if($error != null)
		{
			$err = $this->Get_ERROR_Json("AddUserInfo","-1",$error);
			$res = $this->Get_MyJson("false",$err,null);
			return $res;
		}
		
		$JieKuanRi = $_MARRAY['JieKuanRi'];
		$tempValue = intval($JieKuanRi);
		if($tempValue == 0)
		{
			$Error = $this->ex->Double_($_MARRAY['JieKuanRi_Default']);
			if(is_string($Error) == true)
			{
				$err = $this->Get_ERROR_Json("AddUserInfo","-1",$Error);
				$res = $this->Get_MyJson("false",$err,null);
				return $res;
			}
			$tempValue = intval($JieKuanRi_Default);
			if($tempValue <=0 || $tempValue >31)
			{
				$err = $this->Get_ERROR_Json("AddUserInfo","-1","结款日不正确");
				$res = $this->Get_MyJson("false",$err,null);
				return $res;
			}
			$tempValue += 100;
			$_MARRAY['JieKuanRi'] = $tempValue;
		}
		$supplierShoppingAddress = $_MARRAY['addr_1'].'-'.$_MARRAY['addr_2'].'-'.$_MARRAY['addr_3'];
		$orderContactTel = $_MARRAY['FPhoneNumber_1'].'-'.$_MARRAY['FPhoneNumber_2'].'-'.$_MARRAY['FPhoneNumber_3'];
		
		
		//连接数据库;
		if($this->ConnectDataBase() == false)
		{
			$err = $this->Get_ERROR_Json("AddUserInfo","-1","数据库连接失败");
			$res = $this->Get_MyJson("false",$err,null);
			return $res;
		}
		
		//验证供应商编号是否存在;
		if($this->RunSql("select * from supplier_info where supplierID='".$_MARRAY["Id"]."'") > 0)
		{
			$err = $this->Get_ERROR_Json("AddUserInfo","-1","供应商编号已经存在");
			$res = $this->Get_MyJson("false",$err,null);
			return $res;
		}
		//验证登录名是否存在;
		if($this->RunSql("select * from tbl_user where UserName='".$_MARRAY["AccountUumber"]."'") > 0)
		{
			$err = $this->Get_ERROR_Json("AddUserInfo","-1","登录名已经存在");
			$res = $this->Get_MyJson("false",$err,null);
			return $res;
		}
		
		date_default_timezone_set('PRC'); 
		$sql = "INSERT INTO `supplier_info` (`supplierID`, `supplierName`, `supplierLoginName`, `supplierDetailAddress`, `manufacturer`, `businessContactName`, `businessContacPhone`, `orderContactName`,".
		"`orderContactPhone`, `supplierShoppingAddress`, `orderContactTel`, `orderContactQQ`, `orderContactEmail`, `signAgreement`, `remark`, `firstPart`, `freight`, `add`, `addFee`, `PaymentDate`,`alterTime`,`operator`) VALUES (";
		$sql .= "'".$_MARRAY['Id']."','".$_MARRAY['Name']."','".$_MARRAY['AccountUumber']."','".$_MARRAY['addr_4']."','".$_MARRAY['ShengChanShangName']."','".$_MARRAY['YeWuRen_Name']
		."','".$_MARRAY['YeWuRen_Phone']."','".$_MARRAY['DingDanRen_Name']."','".$_MARRAY['DingDanRen_Phone']."','".$supplierShoppingAddress."','".$orderContactTel."','".$_MARRAY['QQ']
		."','".$_MARRAY['YouXiang']."','".$_MARRAY['ShiFouHeZuo']."','".$_MARRAY['BeiZhu']."','".$_MARRAY['firstPart']."','".$_MARRAY['freight']."','".$_MARRAY['add']."','".$_MARRAY['addFee']."','".$_MARRAY['JieKuanRi']."','".date('y-m-d H:i:s',time())."','".$username."')";
		
		//提交供应商基本信息;
		if($this->RunSql($sql) <= 0)
		{
			$err = $this->Get_ERROR_Json("AddUserInfo","-1","数据提交失败");
			$res = $this->Get_MyJson("false",$err,null);
			return $res;
		}
		
		//提交协议图片;
		if(isset($_MARRAY['xieyi_data']) == true && $_MARRAY['xieyi_data'] != '')
		{
			$imgSql = "insert into supplier_image(image_data,supplierID,type)values('".$_MARRAY["xieyi_data"]."','".$_MARRAY["Id"]."','2');";
			
			if($this->RunSql($imgSql) <= 0)
			{
				$this->CloseDataBase();
            	$this->DeleteGongYingShang($supplierID);
				return "error:企业协议图片数据提交失败";
			}
		}
		
		//提交的企业资质图片;
		
		for($i = 1;$i<=10;$i++)
		{
			$key = "zizhi" . $i . "_data";
			if(isset($_MARRAY[$key]) == true && $_MARRAY[$key] != '')
			{
				$imgSql = "insert into supplier_image(image_data,supplierID,type)values('".$_MARRAY[$key]."','".$_MARRAY["Id"]."','1');";
				if($this->RunSql($imgSql) <= 0)
				{
					$this->CloseDataBase();
            		$this->DeleteGongYingShang($supplierID);
					return "error:企业资质图片数据提交失败";
				}
			}
		}
		
		//添加供应商账户信息;
		$userSql = "insert into tbl_user(`UserName`,`Password`,`Role`,`Active`)  value('".$_MARRAY["AccountUumber"]."','".$_MARRAY["PassWord"]."','5','1');";
		//如果账户添加失败，那么刚添加的供应商基本信息应该删除;
		if($this->RunSql($userSql) <= 0)
		{
			$this->CloseDataBase();
            $this->DeleteGongYingShang($_MARRAY["Id"]);
			return "error:供应商登录账号提交错误，提交失败";
		}
		$this->CloseDataBase();
		return "提交成功";
	}
	
	//删除供应商基本信息;
	function DeleteGongYingShang($supplierID)
	{
		//连接数据库;
		if($this->ConnectDataBase() == false)
		{
			return 'error:数据库连接失败';
		}
		//删除基本信息;
		$deleteSql = "delete from supplier_info where supplierID='".$supplierID."'";
		$this->RunSql($deleteSql);
		//删除图片数据;
		$deleteSql = "delete from supplier_image where supplierID='".$supplierID."'";
		$this->RunSql($deleteSql);
		//关闭数据库;
		$this->CloseDataBase();
	}
	
	//查询供应商基本信息;
	function SelectSupplier($username='', $dic = true)
	{
		$username = $this->GetUserName();
		if($username == null)
		{
			return 'error:尚未登录';
		}
		
		date_default_timezone_set('PRC'); 
		
		$sql = "select id as pri_id, `supplierID` as Id, `supplierName` as `Name`, `supplierLoginName` as AccountUumber, `supplierDetailAddress` as addr_4, `manufacturer` as ShengChanShangName, `businessContactName` as YeWuRen_Name, `businessContacPhone` as YeWuRen_Phone, `orderContactName` as DingDanRen_Name,`orderContactPhone` as DingDanRen_Phone, `supplierShoppingAddress` as addr_1, `orderContactTel` as DingDanRen_ZuoJI, `orderContactQQ` as QQ, `orderContactEmail` as YouXiang, `signAgreement` as ShiFouHeZuo, `remark` as BeiZhu, `firstPart` as firstPart, `freight` as freight, `addPart` as `add`, `addFee` as addFee, `PaymentDate` as JieKuanRi, bankAccount, bankAccountName, bankName, bankAddress from rbc_supplier where supplierLoginName='".$username."'";
		
		//连接数据库;
		if($this->ConnectDataBase() == false)
		{
			return "error:数据库连接失败";
		}
		
		
		//查询供应商基本信息;
		if($this->RunSql($sql) <= 0)
		{
			$this->CloseDataBase();
			return "error:没有查询到结果";
		}
		$row = mysql_fetch_assoc($this->query);
		mysql_free_result($this->query);
		
		//查询供应商上传的图片;
		$image = array();
		$sql = "select `id` as `系统编号`,attach_desc as `描述`,`attach_url` as `数据`, `type` as `类型` from rbc_supplier_attach where `supplier_id` = '".$row['pri_id']."'";
		if($this->RunSql($sql) > 0)
		{
			while ($img = mysql_fetch_assoc($this->query)) 
			{
				array_push($image,$img);
			}
		}
		mysql_free_result($this->query);
		
//		if($dic == true)
//		{
//			//替换字典;
//			include_once('Base/Dic.php');
//			$dic = new Dic();
//			$row['ShiFouHeZuo'] = $dic->IntValueGetName('是否签定合作协议',intval($row['ShiFouHeZuo']));
//			$row['JieKuanRi'] = $dic->IntValueGetName('结款日',intval($row['JieKuanRi']));
//
//			$area = explode('-',$row['addr_1']);
//			$temp = $dic->IdToArea($this,$area[0],$area[1],$area[2]);
//			if($temp != false)
//			{
//				$row['addr_1'] = $temp;
//			}
//		}

		//关闭数据库;
		$this->CloseDataBase();
		
		//返回数组;
		return array($row,$image);
	}
	
	//查询订单信息;
	function SelectOrderInfo($_MARRAY)
	{
		$username = $this->GetUserName();
		if($username == null)
		{
			return 'error:尚未登录';
		}
		
		$ex = new Examine();
		$tempArray = array('order_code','min_time','max_time','order_status','page');
		if($ex->ExamineDataArrayIsExists($_MARRAY, $tempArray) == false)
		{
			return 'error:没有关键数据';
		}
		
		$error = null;
		if($error == null)
			$error = $ex->ExamineData("订单生成时间","Date",$_MARRAY['min_time'],1,20, false);
		if($error == null)
			$error = $ex->ExamineData("订单生成时间","Date",$_MARRAY['max_time'],1,20, false);
		if($error == null)
			$error = $ex->ExamineData("订单状态","Int",$_MARRAY['order_status'],1,1, false);
		if($error == null)
			$error = $ex->ExamineData("当前页数","Int",$_MARRAY['page'],1,10, false);
		
		if($error != null)
		{
			return 'error:'.$error;
		}
		
		//连接数据库;
		if($this->ConnectDataBase() == false)
		{
			return "error:数据库连接失败";
		}
		
		//查询供应商编号;
		$sql = "select supplierID from supplier_info where supplierLoginName='".$username."'";
		//开始执行SQL语句;
		if($this->RunSql($sql) <= 0)
		{
			$this->CloseDataBase();
			return "error:没有查询到供应商信息";
		}
		$row = mysql_fetch_assoc($this->query);
		$supplierID = $row['supplierID'];
		
		
		//提取过滤条件;
		$order_code = null;
		$min_time = null;
		$max_time = null;
		$order_status = null;
		$page = null;
		$order_code = $_GET["order_code"];
		$min_time = $_GET["min_time"];
		$max_time = $_GET["max_time"];
		$order_status = $_GET["order_status"];
		$page = $_GET['page'];
		
		//基本查询SQL语句;
		$sql = "select order_code as 订单编号,create_time as 订单生成时间,consignee as 收货人姓名,consignee_phone as 收货人联系电话,post_code as 邮编,address as 收货地址,logistics_code as 物流编号,logistics_name as 物流名称,order_status as 订单状态,freight as 运费 from supplier_order_info";
		$countSql = "select count(*) as 统计 from supplier_order_info";
		
		//拼接过滤条件;
		$condition = "supplierID='".$supplierID."' ";
		if($order_code != null && strlen($order_code) >0)
		{
			if(strlen($condition) >0)
				$condition.=" and ";
			$condition.= "order_code = '".$order_code."'";
		}
		if($min_time != null && strlen($min_time) >0 && $max_time != null && strlen($max_time) >0)
		{
			if(strlen($condition) >0)
				$condition.=" and ";
			if($min_time == $max_time)
			{
				$min_time.= ' 00:00:00';
				$max_time.= ' 23:59:59';
			}
			$condition.= "(UNIX_TIMESTAMP(create_time) >= UNIX_TIMESTAMP('".$min_time."') and UNIX_TIMESTAMP(create_time) <= UNIX_TIMESTAMP('".$max_time . "'))";
		}
		else
		{
			if($min_time != null && $max_time == null)
			{
				return "error:必须输入最大时间";
			}
			else if($max_time != null && $min_time == null)
			{
				return "error:必须输入最小时间";
			}
		}
		if($order_status != null && strlen($order_status) >0)
		{
			if(strlen($condition) >0)
				$condition.=" and ";
			$condition.="order_status='".$order_status."'";
		}
		if(strlen($condition) >0)
		{
			$sql .= " where ".$condition;
			$countSql .= " where ".$condition;
		}
		if(strlen($condition) <= 0)
		{
			return "error:没有任何过滤条件";
		}
		if($page < 0)
			$page = 0;
		//拼接分页SQL语句;
		$sql .= " limit " . $page . ",1";
		//返回结果;
		$res = '';
		//开始执行SQL语句;
		if($this->RunSql($countSql) <= 0)
		{
			$this->CloseDataBase();
			return "error:统计没有查询到结果";
		}
		$row = mysql_fetch_assoc($this->query);
		$res .= '统计:'.$row['统计'];
		
		if($this->RunSql($sql) <= 0)
		{
			$this->CloseDataBase();
			return "error:记录没有查询到结果";
		}
		$row = mysql_fetch_assoc($this->query);
		
		foreach($row as $key=>$value)
		{
			$res .= ';'.$key.':'.$value;
		}
		$res .= ';当前页:'.$page;
		$this->CloseDataBase();
		return $res;
	}
	
	//提交物流信息;
	function UploadLogisticsInfo($_MARRAY)
	{
		$ex = new Examine();
		$tempArray = array('order_code','logistics_name','logistics_code');
		if($ex->ExamineDataArrayIsExists($_MARRAY, $tempArray) == false)
		{
			return 'error:没有关键数据';
		}
		
		$error = null;
		if($error == null)
			$error = $ex->ExamineData("物流名称","C_Len",$_MARRAY['logistics_name'],1,30, false);
		if($error == null)
			$error = $ex->ExamineData("物流订单号","Int",$_MARRAY['logistics_code'],1,30, false);
		
		if($error != null)
		{
			return 'error:'.$error;
		}
		
		
		$sql = "update supplier_order_info set logistics_name='".$_GET['logistics_name']."',logistics_code='".$_GET['logistics_code']."' where order_code ='".$_GET['order_code']."'";
		
		//连接数据库;
		if($this->ConnectDataBase() == false)
		{
			return "数据库连接失败";
		}
		if($this->RunSql($sql) <= 0)
		{
			$this->CloseDataBase();
			return "没有查询到结果";
		}
		$this->CloseDataBase();
		return "提交成功";
	}
	
	//更改物流状态;
	function UploadLogisticsStatus($_MARRAY)
	{
		$ex = new Examine();
		$error = null;
		if($error == null)
			$error = $ex->ExamineData("订单号","Int",$_MARRAY['order_code'],1,30, false);
		if($error == null)
			$error = $ex->ExamineData("物流状态","Int",$_MARRAY['order_status'],1,30, false);
		
		if($error != null)
		{
			return 'error:'.$error;
		}
		
		$value = intval($_MARRAY['order_status']);
		if($value <0 || $value > 4)
		{
			return "订单状态数据有错";
		}
		$sql = "update supplier_order_info set order_status='".$_MARRAY['order_status']."' where order_code ='".$_MARRAY['order_code']."'";
		
		//连接数据库;
		if($this->ConnectDataBase() == false)
		{
			return "error:数据库连接失败";
		}
		if($this->RunSql($sql) <= 0)
		{
			$this->CloseDataBase();
			return "没有查询到结果";
		}
		$this->CloseDataBase();
		return "提交成功";
	}

	//更新供应商银行信息;
	function UploadBankInfo($_MARRAY)
	{
		$username = $this->GetUserName();
		if($username == null)
		{
			return 'error:尚未登录';
		}
		
		$ex = new Examine();
		$tempArray = array('bankAccount','bankAccountName','bankName','bankAddress');
		if($ex->ExamineDataArrayIsExists($_MARRAY, $tempArray) == false)
		{
			return 'error:没有关键数据';
		}
		
		$error = null;
		if($error == null)
			$error = $ex->ExamineData("供应商银行账号","Double",$_MARRAY['bankAccount'],10,30, false);
		if($error == null)
			$error = $ex->ExamineData("供应商银行账户名称","C_Len",$_MARRAY['bankAccountName'],3,8, false);
		if($error == null)
			$error = $ex->ExamineData("供应商开户银行","C_Len",$_MARRAY['bankName'],3,50, false);
		if($error == null)
			$error = $ex->ExamineData("供应商开户银行地址","C_Len",$_MARRAY['bankAddress'],3,50, false);
		
		if($error != null)
		{
			return 'error:'.$error;
		}
		
		//连接数据库;
		if($this->ConnectDataBase() == false)
		{
			return 'error:数据库连接失败';
		}
		
		//创建Sql语句;
		$sql = "update supplier_info set `bankAccount`='".$_MARRAY['bankAccount']."',`bankAccountName`='".$_MARRAY['bankAccountName']."',`bankName`='".$_MARRAY['bankName']."',`bankAddress`='".$_MARRAY['bankAddress']."'";
		$sql .= " where supplierLoginName='".$_SESSION["username"]."'";
		
		//执行Update
		if($this->RunSql($sql) <= 0)
		{
			return "error:更新失败";
		}
		
		$this->CloseDataBase();
		
		return "更新成功";
	}

	//供应商列表;
	function GongYingShangLieBiao()
	{
		$JiBenInfo = array(
		'select'				,'String'		,'0'	,'供应商编号', 		'supplierID',
		'select'				,'String'		,'0'	,'供应商名称',		'supplierName',
		'select'				,'String'		,'0'	,'供应商登录名',	'supplierLoginName',
		'select'				,'String'		,'0'	,'订单联系人',		'businessContactName',
		'select'				,'String'		,'0'	,'订单联系人手机',	'businessContacPhone',
		'CaoZuoRen'				,'String'		,'0'	,'操作人',			'operator',
		'ShenHeRen'				,'String'		,'0'	,'审核人',			'auditor',
		'KeYongZhuangTai'		,'0_or_1'		,'0'	,'可用状态',		'availableStatus',
		'ShenHeZhuangTai'		,'0_or_1'		,'0'	,'审核状态',		'status',
		'addr_1'				,'NULL'			,'0'	,'供应商发货地',	'',
		'addr_2'				,'NULL'			,'0'	,'供应商发货地',	'',
		'addr_3'				,'NULL'			,'0'	,'供应商发货地',	'',
		'ShiFouheZuoXieYi'		,'0_or_1'		,'0'	,'是否签订合作协议','signAgreement'
		);
		
		//拼接过滤字符串;
		$arrayLen = count($JiBenInfo);
		$condition = '';
		$one = true;
		for($i=0;$i<5*5;$i += 5)
		{
			$value = $_GET[$JiBenInfo[$i]];
			if(strlen($value) == 0)
				continue;
			
			$column = $JiBenInfo[$i + 4];
			if(strlen($column) == 0)
				continue;
			
			if($one == false)
				$condition.=' or ';
				
			if($one == true)
				$one = false;
			
			$condition .= '`'.$column."` = '".$value."'";
		}
		if($one == false)
		{
			$condition = '('.$condition.') ';
		}
		
		
		for($i=5*5;$i<$arrayLen;$i += 5)
		{
			$value = $_GET[$JiBenInfo[$i]];
			if(strlen($value) == 0)
				continue;
			
			$column = $JiBenInfo[$i + 4];
			if(strlen($column) == 0)
				continue;
			
			if($one == false)
				$condition.=' and ';
				
			if($one == true)
				$one = false;
			$condition .= '`'.$column."` = '".$value."'";
		}
		$addr_1 = $_GET['addr_1'];
		$addr_2 = $_GET['addr_2'];
		$addr_3 = $_GET['addr_3'];
		if(strlen($addr_1) != 0 &&strlen($addr_2) != 0 &&strlen($addr_3) != 0)
		{
			if($one == false)
			{
				$condition.=' or ';
			}
			$condition .= "`supplierShoppingAddress`='" . $addr_1 . '-' . $addr_2 . '-' .$addr_3."'";
		}
		if($condition !='')
			$condition = 'where '.$condition;
		
		$columnStr = 'supplierID as 供应商编号,supplierName as 供应商名称,supplierLoginName as 供应商登录名,orderContactName as 订单联系人名称,orderContactPhone as 订单联系人手机,orderContactTel as 订单联系人座机号,orderContactQQ as 订单联系人QQ,signAgreement as 是否签定合作协议,alterTime as 修改时间 ,operator as 操作人,auditor as 审核人,status as 审核状态,availableStatus as 可用状态';
		
		
		$sql = "select ".$columnStr." from supplier_info ".$condition;
		$countSql = "select count(*) as 统计 from supplier_info ".$condition;
		
		//连接数据库;
		if($this->ConnectDataBase() == false)
		{
			return 'error:数据库连接失败';
		}
		$page = $_GET['page'];
		//$page = 0;
		if($page < 0)
			$page = 0;
		//返回结果;
		$res = '';
		//拼接分页SQL语句;
		$sql .= " limit " . $page . ",10";
		//开始执行SQL语句;
		if($this->RunSql($countSql) <= 0)
		{
			$this->CloseDataBase();
			return "error:没有查询到结果";
		}
		$row = mysql_fetch_assoc($this->query);
		$res .= $row['统计'];
		$res .= ';'.$page;
		
		$rowCount = $this->RunSql($sql);
		if($rowCount <= 0)
		{
			$this->CloseDataBase();
			return "error:没有查询到结果";
		}
		$res .= ';'.$rowCount;
		
		//替换字典;
		include_once('../Base/Dic.php');
		$dic = new Dic();
		
		while($row = mysql_fetch_assoc($this->query))
		{
			$row['是否签定合作协议'] = $dic->IntValueGetName('是否签定合作协议',intval($row['是否签定合作协议']));
			$row['可用状态'] = $dic->IntValueGetName('可用状态',intval($row['可用状态']));
			$row['审核状态'] = $dic->IntValueGetName('审核状态',intval($row['审核状态']));
			foreach($row as $key=>$value)
			{
				$res .= ';'.$value;
			}
		}
		
		$this->CloseDataBase();
		return $res ;
	}

	//获取订单商品;
	function GetDingDanShangPin($_MARRAY)
	{
		$ex = new Examine();
		$tempArray = array('order_code');
		if($ex->ExamineDataArrayIsExists($_MARRAY, $tempArray) == false)
		{
			return 'error:没有关键数据';
		}
		$error = null;
		if($error == null)
			$error = $ex->ExamineData("订单号","Int",$_MARRAY['order_code'],1,30, false);
		if($error != null)
		{
			return 'error:'.$error;
		}
		
		
		//连接数据库;
		if($this->ConnectDataBase() == false)
		{
			return 'error:数据库连接失败';
		}
		
		//创建Sql语句;
		$sql = "select (select commodityName from commodity_info where a.commodityID = commodityID ) as commodityName, a.* from supplier_order_commodity as a where a.order_code='".$_MARRAY['order_code']."'";
		
		//执行Update
		$rownum = $this->RunSql($sql);
		$this->CloseDataBase();
		if($rownum < 0)
		{
			return "error:查询失败";
		}
		
		$res = "row:".$rownum;
		while($row = mysql_fetch_assoc($this->query))
		{
			foreach($row as $key=>$value)
			{
				$res .= ';'.$key.':'.$value;
			}
		}
		
		
		return $res;
	}
}
?>
