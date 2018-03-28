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
            background: #b92c28;
            color: #ffffff;
        }
        .green{
            background: #3e8f3e;
            color: #ffffff;
        }
        .blue{
            color: #245580;
            cursor: pointer;
        }
        .table th,.table td{
            text-align: center;
        }
    </style>
</head>
<body>
<?php include 'header.php';?>

<div class="container">
    <?php include 'user.php';?>
    <div class="row">
        <div class="content col-md-8">
            <h4>
                <b>用户管理</b>
            </h4>
            <div class="table-responsive">
                <table class="table table-striped">
                   <tr>
                       <th>用户</th>
                       <th>操作</th>
                   </tr>
                    <?php foreach ($list as $row){ ?>
                    <tr>
                        <td class="<?php echo $row->u_id;?>"><?php echo $row->u_name;?></td>
                        <td class="blue" @click="choose" data-toggle="modal" data-target="#myModal3">审核</td>
                    </tr>
                    <?php } ;?>
                </table>
            </div>
        </div>
        <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="myModalLabel">审核是否通过</h3>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered table-hover" v-for="obj in reslist">
                                    <tr>
                                        <th class="col-md-2">姓名：</th>
                                        <td class="col-md-2">{{obj.u_name}}
                                        </td>
                                        <th class="col-md-2">性别：</th>
                                        <td class="col-md-2">{{obj.sex}}
                                        </td>
                                        <td rowspan="5" class="col-md-2">
                                                <img class="img" :src="'images/head/'+obj.img" alt="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-2">籍贯：</th>
                                        <td class="col-md-2">{{obj.province}}
                                        </td>
                                        <th class="col-md-2">政治面貌：</th>
                                        <td class="col-md-2">{{obj.status}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-2">年龄：</th>
                                        <td class="col-md-2">
                                                {{age}}
                                        </td>
                                        <th class="col-md-2">出生日期：</th>
                                        <td class="col-md-2">
                                            {{bir}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-2">毕业院校：</th>
                                        <td class="col-md-2">
                                            {{obj.school}}
                                        </td>
                                        <th class="col-md-2">专业：</th>
                                        <td class="col-md-2">
                                            {{obj.major}}
                                        </td>
                                    </tr>
                                    <tr >
                                        <th class="col-md-2">身份证号码：</th>
                                        <td class="col-md-2" colspan="3">
                                            {{obj.id_num}}
                                        </td>
                                    </tr>
                                    <tr >
                                        <th class="col-md-2">联系地址：</th>
                                        <td colspan="4" >
                                            {{obj.address}}
                                        </td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary green" @click="yes" >是</button>
                        <button type="button" class="btn btn-default red"  @click="no">否</button>
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
            resall:[],
            reslist:[],
            age:'',
            bir:'',
            id:''
        },
        methods:{
            cancel:function () {
                //注销登录 到控制台 admin下 unlogin方法
                $.post('admin/unlogin',function (data) {
                    if(data=='yes'){
                        location='admin/index'
                    }
                },'text');
            },
            choose:function (e) {
                var _this =this;
                //获取点击目标的兄弟元素td的class名
                var id  = $(e.target).prev('td').attr('class');
                _this.id = id;
                //以获取的td的class名为参数到控制台admin下的per_id方法查询
               $.getJSON('admin/per_id?callback=?',{data:id },function (res) {
                   //对查询返回结果的json数据赋值
                  _this.resall=res;
                  _this.reslist=res;
                  var cid = res[0].id_num;
                   var d = new Date();
                  var year = cid.substr(6,4);
                  _this.age = d.getFullYear()-year;
                 var mm = cid.substr(10,2);
                 var dd = cid.substr(12,2);
                 _this.bir = mm + "-" + dd;
               })
            },
            yes:function () {
                $('#myModal3').modal('hide');
                //将审核结果传到控制台admin下的per_update方法
                $.post('admin/per_update',{id:this.id,state:1},function (res) {
                        if(res ==1){
                            alert('审核成功');
                            location='admin/personal';

                        }else {
                            alert('审核失败');
                            location='admin/personal';

                        }
                },'text')
            },
            no:function () {
                $('#myModal3').modal('hide');
                //将审核结果传到控制台admin下的per_update方法
                $.post('admin/per_update',{id:this.id,state:2},function (res) {
                        if(res ==1){
                            alert('审核成功');
                            location='admin/personal';
                        }else {
                            alert('审核失败');
                            location='admin/personal';

                        }
                },'text')
            }
        }
    })
</script>
</body>
</html>