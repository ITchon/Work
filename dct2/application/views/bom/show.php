<?php 
 if($result_bom!=null){
foreach($result_bom as $row){
foreach($row as $r){
   $max[] = array($r['lv']); 
  }
}
 $maxlv = max($max);
 }

?>

<div class="layout-content">
    <div class="layout-content-body">
        <div class="title-bar">
          <h1 class="title-bar-title">
      
          </h1>
          <p class="title-bar-description">
          </p>
        </div>
        <div class="row gutter-xs">
        <div class="col-xs-12">
            <div class="card">
              <div class="card-header">

                  <h3>Bom Table<a href="">  Back</a></h3>

    </div>
                <div class="card-body">
      <table id="" class="table table-bordered dataTable text-center" cellspacing="0" width="100%"  >
      <thead> 
       <tr>
         <?php 
          for($i=1;$i<=$maxlv[0];$i++) { 
           ?>
         <th width="25px">lv <?php echo $i ?></th>
        
          <?php } ?>
    
        <th width="">Part No</th>
        <th width="">Part name</th>
        <th width="">Drawing_no</th>               
       </tr>
     </thead>
       <tbody>
<?php

       foreach($result_bom as $row){
        foreach($row as $r){
          echo "<tr>";
          for($i=1;$i<=$maxlv[0];$i++) { 
            if($i== $r['lv']){
               echo "<td>".$r['lv']."</td>";
             }else{
              echo "<td></td>";
             }
           }
           $p_id= $r['id'];
           $sql =  'SELECT * FROM part inner join drawing on drawing.d_id = part.d_id where p_id = '.$p_id.' ';
           $query = $this->db->query($sql); 
           $data = $query->result(); 
         echo "<td>".$data[0]->p_no."</td>";
         echo "<td>".$data[0]->p_name."</td>";
         echo "<td>".$data[0]->d_no."</td>";
        echo "</tr>";
       }
       } ?>
  </tbody>
</table>
 <script>
 $(document).ready(function() {
        
 
     
    });


</script>


<!-- <?php 


foreach($result_bom as $row){
  foreach($row as $r){
    foreach($result_part as $row_p){
      foreach($row_p as $rs){
        if($r['id']==$rs->p_id){//  [id]==[id] ?>
              <tr>  
                 <?php for($i=1;$i<=$maxlv[0];$i++) { 
                   if($i== $r['lv']){
                      echo "<td>".$r['lv']."</td>";
                    }else{
                     echo "<td></td>";
                    }
                  }
                   ?>
                  
                  <td><?php echo $rs->p_no ?></td>   
                  <td><?php echo $rs->p_name ?></td>
                  <td><?php echo $rs->p_id ?></td>
              </tr>                         
<?php
          }
        }
    }// End $result_part
  }
}//End $result_bom
?> -->