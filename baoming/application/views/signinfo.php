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
        .btn1{
            width:45%;
            float: left;
        }
        .btn2{
            width:45%;
            float: right;
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
                    <b> <?php foreach ($res as $row){ echo $row->s_name;} ?>在线报名</b>
                </h4>
                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <?php foreach ($list as $row){?>
                                <tr>
                                    <th class="col-md-2">姓名：</th>
                                    <td class="col-md-2">
                                        <span class="uname"><?php echo $row['u_name'];?></span>
                                    </td>
                                    <th class="col-md-2">性别：</th>
                                    <td class="col-md-2">
                                        <span class="sex"><?php echo $row['sex'];?></span>
                                    </td>
                                    <td rowspan="5" class="col-md-2">
                                        <?php if($row['img']!=''){?>
                                            <img class="img" src="images/head/<?php echo $row['img'];?>" alt="">
                                        <?php }else{?>
                                            <p style="font-size: 20px;width: 20px;margin: 0 auto" >请上传照片</p>
                                        <?php }?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">籍贯：</th>
                                    <td class="col-md-2">
                                        <span class="province"><?php echo $row['province'];?></span>
                                    </td>
                                    <th class="col-md-2">政治面貌：</th>
                                    <td class="col-md-2">
                                        <span class="status"><?php echo $row['status'];?></span>
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
                                        <span class="school"><?php echo $row['school'];?></span>
                                    </td>
                                    <th class="col-md-2">专业：</th>
                                    <td class="col-md-2">
                                        <span class="major"><?php echo $row['major'];?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">身份证号码：</th>
                                    <td class="col-md-2" colspan="3">
                                        <span class="id_num"><?php echo $row['id_num'];?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">联系地址：</th>
                                    <td colspan="4" >
                                        <span class="address"><?php echo $row['address'];?></span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    <button class="btn1 btn btn-default" @click="check">确认报名</button>
                    <button class="btn2 btn btn-default" @click="back">取消</button>
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

        },
        methods:{
            cancel:function () {
                //注销登录 到控制台 welcome下 unlogin方法
                $.post('welcome/unlogin',function (data) {
                    if(data=='yes'){
                        location='welcome/index'
                    }
                },'text');
            },
            back:function () {
                location='welcome/index'
            },
            check:function () {
                var nuame = $('.uname').html();
                var id_num = $('.id_num').html();
                var sex = $('.sex').html();
                var province = $('.province').html();
                var address = $('.address').html();
                var school = $('.school').html();
                var major = $('.major').html();
                var status = $('.status').html();
                var img = $('.table').find('img');
                //验证信息是否完整，完整后以科目名为参数到控制台welcome下的sign_add方法
               if(nuame!='' && id_num!='' && sex!='' && province!='' && address!='' && school!='' && major!='' && status!='' && img.length==1){
                   var sname = "<?php foreach ($res as $row){ echo $row->s_name;} ?>";
                   $.post('welcome/sign_add',{sname:sname},function (res) {
                       if(res==1){
                           alert('报名成功，可在个人管理中查看审核状态。');
                           location='welcome/index'
                       }else{
                           alert('报名失败，请稍候再试！')
                       }
                   },'text')
               }else {
                   alert('信息不全，请到个人管理补全个人信息！')
               }
            }
        }
    })
</script>
</body>
</html>