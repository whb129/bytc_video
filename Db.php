<?php

function pub(){
//链接数据库
	@mysql_connect('127.0.0.1','root','root');
//判断链接是否正确
	if (mysql_errno()) {
  	die(mysql_error());
	}
//选择数据库
	mysql_select_db('bytc');
//设置字符集
	mysql_set_charset('utf-8');
}



//select
function select($table,$where='',$field='*'){
	pub();
//准备SQL语句
$sql = "select {$field} from {$table} {$where}";
// var_dump($sql);
//发送SQL语句
$res = mysql_query($sql);
//设置空数组
$return = [];
//处理数据集  将所查询到的数组循环输出到设置数组中  组成多维数组
if($res){
	while ($row = mysql_fetch_assoc($res)){
		$return [] = $row;
	}
}


//释放资源并关闭数据库
    @mysql_free_result($res);
    mysql_close();

//返回多维数组
return $return;

}	



function sele($sql=''){
pub();
$res = mysql_query("$sql");
$return = [];
//处理数据集  将所查询到的数组循环输出到设置数组中  组成多维数组
while ($row = mysql_fetch_assoc($res)){ 
	$return [] = $row;
}


    //释放资源并关闭数据库
    mysql_free_result($res);
    mysql_close();

    //返回多维数组

    return $return;

}


//insert
function add($table,$post){
	pub();
//将post接收到的值（数组），分别所有的键和值用','分割为字符串
$fields = implode('`,`', array_keys($post));
$values = implode("','", array_values($post));
//准备SQL语句
$sql = "insert into {$table}(`" . $fields . "`) values('" . $values . "')";
$sql2 = 'select last_insert_id() as insertId';//执行插入后，马上执行这个sql，获取最后一条出入记录的id
//发送SQL语句
$res = mysql_query($sql);
$res = mysql_query($sql2);
mysql_close();
$id= mysql_fetch_assoc($res);
// var_dump($id);die;
return $id;
}


//发送sql
function addSql($sql){
    pub();

//发送SQL语句
    $res = @mysql_query($sql);
    $num = mysql_affected_rows();
//    if($num != 1){
//        file_put_contents("../log/sql.txt", $sql . PHP_EOL,FILE_APPEND);
//    }

    //关闭数据库
    mysql_close();
    if($num < 1){
        $num = 0;
    }
    return $num;
}

//curlPost
function curlPost($url, $data,$type = 0 ){
    $ch = curl_init();

    $header= array(
        'Content-Type: application/json',
    );

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    if($type) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $tmpInfo = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close( $ch );
        return $ch;

    }else{
        curl_close( $ch );
        return $tmpInfo;
    }
}


/*
 * @curlGet 请求
 */
function curlGet($url){
    $ch = curl_init();

    $header[]='host:www.meipai.com';
    $useragent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36';
//    $referer    = 'https://www.ixigua.com/';

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//    curl_setopt($ch, CURLOPT_REFERER, $referer);  //模拟来源网址
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent); //模拟常用浏览器的useragent
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL, $url);

    $tmpInfo = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close( $ch );
        return $ch;

    }else{
        curl_close( $ch );
        return $tmpInfo;
    }
}


//格式化秒钟
function dataformat($num)
{
    $hour = floor($num / 3600);
    $minute = floor(($num - 3600 * $hour) / 60);
    $second = floor((($num - 3600 * $hour) - 60 * $minute) % 60);

    if($minute){
        if($minute < 10){
            $minute = '0'.$minute;
        }
    }else{
        $minute = '00';
    }

    if($second < 10){
        $second = '0'.$second;
    }

    if($hour){
        return $hour.':'.$minute.':'.$second;
    }else{
        return $minute.':'.$second;
    }
}



//美拍视频播放地址解析
function getAddr($base64){

    $str = substr($base64,4);//去除前4位
    $hex = strrev(substr($base64,0,4));//前4位倒序
    $str16 = intval($hex,16);//前4位倒序后转为16进制数字
    $pre = substr($str16,0,2);
    $tail = substr($str16,2);

    //分割为数组
    $pre = preg_split("//u", $pre, -1, PREG_SPLIT_NO_EMPTY);
    $tail = preg_split("//u", $tail, -1, PREG_SPLIT_NO_EMPTY);

    $s = substr($str,0,$pre[0]);
    $del = substr($str,$pre[0],$pre[1]);
    $del = '`'. preg_quote($del, '`'). '`';
    $d = $s.preg_replace($del,'',substr($str,$pre[0]),1);//正则匹配替换第一个

    $tmp = array(strlen($d) - $tail[0] - $tail[1],$tail[1]);

    $s = substr($d,0,$tmp[0]);
    $del = substr($d,$tmp[0],$tmp[1]);
    $del = '`'. preg_quote($del, '`'). '`';

    //重新组合base64密文
    $base64 = $s.preg_replace($del,'',substr($d,$tmp[0]),1);
    //解码
    return base64_decode($base64);
}

/*
 * 生成UUID
 */
function create_uuid($prefix = ""){    //可以指定前缀
    $str = md5(uniqid(mt_rand(), true));
    $uuid  = substr($str,0,8) . '-';
    $uuid .= substr($str,8,4) . '-';
    $uuid .= substr($str,12,4) . '-';
    $uuid .= substr($str,16,4) . '-';
    $uuid .= substr($str,20,12);
    return $prefix . $uuid;
}

