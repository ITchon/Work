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
        $title =  $this->input->post('title');
        if($name == 'DCN'){
          $sql =  "SELECT d.d_id, d.d_no, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no 
          from drawing as d
          inner join dcn as dc on dc.dcn_id = d.dcn_id
          inner join part as p on p.d_id = d.d_id 
          where d.delete_flag != 0 AND d.dcn_id = $dcn_id";
               $data['title'] = $title ;
               $data['name'] = $name ;
               $sql1 =  'SELECT * from dcn where delete_flag != 0';
        $query = $this->db->query($sql1); 
        $data['result_dcn'] = $query->result(); 

       $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 


        $this->load->view('drawing/show',$data);//bring $data to user_data 
        $this->load->view('footer');
        }
        else if($name == 'Part'){
            $sql =  "SELECT d.d_id, d.d_no, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no 
          from drawing as d
          inner join dcn as dc on dc.dcn_id = d.dcn_id
          inner join part as p on p.d_id = d.d_id 
          where d.delete_flag != 0 AND d.d_id = $d_id";
                 $data['title'] = $title ;
                 $data['name'] = $name ;
                 $sql1 =  'SELECT * from dcn where delete_flag != 0';
        $query = $this->db->query($sql1); 
        $data['result_dcn'] = $query->result(); 

       $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 


        $this->load->view('drawing/show',$data);//bring $data to user_data 
        $this->load->view('footer');


        }
         else if($name == 'Drawing'){
            $d_id = $this->input->post('d_id');
            $sql =  "SELECT d.d_id, d.d_no, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no
          from drawing as d
          inner join dcn as dc on dc.dcn_id = d.dcn_id
          inner join part as p on p.d_id = d.d_id 
          where d.delete_flag != 0 AND d.d_id = $d_id";
                 $data['title'] = $title ;
                 $data['name'] = $name ;
                 $sql1 =  'SELECT * from dcn where delete_flag != 0';
        $query = $this->db->query($sql1); 
        $data['result_dcn'] = $query->result(); 

       $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 


        $this->load->view('drawing/show',$data);//bring $data to user_data 
        $this->load->view('footer');


        }
        else if($this->uri->segment('3')){
            $id = $this->uri->segment('3');
        $sql =  "SELECT d.d_id, d.d_no, d.dcn_id, d.enable, d.path_file, d.file_name, d.version, p.p_no,'v_id'
            from drawing as d
            inner join dcn on dcn.dcn_id = d.dcn_id
            inner join part as p on p.d_id = d.d_id 
            where d.delete_flag != 0 AND d.d_id = $id
            UNION
                SELECT v.d_id, v.d_no, v.dcn_id, v.enable, v.path_file, v.file_name, v.version,p.p_no, v.v_id
         from version as v
         inner join dcn as dc on dc.dcn_id = v.dcn_id
         inner join part as p on p.d_id = v.d_id 
         where v.delete_flag != 0 AND v.d_id = $id
         ORDER by version DESC";
                 $data['title'] = $title ;
                 $data['name'] = $name ;
                 

       $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 


        $this->load->view('drawing/show',$data);//bring $data to user_data 
        $this->load->view('footer');

        }
        else{
            $sql =  "SELECT *
          from drawing as d
          where d.delete_flag != 0";

       $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 


        $this->load->view('drawing/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
        }

        
        
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
        $_FILE = $_FILES['file_name']['name'];

        $config['upload_path']          = './uploads/';
                $config['allowed_types']        = '*';
                $config['max_size']             = 10000;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('file_name'))
                {
                   
                        $data = array('upload_data' => $this->upload->data());
                        //$this->load->view('drawing/manage', $data);
                }


        $result = $this->model->insert_drawing($d_no, $dcn_id, $_FILE);

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


    public function enable($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));
        $result = $this->model->enableDrawing($uid);

        if($result!=FALSE){
            redirect('drawing/manage/'.$uid.'','refresh');
        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('drawing/manage/'.$uid.'','refresh');
        }
    }

    public function disable($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $result = $this->model->disableDrawing($uid);


        if($result!=FALSE){
            redirect('drawing/manage/'.$uid.'','refresh');
            

        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('drawing/manage/'.$uid.'','refresh');

        }
    }

    public function enable_v($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $sql =  "SELECT * from version as v
        where v.v_id = $uid";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $d_id =  $data['result'][0]->d_id;

        $result = $this->model->enableDrawing_v($uid);

        if($result!=FALSE){
            redirect('drawing/manage/'.$d_id.'','refresh');

        }else{
        
            echo "<script>alert('Simting wrong')</script>";
       redirect('drawing/manage/'.$d_id.'','refresh');
        }
    }

    public function disable_v($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $sql =  "SELECT * from version as v
        where v.v_id = $uid";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $d_id =  $data['result'][0]->d_id;

        $result = $this->model->disableDrawing_v($uid);

        if($result!=FALSE){
            redirect('drawing/manage/'.$d_id.'','refresh');
            
        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('drawing/manage/'.$d_id.'','refresh');

        }
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

