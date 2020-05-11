<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissiongroup extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->model->CheckSession();
        $menu['menu'] = $this->model->showmenu();
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url); 
         $sql =  "select * from sys_menus where order_no != 0 and enable != 0";
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
        $sql =  'select * from sys_permission_groups where delete_flag != 0';
        $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 
        $this->load->view('permission_group/manage',$data);//bring $data to user_data 
		$this->load->view('footer');
	}

     public function enable($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $result = $this->model->enablePermission_Group($uid);

        if($result!=FALSE){
            redirect('permissiongroup/manage','refresh');

        }else{
        
            echo "<script>alert('Simting wrong')</script>";
       redirect('permissiongroup/manage','refresh');
        }
    }


    public function disable($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $result = $this->model->disablePermission_Group($uid);

        if($result!=FALSE){
            redirect('permissiongroup/manage','refresh');
            

        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('permissiongroup/manage','refresh');

        }
    }

    public function insert()
    {

        $gname =  $this->input->post('gname');
        $result = $this->model->insert_permissiongroup($gname);


    }

    public function delete_permissiongroup()
    {
        $this->model->delete_permissiongroup($this->uri->segment('3'));
        redirect('permissiongroup/manage');
    }


}

