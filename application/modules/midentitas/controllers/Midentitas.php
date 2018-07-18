<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Midentitas extends AdminController
	{
		public function __construct() {
			parent::__construct();
			$this->load->model('m_midentitas');
		}

	    public function get($order_by) 
	    {
	    	$query = $this->m_midentitas->get($order_by);
	    	return $query;
	    }

	    public function get_where($where) 
	    {
	    	$query = $this->m_midentitas->get_where($where);
	    	return $query;
	    }

	    public function insert($data)
	    {
	    	$query = $this->m_midentitas->_insert($data);
	    	return $query;
	    }

	    public function update($where, $data)
	    {
	    	$query = $this->m_midentitas->_update($where, $data);
	    	return $query;
	    }
	}
