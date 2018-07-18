<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class MyController extends MX_Controller {

		public $data = array();
		public $currentUser = array();

		public function __construct()
		{
			parent::__construct();
			$this->data['module'] = '';
            $this->data['pluginCss'] = '';
            $this->data['pluginJs'] = '';
            $this->data['pageTitle'] = '';
            $this->data['pageCss'] = '';
            $this->data['pageJs'] = '';
            $this->data['content'] = '';
            $this->currentUser = $this->ion_auth->user()->row();
            $this->cekCurrentUser = $this->ion_auth->user()->num_rows();
			if($this->cekCurrentUser > 0) {
				$this->group = $this->ion_auth->get_users_groups( $this->currentUser->id)->result();
				foreach ($this->group as $key => $value) {
					$userGroup[$value->name] = $value->description;
				}

				$this->userLevel = $userGroup;
			}
		}

		public function renderPage()
		{
			if (!$this->ion_auth->logged_in()) {
				
				$this->load->view('layout/login');

			} else {
				
				$this->currentUser = $this->ion_auth->user()->row();
				$this->cekCurrentUser = $this->ion_auth->user()->num_rows();
				$this->currentUser->fullName = $this->currentUser->first_name . ' ' . $this->currentUser->last_name;
				$this->kode_cabang = $this->currentUser->kode_cabang;
				$this->first_name = $this->currentUser->first_name;
    			// new 
	            foreach ($this->group as $key => $value) {
	                $userGroup[$value->name] = $value->description;
	            }
	            $this->userGroup = $userGroup;
	            
				$this->load->view('layout/layout', $this->data);
			}

		}

		public function ajaxRequest()
		{
			if (!$this->input->is_ajax_request()) {
				show_404();
			}
		}
	}

	class AdminController extends MyController {

		public function __construct()
		{
			parent::__construct();
		}

	}
