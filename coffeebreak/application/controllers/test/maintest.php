<?php
class Maintest extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }


    function index()
    {
         //加载静态资源
        $cssArray = array(
            '/static/css/login/login_index.css',
            );
        $jsArray = array(
            '/static/js/login/login_index.js',
            );
        $data = array(
            'title' =>"CB-Login" ,
            // 'cssArray' =>$cssArray,
            // 'jsArray' =>$jsArray,
         );

        // 加载页面
        $this->load->view('updown/default_head',$data);
        $this->load->view('view_test_index');
        $this->load->view('updown/default_foot',$data);
    }

}
