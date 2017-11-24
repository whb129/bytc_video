<!DOCTYPE html>
<html>
<head>
	<title>添加在线视频</title>
	<meta charset="utf-8" />
	
	<script src="http://cdn.bootcss.com/jquery/1.10.0/jquery.min.js"></script>

</head>
<body>
	<div>
	<form>
		标题：
			<input type="text" name="title" placeholder="请输入标题" id = 'title'>
		URL：
			<input type="text" name="videoUrl" placeholder="请输入URL" id = 'videoUrl'>
            <select name="tag" id="tag">
                <option value="iframe">iframe</option>
                <option value="rtmp">rtmp</option>
                <option value="m3u8">m3u8</option>
            </select>
			<button type="button" id="submit">提交</button>
	</form>
	</div>
<div id="div"></div>

</body>

	<script type="text/javascript" language="javascript">
		
	$("#submit").click(function () {

	var title = $('#title').val(),
		videoUrl = $('#videoUrl').val(),
		tag = $('#tag option:selected') .val(),
	    url = 'insert.php';
		$.ajax({
		    url: url,
		    type: "post",
		    data: {
		    	title:title,
		        videoUrl: videoUrl,
                tag: tag
		    },
			dataType:"json",
		    success: function (data) {
		        if(data.code == 200){
		        	alert(data.msg);

		        	if (tag == 'iframe') {
                        var videoUrl="<div><span>分享地址：http://bytc.cn/videoDetail.php?id="+data.date+"</span></div>";
                    } else if (tag == 'rtmp') {
                        var videoUrl="<div><span>分享地址：http://bytc.cn/videoRtmp.php?id="+data.date+"</span></div>";
                    } else {
                        var videoUrl="<div><span>分享地址：http://bytc.cn/videoM3u8.php?id="+data.date+"</span></div>";
                    }
                    $('#div').html();
		      		$('#div').html(videoUrl);
		        }else{
		      		alert(data.msg);
		        }
		    }
		});
})

		
	</script>
</html>



