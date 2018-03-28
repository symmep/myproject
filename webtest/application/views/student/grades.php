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
        .form-control{
            width: 80%;
            height: 30px;
            display: inline;
        }
        .btn-sm{
            float: right;
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
                    <input type="text" name="course" class="form-control" placeholder="课程名称" v-model="find"><button class="btn btn-info btn-primary btn-sm" type="submit" @click="check">搜索</button>
                </div>
                <div class="class-list col-md-8 col-md-offset-2">
                    <table class="table table-striped">
                        <tr>
                            <td>课程号</td>
                            <td>课程名称</td>
                            <td>成绩</td>
                        </tr>
                        <tr v-for="obj in resultList">
                            <td>{{obj.c_id}}</td>
                            <td>{{obj.c_name}}</td>
                            <td>{{obj.score}}</td>
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
                            <li v-for="n in page" @click="change" :class="'page'+n+1"><a>{{n+1}}</a></li>
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
            find:'',
            num:'',
            page:'',
            row:'10',
            flag:false
        },
        mounted:function () {
            var _this=this;
            $.getJSON('student/grades_list?callback=?',function (res) {
                _this.resultAll = res;
                var arr = Object.keys(_this.resultAll);
                var le=arr.length;
                _this.num= Math.ceil(le/_this.row);
                if(_this.num>1){
                    _this.flag=true;
                    _this.page=_this.num-1;
                }
                _this.resultList = _this.resultAll.slice(0,_this.row);
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
                var arr = Object.keys(this.resultList);
                var le=arr.length;
                this.num= Math.ceil(le/this.row);
                if(this.num>1){
                    this.flag=true;
                    this.page=this.num-1;
                }

            },
            change:function (e) {
                var page =$(e.target).text();
                this.resultList = this.resultAll.slice((page-1)*this.row,this.row*page);
                $(e.target).parent('li').addClass('active').siblings().removeClass('active');

            },
            pre:function () {
                var sli=$('.active a').text();
                if(sli!=1){
                    this.resultList = this.resultAll.slice((sli-1-1)*this.row,this.row*(sli-1));
                    $('.active').removeClass('active').prev().addClass('active');
                }
            },
            next:function () {
                var sLi=$('.active a').text();
                if(sLi!=this.num){
                    this.resultList = this.resultAll.slice(sLi*this.row,this.row*(sLi+1));
                    $('.active').removeClass('active').next().addClass('active');
                }
            }
        }
    })
</script>
</body>
</html>