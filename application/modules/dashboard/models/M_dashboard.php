<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_dashboard extends CI_Model 
	{
		var $jadwal = 'jadwal';
		var $paket = 'paket';
		var $tv_payment = 'tv_payment';

		// var $order = array('tgl_keberangkatan' => 'ASC'); 

		public function __construct() {
			parent::__construct();
		}

		public function get_jadwal($where) {
			$table = $this->jadwal;
			$this->db->where($where);
			// $this->db->order_by('tgl_keberangkatan','ASC');
			$query=$this->db->get($table);
			return $query;
		}

		public function get_group_paket($where) {
			$table = $this->paket;
			$this->db->where($where);
			$this->db->select('paket.id AS id,
							paket.jenis_travel AS jenis_travel,
							paket.nm_paket AS nm_paket,
							paket.id_pesawat AS id_pesawat,
							paket.id_hotel_makkah AS id_hotel_makkah,
							paket.id_hotel_madinah AS id_hotel_madinah,
							paket.id_hotel_umum AS id_hotel_umum,
							paket.hrg_paket AS hrg_paket,
							paket.id_hotel_b3 AS id_hotel_b3,
							paket.id_up_hotel_b4 AS id_up_hotel_b4,
							paket.biaya_up_hotel_b4 AS biaya_up_hotel_b4,
							paket.id_up_hotel_b5 AS id_up_hotel_b5,
							paket.biaya_up_hotel_b5 AS biaya_up_hotel_b5,
							paket.biaya_up_double AS biaya_up_double,
							paket.biaya_up_triple AS biaya_up_triple,
							paket.biaya_up_quad AS biaya_up_quad,
							paket.biaya_up_quint AS biaya_up_quint,
							paket.kd_cabang AS kd_cabang,
							paket.active AS active,
							paket.id_user AS id_user,
							paket.create_at AS create_at,
							paket.update_at AS update_at,
							jadwal.nm_jadwal AS nm_jadwal,
							jadwal.tgl_keberangkatan AS tgl_keberangkatan,
							jadwal.lama_hari');
			$this->db->order_by('jadwal.tgl_keberangkatan');
			$this->db->group_by('nm_paket');
			$this->db->join('jadwal','jadwal.id=paket.id_jadwal');
			$query=$this->db->get($table);
			return $query;
		}

		public function get_group_paket2($where) {
			$table = $this->paket;
			$this->db->where($where);
			$this->db->select('paket.id AS id,
							paket.jenis_travel AS jenis_travel,
							paket.nm_paket AS nm_paket,
							paket.id_pesawat AS id_pesawat,
							paket.id_hotel_makkah AS id_hotel_makkah,
							paket.id_hotel_madinah AS id_hotel_madinah,
							paket.id_hotel_umum AS id_hotel_umum,
							paket.hrg_paket AS hrg_paket,
							paket.id_hotel_b3 AS id_hotel_b3,
							paket.id_up_hotel_b4 AS id_up_hotel_b4,
							paket.biaya_up_hotel_b4 AS biaya_up_hotel_b4,
							paket.id_up_hotel_b5 AS id_up_hotel_b5,
							paket.biaya_up_hotel_b5 AS biaya_up_hotel_b5,
							paket.biaya_up_double AS biaya_up_double,
							paket.biaya_up_triple AS biaya_up_triple,
							paket.biaya_up_quad AS biaya_up_quad,
							paket.biaya_up_quint AS biaya_up_quint,
							paket.kd_cabang AS kd_cabang,
							paket.active AS active,
							paket.id_user AS id_user,
							paket.create_at AS create_at,
							paket.update_at AS update_at,
							jadwal.nm_jadwal AS nm_jadwal,
							jadwal.tgl_keberangkatan AS tgl_keberangkatan,
							jadwal.lama_hari');
			$this->db->order_by('jadwal.tgl_keberangkatan');
			$this->db->join('jadwal','jadwal.id=paket.id_jadwal');
			$query=$this->db->get($table);
			return $query;
		}


		public function get_payment($where) {
			$table = $this->tv_payment;
			$this->db->where($where);
			$query=$this->db->get($table);
			return $query;
		}


		public function jadwal()
		{
			$results = array();
			$query = $this->db->query("SELECT * FROM jadwal WHERE active = '1' order by tgl_keberangkatan ASC");
			return $query;
		}

		public function paket($id)
		{
			$results = array();
			$query = $this->db->query(' SELECT
										paket.id AS id,
										paket.jenis_travel AS jenis_travel,
										paket.nm_paket AS nm_paket,
										paket.id_jadwal AS id_jadwal,
										jadwal.nm_jadwal AS nm_jadwal,
										jadwal.tgl_keberangkatan AS tgl_keberangkatan,
										jadwal.lama_hari,
										paket.id_pesawat AS id_pesawat,
										paket.id_hotel_makkah AS id_hotel_makkah,
										(SELECT nm_hotel FROM hotel WHERE id=paket.id_hotel_makkah) AS hotel_makkah,
										paket.id_hotel_madinah AS id_hotel_madinah,
										(SELECT nm_hotel FROM hotel WHERE id=paket.id_hotel_madinah) AS hotel_madinah,
										paket.id_hotel_umum AS id_hotel_umum,
										paket.hrg_paket AS hrg_paket,
										paket.id_up_hotel_b4 AS id_up_hotel_b4,
										paket.biaya_up_hotel_b4 AS biaya_up_hotel_b4,
										paket.id_up_hotel_b5 AS id_up_hotel_b5,	
										paket.biaya_up_hotel_b5 AS biaya_up_hotel_b5,
										paket.biaya_up_double AS biaya_up_double,
										paket.biaya_up_triple AS biaya_up_triple,
										paket.biaya_up_quad AS biaya_up_quad,
										paket.biaya_up_quint AS biaya_up_quint,
										paket.kd_cabang AS kd_cabang,
										cabang.nm_cabang AS nm_cabang,
										paket.active AS active,
										paket.id_user AS id_user 
										FROM
										(( paket JOIN jadwal ON ( ( paket.id_jadwal = jadwal.id ) ) )
										JOIN cabang ON ( ( CONVERT ( paket.kd_cabang USING utf8 ) = cabang.kd_cabang )))
										WHERE id_jadwal='.$id.';
										');
			return $query->result();
		}

		public function hotel($id)
		{
			$results = array();
			$query = $this->db->query('SELECT GROUP_CONCAT(nm_hotel) AS hotel FROM hotel WHERE id in('.$id.')');
			return $query->row();
		}

		public function pesawat($id)
		{
			$results = array();
			$query = $this->db->query('SELECT GROUP_CONCAT(nama_pesawat) AS nm_pesawat FROM pesawat WHERE id in('.$id.')');
			return $query->row();
		}

	}
