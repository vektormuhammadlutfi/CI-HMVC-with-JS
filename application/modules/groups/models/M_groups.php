<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_groups extends CI_Model 
	{
		public function __construct() {
			parent::__construct();
		}

		var $table = "groups";
		var $column_search = array('name', 'description');
		var $column_order = array('name', 'description');
	    var $order = array('id' => 'desc'); 

		public function get($order_by) {
			$table = $this->table;
			$this->db->order_by($order_by);
			$query=$this->db->get($table);
			return $query;
		}

		public function get_where($where) {
			$table = $this->table;
			$this->db->where($where);
			$query=$this->db->get($table);
			return $query;
		}

		public function _insert($data) {
			$table = $this->table;
			$insert = $this->db->insert($table, $data);
			return $insert;
		}

		public function _update($where, $data) {
			$table = $this->table;
			$this->db->where($where);
			$update = $this->db->update($table, $data);
			return $update;
		}

		public function count_where($column, $value) {
			$table = $this->table;
			$this->db->where($column, $value);
			$query=$this->db->get($table);
			$num_rows = $query->num_rows();
			return $num_rows;
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
