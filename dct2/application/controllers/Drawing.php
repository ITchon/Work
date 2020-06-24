<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drawing extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
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
        $id = $this->uri->segment('3');
        $dcn_id =  $this->input->post('dcn_id');
        $d_id =  $this->input->post('d_id');
        $name =  $this->input->post('name');
        $search =$this->input->post('p_no');
        $p_id = $this->input->post('p_id');
        $d_no = $this->input->post('d_no');
        
        if($this->session->flashdata('name')){
            $gg = $this->session->flashdata('name');
            $name = $gg;
        }
        if($this->session->flashdata('dcn_id')){
            $dcn = $this->session->flashdata('dcn_id');
            $dcn_id = $dcn;
        }
        if($this->session->flashdata('name')=='Version'){
            $p_id = $this->session->flashdata('p_id');
            $d_id = $this->session->flashdata('d_id');
        }
        if($this->session->flashdata('name')=='Drawing'){
            $d_id = $this->session->flashdata('d_id');

        }
         if($name == 'Drawing'){
            $search = $d_no;
            $data['d_id'] = $d_id;  
            $data['dcn_id'] = $dcn_id;
            $data['search'] = $search;  
            $data['name'] = $name;  
            $data['title'] = $search;  
            $data['result_dcn'] = $this->model->get_dcn(); 
            if(isset($dcn_id)){
            $data['result'] = $this->model->get_dcn_by($dcn_id,$search); 
            }else{
            $data['result'] = $this->model->get_drawing_by($d_id,$search); 
            }

        $this->load->view('drawing/show',$data);//bring $data to user_data 
        }else if($name == 'Version'){
            $data['p_id'] = $p_id;
            $data['d_id'] = $d_id;  
            $data['search'] = $search;  
            $data['name'] = $name; 
            $data['title'] = $search;  
            $data['result_dcn'] = $this->model->get_dcn(); 
            $data['result'] = $this->model->get_drawing_ver($d_id,$search,$p_id); 
            $this->load->view('drawing/show',$data);//bring $data to user_data 
        }else if($name == 'DCN'){
            $data['dcn'] = $dcn_id;
            $data['dcn_id'] = $dcn_id;  
            $data['search'] = $search;
            $data['name'] = $name;   
            $data['result_dcn'] = $this->model->get_dcn(); 
            if($search != null){
                $data['result'] = $this->model->get_dcn_by($dcn_id,$search); 
            }else{
                $data['result'] = $this->model->get_dcn_byid($dcn_id);
            }
            
        $this->load->view('drawing/show',$data);//bring $data to user_data 
        }else if($name == 'Part'){
            $d_id = $this->input->post('d_id');
            $p_no = $this->input->post('p_no');
            $dcn_id =  $this->input->post('dcn_id');
            $search = $p_no;
            $data['d_id'] = $d_id; 
            $data['dcn_id'] = $dcn_id;   
            $data['search'] = $search;  
            $data['name'] = $name; 
            $data['title'] = $search;  
            $data['result_dcn'] = $this->model->get_dcn(); 
            if(isset($dcn_id)){
                $data['result'] = $this->model->get_dcn_p($dcn_id,$search);
            }else{
                $data['result'] = $this->model->get_part_by($d_id,$search); 
            }
            
        $this->load->view('drawing/show',$data);//bring $data to user_data 

        }else if($this->uri->segment('3')){
            $dcn_id = $this->uri->segment('3');
            $data['d_id'] = $d_id;  
            $data['search'] = $search;  
            $data['name'] = $name; 
            $data['title'] = $search;  
            $data['result_dcn'] = $this->model->get_dcn(); 

            $data['result'] = $this->model->get_drawing_by($dcn_id,$search);

            
            $this->load->view('drawing/show',$data);//bring $data to user_data 
        }else{
        $data['result'] = $this->model->get_drawing(); 
        $this->load->view('drawing/manage',$data);//bring $data to user_data 
    }
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

        $last_id = $this->model->insert_drawing($d_no, $dcn_id, $path, $file);
        $d_id = $last_id;

        $this->model->insert_part1($p_no,$p_name,$d_id);

        redirect('drawing/manage','refresh');
  
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
        $dcn_id =  $this->input->post('dcn_id');

        if($this->input->post('dcn_id')){
        $result = $this->model->enableDrawing($d_id);
        $data = "DCN";
        $this->session->set_flashdata('name',$data);
        $this->session->set_flashdata('dcn_id',$dcn_id);
        redirect('drawing/manage/','refresh');
        }
        else{
        $result = $this->model->enableDrawing($d_id);
        $data = "Drawing";
        $this->session->set_flashdata('name',$data);
        $this->session->set_flashdata('d_id',$d_id);
            redirect('drawing/manage/','refresh');
        }
        
        



    }

    public function disable(){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));
        $d_id = $this->input->post('d_id');
        $dcn_id =  $this->input->post('dcn_id');

        if($this->input->post('dcn_id')){
        $result = $this->model->disableDrawing($d_id);

        $data = "DCN";
        $this->session->set_flashdata('name',$data);
        $this->session->set_flashdata('dcn_id',$dcn_id);
        redirect('drawing/manage/','refresh');
        }
        else{
        $result = $this->model->disableDrawing($d_id);
        $data = "Drawing";
        $this->session->set_flashdata('name',$data);
        $this->session->set_flashdata('d_id',$d_id);
        redirect('drawing/manage/','refresh');
        }
        
        

    }

    public function enable_v(){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));
        $d_id = $this->input->post('d_id');
        $v_id =  $this->input->post('v_id');
        $p_id =  $this->input->post('p_id');


        $result = $this->model->enableDrawing_v($v_id);

        $data = "Version";
        $this->session->set_flashdata('name',$data);
        $this->session->set_flashdata('p_id',$p_id);
        $this->session->set_flashdata('d_id',$d_id);

        redirect('drawing/manage/','refresh');

    }

    public function disable_v(){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));
        $d_id = $this->input->post('d_id');
        $v_id =  $this->input->post('v_id');
        $p_id =  $this->input->post('p_id');


        $result = $this->model->disableDrawing_v($v_id);

        $data = "Version";
        $this->session->set_flashdata('name',$data);
        $this->session->set_flashdata('p_id',$p_id);
        $this->session->set_flashdata('d_id',$d_id);

        redirect('drawing/manage/','refresh');

    }


    public function deletedrawing()
    {
        $id = $this->uri->segment('3');

        $this->model->delete_drawing($id);
        redirect('drawing/manage/'.$id.'','refresh');

    }

    public function deletedrawing_v()
    {
        $id = $this->uri->segment('3');

        $sql =  "SELECT * from version as v where v.v_id = '$id' ";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $d_id =  $data['result'][0]->d_id;

        $this->model->delete_drawing_v($id);
        redirect('drawing/manage/'.$d_id.'','refresh');

    }


    public function version_form()
    {
        $id = $this->uri->segment('3');

        $sql =  "SELECT d.d_id, d.d_no, d.dcn_id, d.enable, d.file_name as file, dc.dcn_no, d.version,
        d.path_file from drawing as d
          inner join dcn as dc on dc.dcn_id = d.dcn_id
          where d.d_id = $id";

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $dcn =  $data['result'][0]->dcn_id;


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

        $this->model->select_version($d_id);
        $this->model->update_version($d_id, $d_no, $dcn_id, $version, $file_name, $path_file);
        redirect('drawing/manage');


  
    }


    public function openfile()
    {
        $d_id =  $this->input->post('d_id');
        $file =  $this->input->post('file');
        $path = $this->input->post('path');
        $open = ("$path$file");
        exec($open);
        if($open){
            echo '<script language="javascript">';
                echo 'history.go(-1);';
                echo '</script>';
        }else{
            echo "<script>";
            echo 'alert("Data not found.");';
            echo '</script>';
        }

    }

    public function open_dcn()
    {
        $dcn_id =  $this->input->post('dcn_id');

        $sql =  "SELECT * from dcn where dcn_id = '$dcn_id' ";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $path =  $data['result'][0]->path_file;
        $file =  $data['result'][0]->file_name;

        $open = ("$path$file");

        exec($open);
        if($open){
            echo '<script language="javascript">';
                echo 'history.go(-1);';
                echo '</script>';
        }else{
            echo "<script>";
            echo 'alert("Data not found.");';
            echo '</script>';
        }
  
    }



}

