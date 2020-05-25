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
    
        $menu['menu'] = $this->model->showmenu();
        $sql =  "select * from sys_menus where order_no != 0 and enable != 0 ";
        $query = $this->db->query($sql); 
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url);
         $menu['submenu']= $query->result(); 
         $this->load->view('header');
         $this->load->view('menu',$menu);

    }

	public function index()
    {	
  
       

    }

    public function manage()
    {	
        $sql='SELECT * FROM sys_users  INNER JOIN sys_user_groups ON sys_users.sug_id=sys_user_groups.sug_id;';
        //$sql =  'SELECT * FROM sys_users ';
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $sqlSelG = "SELECT * FROM sys_user_groups WHERE sug_id<>'0' AND enable='1' AND delete_flag != 0 ;";
        $query = $this->db->query($sqlSelG); 
        $data['excLoadG'] = $query->result(); 

       $id = $this->uri->segment('3'); 
      
        //$data['result'] = $this->main_model->selectOne();

        $this->load->view('editprofile/manage',$data);
        $this->load->view('footer');

    }

    public function updated_profile()
    {
        $fname =  $this->input->post('fname');
        $lname  =  $this->input->post('lname');
        $gender =  $this->input->post('gender');
        $username =  $this->input->post('username');
        $password =  $this->input->post('password');
        $email  =  $this->input->post('email');
        $sug_id =  $this->input->post('sug_id');
        $su_id = $this->input->post('su_id');
        $result = $this->model->updated_profile_data($fname,$lname,$username,$password,$gender,$email,$sug_id,$su_id);

       redirect('User/manage');
    }


}

