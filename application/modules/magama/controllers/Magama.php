<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Magama extends AdminController
	{
		public function __construct() {
			parent::__construct();
			$this->load->model('m_magama');
		}

	    public function get($order_by) 
	    {
	    	$query = $this->m_magama->get($order_by);
	    	return $query;
	    }

	    public function get_where($where) 
	    {
	    	$query = $this->m_magama->get_where($where);
	    	return $query;
	    }

	    public function insert($data)
	    {
	    	$query = $this->m_magama->_insert($data);
	    	return $query;
	    }

	    public function update($where, $data)
	    {
	    	$query = $this->m_magama->_update($where, $data);
	    	return $query;
	    }
	}
