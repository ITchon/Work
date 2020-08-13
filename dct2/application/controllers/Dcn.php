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

        $menu['menu'] = $this->model->showmenu($this->session->userdata('sug_id'));
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url);
          $menu['submenu'] = $this->model->showsubmenu($this->session->userdata('su_id'));
         $this->load->view('header');
        $this->load->view('menu',$menu);

    }
    public function index()
    {   

    }
        public function manage()
    {   

        $sql =  "SELECT dc.dcn_id, dc.dcn_no,dc.file_name as dcn_file,dc.path_file as dcn_path
        ,dc.file_code as dcn_code,dc.enable,dc.tf_id,tf.tf_fol
          from dcn as dc
          left join type_file as tf on tf.tf_id = dc.tf_id 
          where dc.delete_flag != 0 ";
            $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 
        $this->load->view('dcn/show',$data);//bring $data to user_data 
        $this->load->view('footer');

        
    }

    public function add()
    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $sql = "SELECT * FROM type_file where tf_name LIKE '%dcn%'";
        $query = $this->db->query($sql);
        $data['result_type'] = $query->result(); 

        $this->load->view('dcn/add',$data);//bring $data to user_data 
        $this->load->view('footer');
        
        
    }

    
    public function insert()
    {
        
        $dcn_no =  $this->input->post('dcn_no');
        $path =  $this->input->post('path');
        $file =  $this->input->post('file_name');
        $result = $this->model->insert_dcn($dcn_no,$path,$file);
        

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
        $this->model->delete_dcn($id);
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
        $data['result'] = $query->result(); 
        $this->load->view('dcn/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit_dcn()
    {
    
        $dcn_id =  $this->input->post('dcn_id');
        $dcn_no  =  $this->input->post('dcn_no');
        $path_file =  $this->input->post('path_file');
        $file_name =  $this->input->post('file_name');
        if($file_name==null){
            $file_name =  $this->input->post('file_name_old');
        }
       $this->model->save_dcn($dcn_id,$dcn_no,$path_file,$file_name);

        redirect('dcn/manage/'.$dcn_id.'','refresh');
  
    }

    public function enable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $result = $this->model->enableDcn($uid);

        if($result!=FALSE){
            redirect('dcn/manage/'.$uid.'','refresh');

        }else{
            echo "<script>alert('Somting wrong')</script>";
         redirect('dcn/manage/'.$uid.'','refresh');
        }
    }

    public function disable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $result = $this->model->disableDcn($uid);

        if($result!=FALSE){
            redirect('dcn/manage/'.$uid.'','refresh');
        }else{
            echo "<script>alert('Somting wrong')</script>";
            redirect('dcn/manage/'.$uid.'','refresh');

        }
    }

        public function upload()
    {       

        $tf_id =  $this->input->post('tf_id');
        $folder = $this->model->checkfolder($tf_id);
        $config['upload_path']           = './uploads/'.$folder.'/';
        $config['allowed_types']        = '*';
        $config['max_size']        = '0';
        $config['encrypt_name'] = TRUE;
        
        $dcn_no =  $this->input->post('dcn_no');
        $path =  $this->input->post('path');
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
        $result = $this->model->insert_dcn($dcn_no,$tf_id,$file,$c);
    }
            $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
          <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
        </div> ');
            }

    
}     
redirect('dcn/add','refresh');   

    }

}

