<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_group extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database('default');
    }

    public function getUserModules($groupId){
        $this->db->select(['*']);

        $this->db->where('id',$groupId);

        return $this->db->get('admin_group')->row_array();
    }

}