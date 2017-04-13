<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseModel extends CI_Model
{
    protected $_database;
    protected $_table;
    public function __construct()
    {
        parent::__construct();
        $this->load->database($this->_database);
    }

    public function findOneBy($where,$flied='*'){
        $this->db->select($flied);
        $this->db->where($where);
        return $this->db->get($this->_table)->row_array();
    }

    public function findListBy($where,$flied='*',$extension=''){
        $this->db->select($flied);
        $this->db->where($where);

        if(isset($extension['group_by'])){
            $this->db->group_by($extension['group_by']);
        }
        if(isset($extension['order_by'])){
            $this->db->order_by($extension['order_by']);
        }
        if(isset($extension['limit'])){
            if(is_array($extension['limit'])){
                $this->db->limit($extension['limit'][0],$extension['limit'][1]);
            }else{
                $this->db->limit($extension['limit']);
            }
        }
        return $this->db->get($this->_table)->result_array();

    }

    public function updateOneBy($where='',$param){
        $ret = '';
        if(!empty($where)){
            //update
            $param['update_time'] = time();
            $this->db->where($where);
            $ret = $this->db->update($this->_table, $param);
        }else{
            //insert
            $param['create_time'] = time();
            $ret = $this->db->insert($this->_table, $param);
        }
        return $ret;
    }




}