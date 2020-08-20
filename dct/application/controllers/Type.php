<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->load->model('model_type');
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
        $sql =  'select * from type_file where delete_flag != 0';
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 
        $this->load->view('type/manage',$data);//bring $data to user_data 
		$this->load->view('footer');
	}

    public function add()
    {   
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $this->load->view('type/add');//bring $data to user_data 
        $this->load->view('footer');
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
        $result = $this->model_type->insert_type($type_name,$fol_name);
        redirect('type/add');


    }

    public function delete()
    {
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $this->model_type->delete_type($this->uri->segment('3'));
        redirect('type/manage');
    }

    public function edit()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id = $this->uri->segment('3');
        $sql =  "SELECT * from type_file where tf_id = $id";

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $this->load->view('type/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit()
    {
        $tf_id =  $this->input->post('tf_id');
        $tf_name =  $this->input->post('tf_name');
        $tf_fol =  $this->input->post('tf_fol');

        $this->model_type->save_edit_tf($tf_id, $tf_name, $tf_fol);
        redirect('type/manage');


  
    }


}

