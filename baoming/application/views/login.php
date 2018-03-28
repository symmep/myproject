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
        .btn1,.btn2{
            width:45%;
            float: left;
        }
        .btn1{
            margin-right: 45px;
        }
        .green{
            position: absolute;
            left:100%;
            transform: translateY(-25px);
            color: #5cb85c;
            height: 15px;
        }
        .err1{
            position: absolute;
            width: 200px;
            line-height: 15px;
            vertical-align: middle;
            left:100%;
            transform: translateY(-25px);
            color: #a94442;
            height: 15px;
        }
    </style>
</head>
<body>
<?php include 'header.php';?>
<div class="container">
    <div class="row">
        <div class="content col-md-offset-3 col-md-6">
            <h3>
                用户登录
            </h3>
            <input class="form-control" type="text" v-model="uname" placeholder="姓名" @blur="bl">
            <div class="green" v-show="green">
                <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
            </div>
            <div class="err1"  v-show="!flag" >
                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                {{redcode}}
            </div>
            <br/>
            <input class="form-control" type="text" v-model="id" @blur="bl1" placeholder="身份证号" @keyup.enter="check">
            <div class="green" v-show="green1">
                <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
            </div>
            <div class="err1"  v-show="!flag1" >
                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                {{redcode1}}
            </div>
            <br/>
            <input class="form-control" type="password" v-model="password" placeholder="密码" @blur="bl2" @keyup="bl2" @keyup.enter="check">
            <div class="green" v-show="green2">
                <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
            </div>
            <div class="err1"  v-show="!flag2" >
                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                {{redcode2}}
            </div>
            <br/>
            <button class="btn1" @click="check">登录</button>
            <button class="btn2"><a href="welcome/regist">注册</a></button>
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
            id:'',
            password:'',
            repassword:'',
            flag:true,
            flag1:true,
            flag2:true,
            redcode:"",
            redcode1:"",
            redcode2:"",
            green:false,
            green1:false,
            green2:false
        },
        methods:{
            bl:function () {
                //姓名正则验证
                var  regName =  /^([\u4e00-\u9fa5]{2,})$/ ;
                if(this.uname==''){
                    this.flag = false;
                    this.green = false;
                    this.redcode = '请输入姓名！'
                }else if (regName.test(this.uname)){
                    this.flag = true;
                    this.green = true;
                }else{
                    this.flag = false;
                    this.green = false;
                    this.redcode = '请正确输入中文姓名'
                }
            },
            bl1:function () {
                //身份证号正则验证
                var cid = this.id;
                var regIdCard=/^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/;
                var arrExp = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];//加权因子
                var arrValid = [1, 0, "X", 9, 8, 7, 6, 5, 4, 3, 2];//校验码
                if (cid==''){
                    this.flag1 =false;
                    this.green1 = false;
                    this.redcode1='请输入身份证号！';
                }else if(regIdCard.test(cid)){
                    var sum = 0, idx;
                    for(var i = 0; i < cid.length - 1; i++){
                        // 对前17位数字与权值乘积求和
                        sum += parseInt(cid.substr(i, 1), 10) * arrExp[i];
                    }
                    // 计算模（固定算法）
                    idx = sum % 11;
                    // 检验第18为是否与校验码相等
                    if(arrValid[idx] == cid.substr(17, 1).toUpperCase()){
                        this.flag1 =true;
                        this.green1=true;
                    }else {
                        this.green1=false;
                        this.flag1 =false;
                        this.redcode1='输入有误，请核对身份证号！';
                    }
                }else{
                    this.green1=false;
                    this.flag1 =false;
                    this.redcode1='身份证号格式有误！'
                }
            },
            bl2:function () {
                //密码验证
                if(this.password==''){
                    this.green2=false;
                    this.flag2 = false;
                    this.redcode2 = '请输入密码！'
                }else{
                    this.green2 = true;
                    this.flag2 =true;
                }
            },
            check:function () {
                //判断姓名是否为空
                if(this.uname=='') {
                    this.flag = false;
                    this.green = false;
                    this.redcode = '请输入姓名！'
                }
                //判断身份证号是否为空
                if (this.id=='') {
                    this.flag1 = false;
                    this.green1 = false;
                    this.redcode1 = '请输入身份证号！';
                }
                //判断密码是否为空
                if(this.password=='') {
                    this.green2 = false;
                    this.flag2 = false;
                    this.redcode2 = '请输入密码！'
                }
                //以上都不为空后  以姓名、身份证号、密码为参数到控制台welcome下的check_login方法验证登录
                if(this.flag && this.flag1 && this.flag2){
                    $.post('welcome/check_login',{uname:this.uname,id:this.id,pwd:this.password},function (data) {
                        if(data != 'yes'){
                            alert('帐号或密码有误，请确认帐号和密码')
                        }else{
                            location='welcome/index'
                        }
                    },'text')
                }
            }
        }
    })
</script>
</body>
</html>