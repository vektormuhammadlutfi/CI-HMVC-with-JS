<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_users extends CI_Model 
	{
		public $table = 'users';

	    var $column_order = array('id', 'first_name', 'last_name', 'username', 'email', 'phone', 'last_login', 'active');
	    var $column_search = array('id', 'first_name', 'last_name', 'username', 'email', 'phone', 'last_login', 'active');
	    var $order = array('id' => 'desc'); 

		public function __construct() 
		{
			parent::__construct();
		}

		public function get($order_by) 
		{
			$this->db->order_by($order_by);
			$query = $this->db->get($this->table);
			return $query;
		}

		public function get_where($where) 
		{
			$this->db->where($where);
			$query = $this->db->get($this->table);
			return $query;
		}

		public function insert($data) 
		{
			// Execute the query
			$query = $this->db->insert($this->table, $data);

			// Return the result
			return (bool)$query;
		}

		public function update($id, $data) 
		{
			// Execute the query
			$this->db->where('id', $id);
			$query = $this->db->update($this->table, $data);

			// Return the result
			return (bool)$query;
		}

		public function _update($where, $data) {
			$table = $this->table;
			$this->db->where($where);
			$update = $this->db->update($table, $data);
			return $update;
		}

		public function delete($id) {
			// Execute the query
			$this->db->where('id', $id);
			$query = $this->db->delete($this->table);
			
			// Return the result
			return (bool)$query;
		}

	    private function _get_datatables_query($where, $cols)
	    {

	    	$this->db->where($where);
	        $this->db->from($this->table);

	        if(!empty($cols)){

		        foreach ($cols as $col => $value)
		        {
        			$this->db->like($col, $value);
		        }

		    }

	        if(isset($_POST['order'])) // here order processing
	        {
	            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order))
	        {
	            $order = $this->order;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    public function get_datatables($where, $cols)
	    {
	        $this->_get_datatables_query($where, $cols);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    public function count_all($where)
	    {

	    	$this->db->where($where);
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }

	    public function count_filtered($where, $cols)
	    {
	        $this->_get_datatables_query($where, $cols);
	        return $this->db->count_all_results();
	    }
	}
