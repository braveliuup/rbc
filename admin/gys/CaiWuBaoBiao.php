<?php
OB_START();
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
  <div class="financial-statement" >
    <div class="financial-statement-1" >
      <div class="k400">
        <div class="k401">
          <div class="oo">
            <p>订单查询：</p>
          </div>
        </div>
        <div class="k402">
          <input  class="k402-input" type="text" value="订单编号/商品名称"/>
        </div>
      </div>
    </div>
    <div class="financial-statement-1" >
      <div class="k400">
        <div class="k401">
          <div class="oo">
            <p>结算周期：</p>
          </div>
        </div>
        <div class="k404">
          <select class="k404-select">
            <option value="请选择">请选择</option>
            <option value="2016">2016</option>
            <option value=""></option>
          </select>
        </div>
        <div class="k413">
          <p>年</p>
        </div>
        <div class="k404">
          <select class="k404-select">
            <option value="请选择">请选择</option>
            <option value="05">05</option>
            <option value=""></option>
          </select>
        </div>
        <div class="k413">
          <p>月</p>
        </div>
        <div class="k413">
          <p>-</p>
        </div>
        <div class="k404">
          <select class="k404-select">
            <option value="请选择">请选择</option>
            <option value="2016">2016</option>
            <option value=""></option>
          </select>
        </div>
        <div class="k413">
          <p>年</p>
        </div>
        <div class="k404">
          <select class="k404-select">
            <option value="请选择">请选择</option>
            <option value="05">05</option>
            <option value=""></option>
          </select>
        </div>
        <div class="k413">
          <p>月</p>
        </div>
      </div>
    </div>
    
    <div class="financial-statement-4" >
      <div class="k400">
        <div class="k401">
          <div class="oo">
            <p>订单日期查询：</p>
          </div>
        </div>
        <div class="k412">
          <input  class="k412-input" type="text" value="时间控件"/>
        </div>
        <div class="k413">
          <p>-</p>
        </div>
        <div class="k412">
          <input  class="k412-input" type="text" value="时间控件"/>
        </div>
      </div>
    </div>
    <div class="financial-statement-2" >
      <div class="k406">
        <input name=""  class="k406-input" type="button"  value="查询"/>
      </div>
      <div class="k406">
        <input name=""  class="k406-input" type="button"  value="批量导出"/>
      </div>
     
    </div>
    <div class="financial-statement-5" >
    
    <div class="k417"><a href=""><p>全部</p></a></div><div class="k417"><a href=""><p>已结算</p></a></div>
    <div class="k417"><a href=""><p>未结算</p></a></div>
    </div>
    <div class="financial-statement-3" >
      <table width="1320"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="k407"><p>序号</p></td>
          <td class="k407"><p>订单编号</p></td>
          <td class="k407"><p>商品名称</p></td>
          <td class="k407"><p>订单日期</p></td>
          <td class="k407"><p>会员</p></td>
            <td class="k407"><p>数量</p></td>
          <td class="k407"><p>单价(进货价格)</p></td>
          <td class="k407"><p>运费</p></td>
          <td class="k407"><p>小计</p></td>
          <td class="k407"><p>结算金额</p></td>
          <td class="k407"><p>结算状态</p></td>
        </tr>
        <tr>
          <td class="k407"><a href="">
            <div class="k414" >
              <p>001</p>
            </div>
            </a>
           </td>
          <td class="k407"><div class="k408"> <a href="">
              
              <div class="k414" >
                <p>12564252132</p>
              </div>
              </a> </div></td>
          <td class="k407"><div class="k408">
              <p>创康佳美牌阿胶枣杞固体饮料</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>2016.12.56<br />
                08:25:36</p>
            </div></td>
         
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>20</p>
            </div></td>
             <td class="k407"><div class="k408">
              <p>50.00</p>
            </div></td>
          <td class="k407"><div class="k408"> <p>15.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>1015.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>已结算</p>
            </div></td>
        </tr>
               <tr>
          <td class="k407"><a href="">
            <div class="k414" >
              <p>002</p>
            </div>
            </a>
           </td>
          <td class="k407"><div class="k408"> <a href="">
              
              
                <p>12564252132</p>
            
              </a> </div></td>
          <td class="k407"><div class="k408">
              <p>创康佳美牌阿胶枣杞固体饮料</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>2016.12.56<br />
                08:25:36</p>
            </div></td>
          
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>20</p>
            </div></td>
             <td class="k407"><div class="k408">
              <p>50.00</p>
            </div></td>
          <td class="k407"><div class="k408"> <p>15.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>1015.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>已结算</p>
            </div></td>
        </tr>
              
                  <tr>
          <td class="k407"><a href="">
            <div class="k414" >
              <p>003</p>
            </div>
            </a>
           </td>
          <td class="k407"><div class="k408"> <a href="">
              
              
                <p>12564252132</p>
            
              </a> </div></td>
          <td class="k407"><div class="k408">
              <p>创康佳美牌阿胶枣杞固体饮料</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>2016.12.56<br />
                08:25:36</p>
            </div></td>
         
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>20</p>
            </div></td>
             <td class="k407"><div class="k408">
              <p>50.00</p>
            </div></td>
          <td class="k407"><div class="k408"> <p>15.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>1015.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>已结算</p>
            </div></td>
        </tr>
              
                  <tr>
          <td class="k407"><a href="">
            <div class="k414" >
              <p>004</p>
            </div>
            </a>
           </td>
          <td class="k407"><div class="k408"> <a href="">
              
              
                <p>12564252132</p>
            
              </a> </div></td>
          <td class="k407"><div class="k408">
              <p>创康佳美牌阿胶枣杞固体饮料</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>2016.12.56<br />
                08:25:36</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          
          <td class="k407"><div class="k408">
              <p>20</p>
            </div></td>
             <td class="k407"><div class="k408">
              <p>50.00</p>
            </div></td>
          <td class="k407"><div class="k408"> <p>15.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>1015.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>已结算</p>
            </div></td>
        </tr>
              
                  <tr>
          <td class="k407"><a href="">
            <div class="k414" >
              <p>005</p>
            </div>
            </a>
           </td>
          <td class="k407"><div class="k408"> <a href="">
              
              
                <p>12564252132</p>
            
              </a> </div></td>
          <td class="k407"><div class="k408">
              <p>创康佳美牌阿胶枣杞固体饮料</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>2016.12.56<br />
                08:25:36</p>
            </div></td>
         
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>20</p>
            </div></td>
             <td class="k407"><div class="k408">
              <p>50.00</p>
            </div></td>
          <td class="k407"><div class="k408"> <p>15.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>1015.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>已结算</p>
            </div></td>
        </tr>
              
                  <tr>
          <td class="k407"><a href="">
            <div class="k414" >
              <p>006</p>
            </div>
            </a>
           </td>
          <td class="k407"><div class="k408"> <a href="">
              
              
                <p>12564252132</p>
            
              </a> </div></td>
          <td class="k407"><div class="k408">
              <p>创康佳美牌阿胶枣杞固体饮料</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>2016.12.56<br />
                08:25:36</p>
            </div></td>
         
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>20</p>
            </div></td>
             <td class="k407"><div class="k408">
              <p>50.00</p>
            </div></td>
          <td class="k407"><div class="k408"> <p>15.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>1015.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>已结算</p>
            </div></td>
        </tr>
              
                  <tr>
          <td class="k407"><a href="">
            <div class="k414" >
              <p>007</p>
            </div>
            </a>
           </td>
          <td class="k407"><div class="k408"> <a href="">
              
              
                <p>12564252132</p>
            
              </a> </div></td>
          <td class="k407"><div class="k408">
              <p>创康佳美牌阿胶枣杞固体饮料</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>2016.12.56<br />
                08:25:36</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
         
          <td class="k407"><div class="k408">
              <p>20</p>
            </div></td>
             <td class="k407"><div class="k408">
              <p>50.00</p>
            </div></td>
          <td class="k407"><div class="k408"> <p>15.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>1015.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>已结算</p>
            </div></td>
        </tr>
              
                  <tr>
          <td class="k407"><a href="">
            <div class="k414" >
              <p>008</p>
            </div>
            </a>
           </td>
          <td class="k407"><div class="k408"> <a href="">
              
              
                <p>12564252132</p>

            
              </a> </div></td>
          <td class="k407"><div class="k408">
              <p>创康佳美牌阿胶枣杞固体饮料</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>2016.12.56<br />
                08:25:36</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
         
          <td class="k407"><div class="k408">
              <p>20</p>
            </div></td>
             <td class="k407"><div class="k408">
              <p>50.00</p>
            </div></td>
          <td class="k407"><div class="k408"> <p>15.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>1015.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>已结算</p>
            </div></td>
        </tr>
              
                  <tr>
          <td class="k407"><a href="">
            <div class="k414" >
              <p>009</p>
            </div>
            </a>
           </td>
          <td class="k407"><div class="k408"> <a href="">
              
              
                <p>12564252132</p>
            
              </a> </div></td>
          <td class="k407"><div class="k408">
              <p>创康佳美牌阿胶枣杞固体饮料</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>2016.12.56<br />
                08:25:36</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
        
          <td class="k407"><div class="k408">
              <p>20</p>
            </div></td>
             <td class="k407"><div class="k408">
              <p>50.00</p>
            </div></td>
          <td class="k407"><div class="k408"> <p>15.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>1015.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>已结算</p>
            </div></td>
        </tr>
              
                  <tr>
          <td class="k407"><a href="">
            <div class="k414" >
              <p>010</p>
            </div>
            </a>
           </td>
          <td class="k407"><div class="k408"> <a href="">
              
              
                <p>12564252132</p>
            
              </a> </div></td>
          <td class="k407"><div class="k408">
              <p>创康佳美牌阿胶枣杞固体饮料</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>2016.12.56<br />
                08:25:36</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
         
          <td class="k407"><div class="k408">
              <p>20</p>
            </div></td>
             <td class="k407"><div class="k408">
              <p>50.00</p>
            </div></td>
          <td class="k407"><div class="k408"> <p>15.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>1015.00</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>已结算</p>
            </div></td>
        </tr>
              
        <tr>
          
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
             <td class="k407"><div class="k408">
              <p>合计：200</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>合计：</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>合计：</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>合计：</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p>合计：</p>
            </div></td>
          <td class="k407"><div class="k408">
              <p></p>
            </div></td>
        </tr>
      </table>
    </div>
    <div class="pages">
      <div class="page-text">
        <p><span>首页</span><span>&nbsp;&nbsp; </span><span>上一页&lt;&lt;当前</span><span>第1页&gt;&gt;下一页</span><span>&nbsp;&nbsp; 尾页</span></p>
      </div>
      <div class="page-number">
        <input  class="page-input" type="text" value="2"/>
      </div>
      <div  class="pagination">
        <p><span>跳转</span><span>&nbsp; </span><span>共1条记录</span></p>
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
