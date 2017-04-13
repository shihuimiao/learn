<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
}

class AdminBase extends MY_Controller
{
    protected $module_id;
    function __construct()
    {
        parent::__construct();

        //验证有没有登录
        $this->checkLogin();
        //判断用户权限
        $this->checkModules($this->module_id);

    }

    public function checkLogin(){
        $userInfo = get_login_info();
        if(empty($userInfo)) {
            header('Location: /admin/login/showlogin');
        }
    }

    public function checkModules($module_id){
        //index 首页谁都能进去
        if(!empty($module_id)){

        }
    }

}

class AdminAjaxBase extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPostParam($param){
        $ret = [];
        foreach($param as $key=>$val){
            $ret[$key] = $this->input->post($val);
        }

        return $ret;
    }
}




