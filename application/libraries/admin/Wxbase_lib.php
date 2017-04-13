<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wxbase_lib
{
    protected $access_token_file_address ;
    protected $access_token_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';
    protected $set_menu_url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s';

    public function __construct()
    {
        $this->access_token_file_address = FCPATH.'/api_ticket.json';
    }

}