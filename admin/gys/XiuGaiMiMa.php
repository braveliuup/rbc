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
  <div class="change-password_1" >
    
<div class="change-password_1-2">
      <div class="k504">
        <div class="k505">
          <div class="oo">
            <p> 请输入旧密码：</p>
          </div>
        </div>
        <div class="k506">
          <input  class="k506-input" type="password" value=""/>
        </div>
     
         <div class="k508">
        <p>*错误提示:您填写的旧密码不正确</p>
        </div>
      </div>
    </div>


    
<div class="change-password_1-2">
      <div class="k504">
        <div class="k505">
          <div class="oo">
            <p> 请输入新密码：</p>
          </div>
        </div>
        <div class="k506">
          <input  class="k506-input" type="password" value=""/>
        </div>
     
         <div class="k508">
        <p>*设置不符合要求，请重新设置</p>
        </div>
      </div>
    </div>


    
<div class="change-password_1-2">
      <div class="k504">
        <div class="k505">
          <div class="oo">
            <p> 请输入旧密码：</p>
          </div>
        </div>
        <div class="k506">
          <input  class="k506-input" type="password" value=""/>
        </div>
     
         <div class="k508">
        <p>*两次输入的密码不一致</p>
        </div>
      </div>
    </div>
   
      <div class="change-password_2-3" >
 
            <div class="k509">
       
     <div class="k510"><input class="k510-input" name="" type="button" value="提交" /></div>
     <div class="k510" ><input class="k510-input" name="" type="button" value="重置" /></div>
   
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
