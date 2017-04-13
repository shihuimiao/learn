<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 @require_once APPPATH.'/libraries/admin/Wxbase_lib.php';
class Wxaccount_lib extends Wxbase_lib
{
    protected $CI;

    public function __construct()
    {
        parent::__construct();
        $this->CI = & get_instance();
    }

    public function getAccessToken($id){

        //先看有没有文件  如果有的话就直接用
        if(file_exists($this->access_token_file_address)){
            $res = json_decode(file_get_contents($this->access_token_file_address),true);
            if(!empty($res['expires_time'])){
                if((time()-$res['expires_time']) <7200){
                    return ['errno'=>0,'access_token'=>$res['access_token']];
                }
            }
        }

        //在root放一个文件专门放token的
        $res = $this->putAccessToken($id);
        if($res['errno'] == 0){
            //正确得到access_token   存入文件好了
            $fp = fopen($this->access_token_file_address, "w");
            $data = ['access_token'=>$res['data']['access_token'],'expires_time'=>time()];
            $result = fwrite($fp, json_encode($data));
            fclose($fp);

            if($result){
                return ['errno'=>0,'access_token'=>$res['data']['access_token']];
            }
            log_message(
                'MYERROR',
                'fwrite fail; result='.json_encode($result),
                __METHOD__
            );
        }
        return ['errno'=>-1];
    }

    public function putAccessToken($id){
        $url = $this->access_token_url;
        $this->CI->load->model('wxaccount_model');
        $account_info = $this->CI->wxaccount_model->findOneBy(['id'=>$id]);
        $url = sprintf($url,$account_info['appid'],$account_info['appsecret']);

        $this->CI->load->library('curl');
        $res = $this->CI->curl->simple_get($url,[],[64=>false]);

        if(!empty($res)){
            $res = json_decode($res,true);
            log_message(
                'MYINFO',
                'post_data:'.json_encode($res),
                __METHOD__
            );
            if(isset($res['access_token'])){
                return ['errno'=>0,'data'=>$res];
            }
            log_message(
                'MYERROR',
                'access_token get fail;post_data:'.json_encode($res),
                __METHOD__
            );
            return ['errno'=>-1];
        }
        log_message(
            'MYERROR',
            'get access_token false',
            __METHOD__
        );
        return ['errno'=>-1];
    }

    public function setMenu($access_token){
        $url = sprintf($this->set_menu_url,$access_token);
        $param = $this->getMenuParam();

        $this->CI->load->library('curl');
        $res = $this->CI->curl->simple_post($url,$param,[64=>false]);
        $res = json_decode($res,true);
        if($res['errcode'] == 0){
            return ['errno'=>0];
        }
        log_message(
            'MYERROR',
            'set menu fail;res='.json_encode($res),
            __METHOD__
        );
        return ['errno'=>-1];
    }

    public function getMenuParam(){
        $ret = [];
        $this->CI->load->model('admin/wxmenu_model');
        $menu_info = $this->CI->wxmenu_model->findListBy(['is_del'=>0]);
        $first = [];
        $sub_menu = [];

        foreach($menu_info as $key=>$val){
            if($val['level'] == 0){
                $first[] = ['id'=>$val['id'],'name'=>$val['name'],'menu_type'=>$val['menu_type'],'content'=>$val['content']];
            }else{
                $sub_menu[] = ['level'=>$val['level'],'content'=>$val['content'],'menu_type'=>$val['menu_type'],'name'=>$val['name']];
            }
        }
        foreach($first as &$f_val){
            switch($f_val['menu_type']){
                case 0 :
                    $param = ['name'=>$f_val['name']];
                    foreach($sub_menu as $s_key=>$s_val){
                        if($s_val['level'] == $f_val['id']){
                            $type = 'view'; // 默认
                            if($s_val['menu_type'] == 1){
                                $param['sub_button'][] = [
                                    'type' => 'view',
                                    'name' => $s_val['name'],
                                    'url' => $s_val['content'],
                                ];
                            }elseif($s_val['menu_type'] == 2){
                                $param['sub_button'][] = [
                                    'type' => 'click',
                                    'name' => $s_val['name'],
                                    'key' => $s_val['content'],
                                ];
                            }
                            //todo   还有别的类型

                            unset($sub_menu[$s_key]);
                        }
                    }
                    break;
                case 1 :
                    $param = ['type'=>'view','name'=>$f_val['name'],'url'=>$f_val['content']];
                    break;
                case 2 :
                    $param = ['type'=>'click','name'=>$f_val['name'],'key'=>$f_val['content']];
                    break;
                //todo   还有别的类型
            }

            $params[] = $param;
        }
        $ret['button'] = $params;

        return json_encode($ret,JSON_UNESCAPED_UNICODE);

    }


}