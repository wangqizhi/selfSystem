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
		// 打开原生session
		session_start();
	}

	function sess_key()
	{
		return "821e851055d590709ef3753ce4bfc4aa";
	}

	
	function sess_read()
	{
		return $_SESSION;
	}

	function sess_get($item)
	{
		// return $_SESSION[$item];
		if(!$out = $_SESSION[$item])
		{
			return false;
		}else
		{
			return $out;
		}
	}

	function sess_getid()
	{
		return session_id();
	}

	function sess_write($key,$value)
	{
		$_SESSION[$key] = $value;
	}

	function sess_create()
	{
		
	}


	function sess_update()
	{
		
	}


	function sess_destroy()
	{
		session_destroy();
	}

	function sess_destroyid($sessid)
	{
		session_id($sessid);
		session_destroy();
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
