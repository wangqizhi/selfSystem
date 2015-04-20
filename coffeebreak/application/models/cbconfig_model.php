<?php 
class Cbconfig_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        // var_dump("db1:".$db1);

    }
    
    // 获取认证方式
    function get_authmeth()
    {
        $db_cb = $this->load->database("default",TRUE);
        $query = $db_cb->where('configMeth','authMeth')->get('cb_config');
        if ($query) {
            return $query->result();
        }else{
            return false;
        }
        
    }


}
?>