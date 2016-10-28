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
<div class="right">
  <div class="Stand-inside-letter" >

      <div class="Stand-inside-letter-1" >
       <div class="k600"><a href=""><p>未读消息</p></a></div>
       <div class="k600"><a href=""><p>已读消息</p></a></div>
    </div>
    <div class="Stand-inside-letter-2" >
<div class="k601"><div class="k602"><div class="oo"><p>系统消息:</p></div></div><div class="k603"><a href=""><p>系统消息系统消息系统消息系统消息系统消息</p></a></div></div>
<div class="k601"><div class="k602"><div class="oo"><p>招商信息:</p></div></div><div class="k603"><a href=""><p>系统消息系统消息系统消息系统消息系统消息</p></a></div></div>
<div class="k601"><div class="k602"><div class="oo"><p>活动信息:</p></div></div><div class="k603"><a href=""><p>系统消息系统消息系统消息系统消息系统消息</p></a></div></div>
<div class="k601"><div class="k602"><div class="oo"><p>系统消息:</p></div></div><div class="k603"><a href=""><p>系统消息系统消息系统消息系统消息系统消息</p></a></div></div>
<div class="k601"><div class="k602"><div class="oo"><p>系统消息:</p></div></div><div class="k603"><a href=""><p>系统消息系统消息系统消息系统消息系统消息</p></a></div></div>
<div class="k601"><div class="k602"><div class="oo"><p>招商信息:</p></div></div><div class="k603"><a href=""><p>系统消息系统消息系统消息系统消息系统消息</p></a></div></div>
<div class="k601"><div class="k602"><div class="oo"><p>活动信息:</p></div></div><div class="k603"><a href=""><p>系统消息系统消息系统消息系统消息系统消息</p></a></div></div>
<div class="k601"><div class="k602"><div class="oo"><p>系统消息:</p></div></div><div class="k603"><a href=""><p>系统消息系统消息系统消息系统消息系统消息</p></a></div></div>
<div class="k601"><div class="k602"><div class="oo"><p>活动信息:</p></div></div><div class="k603"><a href=""><p>系统消息系统消息系统消息系统消息系统消息</p></a></div></div>
<div class="k601"><div class="k602"><div class="oo"><p>系统消息:</p></div></div><div class="k603"><a href=""><p>系统消息系统消息系统消息系统消息系统消息</p></a></div></div>
    </div>
    
    
    <div class="pages">
      <div class="page-text">
        <p>首页&nbsp;&nbsp; 上一页&lt;&lt;当前第1页&gt;&gt;下一页&nbsp;&nbsp; 尾页</p>
      </div>
      <div class="page-number">
        <input  class="page-input" type="text" value="2"/>
      </div>
      <div  class="pagination">
        <p>跳转&nbsp; 共1条记录</p>
      </div>
    </div>
    
     
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
 
    
  </div>
</div>
</body>
</html>
