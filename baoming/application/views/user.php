<div class="user">
    <?php $user=$this->session->userdata('user');if (isset($user)){
        echo '欢迎您：'.$user->u_name.'&nbsp&nbsp<span data-toggle="modal" data-target="#myModal">注销</span>';
    }else{
        echo '<a href="welcome/login">登录</a>&nbsp&nbsp<a href="welcome/regist">注册</a>';
    }?>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">注销登录</h3>
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