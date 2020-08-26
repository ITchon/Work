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
 
    public function view_pdf()
    {
        $id = $this->input->post('id');
        //$data = $this->model_issue->issue_by_id($id);

        $data = $this->model_ajax->dwg_by($id);
        $parts = explode('.', $data[0]->file_code);
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
        $parts = explode('.', $data[0]->file_code);
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