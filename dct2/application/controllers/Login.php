<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');

    }
	public function index()
    {	
        $this->load->view('login');
	}
	public function chklogin()
    {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
  
        $data= $this->model->getuser($user,$pass);
         if($data==true) {
            $arrData = array('status'=> $data['u_enable'], 'su_id'=>$data['su_id'], 'password'=> $data['password'],'username'=> $data['username'],'sug_id'=>$data['sug_id'],'login' => "OK");	
             $this->session->set_userdata($arrData);
             $this->session->set_userdata('gg',"55");
             $username = $this->session->userdata('username');
             if($data['u_enable'] != 1){
               $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
               <span> Your account has been disable </span>
             </div> ');
                redirect('login');  
             }else if($data['sug_enable'] != 1){
               $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
               <span> Your group has been disable </span>
             </div> ');
                redirect('login'); 
             } else{
                redirect('manage/index');
             }
        }
     else{
      $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
      <span> Wrong password or username </span>
    </div> ');
        redirect('login');  
     
     }
   
   }

    

}

