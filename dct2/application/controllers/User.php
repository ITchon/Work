<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->database(); 
        $this->load->model('model');
        $this->model->CheckSession();
    
        $menu['menu'] = $this->model->showmenu();
        $sql =  "select * from sys_menus where order_no !=0";
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
        $sql =  'SELECT su.su_id,su.username, su.firstname ,su.lastname, su.gender,su.email,su.enable,su.delete_flag, sug.name as name
    FROM
    sys_users  AS su 
    INNER JOIN sys_user_groups AS sug ON sug.sug_id = su.sug_id where su.delete_flag != 0 ';
        $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 
        $this->load->view('user/manage',$data);//bring $data to user_data 
		$this->load->view('footer');
	}


	public function add()
    {	
        $sql =  'select * from sys_users';
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 


        $sqlSelG = "SELECT * FROM sys_user_groups WHERE sug_id<>'1' AND enable='1' AND delete_flag != 0 ;";
        $query = $this->db->query($sqlSelG); 
        $data['excLoadG'] = $query->result(); 

        $this->load->view('user/add',$data);//bring $data to user_data 
		$this->load->view('footer');
	}


    public function insert()
    {
    

        $fname =  $this->input->post('fname');
        $lname  =  $this->input->post('lname');
        $gender =  $this->input->post('gender');
        $username =  $this->input->post('username');
        $password =  $this->input->post('password');
        $email  =  $this->input->post('email');
        $sug_id =  $this->input->post('sug_id');
       $result = $this->model->insert($fname,$lname,$username,$password,$gender,$email,$sug_id);
       echo "<script>alert('Inserted Data Success')</script>";
       redirect('user/add','refresh');

    }
    public function enable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));

		$result = $this->model->enableUser($uid);

		if($result!=FALSE){
            redirect('user/manage','refresh');

		}else{
		
		    echo "<script>alert('Simting wrong')</script>";
       redirect('user/manage','refresh');
		}
	}

	public function disable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));

		$result = $this->model->disableUser($uid);

		if($result!=FALSE){
            redirect('user/manage','refresh');
			

		}else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('user/manage','refresh');

		}
	}

    public function deleteuser()
    {
        $this->model->delete_user($this->uri->segment('3'));
        redirect('user/manage');
    }

    
}

