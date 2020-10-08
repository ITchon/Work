<?php

class Model_part extends CI_Model
{
         
    function insert_sub_part($bm,$lv,$parent,$child,$origin)
    {

      $sql ="INSERT INTO sub_part (b_id,lv,parent_id,child_id,origin,unit,date_created,delete_flag) VALUES ($bm,$lv,$parent,$child,$origin,'pcs',CURRENT_TIMESTAMP,1);";
      $query = $this->db->query($sql);  
      $insert_id = $this->db->insert_id($query);
      if($query){
        return  $insert_id;
      }
      else{
        return false;
      }  
    }

    public function get_type()
    {
      $sql =  "SELECT f.f_id,f.name from folder as f
      where f.delete_flag != 0 AND f.fg_id = 1 ";
         $query = $this->db->query($sql);
        $result =  $query->result();
      return $result;
    }

    public function get_part_outdrawing($p_id)
    {
      $p_id =  implode(',',$p_id);
      $sql =  "SELECT * from part as p
      where p.delete_flag != 0 AND p_id NOT IN($p_id)";
         $query = $this->db->query($sql);
        $result =  $query->result();
      return $result;
    }
    

    public function get_part()
    {
      $sql =  "SELECT p.p_id, p.p_no, p.p_name, p.enable,d.d_no,d.f_id from part as p
      left join part_drawing as pd on pd.p_id = p.p_id
      inner join drawing as d on d.d_id = pd.d_id
      where (p.delete_flag != 0 AND pd.delete_flag != 0 AND d.delete_flag != 0) ";
         $query = $this->db->query($sql);
        $result =  $query->result();
      return $result;
    }

    public function part_search_common($s_pno,$s_pname)
    {
        $sql =  "SELECT * from part as p
        where p.delete_flag != 0 AND (p.p_no LIKE '%$s_pno%' OR p.p_name LIKE '%$s_pname%') ";
        $query = $this->db->query($sql);
        $result =  $query->result();
  
        return $result;
    }
    
    public function part_search($s_pno,$s_pname)
    {
        $sql =  "SELECT p.p_id,p.p_no,p.p_name,p.enable,d.d_no,d.f_id from part as p
        left join part_drawing as pd on pd.p_id = p.p_id
        inner join drawing as d on d.d_id = pd.d_id
        where p.delete_flag != 0  AND pd.delete_flag != 0 AND (p.p_no LIKE '%$s_pno%' OR p.p_name LIKE '%$s_pname%') ";
        $query = $this->db->query($sql);
        $result =  $query->result();
  
        return $result;
    }

    public function get_nopart($d_id)
    {
        $d_id =  implode(',',$d_id);
      $sql =  "SELECT * from drawing where delete_flag != 0 AND d_id NOT IN ($p_id)";
         $query = $this->db->query($sql);
        $result =  $query->result();
      return $result;
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


        function insert_newpart($p_no,$p_name)
    {
   
        $num= $this->db->query("SELECT * FROM part where p_no = '$p_no'"); 
        $chk= $num->num_rows();
        
        if($chk < 1){
          $sql ="INSERT INTO part (p_no,p_name,enable,date_created,delete_flag) VALUES ( '$p_no', '$p_name' 
        ,'1',CURRENT_TIMESTAMP,'1');";
          $query = $this->db->query($sql);  
        if($query){
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


    public function save_edit_part($p_id, $p_no, $p_name)
  {
     $sql1 ="UPDATE part SET p_no = '$p_no', p_name = '$p_name', date_updated = CURRENT_TIMESTAMP, delete_flag = '1' WHERE p_id = '$p_id'";
    $exc_user = $this->db->query($sql1);
    if ($exc_user ){ return true; }else{ return false; }
  }


    public function save_edit_partb($p_id, $p_no, $p_name,$d_id)
    {
       $sql1 ="UPDATE part SET p_no = '$p_no', p_name = '$p_name', d_id = '$d_id', date_updated = CURRENT_TIMESTAMP, delete_flag = '1' WHERE p_id = '$p_id'";
      $exc_user = $this->db->query($sql1);
      if ($exc_user ){ return true; }else{ return false; }
    }
    // public function enablePart($key=''){

    //     $sqlEdt = "UPDATE part SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE p_id={$key};";
    //     $exc_user = $this->db->query($sqlEdt);
        
    //     if ($exc_user){
          
    //       return TRUE;  
          
    //     }else{  return FALSE; }
        
    // }
    // public function disablePart($key=''){

    //     $sqlEdt = "UPDATE part SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE p_id={$key};";
    //     $exc_user = $this->db->query($sqlEdt);
        
    //     if ($exc_user){
          
    //       return TRUE;  
          
    //     }else{  return FALSE; }
        
    // }

    public function enablePart($key){
  $query = $this->db->query("SELECT * from part WHERE p_id = $key "); 
  $result = $query->result()[0];
  if( $result->enable==0){
    $sqlEdt = "UPDATE part SET enable='1', date_updated=CURRENT_TIMESTAMP WHERE p_id={$key};";
    $exc_user = $this->db->query($sqlEdt);
  }
  else{
    $sqlEdt = "UPDATE part SET enable='0', date_updated=CURRENT_TIMESTAMP WHERE p_id={$key};";
    $exc_user = $this->db->query($sqlEdt);
  }
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

    public function sub_part_child($id,$bm)
    { 
     $sql = "SELECT sb.sub_id,sb.b_id,sb.parent_id,sb.child_id,sb.origin,
      sb.quantity,sb.unit,sb.common_part,p.p_no,p.p_name,d.d_no,d.d_name
      FROM part_drawing pd inner join sub_part sb on sb.child_id = pd.pd_id
      inner join part p on p.p_id = pd.p_id 
      inner join drawing d on d.d_id = pd.d_id
      where sb.child_id= $id and sb.b_id = $bm AND sb.delete_flag != 0";
      $query = $this->db->query($sql); 
      if($query){
        $result= $query->result();
        return $result;
      }else{
        return false;
      }
        
    }
  
    public function filter($sub_id,$bm)
    {
      $sql =  'SELECT * FROM sub_part where sub_id = '.$sub_id.'  AND delete_flag != 0';
      $query = $this->db->query($sql); 
      $res= $query->result();
      $data= $this->model_part->sub_part_child($res[0]->parent_id,$bm) ;   
      $array=[];
      
      foreach($data as $r){
          $data= $this->model_part->sub_part_child($r->parent_id,$bm) ;   
          $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no);                                       
          array_push($array,$a);
          foreach($data as $r){
              $data= $this->model_part->sub_part_child($r->parent_id,$bm) ;   
              $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no);                                       
              array_push($array,$a);
              foreach($data as $r){
                  $data= $this->model_part->sub_part_child($r->parent_id,$bm) ;   
                  $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no);                                       
                  array_push($array,$a);
                  foreach($data as $r){
                      $data= $this->model_part->sub_part_child($r->parent_id,$bm) ;   
                      $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no);                                       
                      array_push($array,$a);
                      foreach($data as $r){
                          $data= $this->model_part->sub_part_child($r->parent_id,$bm) ;   
                          $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no);                                       
                          array_push($array,$a);
                          foreach($data as $r){
                              $data= $this->model_part->sub_part_child($r->parent_id,$bm) ;   
                              $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no);                                       
                              array_push($array,$a);
                          
                          foreach($data as $r){
                            $data= $this->model_part->sub_part_child($r->parent_id,$bm) ;   
                              $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no);                                       
                              array_push($array,$a);
                          
                          foreach($data as $r){
                              $data= $this->model_part->sub_part_child($r->parent_id,$bm) ;   
                              $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no);                                       
                              array_push($array,$a);
                          
                          foreach($data as $r){
                              $data= $this->model_part->sub_part_child($r->parent_id,$bm) ;   
                              $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no);                                       
                              array_push($array,$a);
                          
                          foreach($data as $r){
                              $data= $this->model_part->sub_part_child($r->parent_id,$bm) ;   
                              $a=array('parent_id'=>$r->parent_id,'p_no'=>$r->p_no);                                       
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