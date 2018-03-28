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
            position: relative;
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
        .table-responsive{
            margin-top:20px;
        }
        table td[class*="col-"]{
            position: relative;
        }
        table img{
            width: 100%;
        }
        em{
            position: absolute;
            font-size: 12px;
            line-height: 20px;
            padding-right: 10px;
            font-style: normal;
            right: 0;
            bottom: 0;
            cursor: pointer;
        }
        .btn1,.btn2{
            width:45%;
            float: left;
        }
        .btn1{
            margin-right: 45px;
        }
        .f_input{
            width:100%;
        }
        .err1 {
            position: absolute;
            color: #a94442;
            right: 0;
            top: 50%;
        }
        .err2{
            color: #a94442;
        }
        .yellow{
            color: #eb9316;
        }
        .red{
            background: #b92c28;
            color: #ffffff;
        }
        .green{
            background: #3e8f3e;
            color: #ffffff;
        }
        .blue{
            color: #245580;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php include 'header.php';?>

<div class="container">
    <?php include 'user.php';?>
    <div class="row">
        <div class="content col-md-8">
            <h4>
                <b>考生管理</b>
            </h4>
            <div class="table-responsive">
                <table class="table table-striped">
                   <tr>
                       <th></th>
                       <th>科目</th>
                       <th>操作</th>
                   </tr>
                    <?php foreach ($res as $row){ ?>
                    <tr>
                        <td></td>
                        <td ><?php echo $row['s_name'];?></td>
                        <td class="blue" ><a href="welcome/print_page?sname=<?php echo $row['s_name'];?>&id=<?php echo $row['id']?>">查看</a></td>
                    </tr>
                    <?php } ;?>
                </table>
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