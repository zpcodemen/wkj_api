<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>玩客家</title>
</head>
<?php
class wkjAPI {
	var  $access_key = "***";
	var  $secret_key = "***";
	function httpRequest($pUrl, $pData){
		$tCh = curl_init();
		curl_setopt($tCh, CURLOPT_POST, true);
		curl_setopt($tCh, CURLOPT_POSTFIELDS, $pData);
		curl_setopt($tCh, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
		curl_setopt($tCh, CURLOPT_URL, $pUrl);
		curl_setopt($tCh, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($tCh, CURLOPT_SSL_VERIFYPEER, false);
		$tResult = curl_exec($tCh);
		curl_close($tCh);
		$tResult=json_decode ($tResult,true);
		return $tResult;
	}
    
	function createSign($pParams = array()){    
		$tPreSign = http_build_query($pParams, '', '&');
		$SecretKey = sha1($this->secret_key);
		$tSign=hash_hmac('md5',$tPreSign,$SecretKey);
		$pParams['sign'] = $tSign;
		$pParams['reqTime'] = time()*1000;
		$tResult=http_build_query($pParams, '', '&');
		return $tResult;
	}
    
	//下单
	function  Trade($Price,$Amount,$type){				  
		$parameters=array(
			'access_key' => $access_key,
			'method'     => 'upTrade',
			'market'     => 'wkb_cny',
			'price'      => $Price,
			'num'        => $Amount,
			'type'       => $type
		);
		$url = "http://www.wkj.link/order/upTrade";
		$post=$this->createSign($parameters);
		$res =$this->httpRequest($url,$post);
		return $res;
	}
	//取消订单
	function Cancel($OrderID){
		$parameters=array(
			'access_key' => $access_key,
			'method'     => 'Cancel',
			'market'     => 'wkb_cny',
			'trade_num'  => $OrderID
		);
		$url='www.wkj.link/order/Cancel';
		$post=$this->createSign($parameters);
		$res=$this->httpRequest($url,$post);
		return $res;
	}
	//刷单接口
	function upOrder($Price,$Amount,$type){
		$parameters = array(
			'access_key' => $access_key,
			'method'     => 'upOrder',
			'market'     => 'wkb_cny',
			'price'      => $Price,
			'num'        => $Amount,
			'type'       => 1
		);
		$url='www.wkj.link/order/upOrder';
		$post=$this->createSign($parameters);
		$res=$this->httpRequest($url,$post);
		return $res;
	}
}
?>
<body>
</body>
</html>