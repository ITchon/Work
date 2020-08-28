<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foldergroup extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->load->model('model_foldergroup');
        $this->model->CheckSession();
        $this->model->load_menu();
        $this->model->button_show($this->session->userdata('su_id'),12);

    }
	public function index()
    {	

	}

	public function manage()
    {	
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $sql =  "SELECT * from folder_group where delete_flag != 0 AND hidden =0 ";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 
        $this->load->view('folder_group/manage',$data);//bring $data to user_data 
		$this->load->view('footer');
	}

    public function add()
    {   
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $this->load->view('folder_group/add');//bring $data to user_data 
        $this->load->view('footer');
    }

    public function insert()
    {
        $folder_name =  $this->input->post('folder_name');
        $fol_name =  $this->input->post('fol_name');
        if (!file_exists('./uploads/' . $fol_name))/* Check folder exists or not */
        {
            @mkdir($output_dir . $folder_name, 0777);/* Create folder by using mkdir function */
            echo "Folder Created";/* Success Message */
        }
        $result = $this->model_foldergroup->insert_foldergroup($folder_name,$fol_name);
        redirect('foldergroup/add');


    }

    public function delete()
    {
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $this->model_foldergroup->delete_foldergroup($this->uri->segment('3'));
        redirect('foldergroup/manage');
    }

    public function edit()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id = $this->uri->segment('3');
        $sql =  "SELECT * from folder_group where fg_id = $id";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $this->load->view('folder_group/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit()
    {
        $fg_id =  $this->input->post('fg_id');
        $folg_name =  $this->input->post('folg_name');

        $this->model_foldergroup->save_edit_foldergroup($fg_id, $folg_name);
        redirect('foldergroup/manage');


  
    }


}

