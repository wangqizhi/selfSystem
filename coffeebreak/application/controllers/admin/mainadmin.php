<?php
class Mainadmin extends CI_Controller {


    function __construct()
    {
        parent::__construct();

        //加载model
         $this->load->model('user/userinfo_model');
    }

    function index()
    {
        header("Location:/admin/mainadmin/approveuser");

    }

    function approveuser()
    {
        // 验证权限admin-aboutuser
        if(!$this->userdefault->checkPower('admin-aboutuser')){
            header('Location:/');
        }
        
        // 获取session
        $this->viewdefault->usr = $this->session->sess_get('cb_id');

        // 设置页面标题
        $this->viewdefault->data['title'] = "管理-用户开通";

        // 用户名
        $this->viewdefault->data['cb_displayName'] = $this->session->sess_get('cb_displayName');

        // 获取权限组
        $this->viewdefault->data['substation'] = $this->viewdefault->_getsubpowerarray('admin');
        
        // 获取选中标示
        $this->viewdefault->data['subtag'] = 'aboutuser';

        // 获取所有用户信息
        $this->viewdefault->data['allusrs'] = $this->userinfo_model->get_user_login();
        $allpower = $this->userinfo_model->get_power_name();

        $allusridarray = array();
        $allpowerarray = array(0=>'N/A');

        foreach ($allpower as $key => $value) {
            $allpowerarray[$value->id] =  $value->groupName;
        }
        $this->viewdefault->data['allpowerarray'] = $allpowerarray;

        foreach ($this->viewdefault->data['allusrs'] as $key => $value) {
            array_push($allusridarray, $value->uid);
        }
        $this->viewdefault->data['allusrsname'] = $this->userinfo_model->get_users_name($allusridarray);


        // 设置主题
        $this->viewdefault->style = 'mater';

        // 加载js/css
        array_push($this->viewdefault->cssArray,'/static/css/cbadmin/admin_index.css');
        array_push($this->viewdefault->jsArray,'/static/js/cbadmin/admin_index.js');
        $this->viewdefault->_getjscss();

        // 加载view
        $this->viewdefault->_defaultview('/admin/view_admin_index');
    }

    function openusrApi()
    {
        if(!$this->userdefault->checkPower('admin-aboutuser')){
            header('Location:/');
        }
        $usrid = $this->input->post('usrid');
        $out = $this->userinfo_model->set_user_loginpower($usrid);
        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => $out)));
    }




}