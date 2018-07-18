<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Auth extends MX_Controller {

    	public function __construct() {
            parent::__construct();
        }

        public function index()
        {
            redirect('/');
        }

        public function login()
        {
            $this->form_validation->set_rules('identity', 'Identity', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('remember', 'Remember me', 'integer');
            
            if ($this->form_validation->run() === TRUE) {

                $identity = $this->input->post('identity');
                $password = $this->input->post('password');
                $remember = $this->input->post('remember');
                
                if ($this->ion_auth->login($identity, $password, $remember)) {

                    return response(array('status' => true));

                } else {

                    return response(array('status' => false));

                }
            
            } else {

                return response(array('status' => false));

            }
                
            
        }

        public function logout()
        {
            $this->ion_auth->logout();
            redirect('/');
        }
    
    }