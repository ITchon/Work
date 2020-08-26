<?php

class Model_folder extends CI_Model
{
    function insert_folder($folder_name,$fol_name)
    {
     $sql ="INSERT INTO folder (name,folder_name,delete_flag,fg_id) VALUES ( '$folder_name', '$fol_name', '1','1' );";
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