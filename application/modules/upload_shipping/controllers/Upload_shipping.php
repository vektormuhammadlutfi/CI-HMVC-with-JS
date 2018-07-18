<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Upload_shipping extends AdminController {
        public function __construct()
        {
            parent::__construct();

            

            if($this->cekCurrentUser > 0) {
                $this->group = $this->ion_auth->get_users_groups( $this->currentUser->id)->result();
                $this->kode_cabang = $this->currentUser->kode_cabang;
                foreach ($this->group as $key => $value) {
                    $userGroup[$value->name] = $value->description;
                }

                $this->userGroup = $userGroup;
            }

            $this->tanggal = date("Y-m-d");
            $this->jam = date("H:i:s");

			$this->bulan = date('m');
			$this->tahun = date('Y');

            // Module components            
            $this->data['module'] = 'Import Data Shipping';
            $this->data['pluginCss'] = $this->load->view('assets/_pluginCss', $this->data, true);
            $this->data['pluginJs'] = $this->load->view('assets/_pluginJs', $this->data, true);
            
            $this->load->model('m_upload_shipping');
            $this->load->library('excel');
        }

        public function index()
        {
            // Page components

            $this->data['pageTitle'] = 'Data Import Shipping';
            $this->data['pageCss'] = $this->load->view('assets/_pageCss', $this->data, true);;
            $this->data['pageJs'] = $this->load->view('assets/_pageJs', $this->data, true);
            // $this->data['cabang'] = $this->m_upload_shipping->get_cabang()->result();
            $this->data['content'] = $this->load->view('main', $this->data, true);

            // Render page
            $this->renderPage();
        }

        public function get_data()
	    {

			if (array_key_exists('admin', $this->userGroup))
			{
				$where = "Id <> ''"; 
			}

            $office = $this->input->post('office');
            $no_polisi = $this->input->post('no_polisi');
            $no_rangka = $this->input->post('no_rangka');
            $no_mesin = $this->input->post('no_mesin');
            $merk = $this->input->post('merk');
            $tipe = $this->input->post('tipe');
            $tahun = $this->input->post('tahun');

            $cols = array();
            if (!empty($office)) { $cols['kode_cabang'] = $office; }
            if (!empty($no_polisi)) { $cols['no_polisi'] = $no_polisi; }
            if (!empty($no_rangka)) { $cols['no_rangka'] = $no_rangka; }
            if (!empty($no_mesin)) { $cols['no_mesin'] = $no_mesin; }
            if (!empty($merk)) { $cols['merk'] = $merk; }
            if (!empty($tipe)) { $cols['tipe'] = $tipe; }
            if (!empty($tahun)) { $cols['thn_kendaraan'] = $tahun; }  

	        $list = $this->m_upload_shipping->get_datatables($where, $cols);
	        $data = array();
	        $no = $_POST['start'];
	        $status_unit = '';

            foreach ($list as $r) {
                $row = array();
                $no++;

                $btn_action = '<div class="btn-group btn-group-xs btn-group-solid">
                                <button type="button" class="btn btn-xs blue btn-outline btn-detail tooltips" data-container="body" data-placement="top" data-original-title="Tooltip in top" data-id="'.$r->Id  .'"><i class="fa fa-list"></i> Detail</button>
                            </div>';

                $cekbox = '<td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" name="cek" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>';

                $row[] = $cekbox;
                $row[] = $r->Shipping_Date;
                $row[] = $r->Part_Packing_List;
                $row[] = $r->Shipping_Document;
                $row[] = $r->Part_Allocation;
                $row[] = $r->Part_Supply_Request_Date;
                $row[] = $r->Allocation_Date;
                $row[] = $r->Picking_Start;
                $row[] = $btn_action; 

                $data[] = $row;
             
            }
	 
	        $output = array(
	                        "draw" => $_POST['draw'],
	                        "recordsTotal" => $this->m_upload_shipping->count_all($where),
	                        "recordsFiltered" => $this->m_upload_shipping->count_filtered($where, $cols),
	                        "data" => $data,
	                );


	        //output to json format
	        echo json_encode($output);
	    }

        public function import(){

            // $path = $_FILES["file"]["tmp_name"];
            
            if(isset($_FILES["file"]["tmp_name"]))
            {
                $path = $_FILES["file"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                
                foreach($object->getWorksheetIterator() as $worksheet)
                {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for($row=2; $row<=$highestRow; $row++)
                    {
                        $Shipping_Date = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Part_Packing_List = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Shipping_Document = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Part_Allocation = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Part_Supply_Request_Date = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Allocation_Date = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Picking_Start = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        
                        $data[] = array(
                            'Shipping_Date'				=> date('Y-m-d H:i:s',strtotime($Shipping_Date)),
                            'Part_Packing_List'			=> $Part_Packing_List,
                            'Shipping_Document'			=> $Shipping_Document,
                            'Part_Allocation'			=> $Part_Allocation,
                            'Part_Supply_Request_Date'	=> date('Y-m-d H:i:s',strtotime($Part_Supply_Request_Date)),
                            'Allocation_Date'           => date('Y-m-d H:i:s',strtotime($Allocation_Date)),
                            'Picking_Start'             => date('Y-m-d H:i:s',strtotime($Picking_Start)),
                        );
                    }
                }
                
                $query = $this->m_upload_shipping->insert($data);

                if ($query) {
                    $response = array('status' => true, 'action' => 'Success', 'message' => 'Data berhasil diupload');
                } else {
                    $response = array('status' => false, 'action' => 'Failed', 'message' => 'Data gagal diuplpoad');
                }
                return response($response, 'json');
            }else{
                $response = array('status' => false, 'action' => 'Failed', 'message' => 'File Tidak DItemukan');
                return response($response, 'json');
            }

        }

        public function load_add_form()
		{
            $data['midentitas'] = Modules::run('midentitas/get', 'id')->result();
            $data['magama'] = Modules::run('magama/get', 'id')->result();
            $data['msim'] = Modules::run('msim/get', 'id')->result();

			return response($this->load->view('fadd', $data, TRUE), 'html');
		}

    }   
?>
