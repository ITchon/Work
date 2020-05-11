<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->database(); 
        $this->load->model('model');
        $this->model->CheckSession();
    
        $menu['menu'] = $this->model->showmenu();
        $sql =  "select * from sys_menus where order_no != 0 and enable != 0";
        $query = $this->db->query($sql); 
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url);
         $menu['submenu']= $query->result(); 
         $this->load->view('header');
         $this->load->view('menu',$menu);
    }
	public function index()
    {	
    
	}

    
	public function manage()
    {	
        $sql =  'select * from part where delete_flag != 0';
        $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 
        $this->load->view('part/manage',$data);//bring $data to user_data 
		$this->load->view('footer');
	}
	public function add()
    {	
        $sql = "SELECT * FROM part_drawing as pd inner join drawing as d on d.d_id = pd.d_id where d.delete_flag != 0 ";
		$query = $this->db->query($sql);
        $data['result'] = $query->result();  

        $sql = "SELECT * FROM drawing where delete_flag != 0 ";
        $query = $this->db->query($sql);
        $data['result_d'] = $query->result(); 


        $this->load->view('part/add',$data);//bring $data to user_data 
		$this->load->view('footer');
	}

    public function insert()
    {
    
        $p_no =  $this->input->post('p_no');
        $p_name  =  $this->input->post('p_name');
        $d_id =  $this->input->post('d_id');

        $this->model->insert_part($p_no,$p_name);
     foreach ($d_id as $d) {
        $this->model->insert_part2($d);
    }
        echo "<script>alert('Add Data Success')</script>";
        redirect('part/add','refresh');
  
    }


    public function enable($uid){

        //$this->model->CheckPermission($this->session->userdata('su_id'));

		$result = $this->model->enablePart($uid);

		if($result!=FALSE){
            redirect('part/manage','refresh');

		}else{
		
		    echo "<script>alert('Somting wrong')</script>";
       redirect('part/manage','refresh');
		}
	}

	public function disable($uid){

        //$this->model->CheckPermission($this->session->userdata('su_id'));

		$result = $this->model->disablePart($uid);

		if($result!=FALSE){
            redirect('part/manage','refresh');
			

		}else{
            echo "<script>alert('Somting wrong')</script>";
            redirect('part/manage','refresh');

		}
	}

    public function deletepart()
    {
        $this->model->delete_part($this->uri->segment('3'));
        redirect('part/manage');
    }
}

