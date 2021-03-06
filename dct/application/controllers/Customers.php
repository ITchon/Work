<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->load->model('model_customers');
        $this->model->CheckSession();
        $this->model->load_menu();
        $this->model->button_show($this->session->userdata('su_id'),11);
    }

    public function exportCSV(){ 
        // file name 
        $filename = 'Customers '.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
  
        // get data 
        $drwdata = $this->model_customers->get_customers();
     
        // file creation 
        $file = fopen('php://output', 'w');
        $header = array("Customer","Customer Description"); 
        fputcsv($file, $header);
        foreach ($drwdata as $r){ 
          $a = array($r->cus_name,$r->cus_des);
          fputcsv($file,$a); 
        } 
        fclose($file); 
        exit; 
       }


	public function index()
  {	

	}

    
	public function manage()
    {	
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $sql =  'SELECT * FROM customers WHERE delete_flag != 0';
        $query = $this->db->query($sql); 
        $data['result_all'] = $query->result();
        $this->load->view('customers/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
        
    }


    public function add()
    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $this->load->view('customers/add');//bring $data to user_data 
        $this->load->view('footer');
    }


    public function insert()
    {
        $cus_name =  $this->input->post('cus_name');
        $cus_des =  $this->input->post('cus_des');
        $this->model_customers->insert_cus($cus_name,$cus_des);

        redirect('customers/manage','refresh');
       


    }


    public function delete()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $this->model_customers->delete_cus($this->uri->segment('3'));
        redirect('customers/manage');
    }


    public function edit()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id = $this->uri->segment('3');
        $sql =  "SELECT * from customers where cus_id = $id";

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $this->load->view('customers/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit()
    {
        $cus_id =  $this->input->post('cus_id');
        $cus_name =  $this->input->post('cus_name');
        $cus_des =  $this->input->post('cus_des');

        $this->model_customers->save_edit_cus($cus_id,$cus_name, $cus_des);
        redirect('customers/manage');
    }




}

