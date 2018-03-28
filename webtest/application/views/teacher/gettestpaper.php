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
        body{
            /*background: #e2e7ea;*/
        }
        #paper{
            margin:100px auto;
            width: 200px;
            text-align: center;

        }
        #paper .form-control{
            width: 95px;
            display: inline-block;
            padding-left:0;
            padding-right: 0;
        }
        #paper .course{
            display: inline-block;
            padding: 8px;
            width: 100px;
            text-align: center;
            margin: 8px 0;
        }
        .word-icon{
            font-family: "Helvetica", sans-serif;
            font-size: 24px;
            font-weight: bold;
            background-color: #0054a6;
            color: white;
            padding: 2px 5px;
            vertical-align: middle;
        }
        .modal-body{
            text-align: left;
        }
        .modal-body p {
            margin: 8px 0 0 0;
            font-size: 16px;
            font-weight: bold;
        }
        #word-name.form-control{
            width: 150px;
        }
        .modal-body h3{
            text-align: center;
        }
        .true-answer{
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>
    <!-- <?php print_r($this->session->userdata('t_user'));?> -->
     <?php include 'header.php';?>
    <div class="contion">
        <?php include 'sidebar.php' ;?>
        <div id="container">
            <span id="login-state">Hi,&nbsp<?php $t_user=$this->session->userdata('t_user'); if(isset($t_user)){echo $t_user['t_name'];}?>&nbsp&nbsp<span  data-toggle="modal" data-target="#myModal1">注销</span></span>
            <div id="paper">
                <span class="course">单选题数量：</span>
                <select v-model='selectNum' class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10" >10</option>
                    <option value="11" >11</option>
                    <option value="12" >12</option>
                    <option value="13" >13</option>
                    <option value="14" >14</option>
                    <option value="15" >15</option>
                    <option value="16" >16</option>
                    <option value="17" >17</option>
                    <option value="18" >18</option>
                    <option value="19" >19</option>
                    <option value="20" >20</option>
                </select><br>
                <span class="course">判断题数量：</span>
                <select v-model='optionNum' class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10" >10</option>
                </select><br>
                <span class="course">多选题数量：</span>
                <select v-model='checkNum' class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                   <!--  <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10" >10</option> -->
                </select><br>
                <span class="course">科目:</span>
                <select class="form-control" v-model='courseId'>
                    <option disabled value>--选择科目--</option>
                    <option v-for='obj in aCourse' :value="obj.c_id">{{obj.c_name}}</option>
                </select><br>
                <a class="btn btn-default" href="javascript:void(0)" @click='wordDialogShow'>
                    <span class="word-icon">W</span>
                    导出为.doc文档
                </a>
                <div class="modal fade" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <!-- <h4 class="modal-title">自测试题</h4> -->
                                <label>生成文档标题：
                                    <input type="text" id='word-name' placeholder="输入标题" class="form-control" v-model="wordTitle">
                                </label>

                            </div>
                            <div class="modal-body">
                                <h3 v-text='wordTitle'></h3>
                                <h5>一、单选题：</h5>
                                <div v-for='(oSelect,index) in testPaper.select_paper'>
                                    <p>{{index+1}}.{{oSelect.content}}</p>
                                    <span >A.{{oSelect.opa}}</span>
                                    <span >B.{{oSelect.opb}}</span>
                                    <span >C.{{oSelect.opc}}</span>
                                    <span class='true-answer'>正确答案:{{oSelect.true}}</span>
                                </div>
                                <h5>二、判断题：</h5>
                                <div v-for='(oPtion,index) in testPaper.option_paper'>
                                    <p>{{index+1}}.{{oPtion.content}}</p>
                                    <span >A.true</span>
                                    <span >B.false</span>
                                    <span class='true-answer'>正确答案:{{oPtion.bool}}</span>
                                </div>
                                <h5>三、多选题：</h5>
                                <div v-for='(oCheck,index) in testPaper.check_paper'>
                                    <p>{{index+1}}.{{oCheck.content}}</p>
                                    <span >A.{{oCheck.opa}}</span>
                                    <span >B.{{oCheck.opb}}</span>
                                    <span >C.{{oCheck.opc}}</span>
                                    <span >D.{{oCheck.opd}}</span>
                                    <span class='true-answer'>正确答案:{{oCheck.true}}</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" @click='randomTest'>随即抽题</button>
                                <button type="button" class="btn btn-primary" @click='getPage'>确认</button>
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
<script src='js/FileSaver.js' ></script>
<script type="text/javascript" src="js/jquery.wordexport.js"></script>
<script type="text/javascript" src='js/vue.js'></script>
<script>
    var vm = new Vue({
        el:'#paper',
        data:{
            aCourse:[],
            courseId:'',
            selectNum:'10',
            optionNum:'5',
            checkNum:'5',
            testPaper:{},
            wordTitle:'自测题'
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
            wordDialogShow:function(){
                var _this =this;
                if(this.courseId !=''){
                    $.get('teacher/get_paper',{
                            courseId:this.courseId,
                            selectNum:this.selectNum,
                            optionNum:this.optionNum,
                            checkNum:this.checkNum
                        },function(data){
                            _this.testPaper = data;
                    },'json')
                    $('#myModal').modal('show');
                }else{
                    alert('请选择科目');
                }
            },
            randomTest:function(){
                var _this = this;
                $.get('teacher/get_paper',{
                            courseId:this.courseId,
                            selectNum:this.selectNum,
                            optionNum:this.optionNum,
                            checkNum:this.checkNum
                        },function(data){
                            _this.testPaper = data;
                    },'json')
            },
            getPage:function(){
                $('.modal-body').wordExport(this.wordName?this.wordName:'自测题'); 
            }
        }
    })
    // $('.confirm').confirm({
    //     title: '确认生成？',
    //     content: 'Simple confirm!',
    //     confirm: function(){
    //         $.alert('Confirmed!');
    //     },
    //     cancel: function(){
    //         $.alert('Canceled!')
    //     }
    // })
    
</script>