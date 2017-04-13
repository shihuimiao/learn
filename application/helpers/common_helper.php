<?php


if(!function_exists('myIsset')){
    /**
     * @param string $param
     * @param array $data
     */
   function myIsset($param,$data,$default = ''){

       $ret = isset($data[$param]) ? $data[$param] : $default;

       return $ret;
   }
}

if(!function_exists('pwdEncrypt')){
    /**
     * @param string $str  要加密的内容
     * @param bool $is_encode
     */
    function pwdEncrypt($str,$is_encode=true){
        $ci = &get_instance();
        $ci->load->library('encrypt');
        if($is_encode){
            $res = $ci->encrypt->encode($str);
        }else{
            $res = $ci->encrypt->decode($str);
        }
        return $res;
    }
}

if(!function_exists('arr2str')){
    /**
     * @param $data
     * @param bool $toStr
     * @return array|string
     */
    function arr2str($data,$toStr=true){
        $params = '|#|';
        $stamp = '|@|';

        if($toStr){
            $ret = [];
            foreach($data as $k=>$v){
                $ret[] = $k.$params.$v;
            }
            $ret = implode($stamp,$ret);
        }else{
            if(empty($data)){
                return '';
            }
            $exp_data = explode($stamp,$data);
            $ret = [];
            foreach($exp_data as $v){
                $exp_v = explode($params,$v);
                $ret[$exp_v[0]] = $exp_v[1];
            }
        }
        return $ret;
    }
}

if(!function_exists('get_login_info')){
    /**
     * 得到用户信息
     */
    function get_login_info(){
        $ci = &get_instance();
        $user_cookie_key = $ci->config->item('admin_user_info_key');
        $ci->load->helper('cookie');
        $user_info = get_cookie($user_cookie_key);

        $user_info = pwdEncrypt($user_info,0);
        $user_info = arr2str($user_info,0);

        return $user_info;
    }
}

if(!function_exists('twotree')){

    function twotree($data,$params = ['sort_filed'=>'sort_num']){
        if(is_array($data)){
            $ret = [];
            $ret_less = [];
            $sort = [];
            $sort_less = [];
            foreach($data as $key=>$v){
                if($v['parent_id'] == 0){
                    $ret[] = $v;
                    $sort[$key] = $v[$params['sort_filed']];
                }else{
                    $ret_less[$v['parent_id']][] = $v;
                }
            }
            //排序
            array_multisort($sort,SORT_DESC,$ret);

            foreach($ret_less as $less_k=>$less_v){
                //排序
                foreach($less_v as $less_sort_key=>$less_sort_val){
                    $sort_less[$less_sort_key] = $less_sort_val[$params['sort_filed']];
                }
                if(count($less_v)>1){
                    array_multisort($sort_less,SORT_DESC,$less_v);
                }
                foreach($ret as &$ret_v){
                    if($less_k == $ret_v['id']){
                        $ret_v['child'] = $less_v;
                    }
                }
            }
        }else{
            $ret = $data;
        }
        return $ret;
    }
}


