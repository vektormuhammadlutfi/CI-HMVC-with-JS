<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_customer extends CI_Model 
	{
		

		var $table = 'uti_customer';

		var $view = 'view_uti_customer';

	    var $column_order = array('id_customer', 'nm_customer', 'alamat', 'jenis_customer', 'ktp', 'npwp', 'no_telp', 'email');
	    var $column_search = array('id_customer', 'nm_customer', 'alamat', 'jenis_customer', 'ktp', 'npwp', 'no_telp', 'email');
	    var $order = array('id_customer' => 'desc'); 



		public function __construct() {
			parent::__construct();
		}

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
