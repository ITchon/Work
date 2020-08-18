<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->model->CheckSession();
        $this->model->load_menu();
        
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

        $cus_name =  $this->input->post('cusname');
        $cus_des =  $this->input->post('cusdes');
        $result = $this->model->insert_cus($cus_name,$cus_des);
       if($result == true){
        redirect('customers/add','refresh');
       }
       if($result == false){
        echo "<script>alert('Name already exist')</script>";
        redirect('customers/add','refresh'); 
       }
       if($result == 3){
        echo "<script>alert('Error')</script>";
        redirect('customers/add','refresh'); 
       }

    }


    public function delete()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $this->model->delete_cus($this->uri->segment('3'));
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

        $this->model->save_edit_cus($cus_id,$cus_name, $cus_des);
        redirect('customers/manage');
    }




}

