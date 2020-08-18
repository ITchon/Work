<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->database(); 
        
    }
	public function manage()
    {	
        $sql =  'select * from sys_users';
        $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 
        $sql =  'SELECT
		DISTINCT smg.name AS g_name,
		smg.icon_menu,
		sm.mg_id,
        smg.mg_id AS mg,
		smg.order_no
		FROM
		sys_menus AS sm 
		LEFT JOIN sys_menu_groups AS smg ON smg.mg_id = sm.mg_id
        ORDER BY smg.order_no ASC;';    
        $query = $this->db->query($sql); 
         $menu['menu'] = $query->result();
        
         $sql =  "select * from sys_menus ";
         $query = $this->db->query($sql); 
         $menu['submenu']= $query->result(); 
       $this->load->view('header',$menu);
        $this->load->view('user/manage',$data);//bring $data to user_data 
		$this->load->view('footer');
	}
}

