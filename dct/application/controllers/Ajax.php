<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
 
class Ajax extends CI_Controller {
 
 
public function __construct()
    {
        parent::__construct();
     $this->load->helper('url');
        $this->load->model('model');
        $this->load->model('model_ajax');

    }
    
    public function fetch_drawing()
    {
     if($this->input->post('pd_id'))
     
     {
      echo $this->model_ajax->fetch_drawing($this->input->post('pd_id'));
     }
    }
    public function fetch_part_drw()
    {
     if($this->input->post('d_id'))
     
     {
      echo $this->model_ajax->fetch_part_drw($this->input->post('d_id'));
     }
    }

        public function fetch_part_drw_v()
    {
     if($this->input->post('d_id'))
     
     {
      echo $this->model_ajax->fetch_part_drw_v($this->input->post('d_id'));
     }
    }

    public function fetch_pd_edit()
    {

     if($this->input->post('rev') !=null && $this->input->post('d_id')!=null )
     
     {
      echo $this->model_ajax->fetch_pd_edit($this->input->post('rev'),$this->input->post('d_id') );
     }
    
    }
    
   
    public function delete_part_drw()
    {
     if($this->input->post('id'))
     {
        $res = $this->model_ajax->delete_part_drw($this->input->post('id'),$this->input->post('d_id'));	
        if($res != false){
            echo json_encode(array(
            "statusCode"=>200
        ));
        }else{
            echo json_encode(array(
            "statusCode"=>100
        ));
        }
     }
    }

    public function delete_part_drw_v()
    {
     if($this->input->post('rd_id'))
     {
       $res = $this->model_ajax->delete_part_drw_v($this->input->post('rd_id'),$this->input->post('did'),$this->input->post('rev')); 
       if($res != false){
            echo json_encode(array(
            "statusCode"=>200
        ));
       }else{
            echo json_encode(array(
            "statusCode"=>100
        ));
       }

     }
    }

    public function fetch_folder()
    {
     if($this->input->post('cus_id'))
     
     {
      echo $this->model_ajax->fetch_folder($this->input->post('cus_id'),$this->input->post('chkf'));
     }
    }
 
 
    public function view_dwg_pdf()
    {
        $id = $this->input->post('id');
        //$data = $this->model_issue->issue_by_id($id);

        $data = $this->model_ajax->dwg_by($id);
        $parts = explode('.', $data[0]->file_name);
        $extension = array_pop($parts);
        $status = $data[0]->enable;
        if($status != 1){
            $text = "---Obsolate data---";
        }else{
            $text = "";
        }
        if($extension == 'pdf'){
        $arr = array('success' => false, 'data' => '');
        if($data){
            $arr = array('success' => true, 'data' => $data, 'text' => $text);
            }
        }
        else{
            $arr = array('success' => flase, 'data' => 'lol');
        }
        echo json_encode($arr);
        
    }
    public function view_dcn_pdf()
    {
        $id = $this->input->post('id');
        //$data = $this->model_issue->issue_by_id($id);

        $data = $this->model_ajax->dcn_by($id);
        $parts = explode('.', $data[0]->file_name);
        $extension = array_pop($parts);
        if($extension == 'pdf'){
        $arr = array('success' => false, 'data' => '');
        if($data){
            $arr = array('success' => true, 'data' => $data);
            }
        }
        else{
            $arr = array('success' => flase, 'data' => 'lol');
        }
        echo json_encode($arr);
        
    }
    public function view_standard_pdf()
    {
        $id = $this->input->post('id');
        //$data = $this->model_issue->issue_by_id($id);

        $data = $this->model_ajax->standardfile_by($id);
        $parts = explode('.', $data[0]->file_name);
        $extension = array_pop($parts);
        if($extension == 'pdf'){
        $arr = array('success' => false, 'data' => '');
        if($data){
            $arr = array('success' => true, 'data' => $data);
            }
        }
        else{
            $arr = array('success' => flase, 'data' => 'lol');
        }
        echo json_encode($arr);
        
    }

    public function view_standard_pdf_v()
    {
        $id = $this->input->post('id');
        //$data = $this->model_issue->issue_by_id($id);

        $data = $this->model_ajax->standardfile_by_v($id);
        $parts = explode('.', $data[0]->file_name);
        $extension = array_pop($parts);
        if($extension == 'pdf'){
        $arr = array('success' => false, 'data' => '');
        if($data){
            $arr = array('success' => true, 'data' => $data);
            }
        }
        else{
            $arr = array('success' => flase, 'data' => 'lol');
        }
        echo json_encode($arr);
        
    }
    public function view_pdf2()
    {
        $id = $this->input->post('id');
        //$data = $this->model_issue->issue_by_id($id);

        $data = $this->model_ajax->dwg_by_version($id);
        $parts = explode('.', $data[0]->file_name);
        $extension = array_pop($parts);
        if($extension == 'pdf'){
        $arr = array('success' => false, 'data' => '');
        if($data){
            $arr = array('success' => true, 'data' => $data);
            }
        }
        else{
            $arr = array('success' => flase, 'data' => 'lol');
        }
        echo json_encode($arr);
        
    }
 
   
 

 
 
}