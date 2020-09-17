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
    
    public function fetch_folder()
    {
     if($this->input->post('cus_id'))
     
     {
      echo $this->model_ajax->fetch_folder($this->input->post('cus_id'),$this->input->post('chkf'));
     }
    }
 
    // public function select_type()
    // {
    // $cus_id = $this->input->post('cus_id')
    // $f_id = $this->input->post('chkf')
    //  if($this->input->post('chkf'))
     
    //  {
    //   echo $this->model_ajax->select_folder($cus_id,$f_id);
    //  }
    // }
 
    public function view_dwg_pdf()
    {
        $id = $this->input->post('id');
        //$data = $this->model_issue->issue_by_id($id);

        $data = $this->model_ajax->dwg_by($id);
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
    public function view_customersfile_pdf()
    {
        $id = $this->input->post('id');
        //$data = $this->model_issue->issue_by_id($id);

        $data = $this->model_ajax->customersfile_by($id);
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