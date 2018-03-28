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
        #container{
            background-image: url('images/index-bg.gif');
            background-repeat:no-repeat;
            -webkit-background-size: 100% 100%;
            background-size: 100% 100%;
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
        },
        methods:{
            cancel:function () {
                $.post('student/unlogin',function (data) {
                  if(data=='yes'){
                      location='welcome/login'
                  }
                },'text');
            }
        }
    })
</script>
</body>
</html>