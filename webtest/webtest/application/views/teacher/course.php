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
        #course{
            margin-top:100px;
            text-align: center;
        }
        #course-tab{
            margin:30px auto;
        }
        #course-tab tr,th,td,caption{
            text-align: center;
        }
        #course-tab caption{
            font-size: 20px;
        }   
        #course-tab td{
            padding: 8px 30px;
        }
        #course-tab a{
            color: #ccc;
            cursor: pointer;
        }
        #course .form-control{
            width: 220px;
            display: inline;
            margin-right:10px;
        }
        #app{
            line-height: 100%;
        }
    </style>
</head>
<body>
    <?php include 'header.php';?>
    <div class="contion">
        <?php include 'sidebar.php' ;?>
        <div id="container">
            <span id="login-state">Hi,&nbsp<?php $t_user=$this->session->userdata('t_user'); if(isset($t_user)){echo $t_user['t_name'];}?>&nbsp&nbsp<span  data-toggle="modal" data-target="#myModal1">注销</span></span>
            <div id='app'>
                <div id="course">
                    <input type="text" class="form-control" placeholder="在此输入要添加的科目名" v-model="courseName"><button class="btn btn-info" @click='addCourse'>增加课程</button><br>
                    <table id='course-tab'>
                        <caption>当前已有课程</caption>
                        <tr>
                            <th>序号</th>
                            <th>科目名称</th>
                            <th>操作</th>
                        </tr>
                        <tr v-for='(obj,key) in aCourse'>
                            <td v-text='key+1'></td>
                            <td v-text='obj.c_name'></td>
                            <td><a data-toggle="modal" data-target="#myModal" @click='oCourse=obj'>删除</a></td>
                        </tr>
                    </table>
                </div>
                <div class="modal fade" tabindex="-1" role="dialog" id='myModal'>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">确认删除此课程吗？</h4>
                            </div>
                            <div class="modal-body">
                                <p>点击保存确认修改，点击取消将不会做任何修改</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-primary" @click='removeCourse'>保存</button>
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
        el:'#app',
        data:{
            aCourse:[],
            courseName:"",
            oCourse:{}
        },
        created:function(){
            var _this = this;
            $.get('teacher/get_course',{},function(data){
                _this.aCourse = data;
            },'json')
        },
        methods:{
            cancel:function () {
                $.post('teacher/unlogin',function (data) {
                    if(data=='yes'){
                        location='welcome/login'
                    }
                },'text');
            },
            removeCourse:function(){
                $.post('teacher/delete_course',this.oCourse,function(data){
                    if(data == 'yes'){
                        history.go(0);
                    }else if(data == 'no'){
                        alert('删除失败');
                    }
                },'text') 
            },
            addCourse:function(){
                if(this.courseName != ''){
                    $.post('teacher/add_course',{courseName:this.courseName},function(data){
                        if(data == 'yes'){
                            alert('添加课程成功');
                            history.go(0);
                        }else{
                            alert(data);
                        }
                    },'text')
                }else{
                    alert('当前输入为空');
                }
               
            }
        }
    });
</script>