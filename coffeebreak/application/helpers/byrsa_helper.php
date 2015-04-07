<?php 
//rsa认证
function auth_byrsa($usr,$pwd)
{
    // 初始化
    $ch = curl_init();

    // 设置返回值，访问url
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, "http://10.21.5.30/byrsa?usr=".$usr."&pwd=".$pwd);

    // 执行
    $result = curl_exec($ch);
    
    // 关闭
    curl_close($ch);

    return $result;
}
 ?>