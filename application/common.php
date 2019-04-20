<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function Get($url, $foll = 0) {
    //初始化 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); //访问的url
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //完全静默
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //忽略https       
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //忽略https     
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5376e Safari/8536.25"]); //UA
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $foll); //默认为$foll=0
    $output = curl_exec($ch); //获取内容
    curl_close($ch); //关闭
    return $output; //返回
}