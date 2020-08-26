<?php

class Model_customers extends CI_Model
{

public function insert_cus($cusname,$cusdes,$fg_id)
{
     $num= $this->db->query("SELECT * FROM customers where cus_name = '$cusname'"); 
     $chk= $num->num_rows();
    if($chk!=1){
     $sql ="INSERT INTO customers (cus_name,cus_des,fg_id,date_created,delete_flag) VALUES ( '$cusname', '$cusdes','$fg_id', CURRENT_TIMESTAMP,  '1' );";
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


public function insert_fg($fol_name)
{

     $sql ="INSERT INTO folder_group (fg_name,fg_fol) VALUES ( '$fol_name', '$fol_name' );";
       $query = $this->db->query($sql); 
       $last_id = $this->db->insert_id(); 
      if($query){
        return $last_id;
      }
      else{
        return false;
      }
     
}

    
public function delete_cus($id) 
{
    $sql ="UPDATE customers SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE cus_id = '$id'";
    $query = $this->db->query($sql);
       if ($query) { 
          return true; 
       } 
       else{
      return false;
    }
}

    
public function save_edit_cus($cus_id, $cus_name,$cus_des)
{
   $sql1 ="UPDATE customers SET cus_name = '$cus_name',cus_des = '$cus_des', date_updated = CURRENT_TIMESTAMP WHERE cus_id = '$cus_id'";
  $exc_user = $this->db->query($sql1);
  if ($exc_user ){ return true; }else{ return false; }
}

}

?>