<?php
header("Content-Type: text/html; charset=utf-8");

class DB
{
	public $con = null;
	public $query = null;
	public $ConnectStatus = false;
    public $DataBaseIp = "localhost";
	public $LoginName = "root";
	public $PassWord = "";
	public $Db = "ceshi5";
	
	function ConnectDataBase()
	{
		if($this->ConnectStatus== true)
			return true;
		$this->con = mysql_connect($this->DataBaseIp,$this->LoginName,$this->PassWord);
		if (!$this->con)
		{
			$this->ConnectStatus = false;
			return false;
		}
		else 
		{
			$db_selected = mysql_select_db($this->Db, $this->con);
			$this->ConnectStatus = true;
		}
		return true;
	}
	
	function CloseDataBase()
	{
		$this->ConnectStatus = false;
		mysql_close($this->con);
	}
	
	function RunSql($sql)
	{
		mysql_query("set names 'utf8'");
		$this->query = mysql_query($sql);
		return mysql_affected_rows(); 
	}
	
	function Get_MyJson($SUCCESS,$ERROR,$DATA)
	{
		//if(strlen($SUCCESS) == 0)
			//$SUCCESS = '""';
		//if(strlen($ERROR) == 0)
			//$ERROR = '""';
		if(strlen($DATA) == 0)
			$DATA = '""';
		else 
		{
			$char_1 = substr( $DATA, 0, 1 );
			if($char_1 != '[' && $char_1 != '{')
				$DATA = '"'.$DATA.'"';
		}
		if(strlen($ERROR) == 0)
			$ERROR = '""';
		$res = '{';
		$res .= '"SUCCESS":"'.$SUCCESS.'",';
		$res .= '"ERROR":'.$ERROR.',';
		$res .= '"DATA":'.$DATA;
		$res .= '}';
		return $res;
	}
	
	function Get_ERROR_Json($request, $code, $message)
	{
		$res = '{';
		$res .= '"request":"'.$request.'",';
		$res .= '"code":"'.$code.'",';
		$res .= '"message":"'.$message.'"';
		$res .= '}';
		return $res;
	}
	
}

?>
