<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dcn extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->model->CheckSession();
        $menu['menu'] = $this->model->showmenu($this->session->userdata('sug_id'));
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url);
         $sql =  "select * from sys_menus where order_no != 0 and enable != 0 ORDER BY order_no";
         $query = $this->db->query($sql); 
         $menu['submenu']= $query->result(); 
         $this->load->view('header');
         $this->load->view('menu',$menu);

    }
	public function index()
    {	

    }
    	public function manage()
    {	
        $this->model->CheckPermission($this->session->userdata('su_id'));
  
        $sql =  'select * from dcn where delete_flag != 0';
        $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 
        $this->load->view('dcn/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
        
    }

    
    public function insert()
    {
    
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $dcn =  $this->input->post('dcn_no');
        $result = $this->model->insert_dcn($dcn);
        
        redirect('dcn/manage','refresh');
    
  
    }

    public function deletedcn()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $this->model->delete_dcn($this->uri->segment('3'));
        redirect('dcn/manage','refresh');
    }


    public function edit_dcn()   
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $id = $this->uri->segment('3');

        $sql =  "SELECT * from dcn
        where dcn_id = $id";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        
        $this->load->view('dcn/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit_dcn()
    {
    
        $dcn_id =  $this->input->post('dcn_id');
        $dcn_no  =  $this->input->post('dcn_no');
       $this->model->save_dcn($dcn_id,$dcn_no);

        echo "<script>alert('Add Data Success')</script>";
        redirect('dcn/manage','refresh');
  
    }

}

