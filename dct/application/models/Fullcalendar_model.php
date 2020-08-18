<?php

class Fullcalendar_model extends CI_Model
{
 function fetch_all_event(){
     $sql = "SELECT * FROM events";
     $query = $this->db->query($sql);
  return  $query;
 }

 function insert_event($title, $des, $color,$s_day,$s_time,$e_day,$e_time)
 {
    $sql = "INSERT INTO events ( title, description, color, start_event, end_event) VALUES ('$title','$des','$color','$s_day $s_time','$e_day $e_time')";
      $exc = $this->db->query($sql);
      if ($exc) { 
       return true; 
      } 
 }

 function update_event($eventid,$title,$desc,$color,$s_day,$s_time,$e_day,$e_time)
 {
  $sql = "UPDATE events SET title='$title',description='$desc',color='$color',start_event='$s_day $s_time',end_event='$e_day $e_time' WHERE id ='$eventid'";
      $exc = $this->db->query($sql);
      if ($exc) { 
       return true; 
      } 
 }
 function update_drop($id,$start,$end)
 {
  $sql = "UPDATE events SET start_event='$start',end_event='$end' WHERE id ='$id'";
      $exc = $this->db->query($sql);
      if ($exc) { 
       return true; 
      } 
 }

 function delete_event($id)
 {
     $sql = "DELETE FROM events WHERE id='$id'";
     $exc = $this->db->query($sql);
 }
}

?>
