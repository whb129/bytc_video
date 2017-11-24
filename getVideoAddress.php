<?php
/**
 * Created by phpstorm.
 * User: zc
 * Date: 2017/11/15
 * Time: 11:31
 */

include_once 'Db.php';

$id = isset($_POST['id'])?$_POST['id']:'';

if(!$id){
	$data = array(
		'code' => '1001',
		'msg' => '参数错误'
		);
	exit(json_encode($data));
}

$result = select('bytc_videos','where id = '.$id,'video_url');

$videoAddress = $result[0]['video_url'];

if($videoAddress){
	$data = array(
		'data' => $videoAddress,
		'code' => '200',
		);
	exit(json_encode($data));
}else{
	$data = array(
		'code' => '500',
		'msg' => '获取资源失败，请稍后在试！'
		);
	exit(json_encode($data));
}

