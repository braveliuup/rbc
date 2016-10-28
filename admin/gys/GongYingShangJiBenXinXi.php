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
<div class="right">

  <div class="Supplier-basic-information" >
    <div class="Supplier-basic-information-1">
      <div class="k100">
        <div class="k101">
          <div class="oo"><p>供应商编号:</p></div>
        </div>
        <div class="k102">
          <input  class="k102-input" id = "Id" name ="Id" type="text" value=""/>
        </div>
      </div>
      </div>
      
      <div class="Supplier-basic-information-2">
      <div class="k103">
        <div class="k104">
          <div class="oo"><p>供应商名称:</p></div>
        </div>
        <div class="k105">
          <input  class="k105-input" id ="Name" name ="Name" type="text" value=""/>
        </div>
      </div>
      </div>
       <div class="Supplier-basic-information-3">
      <div class="k106">
        <div class="k107">
         <div class="oo"> <p>供应商登陆名:</p></div>
        </div>
        <div class="k108">
          <input  class="k108-input" id ="AccountUumber" name ="AccountUumber" type="text" value=""/>
        </div>
      </div>
      </div>
       <div class="Supplier-basic-information-5">
      <div class="k112">
        <div class="k113">
         <div class="oo"> <p>供应商发货地:</p></div>
        </div>
        <div class="k114">
          <input id="addr_1" class="k114-select" type = "text" name = "addr_1" />
        </div>
      </div>
      </div>
      
       <div class="Supplier-basic-information-6">
        <div class="k117">
          <div class="k118">
          <div class="oo">  <p>供应商详细地址:</p></div>
          </div>
          <div class="k119">
            <textarea class="k119-textarea" id="addr_4" name="addr_4" cols="25" rows="10"></textarea>
          </div>
        </div>
        </div>
      
       <div class="Supplier-basic-information-7">
      <div class="k120">
        <div class="k121">
         <div class="oo"> <p>生产商名称:</p></div>
        </div>
          <div class="k114">
              <input id="ShengChanShangName" class="k114-select" type = "text" name = "ShengChanShangName" />
          </div>
        </div>
      </div>
      </div>
       <div class="Supplier-basic-information-8">
      <div class="k124">
        <div class="k125">
          <div class="oo"><p>业务联系人名称:</p></div>
        </div>
        <div class="k126">
          <input  class="k126-input" type="text" id="YeWuRen_Name" name = "YeWuRen_Name" value=""/>
        </div>
      </div>
      </div>
      
       <div class="Supplier-basic-information-9">
      <div class="k127">
        <div class="k128">
        <div class="oo">  <p>业务联系人手机:</p></div>
        </div>
        <div class="k129">
          <input  class="k129-input" type="text" id ="YeWuRen_Phone" name ="YeWuRen_Phone" value=""/>
        </div>
      </div>
      </div>
      
     <div class="Supplier-basic-information-10">
      <div class="k130">
        <div class="k121">
         <div class="oo"> <p>订单联系人名称:</p></div>
        </div>
        <div class="k132">
          <input  class="k132-input" type="text" id ="DingDanRen_Name" name ="DingDanRen_Name" value=""/>
        </div>
      </div>
      </div>

      <div class="Supplier-basic-information-11">
      <div class="k133">
        <div class="k134">
         <div class="oo"> <p>订单联系人手机:</p></div>
        </div>
        <div class="k135">
          <input  class="k135-input" type="text" id ="DingDanRen_Phone" name ="DingDanRen_Phone" value=""/>
        </div>
      </div>
      </div>
      
      <div class="Supplier-basic-information-12">
      <div class="k136">
        <div class="k137">
         <div class="oo"> <p>订单联系人座机:</p></div>
        </div>
        <div class="k138">
          <input  class="k138-input" type="text" id ="DingDanRen_ZuoJI" value=""/>
        </div>
      </div>
      </div>

       <div class="Supplier-basic-information-13">
      <div class="k142">
        <div class="k143">
          <div class="oo"><p>订单联系人QQ:</p></div>
        </div>
        <div class="k144">
          <input  class="k144-input" type="text" id ="QQ" name = "QQ" value=""/>
        </div>
      </div>
      </div>

       <div class="Supplier-basic-information-14">
      <div class="k145">
        <div class="k146">
         <div class="oo"> <p>订单联系人邮箱:</p></div>
        </div>
        <div class="k147">
          <input  class="k147-input" type="text" id ="YouXiang" name = "YouXiang" value=""/>
        </div>
      </div>
      </div>
      
      
       <div class="Supplier-basic-information-15">
      <div class="k148">
        <div class="k149">
         <div class="oo"> <p>是否签定合作协议:</p></div>
        </div>
        <div class="k150"><input type = "text" id = "ShiFouHeZuo" value = ""/>
      </div>
      </div>
      </div>
      
        <div class="Supplier-basic-information-16">
	<table >
		<tr>
			<td width='100'>
				<p>合作协议:</p>
			</td>
		</tr>
		<tr>
			<?php
				if( (is_array($image) && count($image)>0))
				{
					$ImageNumber = count($image);
					$i = 0;
					while($i < $ImageNumber)
					{
						if($image[$i]['类型'] == '2')
						{
							echo "<td width='100' height='100'>";
							echo "<image src='".$image[$i]['数据']."' width='100%' height='100%'></image>\r\n";
							echo "</td>";
							break;
						}
						$i++;
					}
				}
			?>
		</tr>
		<tr>
			<td width='100'>
				<p>企业资质:</p>
			</td>
		</tr>
		<tr>
			<?php
				$dtcount = 0;
				$nowIndex = 0;
				if( (is_array($image) && count($image)>0))
				{
					$ImageNumber = count($image);
					$i = 0;
					while($i < $ImageNumber)
					{
						if($image[$i]['类型'] == '1')
						{
							echo "<td  width='100' height='100'>";
							echo "<image src='".$image[$i]['数据']."' width='100%' height='100%'></image>\r\n";
							echo "</td>";
							$dtcount++;
							if($dtcount == 5)
							{
								$nowIndex = $i + 1;
								break;
							}
						}
						$i++;
						$nowIndex = $i;
					}
				}
			?>
		</tr>
		<tr>
			<?php
				if( (is_array($image) && count($image)>0))
				{
					$ImageNumber = count($image);
					$i = $nowIndex;
					while($i < $ImageNumber)
					{
						if($image[$i]['类型'] == '1')
						{
							echo "<td  width='100' height='100'>";
							echo "<image src='".$image[$i]['数据']."' width='100%' height='100%'></image>\r\n";
							echo "</td>";
							$dtcount++;
						}
						$i++;
						if($dtcount > 10)
							break;
					}
					
				}
			?>
		</tr>
	</table>
		  
      </div>
      
         <form id = "form">
		 <input style="display:none" type="text" name ='form' value="供应商提交银行信息"></input>
       <div class="Supplier-basic-information-14">
      <div class="k145">
        <div class="k146">
         <div class="oo"> <p>供应商银行账号:</p></div>
        </div>
        <div class="k147">
          <input  class="k147-input" type="text" id = "bankAccount" name = "bankAccount" value=""/>
        </div>
      </div>
      </div>
      
       <div class="Supplier-basic-information-14">
      <div class="k145">
        <div class="k146">
         <div class="oo"> <p>供应商银行账户名称:</p></div>
        </div>
        <div class="k147">
          <input  class="k147-input" type="text" id = "bankAccountName" name = "bankAccountName" value=""/>
        </div>
      
      </div>
      </div>
       <div class="Supplier-basic-information-14">
      <div class="k145">
        <div class="k146">
         <div class="oo"> <p>供应商开户银行:</p></div>
        </div>
        <div class="k147">
          <input  class="k147-input" type="text" id = "bankName" name = "bankName" value=""/>
        </div>
      </div>
      </div>
      
      <div class="Supplier-basic-information-14">
      <div class="k145">
        <div class="k146">
         <div class="oo"> <p>供应商开户银行地址:</p></div>
        </div>
        <div class="k147">
          <input  class="k147-input" type="text" id = "bankAddress" name = "bankAddress" value=""/>
        </div>
      </div>
      </div>
         </form>
      
      
      
      <div  style="width:800px; height:1px; background-color:#000; margin-top:30px; margin-bottom:30px"></div>
      
     
    
       <div class="Supplier-basic-information-19">
      <div class="k167">
        <div class="k168">
          <div class="oo"><p>结款日:</p></div>
        </div>
        <div class="k174">
        <div ><span>每月</span><input type="text" style="display:inline" id = "JieKuanRi" name = "JieKuanRi" /><span>为结款日</span></div>
      </div>
      
      </div>
      </div> 
      
       <div  class="Supplier-basic-information-20">
    </div>
  </div>
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
