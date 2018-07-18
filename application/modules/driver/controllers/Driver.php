<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Driver extends AdminController {

        public function __construct()
        {
            parent::__construct();

            $this->group = $this->ion_auth->get_users_groups($this->currentUser->id)->result();
            $this->kode_cabang = $this->currentUser->kode_cabang;
            foreach ($this->group as $key => $value) {

                $userGroup[$value->name] = $value->description;

            }

            $this->userGroup = $userGroup;

            $this->tanggal = date("Y-m-d");
            $this->jam = date("H:i:s");

			$this->bulan = date('m');
			$this->tahun = date('Y');

            // Module components            
            $this->data['module'] = 'Driver Management';
            $this->data['pluginCss'] = $this->load->view('assets/_pluginCss', $this->data, true);
            $this->data['pluginJs'] = $this->load->view('assets/_pluginJs', $this->data, true);
            
            $this->load->model('m_driver');
        }

        public function index()
        {
            // Page components
            $this->data['userGroup'] = $this->userGroup;

            $this->data['pageTitle'] = 'Driver Management';
            $this->data['pageCss'] = $this->load->view('assets/_pageCss', $this->data, true);;
            $this->data['pageJs'] = $this->load->view('assets/_pageJs', $this->data, true);
            $this->data['content'] = $this->load->view('main', $this->data, true);

            $this->data['mstatus'] = Modules::run('driver_mstatus/get', 'id')->result();
            // Render page
            $this->renderPage();
        }

        public function load_data()
        {

            $nama = $this->input->post('nama', true);
            $jenis_sim = $this->input->post('jenis_sim', true);
            $tgl_start = $this->input->post('tgl_start', true);
            $tgl_end = $this->input->post('tgl_end', true);
            $tgl_exp_from = $this->input->post('tgl_exp_from', true);
            $tgl_exp_to = $this->input->post('tgl_exp_to', true);
            $hp = $this->input->post('telepon', true);
            $absensi_id = $this->input->post('status', true);
            $jenis_driver = $this->input->post('jenis_driver', true);

			$cols = array();
			if (!empty($nama)) { $cols['nama'] = $nama; }
			if (!empty($hp)) { $cols['hp'] = $hp; }
			if (!empty($jenis_sim)) { $cols['jenis'] = $jenis_sim; }
            if (!empty($absensi_id)) { $cols['absensi_id'] = $absensi_id; }
            if (!empty($jenis_driver)) { $cols['jenis_driver'] = $jenis_driver; }

            if(array_key_exists('admin', $this->userGroup)) {
             $where = "active <> '3'";
            }

            if(array_key_exists('koor', $this->userGroup)) {
             $where = "active = '1' AND kode_cabang = '$this->kode_cabang'";
            }

            if(array_key_exists('dispatcher', $this->userGroup)) {
             $where = "active = '1' AND kode_cabang = '$this->kode_cabang'";
            }

             if(array_key_exists('kasir', $this->userGroup)) {
             $where = "active = '1' AND kode_cabang = '$this->kode_cabang'";
            }
            
            if(array_key_exists('marketing', $this->userGroup)) {
             $where = "active = '1' AND kode_cabang = '$this->kode_cabang'";
            }


            $where = "active = '1'";

			if(!empty($tgl_start) && !empty($tgl_end)) {
				$where .= " AND (tgl_lahir BETWEEN '".$tgl_start."' AND '".$tgl_end."')";
			}

			if(!empty($tgl_exp_from) && !empty($tgl_exp_to)) {
				$where .= " AND (tgl_exp_sim BETWEEN '".$tgl_exp_from."' AND '".$tgl_exp_to."')";
			}

	        $list = $this->m_driver->get_datatables($where, $cols);
			$last_query = $this->db->last_query();
			// die(print_r($last_query));

            $iTotalRecords = $this->m_driver->count_all($where);
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
                
                if ($r->active =='1'){
                    $aktif='<span class="label label-sm label-primary">AKTIF</span>';
                }else{
                    $aktif='<span class="label label-sm label-danger">Non AKTIF</span>';
                }

                $btn_action = '<div class="btn-group btn-group-xs btn-group-solid">
                                <button type="button" class="btn btn-xs blue btn-outline btn-detail tooltips" data-container="body" data-placement="top" data-original-title="Tooltip in top" data-id="'.$r->id.'"><i class="fa fa-search"></i> Detail</button>
                                <button type="button" class="btn btn-xs yellow btn-outline btn-edit tooltips" data-container="body" data-placement="top" data-original-title="Tooltip in top" data-id="'.$r->id.'"><i class="fa fa-search"></i> Edit</button>
                                <button class="btn btn-xs btn-outline red btn-update-status" data-id="'.$r->id.'" data-toggle="confirmation" data-placement="left" data-btn-ok-label="Aktif" data-btn-ok-icon="icon-user-following" data-btn-ok-class="btn-success" data-btn-cancel-label="NonAktif" data-btn-cancel-icon="icon-user-unfollow" data-btn-cancel-class="btn-danger"><i class="fa fa-edit"></i> Status</button>
                            </div>';

                $records["data"][] = array(
                    $no,
                    tgl_indo($r->tgl_lahir),
                    $r->nama,
                    $r->jenis,
                    tgl_indo($r->tgl_exp_sim),
                    $r->hp,
                    $r->jenis_driver,
                    '<span class="label label-sm label-'.$r->absensi_label.'">'.$r->absensi_status.'</span>',
                    $aktif,
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

			$data['main'] = $this->m_driver->get_where(array('id' => $id ))->row();

			return response($this->load->view('detail', $data, TRUE), 'html');
		}

		public function load_add_form()
		{
            $data['midentitas'] = Modules::run('midentitas/get', 'id')->result();
            $data['magama'] = Modules::run('magama/get', 'id')->result();
            $data['msim'] = Modules::run('msim/get', 'id')->result();

			return response($this->load->view('fadd', $data, TRUE), 'html');
		}

	    public function add()
	    {

			$this->validateInput();

			$gapok = preg_replace("/[^0-9\.]/", "",$this->input->post('gapok'));

			$data = array(
				'pooling_id' => '1',
                'nama' => $this->input->post('nama', true),
                'jenis_driver' => $this->input->post('jenis_driver', true),
				'identitas_id' => $this->input->post('identitas_id', true),
				'no_identitas' => $this->input->post('no_identitas', true),
				'sim_id' => $this->input->post('sim_id', true),
				'no_sim' => $this->input->post('no_sim', true),
				'tgl_exp_sim' => $this->input->post('tgl_exp_sim', true),
				'agama_id' => $this->input->post('agama_id', true),
				'email' => $this->input->post('email', true),
				'alamat' => $this->input->post('alamat', true),
				'tmp_lahir' => $this->input->post('tmp_lahir', true),
				'tgl_lahir' => $this->input->post('tgl_lahir', true),
				'telepon' => $this->input->post('telepon', true),
				'hp' => $this->input->post('hp', true),
				'gapok' => $gapok,
				'no_rekening' => $this->input->post('no_rekening', true),
				'absensi_status' => 'ready',
				'absensi_label' => 'info',
				'absensi_date' => $this->tanggal,
				'no_rekening' => $this->input->post('no_rekening', true),
				'foto' => 'noavatar.png',
                'kode_cabang' => $this->kode_cabang,
				);

			$query = $this->m_driver->_insert($data);
            
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
            $data['main'] = $this->m_driver->get_where(array('id' => $id))->row();

            $data['midentitas'] = Modules::run('midentitas/get', 'id')->result();
            $data['magama'] = Modules::run('magama/get', 'id')->result();
            $data['msim'] = Modules::run('msim/get', 'id')->result();

			return response($this->load->view('fedit', $data, TRUE), 'html');
		}

	    public function edit()
	    {

			$this->validateInput();

			$id = $this->input->post('id', true);

			$gapok = preg_replace("/[^0-9\.]/", "",$this->input->post('gapok', true));

			$data = array(
                'nama' => $this->input->post('nama', true),
                'jenis_driver'=> $this->input->post('jenis_driver', true),
				'identitas_id' => $this->input->post('identitas_id', true),
				'no_identitas' => $this->input->post('no_identitas', true),
				'sim_id' => $this->input->post('sim_id', true),
				'no_sim' => $this->input->post('no_sim', true),
				'tgl_exp_sim' => $this->input->post('tgl_exp_sim', true),
				'agama_id' => $this->input->post('agama_id', true),
				'email' => $this->input->post('email', true),
				'alamat' => $this->input->post('alamat', true),
				'tmp_lahir' => $this->input->post('tmp_lahir', true),
				'tgl_lahir' => $this->input->post('tgl_lahir', true),
				'telepon' => $this->input->post('telepon', true),
				'hp' => $this->input->post('hp', true),
				'gapok' => $gapok,
				'no_rekening' => $this->input->post('no_rekening', true)
				);

			$query = $this->m_driver->_update(array('id' => $id), $data);
            
            // Check if query was success
            if ($query) {
                $response = array('status' => true, 'action' => 'Success', 'message' => 'Data berhasil diupdate');
            } else {
                $response = array('status' => false, 'action' => 'Failed', 'message' => 'Data gagal diupdate');
            }
			
			return response($response, 'json');
	    }

		public function update_status()
		{

            $id = $this->input->post('id');
            $action = $this->input->post('action');

            if($action == '1') {
                $aktif = '1';
            } else { 
                $aktif = '0';
            }

			$data = array(
                'active' => $aktif,
            );

            $query = $this->m_driver->_update(array('id' => $id), $data);	
            
            // Check if query was success
            if ($query) {
                $results = array('status' => true, 'action' => 'Success', 'message' => 'Status Data Driver berhasil diupdate');
            } else {
                $results = array('status' => false, 'action' => 'Failed', 'message' => 'Status Data Driver gagal diupdate');
            }

            // Return the result to the view
            return response($results, 'json');

		}

        public function validateInput()
        {
            // Load form validation library
            $this->load->library('form_validation');

            // Set validation rules
            if (!$this->input->post('id')) {
                $this->form_validation->set_rules('no_identitas', 'No. Identitas', 'trim|required|is_unique[uti_drivers.no_identitas]');
                $this->form_validation->set_rules('no_sim', 'No. SIM', 'trim|required|is_unique[uti_drivers.no_sim]');
            }
			
            $this->form_validation->set_rules('identitas_id', 'Jenis Identitas', 'trim|required');
            $this->form_validation->set_rules('jenis_driver', 'Jenis Driver', 'trim|required');
            $this->form_validation->set_rules('no_identitas', 'No. Identitas', 'trim|required');
            $this->form_validation->set_rules('nama', 'Nama Driver', 'trim|required');
            $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'trim|required');
            $this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
            $this->form_validation->set_rules('hp', 'No. HP', 'trim|required|numeric');
            $this->form_validation->set_rules('agama_id', 'Agama', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('hp', 'No. HP', 'trim|required');
            $this->form_validation->set_rules('sim_id', 'Jenis SIM', 'trim|required');
            $this->form_validation->set_rules('no_sim', 'No. SIM', 'trim|required');
            $this->form_validation->set_rules('tgl_exp_sim', 'Tgl. Exp SIM', 'trim|required');
            $this->form_validation->set_rules('no_rekening', 'No. Rekening DPLK', 'trim|required');

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

        public function get($order_by) {
            $query = $this->m_driver->get($order_by);
            return $query;
        }

        public function get_where($where) {
            $query = $this->m_driver->get_where($where);
            return $query;
        }
    }
?>
