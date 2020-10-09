<?php

class Model_usergroup extends CI_Model
{

  public function get_usergroup()
  {
    $sql =  'SELECT * FROM sys_user_groups where delete_flag != 0 AND sug_id != 1';
    $query = $this->db->query($sql); 
    $result =  $query->result();
    return $result;
  }


    function insert_group($gname)
    {
     $num= $this->db->query("SELECT * FROM sys_user_groups where name = '$gname'"); 
     $chk= $num->num_rows();
    if($chk!=1){
     $sql ="INSERT INTO sys_user_groups (name,enable,date_created,delete_flag) VALUES ( '$gname', '1', CURRENT_TIMESTAMP,  '1' );";
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

    public function enableGroup($key=''){

        $sqlEdt = "UPDATE sys_user_groups SET enable='1' , date_updated=CURRENT_TIMESTAMP WHERE sug_id={$key};";
        $exc_user = $this->db->query($sqlEdt);
        
        if ($exc_user){
          
          return TRUE;  
          
        }else{  return FALSE; }
        
      }

      public function disableGroup($key=''){

        $sqlEdt = "UPDATE sys_user_groups SET enable='0' , date_updated=CURRENT_TIMESTAMP WHERE sug_id={$key};";
        $exc_user = $this->db->query($sqlEdt);
        
        if ($exc_user){
          
          return TRUE;  
          
        }else{  return FALSE; }
        
      } 

      public function save_edit_ug($sug_id, $sug_name)
      {
         $sql1 ="UPDATE sys_user_groups SET name = '$sug_name', date_updated = CURRENT_TIMESTAMP WHERE sug_id = '$sug_id'";
        $exc_user = $this->db->query($sql1);
        if ($exc_user ){ return true; }else{ return false; }
      }

      public function deluserg_permission($sug_id)
      {
        $sql  =  "DELETE FROM sys_users_groups_permissions WHERE sug_id = '$sug_id'";
        $query = $this->db->query($sql); 
        if ($query) { 
          return true; 
        } 
        else{
           return false;
        } 
      }

      public function insertuserg_permission($sug_id,$spg)
      {
         $sql  = "INSERT INTO sys_users_groups_permissions(sug_id, spg_id, date_created) VALUES  ('$sug_id','$spg',CURRENT_TIMESTAMP)";
         $query = $this->db->query($sql);
        if ($query) { 
          return true; 
        } 
        else{
           return false;
        }
      }     
      public function delete_group($id) {
        $sql ="UPDATE sys_user_groups SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE sug_id = '$id'";
        $query = $this->db->query($sql);
           if ($query) { 
              return true; 
           } 
           else{
          return false;
        }
        }    
}

?>