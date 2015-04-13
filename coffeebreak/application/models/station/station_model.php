<?php 
class Station_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->db_cb = $this->load->database("default",TRUE);
    }
    
    function get_playstation_group($powerid)
    {
        $this->db_cb->select('functionGroup');
        $this->db_cb->distinct();
        $this->db_cb->like('functionPower','-'.$powerid.'-');
        $query = $this->db_cb->get("cb_function");
        if ($query) {
            return $query->result();
        }else{
            return false;
        }
        
    }

}