<!DOCTYPE html>
<html lang="en">
<head>

    <title>rtmp播放</title>
    <!-- <link href="video-js-6.2.0/video-js.css" rel="stylesheet">
    <script src="video-js-6.2.0/videojs-ie8.min.js"></script> -->

    <link href="http://vjs.zencdn.net/5.20.1/video-js.css" rel="stylesheet">
    <script src="videojs-ie8.min.js"></script>
    <script src="http://cdn.bootcss.com/jquery/1.10.0/jquery.min.js"></script>


</head>
<body>

<video id="example_video_1" class="video-js vjs-default-skin" controls preload="auto" width="1280" height="720" poster="http://vjs.zencdn.net/v/oceans.png" data-setup="{}">
<!--    <source src="rtmp://192.168.1.12:1935/live/720.stream" type="rtmp/flv">-->
    <source src="rtmp://stream-ws1.csslcloud.net/src/BDB7C650E1EB78819C33DC5901307667&type=rtmp" type="rtmp/flv" id="">

    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
</video>

<script src="http://vjs.zencdn.net/5.20.1/video.js"></script>
</body>

<script type="text/javascript" language="javascript">

//    $(function () {
//
//        var id = getUrlParam('id');
//        url = 'getVideoAddress.php';
//        $.ajax({
//            url: url,
//            type: "post",
//            data: {
//                id:id
//            },
//            dataType:"json",
//            success: function (data) {
//                if(data.code == 200){
//                    console.log(data.data);
//                    $('#video').attr('src',data.data);
//                }else{
//                    alert(data.msg);
//                }
//            }
//        });
//    })
//
//    function getUrlParam(name) {
//        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
//        var r = window.location.search.substr(1).match(reg); //匹配目标参数
//        if (r != null) return unescape(r[2]); return null; //返回参数值
//    }


</script>

</html>