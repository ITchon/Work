<?php

class Model extends CI_Model
{

  public function CheckSession()        
  {
      if($this->session->userdata('login')!="OK") {
        echo "<script>alert('Please Login')</script>";
        redirect('login','refresh');
     return FALSE;
     
      }else{	return TRUE; 	}
  }
  public function get_drawing()
  {
    $sql ="SELECT * FROM drawing";
    $query = $this->db->query($sql); 
   return $query;
  }

  public function sub_part($id)
  { 
    $sql =  'SELECT p_id FROM sub_part where m_id = '.$id.' ';
    $query = $this->db->query($sql); 
    if($query){
      $result= $query->result();
      return $result;
    }else{
      return false;
    }
    
  }



  public function sort_bom($lv,$p_id)
  {
    $array=[];
     do{
      $a= array('lv'=>$lv,'id'=>$p_id);
      array_push($array,$a);
      $result= $this->model->sub_part($p_id);
      foreach($result as $r){
        $p_id= $r->p_id;
      }
      $lv++;
     }while($result!=false);
    return $array;
  }

  public function hook_bom($bm)
  {
    $sql =  'SELECT * FROM bom where b_master = '.$bm.' ';
    $query = $this->db->query($sql); 
    return $query->result(); 
  }

  public function get_part_drawing()
  {
    $sql ="   SELECT pd.pd_id,p.p_name,d.d_no FROM part_drawing  pd 
    inner join part p on pd.p_id=p.p_id 
    inner join drawing d on pd.d_id=d.d_id";
    $query = $this->db->query($sql); 
     return $query;
  }
  public function CheckPermission($para){
		
		$get_url = trim($this->router->fetch_class().'/'.$this->router->fetch_method());

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
  
  public function getuser($user,$pass) {  
    $pass = base64_encode(trim($pass));
    $sql ="SELECT u.su_id as su_id , u.enable as u_enable ,ug.enable as sug_enable ,u.username as username, ug.sug_id  FROM sys_users as u
    inner join sys_user_groups ug on u.sug_id = ug.sug_id
    
    WHERE username='$user' and password='$pass' ";
  $query = $this->db->query($sql);  

if($query->num_rows()!=0) {
$result = $query->result_array();
  return $result[0];  
  }
else{		
return false;
  }

} 
 function showmenu(){
    $sql =  'SELECT
    DISTINCT smg.name AS g_name,
    smg.icon_menu,
    sm.mg_id,
    smg.mg_id AS mg,
    smg.order_no
    FROM
    sys_menus AS sm 
    inner JOIN sys_menu_groups AS smg ON smg.mg_id = sm.mg_id
    ORDER BY smg.order_no ASC;';    
    $query = $this->db->query($sql); 
    $result = $query->result();
    return $result;
 }
 function givemeid($para){
  $sql ="SELECT *  FROM sys_menus 
  WHERE method='$para'  ";
    $query = $this->db->query($sql);  
   $data = $query->result(); 
   return $data;
 }

 function insert($fname,$lname,$username,$password,$gender,$email,$sug_id)
 {


  $num= $this->db->query("SELECT COUNT(`username`) FROM sys_users where username = '$username'"); 
  $chk= $num->num_rows();
 if($chk!=1){
    $sql1 ="INSERT INTO sys_users (sug_id, username, password, firstname, lastname, gender, email, enable, date_created, date_updated,delete_flag) VALUES ( '$sug_id', '$username', '$password', '$fname', '$lname', '$gender', '$email', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1' )";
  $query= $this->db->query($sql1); 
  if($query){
      return true;
  }else{
    return 3;
  }
 }
 return false;

   
 }


 function insert_part_drawing($p,$d)
 {

  $sql ="INSERT INTO part_drawing (p_id,d_id,enable,date_created,delete_flag) VALUES ('$p','$d','1',CURRENT_TIMESTAMP,'1');";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }  
 }

 function insert_bom($bm,$p)
 {
  $sql ="INSERT INTO bom (b_master,p_id) VALUES ('$bm','$p');";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }  
 }

 function insert_sub_part($p,$d)
 {
  if($p == $d){
    return false;
    echo "Same";
  }else{
  $num= $this->db->query("  SELECT * FROM `sub_part` where `m_id` = $p and `p_id`= $d "); 
  $num1= $this->db->query("  SELECT * FROM `sub_part` where `m_id` = $d and `p_id`= $p "); 
  // $num2= $this->db->query("  SELECT * FROM `sub_part` where `m_id` = $d "); 
  $chk= $num->num_rows();
  $chk1= $num1->num_rows();
  // $chk2= $num2->num_rows();
  }
  if($chk!=1  && $chk1 != 1){
  // $sql ="INSERT INTO sub_part (p_id,sub_p_id,enable,date_created,delete_flag) VALUES ('$p','$d','1',CURRENT_TIMESTAMP,'1');";
  $sql ="INSERT INTO sub_part (m_id,p_id) VALUES ('$p','$d');";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
  }
  else{
    echo "????";
    return false;
  }

}


 function insert_part($p_no,$p_name,$d_no, $lv ,$master)
 {
  $sql ="INSERT INTO part (p_no,p_name,d_id,p_lv,p_master,enable,date_created,delete_flag) VALUES ( '$p_no', '$p_name', '$d_no', '$lv','$master' ,'1',CURRENT_TIMESTAMP,'1');";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }
 function insert_group($gname)
 {
  $num= $this->db->query("SELECT * FROM sys_user_groups where name = '$gname'"); 
  $chk= $num->num_rows();
 if($chk!=1){
  $sql ="INSERT INTO sys_user_groups (name,enable,date_created,delete_flag) VALUES ( '$gname', '1', CURRENT_TIMESTAMP,  '1' );";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return 3;
   }
  }
  return false;
 }

 function insert_drawing($d_no)
 {
  $sql ="INSERT INTO drawing (d_no,enable,date_created,delete_flag,version) VALUES ( '$d_no', '1', CURRENT_TIMESTAMP,  '1' ,'00');";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }

  function select_version($d_id)
 {
  $sql ="SELECT * FROM drawing WHERE d_id = $d_id ;";
  $query = $this->db->query($sql);
  $data = $query->result();

  $d_id =  $data[0]->d_id;
  $version =  $data[0]->version;
  $file_name =  $data[0]->file_name;
  $d_no =  $data[0]->d_no;
  $dcn_id =  $data[0]->dcn_id;

  $gg ="INSERT INTO version (d_id, d_no, dcn_id, enable, date_created, file_name, version) VALUES ( '$d_id', '$d_no', '$dcn_id', '0',
   CURRENT_TIMESTAMP, '$file_name', '$version');";
  $query = $this->db->query($gg); 


 }

 function update_version($d_id, $d_no, $dcn_id, $version, $file_name)
 {
  $v = $version+1;
  $sql ="UPDATE drawing SET d_no = '$d_no' , date_updated=CURRENT_TIMESTAMP, dcn_id = '$dcn_id', version = '$v', file_name = '$file_name' WHERE d_id = '$d_id'";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }


 function insert_permission($gname, $controller, $spg_id)
 {
  $sql ="INSERT INTO sys_permissions (spg_id,name,controller,enable,date_created,delete_flag) VALUES ( '$spg_id', '$gname', '$controller', '1', CURRENT_TIMESTAMP,  '1' );";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }

 function insert_permissiongroup($gname)
 {
  $sql ="INSERT INTO sys_permission_groups (name,enable,date_created,delete_flag) VALUES ( '$gname', '1', CURRENT_TIMESTAMP,  '1' );";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }



 public function enableUser($key=''){

  $sqlEdt = "UPDATE sys_users SET enable='1' , date_updated=CURRENT_TIMESTAMP WHERE su_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;	
    
  }else{	return FALSE;	}
  
}


public function disableUser($key=''){

  $sqlEdt = "UPDATE sys_users SET enable='0' , date_updated=CURRENT_TIMESTAMP WHERE su_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;	
    
  }else{	return FALSE;	}
  
}





 public function enableGroup($key=''){

  $sqlEdt = "UPDATE sys_user_groups SET enable='1' , date_updated=CURRENT_TIMESTAMP WHERE sug_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}



public function disableGroup($key=''){

  $sqlEdt = "UPDATE sys_user_groups SET enable='0' , date_updated=CURRENT_TIMESTAMP WHERE sug_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}



public function enablePermission($key=''){

  $sqlEdt = "UPDATE sys_permissions SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE sp_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}


public function disablePermission($key=''){

  $sqlEdt = "UPDATE sys_permissions SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE sp_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}



public function enablePermission_Group($key=''){

  $sqlEdt = "UPDATE sys_permission_groups SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE spg_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}



public function disablePermission_Group($key=''){

  $sqlEdt = "UPDATE sys_permission_groups SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE spg_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}




public function enableDrawing($key=''){

  $sqlEdt = "UPDATE drawing SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE d_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}


public function disableDrawing($key=''){

  $sqlEdt = "UPDATE drawing SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE d_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}


public function enableDrawing_v($key=''){

  $sqlEdt = "UPDATE version SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE v_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}



public function disableDrawing_v($key=''){

  $sqlEdt = "UPDATE version SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE v_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}




 public function enablePartD($key=''){

  $sqlEdt = "UPDATE part_drawing SET enable='1' , date_updated=CURRENT_TIMESTAMP WHERE pd_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}


public function disablePartD($key=''){

  $sqlEdt = "UPDATE part_drawing SET enable='0' , date_updated=CURRENT_TIMESTAMP WHERE pd_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}




public function enablePart($key=''){

  $sqlEdt = "UPDATE part SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE p_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}


public function disablePart($key=''){

  $sqlEdt = "UPDATE part SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE p_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}





 public function delete_user($id) {
   $sql ="UPDATE sys_users SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE su_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }

    public function delete_group($id) {
   $sql ="UPDATE sys_user_groups SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE sug_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }

   public function delete_permission($id) {
   $sql ="UPDATE sys_permissions SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE sp_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }

   public function delete_permissiongroup($id) {
   $sql ="UPDATE sys_permission_groups SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE spg_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }

   public function delete_drawing($id) {
   $sql ="UPDATE drawing SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE d_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }

   public function delete_part($id) {
   $sql ="UPDATE part SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE p_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }

   public function delete_partD($id) {
   $sql ="UPDATE part_drawing SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE pd_id = '$id'";
   $query = $this->db->query($sql);
      if ($query) { 
         return true; 
      } 
      else{
     return false;
   }
   }







}

?>
