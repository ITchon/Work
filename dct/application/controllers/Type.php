<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
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
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        
        $sql =  'select * from sys_permission_groups where delete_flag != 0';
        $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 
        $this->load->view('drawing_type/manage',$data);//bring $data to user_data 
		$this->load->view('footer');
	}

    public function add()
    {   
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $this->load->view('type/add');//bring $data to user_data 
        $this->load->view('footer');
    }

     public function enable($uid){

       $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $result = $this->model->enablePermission_Group($uid);

        if($result!=FALSE){
            redirect('permissiongroup/manage','refresh');

        }else{
        
            echo "<script>alert('Simting wrong')</script>";
       redirect('permissiongroup/manage','refresh');
        }
    }


    public function insert()
    {
        $type_name =  $this->input->post('type_name');
        $fol_name =  $this->input->post('fol_name');
        if (!file_exists('./uploads/' . $fol_name))/* Check folder exists or not */
        {
            @mkdir($output_dir . $folder_name, 0777);/* Create folder by using mkdir function */
            echo "Folder Created";/* Success Message */
        }
        $result = $this->model->insert_type($type_name,$fol_name);
        redirect('type/add');


    }

    public function delete_pg()
    {
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $this->model->delete_permissiongroup($this->uri->segment('3'));
        redirect('permissiongroup/manage');
    }

    public function edit_pg()
    {
       $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $id = $this->uri->segment('3');
        $sql =  "SELECT spg.spg_id, spg.name as spg_name from sys_permission_groups as spg  where delete_flag !=0";

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $this->load->view('permission_group/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit()
    {
        $spg_id =  $this->input->post('spg_id');
        $spg_name =  $this->input->post('spg_name');

        $this->model->save_edit_pg($spg_id, $spg_name);
        redirect('permissiongroup/manage');


  
    }


}

