<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model{
    public function  get_by_num($tabnmae,$post){
        //数据库查询 $tabnmae为表名，$post为查询条件
        $query = $this -> db -> get_where($tabnmae,$post);
        return $query -> result();
    }
    public function update($tabnmae,$id,$post)
    {
        //数据库更新 $tabnmae为表名，$post为查询条件
        $this->db->where( $id);
        $query=$this->db->update($tabnmae, $post);
        return $query;
    }
    public function get_all($tabname)
    {
        //数据库查询 $tabnmae为表名
        $query = $this->db->get($tabname);
        return $query->result_array();
    }
    public  function querylist($tabnmae){
        //数据库查询 $tabnmae为表名
        $query = $this->db->query($tabnmae);
        return $query->result_array();
    }
}