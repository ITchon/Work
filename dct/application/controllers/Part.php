<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->database(); 
        $this->load->model('model');
        $this->load->model('model_part');
        $this->model->CheckSession();
        $this->model->load_menu();
        $this->model->button_show($this->session->userdata('su_id'),7);
    }

    public function exportCSV(){ 
        // file name 
        $filename = 'Part '.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
  
        // get data 
        $drwdata = $this->model_part->get_part();
        $head = $this->model_part->get_type();
        // $arr = [];
        // foreach($head as $h){
        //     array_push($arr,$h->name);
        // }
        // $head =  implode(',',$arr);
        // $head = '"'.implode('","', $arr).'"';
     
        // file creation 
        $file = fopen('php://output', 'w');
        $header = array("Part No","Part Name");
        foreach($head as $h){
            array_push($header,$h->name);
        } 
        array_push($header,'Status');
        //$header = array("Part No","Part Name","Status","PRODT DWG","CUST DWG","RM DWG","TEMP DWG"); 
        fputcsv($file, $header);
        $res= $this->model_part->get_part();
            foreach($res as $r){
                $num[] = $r->p_id;
              }
        $result_p = $this->model_part->get_part_outdrawing($num);
        $th = $this->model_part->get_type();
        foreach ($result_p as $r){ 
            $status = ($r->enable == '1') ? "Enable" : "Disable";
            $a = array($r->p_no,$r->p_name);
            foreach($th as $t){
                array_push($a,'');
            }
            array_push($a,$status);
            fputcsv($file,$a); 
            }
        $num= $this->db->query("SELECT f.f_id,f.name from folder as f
        where f.delete_flag != 0 AND f.fg_id = 1");
        $chk= $num->num_rows();

        foreach ($drwdata as $r){ 
        $status = ($r->enable == '1') ? "Enable" : "Disable";
            $a = array($r->p_no,$r->p_name);
            $i = 1;
            foreach($th as $t){
                if($r->f_id == $t->f_id){
                    $chk_dwg = $r->d_no;
                    array_push($a,$chk_dwg); 
                    if($i != $chk){
                        $sum = $chk-$i;
                        $s = 0;
                        foreach($th as $t){
                            if($s != $sum){
                            array_push($a,'');
                            }else{
                            array_push($a,$status);
                            fputcsv($file,$a); 
                            break;
                            }
                        $s++;
                        }
                    }else{
                        array_push($a,$chk_dwg);
                        array_push($a,$status);
                        fputcsv($file,$a); 
                    }
                }else{
                    $chk_dwg = '';
                    array_push($a,$chk_dwg);
                }
                $i++;
                }
        } 
        fclose($file); 
        exit; 
       }


	public function index()
    {	
    
	}

    
	public function manage()
    {	

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        
        $params = $_SERVER['QUERY_STRING'];
        $this->session->set_flashdata('search',$params);

        $s_pno =  $this->input->get('s_pno');
        $s_pname =  $this->input->get('s_pname');
        $data['s_pno'] = $s_pno;
        $data['s_pname'] = $s_pname;

        if($this->input->get('s_pno') == null){
            $s_pno = 'null';
        }
        
        if($this->input->get('s_pname') == null){
          $s_pname = 'null';
        }
        if($this->input->get('s_pno') == null && $this->input->get('s_pname') == null){
        $s_pname = '';
        $s_pno = '';
        }
        
        

        if($this->input->get('s_pno') != null || $this->input->get('s_pname') != null){
            $res = $this->model_part->part_search($s_pno,$s_pname);
            if($res != null){
                $data['result'] = $res;
            }else{
                $data['result_p'] = $this->model_part->part_search_common($s_pno,$s_pname);
            }

        }else{
            $res= $this->model_part->get_part();
            foreach($res as $r){
                $num[] = $r->p_id;
              }
            if($this->uri->segment('3')){
               $p_id = $this->uri->segment('3');
                $data['result'] = $this->model_part->get_part_by($p_id);
            }else if($res){
                $data['result_p']= $this->model_part->get_part_outdrawing($num);
                $data['result'] = $this->model_part->get_part();
              }else{
                $data['result'] = $this->model_part->get_part();
              }
            
        }
        $data['type']= $this->model_part->get_type();

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
        $lv =  $this->input->post('lv');
        $sub_id =  $this->input->post('sub_id');
        $origin =  $this->input->post('origin');
        $array = $this->model_part->filter($sub_id,$id);
        $_data = array();
        foreach ($array as $v) {
          if (isset($_data[$v['parent_id']])) {
            // found duplicate
            continue;
          }
          // remember unique item
          $_data[$v['parent_id']] = $v;
        }
        // if you need a zero-based array, otheriwse work with $_data
        $array = array_values($_data);
        
        $query = $this->db->query('SELECT * FROM bom where b_id = '.$id.'   AND delete_flag != 0');
        $res_bom= $query->result();
        $b_master = $res_bom[0]->pd_id;
        $sql =  "SELECT p.p_id, p.p_no, p.p_name, p.enable from part as p where delete_flag != 0 and p.p_id = '$p_id.'";
        $query = $this->db->query($sql); 
        $res = $query->result(); 
        $query = $this->db->query("SELECT  pd.p_id,pd.pd_id,p.p_no,p.p_name,d.d_no,d.d_name from part_drawing pd
        inner join part p on p.p_id = pd.p_id 
        inner join drawing d on d.d_id = pd.d_id where pd.pd_id != '$b_master.'"); 
        $res_part = $query->result(); 
        $data['res_chk'] =$array;
        $data['bm'] =$id;
        $data['p_id'] =$p_id;
        $data['p_no'] =$p_no;
        $data['origin'] =$origin;
        $data['sub_id'] =$sub_id;
        $data['result_p'] =$res_part;
        
        $data['lv'] =$lv;
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
        $query = $this->db->query("SELECT  pd.p_id,pd.pd_id,p.p_no,p.p_name,d.d_no,d.d_name from part_drawing pd
        inner join part p on p.p_id = pd.p_id 
        inner join drawing d on d.d_id = pd.d_id where pd.pd_id !=$m_id"); 
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
       $master = 0;
       if(isset($master)){
       $master =  $this->input->post('master');
       }
       $result = $this->model_part->insert_newpart($p_no,$p_name);

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
        $lv =  $this->input->post('lv');
        $origin =  $this->input->post('origin');
        foreach ($p_id as $p_id) {
            $lv++;
            $chk= $this->model_part->insert_sub_part($bm,$lv,$b_master,$p_id,$origin);
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
            $lv = 2 ;
            $sub_id= $this->model_part->insert_sub_part($bm,$lv,$b_master,$p_id,$bm);
            $chk= $this->model_part->update_sub_id($sub_id);
           }
           redirect('bom/manage/'.$bm.'','refresh');
    }


    public function enable(){

        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $uid = $this->uri->segment('3');
		$result = $this->model_part->enablePart($uid);

        $search = $this->session->flashdata('search');
		if($result!=FALSE){
            redirect('part/manage?'.$search.'','refresh');

		}else{
		    echo "<script>alert('Somting wrong')</script>";
         redirect('part/manage?'.$search.'','refresh');
		}
	}

	// public function disable($uid){

 //        $this->model->CheckPermission($this->session->userdata('su_id'));
 //        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

	// 	$result = $this->model_part->disablePart($uid);

	// 	if($result!=FALSE){
 //            redirect('part/manage/'.$uid.'','refresh');
	// 	}else{
 //            echo "<script>alert('Somting wrong')</script>";
 //            redirect('part/manage/'.$uid.'','refresh');

	// 	}
	// }

    public function deletepart()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $id = $this->uri->segment('3');
        $this->model_part->delete_part($id);
        redirect('part/manage/'.$id.'','refresh');
    }

    public function edit_part()   
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        
        if($this->input->post('bom')){
        $p_id =  $this->input->post('p_id');
        $sql =  "SELECT p.p_id, p.p_no, p.p_name,pd.d_id ,d.d_no
        from part as p
        left join part_drawing as pd on pd.p_id = p.p_id
        left join drawing as d on d.d_id = pd.d_id
        where p.p_id = $id";
        
        $data['gg'] = $this->input->post('bom');

        }else{
        $id = $this->uri->segment('3');
        $sql =  "SELECT p.p_id, p.p_no, p.p_name,pd.d_id ,d.d_no
        from part as p
        left join part_drawing as pd on pd.p_id = p.p_id
        left join drawing as d on d.d_id = pd.d_id
        where p.p_id = $id";
        }
        
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        
        $this->load->view('part/edit',$data);
        $this->load->view('footer');
  
    }

    public function save_edit()
    {
        $p_id =  $this->input->post('p_id');
        $p_no =  $this->input->post('p_no');
        $p_name =  $this->input->post('p_name');
        $d_id =  $this->input->post('d_id');

        $this->model_part->save_edit_part($p_id, $p_no, $p_name,$d_id);
        redirect('part/manage/'.$p_id.'','refresh');
        
    }  

        public function save_editb()
    {
        $bom =  $this->input->post('bom');
        $p_id =  $this->input->post('p_id');
        $p_no =  $this->input->post('p_no');
        $p_name =  $this->input->post('p_name');
        $d_id =  $this->input->post('d_id');
        
        $this->model_part->save_edit_partb($p_id, $p_no, $p_name,$d_id);
        redirect('bom/manage/'.$bom.'','refresh');
        
    }

}

