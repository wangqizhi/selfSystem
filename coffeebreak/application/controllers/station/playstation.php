<?php
class Playstation extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        // $this->output->enable_profiler(TRUE);
        
        // 登陆判断 
        if (!$this->userdefault->checkLogin()){
            header('Location:/');
            return;
        }

        //加载静态资源
        $cssArray = array(
            '/static/css/station/station_index.css',
            );
        $jsArray = array(
            '/static/js/station/station_index.js',
            );
        $data = array(
            'title' =>"CB-station" ,
            'cssArray' =>$cssArray,
            'jsArray' =>$jsArray,
            'cb_displayName' => $this->session->sess_get('cb_displayName')
         );

        
        $this->load->model('station/station_model');
        $this->load->model('user/userinfo_model');

        $usr = $this->session->sess_get('cb_id');

        // 权限检查
        if($this->userdefault->checkPower()){
            $powerarray = array();
            $poweid = $this->userinfo_model->get_user_gid($usr)[0]->loginPower;
            $usrfunction = $this->station_model->get_playstation_group($poweid);
            foreach ($usrfunction as $key => $value) {
                // echo $value->functionGroup;
                array_push($powerarray,$value->functionGroup);
            }
            // var_dump($powerarray);
            $data['powerArray'] = $powerarray;
            // 加载页面
            $this->load->view('updown/default_head',$data);
            $this->load->view('station/view_station_index');
            $this->load->view('updown/default_foot',$data);
        }else{
            echo 'power wrong';
        }
        // $out2 = ;
        // var_dump($out2);return;
       

       
    }


}