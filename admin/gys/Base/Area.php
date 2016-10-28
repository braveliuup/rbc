<?php
header("Content-Type: text/html; charset=utf-8");
include_once("DB.php");

class Area
{
	//获取省数据;
	function GetProvince()
	{
		$db = new DB();
		if($db->ConnectDataBase() != true)
		{
			return 'error:数据库连接失败';
		}
		$sql = "select provinceID, province from ad_province";
		
		if($db->RunSql($sql) == -1)
		{
			$db->CloseDataBase();
			return 'error:没有查询到数据';
		} 
		$html = "";
		while ($Row = mysql_fetch_assoc ($db->query)) 
		{
			$html .= "<option value='".$Row['provinceID']."'>".$Row['province']."</option>";
		}
		$db->CloseDataBase();
		
		ob_clean();
		return $html;
	}

	//根据省ID获取市数据;
	function GetCity($id)
	{
		$db = new DB();
		if($db->ConnectDataBase() != true)
		{
			return null;
		}
		$sql = "select cityID, city from ad_city where father='".$id."'";
		
		if($db->RunSql($sql) == -1)
		{
			$db->CloseDataBase();
			return null;
		} 
		$html = "<option value =''>请选择</option>";
		while ($Row = mysql_fetch_assoc ($db->query)) 
		{
			$html .= "<option value='".$Row['cityID']."'>".$Row['city']."</option>";
		}
		$db->CloseDataBase();
		
		ob_clean();
		return $html;
	}

	//根据市数据获取区数据;
	function GetArea($id)
	{
		$db = new DB();
		if($db->ConnectDataBase() != true)
		{
			return null;
		}
		$sql = "select areaID, area from ad_area where father='".$id."'";
		
		if($db->RunSql($sql) == -1)
		{
			$db->CloseDataBase();
			return null;
		} 
		$html = "<option value =''>请选择</option>";
		while ($Row = mysql_fetch_assoc ($db->query)) 
		{
			$html .= "<option value='".$Row['areaID']."'>".$Row['area']."</option>";
		}
		$db->CloseDataBase();
		
		ob_clean();
		return $html;
	}
}
if( (is_array($_GET) && count($_GET)>0))
{
	if(isset($_GET["City"]) and isset($_GET["City"]))
	{
		$id = $_GET["City"];
		$thisar = new Area();
		echo $thisar->GetArea($id);
	}
	else if(isset($_GET["Province"]) and isset($_GET["Province"]))
	{
		$id = $_GET["Province"];
		$thisar = new Area();
		echo $thisar->GetCity($id);
	}
}
?>