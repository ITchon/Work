<?php

class Model_bom extends CI_Model
{
     
  public function opencsv($id)
  { 
    if($this->session->userdata('sug_id')=="1"){
        return true;
    }else{
        $sql =  "SELECT * FROM sys_users_permissions 
    where su_id = '$id' AND sp_id = 69 ";
    $query = $this->db->query($sql); 
    $result= $query->result();
    if($result != null){
      return true;
    }else{
      return false;
    }
 }

  }


public function delete_sub($id) {
    $sql ="UPDATE sub_part SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE sub_id = '$id'";
    $query = $this->db->query($sql);
    if ($query) { 
     return true; 
     } 
     else{
     return false;
     }
   }
   public function delete_bom($id) {
    $sql ="UPDATE bom SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE b_id = '$id'";
    $query = $this->db->query($sql);
    $query = $this->db->query("UPDATE sub_part SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE b_id = '$id'");
       if ($query) { 
          return true; 
       } 
       else{
      return false;
    }
    }
    function insert_bom($bm)
    {
     $sql ="INSERT INTO bom (b_master,unit,date_created,delete_flag) VALUES ($bm,'pcs',CURRENT_TIMESTAMP,1);";
       $query = $this->db->query($sql);  
       $insert_id = $this->db->insert_id($query );
      if($query){
       return  $insert_id;
      }
      else{
        return false;
      }  
    }
    public function insert_edit_part($m_id, $qty,$unit,$c_p)
    {
     $sql="UPDATE sub_part SET quantity = '$qty', unit = '$unit', common_part = '$c_p'WHERE sub_id = '$m_id'";
    $exc = $this->db->query($sql);
    if ($exc ){ return true; }else{ return false; }
    }
    public function insert_edit_bom($bm, $qty,$unit,$c_p)
  {
     $sql ="UPDATE bom SET quantity = '$qty', unit = '$unit', common_part = '$c_p' WHERE b_id = '$bm'";
     $exc= $this->db->query($sql);
    if ($exc){ return true; }else{ return false; }
  }

  public function hook_bom($bm)
  {
    $sql =  'SELECT * FROM bom where b_id = '.$bm.'   AND delete_flag != 0';
    $query = $this->db->query($sql); 
    if($query ){
      return $query->result(); 
    }
    else{
      return false;
    }
  }

  public function sub_bom($id,$bm)
  { 
    $sql =  'SELECT * FROM sub_part inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where m_id = '.$id.'  AND sub_part.delete_flag != 0 and b_id = '.$bm.'';
    $query = $this->db->query($sql); 
    if($query){
      $result= $query->result();
      return $result;
    }else{
      return false;
    }
      
  }

  public function sub_part($id,$bm,$origin)
  { 
    $sql =  'SELECT * FROM sub_part inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where m_id = '.$id.'  AND sub_part.delete_flag != 0 and b_id = '.$bm.' AND origin='.$origin.'';
    $query = $this->db->query($sql); 
    if($query){
      $result= $query->result();
      return $result;
    }else{
      return false;
    }
      
  }
  
  public function bom($bm)
  {
    $array=[];
    $res_bom= $this->model_bom->hook_bom($bm) ;
    $data= $this->model_bom->sub_bom($res_bom[0]->b_master,$res_bom[0]->b_id) ;
    $bm =  $res_bom[0]->b_id;
    if($data != false){  
        $m_id =$data[0]->p_id;
        foreach($data as $r){
            $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
            $a=array('lv'=>2,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
            array_push($array,$a);
            if($data != false){  
                foreach($data as $r){
                    $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                    $a=array('lv'=>3,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                    
                    array_push($array,$a);
                    if($data != false){  
            
                        foreach($data as $r){

                            $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                            $a=array('lv'=>4,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                            
                            array_push($array,$a);
                            if($data != false){  
                    
                                foreach($data as $r){

                                    $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                                    $a=array('lv'=>5,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                    
                                    array_push($array,$a);
                                    if($data != false){  
                            
                                        foreach($data as $r){

                                            $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                                            $a=array('lv'=>6,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                            
                                            array_push($array,$a);
                                            if($data != false){  
                                    
                                                foreach($data as $r){

                                                    $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                                                    $a=array('lv'=>7,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                                    
                                                    array_push($array,$a);
                                                    if($data != false){  
                                            
                                                        foreach($data as $r){

                                                            $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                                                            $a=array('lv'=>8,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                                            
                                                            array_push($array,$a);
                                                            if($data != false){                                                             
                                                                foreach($data as $r){

                                                                    $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                                                                    $a=array('lv'=>9,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                                                    
                                                                    array_push($array,$a);
                                                                    if($data != false){                                                             
                                                                        foreach($data as $r){
   
                                                                            $data= $this->model->sub_part($r->p_id,$bm,$r->origin) ;
                                                                            $a=array('lv'=>10,'m_id'=>$r->m_id,'id'=>$r->p_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                                                            
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
                            }
                        }
                    }
                }
            }
        }
     }
    }
    return  $array;
  
  }
  public function tree_up($sub_id,$bm)
{
  $array=[];
  $sql =  'SELECT * FROM sub_part inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where sub_id = '.$sub_id.' AND  b_id = '.$bm.' AND sub_part.delete_flag != 0';
  $query = $this->db->query($sql); 
  $res= $query->result();
 
  foreach($res as $r ){

  $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where sub_part.p_id = '.$r->p_id.' AND b_id = '.$bm.'  AND sub_part.delete_flag != 0 '); 
  $data= $query->result();
  foreach($data as $r){

      $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
      $data= $query->result();
      $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
      array_push($array,$a);
      foreach($data as $r){

        $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
        $data= $query->result();
        $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
        array_push($array,$a);
        foreach($data as $r){

          $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
          $data= $query->result();
          $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
          array_push($array,$a);
          foreach($data as $r){
  
            $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
            $data= $query->result();
            $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
            array_push($array,$a);
            foreach($data as $r){
              $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
              $data= $query->result();
              $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
              array_push($array,$a);
              foreach($data as $r){
                $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                $data= $query->result();
                $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                array_push($array,$a);
                foreach($data as $r){
                  $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                  $data= $query->result();
                  $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                  array_push($array,$a);
                  foreach($data as $r){
                    $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->m_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                    $data= $query->result();
                    $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
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
  return $array;
 
}

public function tree_down($sub_id,$bm)
{
  $array=[];
  $sql =  'SELECT * FROM sub_part inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where sub_id = '.$sub_id.' AND  b_id = '.$bm.' AND sub_part.delete_flag != 0';
  $query = $this->db->query($sql); 
  $res= $query->result();
 
  foreach($res as $r ){

  $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where sub_part.p_id = '.$r->p_id.' AND b_id = '.$bm.'  AND sub_part.delete_flag != 0'); 
  $data= $query->result();

  foreach($data as $r){

      $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
      $data= $query->result();
      $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
      array_push($array,$a);
      foreach($data as $r){

        $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
        $data= $query->result();
        $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
        array_push($array,$a);
        foreach($data as $r){

          $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
          $data= $query->result();
          $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
          array_push($array,$a);
          foreach($data as $r){
  
            $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
            $data= $query->result();
            $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
            array_push($array,$a);
            foreach($data as $r){
              $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
              $data= $query->result();
              $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
              array_push($array,$a);
              foreach($data as $r){
                $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                $data= $query->result();
                $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                array_push($array,$a);
                foreach($data as $r){
                  $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                  $data= $query->result();
                  $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                  array_push($array,$a);
                  foreach($data as $r){
                    $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.m_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                    $data= $query->result();
                    $a=array('m_id'=>$r->m_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
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


  return $array;
 
}
}

?>