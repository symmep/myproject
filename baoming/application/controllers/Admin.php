<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }
    public function index()
    {
        //显示登录界面
        $this->load->view('admin/login');
    }
    public function check_login()
    {
        //接收前台数据
        $name = $_POST['uname'];
        $pwd = $_POST['pwd'];
        $arr = array(
            'ad_name' => $name,
            'ad_pwd' => $pwd
        );
        //将数据传到模型admin_model下的get_bu_num方法
        $res = $this->admin_model->get_by_num('admin', $arr);
        if ($res) {
            //登录成功，设置session
            $this->session->set_userdata(array(
                'admin' => $res[0]
            ));
            echo 'yes';
        } else {
            echo 'no';
        }
    }
    public function unlogin()
    {
        //注销session admin
        $this->session->unset_userdata('admin');
        //查询是否有session admin
        $res=$this->session->userdata('admin');
        if($res==null){
            echo 'yes';
        }else{
            echo 'no';
        }
    }
    public function manage()
    {
        //查询是否有session admin 有则显示管理界面，否则返回登录界面
        if($this->session->userdata('admin')){

            $this->load->view('admin/manage');
        }else{
            redirect('admin/');
        }
    }
    public function personal()
    {
        //查询是否有session admin 有则显示用户管理界面，否则返回登录界面
        if($this->session->userdata('admin')){
            $data['list']=$this->admin_model->get_by_num('t_user',array('state'=>0));
            $this->load->view('admin/personal',$data);
        }else{
            redirect('admin/');
        }
    }
    public function per_id()
    {
        //接收前台数据
        $callback = $_GET['callback'];
        $uid = $_GET['data'];
        //以用户id、表t_user为参数到模型admin_model下的get_by_num方法查询
        $res=$this->admin_model->get_by_num('t_user',array('u_id'=>$uid));
        echo $callback."(".json_encode($res).")";
    }
    public function per_update()
    {
        //接收前台数据
        $uid = $_POST['id'];
        $state = $_POST['state'];
        //以用户审核状态、表t_user为参数到模型admin_model下的update方法查询
        $res = $this->admin_model->update('t_user',array('u_id'=>$uid),array('state'=>$state));
        echo $res;
    }
    public function exam_update()
    {
        //接收前台数据
        $uid = $_POST['id'];
        $state = $_POST['state'];
        $sname = $_POST['sname'];
        //以用户审核状态、表t_user为参数到模型admin_model下的update方法查询
        $res = $this->admin_model->update('signup',array('u_id'=>$uid,'s_name'=>$sname),array('state'=>$state));
        print_r($res);
    }
    public function exam_updatey()
    {
        //接收前台数据
        $uid = $_POST['id'];
        $state = $_POST['state'];
        $sname = $_POST['sname'];
        $cid = $_POST['cid'];
        //以用户审核状态、表t_user为参数到模型admin_model下的update方法查询
        $res = $this->admin_model->update('signup',array('u_id'=>$uid,'s_name'=>$sname),array('state'=>$state));
        print_r($res);
    }
    public function exam()
    {
        //查询是否有session admin 有则显示考试管理界面，否则返回登录界面
        if($this->session->userdata('admin')){
            $data['list']=$this->admin_model->get_all('subject');
            $this->load->view('admin/exam',$data);
        }else{
            redirect('admin/');
        }
    }
    public function examinfo()
    {
        //查询是否有session admin 有则显示考试信息界面，否则返回登录界面
        if($this->session->userdata('admin')){
            $sname = $_GET['s_name'];
           $sql = "select * from signup,t_user WHERE signup.u_id=t_user.u_id AND s_name='$sname' AND signup.state=2";
            $data['list']=$this->admin_model->querylist($sql);
            $this->load->view('admin/examinfo',$data);
        }else{
            redirect('admin/');
        }
    }
}
