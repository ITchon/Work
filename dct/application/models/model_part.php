<?php

class Model_part extends CI_Model
{
         
    function insert_sub_part($bm,$m,$p,$origin)
    {
      $sql ="INSERT INTO sub_part (b_id,m_id,p_id,origin,unit,date_created,delete_flag) VALUES ($bm,$m,$p,$origin,'pcs',CURRENT_TIMESTAMP,1);";
      $query = $this->db->query($sql);  
      $insert_id = $this->db->insert_id($query);
      if($query){
        return  $insert_id;
      }
      else{
        return false;
      }  
    }
    function insert_part($p_no,$p_name,$d_id,$master )
    {
   
        $num= $this->db->query("SELECT * FROM part where p_no = '$p_no'"); 
        $chk= $num->num_rows();
        
        if($chk < 1){
          $sql ="INSERT INTO part (p_no,p_name,d_id,enable,date_created,delete_flag) VALUES ( '$p_no', '$p_name', '$d_id'
        ,'1',CURRENT_TIMESTAMP,'1');";
        $sql1 ="INSERT INTO sub_part (m_id,p_id) VALUES ( '$master','$p_no' );";
          $query = $this->db->query($sql);  
        if($query){
          $query = $this->db->query($sql1);  
            return true;
        }
        }else{
          return false;
        }
    
    }
    public function update_sub_id($sub_id) {
        $sql ="UPDATE sub_part SET origin = $sub_id WHERE sub_id =$sub_id";
        $query = $this->db->query($sql);
        if ($query) { 
         return true; 
         } 
         else{
         return false;
         }
    }

    public function save_edit_partb($p_id, $p_no, $p_name,$d_id)
    {
       $sql1 ="UPDATE part SET p_no = '$p_no', p_name = '$p_name', d_id = '$d_id', date_updated = CURRENT_TIMESTAMP, delete_flag = '1' WHERE p_id = '$p_id'";
      $exc_user = $this->db->query($sql1);
      if ($exc_user ){ return true; }else{ return false; }
    }
    public function enablePart($key=''){

        $sqlEdt = "UPDATE part SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE p_id={$key};";
        $exc_user = $this->db->query($sqlEdt);
        
        if ($exc_user){
          
          return TRUE;  
          
        }else{  return FALSE; }
        
    }
    public function disablePart($key=''){

        $sqlEdt = "UPDATE part SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE p_id={$key};";
        $exc_user = $this->db->query($sqlEdt);
        
        if ($exc_user){
          
          return TRUE;  
          
        }else{  return FALSE; }
        
    }
    public function delete_part($id) {
        $sql ="UPDATE part SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE p_id = '$id'";
        $query = $this->db->query($sql);
           if ($query) { 
              return true; 
           } 
           else{
          return false;
        }
    }

    public function filter($sub_id,$bm)
    {
      $sql =  'SELECT * FROM sub_part where sub_id = '.$sub_id.'  AND delete_flag != 0';
      $query = $this->db->query($sql); 
      $res= $query->result();
      $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where sub_part.p_id = '.$res[0]->m_id.' AND b_id = '.$bm.'  AND sub_part.delete_flag != 0'); 
      $data= $query->result();
      $array=[];
      foreach($data as $r){
          $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
          $data= $query->result();
          $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
          array_push($array,$a);
          foreach($data as $r){
  
              $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
              $data= $query->result();
              $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
              array_push($array,$a);
              foreach($data as $r){
  
                  $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                  $data= $query->result();
                  $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                  array_push($array,$a);
                  foreach($data as $r){
      
                      $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                      $data= $query->result();
                      $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                      array_push($array,$a);
                      foreach($data as $r){
                          $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                          $data= $query->result();
                          $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                          array_push($array,$a);
                          foreach($data as $r){
                              $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                              $data= $query->result();
                              $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                              array_push($array,$a);
                          
                          foreach($data as $r){
                              $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                              $data= $query->result();
                              $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                              array_push($array,$a);
                          
                          foreach($data as $r){
                              $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                              $data= $query->result();
                              $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                              array_push($array,$a);
                          
                          foreach($data as $r){
                              $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                              $data= $query->result();
                              $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                              array_push($array,$a);
                          
                          foreach($data as $r){
                              $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id   where sub_part.p_id = '.$r->m_id.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                              $data= $query->result();
                              $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no);                                       
                              array_push($array,$a);
                                    }
                                  }
                               }
                             }
                          }
                      }
                  }
              }
          }
      }
      return $array;
    }
}

?>