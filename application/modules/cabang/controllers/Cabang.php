<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Cabang extends AdminController {

        public function __construct()
        {
            parent::__construct();

            $this->userId = $this->currentUser->id;
			$this->nama = $this->currentUser->first_name.' '.$this->currentUser->last_name;
            $this->kdoffice = $this->currentUser->kode_cabang;
            
            $this->group = $this->ion_auth->get_users_groups($this->currentUser->id)->result();

            foreach ($this->group as $key => $value) {
                $userGroup[$value->name] = $value->description;
            }

            $this->userGroup = $userGroup;

            $this->tanggal = date("Y-m-d");
            $this->jam = date("H:i:s");

			$this->bulan = date('m');
			$this->tahun = date('Y');

            // Module components            
            $this->data['module'] = 'Branch Office';
            $this->data['pluginCss'] = $this->load->view('assets/_pluginCss', $this->data, true);
            $this->data['pluginJs'] = $this->load->view('assets/_pluginJs', $this->data, true);
            
            $this->load->model('m_cabang');
        }

        public function index()
        {
            // Page components
            // $this->data['userGroup'] = $this->userGroup;
            $this->data['pageTitle'] = 'Branch';
            $this->data['pageCss'] = $this->load->view('assets/_pageCss', $this->data, true);;
            $this->data['pageJs'] = $this->load->view('assets/_pageJs', $this->data, true);
            $this->data['content'] = $this->load->view('main', $this->data, true);

            // Render page
            $this->renderPage();
        }

        public function load_data()
        {
            $nama_cabang = $this->input->post('nama_cabang', true);
            $alamat = $this->input->post('alamat', true);
            $email = $this->input->post('email', true);

			$cols = array();
			if (!empty($nama_cabang)) { $cols['nama_cabang'] = $nama_cabang; }
            if (!empty($alamat)) { $cols['email_cabang'] = $alamat; }
            if (!empty($email)) { $cols['alamat_cabang'] = $email; }

            if(array_key_exists('admin', $this->userGroup)) {
             $where = "is_aktif = '1'";
            }

	        $list = $this->m_cabang->get_datatables($where, $cols);
			$last_query = $this->db->last_query();
			// die(print_r($last_query));

            $iTotalRecords = $this->m_cabang->count_all($where);
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
                                    <button type="button" class="btn btn-xs yellow btn-outline btn-edit tooltips" data-container="body" data-placement="top" data-original-title="Tooltip in top" data-id="'.$r->id_cabang  .'"><i class="fa fa-edit"></i> Edit</button>
                                </div>';

                    $records["data"][] = array(
                        $no,
                        $r->nama_cabang,
                        $r->alamat_cabang,
                        $r->email_cabang,
                        $r->telepon_cabang,
                        $r->fax_cabang,
                        $r->nama_pic,
                        $r->adh,
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

			$data['main'] = $this->m_cabang->get_where(array('id' => $id ))->row();

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
                'kode_cabang' => $this->kdoffice,
				);

			$query = $this->m_cabang->_insert($data);
            
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
            $data['main'] = $this->m_cabang->get_where(array('id_cabang' => $id))->row();
            return response($this->load->view('edit_cabang', $data, TRUE), 'html');
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
