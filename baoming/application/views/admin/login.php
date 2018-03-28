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
        .content{
            margin-top: 60px;
        }
        h3{
            text-align: center;
            color: #a30300;
        }
        .btn1{
            width:100%;
        }
    </style>
</head>
<body>
<?php include 'header.php';?>
<div class="container">
    <div class="row">
        <div class="content col-md-offset-3 col-md-6">
            <h3>
                管理员登录
            </h3>
            <input class="form-control" type="text" v-model="uname" placeholder="帐号">
            <br/>
            <input class="form-control" type="password" v-model="password" placeholder="密码" @keyup.enter="check">

            <br/>
            <button class="btn1" @click="check">登录</button>

        </div>
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
            check:function (){
                    //到控制台admin下的check_login方法验证帐号密码
                    $.post('admin/check_login',{uname:this.uname,pwd:this.password},function (data) {
                        if(data != 'yes'){
                            alert('帐号或密码有误，请确认帐号和密码')
                        }else{
                            location='admin/manage'
                        }
                    },'text')
            }
        }
    })
</script>
</body>
</html>