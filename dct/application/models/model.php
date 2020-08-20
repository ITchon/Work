<?php

class Model extends CI_Model
{


  public function CheckSession()        
  {
    if ($this->agent->is_mobile())
    {
      $id =  $this->session->userdata('su_id');
      $query = $this->db->query("SELECT * from sys_users WHERE su_id = $id AND enable != 0 "); 
      $result = $query->result()[0];
      if( $result->mobile==0){
      echo "<script>alert('No Moblie Permission')</script>";
      redirect('login','refresh');   
      exit;
      }
    }
      if($this->session->userdata('su_id')=="") {
        echo "<script>alert('Please Login')</script>";
        redirect('login','refresh');
     return FALSE;
     
      }else{    return TRUE;    }
  }
    public function load_menu()
  { 
    if($this->session->userdata('sug_id')!=3){
         $menu['menu'] = $this->model->showmenu($this->session->userdata('sug_id'),$this->session->userdata('su_id'));
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
         $menu['mg']= $this->model->givemeid($url);
          $menu['submenu'] = $this->model->showsubmenu($this->session->userdata('su_id'));
         $this->load->view('header');
        $this->load->view('menu',$menu);
    }else{
        $menu['menu'] = $this->model->showmenu_user($this->session->userdata('sug_id'),$this->session->userdata('su_id'));
        $url = trim($this->router->fetch_class().'/'.$this->router->fetch_method()); 
        $menu['mg']= $this->model->givemeid($url);
        $menu['submenu'] = $this->model->showsubmenu($this->session->userdata('su_id'));

         $this->load->view('header');
        $this->load->view('menu_user',$menu);
    }

      
  }
   function showmenu($sug_id,$su_id){
    $sql =  'SELECT DISTINCT smg.name AS g_name, smg.icon_menu, sm.mg_id, smg.mg_id AS mg, smg.order_no ,smg.link
    FROM sys_menus AS sm 
    inner JOIN sys_menu_groups AS smg ON smg.mg_id = sm.mg_id 
    inner join sys_permission_groups as spg ON spg.mg_id = sm.mg_id
    inner join sys_users_groups_permissions as sugp ON sugp.spg_id = spg.spg_id
    where sug_id = '.$sug_id.' 
    ORDER BY smg.order_no ASC';    
    $query = $this->db->query($sql); 
    $result = $query->result();
    return $result;
 }
 function showmenu_user($sug_id,$su_id){
  $sql =  'SELECT DISTINCT smg.name AS g_name, smg.icon_menu, sm.mg_id, smg.mg_id AS mg, smg.order_no ,smg.link,sp.sp_id,sup.su_id
  FROM sys_menus AS sm 
  inner JOIN sys_menu_groups AS smg ON smg.mg_id = sm.mg_id 
  inner join sys_permission_groups as spg ON spg.mg_id = sm.mg_id
  inner join sys_users_groups_permissions as sugp ON sugp.spg_id = spg.spg_id
  inner join sys_permissions as sp on sp.controller = smg.link
  inner join sys_users_permissions as sup on sup.sp_id = sp.sp_id
  where sug_id = '.$sug_id.' and sup.su_id = '.$su_id.'
  ORDER BY smg.order_no ASC';    
  $query = $this->db->query($sql); 
  $result = $query->result();
  return $result;
}

 function showsubmenu($id){
    $sql =  "SELECT  sm.name,sm.mg_id,sm.method from sys_menus as sm
    inner join sys_permissions as sp on sp.controller = sm.link
    inner join sys_users_permissions as sup on sup.sp_id = sp.sp_id
    WHERE order_no !=0 AND sm.enable != 0 AND sp.enable != 0 ANd sup.su_id = $id ORDER BY sm.order_no ASC"; 
    $query = $this->db->query($sql); 
    $result = $query->result(); 
    return $result;   
 }


 function givemeid($para){
  $sql ="SELECT *  FROM sys_menus 
  WHERE link='$para'  ";
    $query = $this->db->query($sql);  
   $data = $query->result(); 
   return $data;
 }


  public function CheckPermission($para){
        
        $get_url = trim($this->router->fetch_class().'/'.$this->router->fetch_method());
        if($this->session->userdata('sug_id') == 1) {
          
        }else{
       $sqlChkPerm = "SELECT sp.name,sp.controller
        FROM
        sys_users_permissions AS sup
        INNER JOIN sys_permissions AS sp ON sp.sp_id = sup.sp_id
        LEFT JOIN sys_permission_groups AS spg ON sp.spg_id = spg.spg_id
        WHERE
        sp.enable='1' AND spg.enable='1' AND sup.su_id='{$para}' AND sp.controller='{$get_url}';";
        
        $excChkPerm = $this->db->query($sqlChkPerm);
        $numChkPerm = $excChkPerm->num_rows();
        
        if($numChkPerm == 0) {
            
            echo '<script language="javascript">';
            echo 'alert("Permission not found.");';
            echo 'history.go(-1);';
            echo '</script>';
            exit();
            
        }
        }
 
  }
  public function CheckPermissionGroup($para){
    if($this->session->userdata('sug_id') == 1) {
        
        }else{
             $get_url = trim($this->router->fetch_class().'/'.$this->router->fetch_method());
    $sqlSelPerm = "SELECT
  p.sp_id,
  p.name,
    p.controller
  FROM
  sys_users_groups_permissions AS ugp
  LEFT JOIN sys_permission_groups AS pg ON pg.spg_id = ugp.spg_id
  inner JOIN sys_permissions AS p ON p.spg_id = pg.spg_id
  WHERE pg.enable='1' AND p.enable='1' AND ugp.sug_id='$para' AND p.controller='{$get_url}';";
    $excChkPerm = $this->db->query($sqlSelPerm);
    $numChkPerm = $excChkPerm->num_rows();
    if($numChkPerm == 0) {
    
    echo '<script language="javascript">';
    echo 'alert("Permission '.$get_url.' not found.");';
    echo 'history.go(-1);';
    echo '</script>';
    exit();
    
        }
   
    }
 }

   public function updated_profile_data($fname,$lname,$gender,$email,$su_id)
  {
     $sql1 ="UPDATE sys_users SET 
                      firstname      = '$fname',
                      lastname       = '$lname',
                      gender         = '$gender',
                      email          = '$email',
                      enable         = '1',
                      date_updated   = CURRENT_TIMESTAMP,
                      delete_flag    = '1' 

                       WHERE su_id          = '$su_id' ";
                      

    $exc_user = $this->db->query($sql1);
    if ($exc_user ){ return true; }else{ return false; }
  }
   public  function fetch_pass($session_id)
      {
        $fetch_pass=$this->db->query("SELECT * from sys_users where su_id='$session_id'");
        $res=$fetch_pass->result();
      }
     public function change_pass($session_id,$new_password)
      {
        $new_password = base64_encode(trim($new_password));
        $update_pass=$this->db->query("UPDATE sys_users set password='$new_password'  where su_id='$session_id'");
      }













 















// public function drawing_search($s_dno,$s_name,$s_pno)
//   {
// if($s_dno !=0){
//     $s_dno =  implode('|',(array)$s_dno);
//   }
// if($s_name !=0){
//     $s_name =  implode('|',(array)$s_name);
//   }
// if($s_pno !=0){
//     $s_pno =  implode('|',(array)$s_pno);
//   }
//       $sql =  "SELECT pd.d_id,pd.p_id , d.d_no,d.d_name,c.cus_id,c.cus_name, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no ,pd.p_id,dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code
//       from part_drawing as pd
//         left join drawing as d on d.d_id = pd.d_id
//         left join customers as c on c.cus_id = d.cus_id
//         left join dcn as dc on dc.dcn_id = d.dcn_id
//         left join part as p on p.p_id = pd.p_id
// where d.delete_flag != 0 AND d.d_no RLIKE '$s_dno' OR d.d_name RLIKE '$s_name' OR p.p_no RLIKE '$s_pno'";
//       $query = $this->db->query($sql); 
//       $result =  $query->result();

//       return $result;
//   }



  public function button_show($id,$pg_id)        
  {
  $query= $this->db->query(" SELECT * FROM `sys_permissions` sp inner join sys_users_permissions sup on sup.sp_id = sp.sp_id where su_id = $id and sp.spg_id =$pg_id"); 
            $data = $query->result(); 
            foreach ($data as $r ) {
                  $this->session->set_flashdata($r->button,'');
            }

  }


 

 

}

?>