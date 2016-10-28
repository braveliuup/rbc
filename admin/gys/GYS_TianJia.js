var GYS_TianJiaGYS = 
{
	createNew:function(ObjName,type)
	{
		var obj = {};
		obj.objname = ObjName;
		obj.NowZizhiIndex = 0;
		obj.SubtimUrl;
		obj.IdDic = new Array(10);
		var curWwwPath=window.document.location.href;
		var pathName=window.document.location.pathname;
		var pos=curWwwPath.indexOf(pathName);
		var localhostPaht=curWwwPath.substring(0,pos);
		obj.SubtimUrl = localhostPaht;
		
		for(var i=1;i<=10;i++)
		{
			obj.IdDic[i] = "zizhi"+i.toString();
		}
		
		obj.AJAX_Subtim = function (formId)
		{
			var data = $('#'+formId).serializeArray();
			var typeNode = {};
			typeNode.name = 'form';
			if(type == "new")
				typeNode.value = "添加供应商基本信息";
			else typeNode.value = "修改供应商基本信息";
			data.push(typeNode);
			$.ajax({
					url: obj.SubtimUrl + "/gongyingshang/Service.php",
					type: 'post',
					data: data,
					success: obj.AJAX_CallBack
				});
		}
		
		obj.AJAX_CallBack = function (data)
		{
			alert(data);
		}
		
		obj.ClickUpload = function(file_control_id)
		{
			document.getElementById(file_control_id).click();
		}
		
		obj.deleteZiZhiImg = function(control)
		{
			var id = parseInt(control.id);
			var tdControl = document.getElementById(obj.IdDic[id] + '_td');
			tdControl.innerHTML = "";
			for(var i=id;i<=10;i++)
			{
				if(i+1 > 10)
					return;
				var td1 = document.getElementById(obj.IdDic[i] + '_td');
				var td2 = document.getElementById(obj.IdDic[i+1] + '_td');
				td1.innerHTML = td2.innerHTML;
				td2.innerHTML = null;
				var t = document.getElementById(obj.IdDic[i+1]+ '_img');
				if(t == null)
					return;
				t.id = obj.IdDic[i] + '_img';
				t = document.getElementById(obj.IdDic[i+1]+ '_data');
				t.id = obj.IdDic[i] + '_data';
				t.name = obj.IdDic[i] + '_data';
				t = document.getElementById(obj.IdDic[i+1]+ '_size');
				t.id = obj.IdDic[i] + '_size';
				t.name = obj.IdDic[i] + '_size';
				t = document.getElementById((i+1).toString());
				t.id = i.toString()
			}
		}
		
		obj.deleteXieYiImg = function()
		{
			var t = document.getElementById('xieyi_img');
			t.src = "";
			t = document.getElementById('xieyi_data');
			t.value = "";
			t = document.getElementById('xieyi_size');
			t.value = "";
		}
		
		obj.upload_XieYi = function(control)
		{
			var filetype = ['bmp','jpg','jpeg','png','gif'];
			var fi = control.files[0];
			if(fi.size >1024*306)
			{
				alert('图片不能大于300KB');
				return;
			}
			var fname = fi.name.split('.');
			if(filetype.indexOf(fname[1].toLowerCase()) == -1)
			{
				alert('文件格式不支持');
				return ;
			}
			var fr = new FileReader();
			fr.readAsDataURL(fi);
			fr.onload = function(frev)
			{
				obj.addXieYiImg(frev.target.result,fi.size);
			}
		}
		
		obj.upload_ZiZhi = function(control)
		{
			var filetype = ['bmp','jpg','jpeg','png','gif'];
			var fi = control.files[0];
			if(fi.size >1024*306)
			{
				alert('图片不能大于300KB');
				return;
			}
			var fname = fi.name.split('.');
			if(filetype.indexOf(fname[1].toLowerCase()) == -1)
			{
				alert('文件格式不支持');
				return ;
			}
			var fr = new FileReader();
			fr.readAsDataURL(fi);
			fr.onload = function(frev)
			{
				obj.addZiZhiImg(frev.target.result,fi.size);
			}
		}
		
		obj.addZiZhiImg = function(data, size)
		{
			var CreateNewImageIndex = 0;
			for(var i=1;i<=10;i++)
			{
				if(document.getElementById(obj.IdDic[i] + '_data') == null)
				{
					CreateNewImageIndex = i;
					break;
				}
			}
			if(CreateNewImageIndex <=0 || CreateNewImageIndex > 10)
			{
				alert('最多只能上传10张图片');
				return;
			}
			var tdControl = document.getElementById(obj.IdDic[CreateNewImageIndex] + '_td');
			if(tdControl == null)
			{
				alert('查找数据时出现错误');
				return;
			}
			tdControl.innerHTML = "<img id='" + obj.IdDic[CreateNewImageIndex] + "_img' width='100%' height='100' src=''></img>";
			tdControl.innerHTML += "<input id='" + obj.IdDic[CreateNewImageIndex] + "_data' name='" + obj.IdDic[CreateNewImageIndex] + "_data' style='display:none' type='text' value=''/>";
			tdControl.innerHTML += "<input id='" + obj.IdDic[CreateNewImageIndex] + "_size' name='" + obj.IdDic[CreateNewImageIndex] + "_size' style='display:none' type='text' value=''/>";
			tdControl.innerHTML += "<input id='" + CreateNewImageIndex.toString() + "' style='width:100%;height:20px' type='button' value ='删除' onclick=\"" + obj.objname + ".deleteZiZhiImg(this);\"/>";
			document.getElementById(obj.IdDic[CreateNewImageIndex] + "_img").src = data;
			document.getElementById(obj.IdDic[CreateNewImageIndex] + "_data").value = data;
			document.getElementById(obj.IdDic[CreateNewImageIndex] + "_size").value = size;
		}
		
		obj.addXieYiImg = function(data,size)
		{
			document.getElementById("xieyi_img").src = data;
			document.getElementById("xieyi_data").value = data;
			document.getElementById("xieyi_size").value = size;
		}
		
		
		return obj;
	}
}