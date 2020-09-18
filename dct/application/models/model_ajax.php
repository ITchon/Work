<?php

class Model_ajax extends CI_Model
{

    public function customersfile_by($id)
    {
            $sql ="SELECT cusf.file_name ,f.folder_name,fg.foldergroup_name FROM customers_file as cusf
            left join folder as f on f.f_id = cusf.f_id
            left join folder_group as fg on fg.fg_id = f.fg_id
            WHERE cusf.cusf_id='$id' AND f.delete_flag != 0 ";
              $query = $this->db->query($sql);  
             $data = $query->result(); 
             return $data;
    
    }
    public function dwg_by($id)
    {
            $sql ="SELECT d.file_name ,f.folder_name,fg.foldergroup_name FROM drawing as d
            left join folder as f on f.f_id = d.f_id
            left join folder_group as fg on fg.fg_id = f.fg_id
            WHERE d.d_id='$id' AND f.delete_flag != 0 ";
              $query = $this->db->query($sql);  
             $data = $query->result(); 
             return $data;
    
    }

    public function dcn_by($id)
    {
            $sql ="SELECT dcn.file_name ,f.folder_name,fg.foldergroup_name  FROM dcn 
            left join folder as f on f.f_id = dcn.f_id
            left join folder_group as fg on fg.fg_id = f.fg_id
            WHERE dcn.dcn_id = '$id' AND f.delete_flag != 0 ";
              $query = $this->db->query($sql);  
             $data = $query->result(); 
             return $data;
    
    }
    public function dwg_by_version($id)
    {
            $sql ="SELECT rev.file_name,f.folder_name,fg.foldergroup_name FROM revision_drawing as rev
            left join folder as f on f.f_id = rev.f_id
            left join folder_group as fg on fg.fg_id = f.fg_id
            WHERE rev.rd_id = '$id' AND rev.delete_flag != 0";
              $query = $this->db->query($sql);  
             $data = $query->result(); 
             return $data;
    
    }
 
  
    function fetch_drawing($pd_id)
    {
      $sql ="SELECT  pd.p_id,pd.pd_id,p.p_no,p.p_name,d.d_no,d.d_name from part_drawing pd
      inner join part p on p.p_id = pd.p_id 
      inner join drawing d on d.d_id = pd.d_id where pd.p_id != $pd_id";
     $query = $this->db->query($sql); 

     $output = '<optgroup  label="P/NO|DWG/NO" >';
     foreach($query->result() as $row)
     {
       
      $output .= '<option value="'.$row->pd_id.'">'.$row->p_no." | ".$row->d_no.'</option>';
     }

     return $output;
    }

    function fetch_folder($cus_id,$f_id)
    {
      $sql ="SELECT fg.fg_id,f.f_id,f.name as folname from customers as cus
      inner join folder_group as fg on fg.fg_id = cus.fg_id
      inner join folder as f on f.fg_id = fg.fg_id
      where cus.cus_id = $cus_id";
     $query = $this->db->query($sql); 

     $output = '<optgroup label="" >';
     foreach($query->result() as $row)
     {       
      $selected = '';
       if($f_id == $row->f_id){
        $selected = 'selected';
      }
         $output .= '<option '.$selected.' value="'.$row->f_id.'">'.$row->folname.'</option>.';
       
     }

     return $output;
    }

}

?>