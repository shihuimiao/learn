<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_lib
{
    protected $CI;
    public function __construct()
    {
        $this->CI = & get_instance();
    }

    public function checkLogin(){
        $ret = [
            ['errno'=>0,'data'=>'成功'],
            ['errno'=>-1001,'data'=>'参数不完整'],
            ['errno'=>-1002,'data'=>'无此用户'],
            ['errno'=>-1003,'data'=>'输入密码有误'],

        ];
        $data['username'] = $this->CI->input->post('username');
        $data['password'] = $this->CI->input->post('password');

        if(empty($data['username']) || empty($data['password'])){
            log_message(
                'MYERROR',
                'empty data:'.json_encode($data),
                __METHOD__
            );
            return $ret[1];
        }

        $this->CI->load->model('admin/admin_user');

        $admin_user_res = $this->CI->admin_user->findOneByUserName($data['username']);

        if(empty($admin_user_res)){
            return $ret[2];
        }

        if(md5($data['password'].$admin_user_res['rand_code']) != $admin_user_res['password']){
            return $ret[3];
        }

        $user_data = [
            'username'=>$admin_user_res['username'],
            'nickname'=>$admin_user_res['nickname'],
            'group_id'=>$admin_user_res['group_id'],
        ];

        $user_cookie_key = $this->CI->config->item('admin_user_info_key');
        $this->CI->load->helper('cookie');
        set_cookie($user_cookie_key,pwdEncrypt(arr2str($user_data)),3600*3);

        return $ret[0];
    }

    public function getUserModules(){
        $user_info = get_login_info();
        $this->CI->load->model('admin/admin_module');
        $modules = [];
        if($user_info['group_id'] == 1){  //拥有所有权限
            //取出所有的栏目
            $modules = $this->CI->admin_module->getAllModules();
        }else{

        }

        //用二叉树封一下
        $modules = twotree($modules);
        return $modules;
    }

}