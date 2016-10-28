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
<style>

</style>
<body>

<?php
header("Content-Type: text/html; charset=utf-8");
include_once("GongYingShang_RBC.php");
$gys = new GongYingShang_RBC();
$s = !empty($_POST);
if($s == true)
{
	$array = $gys->SelectSupplier($_POST['username']);
}
else $array = $gys->SelectSupplier();
if(is_array($array) == false)
{
	$gys->ShowError($array);
	exit;
}
$res = $array[0];
$image = $array[1];
//$ShengChanShangName = explode(';',$res["ShengChanShangName"]);//生产商名称;

include_once("MainPageHtml.php");
CreateLeftAndTopHtml();
?>
<div >
    <table>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
  <p>供应商编号:</p>

      <input  class="k102-input" id = "Id" name ="Id" type="text" value=""/>
       <p>供应商名称:</p>

          <input  class="k105-input" id ="Name" name ="Name" type="text" value=""/>
       <p>供应商登陆名:</p>
          <input  class="k108-input" id ="AccountUumber" name ="AccountUumber" type="text" value=""/>
       <p>供应商发货地:</p>
          <input id="addr_1" class="k114-select" type = "text" name = "addr_1" />
         <p>供应商详细地址:</p>
            <textarea class="k119-textarea" id="addr_4" name="addr_4" cols="25" rows="10"></textarea>
       <p>生产商名称:</p>
              <input id="ShengChanShangName" class="k114-select" type = "text" name = "ShengChanShangName" />
         <p>业务联系人名称:</p>
          <input  class="k126-input" type="text" id="YeWuRen_Name" name = "YeWuRen_Name" value=""/>
        <p>业务联系人手机:</p>
          <input  class="k129-input" type="text" id ="YeWuRen_Phone" name ="YeWuRen_Phone" value=""/>
        <p>订单联系人名称:</p>
          <input  class="k132-input" type="text" id ="DingDanRen_Name" name ="DingDanRen_Name" value=""/>
       <p>订单联系人手机:</p>
          <input  class="k135-input" type="text" id ="DingDanRen_Phone" name ="DingDanRen_Phone" value=""/>
       <p>订单联系人座机:</p>
          <input  class="k138-input" type="text" id ="DingDanRen_ZuoJI" value=""/>
       <p>订单联系人QQ:</p>
          <input  class="k144-input" type="text" id ="QQ" name = "QQ" value=""/>
       <p>订单联系人邮箱:</p>
          <input  class="k147-input" type="text" id ="YouXiang" name = "YouXiang" value=""/>
       <p>是否签定合作协议:</p>
                <input type = "text" id = "ShiFouHeZuo" value = ""/>
          <p>是否签定合作协议:</p> <p>供应商银行账号:</p>
          <input  class="k147-input" type="text" id = "bankAccount" name = "bankAccount" value=""/>
       <p>供应商银行账户名称:</p>
          <input  class="k147-input" type="text" id = "bankAccountName" name = "bankAccountName" value=""/>
       <p>供应商开户银行:</p>
          <input  class="k147-input" type="text" id = "bankName" name = "bankName" value=""/>
     <p>供应商开户银行地址:</p>
          <input  class="k147-input" type="text" id = "bankAddress" name = "bankAddress" value=""/>
       <p>结款日:</p><span>每月</span><input type="text" style="display:inline" id = "JieKuanRi" name = "JieKuanRi" /><span>为结款日</span>
  </div>
  
<script src="JavaScript/jquery.js"></script> 
<script type="text/javascript"  language="javascript" >

AJAX_CallBack = function (data)
{
	alert(data);
}
submitButtonClick = function()
{
	var curWwwPath=window.document.location.href;
	var pathName=window.document.location.pathname;
	var pos=curWwwPath.indexOf(pathName);
	var localhostPaht=curWwwPath.substring(0,pos);
	var SubtimUrl = localhostPaht;
	
	$.ajax({
			url: SubtimUrl + "/gongyingshang/Service.php",
			type: 'post',
			data: $('#form').serializeArray(),
			success: AJAX_CallBack
		});
}

$(function(){
<?php
echo "var e = null;\r\n";
foreach($res as $key=>$value)
{
	echo "e = document.getElementById('".$key."');\r\n";
	echo "if(e != null)";
		echo "{e.value ='".$value."';\r\n e.setAttribute('disabled','disabled');}";

}
?>
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

</body>
</html>
