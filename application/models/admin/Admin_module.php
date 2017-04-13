<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_module extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database('default');
    }

    /**
     * 根据groupid 渠道module
     */
    public function getAllModulesByGroup(){

    }

    /**
     * 得到所有的modules
     */
    public function getAllModules(){
        $this->db->select("*");
        return $this->db->get('admin_module')->result_array();
    }



}