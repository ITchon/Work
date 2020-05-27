<?php 
 if($result_bom!=null){
foreach($result_bom as $row){

   $max[] = array($row['lv']); 
  
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
        <th width="">Drawing No</th>               
       </tr>
     </thead>
       <tbody>

 <?php  foreach($bom as $row){
    echo "<td>1</td>";
   for($i=1;$i<=$maxlv[0]-1;$i++) { 
    echo "<td></td>";
    }
    echo "<td>$row->p_no</td>";
    echo "<td>$row->p_name</td>";
    echo "<td>$row->d_no</td>";
 }
            foreach($result_bom as $row){
                 ?>
                          <tr>  
                             <?php for($i=1;$i<=$maxlv[0];$i++) { 
                               if($i== $row['lv']){
                                  echo "<td>".$row['lv']."</td>";
                                }else{
                                 echo "<td></td>";
                                }
                              }
                          
                              $p_id=$row['id'];
                              $query=$this->db->query("SELECT p.p_no,p.p_name,d.d_no from part as p inner join drawing as d on d.d_id = p.d_id where p.p_id = $p_id");
                              $data= $query->result();
                            foreach($data as $row){
                              echo "<td>".$row->p_no."</td>";
                              echo "<td>".$row->p_name."</td>";
                              echo "<td>".$row->d_no."</td>";
                            }
                               ?>
                              
                             
                          </tr>                         
            <?php
   
            }//End $result_bom
            ?>
  </tbody>
</table>
 <script>
 $(document).ready(function() {
        
 
     
    });


</script>