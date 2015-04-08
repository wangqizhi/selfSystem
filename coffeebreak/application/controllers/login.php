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

// 获取用户信息
    public function _get_userInfo($usr)
    {
        $this->load->model('user/userinfo_model');
        // $uInfo = $this->userinfo_model->get_user_name($usr)[0];
        if($uInfo =$this->userinfo_model->get_user_name($usr)[0]){
            return $uInfo;

        }else{
            $uInfo = new uInfo();
            return $uInfo;
        }

    }

// 登陆API
    public function loginApi()
    {
        // $this->output->enable_profiler(TRUE);
        $this->load->model('cbconfig_model');
        $usr = $this->input->post('usr', TRUE);
        $pwd = $this->input->post('pwd', TRUE);

        if ($usr==false or $pwd==false) {
                $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => '0','detail' => '参数错误')));
                return;
                }        
        if($this->cbconfig_model->get_authmeth()[0]){
            $this->load->helper($this->cbconfig_model->get_authmeth()[0]->authMeth);
            //可替换认证方法
            $loginResult = auth_byrsa($usr,$pwd);
            // 测试用
            $loginResult = 1;
            // 等于1的时候通过，否则输出问题.
            if( $loginResult == 1 ){
                $usrInfo = $this->_get_userInfo($usr);
                $this->_loginIn($usrInfo);
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('status' => '1','detail' => array('displayName' => $usrInfo->displayName,))));
            }else{
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('status' => '0','detail' => $loginResult)));
            }
        }else{
            show_error('Not set authMeth');
        }
    }

// 登陆key
    private function _getKey()
    {
        //登陆验证的key
        return "821e851055d590709ef3753ce4bfc4aa";
    }

// 登陆方法
    public function _loginIn($usrInfo)
    {   
        $key = $this->_getKey();
        $rmIP = $_SERVER["REMOTE_ADDR"];
        $usrID = $usrInfo->id;
        $usrDisplayName = $usrInfo->displayName;
        $this->session->sess_write('cb_secret',md5($key.$usrID."@".$rmIP));
        $this->session->sess_write('cb_id_'.$usrID,$usrID);
        $this->session->sess_write('cb_displayName_'.$usrID,$usrDisplayName);
        // var_dump($this->session->sess_read());
        // $this->session->sess_destroy();
    }

// 检查登陆状态
    public function _checkLogin($usrID)
    {
        $rmIP = $_SERVER["REMOTE_ADDR"];
        if (isset($this->session->sess_read()['cb_secret']) and md5($this->_getKey().$usrID."@".$rmIP) == $this->session->sess_read()['cb_secret']) {
            return true;
        }else{
            return false;
        }
        // var_dump($this->session->sess_read()['cb_secret']);
        // $this->session->sess_destroy();
    }

// 登出
    public function loginOut()
    {
        $this->session->sess_destroy();
    }

// 测试
    public function test()
    {
        var_dump($this->_checkLogin("10000179"));
    }


}
 ?>