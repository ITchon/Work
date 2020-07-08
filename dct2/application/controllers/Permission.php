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
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

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
        redirect('permission/manage');

    }

    public function add()
    {   
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $sql = "SELECT * FROM sys_permission_groups where delete_flag != 0 ";
        $query = $this->db->query($sql);
        $data['excLoadG'] = $query->result(); 

        $this->load->view('permission/add',$data);//bring $data to user_data 
        $this->load->view('footer');
    }

    public function deletepermission()
    {
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $this->model->delete_permission($this->uri->segment('3'));
        redirect('permission/manage');
    }

    public function enable($uid){

        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $result = $this->model->enablePermission($uid);

        if($result!=FALSE){
            redirect('permission/manage','refresh');

        }else{
        
            echo "<script>alert('Simting wrong')</script>";
       redirect('permission/manage','refresh');
        }
    }

    public function disable($uid){

       $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $result = $this->model->disablePermission($uid);

        if($result!=FALSE){
            redirect('permission/manage','refresh');
            

        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('permission/manage','refresh');

        }
    }

    public function edit_permission()
    {
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $id = $this->uri->segment('3');
        $sql =  "SELECT sp.sp_id, sp.name as sp_name, spg.spg_id, spg.name as spg_name, sp.controller from sys_permissions as sp
          inner join sys_permission_groups as spg on spg.spg_id = sp.spg_id
          where sp.sp_id = $id";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

         $group = $data['result'][0]->spg_id;

        $sql =  "SELECT * from sys_permission_groups where delete_flag !=0 AND spg_id != '$group'";
        $query = $this->db->query($sql); 
        $data['result_g'] = $query->result(); 

        $this->load->view('permission/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit()
    {
        $sp_id =  $this->input->post('sp_id');
        $sp_name =  $this->input->post('sp_name');
        $spg_id =  $this->input->post('spg_id');

        $this->model->save_edit_p($sp_id, $spg_id, $sp_name);
        redirect('permission/manage');


  
    }

}

