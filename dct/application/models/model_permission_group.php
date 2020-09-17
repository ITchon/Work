<?php

class Model_permission_group extends CI_Model
{

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

        public function save_edit_pg($spg_id, $spg_name)
        {
           $sql1 ="UPDATE sys_permission_groups SET name = '$spg_name', date_updated = CURRENT_TIMESTAMP WHERE spg_id = '$spg_id'";
          $exc_user = $this->db->query($sql1);
          if ($exc_user ){ return true; }else{ return false; }
        }
}

?>