<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <base href="<?php echo site_url() ;?>">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .article{
            border: #f6dac4 1px solid;
            border-top: #b90300 3px solid;
            text-align: center;
            padding: 10px 40px;
            margin-bottom: 20px;
        }
        .title{
            margin:0;
            padding: 0 20px;
            background: url("images/dian.gif") 12px 12px no-repeat #fef9f5;
            height: 35px;
            border-top: #b90300 3px solid;
            padding-left: 26px;
            color: #a70500;
            line-height: 35px;
        }
        h4 a{
            color: #a70500;
        }
        .text{
            text-align: left;
        }
    </style>
</head>
<body>
<?php include 'header.php';?>

<div class="container">
    <?php include 'user.php';?>
    <div class="row">
        <div class="content col-md-8">
            <h4 class="title">
                <?php $cid = $_GET['c_id']; if($cid==1){;?>
                <a href="welcome/news"><b>考试新闻</b></a>
                <?php }else{ ;?>
                    <a href="welcome/information"><b>考试信息</b></a>
                <?php };?>
            </h4>
            <div class="article">
                <div class="text_con">
                    <?php foreach ($article as  $row){?>
                    <h3 id="p_title"><?php echo $row['title']?></h3>
                    <h4 class="sub"></h4>
                    <p class="sou mb10 author"></p>
                    <h5><i id="p_publishtime"><?php echo $row['date']?></i>&nbsp;&nbsp;&nbsp;&nbsp;<i id="p_origin"></i>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.people.com.cn/GB/123231/365208/index.html" target="_blank">手机看新闻</a></h5>
                        <?php echo $row['content']?>
                    <?php }?>
                </div>
            </div>
        </div>
        <?php include 'nav.php';?>
    </div>
</div>
<?php include 'footer.php';?>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/vue.js"></script>
<script>
    var vm =new Vue({
        el:'.container',
        methods:{
            cancel:function () {
                //注销登录 到控制台 welcome下 unlogin方法
                $.post('welcome/unlogin',function (data) {
                    if(data=='yes'){
                        location='welcome/index'
                    }
                },'text');
            }
        }
    })
</script>
</body>
</html>