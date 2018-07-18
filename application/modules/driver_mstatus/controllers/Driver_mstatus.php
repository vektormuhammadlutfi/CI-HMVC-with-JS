<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Driver_mstatus extends AdminController
	{
		public function __construct() {
			parent::__construct();
			$this->load->model('m_driver_mstatus');
		}

	    public function get($order_by) 
	    {
	    	$query = $this->m_driver_mstatus->get($order_by);
	    	return $query;
	    }


	    public function get_where($where) 
	    {
	    	$query = $this->m_driver_mstatus->get_where($where);
	    	return $query;
	    }

	    public function insert($data)
	    {
	    	$query = $this->m_driver_mstatus->_insert($data);
	    	return $query;
	    }

	    public function update($where, $data)
	    {
	    	$query = $this->m_driver_mstatus->_update($where, $data);
	    	return $query;
	    }
	}
