<?php

class Model_permission extends CI_Model
{
    
    



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

    public function enablePermission($key=''){

        $sqlEdt = "UPDATE sys_permissions SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE sp_id={$key};";
         $exc_user = $this->db->query($sqlEdt);
            
        if ($exc_user){
              
              return TRUE;  
              
        }else{  return FALSE; }
            
    }

    public function disablePermission($key=''){

        $sqlEdt = "UPDATE sys_permissions SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE sp_id={$key};";
        $exc_user = $this->db->query($sqlEdt);
        
        if ($exc_user){
          
          return TRUE;  
          
        }else{  return FALSE; }
        
      }

    public function save_edit_part($p_id, $p_no, $p_name,$d_id)
    {
     $sql1 ="UPDATE part SET p_no = '$p_no', p_name = '$p_name', d_id = '$d_id', date_updated = CURRENT_TIMESTAMP, delete_flag = '1' WHERE p_id = '$p_id'";
    $exc_user = $this->db->query($sql1);
    if ($exc_user ){ return true; }else{ return false; }
    } 
    
    public function save_edit_p($sp_id, $spg_id, $sp_name)
    {
       $sql1 ="UPDATE sys_permissions SET name = '$sp_name', spg_id = '$spg_id', date_updated = CURRENT_TIMESTAMP WHERE sp_id = '$sp_id'";
      $exc_user = $this->db->query($sql1);
      if ($exc_user ){ return true; }else{ return false; }
    }       
}

?>