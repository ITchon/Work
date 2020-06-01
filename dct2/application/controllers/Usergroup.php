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
       $data['result_all'] = $query->result();
        $this->load->view('user_group/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
        
    }

    public function rule_ug($id)
    {       
            $sql1 =  "SELECT * from sys_users_groups_permissions where sug_id = $id";
            $query = $this->db->query($sql1); 
            $data['result_user']= $query->result(); 

            $sql2 =  "SELECT sug.sug_id, sug.enable, sug.name, sug.name as sug_name from sys_user_groups as sug where sug.sug_id = $id";
            $query = $this->db->query($sql2); 
            $data['result']= $query->result(); 

            $sql2 =  "SELECT * from sys_user_groups where delete_flag != 0 ";
            $query = $this->db->query($sql2); 
            $data['result_all']= $query->result(); 

            $sql3 =  "SELECT * from sys_permission_groups";
            $query = $this->db->query($sql3); 
            $data['result_group']= $query->result(); 

         $this->load->view('user_group/manage',$data);
         $this->load->view('user_group/rule_userg', $data);//bring $data to user_data 
         $this->load->view('footer');
   
    }


    public function insert()
    {
    

        $gname =  $this->input->post('gname');
       $result = $this->model->insert_group($gname);
       if($result == true){
        echo "<script>alert('Inserted Data Success')</script>";
        redirect('user/manage','refresh'); 
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

        //$this->model->CheckPermission($this->session->userdata('su_id'));
        $result = $this->model->enableGroup($uid);

        if($result!=FALSE){
            redirect('Usergroup/manage','refresh');

        }else{
        
            echo "<script>alert('Simting wrong')</script>";
       redirect('Usergroup/manage','refresh');
        }
    }

    public function disable($uid){

        //$this->model->CheckPermission($this->session->userdata('su_id'));
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

    public function save_userg_permission()
    {

        $sug_id =  $this->input->post('sug_id');
  
        $spg_id =  $this->input->post('spg_id');
           $this->model->deluserg_permission($sug_id);
           if($spg_id != ''){
            foreach ($spg_id as $spg) {
         $this->model->insertuserg_permission($sug_id,$spg);
     }
           }

     redirect('Usergroup/manage','refresh');
 
    }

    public function edit_ug()
    {
        $id = $this->uri->segment('3');

        $sql =  "SELECT sug.sug_id, sug.name as sug_name from sys_user_groups as sug
          where sug.sug_id = $id";

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $this->load->view('user_group/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit()
    {
        $sug_id =  $this->input->post('sug_id');
        $sug_name =  $this->input->post('sug_name');

        $this->model->save_edit_ug($sug_id, $sug_name);
        redirect('Usergroup/manage');
    }




}

