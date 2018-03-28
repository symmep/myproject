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
        h3{
            text-align: center;
            color: #a30300;
        }
        .nav{
            margin-top: 200px;
        }
        .nav li{
            width: 45%;
            height: 80px;
            float: left;
        }
        .nav li a{
            height: 80px;
            text-decoration: none;
            display: inline-block;
            padding:0 0 0 85px;
            font-size: 40px;
            text-align: center;
            line-height: 80px;
        }
        .nav .a2{
            float: right;
        }
    </style>
</head>
<body>
<?php include 'header.php';?>
<div class="container">
    <?php include 'user.php';?>
    <div class="row">
        <ul class="nav col-md-8 col-md-offset-2">
                <li class="a1">
                    <a href="admin/personal">用户管理</a>
                </li>
                <li class="a2">
                    <a href="admin/exam">考生管理</a>
                </li>
            </ul>
    </div>
</div>
<?php include 'footer.php';?>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/vue.js"></script>
<script>
    var vm = new Vue({
        el:'.container',
        data:{
            uname:'',
            password:''
        },
        methods:{
            cancel:function () {
                //注销登录 到控制台 admin下 unlogin方法
                $.post('admin/unlogin',function (data) {
                    if(data=='yes'){
                        location='admin/index'
                    }
                },'text');
            }
        }
    })
</script>
</body>
</html>