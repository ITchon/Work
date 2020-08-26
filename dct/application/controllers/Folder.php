<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folder extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->load->model('model_folder');
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
        $sql =  'select * from folder where delete_flag != 0';
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 
        $this->load->view('folder/manage',$data);//bring $data to user_data 
		$this->load->view('footer');
	}

    public function add()
    {   
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $this->load->view('folder/add');//bring $data to user_data 
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
        $result = $this->model_folder->insert_folder($folder_name,$fol_name);
        redirect('folder/add');


    }

    public function delete()
    {
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $this->model_folder->delete_folder($this->uri->segment('3'));
        redirect('folder/manage');
    }

    public function edit()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id = $this->uri->segment('3');
        $sql =  "SELECT * from folder where f_id = $id";

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $this->load->view('folder/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit()
    {
        $f_id =  $this->input->post('f_id');
        $f_name =  $this->input->post('f_name');
        $f_fol =  $this->input->post('f_fol');

        $this->model_folder->save_edit_f($f_id, $f_name, $f_fol);
        redirect('folder/manage');


  
    }


}
