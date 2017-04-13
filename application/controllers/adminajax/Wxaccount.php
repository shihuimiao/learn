<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wxaccount extends AdminAjaxBase
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('wxaccount_model');
    }

    public function wxAccountList(){

        //data
        $list_data = $this->wxaccount_model->getList($_POST);

        foreach($list_data['data'] as &$v){
            $v['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
        }

        $ret = ['aaData'=>$list_data['data'],'iTotalRecords'=>$list_data['count'],'iTotalDisplayRecords'=>$list_data['count']];
        echo json_encode($ret,JSON_UNESCAPED_UNICODE);exit;
    }

    public function accountSubmit(){
        $ret = [
            ['errno'=>0,'data'=>'更新成功'],
            ['errno'=>-1001,'data'=>'更新失败'],
        ];

        //更换数据
        $params = [
            'wx_name'=>'website_title',
            'token'=>'wx_token',
            'wx_account'=>'wx_accountnum',
            'appid'=>'wx_appid',
            'appsecret'=>'wx_appsecret',
            'descript'=>'website_description',
        ];

        $data = $this->getPostParam($params);

        $res = $this->wxaccount_model->updateOneBy(['id'=>$_POST['id']],$data);

        if($res){
            echo json_encode($ret[0],JSON_UNESCAPED_UNICODE);
            exit;
        }else{
            echo json_encode($ret[1],JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    public function wxmenuAdd(){
        $ret = [
            ['errno'=>0,'data'=>'添加成功'],
            ['errno'=>-1001,'data'=>'添加失败'],
        ];

        $params = [
            'level'=>'menu_level',
            'name'=>'menu_name',
            'menu_type'=>'menu_type',
            'sort'=>'menu_sort',
            'is_show'=>'menu_isshow',
            'content' => 'content',
        ];

        $data = $this->getPostParam($params);
        $this->load->model('admin/wxmenu_model');

        $res = $this->wxmenu_model->updateOneBy(0,$data);

        if($res){
            echo json_encode($ret[0],JSON_UNESCAPED_UNICODE);
            exit;
        }else{
            echo json_encode($ret[1],JSON_UNESCAPED_UNICODE);
            exit;
        }

    }

    public function wxMenuList(){
        $this->load->model('admin/wxmenu_model');

        $list_data = $this->wxmenu_model->findList($_POST);

        //因为是这样取菜单的   所以删除一级菜单的同时要把二级菜单删了
        $level_name = [];
        foreach($list_data['data'] as &$v){
            if($v['level'] == 0){
                $v['level'] = '一级菜单';
                $level_name[$v['id']] = $v['name'];
            }else{
                $my_levelname = isset($level_name[$v['level']]) ? '【'.$level_name[$v['level']].'】 二级菜单' : '';
                $v['level'] = $my_levelname;
            }

            if($v['menu_type'] == 0){
                $v['menu_type'] = '展开二级菜单';
            }elseif($v['menu_type'] == 1){
                $v['menu_type'] = '跳转url';
            }

            if($v['is_show'] ==0){
                $v['is_show'] = '显示';
            }else{
                $v['is_show'] = '不显示';
            }

            $v['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
        }

        $ret = ['aaData'=>$list_data['data'],'iTotalRecords'=>$list_data['count'],'iTotalDisplayRecords'=>$list_data['count']];
        echo json_encode($ret,JSON_UNESCAPED_UNICODE);exit;
    }

    public function wxMenuDel(){
        $ret = [
            ['errno'=>0,'data'=>'删除成功'],
            ['errno'=>-1001,'data'=>'删除失败'],
        ];

        $this->load->model('admin/wxmenu_model');

        $res = $this->wxmenu_model->menu_del($_POST);

        if($res){
            echo json_encode($ret[0],JSON_UNESCAPED_UNICODE);
            exit;
        }else{
            echo json_encode($ret[1],JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    public function wxMenuLoad(){
        $ret = [
            ['errno'=>0,'data'=>'成功'],
            ['errno'=>-1001,'data'=>'token读取失败'],
            ['errno'=>-1002,'data'=>'不成功'],
        ];

        //load
        $this->load->library('admin/Wxaccount_lib');

        $res = $this->wxaccount_lib->getAccessToken($_POST['id']);

        if($res['errno'] != 0){
            log_message(
                'MYERROR',
                'access_token get fail; result='.json_encode($res),
                __METHOD__
            );
            echo json_encode($ret[1],JSON_UNESCAPED_UNICODE);
            exit;
        }

        //生成菜单
        $menu_res = $this->wxaccount_lib->setMenu($res['access_token']);
        if($menu_res['errno'] == 0){
            echo json_encode($ret[0],JSON_UNESCAPED_UNICODE);
            exit;
        }

        echo json_encode($ret[2],JSON_UNESCAPED_UNICODE);
        exit;
    }



}