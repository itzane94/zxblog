<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="shortcut icon" href="/home/images/favicon.ico" type="image/x-icon" />
    <title>itzane | 回声广场</title>
    <link href="/home/css/wall.css" rel="stylesheet">
</head>
<body>
<div id="container" class="container">
    <div id="infoboard">
        总访问量：<span id="totalV"></span> <br/>
        当前在线：<span id="online"></span> <br/>
        总留言量：<span id="totalM"></span> <br/>
    </div>
</div>
<div class="input-box">
    <!--限制用户输入的文字长度，尽量避免用户输入的内容长度超过屏幕的宽度-->
    <input type="text" maxlength="20" placeholder="say something~">
    <button id="btn" class="btn">发送</button>
</div>
<script src="/home/js/jquery-1.10.2.min.js"></script>
<script src="/home/js/barrageWall.js"></script>
<script>
    $(function () {
        //////////////////////////////////////////////////////////////////////
        ////////////////// 注意：请尽量少的使用js去处理css样式！//////////////////
        ///////////////// 尤其是当用户量大时，页面的性能的尤为重要 ////////////////
        ///////////////// 所以，请将你需要的各种动效交个css去实现 ////////////////
        ////////////////////// 注意页面重绘带来的性能影响 //////////////////////
        ////////////////////////////////////////////////////////////////////
        var option={
            container:"#container",//弹幕墙的id
            barrageLen:15//弹幕的行数
        }
        barrageWall.init(option);//初始化弹幕墙

        //初始化ws
        var wsServer = "ws://140.143.196.31:9502";
        websocket = new WebSocket(wsServer);
        websocket.onopen = function(evt){
            //console.log(websocket.readyState+' websocket service established...');
        }
        //监听返回结果
        websocket.onmessage = function (evt){
            var data = JSON.parse(evt.data);
            if(data['online']){
                $('#totalV').text(data['totalV']);
                $('#online').text(data['online']);
                $('#totalM').text(data['totalM']);
                return;
            }
            for(var i in data){
                var j = 0;
                setTimeout(function(){
                    //barrageWall.upWall("images/aq.png","我是说话人",data[i]);//初始化弹幕墙
                    barrageWall.upWall(data[j]['id'],data[j]['grava'],data[j]['message']);//初始化弹幕墙
                    j++;
                },i*1000 );
            }
        }
        //////////////////////////////////////////////////////////////////////
        /////// 实际调用时必须设置你的 弹幕墙id 和 弹幕的行数 并 初始化弹幕墙，///////
        // 然后调用 barrageWall.upWall("用户头像url","用户昵称","用户输入的内容")//
        /////////////////////////////////////////////////////////////////////

        //barrageWall.upWall("images/aq.png","我是说话人","我说的话");//初始化弹幕墙

        //////////////////////////////////////////////////////////////////////
        ////////// 以下注释掉的部分为测试弹幕效果的各种定时器，模拟用户输入 //////////
        //////////////////////////////////////////////////////////////////////

        // var num=0,timer =setInterval(function(){
        //     num++;
        //     if(num>50){clearInterval(timer)}
        //     barrageWall.upWall("images/aq.png","我是说话人"+num,"我说的我说的话我说的话我说的话我说的话我说的话话");
        // },500);

    });
    $("#btn").click(function () {
        ////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////// 注意：///////////////////////////////////////////
        // 1，一定要限制用户输入的文字长度，尽量避免用户输入的内容长度超过屏幕的宽度/////////////////////////
        // 2，如果不需要用户的头像和id，可以在js中去掉 elem 的img标签和用户名，本人因项目需要，所以就保留了 //
        // 3，实际使用时，最少应该加上 特殊字符替换 和 发送成功后清除input的内容，现在 你就当我懒吧~/////////
        /////////////////////////////////////////////////////////////////////////////////////////
        var vla=$(this).prev().val().replace(/(^\s*)|(\s*$)/g, "");
        if(vla){
            websocket.send(vla);
            //barrageWall.upWall("images/aq.png","我是说话人",vla);//初始化弹幕墙
        }
        var vla=$("#btn").prev().val('');
    });
</script>
</body>
</html>

