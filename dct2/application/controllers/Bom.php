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
        $data['result'] = $query->result(); 

       if( $this->input->post('bm')){
          $bm =  $this->input->post('bm'); 
       }else{
        $bm = $this->uri->segment('3');
       }
        if(isset($bm)){
            $array=[];
            $res_bom= $this->model->hook_bom($bm) ;
            $data= $this->model->sub_part($res_bom[0]->b_master,$res_bom[0]->b_id) ;
            $bm =  $res_bom[0]->b_id;
            if($data != false){  
                $m_id =$data[0]->p_id;
                foreach($data as $r){
                    $data= $this->model->sub_part($r->p_id,$bm) ;
                    $a=array('lv'=>2,'id'=>$r->p_id,'m_id'=>$r->sub_id );
                    array_push($array,$a);
                    if($data != false){  
                        foreach($data as $r){
                            $data= $this->model->sub_part($r->p_id,$bm) ;
                            $a=array('lv'=>3,'id'=>$r->p_id,'m_id'=>$r->sub_id );
                            
                            array_push($array,$a);
                            if($data != false){  
                    
                                foreach($data as $r){
   
                                    $data= $this->model->sub_part($r->p_id,$bm) ;
                                    $a=array('lv'=>4,'id'=>$r->p_id,'m_id'=>$r->sub_id );
                                    
                                    array_push($array,$a);
                                    if($data != false){  
                            
                                        foreach($data as $r){
   
                                            $data= $this->model->sub_part($r->p_id,$bm) ;
                                            $a=array('lv'=>5,'id'=>$r->p_id,'m_id'=>$r->sub_id );
                                            
                                            array_push($array,$a);
                                            if($data != false){  
                                    
                                                foreach($data as $r){
   
                                                    $data= $this->model->sub_part($r->p_id,$bm) ;
                                                    $a=array('lv'=>6,'id'=>$r->p_id,'m_id'=>$r->sub_id );
                                                    
                                                    array_push($array,$a);
                                                    if($data != false){  
                                            
                                                        foreach($data as $r){
   
                                                            $data= $this->model->sub_part($r->p_id,$bm) ;
                                                            $a=array('lv'=>7,'id'=>$r->p_id,'m_id'=>$r->sub_id );
                                                            
                                                            array_push($array,$a);
                                                            if($data != false){  
                                                    
                                                                foreach($data as $r){
   
                                                                    $data= $this->model->sub_part($r->p_id,$bm) ;
                                                                    $a=array('lv'=>8,'id'=>$r->p_id,'m_id'=>$r->sub_id );
                                                                    
                                                                    array_push($array,$a);
                                                                    if($data != false){                                                             
                                                                        foreach($data as $r){
   
                                                                            $data= $this->model->sub_part($r->p_id,$bm) ;
                                                                            $a=array('lv'=>9,'id'=>$r->p_id,'m_id'=>$r->sub_id );
                                                                            
                                                                            array_push($array,$a);
                                                                            if($data != false){                                                             
                                                                                foreach($data as $r){
           
                                                                                    $data= $this->model->sub_part($r->p_id,$bm) ;
                                                                                    $a=array('lv'=>10,'id'=>$r->p_id,'m_id'=>$r->sub_id );
                                                                                    
                                                                                    array_push($array,$a);
                                                                                }
                                                                            }
                                                                       }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
         }

// print_r($array_sub_part);
    $data['result_bom'] = $array;  
    $query=$this->db->query("SELECT * from bom inner join part on part.p_id=bom.b_master inner join drawing d on d.d_id=part.d_id where b_id = $bm");
    $data['bom']=$query->result();
    $data['bm']=$bm;
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
        $result = $this->model->insert_bom($bm);
        $sql =  'SELECT * FROM bom where b_master = '.$bm.'   AND delete_flag != 0';
        $query = $this->db->query($sql);
        $res_bom= $query->result();
        $b_id = $res_bom[0]->b_id;
         foreach ($p_id as $p) {
        $chk= $this->model->insert_sub_part($bm,$p, $b_id);
        }

        redirect('bom/manage/'.$b_id.'','refresh');

  
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

