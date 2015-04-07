<?php 
class Cbconfig_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function get_authmeth()
    {

        $query = $this->db->get('cb_config');
        if ($query) {
            return $query->result();
        }else{
            return false;
        }
        
    }


}
?>