<!DOCTYPE html>
<html lang="en">
<head>

    <title>m3u8播放</title>
    <!-- <link href="video-js-6.2.0/video-js.css" rel="stylesheet">
    <script src="video-js-6.2.0/videojs-ie8.min.js"></script> -->

    <script src="http://cdn.bootcss.com/jquery/1.10.0/jquery.min.js"></script>


</head>
<body>

<video id="video"></video>

<script src="https://cdn.jsdelivr.net/hls.js/latest/hls.min.js"></script>

</body>

<script>

    $(function () {

        var id = getUrlParam('id');
        url = 'getVideoAddress.php';
        $.ajax({
            url: url,
            type: "post",
            data: {
                id:id
            },
            dataType:"json",
            success: function (data) {
                if(data.code == 200){
                    console.log(data.data);
                    if(Hls.isSupported()) {
                        var video = document.getElementById('video');
                        var hls = new Hls();
                        hls.loadSource(data.data);
                        hls.attachMedia(video);
                        hls.on(Hls.Events.MANIFEST_PARSED,function() {
                            video.play();
                        });
                    }
                }else{
                    alert(data.msg);
                }
            }
        });
    })

    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg); //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
    }

</script>

</html>
