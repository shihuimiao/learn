<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@ require_once 'BaseModel.php';
class Wxaccount_model extends BaseModel
{
    protected $_database = 'default';
    protected $_table = 'wxaccount';
    public function __construct()
    {
        parent::__construct();
        $this->load->database('default');
    }

    public function getList($params){
        $offset_start = isset($params['iDisplayStart']) ? $params['iDisplayStart'] : 0;
        $offset = isset($params['iDisplayLength']) ? $params['iDisplayLength'] : 10;

        $this->db->select("*");
        if(isset($params['iSortCol_0'])){
            //mDataProp_1
            $sort_name = $params['mDataProp_'.$params['iSortCol_0']];
            $sort = isset($params['sSortDir_0']) ? $params['sSortDir_0'] : 'desc';
            $this->db->order_by($sort_name,$sort);
        }
        $this->db->limit($offset,$offset_start);
        $data = $this->db->get('wxaccount')->result_array();

        $this->db->select("count(*) as count");
        $count = $this->db->get('wxaccount')->row_array();

        return ['data'=>$data,'count'=>$count['count']];

    }



}