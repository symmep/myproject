<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_model');
    }
    public function unlogin(){
        $this->session->unset_userdata('s_user');
        $res=$this->session->userdata('s_user');
        if($res==null){
            echo 'yes';
        }else{
            echo 'no';
        }
    }
	public function index()
	{
        if($this->session->userdata('s_user')){
            $this->load->view('student/index');
        }else{
            redirect('welcome/index');
        }
	}
    public function check_num()
    {
       $num=$_POST['data'];
       $arr=array(
           's_num'=>$num
       );
       $res=$this->student_model->get_by_num('student',$arr);
       echo json_encode($res);
    }
    public function regist()
    {
        $num=$_POST['s_num'];
        $password=$_POST['s_pwd'];
        $name=$_POST['s_name'];
        $grade=$_POST['grade'];
        $major=$_POST['major'];
        $arr=array(
            's_num'=>$num,
            's_pwd'=>$password,
            's_name'=>$name,
            'grade'=>$grade,
            'major'=>$major
        );
        $res=$this->student_model->insert_s('student',$arr);
        echo $res;
    }
    public function check_login()
    {
        $name=$_POST['uname'];
        $pwd=$_POST['pwd'];
        $arr=array(
           's_num'=>$name,
           's_pwd'=>$pwd
        );
        $res=$this->student_model->get_by_num('student',$arr);
        if($res){
            $this->session->set_userdata(array('s_user'=>$res));
            echo 'yes';
        }else{
            echo 'no';
        }
    }
    public function student_ifm()
    {
        if($this->session->userdata('s_user')){
            $this->load->view('student/student_ifm');
        }else{
            redirect('welcome/index');
        }

    }
    public function choice_list()
    {
        $callback=$_GET['callback'];
        $user = $_SESSION['s_user'];
        $s_id=$user['s_id'];
        $sql="SELECT *FROM class,class_student WHERE class.c_id=class_student.c_id AND s_id=$s_id";
        $res=$this->student_model->querylist($sql);
        echo $callback."(".json_encode($res).")";
    }
    public function delete_c()
    {
        $user = $_SESSION['s_user'];
        $s_id=$user['s_id'];
        $c_id=$_POST['c_id'];
        $arr=array(
            's_id'=>$s_id,
            'c_id'=>$c_id
        );
        $res=$this->student_model->delete_c('class_student', $arr);
        echo $res;
    }
    public function course()
    {
        if($this->session->userdata('s_user')){
            $this->load->view('student/course');
        }else{
            redirect('welcome/index');
        }

    }
    public function check_cid()
    {
        $user = $_SESSION['s_user'];
        $s_id=$user['s_id'];
        $c_id=$_POST['c_id'];
        $arr=array(
            's_id'=>$s_id,
             'c_id'=>$c_id
         );
         $res=$this->student_model->get_by_num('class_student',$arr);
        echo json_encode($res);
    }
    public function class_list()
    {
        $callback=$_GET['callback'];

        $res=$this->student_model->getlist('class');
        echo $callback."(".json_encode( $res).")";
    } public function class_add()
    {
        $user = $_SESSION['s_user'];
        $s_id=$user['s_id'];
        $c_id=$_POST['c_id'];
        $arr=array(
            's_id'=>$s_id,
            'c_id'=>$c_id
        );
        $res=$this->student_model->insert_s('class_student',$arr);
        echo $res;
    }
    public function test()
    {
        if($this->session->userdata('s_user')){
            $this->load->view('student/test');
        }else{
            redirect('welcome/index');
        }

    }
    public function check_test()
    {
        $user = $_SESSION['s_user'];
        $s_id=$user['s_id'];
        $c_id=$_POST['c_id'];
        $arr=array(
            's_id'=>$s_id,
            'c_id'=>$c_id
        );
        $res=$this->student_model->get_by_num('student_competence',$arr);
        echo json_encode($res);
    }
    public function testing()
    {
        if($this->session->userdata('s_user')){
            $this->load->view('student/testing');
        }else{
            redirect('welcome/index');
        }

    }
    public function test_list(){
        $callback = $_GET['callback'];
        $c_id=$_SESSION['c_id'];
        $sql1="SELECT * 
                from t_select
                where class_id=$c_id
                ORDER BY RAND() LIMIT 10";
        $sql2="SELECT * 
                from checkbox
                where class_id=$c_id
                ORDER BY RAND() LIMIT 5";
        $sql3="SELECT * 
                from opinion
                where class_id=$c_id
                ORDER BY RAND() LIMIT 10";
        $res1=$this->student_model->querylist($sql1);
        $res2=$this->student_model->querylist($sql2);
        $res3=$this->student_model->querylist($sql3);
        $arr= array(
            'sl'=>$res1,
            'cl'=>$res2,
            'ol'=>$res3
        );
        echo $callback."(".json_encode($arr).")";
    }
    public function score_up(){
        $user = $_SESSION['s_user'];
        $s_id=$user['s_id'];
        $c_id=$_SESSION['c_id'];
        $score=$_POST['score'];
        $arr1=array(
            's_id'=>$s_id,
            'c_id'=>$c_id
        );
        $arr2=array(
            's_id'=>$s_id,
            'c_id'=>$c_id,
            'score'=>$score
        );
        $res=$this->student_model->update_c('score',$arr1,$arr2);
        echo $res;
    }
    public function score_add()
    {
        $user = $_SESSION['s_user'];
        $s_id=$user['s_id'];
        $c_id=$_POST['c_id'];
        $arr=array(
            's_id'=>$s_id,
            'c_id'=>$c_id
        );
        $res=$this->student_model->insert_s('score',$arr);
        if ($res==1){
            $this->session->set_userdata('c_id',$c_id);
        }
        echo $res;
    }

    public function grades()
    {
        if($this->session->userdata('s_user')){
            $this->load->view('student/grades');
        }else{
            redirect('welcome/index');
        }

    }
    public function grades_list()
    {
        $callback=$_GET['callback'];
        $user = $_SESSION['s_user'];
        $s_id=$user['s_id'];
        $sql="SELECT *FROM class,score WHERE class.c_id=score.c_id AND s_id=$s_id";
        $res=$this->student_model->querylist($sql);
        echo $callback."(".json_encode($res).")";
    }
    public function password()
    {
        if($this->session->userdata('s_user')){
            $this->load->view('student/password');
        }else{
            redirect('welcome/index');
        }

    }
    public function check_pwd()
    {
        $callback=$_GET['callback'];
        $data=$_GET['data'];
        $user = $_SESSION['s_user'];
        $s_id=$user['s_id'];
        $pwd=$data['pwd'];
        $arr=array(
            's_id'=>$s_id,
            's_pwd'=>$pwd
        );
        $res=$this->student_model->get_by_num('student',$arr);
        echo $callback."(".json_encode($res).")";
    }
    public function change_pwd(){
        $user = $_SESSION['s_user'];
        $s_id=$user['s_id'];
        $pwd=$_POST['pwd'];
        $arr=array(
            's_id'=>$s_id,
            's_pwd'=>$pwd
        );
        $res=$this->student_model->update_s('student',$arr);
        echo json_encode($res);
    }
}
