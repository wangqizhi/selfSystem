<?php
class Playstation extends CI_Controller {


    function __construct()
    {
        parent::__construct();

        
        //加载默认静态资源
        $this->cssArray = array(
            '/static/css/station/station_index.css',
            );
        $this->jsArray = array(
            '/static/js/station/station_index.js',
            );

        //初始化部分view中变量 
        $this->data['cb_displayName'] = $this->session->sess_get('cb_displayName');
        $this->data['title'] = "CB-station";
        $this->_getjscss();

        // 加载模型：用户及station
        $this->load->model('station/station_model');
        $this->load->model('station/givetask_model');
        $this->load->model('user/userinfo_model');

        // 通过session获取用户id
        $this->usr = $this->session->sess_get('cb_id');
    }


    // 加载静态资源
    function _getjscss()
    {
        $this->data['cssArray'] =   $this->cssArray;
        $this->data['jsArray']  =   $this->jsArray;
    }


    // 获取主模块权限
    function _getpowerarray()
    {
        $powerarray = array();
            $gid = $this->userinfo_model->get_user_gid($this->usr)[0]->gid;
            $usrfunction = $this->station_model->get_playstation_group($gid);
            foreach ($usrfunction as $key => $value) {
                $powerarray[$value->functionGroup] = $value->functionGroupName;
        }
        return $powerarray;
    }


    // 获取子模块权限
    function _getsubpowerarray($which)
    {
        $subpowerarray = array();
            $gid = $this->userinfo_model->get_user_gid($this->usr)[0]->gid;
            $usrsubfunction = $this->station_model->get_playstation_subgroup($which,$gid);
            foreach ($usrsubfunction as $key => $value) {
                $subpowerarray[$value->functionTag] = array($value->functionName,$value->functionUrl);
        }
        return $subpowerarray;
    }


    // view封装
    function _defaultview($default=false)
    {
        // 加载默认view
        $this->load->view('updown/default_head',$this->data );
        $this->load->view('station/view_station_index');
        if ($default) {
            $this->load->view('station/view_station_'.$default,$this->data);
        }
        $this->load->view('station/view_station_foot');
        $this->load->view('updown/default_foot',$this->data );
    }


    //url: /station/playstation
    function index()
    {
        // $this->output->enable_profiler(TRUE);
        
        // 登陆判断 
        if (!$this->userdefault->checkLogin()){
            header('Location:/');
            return;
        }

        // 权限检查
        if($this->userdefault->checkPower()){
            
            // var_dump($powerarray);
            $this->data['powerArray'] = $this->_getpowerarray();
            $this->data['substation'] = false;

            // 加载默认页页面
            $this->_defaultview();

        }else{
            echo 'power wrong';
        }
    }


    //派单部分 
    function _givetask($task)
    {
        // 加载静态资源
        array_push($this->jsArray,'/static/js/station/station_givetask.js');
        array_push($this->cssArray,'/static/css/station/station_givetask.css');
        $this->_getjscss();
        
        if ($task == "stask") {
            
            // 获取用户
            $default_users = $this->givetask_model->get_default_users();
            $default_users_withname =  $this->userinfo_model->get_users_name($default_users);
            $tasktypes = $this->givetask_model->get_task_type();
            $commitusr = $this->givetask_model->get_task_commit($this->usr);

            // 加载数据
            $this->data['defaultusers'] = $default_users_withname;
            $this->data['tasktypes'] = $tasktypes;
            $this->data['commitusr'] = $commitusr;

            // 获取view
            $this->_defaultview("givetaskStask");

        }elseif($task == "rtask"){

            // // 获取用户
            $default_users = $this->givetask_model->get_default_users();
            $default_users_withname =  $this->userinfo_model->get_users_name($default_users);
            // $tasktypes = $this->givetask_model->get_task_type();

            // // 加载数据
            $this->data['defaultusers'] = $default_users_withname;
            // $this->data['tasktypes'] = $tasktypes;

            // 
            $undealtask = $this->givetask_model->get_task_undeal($this->usr);
            $aboutusr = $this->givetask_model->get_task_aboutusr($this->usr);
            $tasktypes = $this->givetask_model->get_task_type();
            $this->data['undealtask'] = $undealtask;
            $this->data['aboutusr'] = $aboutusr;
            $this->data['tasktypes'] = $tasktypes;

            // 获取view
            $this->_defaultview("givetaskRtask");


        }else{
            $this->_defaultview();

        }

    }


    //url: /station/playstation/choose
    function choose($which,$subwhich=false)
    {
        // 如果没有参数跳转至station
        if (!$which) {
            header('Location:/station/playstation');
            return;
        }

        // 登陆判断 
        if (!$this->userdefault->checkLogin()){
            header('Location:/');
            return;
        }
        // 权限检查
        if($this->userdefault->checkPower()){

            $this->data['powerArray'] = $this->_getpowerarray();
            $mysubpowerarray = $this->_getsubpowerarray($which);
            $this->data['substation'] = $mysubpowerarray;
            $this->data['station'] = $which;
            // $this->data['subwhich'] = $this->_getsubpowerarray($which);
            foreach ($mysubpowerarray as $key => $value) {
                if (!$subwhich and count($mysubpowerarray)>0 ) {
                    $this->data['subtag'] = $key;
                    break;
                }
                if ($subwhich == $key) {
                    $this->data['subtag'] = $key;
                    break;
                }
                $this->data['subtag'] = "none";
            }

            // 判断模块
            if ($which=="givetask") {
                // $this->load->view('station/view_station_givetaskStask',$this->data);
                $this->_givetask($this->data['subtag']);
            }else{
                $this->_defaultview();
            }


        }else{
            header('Location:/station/playstation');
            return;
        }
    }


    // 提交任务
    function savetaskApi()
    {
        // 判断是否有调用权限
        $verity_power = $this->userdefault->checkPower('givetask-stask');
        if($verity_power){

            // stask页面获取的post
            $tasktype_post = $this->input->post("tasktype");
            $defaulttaskuser_post = $this->input->post("defaulttaskuser");
            $taskcontent_post = $this->input->post("taskcontent");


            // 空值处理
            if ( $tasktype_post== "" || $defaulttaskuser_post== "" || trim($taskcontent_post)== "" ) {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '缺少参数')));
                return;
            }

            // 异常值处理
            $tasklevelarray = preg_split('/-/',$tasktype_post);
            if (count($tasklevelarray)!=2) {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '事件类型错误')));
                return;
            }
            
            // 获取task类型
            $tasklevelone = $tasklevelarray[0];
            $taskleveltwo = $tasklevelarray[1];


            // 获取默认联系人
            $defaulttaskuser = $this->givetask_model->get_default_user_bylevel($tasklevelone,$taskleveltwo);

            if ($defaulttaskuser_post == 'default' && !$defaulttaskuser) {
                // 无默认联系人
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '该事件没有默认联系人，请选择')));
                return;
            } else {
                // 无默认联系人则增加
                if (!$defaulttaskuser) {
                    $inserttaskresult = $this->givetask_model->set_task_type($tasklevelone,$taskleveltwo,$defaulttaskuser_post);
                    if ($inserttaskresult == false ) {
                        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '提交事件失败')));
                        return;
                    }
                    $defaulttaskuser_real = $defaulttaskuser_post;
                }else{
                    $defaulttaskuser_real = $defaulttaskuser[0]->dealDefault;

                }
                // 插入事件
                $taskid_query = $this->givetask_model->get_task_id($tasklevelone,$taskleveltwo,$defaulttaskuser_real);

                // 确认有task id
                if ( $taskid_query && ($taskid = $taskid_query[0]->id) > 0 ) {
                    // 确认插入用户
                    if($defaulttaskuser_post =='default'){
                        $nowman = $defaulttaskuser_real;
                    }else{
                        $nowman = $defaulttaskuser_post;
                    }

                    // $taskcontent_post_array = preg_split('//n/',$taskcontent_post);
                    $taskcontent_post_real = preg_replace('/\n/', '<br>', $taskcontent_post);
                    // foreach ($taskcontent_post_array as $key => $value) {
                    //     $taskcontent_post_real = $taskcontent_post_real."<br>".$value;
                    // }

                    $task_query = $this->givetask_model->set_task($taskid,$this->security->xss_clean($taskcontent_post_real),$nowman,$this->usr);
                    
                    // 确认插入成功
                    if ($task_query) {
                        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '1','detail' => '派单成功')));
                        return;
                    } else {
                        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '派单失败')));
                        return;
                    }
                    
                } else {
                    $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '获取事件类型ID失败')));
                    return;
                }

            }
        }else{
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '无权限')));
            return;
        }
    }

    // 获取任务信息
    function gettaskApi()
    {
        // 权限判断
        $verity_power = $this->userdefault->checkPower('givetask-rtask');
        if ($verity_power) {
            $caseid = $this->input->post('caseid');
            if ($caseid == '') {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '参数错误')));
                return;
            } 

            $caseinfo = $this->givetask_model->get_task_info($caseid);
            if ($caseinfo) {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '1','detail' => $caseinfo)));
                return;
            } else {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '无指定事件')));
                return;
            }
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '无权限')));
            return;
        }
        
    }

    function getusrnameApi()
    {
        if (!$this->userdefault->checkLogin()){
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '无权限')));
            return;
        }
        $userid = $this->input->post("usrid");
        $default_users_withname =  $this->userinfo_model->get_user_name($userid);
        if ($default_users_withname) {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '1','detail' => $default_users_withname)));
            return;
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '查询失败')));
            return;
        }
        
    }


    // 更新任务信息
    function updatetaskApi()
    {
        // 权限判断
        $verity_power = $this->userdefault->checkPower('givetask-rtask');
        if ($verity_power) {

            // 获取post 
            $case_action = $this->input->post('case_action');
            $case_saywhat = $this->input->post('case_saywhat');
            $case_id = $this->input->post('case_id');

            if ( $case_action == '' || $case_saywhat == '' || $case_id == 0) {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '参数错误')));
                return;
            }

            // 判断转发人是否为空
            $case_forwardman = $this->input->post('case_forwardman');
            if ( $case_action == "case_forward" &&  $case_forwardman == '') {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '没有转发人')));
                return;
            }else{
                $case_forwardman = $this->input->post('case_forwardman');

            }


            // case动作数据库操作
            $case_action_result = $this->givetask_model->update_task($case_action,$case_id,$this->usr,$case_saywhat,$case_forwardman);
            

            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '1','detail' => 'hello')));
            return;
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '无权限')));
            return;
        }
        
    }


    function test(){
        var_dump($_SESSION);

    }


}