<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part_drawing extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->database(); 
        $this->load->model('model');
        $this->model->CheckSession();

        $menu['menu'] = $this->model->showmenu();
         $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url);
         $sql =  "select * from sys_menus where order_no != 0 and enable != 0";
         $query = $this->db->query($sql); 
         $menu['submenu']= $query->result(); 
         $this->load->view('header');
         $this->load->view('menu',$menu);

    }
    public function add()
    {	
        $sql = "SELECT * FROM drawing where delete_flag != 0";
		$query1 = $this->db->query($sql);
        $sql1 = "SELECT * FROM part where delete_flag != 0";
		$query = $this->db->query($sql1);
        $data['drawing'] = $query1->result(); 
        $data['part'] = $query->result(); 
        $this->load->view('part_drawing/add',$data);//bring $data to user_data 
		$this->load->view('footer');
	}


    	public function manage()
    {   
        $p_id =  $this->input->post('p_id');
        $d_id =  $this->input->post('d_id');
        $name =  $this->input->post('name');
        $title =  $this->input->post('title');

        if($name == 'Drawing'){
    $sql =  "SELECT pd.pd_id as pd_id, pd.d_id as d_id, d.d_id as d_id, p.p_name as p_name, d.d_no as d_no, p.p_no as p_no, pd.enable as enable
        FROM
        part_drawing AS pd
        INNER JOIN part AS p ON p.p_id = pd.p_id
        LEFT JOIN drawing AS d ON d.d_id = pd.d_id where pd.delete_flag != 0 AND pd.d_id = $d_id
        ";
         $data['title'] = $title ;
         $data['name'] = $name ;
        }


    else if($name =='Part'){
$sql =  "SELECT pd.pd_id as pd_id, pd.p_id as p_id , d.d_id as d_id, p.p_name as p_name, d.d_no as d_no, p.p_no as p_no, pd.enable as enable
        FROM
        part_drawing AS pd
        INNER JOIN part AS p ON p.p_id = pd.p_id
        LEFT JOIN drawing AS d ON d.d_id = pd.d_id where pd.delete_flag != 0 AND pd.p_id=$p_id
        ";
    $data['title'] = $title ;
    $data['name'] = $name ;
    }
    else{
        $sql =  "SELECT pd.pd_id as pd_id, pd.p_id as p_id , d.d_id as d_id, p.p_name as p_name, d.d_no as d_no, p.p_no as p_no, pd.enable as enable
        FROM
        part_drawing AS pd
        INNER JOIN part AS p ON p.p_id = pd.p_id
        LEFT JOIN drawing AS d ON d.d_id = pd.d_id where pd.delete_flag != 0
        ";
    }

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 
        $this->load->view('part_drawing/manage',$data,$name);//bring $data to user_data 
        $this->load->view('footer');
        
    }
    

    public function insert()
    {
    
        $p_id =  $this->input->post('p_id');
        $d_id =  $this->input->post('d_id');
        
    foreach ($p_id as $p) {
     foreach ($d_id as $d) {
        $result = $this->model->insert_part_drawing($p,$d);
    }
}
        echo "<script>alert('Add Data Success')</script>";
        redirect('part_drawing/add','refresh');
  
    }

    public function save_user_permission()
    {

        $su_id =  $this->input->post('su_id');
        $sp_id =  $this->input->post('sp_id');
           $this->model->deluser_permission($su_id);
foreach ($sp_id as $sp) {
         $this->model->insertuser_permission($su_id,$sp);
     }
 
    }

     public function enable($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $result = $this->model->enablePartD($uid);

        if($result!=FALSE){
            redirect('part_drawing/manage','refresh');

        }else{
        
            echo "<script>alert('Simting wrong')</script>";
       redirect('part_drawing/manage','refresh');
        }
    }

    public function disable($uid){

        //$this->model->CheckPermission($this->session->userdata('sp_id'));

        $result = $this->model->disablePartD($uid);

        if($result!=FALSE){
            redirect('part_drawing/manage','refresh');
            

        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('part_drawing/manage','refresh');

        }
    }

    public function deletePartD()
    {
        $this->model->delete_partD($this->uri->segment('3'));
        redirect('part_drawing/manage');
    }


}

