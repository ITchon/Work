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
        $sql =  'SELECT * from folder as f
        inner join folder_group as fg on fg.fg_id = f.fg_id
        where f.delete_flag != 0';
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 
        $this->load->view('folder/manage',$data);//bring $data to user_data 
		$this->load->view('footer');
	}

    public function add()
    {   
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));   
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $data['result_folg'] = $this->model_folder->get_foldergroup();

        $this->load->view('folder/add',$data);//bring $data to user_data 
        $this->load->view('footer');
    }

    public function insert()
    {
        $type_name =  $this->input->post('type_name');
        $fol_name =  $this->input->post('fol_name');
        $fg_id =  $this->input->post('fg_id');

        
        $result = $this->model_folder->get_foldergroup_byid($fg_id);
        $path = $result[0]->foldergroup_name;
        $result = $this->model_folder->insert_folder($type_name,$fol_name,$fg_id);
        if($result != false){
            $path = "uploads/".$path.'/'.$fol_name;
        if(!is_dir($path)) //create the folder if it's not exists
        {
          mkdir($path,0777,TRUE);
        } 
        }else{
            echo "<script>";
            echo 'alert("Fail");';
            echo 'history.go(-1);';
            echo '</script>';
            redirect('folder/add');
        }
        redirect('folder/manage');


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
        $type_name =  $this->input->post('type_name');
        $fol_name =  $this->input->post('fol_name');
        $res = $this->model_folder->getfolder($f_id);
        $folderg = $res->folg;
        $folder = $res->fol;

        $oldname = './uploads/'.$folderg.'/'.$folder;
        $newname = './uploads/' .$folderg.'/'.$fol_name;
        rename($oldname, $newname);

        $this->model_folder->save_edit_f($f_id, $type_name, $fol_name);
        redirect('folder/manage');


  
    }


}

