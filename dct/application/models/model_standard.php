<?php

class Model_standard extends CI_Model
{

  
public function get_folder_by($f_id)
{ 
      $sql =  "SELECT fg.foldergroup_name as folg ,f.folder_name as fol
      FROM folder as f
      inner join folder_group as fg on fg.fg_id = f.fg_id
      where f.delete_flag != 0 AND f.f_id = '$f_id'";
      $query = $this->db->query($sql); 
      $result = $query->result()[0];
      return $result;
        
}

public function get_fid($std_id)
{ 
  $sql =  "SELECT f_id FROM standard where std_id = '$std_id'";
  $query = $this->db->query($sql); 
  $result= $query->result();
  return $result[0]->f_id;
    
}

public function get_file($std_id)
{ 
  $sql =  "SELECT file_name FROM standard where std_id = '$std_id'";
  $query = $this->db->query($sql); 
  $result= $query->result();
  return $result[0]->file_name;
    
}

public function get_file_rs($rs_id)
{ 
  $sql =  "SELECT * FROM revision_standard where rs_id = '$rs_id'";
  $query = $this->db->query($sql); 
  $result= $query->result()[0];
  return $result;
    
}

public function checkfolder($f_id)
{ 
  $sql =  "SELECT f.folder_name,fg.foldergroup_name FROM folder as f
INNER JOIN folder_group as fg on fg.fg_id = f.fg_id
where fg.delete_flag != 0 AND f_id = '$f_id'";
  $query = $this->db->query($sql); 
  $result= $query->result();
  return $result;
    
}

public function get_folder()
{
  $sql =  "SELECT * from folder where delete_flag != 0 AND fg_id NOT IN(1,2)";
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

public function get_customers()
{
     $sql ="SELECT * from customers where delete_flag != 0";
       $query = $this->db->query($sql);  
       $result =  $query->result();
      if($query){
        return $result;
      }
      else{
        return false;
      }
     
}
public function insert($cus_id,$std_no,$std_name,$dcn_id,$cus_rev,$file_name,$f_id)
{
     $sql ="INSERT INTO standard (std_no,std_name,dcn_id,cus_id,file_name,f_id,date_created,delete_flag,rev,cus_rev,enable) 
     VALUE('$std_no','$std_name','$dcn_id','$cus_id','$file_name','$f_id',CURRENT_TIMESTAMP,'1','0','$cus_rev','1')";
       $query = $this->db->query($sql);  
      if($query){
        return true;
      }
      else{
        return false;
      }
     
}

public function save_edit($std_id,$cus_id,$std_no,$std_name,$dcn_id,$cus_rev,$file,$f_id)
{
   $sql ="UPDATE standard SET std_no = '$std_no',std_name = '$std_name',dcn_id = '$dcn_id',
    cus_id ='$cus_id',cus_rev = '$cus_rev',file_name = '$file', f_id = '$f_id',
   date_updated = CURRENT_TIMESTAMP 
   WHERE std_id = '$std_id'";

  $query = $this->db->query($sql); 
  if ($query ){ return true; }else{ return false; }
}


public function save_edit_v($rs_id,$cus_name,$std_no,$std_name,$dcn_no,$cus_rev,$file,$f_id)
{
   $sql ="UPDATE revision_standard SET std_no = '$std_no',std_name = '$std_name',dcn_no = '$dcn_no',
    cus_name ='$cus_name',cus_rev = '$cus_rev',file_name = '$file', f_id = '$f_id',
   date_updated = CURRENT_TIMESTAMP 
   WHERE rs_id = '$rs_id'";

  $query = $this->db->query($sql); 
  if ($query ){ return true; }else{ return false; }
}


public function delete($id) 
{
    $sql ="UPDATE standard SET delete_flag = '0' , date_deleted=CURRENT_TIMESTAMP WHERE std_id = '$id'";
    $query = $this->db->query($sql);
       if ($query) { 
          return true; 
       } 
       else{
      return false;
    }
}

public function add_revision($std_id)
{
     $sql1 =  "SELECT std.std_no,std.std_name,dc.dcn_no,cus.cus_name,std.file_name,std.f_id
     ,std.cus_rev,std.rev FROM standard as std
     inner join dcn as dc on dc.dcn_id = std.dcn_id
     inner join customers as cus on cus.cus_id = std.cus_id
     where std.std_id = $std_id";
     $query = $this->db->query($sql1);
     $data =  $query->result()[0];
     $std_no =  $data->std_no;
     $std_name =  $data->std_name;
     $dcn_no =  $data->dcn_no;
     $cus_name =  $data->cus_name;
     $file_name =  $data->file_name;
     $f_id =  $data->f_id;
     $cus_rev =  $data->cus_rev;
     $rev =  $data->rev;


 $sql ="INSERT INTO revision_standard (std_no,std_name,dcn_no,cus_name,
  enable, date_created, delete_flag, file_name,f_id,cus_rev,rev) 
  VALUES ( '$std_no','$std_name', '$dcn_no','$cus_name','0',CURRENT_TIMESTAMP,
   '1' , '$file_name','$f_id','$cus_rev','$rev');";
 $query = $this->db->query($sql); 
 $last_id = $this->db->insert_id();
if($query){
    return $last_id;
  }
  else{
    return false;
  }


}

public function add_version($std_id,$rs_id)
{
 $gg ="INSERT INTO version_standard (std_id,rs_id,date_created, delete_flag) VALUES ( '$std_id','$rs_id', CURRENT_TIMESTAMP, '1');";
 $query = $this->db->query($gg); 
if($query){
    return true;
  }
  else{
    return false;
  }

}

function update_version($std_id,$cus_id,$std_no,$std_name,$dcn_id,$cus_rev,$rev,$file,$f_id)
{
 $v = $rev+1;
 $sql ="UPDATE standard SET std_no = '$std_no' ,std_name ='$std_name',cus_id = '$cus_id',
  date_updated=CURRENT_TIMESTAMP, dcn_id = '$dcn_id',rev = '$v',file_name = '$file',
  enable = 1 ,f_id = '$f_id',cus_rev = '$cus_rev' WHERE std_id = '$std_id'";
   $query = $this->db->query($sql);  
  if($query){
    return true;
  }
  else{
    return false;
  }
}

function get_lastrev_standard($std_id)
{
  $sql =  "SELECT std.std_id,std.file_name,std.std_no,std.std_name,std.rev,std.cus_rev,dc.dcn_no,cus.cus_name
  ,f.name as type,std.enable,f.folder_name,fg.foldergroup_name
  FROM standard as std
  left join customers as cus on cus.cus_id = std.cus_id
  left join dcn as dc on dc.dcn_id = std.dcn_id
  left join folder as f on f.f_id = std.f_id
  left join folder_group as fg on fg.fg_id = f.fg_id
  where std.delete_flag !=0 AND std_id = $std_id";
   $query = $this->db->query($sql); 
   $res = $query->result();
  if($query){
    return $res;
  }
  else{
    return false;
  }
}

function get_revision_standard($std_id)
{
  $sql =  "SELECT rs.rs_id,rs.file_name,rs.std_no,rs.std_name,rs.rev,rs.cus_rev,rs.dcn_no,rs.cus_name
  ,f.name as type,rs.enable,f.folder_name,fg.foldergroup_name
  FROM revision_standard as rs
  left join version_standard as vs on vs.rs_id = rs.rs_id
  left join folder as f on f.f_id = rs.f_id
  left join folder_group as fg on fg.fg_id = f.fg_id
  where rs.delete_flag !=0 AND vs.std_id = $std_id";
   $query = $this->db->query($sql); 
   $res = $query->result();
  if($query){
    return $res;
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

}

?>