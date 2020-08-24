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
        $this->load->model('model_drawing');
        $this->model->CheckSession();
        $this->model->button_show($this->session->userdata('su_id'),6);
        $this->model->load_menu();


    }
    public function index()
    {   

    }

    // public function manage()
    // {   
    //     $search = $this->input->post('search');
    //     $sort = $this->input->post('sort');

    //     $s_dno = $this->input->post('s_dno');  
    //     $s_name = $this->input->post('s_name');
    //     $s_pno = $this->input->post('s_pno');

        
    //     $data['search'] = $search;
    //     $data['sort'] = $sort;

    //     $data['s_dno'] = $s_dno;
    //     $data['s_name'] = $s_name;
    //     $data['s_pno'] = $s_pno;

    //            $sql =  "SELECT d.d_id, d.d_no, d.dcn_id,c.cus_name, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no,p.p_id,dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code,d.d_name
    //   from drawing as d
    //   inner join dcn as dc on dc.dcn_id = d.dcn_id
    //   left join part as p on p.d_id = d.d_id 
    //   left join customers as c on c.cus_id = d.cus_id 
    //   where d.delete_flag != 0 ";
    //     $query = $this->db->query($sql);
    //     $data['result'] = $query->result(); 


    //     $sql =  "SELECT * from part
    //   where delete_flag != 0 ";
    //     $query = $this->db->query($sql);
    //     $data['resultp'] = $query->result(); 
    //     $this->load->view('drawing/show',$data);//bring $data to user_data 
    //     $this->load->view('footer'); 
    // }



public function show()
{   
      $this->model_drawing->link_to_dcn($this->session->userdata('su_id'));
      $s_dno = $this->input->get('s_dno');  
      $s_name = $this->input->get('s_name');
      $s_pno = $this->input->get('s_pno');
      $type = $this->input->get('type');

          

      $params = $_SERVER['QUERY_STRING'];

      
      $this->session->set_flashdata('search',$params);

      $data['s_dno'] = $s_dno;
      $data['s_name'] = $s_name;
      $data['s_pno'] = $s_pno;
      $data['type'] = $type;
      $data['result_type']= $this->model_drawing->get_type_drawing();
  
      if($this->input->get('s_dno') == null){
        $s_dno = 'null';
      }
      
      if($this->input->get('s_name') == null){
        $s_name = 'null';
      }
      
      if($this->input->get('s_pno') == null){
        $s_pno = 'null';
      }
      if($this->input->get('s_dno') == null && $this->input->get('s_name') == null && $this->input->get('s_pno') == null){
        $s_pno = '';
        $s_name = '';
        $s_dno = '';

      }
      if($this->input->get('s_dno') != null || $this->input->get('s_name') != null || $this->input->get('s_pno') != null || $this->input->get('type') != null ){
        if($type ==null){
          $data = $this->model_drawing->get_type_drawing();
          foreach($data as $t){
            $type[] = $t->tf_id;
          }
        }
        $data['result'] = $this->model_drawing->drawing_search($s_dno,$s_name,$s_pno,$type);
      }else{
        $data['result'] = $this->model_drawing->get_partdrawing();
      }
        $data['resultp'] = $this->model_drawing->get_part();
      
  
      $this->load->view('drawing/img_modal');
      $this->load->view('drawing/show',$data);//bring $data to user_data 
      $this->load->view('footer'); 
} 
  
      public function show_v()
{   
          $this->model->CheckPermission($this->session->userdata('su_id'));
          $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
  
          $d_id =  $this->input->get('d_id');
  
          $did = '&d_id='.$d_id ;
          $data['search'] = $did;

          $params = $_SERVER['QUERY_STRING'];
          $this->session->set_flashdata('search',$params);
          
          $d_id = intval(preg_replace('/[^0-9]+/', '', $params), 10);
  
     
          $data['result'] = $this->model_drawing->get_drawing_ver($d_id);
          $this->load->view('drawing/img_modal');
          $this->load->view('drawing/show_v',$data);//bring $data to user_data 
          $this->load->view('footer'); 
  
}

    public function add()

    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $data['result_dcn'] = $this->model_drawing->get_dcn();
        $data['result_type'] = $this->model_drawing->get_type_drawing();
        $data['result_cus'] = $this->model_drawing->get_customers();
        $data['result_p'] = $this->model_drawing->get_part();

        $this->load->view('drawing/add',$data);//bring $data to user_data 
        $this->load->view('footer');
    }


    
//     public function insert()
//     {
//         $d_no =  $this->input->post('d_no');
//         $dcn_id =  $this->input->post('dcn_id');
//         $p_no =  $this->input->post('p_no');
//         $p_name =  $this->input->post('p_name');
//         $path =  $this->input->post('path');
//         $file =  $this->input->post('file_name');

//   $num= $this->db->query("SELECT * FROM drawing where d_no = '$d_no'"); 
//   $chk= $num->num_rows();
//  if($chk >= 1){
//     $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
//           <span> ชื่อนี้ถูกใช้เเล้ว</span>
//         </div> ');
//         $this->session->set_flashdata('d_no',$d_no);
      
//  }else if($chk != 1){
//     $num= $this->db->query("SELECT * FROM part where p_no = '$p_no'"); 
//   $chk= $num->num_rows();
//   if($chk>=1){
//     $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
//           <span> ชื่อนี้ถูกใช้เเล้ว</span>
//         </div> ');
//         $this->session->set_flashdata('p_no',$p_no);
     
//  }else{
//     $last_id = $this->model->insert_drawing($d_no, $dcn_id, $path, $file);
//         $d_id = $last_id;
//         $result = $this->model->insert_part1($p_no,$p_name,$d_id);
//         $this->session->set_flashdata('success','<div class="alert alert-succes hide-its">  
//           <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
//         </div> ');
       
// }
    
// }     redirect('drawing/add','refresh');    
//     }

    // public function insert2()
    // {
    
    //     $d_no =  $this->input->post('d_no');
    //     $dcn_id =  $this->input->post('dcn_id');
    //     $file_name =  $this->input->post('file_name2');

        
    //     $result = $this->model->insert_drawing($d_no, $dcn_id, $file_name);

    //     redirect('drawing/manage','refresh');
  
    // }


    public function enable(){

      $this->model->CheckPermission($this->session->userdata('su_id'));
      $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
      $d_id = $this->uri->segment('3');
      $search = $this->session->flashdata('search');
      
      $result = $this->model_drawing->enableDrawing($d_id);

      redirect('drawing/show?'.$search.'','refresh');
      
  }

  public function deletedrawing()
  {
      $this->model->CheckPermission($this->session->userdata('su_id'));
      $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
      $d_id = $this->uri->segment('3');
      $search = $this->input->post('search');
      $this->model_drawing->delete_drawing($d_id);
      redirect('drawing/show'.$search.'','refresh');

  }

  public function version_form()
  {
      $this->model->CheckPermission($this->session->userdata('su_id'));
      $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
      $d_id = $this->uri->segment('3');
      $data['result'] = $this->model_drawing->get_drawing_byid($d_id);
      $data['result_dcn'] = $this->model_drawing->get_dcn();
      $data['result_cus'] = $this->model_drawing->get_customers();
      $data['result_type']= $this->model_drawing->get_type_drawing();
      $this->load->view('drawing/add_version',$data);
      $this->load->view('footer');
  } 
    //  public function test()
    // {


    //     $this->load->view('drawing/test');
    //     $this->load->view('footer');
  
    // }


    // public function version_form_v()
    // {
    //     $this->model->CheckPermission($this->session->userdata('su_id'));
    //     $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
    //     $id = $this->uri->segment('3');

    //     $sql =  "SELECT v.v_id, d.d_id, d.d_no, v.dcn_id, dc.dcn_no, v.enable, v.file_name as file,
    //     v.version, v.path_file from version as v
    //     inner join drawing as d on d.d_id = v.d_id
    //     inner join dcn as dc on dc.dcn_id = d.dcn_id
    //     where v.v_id = $id";

    //     $sql1 =  'SELECT * from dcn where delete_flag != 0';
    //     $query = $this->db->query($sql1); 
    //     $data['result_dcn'] = $query->result(); 

    //     $query = $this->db->query($sql); 
    //     $data['result'] = $query->result(); 

    //     $this->load->view('drawing/add_version',$data);
    //     $this->load->view('footer');
  
    // }


    public function update_v()
    {
        $tf_id =  $this->input->post('tf_id');
        $folder = $this->model_drawing->checkfolder($tf_id);
        $config['upload_path']           = './uploads/'.$folder.'/';
        $config['allowed_types']        = '*';
  
        $pos =  $this->input->post('pos');
        $d_id =  $this->input->post('d_id');
        $d_name =  $this->input->post('d_name');
        $d_no =  $this->input->post('d_no');
        $dcn_id =  $this->input->post('dcn_id');
        $cus_id =  $this->input->post('cus_id');
        $tf_id =  $this->input->post('tf_id');
        $version =  $this->input->post('version');
        $path_file =  $this->input->post('path');
        $code =  $this->input->post('file_code');
        $search =  $this->session->flashdata('search');
        $tfold =  $this->input->post('tfold');
        $folderold = $this->model_drawing->checkfolder($tfold);

        if($_FILES['file_name']['name'] != null){
            $file = $_FILES['file_name']['name'];
             $this->load->library('upload', $config);
        $this->upload->initialize($config);
          if ( ! $this->upload->do_upload('file_name'))
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          
          redirect('drawing/show?'.$search.'','refresh');   
          }else{
    $uploaded = $this->upload->data();
    $code = array('filename'  => $uploaded['file_name']);
    foreach ($code as $c) {
      $c = base64_encode(trim($c));
        $this->model_drawing->select_version($d_id);
        $this->model_drawing->update_version($d_id,$d_name,$cus_id, $d_no, $dcn_id, $version, $file, $path_file,$c,$tf_id,$pos);
        redirect('drawing/show?'.$search.'','refresh');
    }
          }
        }else{
            $file =  $this->input->post('file_name2');
          if ($this->input->post('file_name2') == null)
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          
          redirect('drawing/show?'.$search.'','refresh');   
          }else{
        $file_code =  $this->input->post('file_code');
        copy('./uploads/'.$folderold.'/'.$code, './uploads/'.$folder.'/'.$code);
        $this->model_drawing->select_version($d_id);
        $this->model_drawing->update_version($d_id,$d_name,$cus_id, $d_no, $dcn_id, $version, $file, $path_file,$file_code,$tf_id,$pos);
        redirect('drawing/show?'.$search.'','refresh');

          }
        }
       
  
    }

    public function openfile()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $d_id = $this->uri->segment('3');
        $tf_id = $this->model_drawing->get_tfid($d_id);
        $filecode = $this->model_drawing->get_filecode($d_id);
        $filename = $this->model_drawing->get_file($d_id);
        $folder = $this->model_drawing->checkfolder($tf_id);
        

        $path = './uploads/'.$folder.$filecode;
        $open = ("$path");
        $data = file_get_contents("$path");

        if($open){
        $this->model_drawing->download_record($this->session->userdata('su_id'),$this->session->userdata('username'),$filename);
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
        redirect('drawing/show/','refresh');
    }

    public function openfile_v()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $v_id = $this->uri->segment('3');
        $result = $this->model_drawing->get_did($v_id);
        $tf_id = $result->tf_id;
        $filecode = $result->file_code;
        $filename = $result->file_name;
        $folder = $this->model_drawing->checkfolder($tf_id);
        
        $path = './uploads/'.$folder.$filecode;

        $open = ("$path");
        $data = file_get_contents("$path");

        if($open){
        $this->model_drawing->download_record($this->session->userdata('su_id'),$this->session->userdata('username'),$filename);
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
    $this->model_drawing->download_record($this->session->userdata('su_id'),$this->session->userdata('username'),$filename);
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
        $tf_id =  $this->input->post('tf_id');
        $folder = $this->model_drawing->checkfolder($tf_id);
        $config['upload_path']           = './uploads/'.$folder;
        $config['allowed_types']        = '*';

        $d_no =  $this->input->post('d_no');
        $d_name =  $this->input->post('d_name');
        $pos =  $this->input->post('pos');
        $dcn_id =  $this->input->post('dcn_id');
        $cus_id =  $this->input->post('cus_id');
        $p_id =  $this->input->post('p_id');
        $p_no =  $this->input->post('p_no');
        $p_name =  $this->input->post('p_name');
        $file = $_FILES['file_name']['name'];


      $num= $this->db->query("SELECT * FROM drawing where d_no = '$d_no'"); 
  $chk= $num->num_rows();
 if($chk != 0){
    $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้ว</span>
        </div> ');
        $this->session->set_flashdata('d_no',$d_no);
 }else if($chk < 1){
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
          $c = base64_encode(trim($c));
          $last_id = $this->model_drawing->insert_drawing($d_no,$d_name, $dcn_id,$cus_id, $tf_id, $file,$c,$pos);
          $d_id = $last_id;
      }
    $arr_count = sizeof($p_no);
    for($i=0; $i<$arr_count; $i++)
    {
      $pno = $p_no[$i];
      $pname = $p_name[$i];
      $last_id = $this->model_drawing->insert_newpart($pno,$pname);
      if($last_id == false){
        $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
        <span> ชื่อนี้ถูกใช้เเล้ว</span>
      </div> ');
      $this->session->set_flashdata('p_no',$p_no);   
    }else{
      $this->model_drawing->insert_part_drawing($last_id,$d_id);
      }
    }
  
    if($p_id != null){
      foreach($p_id as $p){
        $result = $this->model_drawing->insert_part_drawing($p,$d_id);
        if($result == false){
          $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้ว</span>
        </div>');
        $this->session->set_flashdata('p_no',$p_no);
       }
      }
    }
      $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
        <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
      </div> ');
      
  }else{
    $uploaded = $this->upload->data();
    $code = array('filename'  => $uploaded['file_name']);
    foreach ($code as $c) {
      $c = base64_encode(trim($c));
        $d_id = $this->model_drawing->insert_drawing($d_no,$d_name, $dcn_id, $cus_id, $tf_id, $file, $c,$pos);
    }  
      $this->session->set_flashdata('success','<div class="alert alert-success hide-it">
        <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
      </div> ');
    if($p_no != null || $p_name != null){
      $arr_count = sizeof($p_no);
      for($i=0; $i<$arr_count; $i++)
      {
        $pno = $p_no[$i];
        $pname = $p_name[$i];
        $last_id = $this->model_drawing->insert_newpart($pno,$pname);
        if($last_id == false){
          $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้ว</span>
        </div> ');
        $this->session->set_flashdata('p_no',$p_no);   
      }else{
        $this->model_drawing->insert_part_drawing($last_id,$d_id);
        }
      }
    }
    if($p_id != null){
      foreach($p_id as $p){
        $result = $this->model_drawing->insert_part_drawing($p,$d_id);
        if($result == false){
          $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้ว</span>
        </div>');
        $this->session->set_flashdata('p_no',$p_no);
       }
      }
    }
    
  } 

          }
  

    
} 
   redirect('drawing/add','refresh');    



}
  public function edit()
{
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $search =  $this->input->post('search');
        $data['search'] = $search;
        $d_id = $this->uri->segment('3');
        

        $data['result'] = $this->model_drawing->get_drawing_byid($d_id);
        $data['result_dcn'] = $this->model_drawing->get_dcn();
        $data['result_cus'] = $this->model_drawing->get_customers();
        $data['result_type'] = $this->model_drawing->get_type_drawing();
        $data['result_pd'] = $this->model_drawing->get_part_drawing_byid($d_id);
        $pid = $this->model_drawing->get_pid_bypd($d_id);
        foreach($pid as $p){
          $num[] = $p->p_id;
        }
        if($pid){
          $data['result_p'] = $this->model_drawing->get_nopart($num);
        }else{
          $data['result_p'] = $this->model_drawing->get_part();
        }
           
        $this->load->view('drawing/edit',$data);
        $this->load->view('footer');
  
}

    public function save_edit()
    {
      $tf_id =  $this->input->post('tf_id');
      $folder = $this->model_drawing->checkfolder($tf_id);
      $config['upload_path']           = './uploads/'.$folder;
      $config['allowed_types']        = '*';
      $tfold =  $this->input->post('tfold');
      $folderold = $this->model_drawing->checkfolder($tfold);
        if ($_FILES['file_name']['name'] != null) {
        $file_name2 =  $this->input->post('file_name2');
        unlink('./uploads/'.$folderold.$file_name2);
        $config['overwrite']            = TRUE;
        }
        $search =  $this->session->flashdata('search');
        
        $pos =  $this->input->post('pos');
        $d_id =  $this->input->post('d_id');
        $d_no =  $this->input->post('d_no');
        $p_id =  $this->input->post('p_id');
        $p_no =  $this->input->post('p_no');
        $p_name =  $this->input->post('p_name');
        $d_name =  $this->input->post('d_name');
        $dcn_id =  $this->input->post('dcn_id');
        $cus_id =  $this->input->post('cus_id');
        $path_file =  $this->input->post('path');
        $dcnid =  $this->input->post('dcnid');
        $code =  $this->input->post('file_code');
        
        


        if($_FILES['file_name']['name'] != null){
            $file = $_FILES['file_name']['name'];
             $this->load->library('upload', $config);
        $this->upload->initialize($config);
          if ( !$this->upload->do_upload('file_name'))
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          if( strpos( $search, 'd_id' ) !== false ){
            redirect('drawing/show_v?'.$search.'','refresh');
          }else{
            redirect('drawing/show?'.$search.'','refresh');
          }

          }else{    
            
    if($p_id != null){
      foreach($p_id as $p){
        $result = $this->model_drawing->insert_part_drawing($p,$d_id);
        if($result == false){
          $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้ว</span>
        </div>');
        $this->session->set_flashdata('p_no',$p_no);
       }
      }
    }
    if($p_no != null || $p_name != null){
      $arr_count = sizeof($p_no);
      for($i=0; $i<$arr_count; $i++)
      {
        $pno = $p_no[$i];
        $pname = $p_name[$i];
        $last_id = $this->model_drawing->insert_newpart($pno,$pname);
        if($last_id == false){
          $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้ว</span>
        </div> ');
        $this->session->set_flashdata('p_no',$p_no);   
      }else{
        $this->model_drawing->insert_part_drawing($last_id,$d_id);
        }
      }
    }
    if($this->input->post('chk_uid') != null){
      $del =  $this->input->post('chk_uid');
      foreach($del as $id){
        $this->model_drawing->del_img($id);
      }
    }

    $uploaded = $this->upload->data();
    $code = array('filename'  => $uploaded['file_name']);
    foreach ($code as $c) {
      $c = base64_encode(trim($c));
        $this->model_drawing->save_edit_drawing($d_id, $d_no, $d_name, $dcn_id, $cus_id, $file, $path_file,$c,$tf_id,$pos);
    }
  }
        }else{
            $file =  $this->input->post('file_name2');
          if ($this->input->post('file_name2') == null)
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          }else{
            rename('./uploads/'.$folderold.$file, './uploads/'.$folder.$file);
            $file_code =  $this->input->post('file_code');
            if($p_id != null){
              foreach($p_id as $p){
                $result = $this->model_drawing->insert_part_drawing($p,$d_id);
                if($result == false){
                  $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
                  <span> ชื่อนี้ถูกใช้เเล้ว</span>
                </div>');
                $this->session->set_flashdata('p_no',$p_no);
               }
              }
            }
           
            if($p_no != null || $p_name != null){
              $arr_count = sizeof($p_no);
              for($i=0; $i<$arr_count; $i++)
              {
                $pno = $p_no[$i];
                $pname = $p_name[$i];
                $last_id = $this->model_drawing->insert_newpart($pno,$pname);
                if($last_id == false){
                  $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
                  <span> ชื่อนี้ถูกใช้เเล้ว</span>
                </div> ');
                $this->session->set_flashdata('p_no',$p_no);
              }else{
                $this->model_drawing->insert_part_drawing($last_id,$d_id);
                }
              }
            }
        if($this->input->post('chk_uid') != null){
          $del =  $this->input->post('chk_uid');
          foreach($del as $id){
            $this->model_drawing->del_img($id);
          }
        }
        $file_code = base64_encode(trim($file_code));
        $this->model_drawing->save_edit_drawing($d_id, $d_no, $d_name, $dcn_id, $cus_id, $file, $path_file,$file_code,$tf_id,$pos);
          }
        }
        
        if( strpos( $search, 'd_id' ) !== false ){
          redirect('drawing/show_v?'.$search.'','refresh');
        }else{
          redirect('drawing/show?'.$search.'','refresh');
        }
        
       
    }


       public function edit_v()   
 {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        
        $v_id = $this->uri->segment('3');
        $sql =  "SELECT * from version where v_id = $v_id";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result()[0]; 
        $d_id = $data['result']->d_id;
      

        $sql1 =  "SELECT * from dcn";
        $query = $this->db->query($sql1); 
        $data['result_dcn'] = $query->result(); 

        $sql1 =  "SELECT * from customers";
        $query = $this->db->query($sql1); 
        $data['result_cus'] = $query->result(); 
        $data['result_type'] = $this->model_drawing->get_type_drawing();
        $data['result_pd'] = $this->model_drawing->get_part_drawing_byid($d_id);
        $pid = $this->model_drawing->get_pid_bypd($d_id);
        foreach($pid as $p){
          $num[] = $p->p_id;
        }
        if($pid){
          $data['result_p'] = $this->model_drawing->get_nopart($num);
        }else{
          $data['result_p'] = $this->model_drawing->get_part();
        }
        $this->load->view('drawing/edit_v',$data);
        $this->load->view('footer');
  
    }

        public function save_edit_v()
    {
      $tf_id =  $this->input->post('tf_id');
      $folder = $this->model_drawing->checkfolder($tf_id);
      $config['upload_path']           = './uploads/'.$folder;
        $config['allowed_types']        = '*';
        $tfold =  $this->input->post('tfold');
        $folderold = $this->model_drawing->checkfolder($tfold);
        if ($_FILES['file_name']['name'] != null) {
        $file_name2 =  $this->input->post('file_name2');
        unlink('./uploads/'.$folderold.$file_name2);
        $config['overwrite']            = TRUE;
        }
        
        $v_id =  $this->input->post('v_id');
        $d_no =  $this->input->post('d_no');
        $d_id =  $this->input->post('d_id');
        $d_name =  $this->input->post('d_name');
        $dcn_id =  $this->input->post('dcn_id');
        $cus_id =  $this->input->post('cus_id');
        $path_file =  $this->input->post('path');
        $dcnid =  $this->input->post('dcnid');
        $code =  $this->input->post('code');
        $tf_id =  $this->input->post('tf_id');
        $pos =  $this->input->post('pos');
        $p_id =  $this->input->post('p_id');
        $p_no =  $this->input->post('p_no');
        $p_name =  $this->input->post('p_name');
        $search =  $this->session->flashdata('search');
        

        if($_FILES['file_name']['name'] != null){
            $file = $_FILES['file_name']['name'];
             $this->load->library('upload', $config);
        $this->upload->initialize($config);
          if ( ! $this->upload->do_upload('file_name'))
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          redirect('drawing/show_v?'.$search.'','refresh');   
          }else{
      if($p_id != null){
        foreach($p_id as $p){
          $result = $this->model_drawing->insert_part_drawing($p,$d_id);
          if($result == false){
            $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
            <span> ชื่อนี้ถูกใช้เเล้ว</span>
          </div>');
          $this->session->set_flashdata('p_no',$p_no);
         }
        }
      }
      if($p_no != null || $p_name != null){
        $arr_count = sizeof($p_no);
        for($i=0; $i<$arr_count; $i++)
        {
          $pno = $p_no[$i];
          $pname = $p_name[$i];
          $last_id = $this->model_drawing->insert_newpart($pno,$pname);
          if($last_id == false){
            $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
            <span> ชื่อนี้ถูกใช้เเล้ว</span>
          </div> ');
          $this->session->set_flashdata('p_no',$p_no);   
        }else{
          $this->model_drawing->insert_part_drawing($last_id,$d_id);
          }
        }
      }
      if($this->input->post('chk_uid') != null){
        $del =  $this->input->post('chk_uid');
        foreach($del as $id){
          $this->model_drawing->del_img($id);
        }
      }
    
    $uploaded = $this->upload->data();
    $code = array('filename'  => $uploaded['file_name']);
    foreach ($code as $c) {
      $c = base64_encode(trim($c));
        $this->model_drawing->save_edit_drawing_v($v_id, $d_no, $d_name, $dcn_id, $cus_id, $file, $path_file,$c,$tf_id,$pos);
        redirect('drawing/show_v?'.$search.'','refresh');   
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
          redirect('drawing/show_v?'.$search.'','refresh');     
          }else{
            if($p_id != null){
              foreach($p_id as $p){
                $result = $this->model_drawing->insert_part_drawing($p,$d_id);
                if($result == false){
                  $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
                  <span> ชื่อนี้ถูกใช้เเล้ว</span>
                </div>');
                $this->session->set_flashdata('p_no',$p_no);
               }
              }
            }
            if($p_no != null || $p_name != null){
              $arr_count = sizeof($p_no);
              for($i=0; $i<$arr_count; $i++)
              {
                $pno = $p_no[$i];
                $pname = $p_name[$i];
                $last_id = $this->model_drawing->insert_newpart($pno,$pname);
                if($last_id == false){
                  $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
                  <span> ชื่อนี้ถูกใช้เเล้ว</span>
                </div> ');
                $this->session->set_flashdata('p_no',$p_no);   
              }else{
                $this->model_drawing->insert_part_drawing($last_id,$d_id);
                }
              }
            }
            if($this->input->post('chk_uid') != null){
              $del =  $this->input->post('chk_uid');
              foreach($del as $id){
                $this->model_drawing->del_img($id);
              }
            }
            rename('./uploads/'.$folderold.$file, './uploads/'.$folder.$file);
            $c =  $this->input->post('file_code');
            $c = base64_encode(trim($c));
        $this->model_drawing->save_edit_drawing_v($v_id, $d_no, $d_name, $dcn_id, $cus_id, $file, $path_file,$c,$tf_id,$pos);
        
        redirect('drawing/show_v?'.$search.'','refresh');   

          }
        }
       
  
    }
}

