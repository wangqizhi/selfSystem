<?php
class Mainadmin extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->viewdefault->usr = $this->CI->session->sess_get('cb_id');
        $this->viewdefault->data['powerArray'] = $this->_getpowerarray();
        $this->viewdefault->data['substation'] = $this->viewdefault->_getsubpowerarray('admin');
        $this->viewdefault->data['subtag'] = 'insertuser';
        $this->viewdefault->_defaultview();
    }

}