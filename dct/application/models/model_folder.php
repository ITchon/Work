<?php

class Model_folder extends CI_Model
{

 public function get_foldergroup()
  {
   $sql ="SELECT * from folder_group where delete_flag != 0 AND hidden !=1";
     $query = $this->db->query($sql);  
     $result = $query->result(); 
    if($query){
      return $result;
    }
    else{
      return false;
    }
  }
 public function get_foldergroup_byid($fg_id)
  {
   $sql ="SELECT * from folder_group where delete_flag != 0 AND hidden !=1 AND fg_id = $fg_id";
     $query = $this->db->query($sql);  
     $result = $query->result(); 
    if($query){
      return $result;
    }
    else{
      return false;
    }
  }
    function insert_folder($type_name,$fol_name,$fg_id)
    {
     $sql ="INSERT INTO folder (name,folder_name,delete_flag,fg_id) VALUES ( '$type_name', '$fol_name', '1','$fg_id' );";
       $query = $this->db->query($sql);  
      if($query){
        return true;
      }
      else{
        return false;
      }
    }

    public function delete_folder($id) {
        $sql ="UPDATE folder SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE f_id = '$id'";
        $query = $this->db->query($sql);
           if ($query) { 
              return true; 
           } 
           else{
          return false;
        }
        }

    public function save_edit_f($f_id, $f_name,$folder_name)
        {
           $sql1 ="UPDATE folder SET name = '$f_name',folder_name = '$folder_name', date_updated = CURRENT_TIMESTAMP WHERE f_id = '$f_id'";
          $exc_user = $this->db->query($sql1);
          if ($exc_user ){ return true; }else{ return false; }
        }
      
}

?>