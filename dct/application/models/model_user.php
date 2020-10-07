<?php

class Model_user extends CI_Model
{

  
      public function get_user()
      {
        $sql =  'SELECT su.su_id,su.password,su.username, su.firstname ,su.lastname, su.gender,su.email,su.enable,su.delete_flag, sug.name as name,su.mobile
        FROM
        sys_users  AS su 
        INNER JOIN sys_user_groups AS sug ON sug.sug_id = su.sug_id where su.delete_flag != 0 AND sug.sug_id != "1"';
        $query = $this->db->query($sql); 
        $result =  $query->result();
        return $result;
      }

      function insert($fname,$lname,$username,$password,$gender,$email,$sug_id)
      {
     
     $password = base64_encode(trim($password));
       $num= $this->db->query("SELECT * FROM sys_users where username = '$username' AND delete_flag != 0"); 
       $chk= $num->result();
     
      if($chk==null){
         $sql1 ="INSERT INTO sys_users (sug_id, username, password, firstname, lastname, gender, email, enable, date_created, date_updated,delete_flag) VALUES ( '$sug_id', '$username', '$password', '$fname', '$lname', '$gender', '$email', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1' )";
       $query= $this->db->query($sql1); 
       if($query){
           return true;
        }else{
         return 3;
        }
      }
      return false;      
      }

      public function enableUser($key){
        $query = $this->db->query("SELECT * from sys_users WHERE su_id = $key "); 
        $result = $query->result()[0];
        if( $result->enable==0){
        $sqlEdt = "UPDATE sys_users SET enable='1' , date_updated=CURRENT_TIMESTAMP WHERE su_id={$key};";
        $exc_user = $this->db->query($sqlEdt);
        }
        else{
          $sqlEdt = "UPDATE sys_users SET enable='0' , date_updated=CURRENT_TIMESTAMP WHERE su_id={$key};";
          $exc_user = $this->db->query($sqlEdt);
        }
      
        if ($exc_user){
          
          return TRUE;    
          
        }else{    return FALSE;   }
        
      }

      public function mobile($key){
   
        if ($key){
          $query = $this->db->query("SELECT * from sys_users WHERE su_id = $key "); 
          $result = $query->result()[0];
          if( $result->mobile==0 ){
          $sqlEdt = "UPDATE sys_users SET mobile='1' , date_updated=CURRENT_TIMESTAMP WHERE su_id={$key};";
          $exc_user = $this->db->query($sqlEdt);
          }
          else{
            $sqlEdt = "UPDATE sys_users SET mobile='0' , date_updated=CURRENT_TIMESTAMP WHERE su_id={$key};";
            $exc_user = $this->db->query($sqlEdt);
          }
      
          return TRUE;    
       
        }
       
        else{    return FALSE;   }
      }

      public function delete_user($id) {
        $sql ="UPDATE sys_users SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE su_id = '$id'";
        $query = $this->db->query($sql);
           if ($query) { 
              return true; 
           } 
           else{
          return false;
        }
        }      
        public function deluser_permission($su_id)
        {
          $sql  =  "DELETE FROM sys_users_permissions WHERE su_id = $su_id";
          $query = $this->db->query($sql); 
          if ($query) { 
            return true; 
          } 
          else{
             return false;
          } 
        }

        public function insertuser_permission($su_id,$sp)
        {
           $sql  = "INSERT INTO sys_users_permissions(su_id, sp_id, date_created) VALUES  ('$su_id','$sp',CURRENT_TIMESTAMP)";
           $query = $this->db->query($sql);
          if ($query) { 
            return true; 
          } 
          else{
             return false;
          }
        }  

        public function save_edit_u($su_id, $username, $password,$gender, $fname, $lname, $email, $sug_id)
        {
          $password = base64_encode(trim($password));
           $sql ="UPDATE sys_users SET sug_id = '$sug_id', username = '$username', password = '$password', firstname = '$fname', lastname = '$lname',
            gender = '$gender', email = '$email', date_updated = CURRENT_TIMESTAMP WHERE su_id = '$su_id'";
          $exc_user = $this->db->query($sql);
          if ($exc_user ){ return true; }else{ return false; }
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

        public function save_edit_ug($sug_id, $sug_name)
        {
           $sql1 ="UPDATE sys_user_groups SET name = '$sug_name', date_updated = CURRENT_TIMESTAMP WHERE sug_id = '$sug_id'";
          $exc_user = $this->db->query($sql1);
          if ($exc_user ){ return true; }else{ return false; }
        }                           
}

?>