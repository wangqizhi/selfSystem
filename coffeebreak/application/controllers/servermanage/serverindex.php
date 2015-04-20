<?php
class Serverindex extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->viewdefault->data['substation'] = $this->viewdefault->_getsubpowerarray('testWqz');
        $this->viewdefault->data['subtag'] = 'test001';
        $this->viewdefault->_defaultview();
    }

}