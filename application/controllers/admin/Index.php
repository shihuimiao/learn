<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends AdminBase
{
    function __construct()
    {
        parent::__construct();
    }

    public function index(){

        //得到用户模块
        $this->load->library('admin/user_lib');
        $modules = $this->user_lib->getUserModules();

        $this->load->view('admin/index',['modules'=>$modules]);
    }

    public function welcome(){
        echo 'welcome';
    }


}