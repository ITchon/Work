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

        $menu['menu'] = $this->model->showmenu($this->session->userdata('sug_id'));
         $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url);
         $sql =  "select * from sys_menus where order_no != 0 and enable != 0 ORDER BY order_no";
         $query = $this->db->query($sql); 
         $menu['submenu']= $query->result(); 
         $this->load->view('header');
         $this->load->view('menu',$menu);

    }
    public function add()
    {	
        $this->model->CheckPermission($this->session->userdata('su_id'));

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
        $id = $this->uri->segment('3');
        $dcn_id =  $this->input->post('dcn_id');
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


        $this->load->view('part_drawing/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
        }
        else if(isset($id)){
            $sql =  "SELECT d.d_id, d.d_no, d.dcn_id, d.enable, d.file_name, d.version, dcn.dcn_no, d.path_file,'v_id', p.p_no
            from drawing as d
            inner join dcn on dcn.dcn_id = d.dcn_id
            inner join part as p on p.d_id = d.d_id 
            where d.delete_flag != 0 AND d.d_id = $id
            UNION
         SELECT v.d_id, v.d_no, v.enable, d.dcn_id, v.file_name, v.version, dc.dcn_no, d.path_file, v.v_id, p.p_no
         from version as v
         inner join drawing as d on d.d_id = v.d_id
         inner join dcn as dc on dc.dcn_id = v.dcn_id
         inner join part as p on p.d_id = d.d_id 
         where v.delete_flag != 0 AND v.d_id = $id
         ORDER by version DESC";
                 $data['title'] = $title ;
                 $data['name'] = $name ;

        $sql1 =  'SELECT * from dcn where delete_flag != 0';
        $query = $this->db->query($sql1); 
        $data['result_dcn'] = $query->result(); 

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 


        $this->load->view('part_drawing/manage',$data);//bring $data to user_data 
        $this->load->view('footer');


        }
        else if($this->input->post('bm')){
            $bm =  $this->input->post('bm'); 
            $sql =  "SELECT d.d_id, d.d_no, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no
          from drawing d 
          inner join dcn as dc on dc.dcn_id = d.dcn_id
          inner join part as p on p.d_id = d.d_id 
          where d.d_id = '$bm' AND d.delete_flag != 0";
          $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 


        $this->load->view('part_drawing/show',$data);//bring $data to user_data 
        $this->load->view('footer');

        }
        else{
          $sql =  'SELECT * from drawing d 
          where d.delete_flag != 0';
          $sql1 =  'SELECT * from dcn where delete_flag != 0';
        $query = $this->db->query($sql1); 
        $data['result_dcn'] = $query->result(); 

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 


        $this->load->view('part_drawing/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
        }

        
        
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

        $this->model->CheckPermission($this->session->userdata('su_id'));

        $result = $this->model->enablePartD($uid);

        if($result!=FALSE){
            redirect('part_drawing/manage','refresh');

        }else{
        
            echo "<script>alert('Simting wrong')</script>";
       redirect('part_drawing/manage','refresh');
        }
    }

    public function disable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));

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
        $this->model->CheckPermission($this->session->userdata('su_id'));
        
        $this->model->delete_partD($this->uri->segment('3'));
        redirect('part_drawing/manage');
    }

    public function openfile()
    {
        $file =  $this->input->post('file');
        $path = $this->input->post('path');
        $open = ("$path$file");
        exec($open);
        
        redirect('part_drawing/manage');

    }


}

