<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?php echo site_url() ;?>">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        #score{
            margin:100px auto;
            text-align: center;
            width: 800px;
        }
        #score-tab{
            width: 800px;
            margin:20px auto;
        }
        #score-tab caption{
            text-align: center;
        }
        #score-tab td,#score-tab th{
            text-align: center;
            padding: 8px;
        }
        #score .form-control{
            width:30%;
            display: inline;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include 'header.php';?>
    <div class="contion">
        <?php include 'sidebar.php' ;?>
        <!-- <h1 style='text-align:center;'>成绩查询</h1> -->
        <div id="container">
            <span id="login-state">Hi,&nbsp<?php $t_user=$this->session->userdata('t_user'); if(isset($t_user)){echo $t_user['t_name'];}?>&nbsp&nbsp<span  data-toggle="modal" data-target="#myModal1">注销</span></span>
            <div id="score">
                <input type="text" v-model='s_name' placeholder="输入姓名" class="form-control">
                <input type="text" v-model='s_num' placeholder="输入学号" class="form-control">
                <input type="text" v-model='grade' placeholder="输入年级如:14,15,16" class="form-control">
                <input type="text" v-model='major' placeholder="输入专业" class="form-control">
                <input type="text" v-model='course' placeholder="输入科目" class="form-control">
                <button class="btn btn-primary" @click='searchScore'>查询</button>
                <table id='score-tab' class="table table-hover" v-show='isShowScore'>
                    <caption>成绩查询</caption>
                    <tr>
                        <th>序号</th>
                        <th>姓名</th>
                        <th>学号</th>
                        <th>年级</th>
                        <th>专业</th>
                        <th>成绩</th>
                    </tr>
                    <tr v-for='(obj,index) in resultList'>
                        <td v-text='index+1'></td>
                        <td v-text='obj.s_name'></td>
                        <td v-text='obj.s_num'></td>
                        <td v-text='obj.grade'></td>
                        <td v-text='obj.major'></td>
                        <td><button data-target="#myModal" data-toggle="modal" @click='showScore(obj)'>点击展开</button></td>
                    </tr>
                </table>
                <div class="modal fade" id="myModal" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">成绩</h4>
                            </div>
                            <div class="modal-body">
                                <p v-for='(value,key,index) in oScore'>{{key}}:{{value}}<span></span></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
    </div>


</body>
</html>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src='js/vue.js'></script>
<script>
    var vm = new Vue({
        el:'#score',
        data:{
            resultList:[],
            s_name:'',
            s_num:'',
            grade:'',
            major:'',
            course:'',
            oScore:{},
            isShowScore:false
        },
        methods:{
            cancel:function () {
                $.post('teacher/unlogin',function (data) {
                    if(data=='yes'){
                        location='welcome/login'
                    }
                },'text');
            },
            searchScore:function(){
                this.resultList = [];
                this.isShowScore =false;
                var _this = this, 
                oStudent = {
                    s_name:this.s_name,
                    s_num:this.s_num,
                    grade:this.grade,
                    major:this.major,
                    course:this.course
                };
                // console.log(oStudent);
                $.get('teacher/get_score',oStudent,function(data){
                    if(data.length > 0){
                        _this.isShowScore = true;
                        _this.resultList = data;
                    }
                },'json');
            },
            showScore:function(obj){
                // console.log(obj);
                this.oScore = obj.score;
                // if(obj.mark){
                //     this.oScore = obj.mark;
                // }else{
                //     if(this.course == ''){
                //         if(obj.score.length == 0){
                //             this.oScore = {'当前学生并无成绩':'请确认是否已参加过考试'};
                //         }else{
                //             this.oScore = obj.score;
                //         }
                //     }else{
                //         this.oScore = {'当前学生本科并无成绩':'请确认是否已参加考试或输入的科目是否存在'};
                //     }
                // }
            }
        }
    });
</script>