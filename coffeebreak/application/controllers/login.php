<?php 
class Login extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }


// 登陆页面
    public function index()
    {
        $cssArray = array(
            '/static/css/login/login_index.css',
            );
        $jsArray = array(
            '/static/js/login/login_index.js',
            );
        $data = array(
            'title' =>"CB-Login" ,
            'cssArray' =>$cssArray,
            'jsArray' =>$jsArray,
         );
        $this->load->view('updown/default_head',$data);
        $this->load->view('login/view_login_index');
        $this->load->view('updown/default_foot',$data);
    }

// 登陆API
    public function loginApi()
    {
        $this->load->model('cbconfig_model');
        $usr = $this->input->post('usr', TRUE);
        $pwd = $this->input->post('pwd', TRUE);

        if ($usr==false or $pwd==false) {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '参数错误')));
                return;
                }        
        if($this->cbconfig_model->get_authmeth()[0]){
            $this->load->helper($this->cbconfig_model->get_authmeth()[0]->authMeth);
            //替换认证方法
            $loginResult = auth_byrsa($usr,$pwd);
            // 测试用
            $loginResult = 1;
            // 等于1的时候通过，否则输出问题.
            if( $loginResult == 1 ){
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '1','detail' => '认证成功')));
            }else{
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => $loginResult)));
            }
            // auth_byrsa("10000179","1234197555");
        }else{
            show_error('Not set authMeth');
        }
    }




}
 ?>