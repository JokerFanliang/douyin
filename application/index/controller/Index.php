<?php
namespace app\index\controller;

use app\model\UserModel;

class Index
{
    public function index()
    {
		$ip = $_SERVER['REMOTE_ADDR'];
		$user=new UserModel();
		$user->ip=$ip;
		$user->created_at=date("Y-m-d H:i:s");
		$user->updated_at=date("Y-m-d H:i:s");
		$user->save();
        return view();
    }

    public function user(){
    	$users=UserModel::select();
    	return view("",compact('users'));
    }

    public function del(){
    	if (!empty($_GET['url'])) {
		    $url = $_GET['url'];
		    $str = GET($url, 1);
		    preg_match("/video_id=(.*?)&/i", $str, $arr);
		    if (count($arr) >= 1) {
		        $str = GET("https://aweme.snssdk.com/aweme/v1/play/?video_id=".$arr[1]."&line=0", 0);
		        preg_match('#<a href="(.*?)">#', $str, $arr2);
		        if (count($arr2) >= 1) {
		            $arr3 = explode("//", $arr2[1]);//把http替换成https就能完美解决
		            if (!empty($arr3)) {
		                //header("content-type:video/mp4");
		                //header("Location: "."https://".$arr3[1]);
		                if (!empty($_GET['way']) && $_GET['way'] == "txt") { //纯文本输出        
		                    exit("https://".$arr3[1]);
		                }
		                elseif(!empty($_GET['way']) && $_GET['way'] == "json") { //json文本输出
		                    $aray = ['code' =>200, 'msg' =>'success', 'url' =>"https://".$arr3[1]];
		                    exit(json_encode($aray, false));
		                } else { //跳转到改地址播放
		                    //header("Location: "."https://".$arr3[1]);
		                    $video_url="https://".$arr3[1];
		                    return json(["video_url"=>$video_url,'msg'=>"解析成功",'code' =>200,]);
		                }

		            }

		        }
		    }

		} else {
		    return json(["video_url"=>"",'msg'=>"请输入参数"]);
		}
    }
}
