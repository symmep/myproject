<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('teacher_model');
	}

	public function index()
	{
		if($this->session->userdata('t_user')){
			$this->load->view('teacher/index');
		}else{
			redirect('welcome/index');
		}
	}
	public function regist_teacher()
	{
		$teacher_num = $_POST['teacher_num'];
		$uname = $_POST['uname'];
		$password = $_POST['password'];
		$query_num = $this->teacher_model->get_t_num($teacher_num);
		$query_check =  $this->teacher_model->get_teacher_num($teacher_num);
		$query_name =  $this->teacher_model->get_t_name($uname);
		if(count($query_num)>0 && count($query_check)==0 && count($query_name)==0){
			$query_save = $this->teacher_model->sava_teacher($uname,$password,$teacher_num);
			if($query_save){
				$t_user = $this->teacher_model->get_teacher_num($teacher_num);
				$this->session->set_userdata(array('t_user'=>$t_user));
				echo "yes";
			}
		}else{
			echo "no";
		};
	}

	public function login_teacher()
	{
		$uname = $_POST['uname'];
		$password = $_POST['password'];
		$this->load->model('teacher_model');
		$query = $this->teacher_model->check_teacher($uname,$password);
		if($query){
			$this->session->set_userdata(array('t_user'=>$query));
			echo "yes";
		}else{
			echo "no";
		}
	}
    public function unlogin(){
        $this->session->unset_userdata('t_user');
        $res=$this->session->userdata('t_user');
        if($res==null){
            echo 'yes';
        }else{
            echo 'no';
        }
    }
    public function changepwd()
    {

        if($this->session->userdata('t_user')){
            $this->load->view('teacher/changepwd');
        }else{
            redirect('welcome/index');
        }

    }
    public function check_pwd()
    {
        $callback=$_GET['callback'];
        $data=$_GET['data'];
        $user = $_SESSION['t_user'];
        $t_id=$user['t_id'];
        $pwd=$data['pwd'];
        $arr=array(
            't_id'=>$t_id,
            't_pwd'=>$pwd
        );
        $res=$this->teacher_model->get_by_num('teacher',$arr);
        echo $callback."(".json_encode($res).")";
    }
    public function change_pwd(){
        $user = $_SESSION['t_user'];
        $t_id=$user['t_id'];
        $pwd=$_POST['pwd'];
        $arr=array(
            't_id'=>$t_id,
            't_pwd'=>$pwd
        );
        $res=$this->teacher_model->update_s('teacher',$arr);
        echo json_encode($res);
    }

	//-----------------科目类--------------------
	//首页面
	public function course()
	{
		if($this->session->userdata('t_user')){
			$this->load->view('teacher/course');
		}else{
			redirect('welcome/index');
		}
	}
	//获取所有科目类别
	public function get_course()
	{
		$query = $this->teacher_model->get_all_course();
		echo json_encode($query);
		// print_r($query);
	}
	//添加科目
	public function add_course()
	{	
		if(isset($_POST['courseName'])){
			$course_name = $_POST['courseName'];
			$query = $this->teacher_model->add_one_course($course_name);
			if($query){
				echo "yes";
			}else{
				echo "添加课程失败";
			}
		}
	}
	//删除科目
	public function delete_course()
	{
		if(isset($_POST['c_id']) && isset($_POST['c_name'])){
			$c_id = $_POST['c_id'];
			$c_name = $_POST['c_name'];
			$query = $this->teacher_model->delete_one_course($c_id,$c_name);
			if($query){
				echo "yes";
			}else{
				echo "no";
			}
		}
	}







	//-----------------分数类--------------------
	public function score()
	{
		if($this->session->userdata('t_user')){
			$this->load->view('teacher/score');
		}else{
			redirect('welcome/index');
		}
	}
	//获取分数
	public function get_score()
	{
		$stu['s_name'] = $this->input->get('s_name');
		$stu['s_num'] = $this->input->get('s_num');
		$stu['grade'] = $this->input->get('grade');
		$stu['major'] = $this->input->get('major');
		$course_name = $this->input->get('course');
		if(!$stu['s_name']){
            unset($stu['s_name']);
        }
        if(!$stu['s_num']){
            unset($stu['s_num']);
        }
        if(!$stu['grade']){
            unset($stu['grade']);
        }
        if(!$stu['major']){
            unset($stu['major']);
        }
		$student = $this->teacher_model->get_student($stu);//查询所有符合条件的学生，结果为二维数组
		if($course_name){
			$course = $this->teacher_model->check_course($course_name);
			if($course){
				if($student){
					foreach ($student as $item) {
						$query = $this->teacher_model->get_score_by_sid_cid($item['s_id'],$course['c_id']);
						if($query){
							$query['score']=array($query['c_name']=>$query['score']);
							$result[] = $query;
						}
					}
				}else{
					$result = array();
				}
			}else{
				$result = array();
			}	
		}else{
			if($student){
				foreach ($student as $item) {
					$s_id = $item['s_id'];
					$query = $this->teacher_model->get_scores_by_sid($s_id);
					if($query){
						$new_query = array();
						foreach ($query as $score){
							$new_query['s_id'] = $score['s_id'];
							$new_query['s_name'] = $score['s_name'];
							$new_query['s_num'] = $score['s_num'];
							$new_query['grade'] = $score['grade'];
							$new_query['major'] = $score['major'];
							$new_query['score'][$score['c_name']] = $score['score'];
						}
						$result[] = $new_query;
					}
				}
			}else{
				$result = array();
			}
		}
		echo json_encode($result);
	}

	//-----------------考生管理类--------------------
	public function examinee()
	{
		if($this->session->userdata('t_user')){
			$this->load->view('teacher/examinee');
		}else{
			redirect('welcome/index');
		}
	}
	public function get_student_by_course()
	{
		if(isset($_GET['courseName'])){
			$course_name = $_GET['courseName'];
			$this->load->model('teacher_model');
			$query = $this->teacher_model->get_student_by_coursename($course_name);
			echo json_encode($query);
			// print_r($query);
		}
	}
	public function change_compe()
	{
		$c_id = $this->input->post('cId');
		$compes = $this->input->post('compe');
		$arr_no = array();
		$arr_yes =array();
		foreach ($compes as $index=>$id) {
			$query = $this->teacher_model->get_compe($c_id,$id);
			if(count($query) == 0){
				$arr_no[]=array('s_id'=>$id,'c_id'=>$c_id);
			}else{
				$arr_yes[]=$query['id'];
			}
		}
		$result_rows=0;
		if(count($arr_yes)>0){
			$delete_rows = $this->teacher_model->delete_compe($arr_yes);
			$result_rows+=$delete_rows;
		}
		if(count($arr_no)>0){
			$add_rows = $this->teacher_model->add_compe($arr_no,$c_id);
			$result_rows+=$add_rows;
		}
		// echo count($compes).'||'.count($delete_rows)+count($add_rows); 	
		// print_r($arr_no);
		if(count($arr_no)+count($arr_yes) == $result_rows){
			echo "success";
		}else{
			echo "fail";
		}
	}
	//题库维护
	public function gettestpaper()
	{
		if($this->session->userdata('t_user')){
			$this->load->view('teacher/gettestpaper');
		}else{
			redirect('welcome/index');
		}
	}
	public function get_paper()
	{
		$c_id = $this->input->get('courseId');
		$select_num = $this->input->get('selectNum');
		$option_num = $this->input->get('optionNum');
		$check_num = $this->input->get('checkNum');
		$select_paper = $this->teacher_model->get_select_paper($c_id,$select_num);
		$option_paper = $this->teacher_model->get_option_paper($c_id,$option_num);
		$check_paper = $this->teacher_model->get_check_paper($c_id,$check_num);
		echo json_encode(array(
				'select_paper'=>$select_paper,
				'option_paper'=>$option_paper,
				'check_paper'=>$check_paper
			));
		// var_dump($c_id);


		// echo $c_id.'||'.$select_num.'||'.$option_num.'||'.$check_num;
	}


}
