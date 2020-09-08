<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bom extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->load->model('model_bom');
        $this->load->model('model_part');
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
        
        $sort =  $this->input->post('sort'); 
        $data['result'] =$this->model_bom->get_bom();

        if( $this->input->post('bm')){
          $bm =  $this->input->post('bm'); 
          redirect('bom/manage/'.$bm.'');
         }else{
          $bm = $this->uri->segment('3');
        }
        if(isset($bm)){
        $array= $this->model_bom->bom($bm) ;
        if($sort){
            $sub_id = $this->input->post('sub_id');
            $array = $this->model_bom->tree_down($sub_id,$bm) ;
            
        }
        $data['result_bom'] = $array;  
        $res = $this->model_bom->get_bom_by($bm) ;;
        $data['bom']=$res;
        $data['bm']=$bm;
        $data['sort']=null;
        $data['bm_id']=$res[0]->pd_id;
        $data['p_no']=$res[0]->p_no;

        //Find Maxlv in array
        if($array!=null){
                 foreach($array as $row){
                    $max[] = array($row['lv']); 
                 }
                    $maxlv = max($max);
                    }else{
                     $max[]=array(1);
                     $maxlv = max($max);
                    }
        $data['maxlv']= $maxlv[0];
        $sql =  'SELECT DISTINCT * FROM part where part.delete_flag !=0';
        $query = $this->db->query($sql); 
        $data['result_sub'] = $query->result();     
        $data['chk'] = $this->model_bom->opencsv($this->session->userdata('su_id'));
        $this->load->view('bom/show',$data);
        $this->load->view('footer');
         }else{
        $data['chk'] = $this->model_bom->opencsv($this->session->userdata('su_id'));
        $this->load->view('bom/manage',$data);
        $this->load->view('footer');
         }
        }


    
    public function edit_bom()
    {
        $bm = $this->uri->segment('3');
        $p_id =  $this->input->post('id');
        $id =  $this->input->post('m_id');
        $data['result'] =$this->model_bom->get_bom_by($bm);
        $data['bm'] =$bm;
        $data['p_id'] =$p_id;
        $data['m_id'] =$id;
        $this->load->view('bom/edit_bom',$data);
		$this->load->view('footer');
    }
    public function edit_part()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $bm = $this->uri->segment('3');
        $p_no =  $this->input->post('p_no');
        $id =  $this->input->post('m_id');
        $query=$this->db->query("SELECT * from part inner join sub_part on sub_part.m_id=part.p_id where  sub_id =  $id");
        $data['result'] = $query->result(); 
        $data['bm'] =$bm;
        $data['p_no'] =$p_no;
        $data['m_id'] =$id;
        $this->load->view('bom/edit_part',$data);
		$this->load->view('footer');
    }
    public function add()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $sql =  'SELECT  pd.p_id,pd.pd_id,p.p_no,p.p_name,d.d_no,d.d_name from part_drawing pd
        inner join part p on p.p_id = pd.p_id 
        inner join drawing d on d.d_id = pd.d_id';
        $query = $this->db->query($sql); 
        $res = $query->result(); 
        $data['result'] =$res;
        $this->load->view('bom/add',$data);
		$this->load->view('footer');
    }
  

    public function delete_sub()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $bm =  $this->input->post('bm');
        $m_id =  $this->input->post('m_id');
        $this->model_bom->delete_sub($m_id);
        redirect('bom/manage/'.$bm.'','refresh');
    }
    public function delete_bom()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $bm = $this->uri->segment('3');
       
        $this->model_bom->delete_bom($bm);
        redirect('bom/manage','refresh');
    }
    public function insert_bom()
    {
        $pd_id =  $this->input->post('pd_id');
        $child_id =  $this->input->post('child_id');
  
   
        $lasted_id = $this->model_bom->insert_bom($pd_id);
        $res = $this->model_bom->hook_bom($lasted_id);
        $parent_id = $res[0]->pd_id;
        if($this->input->post('child_id') != null){
            foreach ($child_id as $id) {
                $sub_id= $this->model_part->insert_sub_part($lasted_id,2,$parent_id,$id,$id);
                $res= $this->model_part->update_sub_id($sub_id);
                }
        }

        redirect('bom/manage/'.$lasted_id.'','refresh');
    }

    public function insert_edit_part()
    {   
        $bm = $this->uri->segment('3');
        $m_id =  $this->input->post('m_id');
        $qty =  $this->input->post('quantity');
        $unit =  $this->input->post('unit');
        $c_p =  $this->input->post('common_part');
        $lasted_id = $this->model_bom->insert_edit_part($m_id,$qty,$unit ,$c_p );
        redirect('bom/manage/'.$bm.'','refresh');
    }
    public function insert_edit_bom()
    {   
        $bm = $this->uri->segment('3');
        $qty =  $this->input->post('quantity');
        $unit =  $this->input->post('unit');
        $c_p =  $this->input->post('common_part');
        $lasted_id = $this->model_bom->insert_edit_bom($bm,$qty,$unit ,$c_p );
        redirect('bom/manage/'.$bm.'','refresh');
    }
    public function insert_sub()
    {    
        $bm =  $this->input->post('bm');
        $p_id =  $this->input->post('p_id');
        $sql =  'SELECT * FROM bom where b_id = '.$bm.'   AND delete_flag != 0';
        $query = $this->db->query($sql);
        $res_bom= $query->result();
        $b_master = $res_bom[0]->b_master;
        foreach ($p_id as $p) {
        $chk= $this->model_bom->insert_sub_part($bm,$b_master,$p,$p);
        }
        redirect('bom/manage/'.$bm.'','refresh');
    }
}

