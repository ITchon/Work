<?php

class Model_drawing extends CI_Model
{

  public function get_drawing()
  {
    $sql =  "SELECT * from drawing  where delete_flag != 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }
    public function get_type_drawing()
  {
    $sql =  "SELECT * from type_file where delete_flag != 0 AND tf_group = 1 OR tf_group = 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }

  public function get_nopart($p_id)
  {
      $p_id =  implode(',',$p_id);
    $sql =  "SELECT * from part where delete_flag != 0 AND p_id NOT IN ($p_id)";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }


  public function get_tfid($d_id)
  { 
    $sql =  "SELECT tf_id FROM drawing where d_id = '$d_id'";
    $query = $this->db->query($sql); 
    $result= $query->result();
    return $result[0]->tf_id;
      
  }


  public function get_file($d_id)
  { 
    $sql =  "SELECT file_name FROM drawing where d_id = '$d_id'";
    $query = $this->db->query($sql); 
    $result= $query->result();
    return $result[0]->file_name;
      
  }
  

  
  public function get_filecode($d_id)
  { 
    $sql =  "SELECT file_code FROM drawing where d_id = '$d_id'";
    $query = $this->db->query($sql); 
    $result= $query->result();
    return $result[0]->file_code;
      
  }

  
  public function get_customers()
  {
    $sql =  "SELECT * from customers where delete_flag != 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }


  public function get_part()
  {
    $sql =  "SELECT * from part  where delete_flag != 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }

  
  public function get_dcn()
  {
    $sql =  "SELECT * from dcn where delete_flag != 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }
  
  

  public function get_drawing_byid($d_id)
  {
    $sql =  "SELECT * from drawing where d_id = $d_id";
       $query = $this->db->query($sql);
      $result =  $query->result()[0];
    return $result;
  }


  public function checkfolder($tf_id)
  { 
    $sql =  "SELECT tf_fol FROM type_file where delete_flag != 0 AND tf_id = '$tf_id'";
    $query = $this->db->query($sql); 
    $result= $query->result();
    return $result[0]->tf_fol;
      
  }


  public function get_part_drawing_byid($d_id)
  {
    $sql =  "SELECT * from part_drawing  as pd
        left join part as p on p.p_id = pd.p_id
        where pd.d_id = $d_id";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }


  public function get_pid_bypd($d_id)
  {
    $sql =  "SELECT pd.p_id from part_drawing  as pd
        where pd.d_id = $d_id";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }


  public function link_to_dcn($id)        
  {
    $query= $this->db->query(" SELECT * FROM `sys_permissions` sp inner join sys_users_permissions sup on sup.sp_id = sp.sp_id where su_id = $id and sp.controller = 'dcn/manage'"); 
    $data = $query->result(); 
    if(!$data){
    }
    else{
      $this->session->set_flashdata($data[0]->button,'');
    }

  }

 public function insert_drawing($d_no,$d_name, $dcn_id,$cus_id, $tf_id, $file,$c,$pos)
  {
     
   $sql ="INSERT INTO drawing (d_no,d_name,enable, dcn_id,cus_id, date_created,delete_flag,tf_id,file_name,file_code,version,pos) VALUES 
   ( '$d_no','$d_name','1', '$dcn_id','$cus_id', CURRENT_TIMESTAMP,  '1','$tf_id','$file','$c','00','$pos');";
     $query = $this->db->query($sql);  
     $last_id = $this->db->insert_id();
   if($query){
       return $last_id;
   }else{
     return false;
  }
  }

  public function insert_newpart($p_no,$p_name)
  {
     $num= $this->db->query("SELECT * FROM part where p_no = '$p_no'"); 
   $chk= $num->num_rows();
 
  if($chk < 1){
     $sql ="INSERT INTO part (p_no,p_name,enable,date_created,delete_flag) VALUES ( '$p_no', '$p_name','1',CURRENT_TIMESTAMP,'1');";
     $query = $this->db->query($sql);  
     $last_id = $this->db->insert_id();
   if($query){
       return $last_id;
   }else{
     return false;
  }
 
  }
 }

 
 public function insert_part_drawing($p_id,$d_id)
 {
  $num= $this->db->query("SELECT * FROM part_drawing where d_id = '$d_id' AND p_id = '$p_id'"); 
  $chk= $num->num_rows();
  if($chk < 1){
    $sql ="INSERT INTO part_drawing (d_id,p_id,date_created) VALUES ( '$d_id','$p_id',CURRENT_TIMESTAMP);";
    $query = $this->db->query($sql);  
    $last_id = $this->db->insert_id();
  if($query){
      return $last_id;
  }else{
    return false;
 }
}
}


public function del_img($id)
{
 $sql ="DELETE FROM part_drawing WHERE pd_id = '$id'";
   $query = $this->db->query($sql);  
  if($query){
    return true;
  }
  else{
    return false;
  }
}


  
  public function download_record($su_id,$su_name,$data)
  {
    $sql  = "INSERT INTO `download_record`(`su_id`, `su_name`, `content`, `date_download`) 
    VALUES ('$su_id','$su_name','$data',CURRENT_TIMESTAMP)";
  $query= $this->db->query($sql); 
  if($query){
      return true;
  }else{
    return false;
 }
 }


  public function delete_drawing($id) {
    $sql ="UPDATE drawing SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE d_id = '$id'";
    $query = $this->db->query($sql);
       if ($query) { 
          return true; 
       } 
       else{
      return false;
    }
    }


  public function save_edit_drawing($d_id, $d_no, $d_name, $dcn_id, $cus_id, $file, $path_file,$c,$tf_id,$pos)
    {
   $path_file = quotemeta($path_file);
     $sql ="UPDATE drawing SET d_no = '$d_no' ,d_name = '$d_name', date_updated=CURRENT_TIMESTAMP, dcn_id = '$dcn_id',cus_id = '$cus_id',
     path_file = '$path_file', file_name = '$file', file_code = '$c',enable = 1 ,tf_id = '$tf_id',pos = '$pos'
     WHERE d_id = '$d_id'";
       $query = $this->db->query($sql);  
      if($query){
        return true;
      }
      else{
        return false;
      }
    }

    
 public function select_version($d_id)
 {
  $sql ="SELECT * FROM drawing WHERE d_id = $d_id ;";
  $query = $this->db->query($sql);
  $data = $query->result()[0];

  $d_id =  $data->d_id;
  $d_name =  $data->d_name;
  $pos =  $data->pos;
  $cus_id =  $data->cus_id;
  $tf_id =  $data->tf_id;
  $version =  $data->version;
  $file_name =  $data->file_name;
  $path_file =  $data->path_file;
  $d_no =  $data->d_no;
  $dcn_id =  $data->dcn_id;
  $file_code =  $data->file_code;
  $path_file = quotemeta($path_file);

  $gg ="INSERT INTO version (d_id,d_name, d_no, cus_id, dcn_id, enable, date_created, delete_flag,
  path_file, file_name,file_code, version,tf_id,pos) VALUES ( '$d_id','$d_name', '$d_no','$cus_id', 
  '$dcn_id', '0', CURRENT_TIMESTAMP, '1', '$path_file', '$file_name','$file_code', '$version','$tf_id','$pos');";
  $query = $this->db->query($gg); 
if($query){
     return true;
   }
   else{
     return false;
   }

 }


 function update_version($d_id,$d_name,$cus_id, $d_no, $dcn_id, $version, $file, $path_file,$c,$tf_id,$pos)
 {
  $v = $version+1;
$path_file = quotemeta($path_file);
  $sql ="UPDATE drawing SET d_no = '$d_no' ,d_name ='$d_name',cus_id = '$cus_id', date_updated=CURRENT_TIMESTAMP, dcn_id = '$dcn_id', version = '$v', path_file = '$path_file', file_name = '$file', file_code = '$c',enable = 1 ,tf_id = '$tf_id',pos = '$pos' WHERE d_id = '$d_id'";
    $query = $this->db->query($sql);  
   if($query){
     return true;
   }
   else{
     return false;
   }
 }


  public function enableDrawing($key){
    $query = $this->db->query("SELECT * from drawing WHERE d_id = $key "); 
    $result = $query->result()[0];
    if( $result->enable==0){
    $sqlEdt = "UPDATE drawing SET enable='1' , date_updated=CURRENT_TIMESTAMP WHERE d_id={$key};";
    $exc_user = $this->db->query($sqlEdt);
    }
    else{
      $sqlEdt = "UPDATE drawing SET enable='0' , date_updated=CURRENT_TIMESTAMP WHERE d_id={$key};";
      $exc_user = $this->db->query($sqlEdt);
    }
  
    if ($exc_user){
      
      return TRUE;    
      
    }else{    return FALSE;   }
    
  }

  public function drawing_search($s_dno,$s_name,$s_pno,$type)
  {
    $s_dno = "";
    $s_name = "";
    $s_pno = "";
if($type !=0){
    $type =  implode(',',array_map('intval',$type));
  }
      $sql =  "SELECT d.d_id,p.p_id,pd.p_id as pd_pid,pd.d_id as pd_did,d.d_no,d.d_name,c.cus_id,c.cus_name, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no,dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code ,d.tf_id
      from drawing as d
        left join part_drawing as pd on pd.d_id = d.d_id
        left join customers as c on c.cus_id = d.cus_id
        left join dcn as dc on dc.dcn_id = d.dcn_id
        left join part as p on p.p_id = pd.p_id
where d.delete_flag != 0 AND d.tf_id IN ($type) AND (d.d_no LIKE '%$s_dno%' OR d.d_name LIKE '%$s_name%' OR p.p_no LIKE '%$s_pno%')";
      $query = $this->db->query($sql);
      $result =  $query->result();

      return $result;
  }

  public function get_partdrawing()
  {
    $sql =  "SELECT d.d_id,p.p_id,pd.p_id as pd_pid,pd.d_id as pd_did,d.d_no,d.d_name,c.cus_id,c.cus_name, d.dcn_id, dc.dcn_no, d.enable, d.file_name, d.version, d.path_file, p.p_no,dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code, d.tf_id
          from drawing as d
            left join part_drawing as pd on pd.d_id = d.d_id
            left join customers as c on c.cus_id = d.cus_id
            left join dcn as dc on dc.dcn_id = d.dcn_id
            left join part as p on p.p_id = pd.p_id
          where d.delete_flag != 0";
       $query = $this->db->query($sql);
      $result =  $query->result();
    return $result;
  }


  public function get_drawing_ver($id)
  {
     $sql =  "SELECT d.d_id, d.d_no,d.d_name,d.cus_id,cus.cus_name, d.dcn_id, dc.dcn_no, d.enable, d.path_file, d.file_name, d.version
     , p.p_no,p.p_id,'v_id',dc.file_name as dcn_file,dc.path_file as dcn_path,d.file_code,dc.file_code as dcn_code
            from drawing as d
            left join part_drawing as pd on pd.d_id = d.d_id
            left join dcn as dc on dc.dcn_id = d.dcn_id
            left join part as p on p.p_id = pd.p_id 
            left join customers as cus on cus.cus_id = d.cus_id 
            where d.delete_flag != 0 AND d.d_id = $id
            UNION
                SELECT v.d_id, v.d_no,v.d_name,v.cus_id,cus.cus_name, v.dcn_id, dc.dcn_no, v.enable, v.path_file, v.file_name, v.version
                , p.p_no,p.p_id, v.v_id,dc.file_name as dcn_file,dc.path_file as dcn_path,v.file_code,dc.file_code as dcn_code
         from version as v
         left join part_drawing as pd on pd.d_id = v.d_id
         left join dcn as dc on dc.dcn_id = v.dcn_id
         left join part as p on p.p_id = pd.d_id 
         left join customers as cus on cus.cus_id = v.cus_id 
         where v.delete_flag != 0 AND v.d_id = $id
         ORDER by version DESC ";
      $query = $this->db->query($sql); 
      $result =  $query->result();
      return $result;
  }


  public function save_edit_drawing_v($v_id, $d_no, $d_name, $dcn_id, $cus_id, $file, $path_file,$c,$tf_id)
  {
 $path_file = quotemeta($path_file);
   $sql ="UPDATE version SET d_no = '$d_no' ,d_name = '$d_name', date_updated=CURRENT_TIMESTAMP, dcn_id = '$dcn_id',cus_id = '$cus_id',
   path_file = '$path_file', file_name = '$file', file_code = '$c',enable = 1 ,tf_id = '$tf_id'
   WHERE v_id = '$v_id'";
     $query = $this->db->query($sql);  
    if($query){
      return true;
    }
    else{
      return false;
    }
  }


}

?>
