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
        .help{
            margin-left: 20px;
        }
        h4{
            color: #a30300;
            padding: 0 20px;
        }
        em{
            float: right;
            font-size: 12px;
            line-height: 20px;
            padding-right: 10px;
            font-style: normal
        }
        .list li,.article li{
            font-size: 14px;
            line-height: 220%;
            text-align: right;
        }
        .list li a,.article li a{
            float: left;
            color: #000;
        }
        .c-date{
            font-size: 12px;
            color: #666;
            font-style: normal
        }
        .article{
            background-image: url("images/p3_01.gif");
            -webkit-background-size: 100% 100%;
            background-size: 100% 35px;
            background-repeat: no-repeat;
        }
        .article-left,.article-right{
            width: 50%;
            float: left;
        }
    </style>
</head>
<body>
<?php include 'header.php';?>

<div class="container">
    <?php include 'user.php';?>
    <div class="row">
        <div class="content col-md-8">
            <a class="help" href="">
                <img src="images/registhelp.jpg" alt="">
            </a>
            <div class="list">
                <h4>
                    <b>最新公告</b>
                </h4>
                <ul>
                    <?php foreach ($all as $row){?>
                    <li>
                        <a href="welcome/detail?c_id=<?php echo $row['c_id']; ?>&a_id=<?php echo $row['a_id']; ?>"><?php echo $row['title'];?></a>
                        <i class="c-date"> [ <?php $arrRow = explode(" ", $row['date']);echo $arrRow[0]?> ] </i>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
        <?php include 'nav.php';?>
        <div class="article col-md-12">
            <div class="article-left">
                <h4>
                    <b>考试新闻</b>
                    <em><a href="welcome/news">更多>></a></em>
                </h4>
                <ul>
                    <?php foreach ($news as $row){?>
                    <li>
                        <a href="welcome/detail?c_id=1&a_id=<?php echo $row['a_id']; ?>"><?php echo $row['title'];?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="article-right">
                <h4>
                    <b>考试信息</b>
                    <em><a href="welcome/information">更多>></a></em>
                </h4>
                <ul>
                    <?php foreach ($info as $row){?>
                        <li>
                            <a href="welcome/detail?c_id=2&a_id=<?php echo $row['a_id']; ?>"><?php echo $row['title'];?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
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