<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_magama extends CI_Model 
	{
		public function __construct() {
			parent::__construct();
		}

		var $table = 'master_agama';
		var $view = 'master_agama';

		public function get($order_by) {
			$table = $this->table;
			$this->db->order_by($order_by);
			$query=$this->db->get($table);
			return $query;
		}

		public function get_where($where) {
			$table = $this->view;
			$this->db->where($where);
			$query=$this->db->get($table);
			return $query;
		}

		public function _insert($data) {
			$table = $this->table;
			$insert = $this->db->insert($table, $data);
			return $insert;
		}

		public function _update($id, $data) {
			$table = $this->table;
			$this->db->where('id', $id);
			$update = $this->db->update($table, $data);
			return $update;
		}
	}
