<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Customer extends AdminController {

        public function __construct()
        {
            parent::__construct();
            $this->tanggal = date("Y-m-d");
            $this->jam = date("H:i:s");

			$this->bulan = date('m');
			$this->tahun = date('Y');

            // Module components            
            $this->data['module'] = 'Customer';
            $this->data['pluginCss'] = $this->load->view('assets/_pluginCss', $this->data, true);
            $this->data['pluginJs'] = $this->load->view('assets/_pluginJs', $this->data, true);
            
            $this->load->model('m_customer');
        }

        public function index()
        {
            // Page components
            $this->data['userGroup'] = $this->userLevel;

            $this->data['pageTitle'] = 'Customer';
            $this->data['pageCss'] = $this->load->view('assets/_pageCss', $this->data, true);;
            $this->data['pageJs'] = $this->load->view('assets/_pageJs', $this->data, true);
            $this->data['content'] = $this->load->view('main', $this->data, true);

            // Render page
            $this->renderPage();
        }

        public function load_data()
        {
            $nm_customer = $this->input->post('nm_customer', true);
            $alamat = $this->input->post('alamat', true);
            $jenis_customer = $this->input->post('jenis_customer', true);
            $ktp = $this->input->post('ktp', true);
            $npwp = $this->input->post('npwp', true);
            $no_telp = $this->input->post('no_telp', true);
            $email = $this->input->post('email', true);

			$cols = array();
			if (!empty($nm_customer)) { $cols['nm_customer'] = $nm_customer; }
			if (!empty($no_telp)) { $cols['no_telp'] = $no_telp; }
			if (!empty($jenis_customer)) { $cols['jenis_customer'] = $jenis_customer; }
			if (!empty($ktp)) { $cols['ktp'] = $ktp; }

            if(array_key_exists('admin', $this->userLevel)) {
             $where = "active = '1'";
            }

            if(array_key_exists('koor', $this->userLevel)) {
             $where = "active = '1' AND kode_cabang = '$this->kode_cabang'";
            }

            if(array_key_exists('dispatcher', $this->userLevel)) {
             $where = "active = '1' AND kode_cabang = '$this->kode_cabang'";
            }

             if(array_key_exists('kasir', $this->userLevel)) {
             $where = "active = '1' AND kode_cabang = '$this->kode_cabang'";
            }
            
            if(array_key_exists('marketing', $this->userLevel)) {
             $where = "active = '1' AND kode_cabang = '$this->kode_cabang'";
            }


	        $list = $this->m_customer->get_datatables($where, $cols);
			$last_query = $this->db->last_query();
			// die(print_r($last_query));

            $iTotalRecords = $this->m_customer->count_all($where);
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
                                <button type="button" class="btn btn-xs yellow btn-outline btn-edit tooltips" data-container="body" data-placement="top" data-original-title="Tooltip in top" data-id="'.$r->id_customer.'"><i class="fa fa-edit"></i> Edit</button>
                                <button class="btn btn-xs btn-outline red btn-update-status" data-id="'.$r->id_customer.'" data-toggle="confirmation" data-placement="top" data-btn-ok-label="Ready" data-btn-ok-icon="icon-user-following" data-btn-ok-class="btn-success" data-btn-cancel-label="Absen" data-btn-cancel-icon="icon-user-unfollow" data-btn-cancel-class="btn-danger"><i class="fa fa-trash"></i> Nonaktifkan</button>
                            </div>';

                $records["data"][] = array(
                    $no,
                    $r->nm_customer,
                    $r->alamat,
                    $r->jenis_customer,
                    $r->ktp,
                    $r->npwp,
                    $r->no_telp,
                    $r->email,
                    $btn_action,
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

			$data['main'] = $this->m_customer->get_where(array('id' => $id ))->row();

			return response($this->load->view('detail', $data, TRUE), 'html');
		}

		public function load_add_form()
		{
			$data['title'] = 'Tambah Data Customer';
			return response($this->load->view('add_customer', $data, TRUE), 'html');
		}

		public function add()
	    {

			$this->validateInput();

			$data = array(
				'nm_customer' => $this->input->post('nm_customer', true),
	            'alamat' => $this->input->post('alamat', true),
	            'jenis_customer' => $this->input->post('jenis_customer', true),
	            'ktp' => $this->input->post('ktp', true),
	            'npwp' => $this->input->post('npwp', true),
	            'no_telp' => $this->input->post('no_telp', true),
	            'email' => $this->input->post('email', true),
	            'active' => '1',
                'kode_cabang' => $this->kode_cabang,
				);

			$query = $this->m_customer->_insert($data);
            
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
            $data['main'] = $this->m_customer->get_where(array('id_customer' => $id))->row();
            return response($this->load->view('edit_customer', $data, TRUE), 'html');
        }

	    public function validateInput()
        {
            // Load form validation library
            $this->load->library('form_validation');

            // Set validation rules	
            $this->form_validation->set_rules('nm_customer', 'Nama Customer', 'trim|required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
            $this->form_validation->set_rules('jenis_customer', 'jenis_customer', 'trim|required');
            $this->form_validation->set_rules('ktp', 'ktp', 'trim|required');
            $this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
            $this->form_validation->set_rules('no_telp', 'no_telp', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');

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

    }
?>
