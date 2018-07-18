<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Dashboard extends MyController {

        public function __construct()
        {
            parent::__construct();

            // Module components            
            $this->data['module'] = 'Dashboard';
            $this->data['pluginCss'] = $this->load->view('assets/_pluginCss', $this->data, true);
            $this->data['pluginJs'] = $this->load->view('assets/_pluginJs', $this->data, true);
            // $this->output->enable_profiler(TRUE);
            $this->load->model('Users_agent_model');
            $this->load->helper('cookie');
            $this->load->library('user_agent');
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
            if($this->ion_auth->logged_in()) {
                $this->users_agent();
                // Page components
                $this->data['pageTitle'] = 'Dashboard';
                $this->data['pageJs'] = $this->load->view('assets/_pageJs', $this->data, true);
                $this->data['content'] = $this->load->view('dashboard', $this->data, true);

                // Render page
                $this->renderPage();

            } else {
                $this->load->view('layout/login');
            }
        }

        function users_agent(){
         // Check bila sebelumnya data pengunjung sudah terrekam
             if (!isset($_COOKIE['VISITOR'])) {
             
                 // Masa akan direkam kembali
                 // Tujuan untuk menghindari merekam pengunjung yang sama dihari yang sama.
                 // Cookie akan disimpan selama 24 jam
                 
                 $ip = $this->input->ip_address();
                 $user_agent = "VISITOR";

                 $cookie = array(
                    "name"   => $user_agent,
                    "value"  => $ip,
                    "expire" =>  time()+86500,
                    "secure" => false
                 );

                 $this->input->set_cookie($cookie);


                if ($this->agent->is_browser())
                {
                        $agent = $this->agent->browser().' '.$this->agent->version();
                }
                elseif ($this->agent->is_robot())
                {
                        $agent = $this->agent->robot();
                }
                elseif ($this->agent->is_mobile())
                {
                        $agent = $this->agent->mobile();
                }
                else
                {
                        $agent = 'Unidentified User Agent';
                }

                $data = array(
                'ip' => $ip,
                'user_id' => $this->currentUser->id,
                'perangkat' => $this->agent->platform(),
                'browser' => $agent,
                'pengunjung' => $user_agent,
                );

                $this->Users_agent_model->insert($data);
            }

        }
        
    }