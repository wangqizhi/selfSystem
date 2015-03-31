<?php 
class ListTask extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo "Helloworld!-ls";
        $test  = $this->load->view('hw',"",true);

    }

    public function show()
    {
        echo "in-show-";
        $this->load->view('hw');

    }




}
 ?>