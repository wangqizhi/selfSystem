<?php 
class Userinfo_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->db_passport = $this->load->database("ad_passport",TRUE);
        $this->db_cb = $this->load->database("default",TRUE);
    }

    // 获取用户登陆权限
    function get_user_loginpower($usr)
    {
        $query = $this->db_cb->select('loginPower')->where('uid',$usr)->where('loginPower','1')->get('cb_users');
        if ($query and count($query->result())==1 ) {
            return true;
        }else{
            return false;
        }
    }

    // 更新登陆时间
    function update_user_lastLoginTime($usr)
    {
        $data = array('lastLoginTime'=>time());
        $this->db_cb->where('uid',$usr)->update('cb_users',$data);
    }
    
    // 获取用户信息
    function get_user_name($usr)
    {
        $query = $this->db_passport->where('id',$usr)->get('users');
        // var_dump($query);
        if ($query) {
            return $query->result();
        }else{
            return false;
        }
        
    }

    // 获取用户gid
    function get_user_gid($usr)
    {
        $query = $this->db_cb->where('uid',$usr)->get('cb_users');
        // var_dump($query);
        if ($query) {
            return $query->result();
        }else{
            return false;
        }
        
    }



}