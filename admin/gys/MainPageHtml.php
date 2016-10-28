<?php
ob_start(); 
header("Content-Type:text/html;charset=utf-8");		
include_once('Base/RBC.php');
	function CreateLeftAndTopHtml()
	{
		$rbc = new RBC();
		$userName = $rbc->GetUserName();
		if($userName === null)
		{
			echo '没有登录';
			exit(0);
		}
			echo "<div class='top'>";
			echo "<div class='top-right'>";
			echo "<div class='logo'><img src='images/logo.png' /></div>";
			echo "<div class='text1'>你好,".$userName."<a href='login.php?exit=1'>退出系统</a></div>";
			echo "</div>";
			echo "</div>";
		
		echo "<div class='left'>";
		  echo "<div style='height:6px;'><img src='images/1.png' width='202px' /></div>";
		  echo "<div class='container'>";
			echo "<div class='leftsidebar_box'>";
			   {
				  echo "<dl class='form'>";
				  echo "<dt><a href='GongYingShangJiBenXinXi.php'>基本信息</a></dt>";
				  echo "</dl>";
			   }
			   {
				  echo "<dl class='System-Settings'>";
				  echo "<dt><a href='DingDanXiangQing.php'>订单信息</a></dt>";
				  echo "</dl>";
			   }
			   {
				  echo "<dl class='Template'>";
				  echo "<dt><a href='CaiWuBaoBiao.php'>财务报表</a></dt>";
				  echo "</dl>";
			   }
			   {
				  echo "<dl class='Website-database'>";
				  echo "<dt><a href='ZhanNeiXin.php'>站内信</a></dt>";
				  echo "</dl>";
			   }
			   {
				  echo "<dl class='change-password'>";
				  echo "<dt><a href='XiuGaiMiMa.php'>修改密码</a></dt>";
				  echo "</dl>";
			   }
			echo "</div>";
		  echo "</div>";
		echo "</div>";
		OB_START();
	}
?>