<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class changepassword extends CI_Controller {

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

    public function account()
    {	
        $su_id =  $this->session->userdata('su_id');
        $this->model->CheckSession();
        $sql='SELECT * FROM sys_users WHERE su_id =  '.$su_id.'';
        //$sql =  'SELECT * FROM sys_users ';
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $this->load->view('changepassword/acount',$data);
        $this->load->view('footer');

    }

    public function changed_pass()
    {

            
            $this->model->CheckSession();
            $cur_password=$this->input->post('cur_password');
            $new_password=$this->input->post('new_password');
            $con_password=$this->input->post('con_password');
            $session_id  =$this->session->userdata('su_id');
            $session_pass=$this->session->userdata('password');

            $pass = base64_decode(trim($session_pass));
            if((!strcmp($cur_password, $pass))&& (!strcmp($new_password, $con_password))){
                $this->model->change_pass($session_id,$new_password);
                echo "Password changed successfully !";
                redirect('Logout');
                }
               else{
                    $this->session->set_flashdata('error','<div class="alert alert-danger hide-it">  
          <span>  <b> Error - </b> รหัสของคุณไม่ตรงกัน - กรุณาลองไหม่</span>
        </div> ');
            redirect('changepassword/account');
                }
            


    }


}

