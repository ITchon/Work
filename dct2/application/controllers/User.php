<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() { 
    
        parent::__construct(); 
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->database(); 
        $this->load->model('model');
        $this->model->CheckSession();
        $this->model->button_show($this->session->userdata('su_id'),2);     
        $menu['menu'] = $this->model->showmenu($this->session->userdata('sug_id'));
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url);
          $menu['submenu'] = $this->model->showsubmenu($this->session->userdata('su_id'));
         $this->load->view('header');
        $this->load->view('menu',$menu);

    }
    public function manage()
    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $sql =  'SELECT su.su_id,su.password,su.username, su.firstname ,su.lastname, su.gender,su.email,su.enable,su.delete_flag, sug.name as name
    FROM
    sys_users  AS su 
    INNER JOIN sys_user_groups AS sug ON sug.sug_id = su.sug_id where su.delete_flag != 0 AND sug.sug_id != "1"';
        $query = $this->db->query($sql); 
       $data['result'] = $query->result(); 
        $this->load->view('user/manage',$data);//bring $data to user_data 
        $this->load->view('footer');
    }

    public function add()
    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $sql='SELECT * FROM sys_users  INNER JOIN sys_user_groups ON sys_users.sug_id=sys_user_groups.sug_id;';

        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 

        $sqlSelG = "SELECT * FROM sys_user_groups WHERE sug_id <>'1' AND enable='1' AND delete_flag != 0;";
        $query = $this->db->query($sqlSelG); 
        $data['excLoadG'] = $query->result(); 

        $this->load->view('user/add',$data);//bring $data to user_data 
        $this->load->view('footer');
    }

    public function rule()
    {   
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $decrypted_id = $this->uri->segment('3');
        $id = base64_decode($decrypted_id);
          $sql =  'SELECT su.su_id,su.password,su.username, su.firstname ,su.lastname, su.gender,su.email,su.enable,su.delete_flag, sug.name as name
    FROM
    sys_users  AS su 
    INNER JOIN sys_user_groups AS sug ON sug.sug_id = su.sug_id where su.delete_flag != 0 AND sug.sug_id != "1"';
            //$sql =  'select * from sys_users where delete_flag != 0';
            $query = $this->db->query($sql); 
            $data['result'] = $query->result(); 

            $sql =  'select * from sys_users_permissions where su_id = '.$id.'';
            $query = $this->db->query($sql); 
            $data['result_user']= $query->result(); 
     
            $sql =  "SELECT su.su_id,su.sug_id, su.firstname as su_name from sys_users as su where su.su_id = $id";
            $query = $this->db->query($sql); 
            $data['result_name']= $query->result(); 


            $sql =  'SELECT sp.sp_id,sp.name as p_name , spg.name as g_name ,sugp.spg_id ,sp.controller  FROM sys_permissions sp 
            INNER JOIN sys_users_groups_permissions sugp ON sugp.spg_id = sp.spg_id 
            inner join sys_permission_groups spg on spg.spg_id = sp.spg_id 
            where sugp.sug_id= '.$data['result_name'][0]->sug_id.' ORDER BY spg.spg_id ASC , sp.name';
            $query = $this->db->query($sql); 
            $data['result_group'] = $query->result();
     
         $this->load->view('user/manage',$data);//bring $data to user_data 
         $this->load->view('user/rule_user', $data);//bring $data to user_data 
     
        $this->load->view('footer');
   
    }


    public function insert()
    {

        $fname =  $this->input->post('fname');
        $lname  =  $this->input->post('lname');
        $gender =  $this->input->post('gender');
        $username =  $this->input->post('username');

        $password =  $this->input->post('password');
        $email  =  $this->input->post('email');
        $sug_id =  $this->input->post('sug_id');
       $result = $this->model->insert($fname,$lname,$username,$password,$gender,$email,$sug_id);
       if($result == true){
       // echo "<script>alert('Inserted Data Success')</script>";
         $this->session->set_flashdata('error','<div class="alert alert-success hide-it">  
          <span>  <b> Complete - </b> Inserted Data Success</span>
        </div> ');
        redirect('user/add','refresh'); 
       }
       if($result == false){
        //echo "<script>alert('Username already exist')</script>";
        $this->session->set_flashdata('error','<div class="alert alert-warning ">  
          <span>  <b> Warning - </b> Username already exist</span>
        </div> ');
        redirect('user/add','refresh'); 
       }
       if($result == 3){
        //echo "<script>alert('Error')</script>";
        $this->session->set_flashdata('error','<div class="alert alert-danger hide-it">  
          <span>  <b> Error - </b> Error!! please try again</span>
        </div> ');
        redirect('user/add','refresh'); 
       }
       

    }
    public function enable($uid){
         $id = base64_decode($uid);
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $result = $this->model->enableUser($id);

        if($result!=FALSE){
            redirect('user/manage','refresh');

        }else{
        
            echo "<script>alert('Simting wrong')</script>";
       redirect('user/manage','refresh');
        }
    }

    public function disable($uid){
        $id = base64_decode($uid);
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));
        $result = $this->model->disableUser($id);

        if($result!=FALSE){
            redirect('user/manage','refresh');
            

        }else{
            echo "<script>alert('Simting wrong')</script>";
            redirect('user/manage','refresh');

        }
    }

    public function deleteuser()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $decrypted_id = $this->uri->segment('3');
        $id = base64_decode($decrypted_id);
        $this->model->delete_user($id);
        $this->session->set_flashdata('success','<div class="alert alert-success hide-it">  
        <span>  Delete Success</span>
      </div> ');
        redirect('user/manage');
    }

    public function save_user_permission()
    {

        $id =  $this->input->post('su_id');
        $sp_id =  $this->input->post('sp_id');
        $su_id = base64_decode($id);
           $this->model->deluser_permission($su_id);
           if($sp_id != ''){
            foreach ($sp_id as $sp) {
         $this->model->insertuser_permission($su_id,$sp);
     }
           }

     redirect('user/manage','refresh');
 
    }

    public function edit_u()
    {
        $this->model->CheckPermission($this->session->userdata('su_id'));
        $this->model->CheckPermissionGroup($this->session->userdata('sug_id'));

        $decrypted_id = $this->uri->segment('3');
        $id = base64_decode($decrypted_id);
        $sql="SELECT * FROM sys_users  INNER JOIN sys_user_groups ON sys_users.sug_id=sys_user_groups.sug_id where su_id = '$id';";
        //$sql =  'SELECT * FROM sys_users ';
        $query = $this->db->query($sql); 
        $data['result'] = $query->result(); 
        if($query->result()==null){
         echo '<script language="javascript">';
         echo 'alert("Error");';
         echo 'history.go(-1);';
         echo '</script>';
         exit();
        }
        $gender = $data['result'][0]->gender;
        $g = $data['result'][0]->sug_id;


        $sqlSelG = "SELECT * FROM sys_user_groups WHERE sug_id<>'1' AND enable='1' AND delete_flag != 0 AND sug_id != $g;";
        $query = $this->db->query($sqlSelG); 
        $data['excLoadG'] = $query->result(); 

        $this->load->view('user/edit',$data);
        $this->load->view('footer');
  


    }

    public function save_edit()
    {
        $su_id =  $this->input->post('su_id');
        $username =  $this->input->post('username');
        $password =  $this->input->post('password');
        $gender =  $this->input->post('gender');
        $fname =  $this->input->post('fname');
        $lname =  $this->input->post('lname');
        $email =  $this->input->post('email');
        $sug_id =  $this->input->post('sug_id');

        $this->model->save_edit_u($su_id, $username, $password,$gender, $fname, $lname, $email, $sug_id);
        redirect('User/manage');
    }

    
}

