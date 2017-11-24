<!DOCTYPE html>
<html>
<head>
	<title>视频播放</title>
	<meta charset="utf-8" />
	<meta name="referrer" content="never">

	<script src="http://cdn.bootcss.com/jquery/1.10.0/jquery.min.js"></script>

</head>
<body>

    <div id="video">

    </div>

</body>

	<script type="text/javascript" language="javascript">

	$(function () {

        var id = getUrlParam('id');
        url = 'getVideoAddress.php';
        $.ajax({
            url: url,
            type: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function (data) {
                if (data.code == 200) {
                    console.log(data.data);
                    $('#video').html(data.data);
                } else {
                    alert(data.msg);
                }
            }
        });
//$(document).ready(function(){
//
//    $('#video-player').find('div').eq(0).css('display','none')
//})
//        window.onload = function(){
//            setTimeout(test,20000);//1000毫秒=1秒后执行test方法
//        };
//
//
//});

//    function test() {
//
//        $('#video-player').children("div").eq(0).css('display','none')
//
//
//        $('#video-player').children("div").eq(0).html('');
//        console.log( $('#video-player').children("div").eq(0).html())
//        alert(1);
//    }
//
//
        function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg); //匹配目标参数
            if (r != null) return unescape(r[2]);
            return null; //返回参数值
        }
    });
//

	</script>
</html>



