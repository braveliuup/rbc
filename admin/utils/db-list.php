<?php
class db{
	/**********************************************************************
	*  Author: fangjun (fangjunai@163.com)
	*  Name..: PHP_For_MySQL_Helper v1.0
	*  Desc..: 自动生成数据库操作类
	*  Date..: 2011-7-22
	/**********************************************************************/

	private $db_server = 'localhost';
	private $db_username = 'root';
	private $db_password = '';
	private $primary_key = null;
	//初始化
	public function __construct(){
		$this->db_conn = mysql_connect($this->db_server,$this->db_username,$this->db_password) or die('Error:'.mysql_error());
		mysql_set_charset('utf8');
	}

	
	//返回所以的数据库名称
	public function db_list(){
		$databasename = array();
		$i=0;
		$list = mysql_list_dbs($this->db_conn);
		while ($row =  mysql_fetch_object($list)) {
     		$databasename[$i] = $row->Database;
     		$i++;
		}
		mysql_close();
		return $databasename;
	}
	
	
	
	//返回所以的数据库名称
	public function table_list($databasename){
		$tablename = array();
		$i=0;
	    $result = @mysql_list_tables($databasename);
		while($row = mysql_fetch_array($result,MYSQL_NUM)){
     		$tablename[$i] = $row[0];
     		$i++;
		}
		mysql_free_result($result);
		mysql_close();
		return $tablename;
	}
	
	//返回表里的字段
	public function field_list($databasename,$tablename){
		$fieldname = array();
		$v = 0;
		mysql_select_db($databasename,$this->db_conn);
		$rel = mysql_query("select * from ".$tablename);
		 for($i=0;$i<mysql_num_fields($rel);$i++){
		 	$meta = mysql_fetch_field($rel);
		 	if($meta){
		 		// var_dump($meta);
		 		if($meta->primary_key==1){
		 	  		$this->primary_key = $meta->name;
		 	  	}else{
		 	  		$fieldname[$v] = $meta->name;
		 	  		$v++;
		 	  	}
		 	}
		 }
	    mysql_close();
	    return $fieldname;
	}

	public function html_field_list($databasename,$tablename){
		$trs="";
		mysql_select_db($databasename,$this->db_conn);
		$sql = "SELECT COLUMN_NAME, DATA_TYPE, COLUMN_COMMENT FROM information_schema.columns WHERE table_name ='{$tablename}'";
		$query = mysql_query($sql);
		while ( $arr = mysql_fetch_assoc($query)) {
			$colname = $arr['COLUMN_NAME'];			
			$coltype = $arr['DATA_TYPE'];			
			$colcomment = $arr['COLUMN_COMMENT'];
			$commentAry = explode('_',$colcomment);
			$type = "";
			if(count($commentAry) == 2){
				$type = $commentAry[1];
			}
			$comment = $commentAry[0];
			if($comment == '' || $type == 'id'){
				continue;
			}
			$input ="<input {\$readonly} name='{$colname}' value='未解析的类型{$coltype}'/>";
			if($coltype == "varchar"){
				switch ($type){
					case 'photo':
						$input ="<input  name='{$colname}' type='file' accept='.jpg,.jpeg,.gif,.png,.bmp'/>";
						break;
					case 'sex':
						$input = "<select name='{$colname}'><option>请选择</option><option value='女'>女</option><option value='男'>男</option></select>";
						break;
					case 'idcard':
						$input ="<input name='{$colname}' onblur='idcardOnBlur(event);'/><script>function idcardOnBlur(event){if(birthCom){birthCom.init(event.currentTarget.value.substr(-12,8));}}</script>";
						break;
					case 'birth':
						$input = "<div id='birthComponent' post-name='{$colname}'></div><script src='js/birth.js'></script>";
						break;
					case 'edu':
						$input = "<select name='{$colname}'><option>请选择</option><option value='初中'>初中</option><option value='高中'>高中</option><option value='大学专科'>大学专科</option><option value='大学本科'>大学本科</option><option value='硕士'>硕士</option><option value='博士'>博士</option></select>";
						break;
					case 'depart':
						$input = "<select name='{$colname}'><option>请选择</option><option value='市场部'>市场部</option><option value='法务部'>法务部</option><option value='财务部'>财务部</option><option value='文案部'>文案部</option><option value='运维部'>运维部</option></select>";
						break;
					case 'title':
						$input = "<select name='{$colname}'><option>请选择</option><option value='员工'>员工</option><option value='部门主管'>部门主管</option></select>";
						break;
					case 'tel':
						$input ="<div id='tel_div'><input  name='{$colname}' type='hidden'/><input  placeholder='区号'/>-<input  placeholder='电话号'/>-<input  placeholder='分机号'/></div>";
						break;
					case 'state':
						$input = "<select name='{$colname}'><option>请选择</option><option value='试用'>试用</option><option value='正式'>正式</option><option value='离职'>离职</option></select>";
						break;
					case 'addr':
						$input = "<div id='areaComponent' data='address' gen-input='true' ></div><script src='js/area.js'></script>";
						break;
					default:
						$input ="<input  name='{$colname}' value='{\${$tablename}.{$colname}}'/>";
						break;
				}
			}else if($coltype == "text"){
				$input ="<textarea  name='{$colname}' />{\${$tablename}.{$colname}}</textarea>";
			}else if($coltype == "int" || $coltype == "tinyint" || $coltype == "mediumint" || $coltype == "double"){
				$input ="<input  name='{$colname}' value='{\${$tablename}.{$colname}}'/>";
			}
			$trs .= "<tr >
				<td>{$comment}:</td>
				<td>"
				.$input.
				"</td>
			</tr>";
		
		}
	    mysql_close();
		return $trs;
	}

	
	public function showclass($databasename,$tablename){
		
		$field = $this->field_list($databasename,$tablename);
		$this->primary_key;
		
		$key = null;
		$val = null;
		$sql = null;
		$tmp = null;
		
		$html = '////////////////////////////////////<br/>';
		$html = $html.'//使用方法<br/>';
		$html = $html.'// 导入<br/>';
		$html = $html.'// ez_sql：http://jvmultimedia.com/docs/ezsql/ez_sql_help.htm';
		$html = $html.'// require_once \'./db/ez_sql_core.php;<br/>';
		$html = $html.'// require_once \'./db/ez_sql_mysql.php;<br/>';
		$html = $html.'// $db = new ezSQL_mysql($cfg_db_user,$cfg_db_pass,$cfg_db_name,$cfg_db_host);<br/>';
		$html = $html.'// $db->query(\'set names utf8\');<br/>';
		$html = $html.'// 调用<br/>';
		$html = $html.'// $forum = new Forum($db);<br/>';
		$html = $html.'// $forum->save($Posts);<br/>';
		$html = $html.'////////////////////////////////////<br/><br/><br/>';

		
		$html = $html.'// 作者:<br/>';
		$html = $html.'// 备注:<br/>';
		$html = $html.'// 创建时间:'.date('Y-m-d H:i:s').'<br/>';
		
		
		$html = $html.'<PRE> class '.$tablename.'{<br/>';
		$html = $html.'<br/>';
		$html = $html.'    private $db';
		$html = $html.'<br/>';
		$html = $html.'<br/>';
		$html = $html.'    //实例化 <br/>';
		$html = $html.'    public function '.$tablename.'($db){<br/>';
		$html = $html.'         $this->db = $db;<br/>';
		$html = $html.'    }<br/>';
		
		
		$html = $html.'<br/>';
		
		$html = $html.'    //保存记录<br/>';
		$html = $html.'    public function save($arry){<br/>';
		for($i=0;$i<count($field);$i++){
     		$key = $key.$field[$i].',';
     		$val = $val.'\'{$arry['.$field[$i].']}\',';
		}
		$sql = "\"insert into ".$tablename." (".rtrim($key,",").")values(".rtrim($val,",").")\"";
		$html = $html.'         $sql='.$sql.';<br/>';
		$html = $html.'         return $this->db->query($sql);<br/>';
		$html = $html.'    }<br/>';
		
		
		$html = $html.'<br/>';

		
		$html = $html.'    //根据主键更新记录 <br/>';
		$html = $html.'    public function update($arry){<br/>';
		for($i=0;$i<count($field);$i++){
     		$tmp = $tmp.$field[$i].'=\'{$arry['.$field[$i].']}\',';
		}
		$sql = "\"update ".$tablename." set ".rtrim($tmp,",")." where ".$this->primary_key.'=".$arry['.$this->primary_key.']';
		$html = $html.'         $sql='.$sql.';<br/>';
		$html = $html.'         return $this->db->query($sql);<br/>';
		$html = $html.'    }<br/>';
		
		//PostID='{$Posts['PostID']}'";
		
		$html = $html.'<br/>';
		
		$html = $html.'    //根据主键删除记录 <br/>';
		$html = $html.'    public function delete($'.$this->primary_key.'){<br/>';
		$sql = "\"delete from ".$tablename." where ".$this->primary_key."=\".$".$this->primary_key;
		$html = $html.'         $sql='.$sql.';<br/>';
		$html = $html.'         return $this->db->query($sql);<br/>';
		$html = $html.'    }<br/>';

		
		$html = $html.'<br/>';
		
		$html = $html.'    //根据主键查询一条记录 <br/>';
		$html = $html.'    public function getQueryById($'.$this->primary_key.'){<br/>';
		$sql = "\"select * from ".$tablename." where ".$this->primary_key."=\".$".$this->primary_key;
		$html = $html.'         $sql='.$sql.';<br/>';
		$html = $html.'         return $this->db->get_row($sql);<br/>';
		$html = $html.'    }<br/>';
		
		
		$html = $html.'<br/>';
		

		$html = $html.'    //查询全部记录 <br/>';
		$html = $html.'    public function getQuery(){<br/>';
		$sql = "\"select * from ".$tablename."\"";
		$html = $html.'         $sql='.$sql.';<br/>';
		$html = $html.'         return $this->db->get_results($sql);<br/>';
		$html = $html.'    }<br/>';
		$html = $html.'<br/>';
		
		$html = $html.'<br/>';
		
		$html = $html.'}</PRE>';
		echo $html;
	}

	public function showhtml($databasename,$tablename){
		mysql_select_db($databasename,$this->db_conn);
		$sql = "SELECT COLUMN_NAME, DATA_TYPE, COLUMN_COMMENT FROM information_schema.columns WHERE table_name ='{$tablename}'";
		$query = mysql_query($sql);
		$list_field = array();
		$filter_field = array();
		$filter_param = array();
		while ( $arr = mysql_fetch_assoc($query)) {
			$colname = $arr['COLUMN_NAME'];
			$coltype = $arr['DATA_TYPE'];
			$colcomment = $arr['COLUMN_COMMENT'];
			$commentAry = explode('_', $colcomment);
			$comment = $commentAry[0];
			$type = "";
			$is_listfield = "";
			$is_filter ="";
			if (count($commentAry) == 2) {
				$type = $commentAry[1];
			}
			if (count($commentAry) == 3) {
				$type = $commentAry[1];
				$is_listfield = $commentAry[2];
			}
			if (count($commentAry) == 4) {
				$type = $commentAry[1];
				$is_listfield = $commentAry[2];
				$is_filter = $commentAry[3];
			}

			if($is_filter){
				$ary = explode(':',$is_filter);
				if(!$filter_field[$ary[1]]){
					$filter_field[$ary[1]] = array('data'=>array($colname=>$comment), 'type'=>$type);
				}else{
					$filter_field[$ary[1]]['data'][$colname] = $comment;
				}
			}
			if(strstr($is_listfield , 'list')){
				$list_field[$colname] = $comment;
			}
		}
		$content='{if $full_page}
				{include file="pageheader.htm"}
				{insert_scripts files="../js/utils.js,listtable.js"}
				<div class="form-div">
			  <form action="javascript:searchParters()" name="searchForm">
				<img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />';
		$search='';
		foreach($filter_field as $key=>$value){
			$search .= '<span>'.$key.'：</span>';
			if($value['type'] == 'addr'){
				foreach($value['data'] as $k=>$v){
					$search .= '<div style="display:inline" id="areaComponent" data="'.$k.'" gen-input="true"></div><script src="js/area.js"></script>';
					$filter_param[] = $k;
				}
			}else if($value['type'] == 'depart'){
				foreach($value['data'] as $k=>$v){
					$search .= '<select name="'.$k.'"><option value="">请选择</option><option value="市场部">市场部</option><option value="法务部">法务部</option><option value="财务部">财务部</option><option value="文案部">文案部</option><option value="运维部">运维部</option></select>';
					$filter_param[] = $k;
				}
			}else if($value['type'] == 'edu'){
				foreach($value['data'] as $k=>$v){
					$search .= '<select name="'.$k.'"><option value="">请选择</option><option value="初中">初中</option><option value="高中">高中</option><option value="大学专科">大学专科</option><option value="大学本科">大学本科</option><option value="硕士">硕士</option><option value="博士">博士</option></select>';
					$filter_param[] = $k;
				}
			}else if($value['type'] == 'birth'){
				foreach($value['data'] as $k=>$v){
					$search .= '<div style="display:inline" id="birthComponent" post-name="'.$k.'"></div><script src="js/birth.js"></script>';
					$filter_param[] = $k;
				}
			}else if($value['type'] == 'state'){
				foreach($value['data'] as $k=>$v){
					$search .= '<select name="'.$k.'"><option value="">请选择</option><option value="试用">试用</option><option value="正式">正式</option><option value="离职">离职</option></select>';
					$filter_param[] = $k;
				}
			}else if($value['type'] == 'sex'){
				foreach($value['data'] as $k=>$v){
					$search .= '<select name="'.$k.'"><option value="">请选择</option><option value="男">男</option><option value="女">女</option></select>';
					$filter_param[] = $k;
				}
			}else{
				$ary = $value['data'];
				$name='';
				$placeholder = '';
				foreach($ary as $k=>$v){
					$name .= $k.'-';
					$placeholder .=$v.'/';
				}
				$search .= '<input name="'.substr($name,0,-1).'" placeholder="'.substr($placeholder, 0, -1).'"/>';
				$filter_param[] = substr($name,0,-1);
			}
		}
		$content .= $search;
		$content .= '  <input type="submit" value="搜索" class="button" />
		  </form>
		</div>
		<script language="JavaScript">
		  function searchParters()
		  {';
			foreach($filter_param as $k=>$value){
				$content .='listTable.filter["kfilter'.$value.'"] = Utils.trim(document.forms["searchForm"].elements["'.$value.'"].value);';
		  	}
		$content .='listTable.filter["page"] = 1;
			listTable.loadList();
		  }
		</script>
		{/if}
		<form method="post" action="javascript:exportTable()" name="listForm" >
		  <div class="list-div" id="listDiv">
		<table cellpadding="3" cellspacing="1">
		<tr>
		';
		$thead='';
		$tbody='';
		$idx = 0;
		$prikey = 'id';
		foreach($list_field as $key=>$value){
			if($idx == 0){
				$thead .='<th><input onclick="listTable.selectAll(this, \''.checkboxes.'\')" type="checkbox"  />'.$value.'</th>';
				$prikey = $key;
				$tbody .='<td><input name="checkboxes[]"   type="checkbox" value="{$obj.'.$key.'}" /><span>{$obj.'.$key.'}</span></td>';
				$idx = 1;
			}else{
				$thead .='<th>'.$value.'</th>';
				$tbody .='<td><span>{$obj.'.$key.'}</span></td>';
			}
		}
		$thead .= ' <th>操作</th>';
		$tbody .= '<td align="center">
			  <a href="'.$tablename.'.php?act=detail&id={$obj.'.$prikey.'}">详细</a>
			</td>';
		$content .=$thead.'</tr>
		  {foreach from=$'.$tablename.'_list item=obj}
		  <tr>'
		  .
		  $tbody
		  .
 		'<tr>';
		$content .= ' {foreachelse}
			  <tr><td class="no-records" colspan="10">{$lang.no_records}</td></tr>
			  {/foreach}
			</table>
			<table id="page-table" cellspacing="0">
			  <tr>
				<td align="right" nowrap="true">
				{include file="page.htm"}
				</td>
			  </tr>
			</table>
			  <input type="submit" value="批量部门分配" id="btnSubmit" name="btnSubmit" class="button"  />
			</div>
			</form>
			<script type="text/javascript">
			  function exportTable(){
				alert("功能暂未实现");
			  }

			  listTable.recordCount = {$record_count};
			  listTable.pageCount = {$page_count};

			  {foreach from=$filter item=item key=key}
			  listTable.filter.{$key} = \'{$item}\';
			  {/foreach}

			</script>
			{if $full_page}
			{include file="pagefooter.htm"}
			{/if}
			';
		echo $content;
		$filepath = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'templates';
		$filename = $tablename.'_list.htm';
		$fp = fopen($filepath.DIRECTORY_SEPARATOR.$filename, "w");
		if($fp){
			$flag = fwrite($fp, $content);
			if($flag){
				echo '<hr>';
				echo "<span class='filetip'>文件已保存到本地。文件名：<a href='http://localhost/admin/templates/{$filename}' target='_blank'>{$filename}</a>目录：<input style='width:400px' value='{$filepath }'></span>";
			}else{
				echo "<span class='filetip'>写入文件失败</span>";
			}
		}
		fclose($fp); 
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> PHP For MySQL Helper  v1.0 </title>
<style>
body{ font-size:14px;}
h3{ padding:0px; margin:0px; background-color:#333; color:#FFF;font-size:14px; }
.dblist,.tablelist,.show{width:100%;padding:10px 0;}
a:link {}
a:hover {color:#F00}
#download:hover{
	background-color:yellow;

}
#download{
	background-color:red
}
.filetip{
	font-size:24px;font-weight:bold;
	color:red;
}
</style>
<script type="text/javascript">

	function loadcomplete(){
		scrollPgae();
	}


	function scrollPgae(){
		var div = document.getElementById("content");
		document.body.scrollTop = div.offsetTop;
	}


</script>
</head>
<body>


<?php
ini_set('default_charset', 'utf-8');

echo '<div class=\'dblist\'>';
echo '<h3>请选择数据库</h3>';
//-----------------------------------
$DB = new db();
$dblist = $DB->db_list();
for ($row=0;$row<count($dblist);$row++){
	echo '<a href="?databasename='.$dblist[$row].'">'.$dblist[$row].'</a><br/>';
}
//-----------------------------------
echo '</div>';


echo '<div class=\'tablelist\'>';
echo '<h3>请选择表</h3>';
//-----------------------------------
if(isset($_GET['databasename'])){
	$databasename = $_GET['databasename'];
	
	$DB = new db();
	$tablelist = $DB->table_list($databasename);
	for ($i=0;$i<count($tablelist);$i++){
		echo 'CLASS:<a target="_self" href="db-html.php?gen=class&databasename='.$databasename.'&tablename='.$tablelist[$i].'">'.$tablelist[$i].'</a>&nbsp&nbspHTML:<a target="_self" href="db-html.php?gen=html&databasename='.$databasename.'&tablename='.$tablelist[$i].'">'.$tablelist[$i].'</a><br/>';
	}
}
//-----------------------------------
echo '</div>';

echo '<div id="content" class=\'show\'>';

if(isset($_GET['gen'])){
	$gen = $_GET['gen'];
	$databasename = $_GET['databasename'];
	$tablename = $_GET['tablename'];
	$DB = new db();

	if($gen == 'class'){
		echo '<h3>自动生成数据类</h3>';
		echo '<br><hr/>';
		$DB->showclass($databasename,$tablename);
		echo '<br><hr/>';
	}else if($gen == 'html'){
		echo '<h3>自动生成HTML模板</h3> ';
		echo '<br><hr/>';
		$DB->showhtml($databasename,$tablename);
	}
	echo '<script>window.onload=loadcomplete;</script>';
}
//-----------------------------------
//-----------------------------------

echo '</div>';
?>




</body>
</html>

