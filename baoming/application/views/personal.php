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
        h4{
            position: relative;
            margin:0;
            padding: 0 20px;
            background: url("images/dian.gif") 12px 12px no-repeat #fef9f5;
            height: 35px;
            border-top: #b90300 3px solid;
            padding-left: 26px;
            color: #a70500;
            line-height: 35px;
        }
        .title{
            padding: 10px 25px;
            border: #f6dac4 1px solid;
        }
        .title a{
            color:#6b0e00;
            font-size: 14px;
            line-height: 220%;
        }
        .page{
            list-style: none;
            overflow: hidden;
        }
        .page li{
            float: left;
            margin: 0 5px;
        }
        .table-responsive{
            margin-top:20px;
        }
        table td[class*="col-"]{
            position: relative;
        }
        table img{
            width: 100%;
        }
        em{
            position: absolute;
            font-size: 12px;
            line-height: 20px;
            padding-right: 10px;
            font-style: normal;
            right: 0;
            bottom: 0;
            cursor: pointer;
        }
        .btn1,.btn2{
            width:45%;
            float: left;
        }
        .btn1{
            margin-right: 45px;
        }
        .f_input{
            width:100%;
        }
        .err1 {
            position: absolute;
            color: #a94442;
            right: 0;
            top: 50%;
        }
        .err2{
            color: #a94442;
        }
        .yellow{
            color: #eb9316;
        }
        .red{
            color: #b92c28;
        }
        .green{
            color: #3e8f3e;
        }
        .blue{
            color: #245580;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php include 'header.php';?>

<div class="container">
    <?php include 'user.php';?>
    <div class="row">
        <div class="content col-md-8">
            <div class="list">
                <h4>
                    <b>个人信息</b>
                    <em @click="{revise=!revise,flag=true,flag1=true,flag2=true,flag3=true,flag4=true,flag5=true,flag6=true,flag7=true}"><span v-if="revise">修改信息</span><span v-else>取消</span></em>
                </h4>
                <form action="welcome/upload" method="post" class="form1">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <?php foreach ($list as $row){?>
                                <tr>
                                    <th class="col-md-2">姓名：</th>
                                    <td class="col-md-2"><span v-if="revise"><?php echo $row['u_name'];?></span>
                                        <input v-else class="f_input" type="text" name="uname"  placeholder="<?php echo $row['u_name'];?>">
                                        <span class="glyphicon glyphicon-remove-circle err1" aria-hidden="true" v-show="!flag"></span>
                                    </td>
                                    <th class="col-md-2">性别：</th>
                                    <td class="col-md-2">
                                        <span v-if="revise"><?php echo $row['sex'];?></span>
                                        <select class="f_input" name="sex"  v-else>
                                            <option value="<?php echo $row['sex'];?>"><?php echo $row['sex'];?></option>
                                            <option value="男">男</option>
                                            <option value="女">女</option>
                                        </select>
                                        <span class="glyphicon glyphicon-remove-circle err1" aria-hidden="true" v-show="!flag6"></span>
                                    </td>
                                    <td rowspan="5" class="col-md-2" v-if="revise">
                                        <?php if($row['img']!=''){?>
                                            <img class="img" src="images/head/<?php echo $row['img'];?>" alt="">
                                        <?php }else{?>
                                            <p style="font-size: 20px;width: 20px;margin: 0 auto" >请上传照片</p>
                                        <?php }?>
                                    </td>
                                    <td rowspan="5" class="col-md-2" v-else>
                                        <?php if($row['img']!=''){?>
                                            <img class="img" src="images/head/<?php echo $row['img'];?>" alt="">
                                        <?php }else{?>
                                            <p style="font-size: 20px;width: 20px;margin: 0 auto" >请上传照片</p>
                                        <?php }?></td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">籍贯：</th>
                                    <td class="col-md-2">
                                        <span v-if="revise"><?php echo $row['province'];?></span>
                                        <input v-else class="f_input" type="text" name="province" placeholder="<?php echo $row['province'];?>">
                                        <span class="glyphicon glyphicon-remove-circle err1" aria-hidden="true" v-show="!flag1"></span>
                                    </td>
                                    <th class="col-md-2">政治面貌：</th>
                                    <td class="col-md-2">
                                        <span v-if="revise"><?php echo $row['status'];?></span>
                                        <select class="f_input" name="status"  v-else >
                                            <option value="<?php echo $row['status'];?>"><?php echo $row['status'];?></option>
                                            <option value="团员">团员</option>
                                            <option value="党员">党员</option>
                                            <option value="群众">群众</option>
                                        </select>
                                        <span class="glyphicon glyphicon-remove-circle err1" aria-hidden="true" v-show="!flag7"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">年龄：</th>
                                    <td class="col-md-2"><?php  $y = substr($row['id_num'],6,4);echo date("Y")-$y; ?></td>
                                    <th class="col-md-2">出生日期：</th>
                                    <td class="col-md-2"><?php  $m = substr($row['id_num'],10,2);$d = substr($row['id_num'],12,2);echo $m."-".$d; ?></td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">毕业院校：</th>
                                    <td class="col-md-2">
                                        <span v-if="revise"><?php echo $row['school'];?></span>
                                        <input v-else class="f_input" type="text" name="school" placeholder="<?php echo $row['school'];?>">
                                        <span class="glyphicon glyphicon-remove-circle err1" aria-hidden="true" v-show="!flag2"></span>

                                    </td>
                                    <th class="col-md-2">专业：</th>
                                    <td class="col-md-2">
                                        <span v-if="revise"><?php echo $row['major'];?></span>
                                        <input v-else class="f_input" type="text" name="major" placeholder="<?php echo $row['major'];?>">
                                        <span class="glyphicon glyphicon-remove-circle err1" aria-hidden="true" v-show="!flag3"></span>
                                    </td>
                                </tr>
                                <tr v-if="revise">
                                    <th class="col-md-2">身份证号码：</th>
                                    <td class="col-md-2" colspan="3">
                                        <span><?php echo $row['id_num'];?></span>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <th class="col-md-2">身份证号码：</th>
                                    <td class="col-md-2" colspan="3">
                                        <input class="f_input" type="text" name="cid" placeholder="<?php echo $row['id_num'];?>">
                                        <span class="glyphicon glyphicon-remove-circle err1" aria-hidden="true" v-show="!flag4"></span>
                                    </td>
                                </tr>
                                <tr v-if="revise">
                                    <th class="col-md-2">联系地址：</th>
                                    <td colspan="3" >
                                        <span ><?php echo $row['address'];?></span>
                                    </td>
                                    <td class="col-md-2">
                                        <button class="f_input" type="button"data-toggle="modal" data-target="#myModal2">修改照片</button>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <th class="col-md-2">联系地址：</th>
                                    <td colspan="3" >
                                        <input class="f_input" type="text" name="address" placeholder="<?php echo $row['address'];?>">
                                        <span class="glyphicon glyphicon-remove-circle err1" aria-hidden="true" v-show="!flag5"></span>
                                    </td>
                                    <td class="col-md-2">
                                        <button class="f_input" type="button"data-toggle="modal" data-target="#myModal2">修改照片</button>
                                    </td>
                                </tr>
                                <tr v-show="!revise">
                                    <td colspan="5"><button class="btn1" type="button" @click="bl" data-toggle="modal" data-target="#myModal1">确认修改</button><button class="btn2" type="button" @click="{revise=true,flag=true,flag1=true,flag2=true,flag3=true,flag4=true,flag5=true,flag6=true,flag7=true}">取消</button></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </form>
                <h4>
                    <b>已报名科目</b>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>考试科目</th>
                            <th>审核状态</th>
                            <th>操作</th>
                        </tr>
                        <?php foreach ($res as $row) {?>
                       <tr>
                           <td><?php echo $row['s_name']?></td>
                            <?php if ($row['state']==2){?>
                                <td class="yellow">待审核</td>
                           <?php }else{?>
                           <?php if($row['state']==1){?>
                           <td class="green">已通过</td>
                           <?php }else{?>
                           <td class="red">未通过</td>
                           <?php } ?>
                           <?php } ?>
                           <td class="blue" data-toggle="modal" data-target="#myModal3" @click="choose">注销考试</td>
                       </tr>
                        <?php   }?>
                    </table>
                </div>
                <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" id="myModalLabel" v-if="!flagall">提交失败：</h3>
                                <h3 class="modal-title" id="myModalLabel" v-else>确认提交：</h3>
                            </div>
                            <div class="modal-body">
                                <ul>
                                    <li v-if="flagall">请确认</li>
                                    <li v-for="value in code" class="err2" v-else>{{value}}</li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="sub" v-if="flagall">确认</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" v-else>确认</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" id="myModalLabel">修改头像</h3>
                            </div>
                            <div class="modal-body">
                                <form class="form2" action="welcome/upload_img" method="post" enctype="multipart/form-data">
                                    <input type="file" name="pic">
                                    <p>(上传文件大小最大为200KB)</p>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="sub1">确认</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" id="myModalLabel">注销考试</h3>
                            </div>
                            <div class="modal-body">
                                确认注销：{{course}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="confirm" >确认</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'nav.php';?>
    </div>
</div>
<?php include 'footer.php';?>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/vue.js"></script>
<script>
    var vm =new Vue({
        el:'.container',
        data:{
            revise:true,
            redcode1 : true,
            redcode2 : true,
            flag:true,
            flag1:true,
            flag2:true,
            flag3:true,
            flag4:true,
            flag5:true,
            flag6:true,
            flag7:true,
            flagall:true,
            code:[],
            course:''
        },
        methods:{
            bl:function () {
                var  regName =  /^([\u4e00-\u9fa5]{2,})$/ ;
                //验证姓名正则
                var ph = $('input[name="uname"]').attr('placeholder');
                var uname = $('input[name="uname"]').val();
                if(uname==''&& ph==''){
                    this.flag = false;
                    this.redcode1 = false;
                }else if (regName.test(uname)||regName.test(ph)){
                    this.flag = true;
                    this.redcode1 = true;
                    this.redcode2 = true;
                    if(uname==''){
                        $('input[name="uname"]').val(ph);
                    }
                }else {
                    this.flag = false;
                    this.redcode2 = false;
                }
                //验证籍贯正则
                var ph1 = $('input[name="province"]').attr('placeholder');
                var province = $('input[name="province"]').val();
                if(province==''&& ph1==''){
                    this.flag1 = false;
                    this.redcode1 = false;
                }else if (regName.test(province)||regName.test(ph1)){
                    this.flag1 = true;
                    this.redcode1 = true;
                    this.redcode2 = true;
                    if(province==''){
                        $('input[name="province"]').val(ph1);
                    }
                }else{
                    this.flag1 = false;
                    this.redcode2 = false;
                }
                //验证学校
                var ph2 = $('input[name="school"]').attr('placeholder');
                var school = $('input[name="school"]').val();
                if(school==''&& ph2==''){
                    this.flag2 = false;
                    this.redcode1 = false;
                }else if (regName.test(school)||regName.test(ph2)){
                    this.flag2 = true;
                    this.redcode1 = true;
                    this.redcode2 = true;
                    if(school==''){
                        $('input[name="school"]').val(ph2);
                    }
                }else{
                    this.flag2 = false;
                    this.redcode2 = false;
                }
                //验证专业
                var ph3 = $('input[name="major"]').attr('placeholder');
                var major = $('input[name="major"]').val();
                if(major==''&& ph3==''){
                    this.flag3 = false;
                    this.redcode1 = false;
                }else if (regName.test(major)||regName.test(ph3)){
                    this.flag3 = true;
                    this.redcode1 = true;
                    this.redcode2 = true;
                    if(major==''){
                        $('input[name="major"]').val(ph3);
                    }
                }else{
                    this.flag3 = false;
                    this.redcode2 = false;
                }
                //验证身份证
                var ph4 = $('input[name="cid"]').attr('placeholder');
                var cid = $('input[name="cid"]').val();
                var regIdCard=/^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/;
                var arrExp = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];//加权因子
                var arrValid = [1, 0, "X", 9, 8, 7, 6, 5, 4, 3, 2];//校验码
                if (cid==''&& ph4==''){
                    this.flag4 =false;
                    this.redcode1 = false;
                }else if(regIdCard.test(cid)||regIdCard.test(ph4)){
                    var sum = 0, idx;
                    var arr = cid || ph4;
                    for(var i = 0; i < arr.length - 1; i++){
                        // 对前17位数字与权值乘积求和
                        sum += parseInt(arr.substr(i, 1), 10) * arrExp[i];
                    }
                    // 计算模（固定算法）
                    idx = sum % 11;
                    // 检验第18为是否与校验码相等
                    if(arrValid[idx] == arr.substr(17, 1).toUpperCase()){
                        this.flag4 =true;
                        this.redcode1 = true;
                        this.redcode2 = true;
                        if(cid==''){
                            $('input[name="cid"]').val(ph4)
                        }
                    }else {
                        this.flag4 =false;
                        this.redcode2 = false;
                    }
                }else{
                    console.log('222');
                    this.flag4 =false;
                    this.redcode2 = false;
                }
                //验证地址
                var ph5 = $('input[name="address"]').attr('placeholder');
                var address = $('input[name="address"]').val();
                if(address==''&& ph5==''){
                    this.flag5 = false;
                    this.redcode1 = false;
                }else if (address.match(/([^\x00-\xff]|[A-Za-z0-9_])+/)||ph5.match(/([^\x00-\xff]|[A-Za-z0-9_])+/)){
                    this.flag5 = true;
                    this.redcode1 = true;
                    this.redcode2 = true;
                    if(address==''){
                        $('input[name="address"]').val(ph5);
                    }
                }else{
                    this.flag5 = false;
                    this.redcode2 = false;
                }
                //验证性别
                var sex = $('select[name="sex"]').val();
                if (sex==''){
                    this.flag6 = false;
                    this.redcode1 = false;
                }else{
                    this.flag6 = true;
                    this.redcode1 = true;
                }
                //验证政治面貌
                var status = $('select[name="status"]').val();
                if (status==''){
                    this.flag7 = false;
                    this.redcode1 = false;
                }else{
                    this.flag7 = true;
                    this.redcode1 = true;
                }


                if(this.redcode1==false){
                    this.code.push('请将信息补充完整！');
                }else{
                    this.code.splice($.inArray('请将信息补充完整！',this.code),1);
                }
                if(this.redcode2==false){
                    this.code.push('输入不合规范,请重新输入！');
                }else{
                    this.code.splice($.inArray('输入不合规范,请重新输入！',this.code),1);
                }
                if(this.redcode1&&this.redcode2){
                    this.flagall=true;
                    this.code=[];
                }else{
                    this.flagall=false;
                }
            },
            sub:function () {
                //.form1表单提交
                $('.form1').submit()
            },
            sub1:function () {
                //.form2表单提交
                $('.form2').submit()
            },
            choose:function (e) {
                //将点击目标的兄弟元素td的兄弟元素td的内容赋给course
                this.course = $(e.target).prev('td').prev('td').text();
            },
            confirm:function (){
                $('#myModal3').modal('hide');
                //以科目名为参数到控制台welcome下的sign_del方法
                $.post('welcome/sign_del',{sname:this.course},function (res){
                    if(res==1){
                        alert('注销成功');
                        location='welcome/personal';
                    }else {
                        alert('注销失败，请稍候再试');
                        location='welcome/personal';
                    }
                });
            },
            cancel:function () {
                //注销登录 到控制台 welcome下 unlogin方法
                $.post('welcome/unlogin',function (data) {
                    if(data=='yes'){
                        location='welcome/index'
                    }
                },'text');
            }
        }
    })
</script>
</body>
</html>