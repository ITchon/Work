<?php

class Model_ajax extends CI_Model
{

    public function dwg_by($id)
    {
            $sql ="SELECT d.file_code,tf.tf_fol  FROM drawing as d
            left join type_file as tf on tf.tf_id = d.tf_id
            WHERE d.d_id='$id' AND tf.delete_flag != 0  ";
              $query = $this->db->query($sql);  
             $data = $query->result(); 
             return $data;
    
    }
    public function dwg_by_version($id)
    {
            $sql ="SELECT v.file_code,tf.tf_fol  FROM version as v
            left join type_file as tf on tf.tf_id = v.tf_id
            WHERE v.v_id='$id' AND v.delete_flag != 0  ";
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
   

}

?>