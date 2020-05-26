<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usergroup extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->model->CheckSession();
        $menu['menu'] = $this->model->showmenu();
        $url = current_url(true);               
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
        $sql =  'select * from sys_users';
        $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 

        $this->load->view('user/manage',$data);//bring $data to user_data 
		$this->load->view('footer');
	}

    
	public function manage()
    {	
      
        $sql =  'select * from sys_user_groups where delete_flag != 0';
        $query = $this->db->query($sql); 
       $data['result'] = $query->result();
        $this->load->view('user_group/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
        
    }
    public function insert()
    {
    

        $gname =  $this->input->post('gname');
       $result = $this->model->insert_group($gname);
       if($result == true){
        echo "<script>alert('Inserted Data Success')</script>";
        redirect('user/add','refresh'); 
       }
       if($result == false){
        echo "<script>alert('Name already exist')</script>";
        redirect('user/add','refresh'); 
       }
       if($result == 3){
        echo "<script>alert('Error')</script>";
        redirect('user/add','refresh'); 
       }

    }

    public function enable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $result = $this->model->enableGroup($uid);

        if($result!=FALSE){
            redirect('Usergroup/manage','refresh');

        }else{
        
            echo "<script>alert('Simting wrong')</script>";
       redirect('Usergroup/manage','refresh');
        }
    }

    public function disable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $result = $this->model->disableGroup($uid);

        if($result!=FALSE){
            redirect('Usergroup/manage','refresh');
            

        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('Usergroup/manage','refresh');

        }
    }

    public function deletegroup()
    {
        $this->model->delete_group($this->uri->segment('3'));
        redirect('Usergroup/manage');
    }




}

