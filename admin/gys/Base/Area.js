//测试
var Area_Class = 
{
	createNew:function(areaId,cityIdId,provinceId)
	{
		var curWwwPath=window.document.location.href;
		var pathName=window.document.location.pathname;
		var pos=curWwwPath.indexOf(pathName);
		var localhostPaht=curWwwPath.substring(0,pos);
		var test = {};
		urlAddr = "../Base/Area.php";
		areaControlId=areaId;
		cityIdControlId=cityIdId;
		provinceControId=provinceId;
		ajaxObj=null;
		
		//初始化AJAX
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		  ajaxObj=new XMLHttpRequest();
		}
		else{// code for IE6, IE5
		  ajaxObj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		//选择市事件
		test.SelectCity = function (id)
		{
			ajaxObj.onreadystatechange=function()
			{
				if (ajaxObj.readyState==4 && ajaxObj.status==200)
				{
					var item = document.getElementById(areaControlId);
					item.innerHTML = ajaxObj.responseText;
				}
			}
			ajaxObj.open("GET",urlAddr+"?City=" + id,true);
			ajaxObj.send();
		}
		//选择省事件
		test.SelectProvince = function (id)
		{
			var c = document.getElementById(cityIdControlId);
			var a = document.getElementById(areaControlId);
			c.innerHTML = "<option value=''>请选省</option>";
			a.innerHTML = "<option value=''>请选市</option>";
			
			if(id === "")
				return;
			
			ajaxObj.onreadystatechange=function()
			{
				if (ajaxObj.readyState==4 && ajaxObj.status==200)
				{
					var item = document.getElementById(cityIdControlId);
					item.innerHTML = ajaxObj.responseText;
				}
			}
			ajaxObj.open("GET",urlAddr+"?Province=" + id,true);
			ajaxObj.send();
		}
		return test;
	}
}