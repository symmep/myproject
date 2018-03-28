<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student_model extends CI_Model{
    public function  get_by_num($tabnmae,$post){
        //查询
        $query = $this -> db -> get_where($tabnmae,$post);
        return $query -> row_array();
    }
    public function  insert_s($tabnmae,$post){
        //新增
        $query = $this -> db -> insert($tabnmae,$post);
        return $query;
    }
    public  function getlist($tabnmae){
        //读取表
        $query = $this->db->get($tabnmae);
        return $query->result_array();
    }
    public  function querylist($tabnmae){
        //读取表
        $query = $this->db->query($tabnmae);
        return $query->result_array();
    }
    public function  update_s($tabnmae,$post){
        //更新
        $this->db->where('s_id', $post['s_id']);
        $query = $this -> db -> update($tabnmae,$post);
        return $query;
    }
    public function  update_c($tabnmae,$post,$arr){
        //更新
        $this->db->where($post);

        $query = $this -> db -> update($tabnmae,$arr);
        return $query;
    }
    public function  delete_c($tabnmae,$post){
        //删除
        $query =$this->db->delete($tabnmae,$post);
        return $query;
    }
    public function get_count_all($tabnmae){

        return $this->db->count_all($tabnmae);
    }
    public function get_count($tabnmae,$post){

        return $this->db->count_all($tabnmae,$post);
    }
    public  function get_list($offset,$page_size,$tabnmae){
        $this->db->select('*');
        $this->db->from($tabnmae);
        $this->db->limit($page_size, $offset);
        $query = $this->db->get();
        return $query->result();
    }
}