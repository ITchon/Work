<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drawing extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->library('upload');
        $this->load->helper('download');
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->model->CheckSession();
        $menu['menu'] = $this->model->showmenu($this->session->userdata('sug_id'));
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url);
         $sql =  "select * from sys_menus where order_no != 0  and enable != 0 ORDER BY order_no";
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
        $this->session->set_userdata('name','');
        $this->session->set_userdata('id','');  
        $data['result_d'] = $this->model->get_drawing(); 
        $data['result_p'] = $this->model->get_part(); 
        $data['result_dcn'] = $this->model->get_dcn(); 
        $this->load->view('drawing/manage',$data);//bring $data to user_data 
        $this->load->view('footer'); 
    }

    public function show()
    {   

        if($this->session->userdata('id')){
            $id = $this->session->userdata('id');
            $name = $this->session->userdata('name');
        }else{
            $id =  $this->input->post('id');
            $name =  $this->input->post('name');
        }
        $ss = $this->input->post('search');
        $sort = $this->input->post('sort');
        $search = $ss;

        if($search == null){
            $search = null;
        }
        
        $data['id'] = $id;
        $data['name'] = $name;
        $data['search'] = $search;
        $data['sort'] = $sort;

        if($sort == 'Drawing'){
            $sort = "d.d_no";
        }else if($sort == 'Part'){
            $sort = "p.p_no";
        }else{
            $sort = "dc.dcn_no";
        }


        if($name == 'DCN'){
            $data['result'] = $this->model->get_dcn_by($id,$search,$sort);
        }else if($name == 'Part'){
            $data['result'] = $this->model->get_part_by($id,$search,$sort); 
        }else if($name == 'Drawing'){
            $data['result'] = $this->model->get_drawing_by($id,$search,$sort); 
        }else{
            redirect('drawing/manage');
        }
        $this->load->view('drawing/show',$data);//bring $data to user_data 
        $this->load->view('footer'); 
    }

    public function show_v()
    {   
        if($this->input->post('id')){
        $id =  $this->input->post('id');
        $name =  $this->input->post('name');
        }else{
        $id = $this->session->userdata('id');
        $name = $this->session->userdata('name');
             
        }
        $d_id =  $this->input->post('d_id');
        $p_id =  $this->input->post('p_id');
        $ss = $this->input->post('search');
        $sort = $this->input->post('sort');
        $search = $ss;

        if($search == null){
            $search = null;
        }

        $data['id'] = $id;
        $data['name'] = $name;
        $data['search'] = $search;
        $data['sort'] = $sort;
   
        $data['result'] = $this->model->get_drawing_ver($d_id,$p_id); 
        $this->load->view('drawing/show_v',$data);//bring $data to user_data 
        $this->load->view('footer'); 

    }

    public function add()

    {   
        //$this->model->CheckPermission($this->session->userdata('su_id'));

        $sql = "SELECT * FROM dcn where delete_flag != 0 ";
        $query = $this->db->query($sql);
        $data['result_dcn'] = $query->result(); 

        $this->load->view('drawing/add',$data);//bring $data to user_data 
        $this->load->view('footer');
    }

    
    public function insert()
    {
        $d_no =  $this->input->post('d_no');
        $dcn_id =  $this->input->post('dcn_id');
        $p_no =  $this->input->post('p_no');
        $p_name =  $this->input->post('p_name');
        $path =  $this->input->post('path');
        $file =  $this->input->post('file_name');

  $num= $this->db->query("SELECT * FROM drawing where d_no = '$d_no'"); 
  $chk= $num->num_rows();
 if($chk >= 1){
    $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้วd</span>
        </div> ');
        $this->session->set_flashdata('d_no',$d_no);
      
 }else if($chk != 1){
    $num= $this->db->query("SELECT * FROM part where p_no = '$p_no'"); 
  $chk= $num->num_rows();
  if($chk>=1){
    $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้วp</span>
        </div> ');
        $this->session->set_flashdata('p_no',$p_no);
     
 }else{
    $last_id = $this->model->insert_drawing($d_no, $dcn_id, $path, $file);
        $d_id = $last_id;
        $result = $this->model->insert_part1($p_no,$p_name,$d_id);
        $this->session->set_flashdata('success','<div class="alert alert-succes hide-its">  
          <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
        </div> ');
       
}
    
}     redirect('drawing/add','refresh');    
    }

    public function insert2()
    {
    
        $d_no =  $this->input->post('d_no');
        $dcn_id =  $this->input->post('dcn_id');
        $file_name =  $this->input->post('file_name2');

        
        $result = $this->model->insert_drawing($d_no, $dcn_id, $file_name);

        redirect('drawing/manage','refresh');
  
    }


    public function enable(){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));
        $d_id =  $this->input->post('d_id');

        $result = $this->model->enableDrawing($d_id);


        redirect('drawing/show/','refresh');
        
    }

    public function disable(){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));
        $d_id = $this->input->post('d_id');

        $result = $this->model->disableDrawing($d_id);


        redirect('drawing/show/','refresh');
        
        

    }


    public function deletedrawing()
    {
        $id = $this->input->post('d_id');
        $this->model->delete_drawing($id);
        redirect('drawing/show/','refresh');

    }

    public function version_form()
    {
        $id =  $this->input->post('d_id');

        $sql =  "SELECT d.d_id, d.d_no, d.dcn_id, d.enable, d.file_name as file, dc.dcn_no, d.version,
        d.path_file from drawing as d
          inner join dcn as dc on dc.dcn_id = d.dcn_id
          where d.d_id = $id";

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $dcn =  $data['result'][0]->dcn_id;
        $data['dcnid'] = $dcn; 


        $sql1 =  "SELECT * from dcn where delete_flag != 0 AND dcn_id != $dcn ";
        $query = $this->db->query($sql1); 
        $data['result_dcn'] = $query->result(); 

        $this->load->view('drawing/add_version',$data);
        $this->load->view('footer');
  
    }

    public function version_form_v()
    {
        $id = $this->uri->segment('3');

        $sql =  "SELECT v.v_id, d.d_id, d.d_no, v.dcn_id, dc.dcn_no, v.enable, v.file_name as file,
        v.version, v.path_file from version as v
        inner join drawing as d on d.d_id = v.d_id
        inner join dcn as dc on dc.dcn_id = d.dcn_id
          where v.v_id = $id";

          $sql1 =  'SELECT * from dcn where delete_flag != 0';
        $query = $this->db->query($sql1); 
        $data['result_dcn'] = $query->result(); 

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $this->load->view('drawing/add_version',$data);
        $this->load->view('footer');
  
    }


    public function update_v()
    {

        $d_id =  $this->input->post('d_id');
        $d_no =  $this->input->post('d_no');
        $dcn_id =  $this->input->post('dcn_id');
        $version =  $this->input->post('version');
        $path_file =  $this->input->post('path');
        $file_name =  $this->input->post('file_name');
        $dcnid =  $this->input->post('dcnid');

        $this->model->select_version($d_id);
        $this->model->update_version($d_id, $d_no, $dcn_id, $version, $file_name, $path_file);

        redirect('drawing/show/','refresh');


  
    }

    public function openfile()
    {
        $d_id =  $this->input->post('d_id');
        $file =  $this->input->post('file');
        $path = $this->input->post('path');
        $open = ("$path$file");
        if($open){
        $this->model->download_record($this->session->userdata('su_id'),$this->session->userdata('username'),$file);
         force_download($open, NULL);  
           echo '<script language="javascript">';
                echo 'history.go(-1);';
                echo '</script>';
        }else{
            echo "<script>";
            echo 'alert("Data not found.");';
            echo 'history.go(-1);';
            echo '</script>';
        }

    }

    public function open_dcn()
    {
        $dcn_id =  $this->input->post('dcn_id');
        $file =  $this->input->post('file');
        $path = $this->input->post('path');
        $open = ("$path$file");
        
        if($open){
    $this->model->download_record($this->session->userdata('su_id'),$this->session->userdata('username'),$file);
    force_download($open, NULL);
            echo '<script language="javascript">';
                echo 'history.go(-1);';
                echo '</script>';
        }else{
            echo "<script>";
            echo 'alert("Data not found.");';
            echo 'history.go(-1);';
            echo '</script>';
        }
  
    }

    public function upload()
    {       
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = '*';
        $d_no =  $this->input->post('d_no');
        $dcn_id =  $this->input->post('dcn_id');
        $p_no =  $this->input->post('p_no');
        $p_name =  $this->input->post('p_name');
        $path =  $this->input->post('path');
        $file = $_FILES['file_name']['name'];


      $num= $this->db->query("SELECT * FROM drawing where d_no = '$d_no'"); 
  $chk= $num->num_rows();
 if($chk != 0){
    $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้วd</span>
        </div> ');
        $this->session->set_flashdata('d_no',$d_no);
      
 }else if($chk != 1){
    $num= $this->db->query("SELECT * FROM part where p_no = '$p_no'"); 
  $chk= $num->num_rows();
  if($chk>=1){
    $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้วp</span>
        </div> ');
        $this->session->set_flashdata('p_no',$p_no);
     
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
            redirect('drawing/add','refresh');   
            }
            else
            {
        if($p_no != null || $p_name != null){
        $last_id = $this->model->insert_drawing($d_no, $dcn_id, $path, $file);
        $d_id = $last_id;
        $result = $this->model->insert_part1($p_no,$p_name,$d_id);
        $this->session->set_flashdata('success','<div class="alert alert-succes hide-its">  
          <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
        </div> ');
    }else{
        $last_id = $this->model->insert_drawing($d_no, $dcn_id, $path, $file);
        $this->session->set_flashdata('success','<div class="alert alert-succes hide-its">  
          <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
        </div> ');
    } 

            }
  
}
    
}     redirect('drawing/add','refresh');    



}
}

