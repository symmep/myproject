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
        #examinee{
            margin:100px auto;
            text-align: center;
            width: 800px;

        }
        #examinee .form-control{
            width: 220px;
            display: inline;
            margin-right:10px;
        }
        #examinee-infor{
            color: red;
        }
        #examinee-tab{
            margin:5px auto;
        }
        #examinee-tab tr,th,td,caption{
            text-align: center;
        }
        #examinee-tab caption{
            font-size: 20px;
        }   
        #examinee-tab td{
            padding: 8px 30px;
        }
        #examinee-tab a{
            color: #ccc;
            cursor: pointer;
        }
        #change-btn{
            background: #eee;
            padding: 4px 20px;
            text-align: right;
            font-size: 16px;
        }
        #change-btn a{
            color: #A00;
        }
    </style>
</head>
<body>
    <?php include 'header.php';?>
    <div class="contion">
        <?php include 'sidebar.php' ;?>
        <!-- <h3 style='text-align:center;'>考生管理</h3> -->
        <div id="container">
            <span id="login-state">Hi,&nbsp<?php $t_user=$this->session->userdata('t_user'); if(isset($t_user)){echo $t_user['t_name'];}?>&nbsp&nbsp<span  data-toggle="modal" data-target="#myModal1">注销</span></span>
            <div id="app">
                <div id="examinee">
                    <input type="text" class="form-control" placeholder="输入科目名" id='courseName'>
                    <select id='studentCompetence' class="form-control">
                        <option>------是否有考试权限------</option>
                        <option value="是">是</option>
                        <option value="否">否</option>
                    </select>
                    <button class="btn btn-info" @click='searchStudent' id='seacch-btn'>筛选</button><br><span id='examinee-infor'>*输入科目名后点击筛选即可查看选择该科目的所有学生*</span><br>


                    <table id='examinee-tab' class="table table-hover" v-show='showChange'>
                        <caption>考试资格查询</caption>
                        <tr>
                            <th>&nbsp;</th>
                            <th>姓名</th>
                            <th>学号</th>
                            <th>专业</th>
                            <th>科目</th>
                            <th>考试资格</th>
                        </tr>
                        <tr v-for='(obj,index) in examineeList'>
                            <td ><input type="checkbox" v-model='compe' :value="obj.s_id"></td>
                            <td v-text='obj.s_name'></td>
                            <td v-text='obj.s_num'></td>
                            <td v-text='obj.major'></td>
                            <td v-text='obj.course'></td>
                            <td v-text='obj.competence'></td>
                        </tr>
                    </table>
                    <div id="change-btn" v-if='showChange'>
                        <a href="javascript:;" @click='selectAll'>全选</a>&nbsp;|
                        <a href="javascript:;" @click='selectCancel'>取消</a>&nbsp;|
                        <a href="javascript:;" @click='selectReverse'>反选</a>&nbsp;|
                        <a href="javascript:;" @click='showMotai'>改变选中</a>
                        <input type="hidden" :value="cId" id='saveCId'>
                    </div>
                </div>
                <div class="modal fade" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">切换考试资格</h4>
                            </div>
                            <div class="modal-body">
                                <p>确定为选中考生切换其考试资格吗？</span></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-primary" @click='selectChange' >确认</button>
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
<script src='js/bootstrap.min.js'></script>
<script src='js/vue.js'></script>
<script>
    var vm = new Vue({
        el:'#app',
        data:{
            examineeList:[],
            compe:[],
            showChange:false
            // oStudent:{},
            // status:''

        },
        methods:{
            cancel:function () {
                $.post('teacher/unlogin',function (data) {
                    if(data=='yes'){
                        location='welcome/login'
                    }
                },'text');
            },
            searchStudent:function(){
                var courseName = $('#courseName').val(),_this=this;
                if(!courseName){
                    alert('请输入科目名');
                }else{
                    $.get('teacher/get_student_by_course',{courseName:courseName},function(data){
                        // console.log($('#studentCompetence').val());
                        if(data){
                            if(data.length > 0){
                                if($('#studentCompetence').val()){
                                    if($('#studentCompetence').val() == '是'){
                                        _this.examineeList =[];
                                        data.forEach(function(obj){
                                            if(obj.competence == 'yes'){
                                                _this.examineeList.push(obj);
                                            }
                                        })
                                        if( _this.examineeList.length > 0){
                                            _this.showChange = true;
                                            _this.compe=[];
                                        }else{
                                            _this.showChange = false;
                                        }
                                    }else if($('#studentCompetence').val() == '否'){
                                        _this.examineeList =[];
                                        data.forEach(function(obj){
                                            if(obj.competence == 'no'){
                                                _this.examineeList.push(obj);
                                            }
                                        })
                                        if( _this.examineeList.length > 0){
                                            _this.showChange = true;
                                            _this.compe=[];
                                        }else{
                                            _this.showChange = false;
                                        }
                                        // if(_this.examineeList.length == 0 ){
                                        //     alert('');
                                        // }
                                    }else{
                                        _this.examineeList = data;
                                        if( _this.examineeList.length > 0){
                                            _this.showChange = true;
                                            _this.compe=[];
                                        }else{
                                            _this.showChange = false;
                                        }
                                    }
                                }
                                // _this.cId = data[0].c_id;
                            }else{
                                alert('当前还未有学生选择了该科目');
                                _this.examineeList =[];
                                if( _this.examineeList.length > 0){
                                    _this.showChange = true;
                                }else{
                                    _this.showChange = false;
                                }
                            }
                        }else{
                            alert('当前输入科目不存在请重新输入');
                            _this.examineeList =[];
                            if( _this.examineeList.length > 0){
                                _this.showChange = true;
                            }else{
                                _this.showChange = false;
                            }
                        }
                    },'json');
                }
            },
            selectAll:function(){
                this.compe = [];
                var _this = this;
                this.examineeList.forEach(function(obj,index,array){
                    _this.compe.push(obj.s_id);
                    // console.log(_this.compe.constructor);
                })
            },
            selectCancel:function(){
                var _this = this;
                _this.compe = [];
            },
            selectReverse:function(){
                var _this=this,reverse=[];
                this.examineeList.forEach(function(obj,index,array){
                    if(_this.compe.indexOf(obj.s_id) == -1){
                        reverse.push(obj.s_id)
                    }
                })
                this.compe = reverse;
            },
            selectChange:function(){
                var cId = $('#saveCId').val();
                $('#myModal').modal('hide');
                $.post('teacher/change_compe',{cId:cId,compe:this.compe},function(data){
                    if(data == 'success'){
                        alert('操作成功');
                        history.go(0);
                    }else if(data == 'fail'){
                        alert('错误，请重试');
                        history.go(0);
                    }  
                },'text');
            },
            showMotai:function(){
                if(this.compe.length == 0){
                    alert('当前选择为空,请选择');
                }else{
                    $('#myModal').modal('show');
                }
                
            }
        },
        computed:{
            cId:function(){
                if(this.examineeList.length > 0){
                    return this.examineeList[0].c_id
                }else{
                    return 0
                }
            }
        }
    });
</script>