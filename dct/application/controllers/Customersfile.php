<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customersfile extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->helper('download');
        $this->load->library('upload');
        $this->load->database(); 
        $this->load->model('model');
        $this->load->model('model_customersfile');
        $this->model->CheckSession();
        $this->model->load_menu();
        $this->model->button_show($this->session->userdata('su_id'),11);
    }
	public function index()
  {	

	}

    
	public function manage()
    {	
        $this->model->CheckPermission($this->session->userdata('su_id'));
         $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $sql =  'SELECT * FROM customers WHERE delete_flag != 0';
        $query = $this->db->query($sql); 
       $data['result_all'] = $query->result();
        $this->load->view('customersfile/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
        
    }


    public function add()
    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $data['result_cus'] = $this->model_customersfile->get_customers();
        $this->load->view('customersfile/add',$data);//bring $data to user_data 
        $this->load->view('footer');
    }


    public function insert()
    {
        $f_id =  $this->input->post('f_id');
        $result = $this->model_customersfile->checkfolder($f_id);
        $folderg = $result->folg;
        $folder = $result->fol;

        
        $config['upload_path']           = './uploads/'.$folderg.'/'.$folder;
        $config['allowed_types']        = '*';

        $cus_id =  $this->input->post('cus_id');
        $cusf_des =  $this->input->post('cusf_des');
        $file_name =  $this->input->post('file_name');

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('file_name'))
            {
            echo "<script>";
            echo 'alert(" File Failed ");';
            
            echo '</script>';
            exit;
            redirect('customersfile/add','refresh');   
            }
            else{
            $res = $this->model_customersfile->insert_cusf($cus_id,$cusf_des,$file_name);
            if($res != false){
            echo "<script>";
            echo 'alert(" What wrong ");';
            echo 'history.go(-1);';
            echo '</script>';
            redirect('customersfile/add','refresh');   
            }else{
                $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
                <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
              </div> ');
            }

            }
            redirect('customersfile/manage','refresh');   


    }


    public function delete()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $this->model_customers->delete_cus($this->uri->segment('3'));
        redirect('customers/manage');
    }


    public function edit()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id = $this->uri->segment('3');
        $sql =  "SELECT * from customers where cus_id = $id";

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $this->load->view('customers/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit()
    {
        $cus_id =  $this->input->post('cus_id');
        $cus_name =  $this->input->post('cus_name');
        $cus_des =  $this->input->post('cus_des');

        $this->model_customers->save_edit_cus($cus_id,$cus_name, $cus_des);
        redirect('customers/manage');
    }




}

