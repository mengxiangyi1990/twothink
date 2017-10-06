<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy\WWW\twothink\public/../application/home/view/default/repair\repair.html";i:1506761419;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>添加报修</title>

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="/cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .main{margin-bottom: 60px;}
        .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
        #re{float:right;}
    </style>
</head>
<body>
<div class="main">
    <!--导航部分-->
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid text-center">
            <div class="col-xs-3">
                <p class="navbar-text"><a href="index.html" class="navbar-link">首页</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">服务</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">发现</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">我的</a></p>
            </div>
        </div>
    </nav>
    <!--导航结束-->

    <div class="container-fluid">
        <form action="<?php echo url(); ?>" method="post" class="form-horizontal">

            <div class="form-item">
                <label>您的姓名:</label>
                <input type="text" class="form-control"  placeholder="请输入用户名(必填)"  ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写真实姓名" nullmsg="请填写用户名" datatype="*1-16" value="" name="name"/>
            </div>

            <div class="form-item">
                <label>您的电话:</label>
                <div class="form-item">
                    <input type="text" id="inputPassword" class="form-control" placeholder="请填写电话号码(必填)"  errormsg="请填写正确的电话号码" nullmsg="请填写电话号码" datatype="*5-5" name="tel">
                </div>
            </div>
            <div class="form-item">
                <label class="item-label">地址</label>
                <div class="controls">
                    <input type="text" class="form-control" name="address" placeholder="请输入详细地址(必填)"  value="<?php echo (isset($info['address']) && ($info['address'] !== '')?$info['address']:''); ?>">
                </div>
            </div>
            <div class="form-item">
                <label class="item-label">简述问题</label>
                <div class="controls">
                    <input type="text" class="form-control" name="title" placeholder="请简单填写问题描述(必填)"  value="<?php echo (isset($info['title']) && ($info['title'] !== '')?$info['title']:''); ?>">
                </div>
            </div>
            <div class="form-item">
                <label class="item-label">内容</label>
                <div class="controls">
                    <textarea  name="content" class="form-control textarea input-large" rows="5" placeholder="请填写问题详情(必填)" ><?php echo $info['content']; ?></textarea>
                </div>
            </div>
            <!--<div class="form-item">-->
                <!--<label>验证码</label>-->
                <!--<div class="form-item">-->
                    <!--<input type="text" id="inputPassword" class="form-control" placeholder="请输入验证码"  errormsg="请填写5位验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="form-item">-->
                <!--<label class="control-label"></label>-->
                <!--<div class="controls verifyimg">-->
                    <!--<?php echo captcha_img(); ?>-->
                <!--</div>-->
                <!--<div class="controls Validform_checktip text-warning"></div>-->
            <!--</div>-->

            <div class="form-item">
                <input type="hidden" name="id" value="<?php echo (isset($info['id']) && ($info['id'] !== '')?$info['id']:''); ?>">
                <button class="btn btn-primary onlineBtn" id="submit" type="submit" target-form="form-horizontal">确 定</button>
            </div>
        </form>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
 

<script type="text/javascript">
    $(document)
        .ajaxStart(function(){
            $("button:submit").addClass("log-in").attr("disabled", true);
        })
        .ajaxStop(function(){
            $("button:submit").removeClass("log-in").attr("disabled", false);
        });
//    $("form").submit(function(){
//        var self = $(this);
//        $.post(self.attr("action"), self.serialize(), success, "json");
//        return false;
//        function success(data){
//            if(data.code){
//                window.location.href = data.url;
//            } else {
//                self.find(".Validform_checktip").text(data.msg);
//                //刷新验证码
//                $(".verifyimg img").click();
//            }
//        }
//    });
    $(function(){
        //刷新验证码
        var verifyimg = $(".verifyimg img").attr("src");
        $(".verifyimg img").click(function(){
            if( verifyimg.indexOf('?')>0){
                $(".verifyimg img").attr("src", verifyimg+'&random='+Math.random());
            }else{
                $(".verifyimg img").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
        });
    });
</script>
