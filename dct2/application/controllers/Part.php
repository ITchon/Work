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
        $sql =  "select * from sys_menus where order_no != 0 and enable != 0 ORDER BY order_no";
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
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $sql =  'SELECT p.p_id, p.p_no, p.p_name, p.enable from part as p where delete_flag != 0';
        $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 
        $this->load->view('part/manage',$data);//bring $data to user_data 
		$this->load->view('footer');
	}
	public function add()

    {	
        $this->model->CheckPermission($this->session->userdata('su_id'));

        $sql = "SELECT * FROM part_drawing as pd inner join drawing as d on d.d_id = pd.d_id where d.delete_flag != 0 ";
		$query = $this->db->query($sql);
        $data['result'] = $query->result();  
        $sql = "SELECT * FROM drawing where delete_flag != 0 ";
        $query = $this->db->query($sql);
        $data['result_d'] = $query->result(); 
        $this->load->view('part/add',$data);//bring $data to user_data 
		$this->load->view('footer');
	}
	public function add_sub()
    {	
        $this->model->CheckPermission($this->session->userdata('su_id'));

        if($this->input->post('bm')){
            $bm = $this->input->post('bm');
            $p_id = $this->input->post('id');

            $data['bm'] =$bm;
            $data['p_id'] =$p_id;

        $sql =  "SELECT p.p_id, p.p_no, p.p_name, p.enable from part as p where delete_flag != 0 and p.p_id = '$p_id.'";

        $sql =  'SELECT p.p_id, p.p_no, p.p_name, p.enable from part as p where delete_flag != 0 ';

        }else{

        $id = $this->uri->segment('3');
        $p_id =  $this->input->post('id');

        $data['bm'] =$id;
        $data['p_id'] =$p_id;

        $sql =  "SELECT p.p_id, p.p_no, p.p_name, p.enable from part as p where delete_flag != 0 and p.p_id = '$p_id.'";

        $sql =  'SELECT p.p_id, p.p_no, p.p_name, p.enable from part as p where delete_flag != 0 ';

        }
        

        $query = $this->db->query($sql); 
        $res = $query->result(); 
        $data['result_p'] =$res;
        $data['p_name'] =$res[0]->p_name;;
        $this->load->view('part/subpart',$data);//bring $data to user_data 
		$this->load->view('footer');
	}



    public function insert()
    {
    
        $bm =  $this->input->post('bm');
        $p_no =  $this->input->post('p_no');
        $p_name  =  $this->input->post('p_name');
        $d_id =  $this->input->post('d_id');
       $d_no =  $this->input->post('d_no');
       $master =  $this->input->post('master');
       $lv = 2;
       $master =0;
       if(isset($master)){
       $lv = 3;
       $master =  $this->input->post('master');
       }
        $this->model->insert_part($p_no,$p_name, $d_no,$lv,$master);

        echo "<script>alert('Add Data Success')</script>";
        if(!$bm){
            redirect('part/add','refresh'); 
        }else{
            redirect('part/add/'.$bm.'','refresh'); 
        }
       
  
    }
    public function insert_sub()
    {

        $bm =  $this->input->post('bm');
        $p_no =  $this->input->post('p_no');
        $p_id =  $this->input->post('p_id');
  
        foreach ($p_id as $p_id) {
            $chk= $this->model->insert_sub_part($p_no,$p_id,$bm);
           }
           redirect('bom/manage/'.$bm.'','refresh');
    }


    public function enable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));

		$result = $this->model->enablePart($uid);

		if($result!=FALSE){
            redirect('part/manage','refresh');

		}else{
		    echo "<script>alert('Somting wrong')</script>";
         redirect('bom/manage','refresh');
		}
	}

	public function disable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));

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
        $this->model->CheckPermission($this->session->userdata('su_id'));
        
        $this->model->delete_part($this->uri->segment('3'));
        redirect('part/manage');
    }

    public function edit_part()   
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        
        if($this->input->post('bom')){
        $p_id =  $this->input->post('p_id');
        $sql =  "SELECT p.p_id, p.p_no, p.p_name,p.d_id, d.d_no from part as p
        inner join drawing as d on d.d_id = p.d_id
        where p.p_id = $p_id";
        
        $data['gg'] = $this->input->post('bom');

        }else{
        $id = $this->uri->segment('3');
        $sql =  "SELECT p.p_id, p.p_no, p.p_name,p.d_id, d.d_no from part as p
        inner join drawing as d on d.d_id = p.d_id
        where p.p_id = $id";
        }
        
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $d =  $data['result'][0]->d_id;

        $sql1 =  "SELECT * from drawing where d_id != '$d'";
        $query = $this->db->query($sql1); 
        $data['result_g'] = $query->result(); 
        
        $this->load->view('part/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit()
    {
        $p_id =  $this->input->post('p_id');
        $p_no =  $this->input->post('p_no');
        $p_name =  $this->input->post('p_name');
        $d_id =  $this->input->post('d_id');

        $this->model->save_edit_part($p_id, $p_no, $p_name,$d_id);
        redirect('part/manage');
        
    }  

        public function save_editb()
    {
        $bom =  $this->input->post('bom');
        $p_id =  $this->input->post('p_id');
        $p_no =  $this->input->post('p_no');
        $p_name =  $this->input->post('p_name');
        $d_id =  $this->input->post('d_id');
        
        $this->model->save_edit_partb($p_id, $p_no, $p_name,$d_id);
        redirect('bom/manage/'.$bom.'','refresh');
        
    }

}

