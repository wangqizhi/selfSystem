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
                $subpowerarray[$value->functionTag] = $value->functionName;
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
        if ($task == "stask") {
            
            $whos =  $this->userinfo_model->get_users_name(array("10000179","10000266"));

            $default_users = $this->givetask_model->get_default_users();
            $default_users_withname =  $this->userinfo_model->get_users_name($default_users);
            $tasktypes = $this->givetask_model->get_task_type();

            $this->data['defaultusers'] = $default_users_withname;
            $this->data['tasktypes'] = $tasktypes;
            array_push($this->jsArray,'/static/js/station/station_givetask.js');
            array_push($this->cssArray,'/static/css/station/station_givetask.css');
            $this->_getjscss();
            $this->_defaultview("givetaskStask");

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


    function gettaskusersApi()
    {

    }

    function test(){
        $test =  $this->userinfo_model->get_users_name(array("10000179","10000266"));
        var_dump($test);

    }

}