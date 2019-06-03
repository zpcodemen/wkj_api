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
    //加密参数数组。返回加密字符串。
	function createSign($pParams = array()){    
		$tPreSign  = http_build_query($pParams, '', '&');
		$SecretKey = sha1($this->secret_key);
		$tSign     = hash_hmac('md5',$tPreSign,$SecretKey);
		$pParams['sign']    = $tSign;
		$pParams['reqTime'] = time()*1000;
		$tResult            = http_build_query($pParams, '', '&');
		return $tResult;
	}
    
	//委托下单
	function  Trade($Price,$Amount,$type){				  
		$parameters=array(
			'access_key' => $access_key,
			'method'     => 'upTrade',
			'market'     => 'wkb_bitcny',
			'price'      => $Price,
			'num'        => $Amount,
			'type'       => $type
		);
		$url = "http://www.wkj.link/order/upTrade";
		$post=$this->createSign($parameters);
		$res =$this->httpRequest($url,$post);
		return $res;
	}
	//取消委托
	function Cancel($OrderID){
		$parameters=array(
			'access_key' => $access_key,
			'method'     => 'Cancel',
			'market'     => 'wkb_bitcny',
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
			'market'     => 'wkb_bitcny',
			'price'      => $Price,
			'num'        => $Amount,
			'type'       => $type
		);
		$url='www.wkj.link/order/upOrder';
		$post=$this->createSign($parameters);
		$res=$this->httpRequest($url,$post);
		return $res;
	}
	//订单状态查询接口
	function getTradeStatus($OrderID,$market){
		$parameters = array(
			'access_key' => $access_key,
			'method'     => 'getTradeStatus',
			'market'     => $market,
			'trade_num'  => $OrderID
		);
		$url='www.wkj.link/order/getTradeStatus';
		$post=$this->createSign($parameters);
		$res =$this->httpRequest($url,$post);
		return $res;
	}
	//查询币种余额
	function getBalance($coin){
		$parameters = array(
			'access_key' => $access_key,
			'method'     => 'getBalance',
			'coin'        => $coin
		);
		$url='www.wkj.link/order/getBalance';
		$post=$this->createSign($parameters);
		$res =$this->httpRequest($url,$post);
		return $res;
	}
	//查询市场订单状态(三天内)
	function getOrderStatus($market,$status){
		$parameters = array(
			'access_key' => $access_key,
			'method'     => 'getOrderStatus',
			'market'     => $market,
			'status'     => $status            //订单状态
		);
		$url='www.wkj.link/order/getOrderStatus';
		$post=$this->createSign($parameters);
		$res =$this->httpRequest($url,$post);
		return $res;
	}
	//自动转出币接口
	function getOrderStatus($market,$status){
		$parameters   =  array(
			'access_key'      => $access_key,
			'method'          => 'rollOut',
			'coin'            => 'wkb',
			'num'             => 12,      
			'paypassword'     => '123456',
			'addr'            => "ssssssssss", //转出地址
			'xrp_tag'         => '',           //tag标签  	
		);
		$url='www.wkj.link/order/rollOut';
		$post=$this->createSign($parameters);
		$res =$this->httpRequest($url,$post);
		return $res;
	}
	//批量撤销挂单
	function cancelAll($host,$access_key,$secret_key){
		$url_cancle      = 'www.wkj.link/order/cancelAll';
		$param_cancel    = array(
			'access_key' => $access_key,
			'method'     => 'cancelAll',
			'market'     => 'wkb_bitcny',
			'type'       => 1
		);
		$arr_api   = createSign($param_cancel,$secret_key);
		$data      = postCurl($url_cancle,$arr_api);
		return $data;
    }
}
?>
<body>
</body>
</html>