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
        $this->model->load_menu();
    }
	public function index()
    {	
    
	}

    
	public function manage()
    {	
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

            $p_id =  $this->input->post('p_id');
            $sql =  "SELECT p.p_id, p.p_no, p.p_name, p.enable,p.d_id,d.d_no
            from part as p
            left join drawing as d on d.d_id = p.d_id
            where p.delete_flag != 0 ";
        $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 
        $this->load->view('part/show',$data);//bring $data to user_data 
        $this->load->view('footer');
        
        
	}
	public function add()
    {	
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $sql = "SELECT * FROM drawing where delete_flag != 0 ";
        $query = $this->db->query($sql);
        $data['result_d'] = $query->result(); 
        $this->load->view('part/add',$data);//bring $data to user_data 
		$this->load->view('footer');
	}
	public function add_sub()
    {	

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id = $this->uri->segment('3');
        $p_id =  $this->input->post('id');
        $p_no =  $this->input->post('p_no');
        $sub_id =  $this->input->post('sub_id');
        $origin =  $this->input->post('origin');
        $array = $this->model->filter($sub_id,$id);
        $_data = array();
        foreach ($array as $v) {
          if (isset($_data[$v['m_id']])) {
            // found duplicate
            continue;
          }
          // remember unique item
          $_data[$v['m_id']] = $v;
        }
        // if you need a zero-based array, otheriwse work with $_data
        $array = array_values($_data);
        
        $query = $this->db->query('SELECT * FROM bom where b_id = '.$id.'   AND delete_flag != 0');
        $res_bom= $query->result();
        $b_master = $res_bom[0]->b_master;
        $sql =  "SELECT p.p_id, p.p_no, p.p_name, p.enable from part as p where delete_flag != 0 and p.p_id = '$p_id.'";
        $query = $this->db->query($sql); 
        $res = $query->result(); 
        $query = $this->db->query("SELECT p.p_id, p.p_no, p.p_name, p.enable from part as p where delete_flag != 0 and p.p_id != '$b_master.'"); 
        $res_part = $query->result(); 
        $data['res_chk'] =$array;
        $data['bm'] =$id;
        $data['p_id'] =$p_id;
        $data['p_no'] =$p_no;
        $data['origin'] =$origin;
        $data['sub_id'] =$sub_id;
        $data['result_p'] =$res_part;
        $data['p_name'] =$res[0]->p_name;
        $this->load->view('part/subpart',$data);//bring $data to user_data 
		$this->load->view('footer');
	}
	public function add_bom_sub()
    {	  
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id = $this->uri->segment('3');
        $m_id =  $this->input->post('m_id');
        $sub_id =  $this->input->post('sub_id');
      
        $sql =  "SELECT p.p_id, p.p_no, p.p_name, p.enable from part as p where delete_flag != 0 and p.p_id = $m_id";
        $query = $this->db->query($sql); 
        $res = $query->result(); 
        $query = $this->db->query("SELECT p.p_id, p.p_no, p.p_name, p.enable from part as p where delete_flag != 0 and p.p_id != $m_id"); 
        $res_part = $query->result(); 
        $data['bm'] =$id;
        $data['p_no'] =$res[0]->p_no;
        $data['p_id'] =$m_id;
        $data['result_p'] =$res_part;
        $data['p_name'] =$res[0]->p_name;

        $this->load->view('part/subpart_b',$data);//bring $data to user_data 
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
       $master =0;
       if(isset($master)){
       $master =  $this->input->post('master');
       }
       $result = $this->model->insert_part($p_no,$p_name, $d_no,$master);

        if($result == true){
       $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
          <span> เพิ่มข้อมูลเรียบร้อยเเล้ว </span>
        </div> ');

        redirect('part/add','refresh'); 
       }
       else if($result == false){
        //echo "<script>alert('Username already exist')</script>";
        $this->session->set_flashdata('success','<div class="alert alert-danger hide-it">  
          <span> ชื่อนี้ถูกใช้เเล้ว</span>
        </div> ');

        $this->session->set_flashdata('p_no',$p_no);
        $this->session->set_flashdata('p_name',$p_name);
        $this->session->set_flashdata('d_id',$d_id);
        redirect('part/add','refresh'); 
       }
       
  
    }
    public function insert_sub()
    {

        $bm =  $this->input->post('bm');
        $b_master =  $this->input->post('b_master');
        $p_id =  $this->input->post('p_id');
        $sub_id =  $this->input->post('sub_id');
        $origin =  $this->input->post('origin');
        foreach ($p_id as $p_id) {
            $chk= $this->model->insert_sub_part($bm,$b_master,$p_id,$origin);
           }
           redirect('bom/manage/'.$bm.'','refresh');
    }
    public function insert_bom_sub()
    {

        $bm =  $this->input->post('bm');
        $b_master =  $this->input->post('b_master');
        $p_id =  $this->input->post('p_id');
        $sub_id =  $this->input->post('sub_id');

        foreach ($p_id as $p_id) {
            $sub_id= $this->model->insert_sub_part($bm,$b_master,$p_id,$bm);
            $chk= $this->model->update_sub_id($sub_id);
           }
           redirect('bom/manage/'.$bm.'','refresh');
    }


    public function enable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

		$result = $this->model->enablePart($uid);

		if($result!=FALSE){
            redirect('part/manage/'.$uid.'','refresh');

		}else{
		    echo "<script>alert('Somting wrong')</script>";
         redirect('part/manage/'.$uid.'','refresh');
		}
	}

	public function disable($uid){

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

		$result = $this->model->disablePart($uid);

		if($result!=FALSE){
            redirect('part/manage/'.$uid.'','refresh');
		}else{
            echo "<script>alert('Somting wrong')</script>";
            redirect('part/manage/'.$uid.'','refresh');

		}
	}

    public function deletepart()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id = $this->uri->segment('3');
        $this->model->delete_part($id);
        redirect('part/manage/'.$id.'','refresh');
    }

    public function edit_part()   
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        
        if($this->input->post('bom')){
        $p_id =  $this->input->post('p_id');
        $sql =  "SELECT p.p_id, p.p_no, p.p_name,p.d_id, d.d_no from part as p
        left join drawing as d on d.d_id = p.d_id
        where p.p_id = $p_id";
        
        $data['gg'] = $this->input->post('bom');

        }else{
        $id = $this->uri->segment('3');
        $sql =  "SELECT p.p_id, p.p_no, p.p_name,p.d_id, d.d_no from part as p
        left join drawing as d on d.d_id = p.d_id
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
        redirect('part/manage/'.$p_id.'','refresh');
        
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

