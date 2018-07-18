<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_driver extends CI_Model 
	{
		

		var $table = 'drivers';

		// var $view = 'view_uti_drivers';

	    var $column_order = array('id', 'nama_cabang', 'nama', 'email', 'jns_sim', 'telepon', 'hp', 'jenis_driver');
	    var $column_search = array('id', 'nama_cabang', 'nama', 'email', 'jns_sim', 'telepon', 'hp', 'jenis_driver');
	    var $order = array('id' => 'desc'); 



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
			$this->db->select('	drivers.id AS id,
								drivers.pooling_id AS pooling_id,
								drivers.identitas_id AS identitas_id,
								drivers.no_identitas AS no_identitas,
								drivers.nama AS nama,
								drivers.alamat AS alamat,
								drivers.email AS email,
								drivers.tmp_lahir AS tmp_lahir,
								drivers.tgl_lahir AS tgl_lahir,
								drivers.agama_id AS agama_id,
								drivers.telepon AS telepon,
								drivers.hp AS hp,
								drivers.no_sim AS no_sim,
								drivers.tgl_exp_sim AS tgl_exp_sim,
								drivers.no_rekening AS no_rekening,
								drivers.absensi_status AS absensi_status,
								drivers.absensi_label AS absensi_label,
								drivers.absensi_date AS absensi_date,
								drivers.foto AS foto,
								drivers.active AS active,
								drivers.sim_id AS sim_id,
								drivers.jenis_driver AS jenis_driver,
								master_sim.jenis AS jenis,
								master_agama.agama AS agama,
								drivers.gapok AS gapok,
								drivers.kode_cabang AS kode_cabang');
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
			$this->db->join('master_sim','master_sim.id=drivers.sim_id');
			$this->db->join('master_agama','master_agama.id=drivers.agama_id');
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    public function count_all($where)
	    {
			$this->db->where($where);
			$this->db->select('	drivers.id AS id,
								drivers.pooling_id AS pooling_id,
								drivers.identitas_id AS identitas_id,
								drivers.no_identitas AS no_identitas,
								drivers.nama AS nama,
								drivers.alamat AS alamat,
								drivers.email AS email,
								drivers.tmp_lahir AS tmp_lahir,
								drivers.tgl_lahir AS tgl_lahir,
								drivers.agama_id AS agama_id,
								drivers.telepon AS telepon,
								drivers.hp AS hp,
								drivers.no_sim AS no_sim,
								drivers.tgl_exp_sim AS tgl_exp_sim,
								drivers.no_rekening AS no_rekening,
								drivers.absensi_status AS absensi_status,
								drivers.absensi_label AS absensi_label,
								drivers.absensi_date AS absensi_date,
								drivers.foto AS foto,
								drivers.active AS active,
								drivers.sim_id AS sim_id,
								drivers.jenis_driver AS jenis_driver,
								master_sim.jenis AS jenis,
								master_agama.agama AS agama,
								drivers.gapok AS gapok,
								drivers.kode_cabang AS kode_cabang');
			$this->db->join('master_sim','master_sim.id=drivers.sim_id');
			$this->db->join('master_agama','master_agama.id=drivers.agama_id');
			$this->db->from($this->table);
	        return $this->db->count_all_results();
	    }

	    public function count_filtered($where, $cols)
	    {
	        $this->_get_datatables_query($where, $cols);
	        return $this->db->count_all_results();
	    }
	}
