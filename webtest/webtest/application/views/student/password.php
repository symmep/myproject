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
        .class-list{
            margin-top: 20px;
            text-align: center;
        }
        input{
            margin: 20px 0;
        }
        .btn1{
            width: 100px;
            height: 30px;
            background: #0099cc;
            color: #ffffff;
            text-align: center;
            font-size: 20px;
            line-height: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<?php include 'header.php';?>
<div class="contion">
    <?php include 's_side.php';?>
    <div id="container">
        <span id="login-state">Hi,&nbsp<?php $s_user=$this->session->userdata('s_user'); if(isset($s_user)){echo $s_user['s_name'];}?>&nbsp&nbsp<span  data-toggle="modal" data-target="#myModal">注销</span></span>
        <div class="container-fluid">
            <div class="row">
                <div class="class-list col-md-4 col-md-offset-4">
                    <h2>修改密码</h2>
                        <input class="form-control" type="password" name="password" placeholder="旧密码" v-model="pwd_old">
                        <input class="form-control" type="password" name="newpwd" placeholder="新密码" v-model="pwd_new">
                        <input class="form-control" type="password" name="rep" placeholder="确认密码" v-model="repwd_new">
                    <button class="btn1" @click="change">提交</button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">注销登录</h4>
                    </div>
                    <div class="modal-body">
                        确认注销?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="cancel">确认</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/vue.js"></script>
<script>
    var vm =new Vue({
        el:'#container',
        data:{
            pwd_old:'',
            pwd_new:'',
            repwd_new:''
        },
        methods:{
            cancel:function () {
                $.post('student/unlogin',function (data) {
                    if(data=='yes'){
                        location='welcome/login'
                    }
                },'text');
            },
            change:function () {
                var user={};
                var pwd=this.pwd_old;
                var pwd1=this.pwd_new;
                var pwd2=this.repwd_new;
                user.pwd=pwd;
                if(pwd==''){
                    alert('请输入旧密码');
                }else {
                    if(pwd1==''){
                        alert('请输入新密码');
                    }else {
                        if(pwd2==''){
                            alert('请确认新密码');
                        }else {
                            $.getJSON('student/check_pwd?callback=?',{data:user},function (res) {
                                if(res==null){
                                    alert('密码有误请确认旧密码')
                                }else {
                                    if(pwd1==pwd2){
                                        if(pwd1==res['s_pwd']){
                                            alert('新密码不能与旧密码一致请重新输入');
                                        }else {
                                            $.post('student/change_pwd',{pwd:pwd1},function (res) {
                                                if(res){
                                                    alert('密码修改成功');
                                                }else {
                                                    alert('密码修改失败');
                                                }
                                            })
                                        }
                                    }
                                }
                            })
                        }
                    }
                }
            }
        }
    })
</script>
</body>
</html>