<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dcn extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->library('upload');
        $this->load->helper('download');
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');     
        $this->load->model('model_dcn');
        $this->load->model('model_drawing');
        $this->model->load_menu();
        $this->model->button_show($this->session->userdata('su_id'),8);
    }
    public function index()
    {   

    }
        public function manage()
    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $text = null;
        $dcn_id = null;
        $data['chk'] = $dcn_id;
        if($this->uri->segment('3')){
            $dcn_id = $this->uri->segment('3');
            $text = "and dc.dcn_id = $dcn_id ";
            $data['chk'] = $dcn_id;
        }
        $data['result'] = $this->model_dcn->get_dcn_byid($text); 
        $this->load->view('dcn/img_modal');//bring $data to user_data 
        $this->load->view('dcn/show',$data);//bring $data to user_data 
        $this->load->view('footer');

        
    }

    public function add()
    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));


        $sql = "SELECT * FROM folder where fg_id = 2";
        $query = $this->db->query($sql);
        $data['result_folder'] = $query->result(); 

        $this->load->view('dcn/add',$data);//bring $data to user_data 
        $this->load->view('footer');
        
        
    }

    
    public function insert()
    {
        
        $dcn_no =  $this->input->post('dcn_no');
        $path =  $this->input->post('path');
        $file =  $this->input->post('file_name');
        $result = $this->model_dcn->insert_dcn($dcn_no,$path,$file);
        

        if($result == true){
       $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
          <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
        </div> ');
        redirect('dcn/add','refresh'); 
       }
       else if($result == false){
        //echo "<script>alert('Username already exist')</script>";
        $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้ว</span>
        </div> ');

        $this->session->set_flashdata('dcn_no',$dcn_no);
        redirect('dcn/add','refresh'); 
       }
        
           
    
  
    }

    public function deletedcn()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id =  $this->uri->segment('3');
        $this->model_dcn->delete_dcn($id);
        redirect('dcn/manage/'.$id.'','refresh');
    }


    public function edit_dcn()   
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $id = $this->uri->segment('3');
        
        $sql =  "SELECT * from dcn
        where dcn_id = $id";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result()[0]; 
        $data['result_folder'] =  $this->model_dcn->get_folder_dcn($id);
        $this->load->view('dcn/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit_dcn()
    {
      $f_id =  $this->input->post('f_id');
      $folder = $this->model_drawing->checkfolder($f_id);
      $config['upload_path']           = './uploads/'.$folder;
      $config['allowed_types']        = '*';

        if ($_FILES['file_name']['name'] != null) {
        $file_code =  $this->input->post('file_code');
        $config['file_name']            =  $file_code;
        $config['overwrite']            = TRUE;
        }
    
        $dcn_id =  $this->input->post('dcn_id');
        $dcn_no  =  $this->input->post('dcn_no');
        $fold =  $this->input->post('fold');
        $folderold = $this->model_drawing->checkfolder($fold);
        $file_name =  $this->input->post('file_name');
        if($_FILES['file_name']['name'] != null){
            $file = $_FILES['file_name']['name'];
             $this->load->library('upload', $config);
        $this->upload->initialize($config);
          if ( !$this->upload->do_upload('file_name'))
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          redirect('drawing/edit_v/'.$d_id.'','refresh');
          }else{
          $this->model_dcn->save_dcn($dcn_id,$dcn_no,$path_file,$file_name,$f_id);
          }
        }else{

        }

        redirect('dcn/manage/'.$dcn_id.'','refresh');
  
    }

    public function enable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $result = $this->model_dcn->enableDcn($uid);
        $chk = $this->session->flashdata('chk');
        if($chk!=null){
            redirect('dcn/manage/'.$chk.'','refresh');

        }else{
             redirect('dcn/manage/','refresh');
        }
    }

    // public function disable($uid){

    //     $this->model->CheckPermission($this->session->userdata('su_id'));
    //     $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

    //     $result = $this->model_dcn->disableDcn($uid);
    //     $chk = $this->session->flashdata('chk');

    //     if($chk!=null){
    //         redirect('dcn/manage/'.$chk.'','refresh');
    //     }else{
    //         redirect('dcn/manage/','refresh');

    //     }
    // }

        public function upload()
    {       

        $f_id =  $this->input->post('f_id');
        $folder = $this->model_drawing->checkfolder($f_id);
        $config['upload_path']           = './uploads/'.$folder.'/';
        $config['allowed_types']        = '*';
        $config['max_size']        = '0';
        $config['encrypt_name'] = TRUE;
        
        $dcn_no =  $this->input->post('dcn_no');
        $path =  $this->input->post('path');
        $f_id =  $this->input->post('f_id');
        $file = $_FILES['file_name']['name'];


    $num= $this->db->query("SELECT * FROM dcn where dcn_no = '$dcn_no' AND delete_flag != 0"); 
  $chk= $num->num_rows();
 if($chk >= 1){
    $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้ว</span>
        </div> ');
        $this->session->set_flashdata('dcn_no',$dcn_no);
      
 }else{

            $this->load->library('upload', $config);
        $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('file_name'))
            {
            echo "<script>";
            echo 'alert(" File Failed ");';
            echo 'history.go(-1);';
            echo '</script>';
            exit();
            redirect('dcn/add','refresh');   
            }
            else
            {
                $uploaded = $this->upload->data();
    $code = array('filename'  => $uploaded['file_name']);
    foreach ($code as $c) {
        $result = $this->model_dcn->insert_dcn($dcn_no,$path,$file,$c,$f_id);
    }
            $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
          <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
        </div> ');
            }

    
}     
redirect('dcn/add','refresh');   

    }

}

