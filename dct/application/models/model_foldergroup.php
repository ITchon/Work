<?php

class Model_foldergroup extends CI_Model
{
    function insert_foldergroup($folder_name,$fol_name)
    {
     $sql ="INSERT INTO folder_group (name,foldergroup_name,delete_flag,hidden) VALUES ( '$folder_name', '$fol_name', '1','0' );";
       $query = $this->db->query($sql);  
      if($query){
        return true;
      }
      else{
        return false;
      }
    }

    public function delete_foldergroup($id) {
        $sql ="UPDATE folder_group SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE fg_id = '$id'";
        $query = $this->db->query($sql);
           if ($query) { 
              return true; 
           } 
           else{
          return false;
        }
        }

    public function save_edit_foldergroup($f_id, $f_name,$folg_name)
        {
           $sql1 ="UPDATE folder_group SET name = '$f_name',foldergroup_name = '$folg_name', date_updated = CURRENT_TIMESTAMP WHERE fg_id = '$f_id'";
          $exc_user = $this->db->query($sql1);
          if ($exc_user ){ return true; }else{ return false; }
        }
      
}

?>