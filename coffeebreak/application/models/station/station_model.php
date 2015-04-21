<?php 
class Station_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->db_cb = $this->load->database("default",TRUE);
    }
    
    // 获取模块
    function get_playstation_group($powerid)
    {
        $this->db_cb->select('functionGroup');
        $this->db_cb->select('functionGroupUrl');
        $this->db_cb->select('functionGroupName');
        $this->db_cb->distinct();
        $this->db_cb->like('functionPower','-'.$powerid.'-');
        $query = $this->db_cb->get("cb_function");
        if ($query) {
            return $query->result();
        }else{
            return false;
        }
        
    }

    // 获取子模块
    function get_playstation_subgroup($functionGroup,$powerid)
    {
        $this->db_cb->select('functionName');
        $this->db_cb->select('functionTag');
        $this->db_cb->select('functionUrl');
        // $this->db_cb->distinct();
        $this->db_cb->where('functionGroup',$functionGroup);
        $this->db_cb->like('functionPower','-'.$powerid.'-');
        $query = $this->db_cb->get("cb_function");
        if ($query) {
            return $query->result();
        }else{
            return false;
        }
    }

    // 判断是否有模块的权限
    function verify_playstation_power($powerid,$levelone,$leveltwo)
    {
        if ($powerid) {
            if ($leveltwo == "power_all") {
                  $query = $this->db_cb->where('functionGroup',$levelone)
                                    ->like('functionPower','-'.$powerid.'-')->get("cb_function");
            } else {
                  $query = $this->db_cb->where('functionGroup',$levelone)
                                    ->where('functionTag',$leveltwo)
                                    ->like('functionPower','-'.$powerid.'-')->get("cb_function");
            }
            
            if ($query && count($query->result())!=0) {
                return true;
            } else {
                return false;
            }
            return true;
        } else {
            return false;
        }
        
    }



}