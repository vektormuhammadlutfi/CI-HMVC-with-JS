    <?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_indonesia extends CI_Model {


		var $provinsi = 'ind_provinces';
		var $kota = 'ind_regencies';
		// var $kecamatan = 'ind_districts';

		public function __construct() {
			parent::__construct();
		}

        public function get_provinsi()
        {
            $this->db->order_by('name_provinces', 'asc');
            return $this->db->get($this->provinsi)->result();
        }

        public function get_kota()
        {
            // kita joinkan tabel kota dengan provinsi
            $this->db->order_by('name_regencies', 'asc');
            $this->db->join($this->provinsi, ''.$this->kota.'.province_id = '.$this->provinsi.'.id');
            return $this->db->get($this->kota)->result();
        }

        public function get_provinsi_where($where) {
            $table = $this->provinsi;
            $this->db->where($where);
            $query=$this->db->get($table);
            return $query;
        }

        public function get_kota_where($where) {
            $table = $this->kota;
            $this->db->where($where);
            $query=$this->db->get($table);
            return $query;
        }

        // public function get_kecamatan()
        // {
        //     // kita joinkan tabel kecamatan dengan kota
        //     $this->db->order_by('name_districts', 'asc');
        //     $this->db->join($this->kota, ''.$this->kecamatan.'.regency_id = '.$this->kota.'.id');
        //     return $this->db->get($this->kecamatan)->result();
        // }


        // // untuk edit ambil dari id level paling bawah
        // public function get_selected_by_id_kecamatan($id_kecamatan)
        // {
        //     $this->db->where('id_kecamatan', $id_kecamatan);
        //     $this->db->join($this->kota, ''.$this->kecamatan.'.id = '.$this->kota.'.province_id');
        //     $this->db->join($this->provinsi, ''.$this->kota.'.id = '.$this->provinsi.'.regency_id');
        //     return $this->db->get($this->kecamatan)->row();
        // }

    }
