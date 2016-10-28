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
  <div class="order-information" >
  
	<form id = "SubmitSelectForm" method="get" action="Service2.php">
    <div class="order-information-1" >
      <div class="k200">
        <div class="oo">
          <p>订单编号：</p>
        </div>
      </div>
      <div class="k201">
        <input class="k201-input" id="order_code" name="order_code" type="text" value=""/>
      </div>
    </div>
    <div class="order-information-1" >
      <div class="k200">
        <div class="oo">
          <p>订单日期：</p>
        </div>
      </div>
      <div class="k203">
        <p>从</p>
      </div>
      <div class="k202">
        <input id="min_time" name="min_time" type="date" value="时间控件"/>
      </div>
      <div class="k203">
        <p>到</p>
      </div>
      <div class="k202">
        <input id="max_time" name="max_time" type="date" value="时间控件"/>
      </div>
      <div class="k204">
        <input class="k204-input"  name="" type="button" value="查询" onclick="gys.SelectOrderInfo('SubmitSelectForm',SelectOrdefInfo_CallBack);"/>
      </div>
    </div>
    <div class="order-information-2" >
      <input style="float:left" checked="true" name="order_status" type="radio" value="0"/><p style="float:left" >未发货订单</p>
	  <input style="float:left" name="order_status" type="radio" value="1"/><p style="float:left" >已发货订单</p>
	  <input style="float:left" name="order_status" type="radio" value="2"/><p style="float:left" >未结算订单</p>
	  <input style="float:left" name="order_status" type="radio" value="3"/><p style="float:left" >已结算订单</p>
    </div>
	</form>
    <div class="order-information-3" >
      <div class="order-information-table">
	  
        <table id = "showdata" width="940" border="0" cellspacing="0" cellpadding="0">
          
		</table>
		
	<form id = "SubmitLogisticsInfoForm" method="post" action="Service3.php">
         <div class="order-information-4">
       <div class="k211">
       <div class="k212"><div class="oo"><p>物流名称:</p></div></div>
       <div class="k213">
       <select class="k213-select" id ="logistics_name" name="logistics_name">
          <option value="">请选择</option>
          <option value="申通">申通</option>
          <option value="圆通">圆通</option>
        </select></div>
       </div>
       <div class="k211">
       <div class="k212"><div class="oo"><p>物流订单号:</p></div></div>
       <div class="k214"> <input class="k214-input" id="logistics_code" name="logistics_code" type="text" value=""/>
       </div>
       </div>
       <div class="k211">
		<div class="k215"><input class="k215-input"  name="" type="button" value="提交" onclick= "gys.UploadLogisticsInfo('SubmitLogisticsInfoForm');"/></div>
        <div class="k215"><input class="k215-input"  name="" type="button" value="取消"/></div>
       </div>
       </div>
		</form>
      </div>
     
    </div>
    
    
    
    
    
    <div class="pages">
      <div class="page-text">
        <input type="button" value='上一页' onclick="gys.SelectOrderInfo_LastPage();" />
		<input type="button" value='下一页' onclick="gys.SelectOrderInfo_NextPage();" />
		<input id ="NowPageNumber" style="width:30px" type="text" value='1' oninput="gys.OrderInfo_NowPageControlValueChange(this);"/>
        <p id ="CountPage">共0条记录</p>
      </div>
    </div>
    
      
<script src="JavaScript/jquery.js"></script> 
<script src='GYS_DingDanXiangQing.js' type='text/javascript' ></script>
<script type="text/javascript"  language="javascript" >

var gys = new GYS_DingDanXiangQing.createNew();
SelectOrderCommodityInfo_CallBack = function(data,row)
{
	var tab = document.getElementById("showdata");
	if(!row)
		row = '0';
	document.getElementById("all_count").innerHTML="数量合计:" + row;
	
	var all_Cost = 0;
	if(data)
	{
		tab.innerHTML += "<tr><td class=\"k206\"><p>商品编号</p></td><td class=\"k206\"><p>商品名称</p></td><td class=\"k206\"><p>规格</p></td><td class=\"k206\"><p>进货单价</p></td><td class=\"k206\"><p>数量</p></td><td class=\"k206\"><p>小计</p></td></tr>";
		for(var i=0;i<row;i++)
		{
			var n = "<tr>";
			n += "<td class=\"k207\" ><div class=\"k208\"><p>"+ data[i]['order_code'] + "</p></div></td>";
			n += "<td class=\"k207\" ><div class=\"k208\"><p>"+ data[i]['commodityName'] + "</p></div></td>";
			n += "<td class=\"k207\" ><div class=\"k208\"><p>"+ data[i]['specification'] + "</p></div></td>";
			n += "<td class=\"k207\" ><div class=\"k208\"><p>"+ data[i]['UnitPrice'] + "</p></div></td>";
			n += "<td class=\"k207\" ><div class=\"k208\"><p>"+ data[i]['quantity'] + "</p></div></td>";
			n += "<td class=\"k207\" ><div class=\"k208\"><p>"+ data[i]['Cost'] + "</p></div></td>";
			tab.innerHTML += n;
			all_Cost += parseInt(data[i]['Cost']);
		}
		tab.innerHTML += "</tr>";
	}
	document.getElementById("all_Cost").innerHTML = "订单总价:" + all_Cost;
}
SelectOrdefInfo_CallBack = function(data)
{
	var tab = document.getElementById("showdata");
	tab.innerHTML = "<tr><td class=\"k209\"><div class=\"k210\"><p id=\"order_code_res\">订单号:<br /></p></div></td><td class=\"k209\"><div class=\"k210\"><p id =\"create_time_res\">订单生成时间:</p></div></td><td class=\"k209\"><div class=\"k210\"><p id=\"consignee_res\">收货人姓名:</p></div></td><td class=\"k209\"><div class=\"k210\"><p id =\"consignee_phone_res\">收货人联系电话:</p></div></td><td class=\"k209\"><div class=\"k210\"><p id =\"post_code_res\">邮编:</p></div></td><td class=\"k209\"><div class=\"k210\"><p id =\"address_res\">收货地址:</p></div></td><td class=\"k209\"><div class=\"k210\"><p id=\"all_count\">数量合计</p></div></td><td class=\"k209\"><div class=\"k210\"><p id=\"all_Cost\">订单合计金额： </p></div><div class=\"k210\"><p id=\"freight\"> 其中运费： </p></div></td><td class=\"k209\"><div class=\"k210\"><input class=\"k210-input\"  name=\"\" type=\"button\" value=\"确认发货\" onclick=\"gys.GoodsReceipt();\"/>  </div></td></tr>";
	if(data == null)
	{
		$("#CountPage").text("共0条数据");
		document.getElementById("NowPageNumber").value = "0";
		document.getElementById("order_code_res").innerHTML = "<p id='order_code_res'>订单号:<br /></p>";
		document.getElementById("create_time_res").innerHTML = "<p id='create_time_res'>订单生成时间:<br /></p>";
		document.getElementById("consignee_res").innerHTML = "<p id='consignee_res'>收货人姓名:<br /></p>";
		document.getElementById("consignee_phone_res").innerHTML = "<p id='consignee_res'>收货人联系电话:<br /></p>";
		document.getElementById("post_code_res").innerHTML = "<p id='post_code_res'>邮编:<br /></p>";
		document.getElementById("address_res").innerHTML = "<p id='address_res'>收货地址:<br /></p>";
		document.getElementById("logistics_name").value = "请选择";
		document.getElementById("logistics_code").value = "";
		return;
	}
	$("#CountPage").text("共" + data["统计"] + "条数据");
	document.getElementById("NowPageNumber").value = parseInt(data["当前页"])+1;
	document.getElementById("order_code_res").innerHTML = "<p id='order_code_res'>订单号:<br />" + data["订单编号"] + "</p>";
	document.getElementById("create_time_res").innerHTML = "<p id='create_time_res'>订单生成时间:<br />" + data["订单生成时间"] + "</p>";
	document.getElementById("consignee_res").innerHTML = "<p id='consignee_res'>收货人姓名:<br />" + data["收货人姓名"] + "</p>";
	document.getElementById("consignee_phone_res").innerHTML = "<p id='consignee_res'>收货人联系电话:<br />" + data["收货人联系电话"] + "</p>";
	document.getElementById("post_code_res").innerHTML = "<p id='post_code_res'>邮编:<br />" + data["邮编"] + "</p>";
	document.getElementById("address_res").innerHTML = "<p id='address_res'>收货地址:<br />" + data["收货地址"] + "</p>";
	document.getElementById("logistics_name").value = data["物流名称"];
	document.getElementById("logistics_code").value = data["物流编号"];
	document.getElementById("freight").innerHTML = "其中运费:" + data["运费"];
	gys.AJAX_Subtim_SelectOrderCommodityInfo(SelectOrderCommodityInfo_CallBack);
}

$(function(){
	document.getElementById("min_time").valueAsDate  = new Date(); 
	document.getElementById("max_time").valueAsDate  = new Date(); 
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
