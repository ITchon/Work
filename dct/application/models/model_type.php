<?php

class Model_type extends CI_Model
{
    function insert_type($type_name,$fol_name)
    {
     $sql ="INSERT INTO type_file (tf_name,tf_fol,delete_flag,tf_group) VALUES ( '$type_name', '$fol_name', '1','1' );";
       $query = $this->db->query($sql);  
      if($query){
        return true;
      }
      else{
        return false;
      }
    }

    public function delete_type($id) {
        $sql ="UPDATE type_file SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE tf_id = '$id'";
        $query = $this->db->query($sql);
           if ($query) { 
              return true; 
           } 
           else{
          return false;
        }
        }

    public function save_edit_tf($tf_id, $tf_name,$tf_fol)
        {
           $sql1 ="UPDATE type_file SET tf_name = '$tf_name',tf_fol = '$tf_fol', date_updated = CURRENT_TIMESTAMP WHERE tf_id = '$tf_id'";
          $exc_user = $this->db->query($sql1);
          if ($exc_user ){ return true; }else{ return false; }
        }
      
}

?>