<?php
ob_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>红细胞</title>
<link rel="stylesheet" type="text/css" href="Content/style-gongying.css" />
</head>


<body>
<?php
header("Content-Type: text/html; charset=utf-8");
include_once("MainPageHtml.php");
CreateLeftAndTopHtml();
?>
</body>

</html>

<script src="JavaScript/jquery.js"></script> 
<script type="text/javascript"  language="javascript" >
$(function(){
	$(".leftsidebar_box dt").css({"background-color":"#34485b"});
	$(".leftsidebar_box dt img").attr("src","images/select_xl01.png");
	$(".leftsidebar_box dd").hide();
	$(".leftsidebar_box dt").click(function(){
		$(".leftsidebar_box dt").css({"background-color":"#34485b"})
		$(this).css({"background-color": "#34485b"});
		$(this).parent().find('dd').removeClass("menu_chioce");
		$(".leftsidebar_box dt img").attr("src","images/select_xl01.png");
		$(this).parent().find('img').attr("src","images/select_xl.png");
		$(".menu_chioce").slideUp(); 
		$(this).parent().find('dd').slideToggle();
		$(this).parent().find('dd').addClass("menu_chioce");
	});
})
</script>