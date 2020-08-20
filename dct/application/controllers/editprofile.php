<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class editprofile extends CI_Controller {

    function __construct() { 
    
         parent::__construct(); 
        $this->load->helper('form');
        $this->load->helper('url');
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
        $su_id =  $this->session->userdata('su_id');
        $sql='SELECT * FROM sys_users  INNER JOIN sys_user_groups ON sys_users.sug_id=sys_user_groups.sug_id
        where su_id = '.$su_id.'';
        //$sql =  'SELECT * FROM sys_users ';
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $gender = $data['result'][0]->gender;


        $g = $data['result'][0]->sug_id;


        $sqlSelG = "SELECT * FROM sys_user_groups WHERE sug_id<>'0' AND enable='1' AND delete_flag != 0 AND sug_id != $g;";
        $query = $this->db->query($sqlSelG); 
        $data['excLoadG'] = $query->result(); 


       $id = $this->uri->segment('3'); 
      
        //$data['result'] = $this->main_model->selectOne();

        $this->load->view('editprofile/manage',$data);
        $this->load->view('footer');

    }

    public function updated_profile()
    {
        $su_id =  $this->session->userdata('su_id');
        $fname =  $this->input->post('fname');
        $lname  =  $this->input->post('lname');
        $gender =  $this->input->post('gender');
        $email  =  $this->input->post('email');

        $result = $this->model->updated_profile_data($fname,$lname,$gender,$email,$su_id);
        $this->session->set_flashdata('success','<div class="alert text-center alert-success hide-it">  
        <span> Success</span>
      </div> ');
       redirect('editprofile/manage');
    }


}

