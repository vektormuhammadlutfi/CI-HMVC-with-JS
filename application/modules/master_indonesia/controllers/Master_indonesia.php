<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Master_indonesia extends AdminController {

        public function __construct()
        {
            parent::__construct();
            $this->tanggal = date("Y-m-d");
            $this->jam = date("H:i:s");

            $this->bulan = date('m');
            $this->tahun = date('Y');

            // Module components            
            $this->data['module'] = 'master indonesia';
            $this->data['pluginCss'] = $this->load->view('assets/_pluginCss', $this->data, true);
            $this->data['pluginJs'] = $this->load->view('assets/_pluginJs', $this->data, true);
            
            $this->load->model('M_indonesia');
            // $this->output->enable_profiler(TRUE);
        }

    // untuk add
    public function index()
    {
        $this->data = array(
            'provinsi' => $this->M_indonesia->get_provinsi(),
            'kota' => $this->M_indonesia->get_kota(),
            'provinsi_selected' => '',
            'kota_selected' => '',
        );

        // Page components
        $this->data['userGroup'] = $this->userLevel;

        $this->data['pageTitle'] = 'Hotel';
        $this->data['pageCss'] = $this->load->view('assets/_pageCss', $this->data, true);;
        $this->data['pageJs'] = $this->load->view('assets/_pageJs', $this->data, true);
        $this->data['content'] = $this->load->view('main', $this->data, true);

        // Render page
        $this->renderPage();
    }

    public function get_provinsi() 
    {
        $query = $this->M_indonesia->get_provinsi();
        return $query;
    }

    public function get_kota() 
    {
        $query = $this->M_indonesia->get_kota();
        return $query;
    }

    public function get_provinsi_where($where) {
            
        $query = $this->M_indonesia->get_provinsi_where($where);
        return $query;
    }

    public function get_kota_where($where) {
            
        $query = $this->M_indonesia->get_kota_where($where);
        return $query;
    }

    // untuk edit 
    public function edit()
    {
        // realnya ambil data dari database, misalnya kita dapatkan data sbb:
        $id_kecamatan = 4;
        // kita ambil data selected nya untuk selected option
        $selected = $this->M_indonesia->get_selected_by_id_kecamatan($id_kecamatan);
        
        $this->data = array(
            'provinsi' => $this->M_indonesia->get_provinsi(),
            'kota' => $this->M_indonesia->get_kota(),
            'provinsi_selected' => $selected->id_provinsi,
            'kota_selected' => $selected->id_kota,
        );
        // Page components
        $this->data['userGroup'] = $this->userLevel;

        $this->data['pageTitle'] = 'Hotel';
        $this->data['pageCss'] = $this->load->view('assets/_pageCss', $this->data, true);;
        $this->data['pageJs'] = $this->load->view('assets/_pageJs', $this->data, true);
        $this->data['content'] = $this->load->view('main', $this->data, true);

        // Render page
        $this->renderPage();
    }
    
    public function aksi_form()
    {
        // datanya bisa kita insert ke DB atau yang lain
        // di sini saya hanya menampilkan datanya saja
        var_dump($this->input->post());
    }
}