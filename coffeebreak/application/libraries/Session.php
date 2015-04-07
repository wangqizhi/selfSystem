<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/*
2015-03-31
modify by wqz
*/


class CI_Session {

	
	public function __construct()
	{
		log_message('debug', "My Session Class Initialized");
		$this->CI =& get_instance();
		session_start();
	}

	
	function sess_read()
	{
		
	}

	function sess_write()
	{
	
	}

	function sess_create()
	{
		
	}


	function sess_update()
	{
		
	}


	function sess_destroy()
	{
		
	}

	
	function userdata($item)
	{

	}

	
	function all_userdata()
	{
	}


	function set_userdata($newdata = array(), $newval = '')
	{
		
	}

	function unset_userdata($newdata = array())
	{
		
	}

	
	function set_flashdata($newdata = array(), $newval = '')
	{
		
	}


	function keep_flashdata($key)
	{
		
	}

	
	function flashdata($key)
	{
		
	}


	function _flashdata_mark()
	{

	}



	function _flashdata_sweep()
	{
	
	}

	

	function _get_time()
	{
		
	}


	function _set_cookie($cookie_data = NULL)
	{

	}

	
	function _serialize($data)
	{
	
	}

	
	function _unserialize($data)
	{
	
	}


	function _sess_gc()
	{
		
	}


}
