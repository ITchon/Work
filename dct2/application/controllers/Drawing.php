<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drawing extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->model->CheckSession();
        $menu['menu'] = $this->model->showmenu();
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
        $name =  $this->input->post('name');
        $title =  $this->input->post('title');
        if($name == 'DCN'){
          $sql =  "SELECT d.d_id, d.d_no, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version from drawing as d
          inner join dcn as dc on dc.dcn_id = d.dcn_id
          where d.delete_flag != 0 AND d.dcn_id = $dcn_id";
               $data['title'] = $title ;
               $data['name'] = $name ;
        }
        else if(isset($id)){
            $sql =  "SELECT d.d_id, d.d_no, d.enable, d.file_name, d.version, dcn.dcn_no,'v_id'
            from drawing as d
            inner join dcn on dcn.dcn_id = d.dcn_id
            where d.delete_flag != 0 AND d.d_id = $id
            UNION
    SELECT v.d_id, v.d_no, v.enable, v.file_name, v.version, dc.dcn_no, v.v_id
    from version as v
    inner join drawing as d on d.d_id = v.d_id
    inner join dcn as dc on dc.dcn_id = v.dcn_id
    where v.delete_flag != 0 AND v.d_id = $id
    ORDER by version DESC";
                 $data['title'] = $title ;
                 $data['name'] = $name ;


        }
        else{
          $sql =  'SELECT d.d_id, d.d_no, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version from drawing d 
          inner join dcn as dc on dc.dcn_id = d.dcn_id where d.delete_flag != 0';
        }

        $sql1 =  'SELECT * from dcn where delete_flag != 0';
        $query = $this->db->query($sql1); 
        $data['result_dcn'] = $query->result(); 

       $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 


        $this->load->view('drawing/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
        
    }

    
    public function insert()
    {
    
        $d_no =  $this->input->post('d_no');
        $dcn_id =  $this->input->post('dcn_id');

        if($this->input->post('file_name') == null){
            $file_name =  $this->input->post('file_name2');
        }else{
            $file_name =  $this->input->post('file_name');
        }
        $result = $this->model->insert_drawing($d_no, $dcn_id, $file_name);

        redirect('drawing/manage','refresh');
  
    }

    public function enable($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));
        $result = $this->model->enableDrawing($uid);

        if($result!=FALSE){
            echo '<script language="javascript">';
            echo 'history.go(-1);';
            echo '</script>';
        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('drawing/manage','refresh');
        }
    }

    public function disable($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $result = $this->model->disableDrawing($uid);

        if($result!=FALSE){
            echo '<script language="javascript">';
            echo 'history.go(-1);';
            echo '</script>';
            

        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('drawing/manage','refresh');

        }
    }

    public function enable_v($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));
        $result = $this->model->enableDrawing_v($uid);

        if($result!=FALSE){
            echo '<script language="javascript">';
            echo 'history.go(-1);';
            echo '</script>';

        }else{
        
            echo "<script>alert('Simting wrong')</script>";
       redirect('drawing/manage','refresh');
        }
    }

    public function disable_v($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $result = $this->model->disableDrawing_v($uid);

        if($result!=FALSE){
                echo '<script language="javascript">';
        
            echo 'history.go(-1);';
            echo '</script>';
            

        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('drawing/manage','refresh');

        }
    }

  

    public function deletedrawing_v()
    {
        $this->model->delete_drawing_v($this->uri->segment('3'));
        echo '<script language="javascript">';
            echo 'history.go(-1);';
            echo '</script>';
    }


    public function version_form()
    {
        $id = $this->uri->segment('3');

        $sql =  "SELECT d.d_id, d.d_no, d.dcn_id, d.enable, d.file_name as file, dc.dcn_no, d.version from drawing as d
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

        $sql =  "SELECT v.v_id, d.d_id, d.d_no, v.dcn_id, dc.dcn_no, v.enable, v.file_name as file, v.version from version as v
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
        $file_name =  $this->input->post('file_name');
        $this->model->select_version($d_id);
        $this->model->update_version($d_id, $d_no, $dcn_id, $version, $file_name);
        redirect('drawing/manage');


  
    }

}

