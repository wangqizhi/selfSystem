<?php
class Playstation extends CI_Controller {


    function __construct()
    {
        parent::__construct();

        //加载静态资源
        $this->cssArray = array(
            '/static/css/station/station_index.css',
            );
        $this->jsArray = array(
            '/static/js/station/station_index.js',
            );
        $this->data = array(
            'title' =>"CB-station" ,
            'cssArray' =>$this->cssArray,
            'jsArray' =>$this->jsArray,
            'cb_displayName' => $this->session->sess_get('cb_displayName'),
            // 'substation' => false,
         );

        // 加载模型：用户及station
        $this->load->model('station/station_model');
        $this->load->model('user/userinfo_model');

        // 通过session获取用户id
        $this->usr = $this->session->sess_get('cb_id');
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
            $this->load->view('updown/default_head',$this->data );
            $this->load->view('station/view_station_index');
            $this->load->view('updown/default_foot',$this->data );

        }else{
            echo 'power wrong';
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
                var_dump($key);
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

            $this->load->view('updown/default_head',$this->data );
            $this->load->view('station/view_station_index');
            $this->load->view('updown/default_foot',$this->data );
            // if (!$subwhich) {
            //     // 加载默认页页面
            //     $this->load->view('updown/default_head',$this->data );
            //     $this->load->view('station/view_station_index');
            //     $this->load->view('updown/default_foot',$this->data );
            // }else{
            //     echo $subwhich;
            // }
            


        }else{
            header('Location:/station/playstation');
            return;
        }
    }

    // function test(){
    //     var_dump("1");
    //     $test = array("1"=>"tes","2"=>"test2");
    //     $test["123"]="test";
    //     var_dump($test);

    // }

}