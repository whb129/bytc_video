<!DOCTYPE html>
<html>
<head>
    <title>videojs支持hls直播实例</title>
    <link href="./dist/video-js.css" rel="stylesheet">
</head>
<body>

<video id="roomVideo" class="video-js vjs-default-skin vjs-big-play-centered" x-webkit-airplay="allow" poster="" webkit-playsinline playsinline x5-video-player-type="h5" x5-video-player-fullscreen="true" preload="auto">
    <source src="http://www.streambox.fr/playlists/test_001/stream.m3u8"  type="application/x-mpegURL">
</video>

<script src="./dist/video.js"></script>
<!--<script src="./videojs-contrib-hls.js?v=c726b94b9923"></script>-->
<script src="https://cdn.bootcss.com/videojs-contrib-hls/5.10.0/videojs-contrib-hls.js"></script>

<script type="text/javascript">
    var myPlayer = videojs('roomVideo',{
        bigPlayButton : false,
        textTrackDisplay : false,
        posterImage: true,
        errorDisplay : false,
        controlBar : false
    },function(){
        console.log(this)
        this.on('loadedmetadata',function(){
            console.log('loadedmetadata');
            //加载到元数据后开始播放视频
            startVideo();
        })

        this.on('ended',function(){
            console.log('ended')
        })
        this.on('firstplay',function(){
            console.log('firstplay')
        })
        this.on('loadstart',function(){
            //开始加载
            console.log('loadstart')
        })
        this.on('loadeddata',function(){
            console.log('loadeddata')
        })
        this.on('seeking',function(){
            //正在去拿视频流的路上
            console.log('seeking')
        })
        this.on('seeked',function(){
            //已经拿到视频流,可以播放
            console.log('seeked')
        })
        this.on('waiting',function(){
            console.log('waiting')
        })
        this.on('pause',function(){
            console.log('pause')
        })
        this.on('play',function(){
            console.log('play')
        })

    });

    var isVideoBreak;
    function startVideo() {

        myPlayer.play();

        //微信内全屏支持
        document.getElementById('roomVideo').style.width = window.screen.width + "px";
        document.getElementById('roomVideo').style.height = window.screen.height + "px";


        //判断开始播放视频，移除高斯模糊等待层
        var isVideoPlaying = setInterval(function(){
            var currentTime = myPlayer.currentTime();
            if(currentTime > 0){
                $('.vjs-poster').remove();
                clearInterval(isVideoPlaying);
            }
        },200)

        //判断视频是否卡住，卡主3s重新load视频
        var lastTime = -1,
            tryTimes = 0;

        clearInterval(isVideoBreak);
        isVideoBreak = setInterval(function(){
            var currentTime = myPlayer.currentTime();
            console.log('currentTime'+currentTime+'lastTime'+lastTime);

            if(currentTime == lastTime){
                //此时视频已卡主3s
                //设置当前播放时间为超时时间，此时videojs会在play()后把currentTime设置为0
                myPlayer.currentTime(currentTime+10000);
                myPlayer.play();

                //尝试5次播放后，如仍未播放成功提示刷新
                if(++tryTimes > 5){
                    alert('您的网速有点慢，刷新下试试');
                    tryTimes = 0;
                }
            }else{
                lastTime = currentTime;
                tryTimes = 0;
            }
        },3000)

    }
</script>

</body>
</html>