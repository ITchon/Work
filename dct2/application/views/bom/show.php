 <?php 
foreach($result_bom as $row){
foreach($row as $r){
  }
}
 $maxlv = (max(array($r['lv']))); 

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
        //  for($i=1;$i<=$maxlv;$i++) { 
           ?>
         <th width="25px">lv 1</th>
         <th width="25px">lv 2</th>
         <th width="25px">lv 3</th>
         <th width="25px">lv 4</th>
         <th width="25px">lv 5</th>
         <th width="25px">lv 6</th>
         <th width="25px">lv 8</th>
         <th width="25px">lv 9</th>
         <th width="25px">lv 10</th>
    

        <th width="">Part No</th>
        <th width="">Part name</th>
        <th width="">Unit</th>               
       </tr>
     </thead>
       <tbody>

 <?php 
            foreach($result_bom as $row){
              foreach($row as $r){
                foreach($result_part as $row_p){
                  foreach($row_p as $rs){
                    if($r['id']==$rs->p_id){//  [id]==[id] ?>
                          <tr>  
                             <?php for($i=1;$i<=10;$i++) { 
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
            ?>
  </tbody>
</table>
 <script>
 $(document).ready(function() {
        
 
     
    });


</script>