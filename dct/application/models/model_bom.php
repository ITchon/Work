<?php

class Model_bom extends CI_Model
{
  function fetch_part()
    {
      $sql ="SELECT *  FROM part ";
     $query = $this->db->query($sql);
     return $query->result();
    }
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
    function insert_bom($p_id,$d_id)
    {
      $sql="SELECT * FROM part_drawing pd where p_id = $p_id and d_id = $d_id ";
      $query = $this->db->query($sql);  
      $result = $query->result()[0];
       $sql ="INSERT INTO bom (pd_id,unit,date_created,delete_flag) VALUES ($result->pd_id,'pcs',CURRENT_TIMESTAMP,1);";
       $query = $this->db->query($sql);  
       $insert_id = $this->db->insert_id($query );
      if($query){
       return  $insert_id;
      }
      else{
        return false;
      }  
    }
    public function insert_edit_part($parent_id, $qty,$unit,$c_p)
    {
     $sql="UPDATE sub_part SET quantity = '$qty', unit = '$unit', common_part = '$c_p'WHERE sub_id = '$parent_id'";
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
    // $sql =  'SELECT * FROM sub_part inner join part on part.p_id = sub_part.p_id inner join part_drawing pd on pd.d_id=part.d_id where parent_id = '.$id.'  AND sub_part.delete_flag != 0 and b_id = '.$bm.'';
    $sql = "SELECT pd.pd_id,sb.sub_id,sb.b_id,sb.parent_id,sb.child_id,sb.origin,
    sb.quantity,sb.unit,sb.common_part,p.p_no,p.p_name,d.d_no,d.d_name
    FROM part_drawing pd inner join sub_part sb on sb.parent_id = pd.pd_id
    inner join part p on p.p_id = pd.p_id 
    inner join drawing d on d.d_id = pd.d_id
    where sb.parent_id= $id and sb.b_id = $bm ";
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

    // $sql =  'SELECT * FROM sub_part inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id where parent_id = '.$id.'  AND sub_part.delete_flag != 0 and b_id = '.$bm.' AND origin='.$origin.'';

   $sql = "SELECT pd.pd_id,sb.sub_id,sb.b_id,sb.parent_id,sb.child_id,sb.origin,
    sb.quantity,sb.unit,sb.common_part,p.p_no,p.p_name,d.d_no,d.d_name
    FROM part_drawing pd inner join sub_part sb on sb.parent_id = pd.pd_id
    inner join part p on p.p_id = pd.p_id 
    inner join drawing d on d.d_id = pd.d_id
    where sb.parent_id= $id and sb.b_id = $bm and sb.origin = $origin ";
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
    // echo $res_bom[0]->pd_id ;
    // echo $res_bom[0]->b_id ;
    // exit;
    $data= $this->model_bom->sub_bom($res_bom[0]->pd_id,$res_bom[0]->b_id) ;

    $bm =  $res_bom[0]->b_id;
    if($data != false){  
        $parent_id =$res_bom[0]->pd_id;
        foreach($data as $r){
            $data= $this->model_bom->sub_part($r->child_id,$bm,$r->origin) ;

            if($data != false){  
                foreach($data as $r){
                    $data= $this->model_bom->sub_part($r->child_id,$bm,$r->origin) ;
                    $a=array('lv'=>2,'m_id'=>$r->parent_id,'id'=>$r->child_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->child_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                    
                    array_push($array,$a);
                    if($data != false){  
            
                        foreach($data as $r){

                            $data= $this->model_bom->sub_part($r->child_id,$bm,$r->origin) ;
                            $a=array('lv'=>3,'m_id'=>$r->parent_id,'id'=>$r->child_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->child_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                            
                            array_push($array,$a);
                            if($data != false){  
                    
                                foreach($data as $r){

                                    $data= $this->model_bom->sub_part($r->child_id,$bm,$r->origin) ;
                                    $a=array('lv'=>4,'m_id'=>$r->parent_id,'id'=>$r->child_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->child_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                    
                                    array_push($array,$a);
                                    if($data != false){  
                            
                                        foreach($data as $r){

                                            $data= $this->model_bom->sub_part($r->child_id,$bm,$r->origin) ;
                                            $a=array('lv'=>5,'m_id'=>$r->parent_id,'id'=>$r->child_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->child_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                            
                                            array_push($array,$a);
                                            if($data != false){  
                                    
                                                foreach($data as $r){

                                                    $data= $this->model_bom->sub_part($r->child_id,$bm,$r->origin) ;
                                                    $a=array('lv'=>7,'m_id'=>$r->parent_id,'id'=>$r->child_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->child_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                                    
                                                    array_push($array,$a);
                                                    if($data != false){  
                                            
                                                        foreach($data as $r){

                                                            $data= $this->model_bom->sub_part($r->child_id,$bm,$r->origin) ;
                                                            $a=array('lv'=>8,'m_id'=>$r->parent_id,'id'=>$r->child_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->child_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                                            
                                                            array_push($array,$a);
                                                            if($data != false){                                                             
                                                                foreach($data as $r){

                                                                    $data= $this->model_bom->sub_part($r->child_id,$bm,$r->origin) ;
                                                                    $a=array('lv'=>9,'m_id'=>$r->parent_id,'id'=>$r->child_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->child_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                                                    
                                                                    array_push($array,$a);
                                                                    if($data != false){                                                             
                                                                        foreach($data as $r){
   
                                                                            $data= $this->model_bom->sub_part($r->child_id,$bm,$r->origin) ;
                                                                            $a=array('lv'=>10,'m_id'=>$r->parent_id,'id'=>$r->child_id,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->child_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no,'origin'=>$r->origin);
                                                                            
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

      $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->parent_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
      $data= $query->result();
      $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
      array_push($array,$a);
      foreach($data as $r){

        $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->parent_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
        $data= $query->result();
        $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
        array_push($array,$a);
        foreach($data as $r){

          $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->parent_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
          $data= $query->result();
          $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
          array_push($array,$a);
          foreach($data as $r){
  
            $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->parent_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
            $data= $query->result();
            $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
            array_push($array,$a);
            foreach($data as $r){
              $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->parent_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
              $data= $query->result();
              $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
              array_push($array,$a);
              foreach($data as $r){
                $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->parent_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                $data= $query->result();
                $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                array_push($array,$a);
                foreach($data as $r){
                  $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->parent_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                  $data= $query->result();
                  $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                  array_push($array,$a);
                  foreach($data as $r){
                    $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.p_id = '.$r->parent_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                    $data= $query->result();
                    $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
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

      $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.parent_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
      $data= $query->result();
      $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
      array_push($array,$a);
      foreach($data as $r){

        $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.parent_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
        $data= $query->result();
        $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
        array_push($array,$a);
        foreach($data as $r){

          $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.parent_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
          $data= $query->result();
          $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
          array_push($array,$a);
          foreach($data as $r){
  
            $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.parent_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
            $data= $query->result();
            $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
            array_push($array,$a);
            foreach($data as $r){
              $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.parent_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
              $data= $query->result();
              $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
              array_push($array,$a);
              foreach($data as $r){
                $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.parent_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                $data= $query->result();
                $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                array_push($array,$a);
                foreach($data as $r){
                  $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.parent_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                  $data= $query->result();
                  $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
                  array_push($array,$a);
                  foreach($data as $r){
                    $query = $this->db->query('SELECT * FROM sub_part  inner join part on part.p_id = sub_part.p_id inner join drawing on drawing.d_id=part.d_id AND  sub_part.parent_id = '.$r->p_id.' AND  sub_part.origin = '.$r->origin.' AND b_id = '.$bm.' AND sub_part.delete_flag != 0'); 
                    $data= $query->result();
                    $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no,'sub_id'=>$r->sub_id,'qty'=>$r->quantity,'unit'=>$r->unit,'common_part'=>$r->common_part,'p_no'=>$r->p_no,'p_id'=>$r->p_id,'p_name'=>$r->p_name,'d_no'=>$r->d_no );                                       
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