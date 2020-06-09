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
    
        $menu['menu'] = $this->model->showmenu($this->session->userdata('sug_id'));
        $sql =  "SELECT * from sys_menus where order_no != 0 and enable != 0 ";
        $query = $this->db->query($sql); 
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url);
         $menu['submenu']= $query->result(); 
         $this->load->view('header');
         $this->load->view('menu',$menu);
    }
	public function index()
	{	
		$this->load->view('dashboard');
		$this->load->view('footer');
	}
}
