<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Teacher_model extends CI_Model{
    public function  get_by_num($tabnmae,$post){
        //查询
        $query = $this -> db -> get_where($tabnmae,$post);
        return $query -> row_array();
    }
	// 查询教师号在表t_num中是否存在
    public function get_t_num($teacher_num)
    {
        return $this-> db -> get_where('t_num',array(
                't_num' => $teacher_num
            ))->row_array();
    }
    //查询教师号在表teacher是否存在，来验证是否已被注册过
    public function get_teacher_num($teacher_num)
    {
    	 return $this-> db -> get_where('teacher',array(
                't_num' => $teacher_num
            ))->row_array();
    }
    //查询用户名是否存在，来验证是否重复
    public function get_t_name($t_name)
    {
    	return $this-> db -> get_where('teacher',array(
                't_name' => $t_name
            ))->row_array();
    }
    //添加注册信息
    public function sava_teacher($uname,$password,$teacher_num)
    {
    	$this-> db -> insert('teacher',array(
    			't_name' => $uname,
    			't_pwd' => $password,
    			't_num' => $teacher_num
    		));
    	return $this-> db ->affected_rows();
    }
    //验证登录信息是否正确
    public function check_teacher($uname,$password)
    {
    	$query = $this-> db -> get_where('teacher',array(
    			't_name' => $uname,
    			't_pwd' => $password
    		));
    	return $query->row_array();
    }
    //修改密码
    public function chang_t_pwd($t_name,$t_new_pwd){
        $this->db->where('t_name', $t_name);
        $this->db->update('teacher', array(
                't_pwd'=> $t_new_pwd
            )); 
        return $this-> db ->affected_rows();

    }
    public function  update_s($tabnmae,$post){
        //更新
        $this->db->where('t_id', $post['t_id']);
        $query = $this -> db -> update($tabnmae,$post);
        return $query;
    }

    //获取所有科目类别
    public function get_all_course()
    {
        return $this-> db -> get('class')->result_array();
    }
    //验证科目是否存在
    public function check_course($course)
    {
        return $this-> db ->get_where('class',array(
                'c_name'=>$course
            ))->row_array();
    }
    //添加一门科目
    public function add_one_course($course_name)
    {
        $this-> db ->insert('class',array(
                'c_name' => $course_name
            )); 
        return $this -> db -> affected_rows();
    }
    //删除一门课程
    public function delete_one_course($c_id,$c_name)
    {
        $this->db->delete('class',array(
                'c_id' => $c_id,
                'c_name'=> $c_name
            ));
        return $this-> db -> affected_rows();
    }
    //查询分数
    //查询学生
    public function get_student($student)
    {
        return $this->db->get_where('student',$student)->result_array();
    }
    //查询分数，通过学生id和课程id,查询一条
    public function get_score_by_sid_cid($s_id,$c_id)
    {
        $sql = "SELECT * 
                from class c,student s,score o
                where c.c_id=o.c_id and o.s_id=s.s_id and o.c_id=$c_id and o.s_id=$s_id";
        return $this->db->query($sql)->row_array();
    }
    public function get_score_by_sid($s_id)
    {
        return $this->db->get_where('score',array('s_id'=>$s_id))->result_array();
    }
    public function get_scores_by_sid($s_id)
    {
        $sql ="SELECT * 
            from class c,student s,score o
            where c.c_id=o.c_id and o.s_id=s.s_id and s.s_id=$s_id";
        return $this->db->query($sql)->result_array();
    }
    // public function get_score($arr)
    // {
    //     if(!$arr['s_name']){
    //         unset($arr['s_name']);
    //     }
    //     if(!$arr['s_num']){
    //         unset($arr['s_num']);
    //     }
    //     if(!$arr['grade']){
    //         unset($arr['grade']);
    //     }
    //     if(!$arr['major']){
    //         unset($arr['major']);
    //     }
    //     $course = $arr['course'];
    //     unset($arr['course']);

    //     if(isset($course)){

    //     }else{

    //     }
    //     $result_arr = $this->db->get_where('student',$arr)->result_array();
    //     $result_array = array();
    //     $result_array1 = array();
    //     foreach ($result_arr as $item) {
    //         $arr_course = $this-> db ->get_where('score',array(
    //                 's_id'=>$item['s_id'] 
    //         )) -> result_array();
    //         $item['score'] = array();
    //         foreach ($arr_course as $key => $value) {
    //             $result_course = $this->db->get_where('class',array(
    //                     'c_id'=>$value['c_id']
    //                 ))->row_array();
    //             $item['score'][$result_course['c_name']]=$value['score'];
    //         }
    //         array_push($result_array, $item);
    //     }
    //     if($course){
    //         foreach ($result_array as $item){
    //             if(isset($item['score'][$course])){
    //                 $item['mark'][$course] = $item['score'][$course];
    //                 array_push($result_array1, $item);
    //             }else{
    //                 array_push($result_array1, $item);
    //             }
    //         }        
    //         return $result_array1;
    //     }else{
    //         return $result_array;
    //     }
        
    // }
    //根据科目查询学生
    public function get_student_by_coursename($course_name)
    {
        $result_course = $this-> db ->get_where('class',array(
                'c_name' => $course_name
            ))->row_array();
        if($result_course){
            $result = array();
            $class_student =  $this-> db ->get_where('class_student',array(
                'c_id' => $result_course['c_id']
            ))->result_array();
            foreach ($class_student as $item) {
                $student_one =  $this-> db ->get_where('student',array(
                        's_id' => $item['s_id']
                    ))->row_array();
                $student_competence = $this->db->get_where('student_competence',array(
                        'c_id'=>$result_course['c_id'],
                        's_id'=>$student_one['s_id']
                    ))->row_array();
                if($student_competence){
                    $student_one['competence'] = 'yes';
                }else{
                    $student_one['competence'] = 'no';
                }
                unset($student_one['s_pwd']);
                $student_one['course'] = $course_name;
                $student_one['c_id'] = $result_course['c_id'];
                $result[] = $student_one;
            }
            return $result;
        }else{
            return $result_course;
        }
    }
    public function get_compe($c_id,$s_id)
    {
       return $this->db->get_where('student_competence',array(
            's_id'=>$s_id,
            'c_id'=>$c_id
            ))->row_array();
    }
    public function delete_compe($arr_yes)
    {
        $this->db->where_in('id', $arr_yes);
        $this->db->delete('student_competence');
        return $this->db->affected_rows();
    }
    public function add_compe($arr_no,$c_id)
    {
        $this->db->insert_batch('student_competence', $arr_no);
        return $this->db->affected_rows();
    }
    public function get_select_paper($c_id,$select_num)
    {
        $sql = "SELECT * 
                from t_select
                where class_id=$c_id
                ORDER BY RAND() LIMIT 0,$select_num";
        return $this->db->query($sql)->result_array();

    }
    public function get_option_paper($c_id,$option_num)
    {
        $sql = "SELECT * 
                from opinion
                where class_id=$c_id
                ORDER BY RAND() LIMIT 0,$option_num";
        return $this->db->query($sql)->result_array();
        
    }
    public function get_check_paper($c_id,$check_num)
    {
        $sql = "SELECT * 
                from checkbox
                where class_id=$c_id
                ORDER BY RAND() LIMIT 0,$check_num";
        return $this->db->query($sql)->result_array();
        
    }
}