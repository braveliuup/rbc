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
			$input ="<input disabled='{\$disabled}' name='{$colname}' value='未解析的类型{$coltype}'/>";
			if($coltype == "varchar"){
				$input ="<input disabled='{\$disabled}' name='{$colname}' value='{\${$tablename}.{$colname}}'/>";
			}else if($coltype == "text"){
				$input ="<textarea disabled='{\$disabled}' name='{$colname}' />{\${$tablename}.{$colname}}</textarea>";
			}else if($coltype == "int" || $coltype == "tinyint" || $coltype == "mediumint" || $coltype == "double"){
				$input ="<input disabled='{\$disabled}' name='{$colname}' value='{\${$tablename}.{$colname}}'/>";
			}
			$trs .= "<tr ".($colcomment=="id"?"hidden":"").">
				<td>{$colcomment}:</td>
				<td>".
				$input
				."</td>
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

		$content =  '<html>
				<head>
				</head>
				<body>
				<form enctype="multipart/form-data" action="" method="post" name="theForm">
				<table align="center">
				'.
				$this->html_field_list($databasename, $tablename)
				.'
				</table>
				<div class="button-div">
			        <input type="button" value="确定" class="button" onclick="" />
			     </div>
				</form>
				</body>
			</html>';
		echo $content;

		$filepath = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'templates';
		$filename = $tablename.'.htm';
		$fp = fopen($filepath.DIRECTORY_SEPARATOR.$filename, "w");
		if($fp){
			$flag = fwrite($fp, $content);
			if($flag){
				echo '<hr>';
				echo "<span class='filetip'>文件已保存到本地。文件名：<input value='{$filename}'/>；目录：<input style='width:400px' value='{$filepath }'></span>";
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

