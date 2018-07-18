<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_workarea extends CI_Model 
	{
		

		var $table = 'cabang';
		var $marketing = 'marketing';
		var $ind_regencies = 'ind_regencies';
		var $ind_provinces = 'ind_provinces';

	    var $column_order = array('id','kd_cabang','nm_cabang','alamat','no_telp','kota','prov','pimpinan','no_hp_pimpinan','biaya_pesawat_kepusat','active');
	    var $column_search = array('id','kd_cabang','nm_cabang','alamat','no_telp','kota','prov','pimpinan','no_hp_pimpinan','biaya_pesawat_kepusat','active');
	    var $order = array('id' => 'desc'); 



		public function __construct() {
			parent::__construct();
		}

		public function get() {
			$table = $this->table;
			$this->db->order_by($order);
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
	    	$this->db->select(' cabang.id,
								cabang.kd_cabang,
								cabang.nm_cabang,
								cabang.alamat,
								cabang.rekening,
								cabang.no_telp,
								cabang.prov,
								ind_provinces.name_provinces,
								cabang.kota,
								ind_regencies.name_regencies,
								cabang.pimpinan,
								cabang.no_hp_pimpinan,
								cabang.biaya_pesawat_kepusat,
								cabang.referensi_cabang,
								marketing.nm_marketing,
								cabang.jenis_cabang,
								cabang.active
	    					');
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
	    	$this->db->join($this->marketing, ''.$this->table.'.referensi_cabang = '.$this->marketing.'.id');
	    	$this->db->join($this->ind_regencies, ''.$this->table.'.kota = '.$this->ind_regencies.'.id_kota');
	    	$this->db->join($this->ind_provinces, ''.$this->table.'.prov = '.$this->ind_provinces.'.id');
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
