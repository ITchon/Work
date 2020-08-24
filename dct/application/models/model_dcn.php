<?php

class Model_dcn extends CI_Model
{
  
    public function get_dcn_byid($text)
    {
        $sql =  "SELECT dc.dcn_id, dc.dcn_no,dc.file_name as dcn_file,dc.path_file as dcn_path
        ,dc.file_code as dcn_code,dc.enable,dc.tf_id,tf.tf_fol
        from dcn as dc
        LEFT JOIN type_file as tf on tf.tf_id  = dc.tf_id
        where dc.delete_flag != 0 $text";
         $query = $this->db->query($sql);
        $result =  $query->result();
      return $result;
    }

    
public function enableDcn($key=''){

  $sqlEdt = "UPDATE dcn SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE dcn_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function disableDcn($key=''){

  $sqlEdt = "UPDATE dcn SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE dcn_id={$key};";
  $exc_user = $this->db->query($sqlEdt);
  
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function get_type_dcn()
{
  $sql =  "SELECT * from type_file where delete_flag != 0 AND tf_group = 2 OR tf_group = 0";
     $query = $this->db->query($sql);
    $result =  $query->result();
  return $result;
}


    
    public function delete_dcn($id) {
      $sql ="UPDATE DCN SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE dcn_id = '$id'";
      $query = $this->db->query($sql);
         if ($query) { 
            return true; 
         } 
         else{
        return false;
      }
      }


    public function insert_dcn($dcn_no,$path,$file,$code,$tf_id)
    {
      $path = quotemeta($path);
      $num= $this->db->query("SELECT * FROM dcn where dcn_no = '$dcn_no'"); 
    $chk= $num->num_rows();
  
   if($chk < 1){
      $sql  = "INSERT INTO dcn (dcn_no, date_created, delete_flag, enable, path_file, file_name, file_code,tf_id) VALUES  
      ('$dcn_no', CURRENT_TIMESTAMP, '1', '1','$path','$file','$code','$tf_id')";
    $query= $this->db->query($sql); 
    if($query){
        return true;
    }
   }else{
      return false;
   }
  
    }

  public function save_dcn($dcn_id,$dcn_no,$path_file,$file_name,$tf_id)
  {
     $sql ="UPDATE dcn SET dcn_no = '$dcn_no', path_file = '$path_file', file_name = '$file_name', date_updated = CURRENT_TIMESTAMP,tf_id = '$tf_id' WHERE dcn_id = '$dcn_id'";
    $exc_user = $this->db->query($sql);
    if ($exc_user ){ 
      return true; 
    }else{ 
      return false; 
    }
  }

}

?>