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
        #container{
            display:-webkit-flex;
            display:flex;

        }
        .imgs{
            -webkit-flex:2;
            flex:2;
        }
        .login{
            -webkit-flex:1;
            flex:1;
            float: right;
        }
        ul{

            margin: 0 auto;
            overflow: hidden;
        }
        li{
            margin: 10px 20px 10px 0;
            width: 120px;
            height: 30px;
            float: left;
            border:1px solid #3399cc;
            background: #0099cc;
            color: #ffffff;
            text-align: center;
            font-size: 20px;
            border-radius: 5px;
            cursor: pointer;
            position: relative;
        }
        li:last-child{
            margin-right: 0;
        }
        li::before{
            background-color: transparent;
            content: "";
            position: absolute;
            left: 0;
            bottom: -10px;
            display: block;
            height: 2px;
            -webkit-transition: .3s all;
            -o-transition: .3s all;
            transition: .3s all;
            width: 0;
        }
        li.active::before{
            content: "";
            position: absolute;
            bottom: -10px;
            width: 100%;
            height: 2px;
            background: #0099cc;
        }
        img{
            width: 100%;
            height: 100%;
        }
        #content{
            width: 260px;
            font-size:0;
        }
        .wrap{
            width: 260px;
            margin:80px auto 0;
        }
        input{
            margin:10px 0;
        }
        .btn1,.btn2{
            width: 120px;
            height: 30px;
            background: #0099cc;
            color: #ffffff;
            text-align: center;
            font-size: 20px;
            line-height: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .btn1{
            margin-right:20px;
        }
    </style>
</head>
<body>
    <?php include 'header.php';?>
    <contion>
        <div id="container">
            <div class="imgs">
                    <img src="images/loginbg.jpg" alt="">
                </div>
            <div class="login">
                <div class="wrap">
                    <ul>
                        <li class="active">学生登录</li>
                        <li>教师登录</li>
                    </ul>
                    <div id="content">
                        <div id="content1">
                            <form v-if='s_reg'>
                                <input class="form-control" type="text" name="uname" placeholder="学号" v-model="num_sr" >
                                <br/>
                                <input class="form-control" type="password" name="password" placeholder="密码" v-model="pwd_sr" >
                                <br/>
                                <input class="form-control" type="password" name="password" placeholder="确认密码" v-model="pwd2_sr" >
                                <br/>
                                <input class="form-control" type="text" name="password" placeholder="姓名" v-model="s_name" >
                                <br/>
                                <input class="form-control" type="text" name="password" placeholder="年级（4位小写数字）" v-model="grade">
                                <br/>
                                <input class="form-control" type="text" name="password" placeholder="专业" v-model="major" >
                                <br/>
                                <button class="btn1" @click="regist_s">注册</button>
                                <button class="btn2" @click='slogChange'>已有帐号?</button>
                            </form>
                            <form v-else>
                                <input class="form-control" type="text" name="uname" placeholder="学号" v-model="num_ss" >
                                <br/>
                                <input class="form-control" type="password" name="password" placeholder="密码" v-model="pwd_ss" @keyup.enter="check_s">
                                <br/>
                                <button class="btn1" @click="check_s" >登陆</button>
                                <button class="btn2" @click='sregChange'>没有帐号？</button>
                            </form>
                           
                        </div>
                        <div id="content2" style="display: none">
                             <form v-if="t_reg">
                               <input class="form-control" type="text" name="teacher_num" placeholder="请输入教师号">
                                <br/>
                                 <input class="form-control" type="text" name="uname" placeholder="请输入登录帐号">
                                 <br/>
                                <input class="form-control" type="password" name="password" placeholder="输入密码">
                                <br/>
                                <input class="form-control" type="password" name="repassword" placeholder="确认密码">
                                <br/>
                                <button class="btn1" @click="saveTeacher" >注册</button>
                                <button class="btn2" @click='tregChange'>已有帐号?</button>
                            </form>
                            <form v-else id="teacher_login">
                                <input class="form-control" type="text" name="uname" placeholder="用户名">
                                <br/>
                                <input class="form-control" type="password" name="password" placeholder="密码">
                                <br/>
                                <button class="btn1" @click="loginTeacher">登陆</button>
                                <button class="btn2" @click='tlogChange'>没有帐号?</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </contion>
</body>
</html>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/vue.js"></script>
<script>
    $(function(){
        var $li = $('.wrap li');
        $li.on('click',function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index = $li.index(this);
            $('div#content > div').eq(index).show().siblings().hide();
        });
        $('form').submit(function(e){
            if(e){
                e.preventDefault();
            }else{
                window.event.returnValue = false;
            }
        });
    });
    var vm = new Vue({
        el:'#container',
        data:{
            s_reg:false,
            t_reg:false,
            num_sr:'',
            pwd_sr:'',
            pwd2_sr:'',
            num_ss:'',
            pwd_ss:'',
            s_name:'',
            grade:'',
            major:''
        },
        methods:{
            sregChange:function(){
                this.s_reg = true;
            },
            slogChange:function(){
                this.s_reg = false;
            },
            tregChange:function(){
                this.t_reg = false;
            },
            tlogChange:function(){
                this.t_reg = true;
            },
            regist_s:function () {
                if( this.num_sr==''){
                    alert('请输入学号');
                }else {
                    var num =this.num_sr;
                    var pwd = this.pwd_sr;
                    var pwd2=this.pwd2_sr;
                    var name=this.s_name;
                    var nj=this.grade;
                    var zy=this.major;
                    $.post('student/check_num',{data:num},function (data) {
                        if(data!='null'){
                            alert('该学号已经注册，请确认学号或者直接登录');
                        }else{
                            if(pwd==''){
                                alert('请输入密码');
                            }else{
                                if(pwd2==''){
                                    alert('请确认密码');
                                }else{
                                  if(name==''||nj==''||zy==''){
                                      alert('请填写完整学生信息');
                                  }else{
                                      if(pwd==pwd2){
                                          $.post('student/regist',{s_num:num,s_pwd:pwd,s_name:name,grade:nj,major:zy},function (data) {
                                              if(data==1){
                                                  alert('注册成功请登录');
                                              }
                                          })
                                      }
                                  }
                                }
                            }
                        }
                    });

                }


            },
            check_s:function () {
                if(this.num_ss==''){
                    alert('请输入学号');
                }else{
                    var name=this.num_ss;
                    var pwd = this.pwd_ss;
                    if (pwd==''){
                        alert('请输入密码');
                    }else{
                        $.post('student/check_login',{uname:name,pwd:pwd},function (data) {
                            if(data != 'yes'){
                                alert('帐号或密码有误，请确认帐号和密码')
                            }else{
                                location='student/index'
                            }
                        },'text')
                    }
                }
            },
            saveTeacher:function(){
                var oTeacher = {};
                oTeacher.teacher_num = $("#teacher_regist input[name='teacher_num']").val();
                oTeacher.uname = $("#teacher_regist input[name='uname']").val();
                oTeacher.password = $("#teacher_regist input[name='password']").val();
                oTeacher.repassword = $("#teacher_regist input[name='repassword']").val();
                if(oTeacher.password != oTeacher.repassword ){
                    alert('两次输入的密码不一致请重新输入');
                }else{
                    // console.log(oTeacher)
                    $.post('teacher/regist_teacher',oTeacher,function(data){
                        if(data == 'yes'){
                            alert("注册成功");
                            location.href = 'teacher/index';
                        }else{
                            alert('注册失败：输入的教师号有误或当前教师号已被注册,请重试');
                        }
                    },'text');
                }

            },
            loginTeacher:function(){
                uname = $("#teacher_login input[name='uname']").val();
                password = $("#teacher_login input[name='password']").val();
                $.post('teacher/login_teacher',{uname:uname,password:password},function(data){
                    if(data == 'yes'){
                        alert("登录成功");
                        location.href = 'teacher/index';
                    }else{
                        alert('登录失败请重试');
                    }
                },'text');
            }
        }
    });
</script>