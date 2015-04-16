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
    public function checkPower($power='login')
    {
        $this->CI->load->model('user/userinfo_model');
        $this->CI->load->model('station/station_model');

        if ($power=='login') {
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

        }else{
            $gid = $this->CI->userinfo_model->get_user_gid($this->CI->session->sess_read()['cb_id']);
            // $gid = $this->CI->userinfo_model->get_user_gid("10000179");
            // var_dump(preg_split('/-/',$power));exit;
            $levelarray = preg_split('/-/',$power);
            if (count($levelarray)==1) {
                $levelone = preg_split('/-/',$power)[0]; 
                $leveltwo = "power_all";
            } else {
                $levelone = preg_split('/-/',$power)[0];
                $leveltwo = preg_split('/-/',$power)[1];
            }
            
            
            if ($gid && $levelone != '' && $leveltwo != '') {
                $verify = $this->CI->station_model->verify_playstation_power($gid[0]->gid,$levelone,$leveltwo);
                if ($verify) {
                    log_message('debug', "****CB: checkPower-".$power." ok");
                    return true;
                } else {
                    log_message('debug', "****CB: checkPower-".$power." failed");

                    return false;
                }
            } else {
                log_message('debug', "****CB: checkPower failed");

                return false;
            }
        }

        // if($login=="station"){
        //     $gid = $this->CI->userinfo_model->get_user_gid($this->CI->session->sess_read()['cb_id']);
        //     // $gid = $this->CI->userinfo_model->get_user_gid("10000179");
        //     $taskid = $this->CI->input->post("taskid");
        //     if ($gid && $levelone != '' && $leveltwo != '') {
        //         $verify = $this->CI->station_model->verify_playstation_power($gid[0]->gid,$levelone,$leveltwo);
        //         if ($verify) {
        //             return true;
        //         } else {
        //             return false;
        //         }
        //     } else {
        //         return false;
        //     }
            
        // }else{
        //     log_message('debug', "****CB: checkPower failed");
        //     return false;
        // }
    }

    // 默认用户信息
    public function defaultUserinfo($usr){
        $uInfo = (object)"uInfo";
        $uInfo->displayName = "Unknow(Get Userinfo Failed)";
        $uInfo->id = $usr;
        return $uInfo;
    }



}