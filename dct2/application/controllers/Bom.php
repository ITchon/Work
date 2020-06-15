<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bom extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        $this->load->model('model');
        $this->model->CheckSession();
        
        $menu['menu'] = $this->model->showmenu($this->session->userdata('sug_id'));
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url);
         $sql =  "select * from sys_menus where order_no != 0  and enable != 0 ORDER BY order_no";
         $query = $this->db->query($sql); 
         $menu['submenu']= $query->result(); 
         $this->load->view('header');
        $this->load->view('menu',$menu);

    }
	public function index()
    {	
        
    }
    	public function manage()
    {	
        $sql =  'SELECT * From bom inner join part p on p.p_id = bom.b_master where bom.delete_flag !=0';
        $query = $this->db->query($sql); 
        $res = $query->result(); 
        $data['result'] =$res;
    
       if( $this->input->post('bm')){
          $bm =  $this->input->post('bm'); 
       }else{
        $bm = $this->uri->segment('3');
       }
       $search =  $this->input->post('search'); 
       if($search){
        $sort =  $this->input->post('sort'); 
        $sub_id =  $this->input->post('sub_id'); 
 
        $array= $this->model->bom($bm) ;
        $sql =  'SELECT * FROM sub_part where sub_id = '.$sub_id.'  AND delete_flag != 0';
        $query = $this->db->query($sql); 
        $res= $query->result();
        $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where sub_part.p_id = '.$res[0]->p_id.' AND b_id = '.$bm.'  AND sub_part.delete_flag != 0'); 
        $data= $query->result();
        foreach($data as $row){
       echo $row->sub_id." | "."<br>";
        foreach($array as $r){
       
            if($row->sub_id == $r['sub_id']){
       
                $tree_up= $this->model->tree_up($row->m_id,$r['lv'],$bm);
                foreach($tree_up as $re){
                echo $re['lv']." | ".$re['p_id']." | ".$re['sub_id']."<br>";
                }
            }
            
        }
    }
    
        exit;
        $data['result_bom'] = $array;  
        $query=$this->db->query("SELECT * from bom inner join part on part.p_id=bom.b_master inner join drawing d on d.d_id=part.d_id where b_id = $bm");
        $res = $query->result();
        $data['bom']=$res;
        $data['bm']=$bm;
        $data['bm_id']=$res[0]->b_master;
        $sql =  'SELECT DISTINCT * FROM part where part.delete_flag !=0';
        $query = $this->db->query($sql); 
        $data['result_sub'] = $query->result(); 
        $this->load->view('bom/show_up',$data);//bring $data to user_data 
        $this->load->view('footer');
        
       }
        else if(isset($bm)){
    $array= $this->model->bom($bm) ;
    $data['result_bom'] = $array;  
    $query=$this->db->query("SELECT * from bom inner join part on part.p_id=bom.b_master inner join drawing d on d.d_id=part.d_id where b_id = $bm");
    $res = $query->result();
    $data['bom']=$res;
    $data['bm']=$bm;
    $data['bm_id']=$res[0]->b_master;
    $sql =  'SELECT DISTINCT * FROM part where part.delete_flag !=0';
    $query = $this->db->query($sql); 
    $data['result_sub'] = $query->result(); 
    $this->load->view('bom/show',$data);//bring $data to user_data 
   $this->load->view('footer');
    }else{
        $this->load->view('bom/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
    }

        
    }

    
    public function edit_bom()
    {
        $bm = $this->uri->segment('3');
        $p_id =  $this->input->post('id');
        $m_id =  $this->input->post('m_id');
        $query=$this->db->query("SELECT * from bom inner join part on part.p_id=bom.b_master where b_id = $bm");
        $data['result'] = $query->result();
        $data['bm'] =$bm;
        $data['p_id'] =$p_id;
        $data['m_id'] =$m_id;
        $this->load->view('bom/edit_bom',$data);//bring $data to user_data 
		$this->load->view('footer');
    }
    public function edit_part()
    {
        $bm = $this->uri->segment('3');
        $p_no =  $this->input->post('p_no');
        $id =  $this->input->post('m_id');
        $query=$this->db->query("SELECT * from part inner join sub_part on sub_part.m_id=part.p_id where  sub_id =  $id");
        $data['result'] = $query->result(); 
        $data['bm'] =$bm;
        $data['p_no'] =$p_no;
        $data['m_id'] =$id;
        $this->load->view('bom/edit_part',$data);//bring $data to user_data 
		$this->load->view('footer');
    }
    public function add()
    {
        $sql =  'SELECT p.p_id, p.p_no, p.p_name, p.enable from part as p where delete_flag != 0 ';
        $query = $this->db->query($sql); 
        $data['result_p'] = $query->result(); 
        $this->load->view('bom/add',$data);//bring $data to user_data 
		$this->load->view('footer');
    }


    public function delete()
    {

        $bm =  $this->input->post('bm');
        $m_id =  $this->input->post('m_id');
        $this->model->delete_sub($m_id);
        redirect('bom/manage/'.$bm.'','refresh');
    }
    public function delete_bom()
    {
        $bm = $this->uri->segment('3');
        $this->model->delete_bom($bm);
        redirect('bom/manage','refresh');
    }

    public function insert_bom()
    {
        $bm =  $this->input->post('bm');
        $p_id =  $this->input->post('p_id');
        $lasted_id = $this->model->insert_bom($bm);
        foreach ($p_id as $p) {
            $chk= $this->model->insert_sub_part($bm, $p,$lasted_id);
            }
        redirect('bom/manage/'.$lasted_id.'','refresh');
    }

    public function insert_edit_part()
    {    $bm = $this->uri->segment('3');
        $m_id =  $this->input->post('m_id');
        $qty =  $this->input->post('quantity');
        $unit =  $this->input->post('unit');
        $c_p =  $this->input->post('common_part');
        $lasted_id = $this->model->insert_edit_part($m_id,$qty,$unit ,$c_p );
       
        redirect('bom/manage/'.$bm.'','refresh');
    }
    public function insert_edit_bom()
    {    $bm = $this->uri->segment('3');
        $qty =  $this->input->post('quantity');
        $unit =  $this->input->post('unit');
        $c_p =  $this->input->post('common_part');
        $lasted_id = $this->model->insert_edit_bom($bm,$qty,$unit ,$c_p );
       
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
        $chk= $this->model->insert_sub_part($b_master,$p, $bm);
        }
        redirect('bom/manage/'.$bm.'','refresh');

  
    }


  

}

