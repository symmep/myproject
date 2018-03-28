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
    <style>
        .table{
            width: 500px;
            margin: 0 auto;
        }
        table img{
            width: 100%;
        }
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
            text-align: left;
        }
        .col-md-6{
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <table class="table">
                <h3>准考证</h3>

                <?php foreach ($res as $row){?>
                    <tr>
                        <th class="col-md-2">姓名：</th>
                        <td class="col-md-2"><span ><?php echo $row['u_name'];?></span>
                        </td>
                        <td rowspan="6" class="col-md-2" >
                            <img class="img" src="images/head/<?php echo $row['img'];?>" alt="">
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-2">性别：</th>
                        <td class="col-md-2">
                            <span ><?php echo $row['sex'];?></span>
                        </td>
                    </tr>
                    <tr >
                        <th class="col-md-2">身份证号码：</th>
                        <td class="col-md-2" >
                            <span><?php echo $row['id_num'];?></span>
                        </td>
                    </tr>
                    <tr >
                        <th class="col-md-2">准考证号：</th>
                        <td >
                            <span><?php echo $row['id_num'].$_GET['id'];?></span>
                        </td>

                    </tr>
                    <tr >
                        <th class="col-md-2">考试科目</th>
                        <td  >
                            <span><?php echo $_GET['sname'];?></span>
                        </td>

                    </tr>
                    <?php }?>
                    <tr >
                        <th class="col-md-2">考试时间：</th>
                        <td  >
                            <?php foreach ($list as $row){?>
                            <span><?php  $arr1 = explode(" ",$row['date_s']);$arr2 = explode(" ",$row['date_e']);echo $arr1[1]."-".$arr2[1];?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                <?php } ?>
            </table>
            <button class="button" @click="print">打印</button>
            <button class="button" @click="out">取消</button>
        </div>
    </div>
</div>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/vue.js"></script>
<script>
    var vm =new Vue({
        el:'.container',
        methods:{
            print:function () {
                //打印本页面
                window.print();
            },
            out:function () {
                location="welcome/index"
            }
        }
    })
</script>
</body>
</html>