<?php 
class Userinfo_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    // 获取认证方式
    function get_user_name($usr)
    {
        $db_passport = $this->load->database("ad_passport",TRUE);
        $query = $db_passport->where('id',$usr)->get('users');
        // var_dump($query);
        if ($query) {
            return $query->result();
        }else{
            return false;
        }
        
    }

}
?>