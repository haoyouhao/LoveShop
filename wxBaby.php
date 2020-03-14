<?php
function getBaseInfo(){

	$appid = "wx78b20895a12fb25c";
	$redirect_uri = urlencode("http://192.168.2.161/MyWeb/wxToShow/wxToBaby.php");
	$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=123#wechat_redirect";
	header('location:'.$url);
}
getBaseInfo();
?>