<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Workarea extends AdminController {

        public function __construct()
        {
            parent::__construct();

            $this->tanggal = date("Y-m-d");
            $this->jam = date("H:i:s");

			$this->bulan = date('m');
			$this->tahun = date('Y');

            // Module components            
            $this->data['module'] = 'Working Area';
            $this->data['pluginCss'] = $this->load->view('assets/_pluginCss', $this->data, true);
            $this->data['pluginJs'] = $this->load->view('assets/_pluginJs', $this->data, true);
            
            $this->load->model('M_workarea');
            // $this->output->enable_profiler(TRUE);
            if($this->cekCurrentUser > 0) {
                $this->group = $this->ion_auth->get_users_groups( $this->currentUser->id)->result();
                $this->kode_cabang = $this->currentUser->kode_cabang;
                foreach ($this->group as $key => $value) {
                    $userGroup[$value->name] = $value->description;
                }

                $this->userLevel = $userGroup;
            }
        }

        public function index()
        {
            // Page components
            $this->data['userGroup'] = $this->userLevel;

            $this->data['pageTitle'] = 'Work Area';
            $this->data['pageCss'] = $this->load->view('assets/_pageCss', $this->data, true);;
            $this->data['pageJs'] = $this->load->view('assets/_pageJs', $this->data, true);
            $this->data['content'] = $this->load->view('main', $this->data, true);

            // Render page
            $this->renderPage();
        }

        public function load_data()
        {
            $kd_cabang = $this->input->post('kd_cabang',TRUE);
            $nm_cabang = $this->input->post('nm_cabang',TRUE);
            $alamat = $this->input->post('alamat',TRUE);
            $rekening = $this->input->post('rekening',TRUE);
            $no_telp = $this->input->post('no_telp',TRUE);
            $kota = $this->input->post('kota',TRUE);
            $prov = $this->input->post('prov',TRUE);
            $pimpinan = $this->input->post('pimpinan',TRUE);
            $no_hp_pimpinan = $this->input->post('no_hp_pimpinan',TRUE);
            $biaya_pesawat_kepusat = $this->input->post('biaya_pesawat_kepusat',TRUE);
            $nm_marketing = $this->input->post('nm_marketing',TRUE);
            $jenis_cabang = $this->input->post('jenis_cabang',TRUE);

			$cols = array();
			if (!empty($kd_cabang)) { $cols['kd_cabang'] = $kd_cabang; }
			if (!empty($nm_cabang)) { $cols['nm_cabang'] = $nm_cabang; }
            if (!empty($alamat)) { $cols['alamat'] = $alamat; }
			if (!empty($rekening)) { $cols['rekening'] = $rekening; }
			if (!empty($no_telp)) { $cols['no_telp'] = $no_telp; }
            if (!empty($kota)) { $cols['kota'] = $kota; }
            if (!empty($prov)) { $cols['prov'] = $prov; }
            if (!empty($pimpinan)) { $cols['pimpinan'] = $pimpinan; }
            if (!empty($no_hp_pimpinan)) { $cols['no_hp_pimpinan'] = $no_hp_pimpinan; }
            if (!empty($biaya_pesawat_kepusat)) { $cols['biaya_pesawat_kepusat'] = $biaya_pesawat_kepusat; }
            if (!empty($nm_marketing)) { $cols['nm_marketing'] = $nm_marketing; }
            if (!empty($jenis_cabang)) { $cols['jenis_cabang'] = $jenis_cabang; }

             if(array_key_exists('Super Admin', $this->userLevel)) {
             $where = "cabang.active = '1'";              
            } else {
             $where = "cabang.active = '1'";             
            }


	        $list = $this->M_workarea->get_datatables($where, $cols);
			$last_query = $this->db->last_query();
			// die(print_r($last_query));

            $iTotalRecords = $this->M_workarea->count_all($where);
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);
            
            $records = array();
            $records["data"] = array(); 

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;

            $no = $iDisplayStart;
            foreach ($list as $r) {
	            $no++;

                $btn_action = '<div class="btn-group btn-group-xs btn-group-solid">
                                <button type="button" class="btn btn-xs yellow btn-outline btn-edit tooltips" data-container="body" data-placement="top" data-original-title="Tooltip in top" data-id="'.$r->id.'"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-xs btn-outline red btn-update-status" data-id="'.$r->id.'" data-toggle="confirmation" data-placement="top" data-btn-ok-label="Yes" data-btn-ok-icon="icon-user-following" data-btn-ok-class="btn-success" data-btn-cancel-label="No" data-btn-cancel-icon="icon-user-unfollow" data-btn-cancel-class="btn-danger"><i class="fa fa-trash"></i></button>
                            </div>';

                $records["data"][] = array(
                    $no,                    
                    $btn_action,
                    $r->kd_cabang,
                    $r->nm_cabang,
                    $r->alamat,
                    $r->rekening,
                    $r->no_telp,
                    $r->name_regencies,
                    $r->name_provinces,
                    $r->pimpinan,
                    $r->no_hp_pimpinan,
                    // $r->biaya_pesawat_kepusat,
                    $r->nm_marketing,
                    $r->jenis_cabang,
                );

            }

            if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
                $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
            }

            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;
            
            echo json_encode($records);
        }

		public function load_detail()
		{

            $id = $this->input->get('id');

			$data['main'] = $this->M_workarea->get_where(array('id' => $id ))->row();

			return response($this->load->view('detail', $data, TRUE), 'html');
		}

		public function load_add_form()
		{
			$data['title'] = 'Tambah Data Work Area';
            // $data['marketing'] = Modules::run('marketing/get_marketing_where', array('active' => '1'))->result();
            $data = array(
            'provinsi' => Modules::run('master_indonesia/get_provinsi'),
            'kota' => Modules::run('master_indonesia/get_kota'),
            'provinsi_selected' => '',
            'kota_selected' => '',
            'marketing' => Modules::run('marketing/get_marketing_where', array('active' => '1'))->result(),
            );
			return response($this->load->view('add_workarea', $data, TRUE), 'html');
		}

		public function add()
	    {

            $this->ajaxRequest();
			$data = array(
				'kd_cabang' => $this->input->post('kd_cabang',TRUE),
                'nm_cabang' => $this->input->post('nm_cabang',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'rekening' => $this->input->post('rekening',TRUE),
                'no_telp' => $this->input->post('no_telp',TRUE),
                'kota' => $this->input->post('kota',TRUE),
                'prov' => $this->input->post('prov',TRUE),
                'pimpinan' => $this->input->post('pimpinan',TRUE),
                'no_hp_pimpinan' => $this->input->post('no_hp_pimpinan',TRUE),
                'biaya_pesawat_kepusat' => $this->input->post('biaya_pesawat_kepusat',TRUE),
                'referensi_cabang' => $this->input->post('referensi_cabang',TRUE),
                'jenis_cabang' => $this->input->post('jenis_cabang',TRUE),
                'active' => '1',
                'id_user' => $this->currentUser->id,
				);

			$query = $this->M_workarea->_insert($data);
            
            // Check if query was success
            if ($query) {
                $response = array('status' => true, 'action' => 'Success', 'message' => 'Data berhasil ditambahkan');
            } else {
                $response = array('status' => false, 'action' => 'Failed', 'message' => 'Data gagal ditambahkan');
            }
			
			return response($response, 'json');
	    }

        public function load_edit_form()
        {

            $id = $this->input->get('id');
            $data = array(
            'provinsi' => Modules::run('master_indonesia/get_provinsi'),
            'kota' => Modules::run('master_indonesia/get_kota'),
            'provinsi_selected' => '',
            'kota_selected' => '',
            'marketing' => Modules::run('marketing/get_marketing_where', array('active' => '1'))->result(),
            'main' => $this->M_workarea->get_where(array('id' => $id))->row(),
            );
            return response($this->load->view('edit_workarea', $data, TRUE), 'html');
        }

        public function edit()
        {
            // Check if ajax request
            $this->ajaxRequest();

            // Validate the submitted data
            // $this->validateInput();

            // Preparing the data before update
            $id    = $this->input->post('id');

            $data = array(
                'kd_cabang' => $this->input->post('kd_cabang',TRUE),
                'nm_cabang' => $this->input->post('nm_cabang',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'rekening' => $this->input->post('rekening',TRUE),
                'no_telp' => $this->input->post('no_telp',TRUE),
                'kota' => $this->input->post('kota',TRUE),
                'prov' => $this->input->post('prov',TRUE),
                'pimpinan' => $this->input->post('pimpinan',TRUE),
                'no_hp_pimpinan' => $this->input->post('no_hp_pimpinan',TRUE),
                'biaya_pesawat_kepusat' => $this->input->post('biaya_pesawat_kepusat',TRUE),
                'referensi_cabang' => $this->input->post('referensi_cabang',TRUE),
                'jenis_cabang' => $this->input->post('jenis_cabang',TRUE),                
            );

            $query = $this->M_workarea->_update(array('id' => $id), $data);

            // Check if query was success
            if ($query) {
                $results = array('status' => true, 'action' => 'Success', 'message' => 'updated successfully');
            } else {
                $results = array('status' => false, 'action' => 'Failed', 'message' => 'Failed to update');
            }

            // Return the result to the view
            return response($results);
        }


        public function delete()
        {
            $id = $this->input->post('id');
            $data = array(
                'active' => '0',
                );

            // die(print_r($data));
            $query = $this->M_workarea->_update(array('id' => $id), $data);

            // Check if query was success
            if ($query) {
                $results = array('status' => true, 'action' => 'Success', 'message' => 'berhasil');
            } else {
                $results = array('status' => false, 'action' => 'Failed', 'message' => 'Gagal');
            }

            // Return the result to the view
            return response($results, 'json');
        }

	    public function validateInput()
        {
            // Load form validation library
            $this->load->library('form_validation');

            // Set validation rules	
            $this->form_validation->set_rules('kd_cabang', 'kd cabang', 'trim|required');
            $this->form_validation->set_rules('nm_cabang', 'nm cabang', 'trim|required');
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
            $this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
            $this->form_validation->set_rules('kota', 'kota', 'trim|required');
            $this->form_validation->set_rules('prov', 'prov', 'trim|required');
            $this->form_validation->set_rules('pimpinan', 'pimpinan', 'trim|required');
            $this->form_validation->set_rules('no_hp_pimpinan', 'no hp pimpinan', 'trim|required');
            $this->form_validation->set_rules('biaya_pesawat_kepusat', 'biaya pesawat kepusat', 'trim|required');

            // Run the validation
            if ($this->form_validation->run() === false) {

                $response = array(
                    'status' => false,
                    'action' => 'Failed',
                    'message' => $this->form_validation->error_string('<h5>', '</h5>')
                );

                return response($response, 'json');

            }
        }

        public function get_workarea()
        {
            $query = $this->M_workarea->get()->result();
            return $query;

        }

    }
?>
