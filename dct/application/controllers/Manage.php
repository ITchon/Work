<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->database(); 
        $this->load->model('model');
        $this->model->CheckSession();
      $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $this->model->load_menu();
    }
	public function index()
	{	
        $sql = "SELECT COUNT(d_id) as d_id FROM Drawing where delete_flag != 0";
        $query = $this->db->query($sql);
        $drawing = $query->result();
        $data['drawing'] = $drawing[0]->d_id;

        $sql2 = "SELECT COUNT(p_id) as p_id FROM Part where delete_flag != 0";
        $query = $this->db->query($sql2);
        $part = $query->result();
        $data['part'] = $part[0]->p_id;

        $sql4 = "SELECT COUNT(b_id) as b_id FROM BOM where delete_flag != 0";
        $query = $this->db->query($sql4);
        $bom = $query->result();
        $data['bom'] = $bom[0]->b_id;

        $sql4 = "SELECT COUNT(cus_id) as cus_id FROM customers where delete_flag != 0";
        $query = $this->db->query($sql4);
        $bom = $query->result();
        $data['cus'] = $bom[0]->cus_id;

        $sql4 = "SELECT COUNT(dcn_id) as dcn_id FROM dcn where delete_flag != 0 AND file_name RLIKE('DCN')";
        $query = $this->db->query($sql4);
        $bom = $query->result();
        $data['dcnall'] = $bom[0]->dcn_id;

        $sql = "SELECT file_name FROM dcn WHERE delete_flag != 0 AND file_name RLIKE('DCN') ORDER BY file_name DESC";
        $query = $this->db->query($sql);
        $dcn = $query->result();
        $arr = [];
        foreach($dcn as $dc){
            $name = substr($dc->file_name,0,5);
            array_push($arr,$name);
        }
        $dcnyear = array_unique($arr); // Array is now (1, 2, 3)
        $filename =  implode(',',$dcnyear);
        $dcnyear = str_replace(' ', '', $dcnyear);
        $dcnfile = [];
        foreach($dcnyear as $d){
            $sql = "SELECT COUNT(dcn_id) as dcn_id FROM dcn WHERE delete_flag != 0 AND file_name RLIKE('$d')";
            $query = $this->db->query($sql);
            $dcn = $query->result();
            array_push($dcnfile,$dcn);
            
        }
        $dcn =[];
        foreach($dcnfile as $d){
            foreach($d as $c){
                array_push($dcn,$c->dcn_id);
            }
        }
        $data['dcnyear'] = array_combine($dcnyear, $dcn);

        
  //       $sql4 = "SELECT cus.cus_name,fg.foldergroup_name FROM folder_group as fg
		// inner join customers as cus on cus.fg_id = fg.fg_id
  //       where fg.delete_flag != 0";
  //       $query = $this->db->query($sql4);
  //       $data['result_cusf'] = $query->result();

  //       $sql4 = "SELECT cus.cus_name,fg.foldergroup_name,f.folder_name FROM folder_group as fg
		// inner join customers as cus on cus.fg_id = fg.fg_id
		// inner join folder as f on f.fg_id = fg.fg_id
  //       where fg.delete_flag != 0";
  //       $query = $this->db->query($sql4);
  //       $data['result_f'] = $query->result();



        $sql5 = "SELECT f.folder_name FROM folder as f where f.fg_id = 1";
        $query = $this->db->query($sql5);
        $filea = $query->result();
        $num = 0;
        foreach($filea as $f){
        $directory = './uploads/'.'Drawing/'.$f->folder_name.'/';
        $files = glob($directory . "*");
        if ($files){
        $fileall = count($files); 
        $num = $fileall+$num;
        }
        }
        $data['num_drawing'] = $num;

        $sql5 = "SELECT f.folder_name ,f.name as type FROM folder as f where f.fg_id = 1";
        $query = $this->db->query($sql5);
        $folder = $query->result();
        
        $data['folder_d'] = $folder;

        $sql5 = "SELECT f.folder_name ,f.name as type FROM folder as f where f.fg_id = 3";
        $query = $this->db->query($sql5);
        $folder = $query->result();
        
        $data['folder_std'] = $folder;

        $sql5 = "SELECT f.folder_name FROM folder as f where f.fg_id = 2";
        $query = $this->db->query($sql5);
        $filea = $query->result();
        $num1 = 0;
        foreach($filea as $f){
        $directory = './uploads/'.'DCN/'.$f->folder_name.'/';
        $files = glob($directory . "*");
        if ($files){
        $fileall = count($files); 
        $num1 = $fileall+$num1;
        }
        }
        $data['num_dcn'] = $num1;


		$this->load->view('dashboard',$data);
		$this->load->view('footer');
	}

    function view_list()
{
$this->load->view('dcn/manage');
}
}
