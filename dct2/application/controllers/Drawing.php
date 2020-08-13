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
            $this->model->button_show($this->session->userdata('su_id'),6);
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
        $search = $this->input->post('search');
        $sort = $this->input->post('sort');

        $s_dno = $this->input->post('s_dno');  
        $s_name = $this->input->post('s_name');
        $s_pno = $this->input->post('s_pno');

        
        $data['search'] = $search;
        $data['sort'] = $sort;

        $data['s_dno'] = $s_dno;
        $data['s_name'] = $s_name;
        $data['s_pno'] = $s_pno;

               $sql =  "SELECT d.d_id, d.d_no, d.dcn_id,c.cus_name, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no,p.p_id,dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code,d.d_name
      from drawing as d
      inner join dcn as dc on dc.dcn_id = d.dcn_id
      left join part as p on p.d_id = d.d_id 
      left join customers as c on c.cus_id = d.cus_id 
      where d.delete_flag != 0 ";
        $query = $this->db->query($sql);
        $data['result'] = $query->result(); 


        $sql =  "SELECT * from part
      where delete_flag != 0 ";
        $query = $this->db->query($sql);
        $data['resultp'] = $query->result(); 
        $this->load->view('drawing/show',$data);//bring $data to user_data 
        $this->load->view('footer'); 
    }

        public function show()
    {   

        $search = $this->input->post('search');
        $sort = $this->input->post('sort');
        $data['search'] = $search;
        $data['sort'] = $sort;

        $s_dno = $this->input->post('s_dno');  
        $s_name = $this->input->post('s_name');
        $s_pno = $this->input->post('s_pno');
        
        
        $data['s_dno'] = $s_dno;
        $data['s_name'] = $s_name;
        $data['s_pno'] = $s_pno;


      if($this->input->post('s_dno') == null){
        $s_dno = 'null';
      }
      
      if($this->input->post('s_name') == null){
        $s_name = 'null';
      }
      
      if($this->input->post('s_pno')== null){
        $s_pno = 'null';
      }

        $data['result'] = $this->model->drawing_search($s_dno,$s_name,$s_pno);
         $sql =  "SELECT * from part
      where delete_flag != 0 ";
        $query = $this->db->query($sql);
        $data['resultp'] = $query->result(); 

        $this->load->view('drawing/img_modal');
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
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

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

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $d_id =  $this->input->post('d_id');

        $result = $this->model->enableDrawing($d_id);


        redirect('drawing/show/','refresh');
        
    }

    public function disable(){

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $d_id = $this->input->post('d_id');

        $result = $this->model->disableDrawing($d_id);


        redirect('drawing/show/','refresh');
        
        

    }


    public function deletedrawing()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id = $this->input->post('d_id');
        $this->model->delete_drawing($id);
        redirect('drawing/show/','refresh');

    }

    public function version_form()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $id =  $this->input->post('d_id');

        $sql =  "SELECT d.d_id, d.d_no, d.dcn_id, d.enable, d.file_name as file, dc.dcn_no, d.version,
        d.path_file ,d.file_code
        from drawing as d
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
     public function test()
    {


        $this->load->view('drawing/test');
        $this->load->view('footer');
  
    }


    public function version_form_v()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
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
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = '*';
        $config['encrypt_name'] = TRUE;
        $d_id =  $this->input->post('d_id');
        $d_no =  $this->input->post('d_no');
        $dcn_id =  $this->input->post('dcn_id');
        $version =  $this->input->post('version');
        $path_file =  $this->input->post('path');
        $dcnid =  $this->input->post('dcnid');
        $code =  $this->input->post('code');

        if($_FILES['file_name']['name'] != null){
            $file = $_FILES['file_name']['name'];
             $this->load->library('upload', $config);
        $this->upload->initialize($config);
          if ( ! $this->upload->do_upload('file_name'))
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          exit();
          redirect('drawing/show','refresh');   
          }else{
            $uploaded = $this->upload->data();
    $code = array('filename'  => $uploaded['file_name']);
    foreach ($code as $c) {
            $this->model->select_version($d_id);
        $this->model->update_version($d_id, $d_no, $dcn_id, $version, $file, $path_file,$c);
        redirect('drawing/show/','refresh');
    }
          }
        }else{
            $file =  $this->input->post('file_name2');
          if ($this->input->post('file_name2') == null)
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          exit();
          redirect('drawing/show','refresh');   
          }else{
            $this->model->select_version($d_id);
        $this->model->update_version($d_id, $d_no, $dcn_id, $version, $file, $path_file,$code);
        redirect('drawing/show/','refresh');

          }
        }
       
  
    }

    public function openfile()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $d_id =  $this->input->post('d_id');
        $file =  $this->input->post('file');
        $test = "\\\\192.168.161.205\\dct\\uploads\\test.pdf";
        $filename =  $this->input->post('filename');
        $path = $this->input->post('path');
        $open = ("$test");
        $data = file_get_contents("$path$file");

exec($test);

        if($open){
        $this->model->download_record($this->session->userdata('su_id'),$this->session->userdata('username'),$filename);
           redirect('drawing/show/','refresh');
        }else{
            echo "<script>";
            echo 'alert("Data not found.");';
            echo 'history.go(-1);';
            echo '</script>';
        }
        redirect('drawing/show/','refresh');
    }

    public function open_dcn()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $dcn_id =  $this->input->post('dcn_id');
        $file =  $this->input->post('file');
        $filename =  $this->input->post('filename');
        $path = $this->input->post('path');
        $open = ("$path$file");
        $data = file_get_contents("$path$file");
        if($open){
    $this->model->download_record($this->session->userdata('su_id'),$this->session->userdata('username'),$filename);
    force_download($filename, $data);
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
            $config['encrypt_name'] = TRUE;
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
        $uploaded = $this->upload->data();
    $code = array('filename'  => $uploaded['file_name']);
    foreach ($code as $c) {
      $last_id = $this->model->insert_drawing($d_no, $dcn_id, $path, $file,$c);
      $d_id = $last_id;
      $result = $this->model->insert_part1($p_no,$p_name,$d_id);
  }
      $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
        <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
      </div> ');
  }else{
    $uploaded = $this->upload->data();
    $code = array('filename'  => $uploaded['file_name']);
    foreach ($code as $c) {
        $last_id = $this->model->insert_drawing($d_no, $dcn_id, $path, $file, $c);
    }  
      $this->session->set_flashdata('success','<div class="alert alert-success hide-it">
        <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
      </div> ');
  } 

          }
  
}
    
}     redirect('drawing/add','refresh');    



}
  public function edit()   
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        
        $d_id =  $this->input->post('d_id');
        $sql =  "SELECT * from drawing where d_id = $d_id";
        
        $query = $this->db->query($sql); 
        $data['result'] = $query->result()[0]; 

        $sql1 =  "SELECT * from dcn";
        $query = $this->db->query($sql1); 
        $data['result_dcn'] = $query->result(); 

        $sql1 =  "SELECT * from customers";
        $query = $this->db->query($sql1); 
        $data['result_cus'] = $query->result(); 
        
        $this->load->view('drawing/edit',$data);
        $this->load->view('footer');
  
    }

        public function save_edit()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = '*';

        if ($_FILES['file_name']['name'] != null) {
        $file_code =  $this->input->post('file_code');
        $config['file_name']            =  $file_code;
        $config['overwrite']            = TRUE;
        }
        
        $d_id =  $this->input->post('d_id');
        $d_no =  $this->input->post('d_no');
        $d_name =  $this->input->post('d_name');
        $dcn_id =  $this->input->post('dcn_id');
        $cus_id =  $this->input->post('cus_id');
        $path_file =  $this->input->post('path');
        $dcnid =  $this->input->post('dcnid');
        $code =  $this->input->post('code');

        if($_FILES['file_name']['name'] != null){
            $file = $_FILES['file_name']['name'];
             $this->load->library('upload', $config);
        $this->upload->initialize($config);
          if ( ! $this->upload->do_upload('file_name'))
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          exit();
          redirect('drawing/manage','refresh');   
          }else{
            $uploaded = $this->upload->data();
    $code = array('filename'  => $uploaded['file_name']);
    foreach ($code as $c) {
        $this->model->save_edit_drawing($d_id, $d_no, $d_name, $dcn_id, $cus_id, $file, $path_file,$c);
        redirect('drawing/manage/','refresh');
    }
          }
        }else{
            $file =  $this->input->post('file_name2');
          if ($this->input->post('file_name2') == null)
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          exit();
          redirect('drawing/manage','refresh');   
          }else{
            $file_code =  $this->input->post('file_code');
        $this->model->save_edit_drawing($d_id, $d_no, $d_name, $dcn_id, $cus_id, $file, $path_file,$file_code);
        redirect('drawing/manage/','refresh');

          }
        }
       
  
    }


        public function edit_v()   
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        
        $v_id =  $this->input->post('v_id');
        $sql =  "SELECT * from version where v_id = $v_id";
        
        $query = $this->db->query($sql); 
        $data['result'] = $query->result()[0]; 

        $sql1 =  "SELECT * from dcn";
        $query = $this->db->query($sql1); 
        $data['result_dcn'] = $query->result(); 

        $sql1 =  "SELECT * from customers";
        $query = $this->db->query($sql1); 
        $data['result_cus'] = $query->result(); 
        
        $this->load->view('drawing/edit_v',$data);
        $this->load->view('footer');
  
    }

        public function save_edit_v()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = '*';

        if ($_FILES['file_name']['name'] != null) {
        $file_code =  $this->input->post('file_code');
        $config['file_name']            =  $file_code;
        $config['overwrite']            = TRUE;
        }
        
        $v_id =  $this->input->post('v_id');
        $d_no =  $this->input->post('d_no');
        $d_name =  $this->input->post('d_name');
        $dcn_id =  $this->input->post('dcn_id');
        $cus_id =  $this->input->post('cus_id');
        $path_file =  $this->input->post('path');
        $dcnid =  $this->input->post('dcnid');
        $code =  $this->input->post('code');

        if($_FILES['file_name']['name'] != null){
            $file = $_FILES['file_name']['name'];
             $this->load->library('upload', $config);
        $this->upload->initialize($config);
          if ( ! $this->upload->do_upload('file_name'))
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          exit();
          redirect('drawing/manage','refresh');   
          }else{
            $uploaded = $this->upload->data();
    $code = array('filename'  => $uploaded['file_name']);
    foreach ($code as $c) {
        $this->model->save_edit_drawing_v($v_id, $d_no, $d_name, $dcn_id, $cus_id, $file, $path_file,$c);
        redirect('drawing/manage/','refresh');
    }
          }
        }else{
            $file =  $this->input->post('file_name2');
          if ($this->input->post('file_name2') == null)
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          exit();
          redirect('drawing/manage','refresh');   
          }else{
            $file_code =  $this->input->post('file_code');
            
        $this->model->save_edit_drawing_v($v_id, $d_no, $d_name, $dcn_id, $cus_id, $file, $path_file,$file_code);
        redirect('drawing/manage/','refresh');

          }
        }
       
  
    }
}

