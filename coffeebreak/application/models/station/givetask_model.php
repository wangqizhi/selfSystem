<?php 
class givetask_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->db_cb = $this->load->database("default",TRUE);
    }

    // 获取默认处理人
    function get_default_users()
    {
        $query = $this->db_cb->select('dealDefault')->distinct()->get("cb_givetask_type");
        if ($query) {
            $default_uers = array();
            foreach ($query->result() as $key => $value) {
               array_push($default_uers,$value->dealDefault);
            }
            if (count($default_uers)==0) {
                return false;
            } else {
                return $default_uers;
            }
        } else {
            return false;
        }
    }


    // 获取事件类型
    function get_task_type()
    {
        $query = $this->db_cb->select('id')->select('taskLevelOne')->select('taskLevelTwo')->get("cb_givetask_type");
        // var_dump($query->result());return;
        if ($query) {
            $tasktypes = array();
            foreach ($query->result() as $key => $value) {
               // array_push($tasktypes,$value->taskLevelOne.'-'.$value->taskLevelTwo);
                $tasktypes[$value->id] = $value->taskLevelOne.'-'.$value->taskLevelTwo;
            }
            if (count($tasktypes)==0) {
                return false;
            } else {
                return $tasktypes;
            }
        } else {
            return false;
        }
    }


}