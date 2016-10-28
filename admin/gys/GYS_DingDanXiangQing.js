
var GYS_DingDanXiangQing = 
{
	createNew:function()
	{
		var obj = {};
		var curWwwPath=window.document.location.href;
		var pathName=window.document.location.pathname;
		var pos=curWwwPath.indexOf(pathName);
		var localhostPaht=curWwwPath.substring(0,pos);
		
		obj.SelectOrdefInfo_Url = localhostPaht + '/gongyingshang/Service.php';
		obj.SelectOrdefInfo_Res = {};
		obj.SelectOrdefInfo_FormId = '';
		obj.SelectOrdefInfo_Client_CallBack;
		obj.SelectOrdefInfo_CountPage = 0;
		obj.SelectOrdefInfo_NowPage = 0;
		
		obj.UploadLogisticsInfo_Url = localhostPaht + '/gongyingshang/Service.php';
		obj.GoodsReceipt_Url = localhostPaht + '/gongyingshang/Service.php';
		obj.SelectOrdefInfo_Now_ordef_code ='';
		
		
		obj.SelectOrderCommodityInfo_Url = localhostPaht + '/gongyingshang/Service.php';
		obj.SelectOrderCommodityInfo_Client_CallBack;
		obj.AJAX_Subtim_SelectOrderCommodityInfo = function (callback_function)
		{
			obj.SelectOrderCommodityInfo_Client_CallBack = callback_function;
			var data= Array();
			var GetNode = {};
			GetNode.name = 'order_code';
			GetNode.value = obj.SelectOrdefInfo_Now_ordef_code;
			data.push(GetNode);
			var typeNode = {};
			typeNode.name = 'form';
			typeNode.value = '查询订单商品信息';
			data.push(typeNode);
			$.ajax({
					url: obj.SelectOrderCommodityInfo_Url,
					type: 'get',
					data: data,
					success: obj.SelectOrderCommodityInfo_CallBack
				});	
		}
		obj.SelectOrderCommodityInfo_CallBack = function(data)
		{
			temp_res = {};
			//解析数据;
			var res = data.split(';');
			var runNum = 0;
			if(res.length > 1)
			{
				var v = res[0].split(':');
				if(v[0] === 'row')
				{
					runNum = parseInt(v[1]);
				}
			}
			else // <=1 ||
			{
				obj.SelectOrderCommodityInfo_Client_CallBack(null,null);
				return;
			}
			var runColumn = (res.length-1) / runNum;
			var ColumnIndex = 1;
			for(var i=0;i<runNum;i++)
			{
				var dic = {};
				for(var j=0;j<runColumn;j++)
				{
					var v = res[ColumnIndex++].split(':');
					if(v.length == 2)
					{
						dic[v[0]] = v[1];
					}
				}
				temp_res[i] = dic;
			}
			obj.SelectOrderCommodityInfo_Client_CallBack(temp_res,runNum);
		}
		
		//订单查询-->AJAX提交;
		obj.AJAX_Subtim_SelectOrderInfo = function (formId, callback_function)
		{
			obj.SelectOrdefInfo_FormId = formId;
			var data = $('#'+formId).serializeArray();
			var pageNode = {};
			pageNode.name = 'page';
			pageNode.value = obj.SelectOrdefInfo_NowPage;
			data.push(pageNode);
			var typeNode = {};
			typeNode.name = 'form';
			typeNode.value = '查询订单信息';
			data.push(typeNode);
			
			obj.SelectOrdefInfo_Client_CallBack = callback_function;
			$.ajax({
					url: obj.SelectOrdefInfo_Url,
					type: 'get',
					data: data,
					success: obj.SelectOrdefInfo_CallBack
				});
		}
		//订单信息->AJAX回调;
		obj.SelectOrdefInfo_CallBack = function (data)
		{
			obj.SelectOrdefInfo_Res = {};
			//解析数据;
			var res = data.split(';');
			for(var i=0;i<res.length;i++)
			{
				var v = res[i].split(':');
				if(v.length == 2)
				{
					obj.SelectOrdefInfo_Res[v[0]] = v[1];
				}
				else 
				{
					if(v[0] == '订单生成时间')
					{
						obj.SelectOrdefInfo_Res[v[0]] = v[1] + ":" + v[2] + ":" + v[3];
					}
				}
			}
			//如果包含错误;
			//弹窗提示,然后结束;
			if(obj.SelectOrdefInfo_Res['error'])
			{
				alert(obj.SelectOrdefInfo_Res['error']);
				obj.SelectOrdefInfo_Client_CallBack(null);
				return;
			}
			//取总页数;
			var error = false;
			if(obj.SelectOrdefInfo_Res['订单编号'])
			{
				obj.SelectOrdefInfo_Now_ordef_code = obj.SelectOrdefInfo_Res['订单编号'];
			}
			else error = true;
			if(obj.SelectOrdefInfo_Res['统计'])
			{
				obj.SelectOrdefInfo_CountPage = parseInt(obj.SelectOrdefInfo_Res['统计']);
			}
			else error = true;
			if(obj.SelectOrdefInfo_Res['当前页'])
			{
				obj.SelectOrdefInfo_NowPage = parseInt(obj.SelectOrdefInfo_Res['当前页']);
			}
			else error = true;
			if(error == true)
			{
				obj.SelectOrdefInfo_CountPage = '0';
				obj.SelectOrdefInfo_NowPage = 0;
				alert('超出预期的数据格式');
				obj.SelectOrdefInfo_Client_CallBack(null);
				return;
			}
				
			obj.SelectOrdefInfo_Client_CallBack(obj.SelectOrdefInfo_Res);
		}
		//订单信息-->查询按钮;
		obj.SelectOrderInfo = function (formId, callback_function) 
		{
			obj.SelectOrdefInfo_NowPage = 0;
			obj.AJAX_Subtim_SelectOrderInfo(formId, callback_function);
		}
		//订单信息-->下一页;
		obj.SelectOrderInfo_NextPage = function ()
		{
			if(obj.SelectOrdefInfo_NowPage + 1 >= parseInt(obj.SelectOrdefInfo_CountPage))
			{
				alert("已经到最大页数了呢~");
				return;
			}
			obj.SelectOrdefInfo_NowPage ++;	
			obj.AJAX_Subtim_SelectOrderInfo(obj.SelectOrdefInfo_FormId, obj.SelectOrdefInfo_Client_CallBack);
			
		}
		//订单信息-->上一页;
		obj.SelectOrderInfo_LastPage = function ()
		{
			if(obj.SelectOrdefInfo_NowPage - 1 < 0)
			{
				alert("已经没有了呢~");
				return;
			}
			obj.SelectOrdefInfo_NowPage --;
			obj.AJAX_Subtim_SelectOrderInfo(obj.SelectOrdefInfo_FormId, obj.SelectOrdefInfo_Client_CallBack);
		}
		//订单信息-->页面跳转;
		obj.SelectOrdefInfo_GoToPage = function ()
		{
			obj.AJAX_Subtim_SelectOrderInfo(formId, callback_function);
		}
		//订单信息-->当前页空间的值发生改变时;
		obj.OrderInfo_NowPageControlValueChange = function(control)
		{
			var newValue = parseInt(control.value);
			if(isNaN(newValue) == true || newValue <= 0 || newValue > obj.SelectOrdefInfo_CountPage)
			{
				control.value = 1;
				alert('这样不合规矩的呢~');
				return;
			}
			obj.SelectOrdefInfo_NowPage = newValue - 1;
		}
		
		//订单信息-->提交物流信息更改;
		obj.UploadLogisticsInfo = function(formId)
		{
			if(obj.SelectOrdefInfo_Now_ordef_code.length == 0)
			{
				alert('不可以的呢~~你要先查到数据才能修改物流信息呦~~');
				return;
			}
			
			obj.SelectOrdefInfo_FormId = formId;
			var data = $('#'+formId).serializeArray();
			var codeNode = {};
			codeNode.name = 'order_code';
			codeNode.value = obj.SelectOrdefInfo_Now_ordef_code;
			data.push(codeNode);
			var typeNode = {};
			typeNode.name = 'form';
			typeNode.value = '提交物流信息';
			data.push(typeNode);
			$.ajax({
					url: obj.UploadLogisticsInfo_Url,
					type: 'get',
					data: data,
					success: obj.UploadLogisticsInfo_CallBack
				});
		}
		//订单信息-->提交物流信息更改-->回调;
		obj.UploadLogisticsInfo_CallBack = function (data)
		{
			alert(data);
		}
		//订单信息-->确认发货;
		obj.GoodsReceipt = function(value)
		{
			var data = new Array();
			var codeNode = {};
			codeNode.name = 'order_code';
			codeNode.value = obj.SelectOrdefInfo_Now_ordef_code;
			data.push(codeNode);
			var statusNode = {};
			statusNode.name = 'order_status';
			statusNode.value = '1';
			data.push(statusNode);
			var typeNode = {};
			typeNode.name = 'form';
			typeNode.value = '更改物流状态';
			data.push(typeNode);
			$.ajax({
					url: obj.GoodsReceipt_Url,
					type: 'get',
					data: data,
					success: obj.UploadLogisticsInfo_CallBack
				});
		}
		return obj;
	}
}