<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_office extends CI_Model 
	{
		public function __construct() {
			parent::__construct();
		}

		var $table = 'cabang';

		var $column_search = array('kd_cabang', 'nm_cabang', 'alamat', 'no_telp', 'kota', 'prov','pimpinan','no_hp_pimpinan','active');
		var $column_order = array('kd_cabang', 'nm_cabang', 'alamat', 'no_telp', 'kota', 'prov','pimpinan','no_hp_pimpinan','active');
		var $order = array('kd_cabang' => 'ASC');

		public function get() {
			$this->db->order_by('kd_cabang');
			$query=$this->db->get('cabang');
			return $query;
		}
		
	}
