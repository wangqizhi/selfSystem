<?php
class Login extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }


// 登陆页面
    public function index()
    {
        //判断登陆跳转
        if ($this->userdefault->checkLogin() ){
            header("Location:/station/playstation");
            return;
        }

        //加载静态资源
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

        // 加载页面
        $this->load->view('updown/default_head',$data);
        $this->load->view('login/view_login_index');
        $this->load->view('updown/default_foot',$data);
    }

// 获取用户信息
    public function _get_userInfo($usr)
    {
        $this->load->model('user/userinfo_model');
        if($uInfo = $this->userinfo_model->get_user_info($usr)){
            return $uInfo[0];

        }else{
            return $this->userdefault->defaultUserinfo($usr);
        }

    }

// 登陆API
    public function loginApi()
    {
        // $this->output->enable_profiler(TRUE);
        $this->load->model('user/userinfo_model');
        $this->load->model('cbconfig_model');
        $usr = $this->input->post('usr', TRUE);
        $pwd = $this->input->post('pwd', TRUE);

        if ($usr==false or $pwd==false) {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '参数错误')));
                return;
                }        
        if($this->cbconfig_model->get_authmeth()[0]){
            $this->load->helper($this->cbconfig_model->get_authmeth()[0]->configValue);
            //可替换认证方法
            $loginResult = auth_byrsa($usr,$pwd);

            // 测试用
            $loginResult = 1;
            
            // 登陆权限检查
            $loginpower = $this->userinfo_model->get_user_loginpower($usr);

            // 更新登陆时间
            $this->userinfo_model->update_user_lastLoginTime($usr);

            // 报错对应中文提示
            $loginResultArray = array('1'=>'被锁定','-2'=>'认证失败');
            
            if( $loginResult == 1 and $loginpower ){
                $usrInfo = $this->_get_userInfo($usr);
                $this->_loginIn($usrInfo);
                // 登陆成功后跳转至主页
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('status' => '1','detail' => array('displayName' => $usrInfo->displayName,))));
            }else{
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('status' => '0','detail' => $loginResultArray[$loginResult])));
            }
        }else{
            show_error('Not set authMeth');
        }
    }


// 登陆方法
    public function _loginIn($usrInfo)
    {   
        $key = $this->session->sess_key();
        $rmIP = $_SERVER["REMOTE_ADDR"];
        $usrID = $usrInfo->id;
        $usrDisplayName = $usrInfo->displayName;
        $this->session->sess_write('cb_secret',md5($key.$usrID."@".$rmIP));
        $this->session->sess_write('cb_id',$usrID);
        $this->session->sess_write('cb_displayName',$usrDisplayName);
        log_message('debug', "****CB: User:".$usrID." login");

        // var_dump($this->session->sess_read());
        // $this->session->sess_destroy();
    }


// 登出
    public function loginOut()
    {
        log_message('debug', "****CB: sess_destroy");
        $this->session->sess_destroy();
        // var_dump(header("Referer"));
        header("Location:/");


    }

// 测试
    // public function test()
    // {
    //     // var_dump($this->userdefault->checkLogin("10000179"));
    //     echo "t";
    //     $test =$this->userdefault->checkPower();
    //     var_dump($test);

    // }


}
 ?>