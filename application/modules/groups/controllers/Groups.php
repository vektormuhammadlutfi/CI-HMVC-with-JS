<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Groups extends AdminController {

        public function __construct()
        {
            parent::__construct();

            // Module components            
            $this->data['module'] = 'Groups';
            $this->data['pluginCss'] = $this->load->view('assets/_pluginCss', $this->data, true);
            $this->data['pluginJs'] = $this->load->view('assets/_pluginJs', $this->data, true);
            
            $this->load->model('m_groups');
        }

        public function index()
        {
            // Page components
            $this->data['pageTitle'] = 'Groups Management';
            $this->data['pageCss'] = '';
            $this->data['pageJs'] = $this->load->view('assets/_pageJs', $this->data, true);
            $this->data['content'] = $this->load->view('main', $this->data, true);

            // Render page
            $this->renderPage();
        }

        public function load_data()
        {

            $name = $this->input->post('group_name', true);
            $description = $this->input->post('description', true);

			$cols = array();
			if (!empty($name)) { $cols['name'] = $name; }
			if (!empty($description)) { $cols['description'] = $description; }

            $where = "id != 'null'";

	        $list = $this->m_groups->get_datatables($where, $cols);
			$last_query = $this->db->last_query();
			// die(print_r($last_query));

            $iTotalRecords = $this->m_groups->count_all($where);
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
                                <button type="button" class="btn btn-xs blue btn-outline btn-edit tooltips" data-container="body" data-placement="top" data-original-title="Tooltip in top" data-id="'.$r->id.'"><i class="fa fa-edit"></i> Edit</button>
                            </div>';

                $records["data"][] = array(
                    $no,
                    $r->name,
                    $r->description,
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
            // $this->ajaxRequest();

            // Return the result to the view
            return response($this->load->view('groupAdd', null, true), 'html');
        }

        public function loadEditForm()
        {   
            // Check if ajax request
            // $this->ajaxRequest();

            // Get group data
            $id = $this->input->get('id');
            $query = $this->m_groups->get_where(array('id' => $id));

            if ($query) {
                
                // Set group data
                $data['group'] = $query->row();

                // Return the result to the view
                return response($this->load->view('groupEdit', $data, true), 'html');
            }

            // Return 404 if data not found
            return show_404();
        }

        public function insert()
        {
            // Check if ajax request
            // $this->ajaxRequest();

            // Validate the submitted data
            $this->validateInput();

            // Preparing the data before insert to DB
			$data = array(
				'name' => $this->input->post('name', true),
				'description' => $this->input->post('description', true)
			);

            // Execute insert function from model
            $query = $this->m_groups->_insert($data);
            
            // Check if query was success
            if ($query) {
                $results = array('status' => true, 'action' => 'Success', 'message' => 'Group added successfully');
            } else {
                $results = array('status' => false, 'action' => 'Failed', 'message' => 'Failed to add Group');
            }

            // Return the result to the view
            return response($results);
        }

        public function update()
        {
            // Check if ajax request
            // $this->ajaxRequest();

            // Validate the submitted data
            $this->validateInput();

            // Preparing the data before update
			$id   = $this->input->post('id');
			$data = array(
				'name' => $this->input->post('name', true),
				'description' => $this->input->post('description', true)
			);
			
            // Execute update function from model
            $query = $this->m_groups->_update(array('id' => $id), $data);
            
            // Check if query was success
            if ($query) {
                $results = array('status' => true, 'action' => 'Success', 'message' => 'Group updated successfully');
            } else {
                $results = array('status' => false, 'action' => 'Failed', 'message' => 'Failed to update Group');
            }

            // Return the result to the view
            return response($results);
        }

        public function delete()
        {
            // Check if ajax request
            // $this->ajaxRequest();

            // Preparing the data before delete
            $id = (int)$this->input->post('id');

            // Execute getGrid function from model
            $query = $this->m_groups->delete($id);
            
            // Check if query was success
            if ($query) {
                $results = array('status' => true, 'action' => 'Success', 'message' => 'Group has been deleted!');
            } else {
                $results = array('status' => false, 'action' => 'Failed', 'message' => 'Failed to delete Group');
            }

            // Return the result to the view
            return response($results);
        }

        public function validateInput()
        {
            // Load form validation library
            $this->load->library('form_validation');

            // Set validation rules
            if (!$this->input->post('id')) {
                $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[groups.name]');
            }
            $this->form_validation->set_rules('description', 'Description', 'trim|required');

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

        public function get($orderBy = 'id')
        {
            $query = $this->m_groups->get($orderBy);
            return $query;
        }

    }
?>
