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


    // 申请可以登录的用户
    function set_user_login($usr)
    {
        $query = $this->db_cb->select('loginPower')->where('uid',$usr)->where('loginPower','1')->get('cb_users');
        if ($query and count($query->result())==1 ) {
            return false;
        }else{
            $data = array('uid'=>$usr,'createTime'=>time(),'lastLoginTime'=>time(),'loginPower'=>0);
            $this->db_cb->insert('cb_users',$data);
            return true;
        }
    }

    // 获取所有用户信息
    function get_user_login()
    {
        // $this->db_cb->join('cb_power','cb_users.gid = cb_power.id');
        $query = $this->db_cb->get('cb_users');
        if ($query) {
            return $query->result();
        }else{
            return false;
        }
    }

    // 获取所有id对应权限
    function get_power_name()
    {
        $query = $this->db_cb->get('cb_power');
        if ($query) {
            return $query->result();
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
    function get_user_info($usr)
    {
        $query = $this->db_passport->where('id',$usr)->get('users');
        // var_dump($query);
        if ($query) {
            return $query->result();
        }else{
            return false;
        }
        
    }


    // 获取一组用户名信息
    function get_users_name($usrs)
    {
        $usrsnamearray = array();
        foreach ($usrs as $key => $value) {
            $query = $this->db_passport->select('displayName')->where('id',$value)->get('users');
            if ($query && count($query->result())==1) {
                // array_push($usrsnamearray,$query->result()[0]->displayName);
                $usrsnamearray[$value] = $query->result()[0]->displayName;
            }else{
                $usrsnamearray[$value] = 0;
            }
        }
        // var_dump($query);
        if (count($usrsnamearray) == 0) {
            return false;
        }else{
            return $usrsnamearray;
        }
    }


    // 获取一个用户名信息
    function get_user_name($usr)
    {
        $query = $this->db_passport->select('displayName')->where('id',$usr)->get('users');
        if ($query) {
                // array_push($usrsnamearray,$query->result()[0]->displayName);
            return $query->result()[0]->displayName;
        }else{
            return false;
        }
    }

    // 获取用户gid
    function get_user_gid($usr)
    {
        $query = $this->db_cb->select("gid")->where('uid',$usr)->get('cb_users');
        // var_dump($query);
        if ($query) {
            return $query->result();
        }else{
            return false;
        }
        
    }
    

}