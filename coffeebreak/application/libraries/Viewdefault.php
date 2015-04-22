<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
2015-04-13
modify by wqz
*/


class Viewdefault {

    public function __construct()
    {
        log_message('debug', "My Viewdefault Class Initialized");
        $this->CI =& get_instance();

        $this->style = false;

        //加载默认静态资源
        $this->cssArray = array(
            '/static/css/station/station_index.css',
            );
        $this->jsArray = array(
            '/static/js/station/station_index.js',
            );

        //初始化部分view中变量 
        $this->data['cb_displayName'] = false;//$this->CI->session->sess_get('cb_displayName');
        $this->data['title'] = "CB-station";
        $this->_getjscss();




        // 加载模型：用户及station
        $this->CI->load->model('station/station_model');
        // $this->CI->load->model('station/givetask_model');
        $this->CI->load->model('user/userinfo_model');



        // 通过session获取用户id
        $this->usr = 0;//$this->CI->session->sess_get('cb_id');
        $this->data['powerArray'] = false;//$this->_getpowerarray();
        $this->data['substation'] = false;//$this->_getsubpowerarray();//获取子模块数组
        $this->data['subtag'] = "none";//选中哪个

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
        // $powerarray = array();
        $gid = $this->CI->userinfo_model->get_user_gid($this->usr)[0]->gid;
        $usrfunction = $this->CI->station_model->get_playstation_group($gid);
        // foreach ($usrfunction as $key => $value) {
        //         $powerarray[$value->functionGroup] = $value->functionGroupName;
        // }
        return $usrfunction;
    }


    // 获取子模块权限
    function _getsubpowerarray($which=false)
    {
        if (!$which) {
            return false;
        }
        $subpowerarray = array();
            $gid = $this->CI->userinfo_model->get_user_gid($this->usr)[0]->gid;
            $usrsubfunction = $this->CI->station_model->get_playstation_subgroup($which,$gid);
            foreach ($usrsubfunction as $key => $value) {
                $subpowerarray[$value->functionTag] = array($value->functionName,$value->functionUrl);
        }
        return $subpowerarray;
    }


    // view封装
    function _defaultview($default=false)
    {
        // 加载默认view
        if ($this->style=='mater') {
            $this->CI->load->view('updown/mater_head',$this->data );
            $this->CI->load->view('station/view_station_indexmater');
            if ($default) {
                $this->CI->load->view($default,$this->data);
            }
            $this->CI->load->view('station/view_station_foot');
            $this->CI->load->view('updown/mater_foot',$this->data );
        } else {
            $this->CI->load->view('updown/default_head',$this->data );
            $this->CI->load->view('station/view_station_indexboot');
            if ($default) {
                $this->CI->load->view($default,$this->data);
            }
            $this->CI->load->view('station/view_station_foot');
            $this->CI->load->view('updown/default_foot',$this->data );
        }
        
       
    }


}