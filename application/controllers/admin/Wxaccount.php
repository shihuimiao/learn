<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wxaccount extends AdminBase
{
    protected $module_id = 8;
    public function __construct()
    {
        parent::__construct();
    }

    public function Index(){
        $this->load->view('admin/wxaccount_list');
    }

    public function Info(){
        if(!isset($_GET['id'])){
            $this->load->view('errors/html/error_404',['heading'=>'网络出错','message'=>'刷新网页']);
            exit;
        }

        //微信基本内容
        $this->load->model('wxaccount_model');
        $account_info = $this->wxaccount_model->findOneBy(['id'=>$_GET['id']]);

        $data = [
            'account_info'=>$account_info,
        ];

        $this->load->view('admin/wxaccount_info',$data);
    }

    public function wxMenuAdd(){

        $this->load->model('admin/wxmenu_model');
        $level0_arr = $this->wxmenu_model->findListBy(['level'=>0,'is_del'=>0],'id,name');

        $this->load->view('admin/wxmenu_add',['level_arr'=>$level0_arr]);
    }

}