<!-- <?php 
foreach($result as $row){
foreach($row as $r){
  }
}
  $maxlv = (max(array($r['lv']))); 
?>

 -->
<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
        

            </h1>
            <p class="title-bar-description">
            </p>
          </div>

          <div class="row gutter-xs">
          <div class="col-xs-7">
              <div class="card">
                <div class="card-header">

                  <h3>Bom Table</h3>
                  <small>The tables presented below use <a href="https://datatables.net/extensions/responsive/" target="_blank">DataTables Responsive Extension</a>, the styling of which is completely rewritten in SASS, without modifying however anything in JavaScript.</small>

                </div>
                <div class="card-body">
<table id="demo-datatables-buttons-1" class="table table-bordered dataTable" cellspacing="0" width="100%">
                  <thead>

           
                      <tr>
                      <?php for($i=1;$i<=$maxlv;$i++) { ?>
                        <th width="5%">lv <?php echo $i ?></th>
                    <?php } ?>
                        <th width="">Id</th>
                       
                      </tr>
                    </thead>
                    <tbody>

                    <?php 
                    
         
foreach($result as $row){

foreach($row as $r){?>

<tr>  
<?php for($i=1;$i<=$maxlv;$i++) { 
  if($i== $r['lv']){
     echo "<td>".$r['lv']."</td>";
  }else{
    echo "<td></td>";
   }
  }
  ?>

 <td><?php echo $r['id'] ?></td>
 
   </tr>

   <?php
}

}

?>
                  
            
                    </tbody>
                  </table>
 <script>
 $(document).ready(function() {
        
 
     
    });


</script>