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
        h4{
            margin:0;
            padding: 0 20px;
            background: url("images/dian.gif") 12px 12px no-repeat #fef9f5;
            height: 35px;
            border-top: #b90300 3px solid;
            padding-left: 26px;
            color: #a70500;
            line-height: 35px;
        }
        .title{
            padding: 10px 25px;
            border: #f6dac4 1px solid;
        }
        .title a{
            color:#6b0e00;
            font-size: 14px;
            line-height: 220%;
        }
        .page{
            list-style: none;
            overflow: hidden;
        }
        .page li{
            float: left;
            margin: 0 5px;
        }
    </style>
</head>
<body>
<?php include 'header.php';?>

<div class="container">
    <?php include 'user.php';?>
    <div class="row">
        <div class="content col-md-8">
            <div class="list">
                <h4>
                    <b>考试新闻</b>
                </h4>
                <ul class="title">
                    <?php foreach ($list as $row){ ?>
                        <li>
                            <a href="welcome/detail?c_id=1&a_id=<?php echo $row->a_id; ?>"><?php echo $row->title;?></a>
                        </li>
                    <?php } ?>
                </ul>
                <?php echo $links?>
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