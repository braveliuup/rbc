<?php

class Dic
{
	function IdToArea($db, $province, $city, $area)
	{
		$res = '';
		$sql = "select `province` as `省` from ad_province where `provinceID`='".$province."'";
		if($db->RunSql($sql) > 0)
		{
			$row = mysql_fetch_assoc ($db->query);
			$res .= $row['省'];
		}
		else return false;
		$sql = "select `city` as `市` from ad_city where `cityID`='".$city."'";
		if($db->RunSql($sql) > 0)
		{
			$row = mysql_fetch_assoc ($db->query);
			$res .= '-'.$row['市'];
		}
		else return false;
		$sql = "select `area` as `区` from ad_area where `areaID`='".$area."'";
		if($db->RunSql($sql) > 0)
		{
			$row = mysql_fetch_assoc ($db->query);
			$res .= '-'.$row['区'];
		}
		else return false;
		
		return $res;
	}
	
	function IntValueGetName($column, $value)
	{
		switch($column)
		{
			case '是否签定合作协议':
				if($value == 1)
					return "是";
				else if($value == 0)
					return "否";
				break;
			case '结款日':
				if($value < 100)
				{
					if($value == 1)
						return "每月最后1号为结款日";
					else if($value == 2)
						return "每月1-5号为结款日";
					else if($value == 3)
						return "16号到最后一天为结款日";
				}
				else if($value >= 100)
				{
					$value = $value - 100;
					return "每月".$value."号为结款日";
				}
			break;
		case '可用状态':
			if($value == 1)
				return "可用";
			else if($value == 0)
				return "不可用";
			break;
		case '审核状态':
			if($value == 1)
				return "审核通过";
			else if($value == 0)
				return "未审核";
			break;
			default:
				return "错误的字典值";
		}
		
		return "";
	}
}

?>