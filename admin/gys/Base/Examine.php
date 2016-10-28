<?php
OB_START();
header("Content-Type: text/html; charset=utf-8");
class Examine
{
	//字符串是否可用;
	function EmptyString($str) 
	{ 
		if (!is_string($str)) return "字符不可用"; //是否是字符串类型
		if (empty($str)) return "字符不可用"; //是否已设定 
		if ($str=='') return "字符不可用"; //是否为空 
		if(strpos($str,"'") == true)
			return "字符不可用";
		return null; 
	} 

	//字符串长度区间;
	function mStrLen($str,$MinLen,$MaxLen)
	{
		$temp = strlen($str);
		if($temp >= $MinLen)
		{
			if($temp <= $MaxLen)
				return null;
			else 
			{
				return '必须小于'.$MaxLen .'位';
			}
		}
		else 
		{
			return '必须大于'.$MinLen .'位';
		}
	}
	
	//中文;
	function Cn($str,$minLen,$maxLen)
	{
		$error = Examine::mStrLen($str,$minLen,$maxLen);
		if($error != null)
			return $error;
		if(preg_match('/^[\x{4e00}-\x{9fa5}]+$/u',$str) > 0)
		{
			return null;
		}
		else return '不全是中文';
	}
	
	//英文字符;
	function En($str,$minLen,$maxLen)
	{
		$error = Examine::mStrLen($str,$minLen,$maxLen);
		if($error != null)
			return $error;
		if(!preg_match('/[a-zA-Z]/', $str))
		{
			return "必须全是英文字符";
		}
		else return null;
	}
	
	//整数;
	function Number($str,$minLen,$maxLen)
	{
		$error = Examine::mStrLen($str,$minLen,$maxLen);
		if($error != null)
			return $error;
		if(!preg_match('/^\d+$/i',$str))
		{
			return "必须是数字";
		}
		else return null;
	}
	
	//数字;
	function Double_($str,$minLen,$maxLen)
	{
		$error = Examine::mStrLen($str,$minLen,$maxLen);
		if($error != null)
			return $error;
		if(!is_numeric($str))
			return "必须是数字";
		else return null;
	}
	
	//手机号;
    function PhoneNumber($str) 
	{
		if(!preg_match("/^1[34578]{1}\d{9}$/",$str))
		{  
			return '不正确'; 
		}
		else return null;
    }
	
	//座机;
	function FixedPhoneNumber($str,$minLen,$maxLen)
	{
		$error = Examine::mStrLen($str,$minLen,$maxLen);
		if($error != null)
			return $error;
		if(!preg_match("/^(0[0-9]{2,3}-)?([2-9][0-9]{6,7})+(-[0-9]{1,4})?$/",$str))
		{  
			return '座机号码不正确'; 
		}
		else return null;
	}
	
	//账号;
	function AccountNumber($str,$minLen,$maxLen)
	{
		$error = Examine::mStrLen($str,$minLen,$maxLen);
		if($error != null)
			return $error;
		if (!preg_match("/^[a-zA-Z0-9_]{3,16}$/",$str))
		{
			return '用户名只能由字母、数字以及_组成';
		}
		else return null;
	}
	
	//密码;
	function Password($str,$minLen,$maxLen)
	{
		$error = Examine::mStrLen($str,$minLen,$maxLen);
		if($error != null)
			return $error;
		if (!preg_match("/^[a-zA-Z0-9_]{3,16}$/",$str))
		{
			return '密码只能由字母、数字和标点符号组成';
		}
		else return null;
	}
	
	//网址;
	function UrlAddr($str,$minLen,$maxLen)    
	{    
		$error = Examine::mStrLen($str,$minLen,$maxLen);
		if($error != null)
			return $error;
		if (!eregi("^http://[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*$",$str))   
		{    
			return '地址不正确';
		}
		return null;    
	}    
	
	//邮箱;
	function Email($str,$minLen,$maxLen)
	{
		$error = Examine::mStrLen($str,$minLen,$maxLen);
		if($error != null)
			return $error;
		if (!ereg("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i",$str))
		{ 
			return '邮箱不正确';
		} 
		return null;
	}
	
	//性别;
	function Sex($str,$minLen,$maxLen)
	{
		$error = Examine::ChinaLen($str,$minLen,$maxLen);
		if($error != null)
			return $error;
		if($str === '男' or $str === '女')
			return null;
		else return "必须是男或女";
	}
	
	//邮编;
	function Post($str,$minLen,$maxLen)    
	{
		$error = $this->mStrLen($str,$minLen,$maxLen);
		if($error != null)
			return $error;
		if($this->mStrLen($str,1,7) === null)
		{		
			if(ereg("^[+]?[_0-9]*$",$str))    
			{    
				return null;
			}
		}
		else return "邮编不正确";
	}    
	
	//日期;
	function Date_($str,$minLen,$maxLen) 
	{
		$error = Examine::mStrLen($str,$minLen,$maxLen);
		if($error != null)
			return $error;
		$unixTime = strtotime($str);
		if (!$unixTime) 
		{
			return "日期格式不正确";
		}
		else 
		{
			return null;
		}
    }
	
	//金额转换5645132.3155 return '￥5,645,132.31';
	function Exchange_Money($str)    
	{    
		if(!is_numeric($str))
			return "必须是数字";
		$A_tmp=explode(".",$str); //将数字按小数点分成两部分，并存入数组$A_tmp    
		$I_len=strlen($A_tmp[0]); //测出小数点前面位数的宽度    
		if($I_len%3==0)    
		{    
			$I_step=$I_len/3; //如前面位数的宽度mod 3 = 0 ,可按，分成$I_step 部分    
		}
		else    
		{    
			$step=($len-$len%3)/3+1; //如前面位数的宽度mod 3 != 0 ,可按，分成$I_step 部分+1    
		}
		$C_cur="";    
		//对小数点以前的金额数字进行转换    
		while($I_len<>0)    
		{    
			$I_step--;
			if($I_step==0)    
			{    
				$C_cur .= substr($A_tmp[0],0,$I_len-($I_step)*3);    
			}
			else    
			{    
				$C_cur .= substr($A_tmp[0],0,$I_len-($I_step)*3).",";    
			}
			$A_tmp[0]=substr($A_tmp[0],$I_len-($I_step)*3);    
			$I_len=strlen($A_tmp[0]);    
		}    
			
			
		//对小数点后面的金额的进行转换    
		if($A_tmp[1]=="")    
		{    
			$C_cur .= ".00";    
		}
		else    
		{    
			$I_len=strlen($A_tmp[1]);    
			if($I_len<2)    
			{    
				$C_cur .= ".".$A_tmp[1]."0";    
			}
			else    
			{    
				$C_cur .= ".".substr($A_tmp[1],0,2);    
			}    
		}
		//加上人民币符号并传出    
		$C_cur="￥".$C_cur;    
		return $C_cur;    
	}    
	
	//验证全数字;
	function Exchange_Number($str,$minLen,$maxLen)
	{
		$error = Examine::mStrLen($str,$minLen,$maxLen);
		if($error != null)
			return;
		if(eregi('^[0-9]*$',$str))
		{
			return null;
		}
		return '必须全是数字';
	}
	
	//验证中文长度;
	function ChinaLen($value,$minLen,$maxLen)
	{
		$temp = mb_strlen($value,"utf-8");
		if($temp >= $minLen)
		{
			if($temp <= $maxLen)
				return null;
			else 
			{
				return '必须小于'.$maxLen .'位';
			}
		}
		else 
		{
			return '必须大于'.$minLen .'位';
		}
		return null;
	}
	
	//验证数据;
	function ExamineData($china,$name,$value,$minLen,$maxLen,$chinaLenOrenLen)
	{
		switch($name)
		{
			case 'ImgSize':	//图片大小
				$error = Examine::mStrLen($value,$minLen,$maxLen);
				if($error != null)
				{
					$error = "图片不能超过" . $maxLen / 1024 / 1024 . "KB大小";
				}
				break;
			case 'C_Len':	//中文长度;
				$error = Examine::ChinaLen($value,$minLen,$maxLen);
				break;
			case 'E_Len':	//英文长度;
				$error = Examine::mStrLen($value,$minLen,$maxLen);
				break;
			case 'Cn':	//中文;
				$error = Examine::Cn($value,$minLen,$maxLen);
				break;
			case 'En':	//英文;
				$error = Examine::En($value,$minLen,$maxLen);
				break;
			case 'Number': //数字;
				$error = Examine::Exchange_Number($value,$minLen,$maxLen);
				break;
			case 'AccountNumber':	//账号;
				$error = Examine::AccountNumber($value,$minLen,$maxLen);
				break;
			case 'Password':	//密码;
				$error = Examine::Password($value,$minLen,$maxLen);
				break;
			case 'PhoneNumber':	//手机号码;
				$error = Examine::PhoneNumber($value);
				break;
			case 'FPhoneNumber':	//座机号码;
				$error = Examine::FixedPhoneNumber($value,$minLen,$maxLen);
				break;
			case 'UrlAddr':	//网址;
				$error = Examine::UrlAddr($value,$minLen,$maxLen);
				break;
			case 'Email':	//邮箱;
				$error = Examine::Email($value,$minLen,$maxLen);
				break;
			case 'Post':	//邮编;
				$error = Examine::Post($value,$minLen,$maxLen);
				break;
			case 'String':	//字符串;
				$error = Examine::EmptyString($value,$minLen,$maxLen);
				break;
			case "Uint":	//Uint;
				$error = Examine::Number($value,$minLen,$maxLen);
				break;
			case "Int":		//int;
				$error = Examine::Double_($value,$minLen,$maxLen);
				break;
			case "Double":	//Double;
				$error = Examine::Double_($value,$minLen,$maxLen);
				break;
			case "Date":	//时间;
				$error = Examine::Date_($value,$minLen,$maxLen); 
				break;
			case "Sex":		//男|女;
				$error = Examine::Sex($value,$minLen,$maxLen);
				break;
			case "NULL":
				$error = null;
				break;
			default:
				$error = $name.'标志不正确';
				return $error;
		}
		if($error != null)
			$error = $china.$error;
		return $error;
	}
	
	function ExamineDataIsExists($_MARRAY,$name)
	{
		if($name == null)
			return false;
		return isset($_MARRAY[$name]);
	}
	function ExamineDataArrayIsExists($_MARRAY,$array)
	{
		$max = count($array);
		for($i=0;$i<$max;$i++)
		{
			if(isset($_MARRAY[$array[$i]]) == false)
			{
				echo $array[$i];
				return false;
			}
		}
		return true;
	}
}
?>














