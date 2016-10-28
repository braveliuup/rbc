
var GYS_GongYingShangLieBiao = 
{
	createNew:function()
	{
		var obj = {};
		var curWwwPath=window.document.location.href;
		var pathName=window.document.location.pathname;
		var pos=curWwwPath.indexOf(pathName);
		var localhostPaht=curWwwPath.substring(0,pos);
		
		obj.Select_Url = localhostPaht + '/gongyingshang/Service.php';
		obj.Select_Res = {};
		obj.Select_FormId = '';
		obj.Select_Client_CallBack;
		obj.Select_CountPage = 0;
		obj.Select_NowPage = 0;
		obj.Select_AllRowCount = 0;

		//供应商列表-->AJAX提交;
		obj.AJAX_Subtim = function (formId, callback_function)
		{
			//$('#'+formId).submit();
			//return;
			obj.Select_FormId = formId;
			var data = $('#'+formId).serializeArray();
			var pageNode = {};
			pageNode.name = 'page';
			pageNode.value = obj.Select_NowPage;
			data.push(pageNode);
			var typeNode = {};
			typeNode.name = 'form';
			typeNode.value = '供应商列表';
			data.push(typeNode);
			
			obj.Select_Client_CallBack = callback_function;
			$.ajax({
					url: obj.Select_Url,
					type: 'get',
					data: data,
					success: obj.CallBack
				});
		}
		//供应商列表->AJAX回调;
		obj.CallBack = function (data)
		{
			//解析数据;
			var res = data.split(';');
			if(res.length <=1)
			{
				alert('没有查询到数据');
				return;
			}
			
			obj.Select_AllRowCount = res[0];
			obj.Select_NowPage = res[1];
			obj.Select_CountPage = obj.Select_AllRowCount / 10;
			var RowCount = res[2];
			var columnCount = (res.length - 3) / obj.Select_AllRowCount;
			obj.Select_Res = new Array(RowCount);
			
			for(var i=0,j=3;i<RowCount;i++)
			{
				var row = new Array(columnCount)
				for(var z = 0;z<columnCount;j++,z++)
				{
					row[z] = res[j];
				}
				obj.Select_Res[i] = row;
			}
			
			obj.Select_Client_CallBack(obj.Select_Res,obj.Select_AllRowCount,obj.Select_NowPage);
		}
		//订单信息-->查询按钮;
		obj.SelectButton = function (formId, callback_function) 
		{
			obj.Select_NowPage = 0;
			obj.AJAX_Subtim(formId, callback_function);
		}
		
		//订单信息-->下一页;
		obj.Select_NextPage = function ()
		{
			if(obj.Select_NowPage + 1 >= parseInt(obj.Select_CountPage))
			{
				alert("已经到最大页数了呢~");
				return;
			}
			obj.Select_NowPage ++;	
			obj.AJAX_Subtim(obj.Select_FormId, obj.Select_Client_CallBack);
			
		}
		//订单信息-->上一页;
		obj.Select_LastPage = function ()
		{
			if(obj.Select_NowPage - 1 < 0)
			{
				alert("已经没有了呢~");
				return;
			}
			obj.Select_NowPage --;
			obj.AJAX_Subtim(obj.Select_FormId, obj.Select_Client_CallBack);
		}
		//订单信息-->当前页空间的值发生改变时;
		obj.NowPageControlValueChange = function(control)
		{
			var newValue = parseInt(control.value);
			if(isNaN(newValue) == true || newValue <= 0 || newValue > obj.Select_CountPage)
			{
				control.value = 1;
				alert('这样不合规矩的呢~');
				return;
			}
			obj.Select_CountPage = newValue - 1;
		}
		return obj;
	}
}