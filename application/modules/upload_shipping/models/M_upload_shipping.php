<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_upload_shipping extends CI_Model 
	{
		

		var $table = 'tbl_shipping';
		var $view = '';

	    var $column_order = array('Shipping_Date',
			'Part_Packing_List',
			'Shipping_Document',
			'Part_Allocation',
			'Part_Supply_Request_Date',
			'Allocation_Date',
			'Picking_Start',
			'Picking_End',
			'Checking_Start',
			'Checking_End',
			'Part_Case',
			'Supplied_Part',
			'Part_Name',
			'Quantity_Packing',
			'Dimension',
			'Volume',
			'Length',
			'Width',
			'Heigth',
			'Weight',
			'Description',
			'Case_Type',
			'Branch',
			'Seller_Name',
			'Ordered_Part',
			'Location_Status',
			'Code',
			'Branch_Type',
			'Delivery_Code',
			'Delivery_Method',
		);
	    var $column_search = array('Shipping_Date',
			'Part_Packing_List',
			'Shipping_Document',
			'Part_Allocation',
			'Part_Supply_Request_Date',
			'Allocation_Date',
			'Picking_Start',
			'Picking_End',
			'Checking_Start',
			'Checking_End',
			'Part_Case',
			'Supplied_Part',
			'Part_Name',
			'Quantity_Packing',
			'Dimension',
			'Volume',
			'Length',
			'Width',
			'Heigth',
			'Weight',
			'Description',
			'Case_Type',
			'Branch',
			'Seller_Name',
			'Ordered_Part',
			'Location_Status',
			'Code',
			'Branch_Type',
			'Delivery_Code',
			'Delivery_Method',
		);
	    
	    var $order = array('id' => 'desc'); 

		public function __construct() {
			parent::__construct();
		}

		public function get($order_by) {
			$table = $this->table;
			$this->db->order_by($order_by);
			$query=$this->db->get($table);
			return $query;
		}

		function insert($data)
		{
			$table = $this->table;
			$insert = $this->db->insert_batch($table, $data);
			return $insert;
		}

		public function get_where($where) {
			$table = $this->table;
			$this->db->where($where);
			$query=$this->db->get($table);
			return $query;
		}
		
	    private function _get_datatables_query($where, $cols)
	    {

			$this->db->where($where);
	        $this->db->from($this->table);

	        if(!empty($cols)){

		        foreach ($cols as $col => $value)
		        {
        			$this->db->like($col, $value);
		        }

		    }

	        if(isset($_POST['order'])) // here order processing
	        {
	            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order))
	        {
	            $order = $this->order;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	 
	    public function get_datatables($where, $cols)
	    {
	        $this->_get_datatables_query($where, $cols);
	        if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
	        return $query->result();
	    }
	 
	    public function count_all($where)
	    {
			$this->db->where($where);
			$this->db->from($this->table);
	        return $this->db->count_all_results();
	    }

	    public function count_filtered($where, $cols)
	    {
	        $this->_get_datatables_query($where, $cols);
	        return $this->db->count_all_results();
	    }
	}
