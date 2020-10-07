<?php

class Model_dcn extends CI_Model
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
  
    public function get_dcn_byid($text)
    {
        $sql =  "SELECT dc.dcn_id,dc.dcn_no,dc.dcn_name,dc.model,cus.cus_name,dc.file_name,dc.path_file as dcn_path
        ,dc.file_code as dcn_code,dc.enable,dc.f_id,f.folder_name,fg.foldergroup_name
        from dcn as dc
        LEFT JOIN customers as cus on cus.cus_id  = dc.cus_id
        LEFT JOIN folder as f on f.f_id  = dc.f_id
        LEFT JOIN folder_group as fg on fg.fg_id  = f.fg_id
        where dc.delete_flag != 0 $text";
         $query = $this->db->query($sql);
        $result =  $query->result();
      return $result;
    }

      public function dcn_search($s_dno,$s_name)
  {

      $sql =  "SELECT dc.dcn_id,dc.dcn_no,dc.dcn_name,dc.model,cus.cus_name,dc.file_name,dc.path_file as dcn_path
        ,dc.file_code as dcn_code,dc.enable,dc.f_id,f.folder_name,fg.foldergroup_name
        from dcn as dc
        LEFT JOIN customers as cus on cus.cus_id  = dc.cus_id
        LEFT JOIN folder as f on f.f_id  = dc.f_id
        LEFT JOIN folder_group as fg on fg.fg_id  = f.fg_id
        where dc.delete_flag != 0 AND (dc.dcn_no LIKE '%$s_dno%' OR dc.dcn_name LIKE '%$s_name%') ";

      $query = $this->db->query($sql);
      $result =  $query->result();

      return $result;
  }


    public function get_customers()
  {
    $sql =  "SELECT * from customers where delete_flag != 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }



    
public function enableDcn($key){
  $query = $this->db->query("SELECT * from dcn WHERE dcn_id = $key "); 
  $result = $query->result()[0];
  if( $result->enable==0){
    $sqlEdt = "UPDATE dcn SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE dcn_id={$key};";
    $exc_user = $this->db->query($sqlEdt);
  }
  else{
    $sqlEdt = "UPDATE dcn SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE dcn_id={$key};";
    $exc_user = $this->db->query($sqlEdt);
  }
  if ($exc_user){
    
    return TRUE;  
    
  }else{  return FALSE; }
  
}

public function get_folder_dcn()
{
  $sql =  "SELECT * from folder where delete_flag != 0 AND fg_id = 2";
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


    public function insert_dcn($dcn_no,$dcn_name,$model,$cus_id,$file,$c,$f_id)
    {
      $num= $this->db->query("SELECT * FROM dcn where dcn_no = '$dcn_no' AND delete_flag != 0"); 
    $chk= $num->num_rows();
  
   if($chk < 1){
      $sql  = "INSERT INTO dcn (dcn_no,dcn_name,model,cus_id, date_created, delete_flag, enable, file_name,f_id) VALUES  
      ('$dcn_no','$dcn_name','$model','$cus_id', CURRENT_TIMESTAMP, '1', '1','$file','$f_id')";
    $query= $this->db->query($sql); 
    if($query){
        return true;
    }
   }else{
      return false;
   }
  
    }

  public function save_dcn($dcn_id,$dcn_no,$dcn_name,$model,$cus_id,$file,$f_id)
  {
     $sql ="UPDATE dcn SET dcn_no = '$dcn_no', dcn_name = '$dcn_name',model = '$model', cus_id = '$cus_id', file_name = '$file', date_updated = CURRENT_TIMESTAMP,f_id = '$f_id' WHERE dcn_id = '$dcn_id'";
    $exc_user = $this->db->query($sql);
    if ($exc_user ){ 
      return true; 
    }else{ 
      return false; 
    }
  }

}

?>