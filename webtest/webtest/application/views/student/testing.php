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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:600,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/countdown.css">
    <style>
        .container-fluid {
             margin-top: 0;
        }
        li{
            list-style: decimal;
        }
        .wrap{
            margin:0 auto;
            width: 60%;
        }
        .btn-wrap{
            text-align: center;
            margin: 20px auto;
        }
        .btn1{
            width: 120px;
            height: 30px;
            background: #0099cc;
            color: #ffffff;
            text-align: center;
            font-size: 20px;
            line-height: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<?php include 'header.php';?>
<div class="contion">
    <div id="container">
        <span id="login-state">Hi,&nbsp<?php $s_user=$this->session->userdata('s_user'); if(isset($s_user)){echo $s_user['s_name'];}?>&nbsp&nbsp<span  data-toggle="modal" data-target="#myModal">注销</span></span>
        <div class="container-fluid">
            <div id="content">
                    <h1 class="alt-1">0h 30m 00s</h1>
            </div>
            <div class="wrap">
                <h3>一、单选题</h3>
                <ol class="select">
                    <li v-for="obj in sArr" >
                        <h5>{{obj.content}}</h5>
                        <label><input :name="obj.select_id" type="radio" :value="obj.opa" />A. {{obj.opa}}</label><br/>
                        <label><input :name="obj.select_id" type="radio" :value="obj.opb" />B. {{obj.opa}}</label><br/>
                        <label><input :name="obj.select_id" type="radio" :value="obj.opc" />C. {{obj.opc}}</label><br/>
                        <label><input :name="obj.select_id" type="radio" :value="obj.true" />D. {{obj.true}}</label>
                    </li>
                </ol>
                <h3>二、多选题</h3>
                <ol class="checkbox">
                    <li v-for="obj in cArr" >
                        <h5>{{obj.content}}</h5>
                        <label><input :name="obj.checkbox_id" type="checkbox" :value="obj.opa" />A. {{obj.opa}}</label><br/>
                        <label><input :name="obj.checkbox_id" type="checkbox" :value="obj.opb" />B. {{obj.opb}}</label><br/>
                        <label><input :name="obj.checkbox_id" type="checkbox" :value="obj.opc" />C. {{obj.opc}}</label><br/>
                        <label><input :name="obj.checkbox_id" type="checkbox" :value="obj.opd" />D. {{obj.opd}}</label>
                    </li>
                </ol >
                <h3>三、判断题</h3>
                <ol class="opinion">
                    <li v-for="obj in oArr">
                        <h5>{{obj.content}}</h5>
                        <label><input :name="obj.content" type="radio" value="true" />正确</label><br/>
                        <label><input :name="obj.content" type="radio" value="false" />错误</label>
                    </li>
                </ol>
            </div>
            <div class="btn-wrap"><button  class="btn1" data-toggle="modal" data-target="#myModal1" @click="sub">交卷</button></div>
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
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">确认交卷</h4>
                    </div>
                    <div class="modal-body">
                        {{msg}}是否交卷？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"  @click="fn">确认</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.countdown.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/vue.js"></script>
<script>
    $(function () {
        "use strict";
        $('time').countDown({
            with_separators: true
        });
        $('.alt-1').countDown({
            css_class: 'countdown-alt-1'
        });
        $('header a').on('click',function () {
            return false;
        });
    });
    var vm =new Vue({
        el:'#container',
        data:{
            resultAll:'',
            sArr:'',
            cArr:'',
            oArr:'',
            msg:'',
            score:''
        },
        mounted:function () {
            var _this = this;
            setTimeout(function () {
                _this.fn();
            },1800000);
            $.getJSON('student/test_list?callback=?',function (res) {
                _this.resultAll= res;
                _this.sArr = res['sl'];
                _this.cArr = res['cl'];
                _this.oArr = res['ol'];
            })
        },
        methods:{
            cancel:function () {
                $.post('student/unlogin',function (data) {
                    if(data=='yes'){
                        location='welcome/login'
                    }
                },'text');
            },
            sub:function () {
                var arr1 = $('.select').find(':radio:checked');
                var arr3 = $('.opinion').find(':radio:checked');
                var h1 = $('.hh-1').html();
                var h2 = $('.hh-2').html();
                var m1 = $('.mm-1').html();
                var m2 = $('.mm-2').html();
                var s1 = $('.ss-1').html();
                var s2 = $('.ss-2').html();
                var flag = true;
                if (h1!=0){
                    flag=false;
                }
                if (h2!=0){
                    flag=false;
                }
                if (m1!=0){
                    flag=false;
                }
                if (m2!=0){
                    flag=false;
                }
                if (s1!=0){
                    flag=false;
                }
                if (s2!=0){
                    flag=false;
                }
                if(!flag){
                    var flag1 =true;
                    $('.checkbox li').each(function () {
                        var arr =$(this).find(':checkbox:checked');
                        if(arr.length==0){
                            flag1=false;
                        }
                    });
                    if(arr1.length==this.sArr.length&&arr3.length==this.oArr.length&& flag1){
                    }else {
                        this.msg="还有试题未作答，"
                    }
                }
            },
            fn :function () {
                var grade=0;
                var arr1 = $('.select').find(':radio:checked');
                var arr2 = $('.checkbox li');
                var arr3 = $('.opinion').find(':radio:checked');
                for(var i=0;i<arr1.length;i++){
                    for(var j=0;j<this.sArr.length;j++){
                        if (arr1[i].name==this.sArr[j].select_id){
                            if(arr1[i].value==this.sArr[j].true){
                                    grade+=3;
                            }
                            break
                        }
                    }
                }
                for(var x=0;x<arr2.length;x++){
                    var arr = [];
                    var t_id =arr2.eq(x).find('input')[0].name;
                    arr2.eq(x).find(':checkbox:checked').each(function () {
                        arr.push(this.value)
                    });
                    for(var j=0;j<this.cArr.length;j++){
                        if(this.cArr[j].checkbox_id==t_id){
                            var str = this.cArr[j].true;
                            var stra =arr.join(';');
                            if (str==stra){
                                grade+=10;
                            }
                            break
                        }
                    }
                }
                for(var i=0;i<arr3.length;i++){
                    for(var j=0;j<this.oArr.length;j++){
                        if (arr3[i].name==this.oArr[j].content){
                            if(arr3[i].value==this.oArr[j].bool){
                                grade+=2;
                            }
                            break
                        }
                    }
                }
                this.score=grade;
                $.post('student/score_up',{score:this.score},function (res) {
                    if(res==1){
                        alert('交卷成功');
                        $('#myModal1').modal('hide');
                        location='student/index'
                    }else {
                        alert('交卷失败');
                        $('#myModal1').modal('hide');
                    }
                })
            }
        }
    })
</script>
</body>
</html>