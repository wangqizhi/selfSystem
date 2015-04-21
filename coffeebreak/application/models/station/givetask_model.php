<?php 
class givetask_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->db_cb = $this->load->database("default",TRUE);
    }

    // 获取所有默认处理人
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

    // 获取task默认联系人
    function get_default_user_bylevel($levelone,$leveltwo)
    {
        if ($levelone && $leveltwo) {
            $query = $this->db_cb->select('dealDefault')
                                    ->where('taskLevelOne',$levelone)
                                    ->where('taskLevelTwo',$leveltwo)->get("cb_givetask_type");
            if ($query && count($query->result())!=0) {
                return $query->result();
            } else {
                return false;
            }
            
        } else {
            return false;
        }
        
    }


    // 获取事件类型
    function get_task_type()
    {
        $query = $this->db_cb->select('id')->select('taskLevelOne')->select('taskLevelTwo')->order_by("taskLevelOne")->get("cb_givetask_type");
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


    // 获取事件ID
    function get_task_id($levelone,$leveltwo,$dealdefault)
    {
        $query = $this->db_cb->select('id')->where('taskLevelOne',$levelone)->where('taskLevelTwo',$leveltwo)->where('dealDefault',$dealdefault)->get("cb_givetask_type");
        if ($query){
            return $query->result();
        }else{
            return false;
        }

    }

    // 设置事件及默认联系人(未做插入失败判断)
    function set_task_type($levelone,$leveltwo,$dealdefault)
    {
        $query = $this->db_cb->select('id')->where('taskLevelOne',$levelone)->where('taskLevelTwo',$leveltwo)->where('dealDefault',$dealdefault)->get("cb_givetask_type");
        if ( $query && count($query->result()) == 0 ) {
            $data = array(
                    'taskLevelOne' => $levelone,
                    'taskLevelTwo' => $leveltwo,
                    'dealDefault' => $dealdefault,
                    );
            $res = $this->db_cb->insert('cb_givetask_type',$data);
            // var_dump($res);
            return true;
        }elseif( $query && count($query->result()) == 1 ) {
            $data = array(
                    'dealDefault' => $dealdefault,
                    );
            $this->where('taskLevelOne',$levelone)->where('taskLevelTwo',$leveltwo);
            $res = $this->db_cb->update('cb_givetask_type',$data);
            return true;
        }else{
            return false;
        }
    }

    // 插入事件
    function set_task($typeid,$taskcontent,$nowman,$askman)
    {
        $data = array(
                'typeID' => $typeid ,
                'taskContent' => $taskcontent ,
                'taskPath' =>  $askman.'@'.time().':a',
                'nowMan' => $nowman ,
                'askMan' => $askman ,
                'taskStatus' => 1 ,
                'startTime' => time() ,
                'finishTime' => 0,
            );
        $res = $this->db_cb->insert('cb_givetask_task',$data);
        if ($res) {
            return true;
        } else {
            return false;
        }
        
    }

    // 获取用户未处理事件
    function get_task_undeal($usr)
    {
        $query = $this->db_cb->select('id')->select('typeID')->select('startTime')
                                ->where('nowMan',$usr)
                                ->where('taskStatus',1)
                                // ->or_where('nowMan',$usr)
                                // ->where('taskStatus',2)
                                ->order_by('startTime')
                                ->get('cb_givetask_task');
        if ( $query && count($query->result())!=0 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    // 获取用户待关事件
    function get_task_aboutusr($usr)
    {
        $query = $this->db_cb->select('id')->select('typeID')->select('startTime')
                                ->where('nowMan',$usr)
                                ->where('taskStatus',2)
                                ->order_by('taskStatus')
                                ->get('cb_givetask_task');
        if ( $query && count($query->result())!=0 ) {
            return $query->result();
        } else {
            return false;
        }
    }


    // 获取用户提交未完成事件
    function get_task_commit($usr)
    {
        $query = $this->db_cb->select('id')->select('typeID')->select('startTime')->select('taskContent')->select('nowMan')
                                ->where('askMan',$usr)
                                ->where('taskStatus',1)
                                ->order_by('startTime')
                                ->get('cb_givetask_task');
        if ( $query && count($query->result())!=0 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    // 获取事件内容
    function get_task_info($caseid)
    {
        $query = $this->db_cb->where('id',$caseid)->get('cb_givetask_task');
        if ( $query && count($query->result())==1 ) {
            return $query->result();
        } else {
            return false;
        }
        
    }

    // 获取事件类型，根据ID
    function get_tasktype_byid($typeid)
    {
        $query = $this->db_cb->select('taskLevelOne')->select('taskLevelTwo')->where('id',$typeid)->get('cb_givetask_type');
        if ( $query && count($query->result())==1 ) {
            return $query->result()[0];
        } else {
            return false;
        }
    }

    // 获取message，根据ID
    function get_message_content($msgid)
    {
        $query = $this->db_cb->select('msgContent')->where('id',$msgid)->get('cb_givetask_message');
        if ( $query && count($query->result())==1 ) {
            return $query->result()[0];
        } else {
            return false;
        }
    }


    // 更新事件
    function update_task($action,$caseid,$usr,$givemessage,$forwardman)
    {
        if ($action =='' && $caseid =='' && $usr =='') {
            return false;
        }
        $query_power = $this->db_cb->select('id')->select('taskPath')->select('askMan')->where('id',$caseid)->where('nowMan',$usr)->get('cb_givetask_task');
        if($query_power and count($query_power->result())!=0 ){

            $askman = $query_power->result()[0]->askMan;
            // 留言id
            if ($givemessage=='') {
                $givemessage_id = 0;
            } else {
                $msghash = md5($givemessage);
                $query_msg = $this->db_cb->select('id')->where('hashValue',$msghash)->get('cb_givetask_message');
                if ($query_msg && count($query_msg->result()) == 0 ) {
                    $msg_data = array(
                                    'hashValue' => $msghash,
                                    'msgContent' => $givemessage,
                                    );
                    $this->db_cb->insert('cb_givetask_message',$msg_data);
                    $query_msg_insert = $this->db_cb->select('id')->where('hashValue',$msghash)->get('cb_givetask_message');
                    $givemessage_id = $query_msg_insert->result()[0]->id;
                } elseif($query_msg && count($query_msg->result()) != 0 ){
                    $givemessage_id = $query_msg->result()[0]->id;
                } else {
                    $givemessage_id = 0;
                }
                
            }
            // 操作时间戳
            $do_time = time();
            $taskPath = $query_power->result()[0]->taskPath;
            
            if ($action == 'case_submit') {
                $data = array(
                    'taskPath' => $taskPath.'-'.$askman.'@'.$do_time.':'.$givemessage_id,
                    'nowMan' => $askman,
                    'taskStatus' => 2,
                    );
                $this->db_cb->where('id',$caseid);
                $this->db_cb->update('cb_givetask_task',$data);

            } elseif ($action == 'case_reject') {
                $data = array(
                    'taskPath' => $taskPath.'-'.$usr.'@'.$do_time.':'.$givemessage_id,
                    'taskStatus' => 0,
                    'finishTime' => $do_time,
                    );
                $this->db_cb->where('id',$caseid);
                $this->db_cb->update('cb_givetask_task',$data);
            } elseif ($action == 'case_forward') {
                if ($forwardman == '') {
                    return false;
                }
                // 如需必要需要写一下转发人的判断，当前未检测
                /*
                if($forwardman not in $default usr array){
                    reutrn false;
                }
                */
                $data = array(
                    'taskPath' => $taskPath.'-'.$usr.'@'.$do_time.':'.$givemessage_id,
                    'taskStatus' => 1,
                    'finishTime' => $do_time,
                    'nowMan' => $forwardman,
                    );
                $this->db_cb->where('id',$caseid);
                $this->db_cb->update('cb_givetask_task',$data);
            } elseif ($action == 'case_close') {
                $data = array(
                    'taskPath' => $taskPath.'-'.$usr.'@'.$do_time.':'.$givemessage_id,
                    'taskStatus' => 3,
                    'finishTime' => $do_time,
                    );
                $this->db_cb->where('id',$caseid);
                $this->db_cb->update('cb_givetask_task',$data);

            }else {
                // action错误
                return false;
            }
        }else{
            // 没有权限更新task
            return false;

        }

    }


}