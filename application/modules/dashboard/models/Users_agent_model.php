<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Users_agent_model extends CI_Model 
	{
		

		var $table = 'users_agent';

		public function insert($data) {
			$table = $this->table;
			$insert = $this->db->insert($table, $data);
			return $insert;
		}

	}
