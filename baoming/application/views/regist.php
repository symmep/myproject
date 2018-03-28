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
                用户注册
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
            <input class="form-control" type="text" v-model="id" @blur="bl1" placeholder="身份证号">
            <div class="green" v-show="green1">
                <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
            </div>
            <div class="err1"  v-show="!flag1" >
                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                {{redcode1}}
            </div>
            <br/>
            <input class="form-control" type="password" v-model="password" placeholder="密码" @blur="bl2">
            <div class="green" v-show="green2">
                <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
            </div>
            <div class="err1"  v-show="!flag2" >
                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                {{redcode2}}
            </div>
            <br/>
            <input class="form-control" type="password" v-model="repassword" placeholder="确认密码" @blur="bl3">
            <div class="green" v-show="green3">
                <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
            </div>
            <div class="err1"  v-show="!flag3" >
                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                {{redcode3}}
            </div>
            <br/>
            <button class="btn1" @click="reg">注册</button>
            <button class="btn2" @click="go">已注册？登录</button>
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
            flag3:true,
            redcode:"",
            redcode1:"",
            redcode2:"",
            redcode3:"",
            green:false,
            green1:false,
            green2:false,
            green3:false
        },
        methods:{
            bl:function () {
                //姓名正则验证
                var  regName =  /^([\u4e00-\u9fa5]{2,})$/ ;
                if(this.uname==''){
                    this.flag = false;
                    this.green = false;
                    this.redcode = '姓名不能为空！'
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
                //身份证正则验证
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
                        var _this =this;
                        $.get('welcome/check_id',{cid:cid},function (res) {
                            if(res=='null'){
                                _this.flag1 =true;
                                _this.green1=true;
                            }else {
                                _this.green1=false;
                                _this.flag1 =false;
                                _this.redcode1='该身份证号已注册!请确认或直接登录';
                            }
                        },'text');

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
                    this.redcode2 = '密码不能为空！'
                }else{
                    this.green2 = true;
                    this.flag2 =true;
                }
            },
            bl3:function () {
                //验证2次密码输入是否一致
                if(this.repassword!=''){
                    if(this.password!=this.repassword){
                        this.flag3 = false;
                        this.green3 = false;
                        this.redcode3 = '两次密码不一致！'
                    }else{
                        this.green3 = true;
                        this.flag3 =true;
                    }
                }
            },
            reg:function () {
                var _this=this;
                //所有输入满足注册要求后到控制台welcome下的 add_user方法注册
                if(this.flag&&this.flag1&&this.flag2&&this.flag3&&_this.uname!=''&&_this.password!=''&&_this.repassword!=''&&_this.id!=''){
                    $.post('welcome/add_user',{
                     uname:_this.uname,
                     pwd:_this.password,
                     id:_this.id
                    },function (res) {
                      if(res==1){
                          alert('注册成功');
                          //自动登录
                          location.href = 'welcome/auto_login?id='+_this.id;
                      }else{
                          alert('注册失败')
                      }
                    },'text')
                }
            },
            go:function () {
                location.href = 'welcome/login';
            }
        }

    })
</script>
</body>
</html>