<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bom extends CI_Controller {

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
        //  $this->load->view('menu',$menu);

    }
	public function index()
    {	

    }
    	public function manage()
    {	
          $sql =  'SELECT DISTINCT part.`p_id`,`p_name` FROM `part` inner join bom on bom.b_master = part.p_id';

       
       $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 


        $this->load->view('bom/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
        
    }


    public function show_bom()
    {	
        $bm =  $this->input->post('bm');
        if(isset($bm)){
            $i=2;
            $data= $this->model->hook_bom($bm) ;
            $result=[];
            $a=[];
        do{
         $r= $this->model->sort_bom($i,$data) ;  
         $data=$r['res'];
         array_push($a, $r['data']);
        $i++;

     }
   while($data!=false);
    }
    $gg['data'] = $a; 
    $this->load->view('bom/show',$gg);//bring $data to user_data 
    $this->load->view('footer');

	}

    
    public function add()
    {

        $sql =  'SELECT p.p_id, p.p_no, p.p_name, p.enable from part as p where delete_flag != 0 and p_master =0';
        $query = $this->db->query($sql); 
       $data['result_p'] = $query->result(); 
        $this->load->view('bom/add',$data);//bring $data to user_data 
		$this->load->view('footer');
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

    public function deletedrawing()
    {
        $this->model->delete_drawing($this->uri->segment('3'));
        redirect('drawing/manage');
    }


    public function edit_form()
    {
        $id = $this->uri->segment('3');

        $sql =  "SELECT d.d_id, d.d_no, d.dcn_id, d.file_name as file, dc.dcn_no, d.version from drawing as d
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


    public function insert_bom()
    {
        $bm =  $this->input->post('bm');
        $p_id =  $this->input->post('p_id');
        
     foreach ($p_id as $p) {
        $result = $this->model->insert_bom($bm,$p);
    }

        echo "<script>alert('Add Data Success')</script>";
        redirect('bom/add','refresh');
  
    }

}

