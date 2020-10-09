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
        $this->model->CheckSession();
        $this->model->load_menu();
        $this->model->button_show($this->session->userdata('su_id'),8);
    }

    public function exportCSV(){ 
        // file name 
        $filename = 'DCN '.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");

        $text = null;

        // get data 
        $drwdata = $this->model_dcn->get_dcn_byid($text);
     
        // file creation 
        $file = fopen('php://output', 'w');
        $header = array("DCN No","DCN Name","Model","Customer","Status"); 
        fputcsv($file, $header);
        foreach ($drwdata as $r){ 
          $status = ($r->enable == '1') ? "Enable" : "Disable";
          $a = array($r->dcn_no,$r->dcn_name,$r->model,$r->cus_name,$status);
          fputcsv($file,$a); 
        } 
        fclose($file); 
        exit; 
       }


    public function index()
    {   

    }
        public function manage()
    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $s_dcno = $this->input->get('s_dcno');  
        $s_name = $this->input->get('s_name');

        $params = $_SERVER['QUERY_STRING'];
        
        $this->session->set_flashdata('search',$params);
    
        $data['s_dcno'] = $s_dcno;
        $data['s_name'] = $s_name;

        if($this->input->get('s_dcno') == null){
            $s_dcno = 'null';
        }
        
        if($this->input->get('s_name') == null){
          $s_name = 'null';
        }
        if($this->input->get('s_dcno') == null && $this->input->get('s_name') == null){
        $s_name = '';
        $s_dcno = '';

        }


        $text = null;
        $dcn_id = null;
        $data['chk'] = $dcn_id;
        if($this->uri->segment('3')){
            $dcn_id = $this->uri->segment('3');
            $type = is_numeric($dcn_id);
            if ($type == 1) {
            $text = "and dc.dcn_id = '$dcn_id'";
            }else{
            $text = "and dc.dcn_no = '$dcn_id' ";
            }
            $data['chk'] = $dcn_id;
        }
        if($this->input->get('s_dcno') != null || $this->input->get('s_name') != null ){
        $data['result'] = $this->model_dcn->dcn_search($s_dcno,$s_name);
      }else{
        $data['result'] = $this->model_dcn->get_dcn_byid($text); 
      }
        
        $this->load->view('dcn/img_modal');//bring $data to user_data 
        $this->load->view('dcn/show',$data);//bring $data to user_data 
        $this->load->view('footer');

        
    }

    public function add()
    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));


        $sql = "SELECT * FROM folder where fg_id = 2 AND delete_flag != 0";
        $query = $this->db->query($sql);
        $data['result_folder'] = $query->result(); 
        $data['result_cus'] = $this->model_dcn->get_customers();

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
        
        $chk = $this->session->flashdata('chk'); 
        if($chk == null){
            $chk = '';
        }

        $id =  $this->uri->segment('3');
        $this->model_dcn->delete_dcn($id);
        redirect('dcn/manage/'.$chk.'','refresh');
    }


    public function edit_dcn()   
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $id = $this->uri->segment('3');
        
        $sql =  "SELECT * from dcn
        where dcn_id = $id";
        $query = $this->db->query($sql); 
        $chk = $this->session->flashdata('chk'); 
        $data['chk'] = $chk;
        $data['result'] = $query->result()[0]; 
        $data['result_folder'] =  $this->model_dcn->get_folder_dcn($id);
        $data['result_cus'] =  $this->model_dcn->get_customers();
        $this->load->view('dcn/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit_dcn()
    {
        $f_id =  $this->input->post('f_id');
        $resnew = $this->model_dcn->get_folder_by($f_id);
        $folder = $resnew->fol;

        $config['upload_path']           = './uploads/'.'DCN'.'/'.$folder;
        $config['allowed_types']        = '*';
        $config['overwrite']            = TRUE;

        $fold =  $this->input->post('fold');
        $resold = $this->model_dcn->get_folder_by($fold);
        $folderold = $resold->fol;
          // if ($_FILES['file_name']['name'] != null) {
          // $file_name2 =  $this->input->post('file_name2');
          // unlink('./uploads/'.'DCN'.'/'.$folderold.'/'.$file_name2);
          
          // }
        $chk =  $this->input->post('chk');
        if($chk == null){
            $chk = '';
        }
        $dcn_id =  $this->input->post('dcn_id');
        $dcn_no  =  $this->input->post('dcn_no');
        $dcn_name  =  $this->input->post('dcn_name');
        $model  =  $this->input->post('model');
        $cus_id = $this->input->post('cus_id');

        $file_name =  $this->input->post('file_name2');
        if($_FILES['file_name']['name'] != null){
            $file = $_FILES['file_name']['name'];
            $remove[] = "'";
            $remove[] = '"';
            $remove[] = ";";
            $remove[] = "[";
            $remove[] = "]";
            $remove[] = "&";
            $file = str_replace(' ', '_', $file);
            $file = str_replace( $remove, "", $file );

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
          if ( !$this->upload->do_upload('file_name'))
          {
          echo "<script>";
          echo 'alert(" File Failed ");';
          echo '</script>';
          redirect('drawing/edit_v/'.$chk.'','refresh');
          }else{
          $this->model_dcn->save_dcn($dcn_id,$dcn_no,$dcn_name,$model,$cus_id,$file,$f_id);
          $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
        <span> แก้ไขข้อมูลเรียบร้อยเเล้ว </span>
      </div> ');
          }
        }else{
         copy('./uploads/'.'DCN'.'/'.$folderold.'/'.$file_name, './uploads/'.'DCN'.'/'.$folder.'/'.$file_name);
         $this->model_dcn->save_dcn($dcn_id,$dcn_no,$dcn_name,$model,$cus_id,$file_name,$f_id);
         $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
        <span> แก้ไขข้อมูลเรียบร้อยเเล้ว </span>
      </div> ');
        }
        redirect('dcn/manage/'.$chk.'','refresh');
  
    }

    public function enable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $search = $this->session->flashdata('search');
        $this->session->set_flashdata('search',$search);

        $result = $this->model_dcn->enableDcn($uid);
        $chk = $this->session->flashdata('chk');
        if($chk!=null){
            redirect('dcn/manage/'.$chk.'','refresh');

        }else{
             redirect('dcn/manage?'.$search.'','refresh');
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
        $result = $this->model_dcn->get_folder_by($f_id);
        $folderg = $result->folg;
        $folder = $result->fol;

        $config['upload_path']           = './uploads/'.$folderg.'/'.$folder;
        $config['allowed_types']        = '*';
        $config['overwrite']            = TRUE;

        
        
        $dcn_no =  $this->input->post('dcn_no');
        $dcn_name =  $this->input->post('dcn_name');
        $model =  $this->input->post('model');
        $cus_id =  $this->input->post('cus_id');
        $file = $_FILES['file_name']['name'];
            $remove[] = "'";
            $remove[] = '"';
            $remove[] = ";";
            $remove[] = "[";
            $remove[] = "]";
            $remove[] = "&";

            $file = str_replace(' ', '_', $file);
            $file = str_replace( $remove, "", $file );

    $num= $this->db->query("SELECT * FROM dcn where dcn_no = '$dcn_no' AND delete_flag != 0"); 
  $chk= $num->num_rows();
 if($chk >= 1){
    $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> Numberนี้ถูกใช้เเล้ว</span>
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
            redirect('dcn/add','refresh');   
            }
            else
            {
                $uploaded = $this->upload->data();
    $code = array('filename'  => $uploaded['file_name']);
    foreach ($code as $c) {
        $result = $this->model_dcn->insert_dcn($dcn_no,$dcn_name,$model,$cus_id,$file,$c,$f_id);
    }
            $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
          <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
        </div> ');
            }

    
}     
redirect('dcn/add','refresh');   

    }

}

