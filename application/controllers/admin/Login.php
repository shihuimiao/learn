<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

    }

    function index(){

        $user_cookie_key = $this->config->item('admin_user_info_key');
        $this->load->helper('cookie');
        $aa = get_cookie($user_cookie_key);

        $aa = pwdEncrypt($aa,0);
        $aa = arr2str($aa,0);
        var_dump($aa);

    }

    public function showLogin(){
        $this->load->view('admin/login');
    }

    /**
     * 登录接口
     */
    public function doLogin(){

        log_message(
            'MYINFO',
            'post_data:'.json_encode($_POST),
            __METHOD__
        );

        $this->load->library('admin/User_lib');
        $res = $this->user_lib->checkLogin();

        echo json_encode($res);
        exit;

    }



}