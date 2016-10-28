<?php
header("Content-Type: text/html; charset=utf-8");
if(!session_id())
	session_start();
if( (is_array($_GET) && count($_GET)>0))
{
	if(isset($_GET["exit"]) and isset($_GET["exit"]))	//是否点击了退出;
	{
		$_SESSION = array();	//清空SESSION;
	}
}

if(isset($_SESSION["username"]) == true)	//是否设置了usernmae，true == 已经登录了;
{
	header("Location:main.php");
	ob_end_flush();
	exit();
}
$AccountUumber = "";	
$Password = "";
if( (is_array($_GET) && count($_GET)>0))	//是否有GET参数;
{
	if(isset($_GET["id_AccountUumber"]) and isset($_GET["pawd_Password"]))//参数中是否包含账户密码;
	{ 
		$AccountUumber = $_GET["id_AccountUumber"];		//账号;
		$Password = $_GET["pawd_Password"];				//密码;
		include_once('Base/Examine.php'); 			//验证工具;
		$ex = new Examine();		
		if(is_string($Error) == true)	//如果数据校验有错误弹窗提示;
		{
			$ex->ShowError($Error);
			ob_end_flush();
			exit();
		}
		else 
		{
			include_once('Base/RBC.php');
			$mysql = new RBC();
			$error = null;
			$error = $mysql->Login($AccountUumber,$Password);	//用户登录;
			if(is_string($error) == true)
			{
				$mysql->ShowError($error);
			}
			else 
			{	
				header('Location:main.php');
				exit();
			}
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<link rel="stylesheet" type="text/css" href="Content/style.css" />
</head>

<script language="javascript">
	function SubmitForm()
	{
		document.getElementById("login").submit();
	}
</script>

<body>
    <form id="login" method = 'get'  action = 'Login.php'>
		<div style="width:100%;text-align: center;margin-top:10%;">
			<h1>红细胞供应商后台登录</h1>
			<div>账户<input name="id_AccountUumber" type="text" value=<?php echo "'".$AccountUumber."'";?> /></div>
			<br>
			<div>密码<input name= "pawd_Password" type="password" value=<?php echo "'".$Password."'";?> /></div>
			<br>
			<input type="button" value = "登录" onclick="SubmitForm()" />
		</div>
	</form>

</body>
</html>
