<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->database(); 
        $this->load->model('model');
        $this->load->model('model_dashboard');
        $this->model->CheckSession();
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $this->model->load_menu();
    }
	public function index()
	{	
        $data['drawing_file'] = $this->model_dashboard->drawing_file();
        
        $sql = "SELECT COUNT(file_name) as file_name FROM drawing where delete_flag != 0";
        $query = $this->db->query($sql);
        $drawing = $query->result();
        $data['drawing_all'] = $drawing[0]->file_name;
        //-------------------------------------------------------------------------------
        
        $data['standard_file'] = $this->model_dashboard->standard_file();

        $sql = "SELECT COUNT(file_name) as file_name FROM standard where delete_flag != 0";
        $query = $this->db->query($sql);
        $standard = $query->result();
        $data['standard_all'] = $standard[0]->file_name;
        //-------------------------------------------------------------------------------

        $sql2 = "SELECT COUNT(p_id) as p_id FROM Part where delete_flag != 0";
        $query = $this->db->query($sql2);
        $part = $query->result();
        $data['part'] = $part[0]->p_id;
        //-------------------------------------------------------------------------------

        $sql4 = "SELECT COUNT(b_id) as b_id FROM BOM where delete_flag != 0";
        $query = $this->db->query($sql4);
        $bom = $query->result();
        $data['bom'] = $bom[0]->b_id;
        //-------------------------------------------------------------------------------

        $sql4 = "SELECT COUNT(cus_id) as cus_id FROM customers where delete_flag != 0";
        $query = $this->db->query($sql4);
        $cus = $query->result();
        $data['cus'] = $cus[0]->cus_id;
        //-------------------------------------------------------------------------------

        $sql4 = "SELECT COUNT(dcn_id) as dcn_id FROM dcn where delete_flag != 0 AND file_name RLIKE('DCN')";
        $query = $this->db->query($sql4);
        $dcn = $query->result();
        $data['dcn_all'] = $dcn[0]->dcn_id;

        $sql = "SELECT file_name FROM dcn WHERE delete_flag != 0 AND file_name RLIKE('DCN') ORDER BY file_name DESC";
        $query = $this->db->query($sql);
        $dcn = $query->result();
        $year_name = [];
        foreach($dcn as $dc){
            $name = substr($dc->file_name,0,5); //cut file_name
            array_push($year_name,$name);
        }
        $dcnyear = array_unique($year_name); //cut same file_name
        $dcnyear = str_replace(' ', '', $dcnyear);

        $total_file = [];
        foreach($dcnyear as $d){
            $sql = "SELECT COUNT(dcn_id) as dcn_id FROM dcn WHERE delete_flag != 0 AND file_name RLIKE('$d')";
            $query = $this->db->query($sql);
            $dcn = $query->result();
            array_push($total_file,$dcn);
        }
        $dcn_file =[];
        foreach($total_file as $d){
            foreach($d as $c){
                array_push($dcn_file,$c->dcn_id);
            }
        }
        $data['dcnyear'] = array_combine($dcnyear, $dcn_file); //mix array name & value
        //-------------------------------------------------------------------------------


		$this->load->view('dashboard',$data);
		$this->load->view('footer');
	}

    function view_list()
{
$this->load->view('dcn/manage');
}
}
