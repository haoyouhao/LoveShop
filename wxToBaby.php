<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
    html,body{ height: 100%; margin: 0; padding: 0;}
    #box{
        width: 100%;
        height: 100%;
        background: yellow;
    }
    .text{

        font-size: 80px;
        text-align: center;
    }
    </style>
</head>
<body>
<div id="box">
    <div class="text">
        欢迎操作:<br>
        《RPA+OCR互动体验》<br>
        RPA成功启动扫描仪！！
    </div>
</div>
</body>
</html>
<!-- 德成服务号跳转链接：
https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIwMDI0Nzc3OQ==&scene=124#wechat_redirect
 -->
<!-- <script type="text/javascript">
window.location.href = "https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIwMDI0Nzc3OQ==&scene=124#wechat_redirect"
</script> -->








<?php

//获取到网页授权的access_token
$appid = "wx78b20895a12fb25c";//填写公众号或服务号、测试号的appid
$secret = "5c0423adfd71834ab6bebe962d487a04";//填写对应的secriet

if(isset($_SESSION['openId'])){
    $openid = $_SESSION['openId'];
    // acGZH();
}else{
    $code = $_GET['code'];
    $url = "https://api.weixin.qq.com/sns/oauth2/access_token?grant_type=authorization_code&appid=".$appid."&secret=".$secret."&code=".$code;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HEADER,0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $res = curl_exec($ch);
    curl_close($ch);
    $json_obj = json_decode($res,true);
    $openid = $json_obj['openid'];
    $_SESSION['openId'] = $openid;
    // echo '$json_obj 返回信息：'.$res.'<br><br>';


    $url2 = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
    $ch2 = curl_init();
    curl_setopt($ch2,CURLOPT_URL,$url2);
    curl_setopt($ch2,CURLOPT_HEADER,0);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 10);
    $res2 = curl_exec($ch2);
    curl_close($ch2);
    $json_obj2 = json_decode($res2,true);
    $access_token = $json_obj2['access_token'];
    // echo '$json_obj2 返回信息：';
    // var_dump($json_obj2);
    // echo '<br><br>';
}
    // echo '微信用户：'.$openid.'<br/><br/>';
    // echo 'access_token:  '.$access_token.'<br/><br/>';


// 运行py写入文件
// $result = exec("python Wtoken.py {$openid} {$access_token}");
// var_dump($result);

//或者直接写入文件
$myfile = fopen("TOKEN.json", "w") or die("Unable to open file!");
$txt = '{"openid":"'.$openid.'","access_token":"'.$access_token.'"}';
fwrite($myfile, $txt);
fclose($myfile);

// // 运行py给用户发送消息
// $result = exec("python wxSend.py {$openid} {$access_token}");
// // var_dump($result);





?>
