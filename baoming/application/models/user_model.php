<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model{
    public function check($tabnmae,$post)
    {
        //数据库查询 $tabnmae为表名，$post为查询条件
        $query = $this -> db -> get_where($tabnmae,$post);
        return $query -> row();
    }
    public function add($tabname,$post)
    {
        //数据库新增 $tabnmae为表名，$post为新增数据
        $query = $this -> db -> insert($tabname,$post);
        return $query;
    }
    public function get_user_by_id($post)
    {
        //数据库查询
        $query = $this->db->get_where('t_user', array('id_num' => $post));
        return $query->result();
    }
    public function  get_by_num($tabnmae,$post){
        //数据库查询 $tabnmae为表名，$post为查询条件
        $query = $this -> db -> get_where($tabnmae,$post);
        return $query -> result();
    }
    public function update($tabnmae,$id,$post)
    {
        //数据库更新 $tabnmae为表名，$post为查询条件
        $this->db->where($id);
        $query=$this->db->update($tabnmae, $post);
        return $query;
    }
    public function get_all($tabname)
    {
        //数据库查询 $tabnmae为表名
        $query = $this->db->get($tabname);
        return $query->result_array();
    }
    public function get_ten($tabnmae)
    {
        //查询10条数据 $tabnmae为表名
        $this->db->select('*');
        $this->db->from($tabnmae);
        $this->db->order_by('date','desc');
        $this->db->limit('10');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_w($tabnmae,$post)
    {
        //查询5条数据 $tabnmae为表名
        $this->db->select('*');
        $this->db->from($tabnmae);
        $this->db->where($post);
        $this->db->order_by('date','desc');
        $this->db->limit('5');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_a($tabnmae,$post)
    {
        //数据库查询 $tabnmae为表名，$post为查询条件
        $query = $this->db->get_where($tabnmae,$post);
        return $query->result_array();
    }
    public function del($tabnmae,$post)
    {
        //数据库删除 $tabnmae为表名，$post为查询条件
        $this->db->where($post);
        $query = $this->db->delete($tabnmae);
        return $query;
    }
    public function get_count($tabnmae,$post)
    {
        //数据库查询 $tabnmae为表名，$post为查询条件
        $this->db->select('*');
        $this->db->from($tabnmae);
        $this->db->where($post);
        $this->db->order_by('date','desc');
        $query = $this->db->get();
        return count($query->result());
    }
    public function get_art($tabnmae,$arr,$offset,$page_size)
    {
        //数据库查询 $tabnmae为表名，$post为查询条件
        $this->db->select('*');
        $this->db->from($tabnmae);
        $this->db->where($arr);
        $this->db->limit($page_size, $offset);
        $this->db->order_by('date','desc');
        $query = $this->db->get();
        return $query->result();
    }
}