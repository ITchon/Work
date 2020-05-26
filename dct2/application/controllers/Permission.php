<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->load->helper('url'); 
        $this->model->CheckSession();
        $menu['menu'] = $this->model->showmenu();
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
        
        $sql =  'select * from sys_permissions where delete_flag !=0';
        $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 

        $sql =  'select * from sys_permission_groups where delete_flag !=0';
        $query = $this->db->query($sql); 
        $data['excLoadG'] = $query->result(); 


        $this->load->view('permission/manage',$data);//bring $data to user_data 
		$this->load->view('footer');
	}

        public function insert()
    {

        $gname =  $this->input->post('gname');
        $controller =  $this->input->post('controller');
        $spg_id =  $this->input->post('spg_id');
        $result = $this->model->insert_permission($gname, $controller, $spg_id);


    }

    public function deletepermission()
    {
        $this->model->delete_permission($this->uri->segment('3'));
        redirect('permission/manage');
    }

    public function enable($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $result = $this->model->enablePermission($uid);

        if($result!=FALSE){
            redirect('permission/manage','refresh');

        }else{
        
            echo "<script>alert('Simting wrong')</script>";
       redirect('permission/manage','refresh');
        }
    }

    public function disable($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $result = $this->model->disablePermission($uid);

        if($result!=FALSE){
            redirect('permission/manage','refresh');
            

        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('permission/manage','refresh');

        }
    }

}

