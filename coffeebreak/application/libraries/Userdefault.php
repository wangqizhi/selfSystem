<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/*
2015-04-13
modify by wqz
*/


class Userdefault {

    public function __construct()
    {
        log_message('debug', "My Userdefault Class Initialized");
        $this->CI =& get_instance();

    }

// 检查登陆状态
    public function checkLogin()
    {
        // 匹配密钥，及IP、用户名
        $rmIP = $_SERVER["REMOTE_ADDR"];
        if (!isset($this->CI->session->sess_read()['cb_id'])) {
            return false;
        }
        $usrID=$this->CI->session->sess_read()['cb_id'];
        if (isset($this->CI->session->sess_read()['cb_secret']) and md5($this->CI->session->sess_key().$usrID."@".$rmIP) == $this->CI->session->sess_read()['cb_secret']) {
            log_message('debug', "****CB: checkLogin ok");
            return true;
        }else{
            log_message('debug', "****CB: checkLogin failed");
            return false;
        }
        // var_dump($this->session->sess_read()['cb_secret']);
        // $this->session->sess_destroy();
    }

// 检查登陆权限
    public function checkPower($login=true)
    {
        if ($login) {
            $this->CI->load->model('user/userinfo_model');
            $query = $this->CI->userinfo_model->get_user_loginpower($this->CI->session->sess_read()['cb_id']);
            if($query)
            {
                log_message('debug', "****CB: checkPower-login ok");
                return true;
            }else
            {
                log_message('debug', "****CB: checkPower-login failed");
                return false;

            }
        }
    }

    public function defaultUserinfo($usr){
        $uInfo = (object)"uInfo";
        $uInfo->displayName = "Unknow(Get Userinfo Failed)";
        $uInfo->id = $usr;
        return $uInfo;
    }


}