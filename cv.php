<?php
public static $appid='wxb26d9c5e3ce6b971';
public static $secret='7d067012ed03fe02dd08e926db79bc44';
 
public function test()
{
    $params=Request::instance()->param();
    $url="https://api.weixin.qq.com/sns/jscode2session?appid=".self::$appid."&secret=".self::$secret."&js_code=".$params['code']."&grant_type=authorization_code";
    $data=$this->doCurl($url);
    $info['openid']=$data->openid;　　//获取到用户的openid
    $info['avatar']=$params['avatarUrl'];
    $info['province']=$params['province'];
    $info['city']=$params['city'];
    $info['nickName']=$params['nickName'];
    return json(['status'=>1]);
}
 
 
public function doCurl($url)
{
    $curl = curl_init();
    // 使用curl_setopt()设置要获取的URL地址
    curl_setopt($curl, CURLOPT_URL, $url);
    // 设置是否输出header
    curl_setopt($curl, CURLOPT_HEADER, false);
    // 设置是否输出结果
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // 设置是否检查服务器端的证书
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // 使用curl_exec()将CURL返回的结果转换成正常数据并保存到一个变量
    $data = curl_exec($curl);
    // 使用 curl_close() 关闭CURL会话
    curl_close($curl);
    return json_decode($data);
}
?>