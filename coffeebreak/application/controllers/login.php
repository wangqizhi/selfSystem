<?php 
class Login extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array('title' =>"1" , );
        $this->load->view('hw');

    }

    public function show()
    {
        echo "show!";

    }

    // public function _output()
    // {
    //     echo "<br>from my output fun";
    // }



}
 ?>