<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
	public function index()
	{
	    //到模型user_model下的get_ten方法获取公告信息
        $data['all']=  $this->user_model->get_ten('article');
        //到模型user_model下的get_w方法获取考试新闻
        $data['news']=  $this->user_model-> get_w('article',array('c_id'=>'1'));
        //到模型user_model下的get_w方法获取考试信息
        $data['info']=  $this->user_model-> get_w('article',array('c_id'=>'2'));
        //显示主页
		$this->load->view('index',$data);
	}
	public function login()
    {
        //显示登录
        $this->load->view('login');
    }
    public function check_login()
    {
        //接收前台数据
        $name=$_POST['uname'];
        $id=$_POST['id'];
        $pwd=$_POST['pwd'];
        $arr=array(
            'u_name'=>$name,
            'id_num'=>$id,
            'password'=>$pwd
        );
        //将数据传到模型user_model下的get_bu_num方法
        $res=$this->user_model->get_by_num('t_user',$arr);
        if($res){
            //登录成功，设置session
            $this->session->set_userdata(array(
                'user'=>$res[0]
            ));
            echo 'yes';
        }else{
            echo 'no';
        }
    }
    public function auto_login(){
        //自动登录
        $id = $this->input->get('id');
        $result = $this->user_model->get_user_by_id($id);
        //登录成功，设置session
        $this->session->set_userdata(array(
            'user'=>$result[0]
        ));
        redirect("welcome/index");
    }
    public function unlogin()
    {
        //注销session user
        $this->session->unset_userdata('user');
        //查询是否有session user
        $res=$this->session->userdata('user');
        if($res==null){
            echo 'yes';
        }else{
            echo 'no';
        }
    }
    public function regist()
    {
       //显示注册界面
        $this->load->view('regist');
    }
    public function check_id()
    {
        //接收前台数据
        $id = $_GET['cid'];
        $arr = array(
          'id_num'=> $id
        );
        //到模型user_model下的check方法
        $res=$this->user_model->check('t_user',$arr);
        echo json_encode($res);
    }
    public function add_user()
    {
        //接收前台数据
        $uname = $_POST['uname'];
        $id = $_POST['id'];
        $pwd = $_POST['pwd'];
        $arr = array(
            'u_name' => $uname,
            'id_num' => $id,
            'password' => $pwd,
            'state'=>'0'
        );
        //到模型user_model下的add方法
        $res = $this->user_model->add('t_user',$arr);
        echo $res;
    }
    public function signup()
    {
        //查询是否有session user
        if($this->session->userdata('user')){
            //获取session数据
            $user = $_SESSION['user'];
            $uid = $user->u_id;
            //到模型user_model下的get_all方法
            $arrall =  $this->user_model->get_all('subject');
            $le1=count($arrall);
            //到模型user_model下的get_by_num方法
            $arr = $this->user_model->get_by_num('signup',array('u_id'=>$uid));
            $le2=count($arr);
            for($i=0;$i<$le1;$i++){
                for($j=0;$j<$le2;$j++){
                    if($arrall[$i]['s_name']==$arr[$j]->s_name){
                        array_splice($arrall,$i,1);
                        $le1=count($arrall);
                        continue;
                    }
                }
            }
            $data['list']= $arrall;
            //显示报名界面
            $this->load->view('signup',$data);
        }else{
            redirect('welcome/login');
        }
    }
    public function signinfo()
    {
        //查询是否有session user
        if($this->session->userdata('user')){
            //获取前台数据
            $sid=$_GET['sid'];
            //到模型user_model下的get_by_num方法
            $data['res']=$this->user_model->get_by_num('subject',array('s_id'=>$sid));
            //获取session数据
            $user=$_SESSION['user'];
            $uid=$user->u_id;
            //到模型user_model下的get_a方法
            $data['list']=  $this->user_model->get_a('t_user',array('u_id'=>$uid));
            //显示报名信息
            $this->load->view('signinfo',$data);
        }else{
            redirect('welcome/login');
        }
    }
    public function sign_add()
    {
        //获取session数据
        $user=$_SESSION['user'];
        $uid=$user->u_id;
        //获取前台数据
        $sname = $_POST['sname'];
        //到模型user_model下的get_all方法
            $res = $this->user_model->add('signup',array(
                's_name'=>$sname,
                'u_id'=>$uid,
                'state'=>'2'
            ));
        echo $res;
    }

    public function news()
    {
        //设置CI分页类
        $this->load->library('pagination');
        $total = $this->user_model->get_count('article',array('c_id'=>'1'));
        $config['base_url'] = base_url().'welcome/news';//当前控制器方法
        $config['total_rows'] = $total;//总数
        $config['per_page'] = 10;//每页显示条数
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['cur_tag_open'] = '<li><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        //到模型user_model下的get_art方法
        $results = $this->user_model->get_art('article',array('c_id'=>1),$this->uri->segment(3),$config['per_page']);
        //显示考试新闻页面
        $this->load->view('news',array(
            'list'=>$results,
            'links'=>$links,
        ));
    }
    public function information()
    {
        //设置CI分页类
        $this->load->library('pagination');
        $total = $this->user_model->get_count('article',array('c_id'=>'2'));

        $config['base_url'] = base_url().'welcome/news';//当前控制器方法
        $config['total_rows'] = $total;//总数
        $config['per_page'] = 10;//每页显示条数
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['cur_tag_open'] = '<li><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        //到模型user_model下的get_art方法
        $results = $this->user_model->get_art('article',array('c_id'=>2),$this->uri->segment(3),$config['per_page']);
        //显示考试信息页面
        $this->load->view('information',array(
            'list'=>$results,
            'links'=>$links,
        ));
    }
    public function detail()
    {
        //获取前台数据
        $aid = $_GET['a_id'];
        //到模型user_model下的get_a方法 获取文章
        $data['article']=  $this->user_model->get_a('article',array('a_id'=>$aid));
        //显示详细信息页面
        $this->load->view('detail',$data);
    }
    public function personal()
    {
        //查询是否有session user
        if($this->session->userdata('user')){
            //获取session数据
            $user=$_SESSION['user'];
            $uid=$user->u_id;
            //到模型user_model下的get_a方法 获取用户信息
            $data['list']=  $this->user_model->get_a('t_user',array('u_id'=>$uid));
            //到模型user_model下的get_a方法 获取报名信息
            $data['res']=  $this->user_model->get_a('signup',array('u_id'=>$uid));
            //显示个人管理页面
            $this->load->view('personal',$data);
        }else{
            redirect('welcome/login');
        }
    }
    public function upload_img()
    {
        //获取session信息
        $user=$_SESSION['user'];
        $uid=$user->u_id;
        $cid=$user->id_num;
        //接收前台数据
        $config['upload_path'] = 'images/head';
        $config['allowed_types'] = 'gif|png|jpg|jpeg';
        $config['overwrite'] = true;
        $config['max_size'] = '200';
        $config['file_name'] = $cid;
        $this->load->library('upload',$config);
        //照片上传是否成功
        if(! $this->upload->do_upload('pic')){
            //失败  到模型user_model下的get_a方法查询用户信息
            echo "<script>alert('图片上传失败')</script>";
            $data['list']=  $this->user_model->get_a('t_user',array('u_id'=>$uid));
            //显示个人管理
            $this->load->view('personal',$data);
        }else{
            //成功   到模型user_model下的update方法更新用户信息
            $data = $this->upload->data();
            $img = $data['file_name'];
            $res=$this->user_model->update('t_user',array("u_id"=>$uid),array(
                'img'=>$img
            ));
            //个人信息修改是否成功
            if ($res==1) {
                //成功   到模型user_model下的get_by_num方法查询用户信息
                $result = $this->user_model->get_by_num('t_user', array("u_id" => $uid));
                if ($result) {
                    //查询成功设置session
                    $this->session->set_userdata(array(
                        'user' => $result[0]
                    ));
                    redirect('welcome/personal');
                } else {
                    //失败  到模型user_model下的get_a方法查询用户信息
                    echo "<script>alert('修改失败')</script>";
                    $data['list'] = $this->user_model->get_a('t_user', array('u_id' => $uid));
                    //显示个人管理
                    $this->load->view('personal', $data);
                }
            }
        }
    }
    public function upload()
    {
        //获取session信息
        $user = $_SESSION['user'];
        $uid = $user->u_id;
        //接收前台数据
        $uname = $_POST['uname'];
        $sex = $_POST['sex'];
        $status = $_POST['status'];
        $school = $_POST['school'];
        $major = $_POST['major'];
        $cid = $_POST['cid'];
        $address = $_POST['address'];
        $province = $_POST['province'];
        //到模型user_model下的update方法更新用户信息
        $res = $this->user_model->update('t_user', array('u_id'=>$uid), array(
            'u_name' => $uname,
            'id_num' => $cid,
            'sex' => $sex,
            'province' => $province,
            'address' => $address,
            'school' => $school,
            'major' => $major,
            'status' => $status
        ));
        //个人信息修改是否成功
        if ($res == 1) {
            //成功   到模型user_model下的get_by_num方法查询用户信息
            $result = $this->user_model->get_by_num('t_user', array("u_id"=>$uid));
            if ($result) {
                //查询成功设置session
                $this->session->set_userdata(array(
                    'user' => $result[0]
                ));
                redirect('welcome/personal');
            } else {
                //失败  到模型user_model下的get_a方法查询用户信息
                echo "<script>alert('修改失败')</script>";
                $data['list'] = $this->user_model->get_a('t_user', array('u_id' => $uid));
                //显示个人管理
                $this->load->view('personal', $data);
            }
        }
    }
    public function sign_del()
    {
        //获取session信息
        $user = $_SESSION['user'];
        $uid = $user->u_id;
        //接收前台数据
        $sname = $_POST['sname'];
        //到模型user_model下的del方法删除报名信息
        $res = $this->user_model->del('signup',array(
            's_name'=>$sname,
            'u_id'=>$uid
        ));
        echo $res;
    }
    public function print_exam(){
        //查询是否有session user
        if($this->session->userdata('user')){
            //获取session信息
            $user=$_SESSION['user'];
            $uid=$user->u_id;
            //到模型user_model下的get_a方法获取报名信息
            $data['res']=  $this->user_model->get_a('signup',array('u_id'=>$uid,'state'=>1));
            $this->load->view('print',$data);
        }else{
            redirect('welcome/login');
        }
    }
    public function print_page()
    {
        //查询是否有session user
        if($this->session->userdata('user')){
            //获取session信息
            $user=$_SESSION['user'];
            $uid=$user->u_id;
            //接收前台数据
           $sname = $_GET['sname'];
           //到模型user_model下的get_a方法获取用户信息
            $data['res']=  $this->user_model->get_a('t_user',array('u_id'=>$uid));
            //到模型user_model下的get_a方法获取考试信息
            $data['list']=  $this->user_model->get_a('subject',array('s_name'=>$sname));
            $this->load->view('print_page',$data);
        }else{
            redirect('welcome/login');
        }
    }
}
