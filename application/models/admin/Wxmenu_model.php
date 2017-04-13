<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@ require_once APPPATH.'/models/BaseModel.php';

class Wxmenu_model extends BaseModel
{
    protected $_database = 'default';
    protected $_table = 'wxmenu';
    public function __construct()
    {
        parent::__construct();
    }

    public function findList($params){
        $offset_start = isset($params['iDisplayStart']) ? $params['iDisplayStart'] : 0;
        $offset = isset($params['iDisplayLength']) ? $params['iDisplayLength'] : 10;

        $this->db->select("*");

        $this->db->where(['is_del'=>0]);

        if(isset($params['iSortCol_0'])){
            //mDataProp_1
            $sort_name = $params['mDataProp_'.$params['iSortCol_0']];
            $sort = isset($params['sSortDir_0']) ? $params['sSortDir_0'] : 'desc';
            $this->db->order_by($sort_name,$sort);
        }
        $this->db->limit($offset,$offset_start);
        $data = $this->db->get($this->_table)->result_array();

        $this->db->select("count(*) as count");
        $count = $this->db->get($this->_table)->row_array();

        return ['data'=>$data,'count'=>$count['count']];

    }

    public function menu_del($params){

        $this->db->where('id', $params['id']);
        $res = $this->db->update($this->_table, ['is_del'=>1]);

        return $res;
    }

}