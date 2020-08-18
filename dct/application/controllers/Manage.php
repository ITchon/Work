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
        $sql = "SELECT COUNT(d_id) as d_id FROM Drawing";
        $query = $this->db->query($sql);
        $drawing = $query->result();
        $data['drawing'] = $drawing[0]->d_id;

        $sql2 = "SELECT COUNT(p_id) as p_id FROM Part";
        $query = $this->db->query($sql2);
        $part = $query->result();
        $data['part'] = $part[0]->p_id;

        $sql3 = "SELECT COUNT(d.d_id) as d_id
        FROM drawing as d
        LEFT JOIN Part as p on p.d_id = d.d_id
        WHERE p.d_id is null";
        $query = $this->db->query($sql3);
        $sum = $query->result();
        $data['sum'] = $sum[0]->d_id;

        $sql4 = "SELECT COUNT(b_id) as b_id FROM BOM";
        $query = $this->db->query($sql4);
        $bom = $query->result();
        $data['bom'] = $bom[0]->b_id;


        $sql5 = "SELECT tf.tf_name,tf.tf_fol FROM type_file as tf";
        $query = $this->db->query($sql5);
        $filea = $query->result();
        $num = 0;
        foreach($filea as $f){
        $directory = './uploads/'.$f->tf_fol.'/';
        $files = glob($directory . "*");
        if ($files){
        $fileall = count($files); 
        $num = $fileall+$num;
        }
        }
        $data['num'] = $num;

		$this->load->view('dashboard',$data);
		$this->load->view('footer');
	}

    function view_list()
{
$this->load->view('dcn/manage');
}
}
