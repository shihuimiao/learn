<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database('default');
    }

    public function findOneByUserName($username){
        $this->db->select(['*']);

        $this->db->where('username',$username);

        return $this->db->get('admin_user')->row_array();
    }



}