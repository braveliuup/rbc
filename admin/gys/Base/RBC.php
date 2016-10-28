<?php
OB_START();
header("Content-Type: text/html; charset=utf-8");
include_once('db.php');
include_once('Examine.php');
class RBC extends DB
{
	//弹窗显示错误信息;
	public function ShowError($ErrorInfo)
	{
		echo "<script language='javascript'>"; 
		echo "alert('".$ErrorInfo."');";
		echo "</script>";
	}
	
	//跳转到页面;
	public function PageGoTo($Page)
	{
		echo "<script language='javascript'>"; 
		echo "location='".$Page."';"; 			
		echo "</script>";
	}
	
	//登录;
	function Login($AccountUumber,$Password)
	{
		if($this->ConnectDataBase() == false)	//连接RBC数据库;
		{
			return "数据库连接失败";
		} 
		$sql = "select * from rbc_supplier as t where t.supplierLoginName ='".$AccountUumber."' and t.`supplierLoginPassword` = '".$Password."'";
		
		if($this->RunSql($sql) == -1)
		{
			return '查询失败';
		} 
		
		$num_rows = mysql_num_rows($this->query);	//获取结果行数;
		
		if($num_rows != 1)
		{
			return "账号或密码错误";
		}
		
		$row = mysql_fetch_assoc($this->query);
//		$role = $row['Role'];
//		$sql = "select * from tbl_role where id ='".$role."'";
//
//		if($this->RunSql($sql) == -1)
//		{
//			$this->CloseDataBase();
//			return '查询失败';
//		}
		
		if(!session_id())
			session_start();
		
		if(isset($_SESSION["username"]) == true)
		{
			$this->CloseDataBase();
			return "已经登录了!";
		}
		$_SESSION['username']=$AccountUumber;
//		$_SESSION['role']=$role;
//		$num_rows = mysql_num_rows($this->query);	//获取结果行数;
//		if($num_rows === 1)
//		{
//			$row = mysql_fetch_assoc($this->query);
//			$arr = array();
//			$arr = explode(',',$row['Modules']);
//			$_SESSION['module']=$arr;
//		}
		
		$this->CloseDataBase();
		return true;
	}
	
	//退出账户;
	public function cancel()
	{
		if(!session_id())
			session_start();
		$_SESSION = array();
	}
	
	//用户是否已经登录了;
	public function User_HasLoggedIn()
	{
		if(!session_id())
			session_start();
		return isset($_SESSION["username"]);//是否设置了usernmae，true == 已经登录了;
	}
	
	//获取用户名;
	public function GetUserName()
	{
		if(!session_id())
			session_start();
		if($this->User_HasLoggedIn() == true)
		{
			return $_SESSION["username"];
		}
		else return null;
	}
	
	//获取用户权限
	public function GetUserRole()
	{
		if(!session_id())
			session_start();
		if(isset($_SESSION["role"]) == false)	//是否设置了角色;
			return null;
		return $_SESSION['role'];
	}
}
ob_end_flush();
?>
