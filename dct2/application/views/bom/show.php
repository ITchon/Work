<!-- <?php 
foreach($data as $row){
foreach($row as $r){
   echo $r['lv']." | ".$r['id'];
   echo "<br>";
}

}

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
                      <th  width="5%" >Lv1</th>
                      <th  width="5%">Lv2</th>
                      <th  width="5%">Lv3</th>
                      <th  width="5%">Lv4</th>
                      <th  width="5%">Lv5</th>
                      <th  width="5%">Lv6</th>
                      <th  width="5%">Lv7</th>
                      <th  width="5%">Lv8</th>
                      <th  width="5%">Lv9</th>
                      <th  width="5%">Lv10</th>
                        <th width="">Id</th>
                       
                      </tr>
                    </thead>
                    <tbody>

                    <?php 
foreach($data as $row){
foreach($row as $r){?>
<tr>  
<td><?php if($r['lv']==1){echo $r['lv'];} ?></td>
<td><?php if($r['lv']==2){echo $r['lv'];} ?></td>
<td><?php if($r['lv']==3){echo $r['lv'];} ?></td>
<td><?php if($r['lv']==4){echo $r['lv'];} ?></td>
<td><?php if($r['lv']==5){echo $r['lv'];} ?></td>
<td><?php if($r['lv']==6){echo $r['lv'];} ?></td>
<td><?php if($r['lv']==7){echo $r['lv'];} ?></td>
<td><?php if($r['lv']==8){echo $r['lv'];} ?></td>
<td><?php if($r['lv']==9){echo $r['lv'];} ?></td>
<td><?php if($r['lv']==10){echo $r['lv'];} ?></td>
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