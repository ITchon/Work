<?php

class Model_customersfile extends CI_Model
{

public function get_folder_by($f_id)
{ 
      $sql =  "SELECT fg.foldergroup_name as folg ,f.folder_name as fol
      FROM folder as f
      inner join folder_group as fg on fg.fg_id = f.fg_id
      where f.delete_flag != 0 AND f.f_id = '$f_id'";
      $query = $this->db->query($sql); 
      $result = $query->result()[0];
      return $result;
        
}

public function get_folder()
{
  $sql =  "SELECT * from folder where delete_flag != 0 AND fg_id NOT IN(1,2)";
     $query = $this->db->query($sql);
    $result =  $query->result();
  return $result;
}

public function get_customers()
{
     $sql ="SELECT * from customers where delete_flag != 0";
       $query = $this->db->query($sql);  
       $result =  $query->result();
      if($query){
        return $result;
      }
      else{
        return false;
      }
     
}
public function insert_cusf($cus_id,$cusf_des,$file_name,$f_id)
{
     $sql ="INSERT INTO customers_file (cusf_des,cus_id,file_name,f_id,delete_flag) VALUE('$cusf_des','$cus_id','$file_name','$f_id','1')";
       $query = $this->db->query($sql);  
      if($query){
        return true;
      }
      else{
        return false;
      }
     
}

public function save_edit_cusf($cusf_id,$cus_id,$cusf_des,$file_name,$f_id)
{
   $sql1 ="UPDATE customers_file SET cusf_des = '$cusf_des',file_name = '$file_name', cus_id ='$cus_id', f_id = '$f_id',
   date_updated = CURRENT_TIMESTAMP 
   WHERE cusf_id = '$cusf_id'";
  $exc_user = $this->db->query($sql1);
  if ($exc_user ){ return true; }else{ return false; }
}


}

?>