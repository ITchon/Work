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
         $sql =  "select * from sys_menus where order_no != 0  and enable != 0";
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

        $dcn_id =  $this->input->post('dcn_id');
        $name =  $this->input->post('name');

        if($name == 'dcn'){
          $sql =  "SELECT * from drawing as d
          inner join dcn as dc on dc.dcn_id = d.dcn_id
          LEFT JOIN version AS v ON v.d_id = d.d_id
          where d.delete_flag != 0 AND d.dcn_id = $dcn_id";
        }
        else{
          $sql =  'select * from drawing d inner join dcn on dcn.dcn_id = d.dcn_id where d.delete_flag != 0';
        }


        
        $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 


        $this->load->view('drawing/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
        
    }

    
    public function insert()
    {
    

        $d_no =  $this->input->post('d_no');
        $dcn_id =  $this->input->post('dcn_id');
        $result = $this->model->insert_drawing($d_no,$dcn_id);
  
    }

    public function enable($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $result = $this->model->enableDrawing($uid);

        if($result!=FALSE){
            redirect('drawing/manage','refresh');

        }else{
        
            echo "<script>alert('Simting wrong')</script>";
       redirect('drawing/manage','refresh');
        }
    }

    public function disable($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $result = $this->model->disableDrawing($uid);

        if($result!=FALSE){
            redirect('drawing/manage','refresh');
            

        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('drawing/manage','refresh');

        }
    }

    public function deletedrawing()
    {
        $this->model->delete_drawing($this->uri->segment('3'));
        redirect('drawing/manage');
    }


    public function edit_form()
    {


        $id = $this->uri->segment('3');

        $sql =  "SELECT d.d_id, d.d_no, dc.dcn_no, d.file_name as file, dc.dcn_id, d.version from drawing as d
          inner join dcn as dc on dc.dcn_id = d.dcn_id
          where d.d_id = $id";

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

