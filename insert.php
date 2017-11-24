<?php
/**
 * Created by phpstorm.
 * User: zc
 * Date: 2017/11/15
 * Time: 11:31
 */

include_once 'Db.php';

$title = isset($_POST['title'])?$_POST['title']:'';
$video_url = isset($_POST['videoUrl'])?$_POST['videoUrl']:'';
$tag = isset($_POST['tag'])?$_POST['tag']:'';


if(!$title){
	$data = array(
		'code' => '1001',
		'msg' => '标题不能为空'
		);
	exit(json_encode($data));
}

if(!$video_url){
	$data = array(
		'code' => '1002',
		'msg' => 'URL不能为空'
		);
	exit(json_encode($data));
}

if(!$tag){
    $data = array(
        'code' => '1003',
        'msg' => '资源类型不能为空'
    );
    exit(json_encode($data));
}

//$video_url = str_replace('width="100%"','width="800px"',$video_url);
//$video_url = str_replace('height="100%"','height="550px"',$video_url);

$post = array(
	'title' => $title,
	'video_url' => $video_url,
	'tag' => $tag,
	'create_time' => date('Y-m-d H:i:s',time())
	);

$id = add('bytc_videos',$post);

if($id){
	$data = array(
		'date' => $id['insertId'],
		'code' => '200',
		'msg' => '添加成功！'
		);
	exit(json_encode($data));
}else{
	$data = array(
		'code' => '500',
		'msg' => '添加失败，请稍后在试！'
		);
	exit(json_encode($data));
}

