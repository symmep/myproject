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
         }
         .sub{
            color: #337ab7;
            cursor: pointer;
         }
        .form-control{
           width: 80%;
           height: 30px;
           display: inline;
        }
        .btn-sm{
            float: right;
        }
        .paging{
            text-align: center;
        }
        .pagination{
            margin: 0 auto;
        }
         .pagination .display{
            display: none;
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
                <div class="information col-md-4 col-md-offset-4">
                <input type="text" name="course" class="form-control" placeholder="课程名称" v-model="find"><button class="btn btn-info btn-primary btn-sm" @click="check">搜索</button>
                </div>
                <div class="class-list col-md-8 col-md-offset-2">
                    <table class="table table-striped">
                        <tr>
                            <td>课程号</td>
                            <td>课程名称</td>
                            <td>操作</td>
                        </tr>
                        <tr v-for="obj in resultList">
                            <td>{{obj.c_id}}</td>
                            <td>{{obj.c_name}}</td>
                            <td class="sub" data-toggle="modal" data-target="#myModal1" @click="choose">选课</td>
                        </tr>
                    </table>
                    <div class="paging" v-show="flag">
                        <ul class="pagination">
                            <li @click="pre" class="pre">
                                <a aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li @click="change" class="page1 active"><a>1</a></li>
                            <li v-show="pre1" class="pre1"><a >...</a></li>
                            <li v-for="n in page" @click="change" :class="'page'+(n+1)"><a>{{n+1}}</a></li>
                            <li v-show="next1" class="next1"><a >...</a></li>
                            <li @click="change" :class="'page'+num"><a>{{num}}</a></li>
                            <li @click="next" class="next">
                                <a aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </div>
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
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">选课</h4>
                    </div>
                    <div class="modal-body">
                        确认选修：{{course}}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"  @click="confirm">确认</button>
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
            resultList:[],
            resultAll:[],
            num:'',
            page:'',
            row:'10',
            course:'',
            c_id:'',
            find:'',
            flag:false,
            pre1:false,
            next1:false
        },
        mounted:function () {
            var _this =this;
            $.getJSON('student/class_list?callback=?',{data:this.row},function (res) {
                _this.link=res['link'];
                _this.resultAll = res;
                var arr = Object.keys(_this.resultAll);
                var le=arr.length;
                _this.num= Math.ceil(le/_this.row);
                if(_this.num>1){
                    _this.flag=true;
                    _this.page=_this.num-2;
                }
                _this.resultList = _this.resultAll.slice(0,_this.row);
            });
        },
        updated:function () {
            var act=$('.active').text();
            if(this.num>10){
                if(act<5){
                    this.next1=true;
                    $('.page5').nextUntil($('.next1')).addClass('display');
                }
            }
        },
        methods:{
            cancel:function () {
                $.post('student/unlogin',function (data) {
                    if(data=='yes'){
                        location='welcome/login'
                    }
                },'text');
            },
            choose:function (e) {
                this.course = $(e.target).prev('td').text();
                this.c_id = $(e.target).prev('td').prev('td').text();
                $.post('student/check_cid',{c_id:this.c_id},function (res){
                    if(res!='null'){
                        $('#myModal1').modal('hide');
                        alert('已经选修该课程');
                    }
                })
            },
            confirm:function () {
                $.post('student/class_add',{c_id:this.c_id},function (res) {
                    if(res==1){
                        alert('选课成功');
                        $('#myModal1').modal('hide');
                    }else {
                        alert('选课失败');
                        $('#myModal1').modal('hide');
                    }
                })
            },
            check:function () {
                var newArr=[];
                var lesson=this.find;
                var arr=this.resultAll;
                for(var i=0;i<arr.length;i++){
                    $.each(arr[i],function(key,val){
                        if(lesson==val){
                            newArr.push(arr[i]);
                        }
                    });
                }
                this.resultList=newArr;
                if(lesson==''){
                    this.resultList=this.resultAll;
                }
                var oArr = Object.keys(this.resultList);
                var le=oArr.length;
                this.num= Math.ceil(le/this.row);
                if(this.num>1){
                    this.flag=true;
                    this.page=this.num-2;
                }
            },
            change:function (e) {
                var tPage =$(e.target).text();
                this.resultList = this.resultAll.slice((tPage*1-1)*this.row,this.row*tPage);
                $(e.target).parent('li').addClass('active').siblings().removeClass('active');
                if(this.num>10){
                    var lNum6= '.page'+(this.num-6);
                    var lNum5= '.page'+(this.num-5);
                    var lNum4= '.page'+(this.num-4);
                    if(tPage<5){
                        this.pre1=false;
                        this.next1=true;
                        $('.pre1').nextUntil($('.page6')).removeClass('display');
                        $('.page5').nextUntil($('.next1')).addClass('display');
                    }
                    if(tPage==this.num){
                        this.pre1=true;
                        this.next1=false;
                        $('.pre1').nextUntil($(lNum4)).addClass('display');
                        $(lNum5).nextUntil($('.next1')).removeClass('display');
                    }
                    if(tPage==5) {
                        this.pre1=false;
                        this.next1=true;
                        $('.pre1').nextUntil($('.page8')).removeClass('display');
                        $('.page7').nextUntil($('.next1')).addClass('display');
                    }
                    if(tPage==this.num-4){
                        this.pre1=true;
                        this.next1=false;
                        $('.pre1').nextUntil($(lNum5)).addClass('display');
                        $(lNum6).nextUntil($('.next1')).removeClass('display');
                    }
                    if(tPage>this.num-4){
                        this.pre1=true;
                        this.next1=false;
                        $('.pre1').nextUntil($(lNum4)).addClass('display');
                        $(lNum5).nextUntil($('.next1')).removeClass('display');
                    }
                    if(tPage>5 && page<this.num-4){
                        this.pre1=true;
                        this.next1=true;
                        $('.pre1').nextUntil($('.next1')).addClass('display');
                        $(e.target).parent().removeClass('display').prev().removeClass('display').prev().removeClass('display');
                        $(e.target).parent().next().removeClass('display').next().removeClass('display');
                    }

                }
            },
            pre:function () {
                var act=$('.active').text();
                var nLi=$('.active').prev().text();
                if(act!=1){
                    this.resultList = this.resultAll.slice((act*1-2)*this.row,this.row*(act*1-1));
                    if(nLi!='...'){
                        $('.active').removeClass('active').prev().addClass('active');
                    }else{
                        if(this.num==2){
                            $('.active').removeClass('active');
                            $('.page1').addClass('active');
                        }else {
                            $('.active').removeClass('active').prev().prev().addClass('active');
                        }
                    }
                }
                if(this.num>10){
                    if(this.num-act>2 && act>4){
                        var pname= '.page'+(act*1-4);
                        var nname='.page'+(act*1+2);
                        var name1='.page'+(act*1+1);
                        if(this.num-act==3){
                                $('.active').prev().removeClass('display');
                        }else{
                            this.next1=true;
                            if(this.num-act<=16){
                                $('.active').prevUntil($(pname)).removeClass('display');
                                $(name1).nextUntil($('.next1')).addClass('display');
                            }
                            if(act==6){
                                this.pre1=false;
                                $(nname).prevUntil($('.page6')).addClass('display');
                                $('.active').prevUntil($('pre1')).removeClass('display');
                            }
                            if(act<6){
                                this.pre1=false;
                                $(nname).prevUntil($('.page5')).addClass('display');
                                $('.active').prevUntil($('pre1')).removeClass('display');
                            }
                        }

                    }
                }

            },
            next:function () {
                var nLi=$('.active').next().text();
                var act=$('.active').text();
                if(act!=this.num){
                    this.resultList = this.resultAll.slice(act*this.row,this.row*(act*1+1));
                    if(nLi!='...'){
                        $('.active').removeClass('active').next().addClass('active');
                    }else{
                        if(this.num==2){
                            $('.active').removeClass('active');
                            $('.page2').addClass('active');
                        }else {
                            $('.active').removeClass('active').next().next().addClass('active');
                        }
                    }
                }
                if(this.num>10){
                    if(act>=4){
                        var name1='.page'+(act*1-1);
                        var nname='.page'+(act*1+4);
                        var fname='.page'+(act*1-3);
                        var tname='.page'+(act);
                        if(act==4){
                            $('.page5').nextUntil($('.page8')).removeClass('display');
                        }else{
                            this.pre1=true;
                            if(this.num-act>4){
                                $(name1).prevUntil($('.pre1')).addClass('display');
                                $('.active').nextUntil($(nname)).removeClass('display');
                            }
                            if(this.num-act==5){
                                this.next1=false;
                                $(fname).nextUntil($(tname)).addClass('display');
                                $('.active').nextUntil($('.next1')).removeClass('display');
                            }
                            if(this.num-act==4){
                                $(tname).prev().addClass('display');
                            }
                        }
                    }
                }
            }
        }
    })
</script>
</body>
</html>