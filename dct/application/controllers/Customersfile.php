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
        $sql =  'SELECT cusf.cusf_id,cusf.file_name,cusf.cusf_des,cus.cus_name as cusname,f.name as type
        FROM customers_file as cusf
        inner join customers as cus on cus.cus_id = cusf.cus_id
        inner join folder as f on f.f_id = cusf.f_id
        inner join folder_group as fg on fg.fg_id = f.fg_id
        where cus.delete_flag !=0';
        $query = $this->db->query($sql); 
        $data['result'] = $query->result();
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
        $result = $this->model_customersfile->get_folder_by($f_id);
        $folderg = $result->folg;
        $folder = $result->fol;

        $config['upload_path']           = './uploads/'.$folderg.'/'.$folder;
        $config['allowed_types']        = '*';

        $cus_id =  $this->input->post('cus_id');
        $cusf_des =  $this->input->post('cusf_des');
        $file_name = $_FILES['file_name']['name'];

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
            $res = $this->model_customersfile->insert_cusf($cus_id,$cusf_des,$file_name,$f_id);
            if($res != true){
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
        $sql =  "SELECT cusf.cusf_id,cus.cus_id,cusf.cusf_des,cus.cus_name,cusf.file_name ,cusf.f_id
        from customers_file as cusf
        inner join customers as cus on cus.cus_id = cusf.cus_id
        where cusf_id = $id";
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $data['result_cus'] = $this->model_customersfile->get_customers();
        $data['result_fol'] = $this->model_customersfile->get_folder();

        $this->load->view('customersfile/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit()
    {
        $f_id =  $this->input->post('f_id');
        $result = $this->model_customersfile->get_folder_by($f_id);
        $folderg = $result->folg;
        $folder = $result->fol;

        $config['upload_path']           = './uploads/'.$folderg.'/'.$folder;
        $config['allowed_types']        = '*';

        $cusf_id =  $this->input->post('cusf_id');
        $cus_id =  $this->input->post('cus_id');
        $cus_des =  $this->input->post('cus_des');
        $cus_des =  $this->input->post('cus_des');
        $filename =  $this->input->post('file_name2');
        $file = $_FILES['file_name']['name'];

        echo $f_id."f_id<br>";
        echo $cusf_id."cusf_id<br>";
        echo $cus_id."cus_id<br>";
        echo $cus_des."cus_des<br>";
        echo $file_name."file_name<br>";
        echo $file."file<br>";
        exit;
        

        $this->model_customers->save_edit_cus($cus_id,$cus_name, $cus_des);
        redirect('customers/manage');
    }




}

