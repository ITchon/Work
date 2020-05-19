<br>	
<div class="container">
<?php
	echo "| ".$result[0]->b_master." | <hr>";
        foreach($result as $r){
         $result =$this->model->sub_part($r->p_id);
         echo "| 2 | ".$r->p_id."<br>";
         foreach($result as $r){
             $result =$this->model->sub_part($r->p_id);
             echo "| 3 | ".$r->p_id."<br>";
         }
         foreach($result as $r){
             $result =$this->model->sub_part($r->p_id);
             echo "| 4 | ".$r->p_id."<br>";
         }
         foreach($result as $r){
             $result =$this->model->sub_part($r->p_id);
              echo "| 5 | ".$r->p_id."<br>";
         }
         foreach($result as $r){
             $result =$this->model->sub_part($r->p_id);
              echo "| 6 | ".$r->p_id."<br>";
         }
         foreach($result as $r){
             $result =$this->model->sub_part($r->p_id);
              echo "| 7 | ".$r->p_id."<br>";
         }
         foreach($result as $r){
             $result =$this->model->sub_part($r->p_id);
              echo "| 8 | ".$r->p_id."<br>";
         }
         foreach($result as $r){
             $result =$this->model->sub_part($r->p_id);
              echo "| 9 | ".$r->p_id."<br>";
         }
         foreach($result as $r){
             $result =$this->model->sub_part($r->p_id);
              echo "| 10 | ".$r->p_id."<br>";
         }
         
     echo "<hr>";
     }
?>
</div>