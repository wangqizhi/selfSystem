<?php
class Mainadmin extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        header("Location:/admin/mainadmin/approveuser");

    }

    function approveuser()
    {
        // 获取session
        $this->viewdefault->usr = $this->session->sess_get('cb_id');

        // 设置页面标题
        $this->viewdefault->data['title'] = "管理-用户开通";

        // 用户名
        $this->viewdefault->data['cb_displayName'] = $this->session->sess_get('cb_displayName');

        // 获取权限
        $this->viewdefault->data['powerArray'] = $this->viewdefault->_getpowerarray();
        $this->viewdefault->data['substation'] = $this->viewdefault->_getsubpowerarray('admin');
        $this->viewdefault->data['subtag'] = 'insertuser';
        $this->viewdefault->_defaultview();
    }


}