<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Users extends AdminController {

        public function __construct()
        {
            parent::__construct();

            if($this->ion_auth->logged_in()){
                $this->group = $this->ion_auth->get_users_groups($this->currentUser->id)->result();
            
                foreach ($this->group as $key => $value) {

                    $userGroup[$value->name] = $value->description;

                }

                $this->userGroup = $userGroup;

            }

            // Module components            
            $this->data['module'] = 'Users';
            $this->data['pluginCss'] = $this->load->view('assets/_pluginCss', $this->data, true);
            $this->data['pluginJs'] = $this->load->view('assets/_pluginJs', $this->data, true);
            
            $this->load->model('m_users');
            $this->load->model('M_office');
        }

        public function index()
        {
            // Page components
            $this->data['pageTitle'] = 'Users';
            $this->data['pageCss'] = $this->load->view('assets/_pageCss', $this->data, true);;
            $this->data['pageJs'] = $this->load->view('assets/_pageJs', $this->data, true);
            $this->data['content'] = $this->load->view('users', $this->data, true);

            // Render page
            $this->renderPage();
        }

        public function load_data()
        {

            $last_login_from = $this->input->post('last_login_from');
            $last_login_to = $this->input->post('last_login_to');
            $full_name = $this->input->post('full_name');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $status = $this->input->post('status');

			$cols = array();
            if (!empty($username)) { $cols['username'] = $username; }
            if (!empty($email)) { $cols['email'] = $email; }
            if (!empty($phone)) { $cols['phone'] = $phone; }
			if (!empty($status)) { $cols['active'] = $status; }

            $where = "active = '1' or active = '0'";


			if(!empty($last_login_from) && !empty($last_login_to)) {
                $where .= " AND (last_login BETWEEN '".$last_login_from."' AND '".$last_login_to."')";
			}
			if(!empty($full_name)) {
                $where .= " AND (first_name LIKE '%".$full_name."%' OR last_name LIKE '%".$full_name."%')";
			}

	        $list = $this->m_users->get_datatables($where, $cols);
			$last_query = $this->db->last_query();
			// die(print_r($last_query));

            $iTotalRecords = $this->m_users->count_all($where);
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

                $btn_action = '<div class="btn-group btn-group-xs btn-group-solid">';
                //kondisi
				
                if($r->active == '1')
                {
                    $active = 'aktif';
                    $label = 'success';
                }else{
                    $active = 'nonaktif';
                    $label = 'danger';
                }

                if(array_key_exists('Super Admin', $this->userGroup) && $r->username != 'administrator'){
                    $btn_action .='<button type="button" class="btn btn-xs yellow btn-outline btn-edit tooltips" data-container="body" data-placement="top" data-id="'.$r->id.'"><i class="fa fa-edit"></i> Edit</button>
                    <button class="btn btn-xs btn-outline red btn-update-status" data-id="'.$r->id.'" data-toggle="confirmation" data-placement="top" data-btn-ok-label="Aktif" data-btn-ok-icon="icon-check" data-btn-ok-class="btn-success" data-btn-cancel-label="Blokir" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"><i class="fa fa-edit"></i> Status</button>';
                }

                $btn_action .= '</div>';

	            $last_login = date("Y-m-d H:i:s", $r->last_login);

                //draw to table
                $records["data"][] = array(
                    $no,
                    $r->first_name.' '.$r->last_name,
                    $r->username,
                    $r->email,
                    $r->phone,
                    $last_login,
                    '<span class="label label-sm label-'.$label.'">'.$active.'</span>',
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

        public function loadAddForm()
        {   
            // Check if ajax request
            $this->ajaxRequest();

            // Get group data
            $data['groups'] = Modules::run('groups/get')->result();
            $data['office'] = $this->M_office->get()->result();

            // Return the result to the view
            return response($this->load->view('userAdd', $data, true), 'html');
        }

        public function loadEditForm()
        {   
            // Check if ajax request
            $this->ajaxRequest();

            // Get user data
            $id = $this->input->get('id');
            $query = $this->ion_auth->user((int)$id)->row();

            if ($query) {
                
                // Set user data
                $data['user'] = $query;
                $data['groups'] = Modules::run('groups/get')->result();
                $data['userGroup'] = $this->ion_auth->get_users_groups($id)->row();
                $data['office'] = $this->M_office->get()->result();
                // die(print_r($this->db->last_query()));
                // die(print_r($data['userGroup']));

                // Return the result to the view
                return response($this->load->view('userEdit', $data, true), 'html');
            }

            // Return 404 if data not found
            return show_404();
        }

        public function insert()
        {
            // Check if ajax request
            $this->ajaxRequest();

            // Validate the submitted data
            $this->validateInput();

            // Preparing the data before insert to DB
            $username = $this->input->post('username');
            $email    = $this->input->post('email');
            $password = $this->input->post('password');
            $level    = array($this->input->post('level'));

            $userData = array(
                'username'   => $username,
                'first_name' => ucwords($this->input->post('first_name')),
                'last_name'  => ucwords($this->input->post('last_name')),
                'phone'      => $this->input->post('phone'),
                'kode_cabang' => strtoupper($this->input->post('kode_cabang'))
            );

            // Execute ion-auth register
            $query = $this->ion_auth->register($username, $password, $email, $userData, $level);
            
            // Check if query was success
            if ($query) {
                $results = array('status' => true, 'action' => 'Success', 'message' => 'Account successfully created');
            } else {
                $results = array('status' => false, 'action' => 'Failed', 'message' => 'Failed to add User');
            }

            // Return the result to the view
            return response($results);
        }

        public function update()
        {
            // Check if ajax request
            $this->ajaxRequest();

            // Validate the submitted data
            $this->validateInput();

            // Preparing the data before update
			$id    = $this->input->post('id');
            // $level = array($this->input->post('level'));


            $userData = array(
                'first_name' => ucwords($this->input->post('first_name')),
                'last_name'  => ucwords($this->input->post('last_name')),
                'phone'      => $this->input->post('phone'),
                'password'   => $this->input->post('password'),
                'kode_cabang' => strtoupper($this->input->post('kode_cabang'))
            );

            // Execute ion-auth update function
            
            // Update the groups user belongs to
            $level = $this->input->post('level');

            if (isset($level) && !empty($level)) {

                $this->ion_auth->remove_from_group('', $id);

                foreach ($level as $grp) {
                    $this->ion_auth->add_to_group($grp, $id);
                }

            }

            // $this->ion_auth->remove_from_group('', $id);       
            // $this->ion_auth->add_to_group($level, $id);
            $query = $this->ion_auth->update($id, $userData);

            // Check if query was success
            if ($query) {
                $results = array('status' => true, 'action' => 'Success', 'message' => 'User updated successfully');
            } else {
                $results = array('status' => false, 'action' => 'Failed', 'message' => 'Failed to update User');
            }

            // Return the result to the view
            return response($results);
        }

        public function delete()
        {
            // Check if ajax request
            $this->ajaxRequest();

            // Preparing the data before delete
            $id = (int)$this->input->post('id');

            // Execute getGrid function from model
            $query = $this->ion_auth->delete_user($id);
            
            // Check if query was success
            if ($query) {
                $results = array('status' => true, 'action' => 'Success', 'message' => 'User has been deleted!');
            } else {
                $results = array('status' => false, 'action' => 'Failed', 'message' => 'Failed to delete User');
            }

            // Return the result to the view
            return response($results);
        }

        public function update_status()
        {

            $id = $this->input->post('id');
            $action = $this->input->post('action');

            if($action == '1') {
                $active = '1';
            } else { 
                $active = '0';
            }

            $data = array(
                'active' => $active,
            );

            $query = $this->m_users->_update(array('id' => $id), $data);    
            
            // Check if query was success
            if ($query) {
                $results = array('status' => true, 'action' => 'Success', 'message' => 'Status Users berhasil diupdate');
            } else {
                $results = array('status' => false, 'action' => 'Failed', 'message' => 'Status Users gagal diupdate');
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
                $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            }

            $this->form_validation->set_rules('first_name', 'First name', 'trim|required');
            $this->form_validation->set_rules('last_name', 'Last name', 'trim');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[2]');
            $this->form_validation->set_rules('password_confirm', 'Password confirmation','required|matches[password]');

            // Run the validation
            if ($this->form_validation->run() === false) {

                $response = array(
                    'status' => false,
                    'action' => 'Failed',
                    'message' => $this->form_validation->error_string('<h5>', '</h5>')
                );

                return response($response);

            }
        }

        
    }
?>
