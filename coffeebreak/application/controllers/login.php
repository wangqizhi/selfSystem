<?php 
class Login extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array('title' =>"1" , );
        $this->load->view('updown/default_head');
        $this->load->view('updown/default_import');
        $this->load->view('view_login');
        $this->load->view('updown/default_foot');
    }

    public function show()
    {
        echo "show!";
    }
}
 ?>