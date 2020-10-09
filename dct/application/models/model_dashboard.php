<?php

class Model_dashboard extends CI_Model
{

    public function drawing_file()
    {
        $sql = "SELECT f_id, name FROM folder WHERE fg_id = 1";
        $query = $this->db->query($sql);
        $folder = $query->result();

        $total_fid = [];
        foreach($folder as $f){
        $sql = "SELECT COUNT(file_name) as file_name FROM drawing where delete_flag != 0 AND f_id = $f->f_id";
        $query = $this->db->query($sql);
        $data = $query->result();
        array_push($total_fid,$data);
    }
    $head_dwg =[];
        foreach($folder as $f){
                array_push($head_dwg,$f->name);
        }
    $total_file =[];
        foreach($total_fid as $tf){
            foreach($tf as $t){
                array_push($total_file,$t->file_name);
            }
        }
        $data = array_combine($head_dwg, $total_file); //mix array name & value
        return $data;
    }

    public function standard_file()
    {
        
        $sql = "SELECT f_id, name FROM folder WHERE fg_id = 3";
        $query = $this->db->query($sql);
        $folder = $query->result();

        $total_fid = [];
        foreach($folder as $f){
        $sql = "SELECT COUNT(file_name) as file_name FROM standard where delete_flag != 0 AND f_id = $f->f_id";
        $query = $this->db->query($sql);
        $data = $query->result();
        array_push($total_fid,$data);
        }
        $head_std =[];
        foreach($folder as $f){
                array_push($head_std,$f->name);    
        }
        $total_file =[];
        foreach($total_fid as $tf){
            foreach($tf as $t){
                array_push($total_file,$t->file_name);
            }
        }
        $data = array_combine($head_std, $total_file); //mix array name & value
        return $data;
    }

}

?>