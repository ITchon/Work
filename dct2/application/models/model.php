<?php

class Model extends CI_Model
{

  public function CheckSession()        
  {
      if($this->session->userdata('login')!="OK") {
        echo "<script>alert('Please Login')</script>";
        redirect('login','refresh');
     return FALSE;
     
      }else{  return TRUE;  }
  }
  public function get_drawing()
  {
    $sql ="SELECT * FROM drawing";
    $query = $this->db->query($sql); 
   return $query;
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
  $sql ="INSERT INTO sys_users (sug_id, username, password, firstname, lastname, gender, email, enable, date_created, date_updated,delete_flag) VALUES ( '$sug_id', '$username', '$password', '$fname', '$lname', '$gender', '$email', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1' );";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }


//function insert_part_drawing($p,$d)
//{

// $sql ="INSERT INTO part_drawing (p_id,d_id,enable,date_created,delete_flag) VALUES ('$p','$d','1',CURRENT_TIMESTAMP,'1');";
//   $query = $this->db->query($sql);  
//  if($query){
//    return true;
//  }
//  else{
//    return false;
//  }
//}


 function insert_part($p_no,$p_name)
 {
  $sql ="INSERT INTO part (p_no,p_name,enable,date_created,delete_flag) VALUES ( '$p_no', '$p_name', '1', CURRENT_TIMESTAMP,'1');";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }


 function insert_part2($d)
 {
  $maxid=0;
  $gg ="SELECT MAX(p_id) as maxid from part";
  $row = $this->db->query($gg)->row();
 if($row){
  $maxid = $row->maxid;
 }

  $sql ="INSERT INTO part_drawing (p_id,d_id,enable,date_created,delete_flag) VALUES ( '$maxid', '$d', '1', CURRENT_TIMESTAMP,'1');";
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
  $sql ="INSERT INTO sys_user_groups (name,enable,date_created,delete_flag) VALUES ( '$gname', '1', CURRENT_TIMESTAMP,  '1' );";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }
 function insert_drawing($d_no,$dcn_id)
 {
<<<<<<< HEAD
  $sql ="INSERT INTO drawing (d_no,enable,date_created,delete_flag) VALUES ( '$d_no', '1', CURRENT_TIMESTAMP,  '1');";
=======
  $sql ="INSERT INTO drawing (d_no,dcn_id,enable,date_created,delete_flag,version) VALUES ( '$d_no','$dcn_id', '1', CURRENT_TIMESTAMP,  '1' ,'00');";
>>>>>>> 4032de28c05971594b24ae4e858f44fe1b3e4e04
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }
 function insert_dcn($dcn_no)
 {
  $sql ="INSERT INTO dcn (dcn_no,enable,date_created,delete_flag) VALUES ( '$dcn_no', '1', CURRENT_TIMESTAMP,  '1');";
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
    
  }else{  return FALSE; }
  
}

public function num_enableUser($para){
  
  for($i=0;$i<count($para);$i++){
    
    $this->enableUser($para[$i]);
    
  }
  
  return TRUE;
  
}

public function disableUser($key=''){

  $sqlEdt = "UPDATE sys_users SET enable='0' , date_updated=CURRENT_TIMESTAMP WHERE su_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_disableUser($para){

  for($i=0;$i<count($para);$i++){
    
    $this->disableUser($para[$i]);
    
  }
  
  return TRUE;
  
}



 public function enableGroup($key=''){

  $sqlEdt = "UPDATE sys_user_groups SET enable='1' , date_updated=CURRENT_TIMESTAMP WHERE sug_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_enableGroup($para){
  
  for($i=0;$i<count($para);$i++){
    
    $this->enableGroup($para[$i]);
    
  }
  
  return TRUE;
  
}

public function disableGroup($key=''){

  $sqlEdt = "UPDATE sys_user_groups SET enable='0' , date_updated=CURRENT_TIMESTAMP WHERE sug_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_disableGroup($para){

  for($i=0;$i<count($para);$i++){
    
    $this->disableGroup($para[$i]);
    
  }
  
  return TRUE;
    
}

public function enablePermission($key=''){

  $sqlEdt = "UPDATE sys_permissions SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE sp_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_enablePermission($para){
  
  for($i=0;$i<count($para);$i++){
    
    $this->enablePermission($para[$i]);
    
  }
  
  return TRUE;
  
}

public function disablePermission($key=''){

  $sqlEdt = "UPDATE sys_permissions SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE sp_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_disablePermission($para){

  for($i=0;$i<count($para);$i++){
    
    $this->disableGroup($para[$i]);
    
  }
  
  return TRUE;
  
}

public function enablePermission_Group($key=''){

  $sqlEdt = "UPDATE sys_permission_groups SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE spg_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_enablePermission_Group($para){
  
  for($i=0;$i<count($para);$i++){
    
    $this->enablePermission_Group($para[$i]);
    
  }
  
  return TRUE;
  
}

public function disablePermission_Group($key=''){

  $sqlEdt = "UPDATE sys_permission_groups SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE spg_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_disablePermission_Group($para){

  for($i=0;$i<count($para);$i++){
    
    $this->disableGroup_Group($para[$i]);
    
  }
  
  return TRUE;
  
}


public function enableDrawing($key=''){

  $sqlEdt = "UPDATE drawing SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE d_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_enableDrawing($para){
  
  for($i=0;$i<count($para);$i++){
    
    $this->enableDrawing($para[$i]);
    
  }
  
  return TRUE;
  
}

public function disableDrawing($key=''){

  $sqlEdt = "UPDATE drawing SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE d_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_disableDrawing($para){

  for($i=0;$i<count($para);$i++){
    
    $this->disableDrawing($para[$i]);
    
  }
  
  return TRUE;
  
}



 public function enablePartD($key=''){

  $sqlEdt = "UPDATE part_drawing SET enable='1' , date_updated=CURRENT_TIMESTAMP WHERE pd_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_enablePartD($para){
  
  for($i=0;$i<count($para);$i++){
    
    $this->enablePartD($para[$i]);
    
  }
  
  return TRUE;
  
}

public function disablePartD($key=''){

  $sqlEdt = "UPDATE part_drawing SET enable='0' , date_updated=CURRENT_TIMESTAMP WHERE pd_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_disablePartD($para){

  for($i=0;$i<count($para);$i++){
    
    $this->disablePartD($para[$i]);
    
  }
  
  return TRUE;
  
}



public function enablePart($key=''){

  $sqlEdt = "UPDATE part_drawing SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE p_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_enablePart($para){
  
  for($i=0;$i<count($para);$i++){
    
    $this->enablePart($para[$i]);
    
  }
  
  return TRUE;
  
}

public function disablePart($key=''){

  $sqlEdt = "UPDATE part SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE p_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function num_disablePart($para){

  for($i=0;$i<count($para);$i++){
    
    $this->disablePart($para[$i]);
    
  }
  
  return TRUE;
  
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

   public function deluser_permission($su_id) { 

  $sql1  =  "DELETE FROM sys_users_permissions WHERE su_id = $su_id";
      $query = $this->db->query($sql1); 
   }

   public function insertuser_permission($su_id,$sp) { 


     $sql  = "
      INSERT INTO sys_users_permissions(su_id, sp_id, date_created)VALUES('$su_id', '$sp',CURRENT_TIMESTAMP) ";
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
