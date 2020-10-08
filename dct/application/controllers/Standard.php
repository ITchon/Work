<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Standard   extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->helper('download');
        $this->load->library('upload');
        $this->load->database(); 
        $this->load->model('model');
        $this->load->model('model_standard');
        $this->model->CheckSession();
        $this->model->load_menu();
        $this->model->button_show($this->session->userdata('su_id'),14);
    }
	public function index()
  {	

	}

    
	public function manage()
    {	
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $sql =  'SELECT std.std_id,std.file_name,std.std_no,std.std_name,std.rev,std.cus_rev,dc.dcn_no,cus.cus_name as cusname
        ,f.name as type,f.folder_name,fg.foldergroup_name
        FROM standard as std
        left join customers as cus on cus.cus_id = std.cus_id
        left join dcn as dc on dc.dcn_id = std.dcn_id
        left join folder as f on f.f_id = std.f_id
        left join folder_group as fg on fg.fg_id = f.fg_id
        where std.delete_flag !=0';
        $query = $this->db->query($sql); 
        $data['result'] = $query->result();
        
        $this->load->view('standard/manage',$data);//bring $data to user_data 
        $this->load->view('standard/img_modal');
        $this->load->view('footer');
        
    }

    public function show_v()
    {   
              $this->model->CheckPermission($this->session->userdata('su_id'));
              $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
              $std_id =  $this->input->get('std_id');
      
              
              
    
              $params = $_SERVER['QUERY_STRING'];
              $this->session->set_flashdata('search',$params);
              
              $d_id = intval(preg_replace('/[^0-9]+/', '', $params), 10);
        
              $data['result_last'] = $this->model_standard->get_lastrev_standard($std_id);
              $data['result_rev'] = $this->model_standard->get_revision_standard($std_id);
              $this->load->view('standard/img_modal');
              $this->load->view('standard/show_v',$data);
              $this->load->view('footer'); 
      
    }


    public function add()
    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $data['result_cus'] = $this->model_standard->get_customers();
        $data['result_fol'] = $this->model_standard->get_folder();
        $data['result_dcn'] = $this->model_standard->get_dcn();
        $this->load->view('standard/add',$data);//bring $data to user_data 
        $this->load->view('footer');
    }

    public function add_version()
    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $id = $this->uri->segment('3');
        $sql =  "SELECT std.std_id,std.std_no,std.std_name,std.dcn_id,std.enable,cus.cus_id,
        cus.cus_name,std.file_name ,std.f_id,std.cus_rev,std.rev
        from standard as std
        inner join customers as cus on cus.cus_id = std.cus_id
        where std_id = $id";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result()[0]; 

        $data['result_cus'] = $this->model_standard->get_customers();
        $data['result_fol'] = $this->model_standard->get_folder();
        $data['result_dcn'] = $this->model_standard->get_dcn();
        $this->load->view('standard/add_version',$data);//bring $data to user_data 
        $this->load->view('footer');
    }


    public function insert()
    {
        $f_id =  $this->input->post('f_id');
        
        $result = $this->model_standard->get_folder_by($f_id);
        $folderg = $result->folg;
        $folder = $result->fol;

        $config['upload_path']           = './uploads/'.$folderg.'/'.$folder;
        $config['allowed_types']        = '*';


        $cus_id =  $this->input->post('cus_id');
        $std_no =  $this->input->post('std_no');
        $std_name =  $this->input->post('std_name');
        $dcn_id =  $this->input->post('dcn_id');
        $cus_rev =  $this->input->post('cus_rev');
        $file_name = $_FILES['file_name']['name'];
            $remove[] = "'";
            $remove[] = '"';
            $remove[] = ";";
            $remove[] = "[";
            $remove[] = "]";
            $remove[] = "&";
            $file_name = str_replace(' ', '_', $file_name);
            $file_name = str_replace( $remove, "", $file_name );
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('file_name'))
            {
            echo "<script>";
            echo 'alert(" File Failed ");';
            
            echo '</script>';
            exit;
            redirect('standard/add','refresh');   
            }
            else{
            $res = $this->model_standard->insert($cus_id,$std_no,$std_name,$dcn_id,$cus_rev,$file_name,$f_id);
            if($res != true){
            echo "<script>";
            echo 'alert(" What wrong ");';
            echo 'history.go(-1);';
            echo '</script>';
            redirect('standard/add','refresh');   
            }else{
                $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
                <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
              </div> ');
            }

            }
            redirect('standard/add','refresh');   


    }


    public function delete()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $this->model_standard->delete($this->uri->segment('3'));
        redirect('standard/manage');
    }


    public function edit()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id = $this->uri->segment('3');
        $sql =  "SELECT std.std_id,std.std_no,std.std_name,std.dcn_id,cus.cus_id,
        cus.cus_name,std.file_name ,std.f_id,std.cus_rev,std.rev
        from standard as std
        inner join customers as cus on cus.cus_id = std.cus_id
        where std_id = $id";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result()[0]; 

        $data['result_cus'] = $this->model_standard->get_customers();
        $data['result_fol'] = $this->model_standard->get_folder();
        $data['result_dcn'] = $this->model_standard->get_dcn();

        $this->load->view('standard/edit',$data);
        $this->load->view('footer');
  
    }

    public function edit_v()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id = $this->uri->segment('3');
        $sql =  "SELECT rs.rs_id,rs.std_no,rs.std_name,rs.dcn_no,
        rs.cus_name,rs.file_name ,rs.f_id,rs.cus_rev,rs.rev
        from revision_standard as rs
        where rs_id = $id";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result()[0]; 

        $data['result_cus'] = $this->model_standard->get_customers();
        $data['result_fol'] = $this->model_standard->get_folder();
        $data['result_dcn'] = $this->model_standard->get_dcn();

        $this->load->view('standard/edit_v',$data);
        $this->load->view('footer');
  
    }

    public function save_edit()
    {
        $f_id =  $this->input->post('f_id');
        $res = $this->model_standard->get_folder_by($f_id);
        $folderg = $res->folg;
        $folder = $res->fol;

        $config['upload_path']           = './uploads/'.$folderg.'/'.$folder;
        $config['allowed_types']        = '*';
        $config['overwrite']            = TRUE;

        $fold =  $this->input->post('fold');
        $resold = $this->model_standard->get_folder_by($fold);
        $foldergold = $resold->folg;
        $folderold = $resold->fol;


        $std_id =  $this->input->post('std_id');
        $cus_id =  $this->input->post('cus_id');
        $std_no =  $this->input->post('std_no');
        $std_name =  $this->input->post('std_name');
        $dcn_id =  $this->input->post('dcn_id');
        $cus_rev =  $this->input->post('cus_rev');
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
              echo 'history.go(-1);';
              echo '</script>';
        }else{
        $this->model_standard->save_edit($std_id,$cus_id,$std_no,$std_name,$dcn_id,$cus_rev,$file,$f_id);
        $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
        <span> แก้ไขข้อมูลเรียบร้อยเเล้ว </span>
      </div> ');
        }
    }else{
        copy('./uploads/'.$foldergold.'/'.$folderold.'/'.$file_name, './uploads/'.$folderg.'/'.$folder.'/'.$file_name);
        $this->model_standard->save_edit($std_id,$cus_id,$std_no,$std_name,$dcn_id,$cus_rev,$file_name,$f_id);
        $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
        <span> แก้ไขข้อมูลเรียบร้อยเเล้ว </span>
      </div> ');
    }
        

        

        
        redirect('standard/manage');
    }

    public function save_edit_v()
    {
        $f_id =  $this->input->post('f_id');
        $res = $this->model_standard->get_folder_by($f_id);
        $folderg = $res->folg;
        $folder = $res->fol;

        $config['upload_path']           = './uploads/'.$folderg.'/'.$folder;
        $config['allowed_types']        = '*';
        $config['overwrite']            = TRUE;

        $fold =  $this->input->post('fold');
        $resold = $this->model_standard->get_folder_by($fold);
        $foldergold = $resold->folg;
        $folderold = $resold->fol;


        $rs_id =  $this->input->post('rs_id');
        $cus_name =  $this->input->post('cus_name');
        $std_no =  $this->input->post('std_no');
        $std_name =  $this->input->post('std_name');
        $dcn_no =  $this->input->post('dcn_no');
        $cus_rev =  $this->input->post('cus_rev');
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
              echo 'history.go(-1);';
              echo '</script>';
        }else{
        $this->model_standard->save_edit_v($rs_id,$cus_name,$std_no,$std_name,$dcn_no,$cus_rev,$file,$f_id);
        $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
        <span> แก้ไขข้อมูลเรียบร้อยเเล้ว </span>
      </div> ');
        }
    }else{
        copy('./uploads/'.$foldergold.'/'.$folderold.'/'.$file_name, './uploads/'.$folderg.'/'.$folder.'/'.$file_name);
        $this->model_standard->save_edit_v($rs_id,$cus_name,$std_no,$std_name,$dcn_no,$cus_rev,$file_name,$f_id);
        $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
        <span> แก้ไขข้อมูลเรียบร้อยเเล้ว </span>
      </div> ');
    }
        

        

        
        redirect('standard/manage');
    }


    public function update_v()
    {
        $f_id =  $this->input->post('f_id');
        $res = $this->model_standard->get_folder_by($f_id);
        $folderg = $res->folg;
        $folder = $res->fol;

        $config['upload_path']           = './uploads/'.$folderg.'/'.$folder;
        $config['allowed_types']        = '*';
        $config['overwrite']            = TRUE;

        $fold =  $this->input->post('fold');
        $resold = $this->model_standard->get_folder_by($fold);
        $foldergold = $resold->folg;
        $folderold = $resold->fol;


        $std_id =  $this->input->post('std_id');
        $cus_id =  $this->input->post('cus_id');
        $std_no =  $this->input->post('std_no');
        $std_name =  $this->input->post('std_name');
        $dcn_id =  $this->input->post('dcn_id');
        $cus_rev =  $this->input->post('cus_rev');
        $rev =  $this->input->post('version');
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
              echo 'history.go(-1);';
              echo '</script>';
        }else{
            $last_id = $this->model_standard->add_revision($std_id);
            $this->model_standard->add_version($std_id,$last_id);
            $this->model_standard->update_version($std_id,$cus_id,$std_no,$std_name,$dcn_id,$cus_rev,$rev,$file,$f_id);
        }
    }else{
        copy('./uploads/'.$foldergold.'/'.$folderold.'/'.$file_name, './uploads/'.$folderg.'/'.$folder.'/'.$file_name);
        $last_id = $this->model_standard->add_revision($std_id);
            $this->model_standard->add_version($std_id,$last_id);
            $this->model_standard->update_version($std_id,$cus_id,$std_no,$std_name,$dcn_id,$cus_rev,$rev,$file_name,$f_id);
    }
   
        redirect('standard/manage');
    }

    public function openfile()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $std_id = $this->uri->segment('3');
        $f_id = $this->model_standard->get_fid($std_id);
        // $filecode = $this->model_drawing->get_filecode($d_id);
        $filename = $this->model_standard->get_file($std_id);
        $res = $this->model_standard->checkfolder($f_id);
        $folder = $res[0]->folder_name;
        $folderg = $res[0]->foldergroup_name;
        
        $path = './uploads/'.$folderg.'/'.$folder.'/'.$filename ;
        $open = ("$path");
        $data = file_get_contents("$path");
        
        if($open){
        $this->model_standard->download_record($this->session->userdata('su_id'),$this->session->userdata('username'),$filename);
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
        redirect('standard/manage/','refresh');
    }

    public function openfile_v()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $rs_id = $this->uri->segment('3');
        $result = $this->model_standard->get_file_rs($rs_id);
        $f_id = $result->f_id;
        // $filecode = $result->file_code;
        $filename = $result->file_name;
        $res = $this->model_standard->checkfolder($f_id);
        $folder = $res[0]->folder_name;
        $folderg = $res[0]->foldergroup_name;
        
        $path = './uploads/'.$folderg.'/'.$folder.'/'.$filename ;
        $open = ("$path");
        $data = file_get_contents("$path");

        if($open){
        $this->model_standard->download_record($this->session->userdata('su_id'),$this->session->userdata('username'),$filename);
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
        redirect('standard/show/','refresh');
    }





}

