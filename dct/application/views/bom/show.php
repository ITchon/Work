

<style>
th, td {
 font-size:17px;
 font-weight: bold;
}
#header {
  font-size: 1.8em;
  font-weight: bold;
}
#form {
  display: inline-block;
}


</style>
<div class="layout-content">
    <div class="layout-content-body">
        <div class="title-bar">
          <h1 class="title-bar-title"></h1>
          <p class="title-bar-description">
          </p>
        </div>
        <div class="card">              
        <div class="card-header">
        <div class="col-xs-10">
          <div class="col-xs-5">
               <span class="text-center text-primary" id="header">BOM TABLE <i class="fa fa-sitemap" aria-hidden="true"></i></span>
                  </div>            
            </div>      
          </div>
          <br>

  <div class="no_print">
    <?php if($chk==null){ ?>
<div class=" col-md-3 col-sm-3 hide">
    <?php }else {?>
<div class=" col-md-3 col-sm-3">
 <?php } ?>
  

  <a href="#" class="btn btn-outline-info" id="xx">csv</a>
  <a class=" btn btn-success " onclick="window.print()"><i class="fa fa-print"></i></a>
          </div>

          <form id="" class="" action="<?php echo base_url()."bom/manage/$bm "?>" style="padding-right:50px"  method="post">
          <div class="col-md-3 col-sm-12" ></div>
                        <div class="input-group" >
                        <div class="input-group-btn">
                        <a href="" class="no_print btn btn-primary ">Clear</a> 
                        </div>
                        <select name="sub_id" class="form-control select2"   required>
                   <option value="">- - - Search - - - </option>
                   <?php
                   $_data = array();
                   foreach ($result_bom as $v) {
                     if (isset($_data[$v['p_id']])) {
                       // found duplicate
                       continue;
                     }
                     // remember unique item
                     $_data[$v['p_id']] = $v;
                   }
                   // if you need a zero-based array, otheriwse work with $_data
                   $data = array_values($_data);
                      foreach($data as $row){
                     
                        ?>
                              
                     <option value="<?php  echo $row['sub_id'] ?>"  ><?php echo $row['p_no'] ?></option>
                  
                    <?php
                        }      
                      
                      ?> 
                   </select>
                   <div class="input-group-btn">
                   <select name="sort" class="btn btn-primary" id="">
          <?php if($sort == "up"){  
              echo "<option value='up'  >Tree up</option>";
              echo "<option value='down' >Tree down</option>";
          }else{
            echo "<option value='down' >Tree down</option>";
            echo "<option value='up'  >Tree up</option>";
          }
            ?>
          </select>
                        </div>
                        <div class="input-group-btn">                    
                    <input type="submit" class="btn btn-outline-primary" value="Search">
                    </div>
                    
                  </div>
        </form>          
</div>
       <div class="card-body">
         <table id="projectSpreadsheet" class="table table-hover  dataTable" style="border: 1px groove #ddd !important;" cellspacing="0" width="100%"  >
            <thead> 
             <tr>
               <?php 
                for($i=1;$i<=$maxlv;$i++) { ?>
               <th width="30px" class="not-active " style='border-right: 1px groove ;'>lv <?php echo $i  ?></th>
               <?php } ?>
              <th width="" class="not-active " style='border-right: 1px groove ;'>Part No</th>
              <th width="250px" class="not-active" style='border-right: 1px groove ;'>Part name</th>
              <th width="" class="not-active" style='border-right: 1px groove ;'>Qty</th>               
              <th width="" class="not-active" style='border-right: 1px groove ;'>Unit</th>               
              <th width="" class="not-active" style='border-right: 1px groove ;'>Drawing No</th>               
              <th width="" class="not-active no_print"></th>               
             </tr>
            </thead>
          <tbody id="tbodyid">
          
          <?php  if($sort!="up"){
            
                           foreach($bom as $row){
                            echo "<td class='text-danger text-center' style='border-right: 1px groove;border-bottom: 1px groove'>1</td>";
                             for($i=1;$i<=$maxlv-1;$i++) { 
                            echo "<td style='border-right: 1px groove;border-bottom: 1px groove'></td>";
                            }
                            echo "<td class='text-danger' style='border-right: 1px groove '>$row->p_no</td>";
                            echo "<td class='text-danger' style='border-right: 1px groove '>$row->p_name</td>";
                            echo "<td class='text-danger' style='border-right: 1px groove '>$row->quantity</td>";
                            echo "<td class='text-danger' style='border-right: 1px groove '>$row->unit</td>";
                            echo "<td class='text-danger' style='border-right: 1px groove '>$row->d_no</td>";
                            echo "<td class='text-danger text-center no_print '><a type='button' href='".base_url()."bom/delete_bom/".$bm."' onclick='return confirm(\"All data in this bom will be delete are you sure?\")' ><button class='btn btn-danger btn-sm fa fa-trash  no-border' data-toggle='tooltip' data-html='true' data-placement='left' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>'></button></a>";
                            ?>
     
                            <a type="button" href="<?php echo base_url()."bom/edit_bom/$bm"?>" ><button class="btn btn-success btn-sm fa fa-pencil-square-o  no-border" data-toggle="tooltip" data-html="true" data-placement="bottom" aria-describedby="passHelp" title="<h5>แก้ไขจำนวน</h5>"></button></a>
                            <form id="form" action="<?php echo base_url()."part/add_bom_sub/$bm" ?>" method="post">
                           <input type="hidden" name="m_id" value="<?php echo $bm_id?>" >
                            <button type="submit"  class="btn btn-primary btn-sm fa fa-plus  no-border" data-toggle="tooltip" data-html="true" data-placement="bottom" aria-describedby="passHelp" title="<h5>Add Part Lv 2</h5>"></button>
                            </form>
                            
                                <?php                     
                          }
                        }
                   foreach($result_bom as $row){ ?>
                          <tr>  
                             <?php for($i=1;$i<=$maxlv;$i++) { 
                               if($i== $row['lv']){
                                  echo "<td class='text-center' style='border-right: 1px groove ;border-bottom: 1px groove'>".$row['lv']."</td>";
                                }else{
                                 echo "<td style='border-right: 1px groove;border-bottom: 1px groove  '></td>";
                                }
                              }               
                                echo "<td style='border-right: 1px groove '>".$row['p_no']."</td>";
                                echo "<td style='border-right: 1px groove '>".$row['p_name']."</td>";
                                echo "<td style='border-right: 1px groove '>".$row['qty']."</td>";
                                echo "<td style='border-right: 1px groove '>".$row['unit']."</td>";
                                echo "<td style='border-right: 1px groove '>".$row['lv']."</td>";
                         ?>
                         
                        <td class="text-center no_print">
                    <form id="form" action="<?php echo base_url()?>bom/delete_sub" method="post">
                    <input type="hidden" name="m_id" value="<?php echo $row['sub_id'] ?>" >
                    <input type="hidden" name="bm" value="<?php echo $bm ?>" >  
                    <button type="submit" onclick='return confirm("Confirm Delete Item")' class="btn btn-default btn-sm fa fa-trash  no-border" data-toggle="tooltip" data-html="true" data-placement="left" aria-describedby="passHelp" title="<h5>ลบข้อมูล</h5>"></button>
                    </form>

                    <form id="form" action="<?php echo base_url()."bom/edit_part/$bm" ?>" method="post">
                    <input type="hidden" name="m_id" value="<?php echo $row['sub_id'] ?>" >
                    <input type="hidden" name="p_no" value="<?php echo $row['p_no'] ?>" >
                    <button type="submit"  class="btn btn-success btn-sm fa fa-pencil-square-o no-border" data-toggle="tooltip" data-html="true" data-placement="bottom" aria-describedby="passHelp" title="<h5>แก้ไขจำนวน</h5>"></button>
                    </form>       
                    <form id="form" action="<?php echo base_url()."part/add_sub/$bm"?>" method="post">
                    <input type="hidden" name="sub_id" value="<?php echo $row['sub_id'] ?>" >
                    <input type="hidden" name="id" value="<?php echo $row['p_id'] ?>" >
                    <input type="hidden" name="origin" value="<?php echo $row['origin'] ?>" >
                    <input type="hidden" name="p_no" value="<?php echo $row['p_no'] ?>" >
                    <input type="hidden" name="lv" value="<?php echo $row['lv'] ?>" >
                    <button type="submit"  class="btn btn-primary btn-sm fa fa-plus  no-border" data-toggle="tooltip" data-html="true" data-placement="bottom" aria-describedby="passHelp" title="<h5>Add Part Lv <?php echo $row['lv']+1 ?></h5>"></button>
                    </form>  
             
                              </td>

                          <?php                      
                                              
                            }
                               ?>                                                        
                          </tr>                         
                          <?php  if($sort == "up"){
                                foreach($bom as $row){
                                  echo "<td class='text-danger text-center' style='border-right: 1px groove;border-bottom: 1px groove'>1</td>";
                                   for($i=1;$i<=$maxlv-1;$i++) { 
                                  echo "<td style='border-right: 1px groove;border-bottom: 1px groove'></td>";
                                  } 
                                  echo "<td class='text-danger' style='border-right: 1px groove '>$row->p_no</td>";
                                  echo "<td class='text-danger' style='border-right: 1px groove '>$row->p_name</td>";
                                  echo "<td class='text-danger' style='border-right: 1px groove '>$row->quantity</td>";
                                  echo "<td class='text-danger' style='border-right: 1px groove '>$row->unit</td>";
                                  echo "<td class='text-danger' style='border-right: 1px groove '>$row->d_no</td>";
                                  echo "<td class='text-danger text-center'><a type='button' href='".base_url()."bom/delete_bom/".$bm."' onclick='return confirm(\"Confirm Delete Part?\")' ><button class='btn btn-danger btn-sm fa fa-trash' data-toggle='tooltip' data-html='true' data-placement='left' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>'></button></a>";
                                  ?>
                    
                                  <a type="button" href="<?php echo base_url()?>bom/edit_bom/$bm" ><button class="btn btn-success btn-sm fa fa-pencil-square-o" data-toggle="tooltip" data-html="true" data-placement="bottom" aria-describedby="passHelp" title="<h5>แก้ไขจำนวน</h5>"></button></a>
                                  <form id="form" action="<?php echo base_url()."part/add_bom_sub/$bm" ?>" method="post">
                                  <input type="hidden" name="m_id" value="<?php echo $bm_id?>" >
                                  <button type="submit"  class="btn btn-primary btn-sm fa fa-plus" data-toggle="tooltip" data-html="true" data-placement="bottom" aria-describedby="passHelp" title="<h5>Add Part Lv 2</h5>"></button>
                                  </form>
                                      <?php
                                }
                          }
                                ?>
                          
           
  </tbody>
</table>
 <script>
$(document).ready( function () {
  $('.select2').select2();

  $(document).ready(function () {

  function exportTableToCSV($table, filename) {
    
        var $rows = $table.find('tr:has(td),tr:has(th)'),
    
            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character
    
            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',
    
            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row), $cols = $row.find('td,th');
    
                return $cols.map(function (j, col) {
                    var $col = $(col), text = $col.text();
    
                    return text.replace(/"/g, '""'); // escape double quotes
    
                }).get().join(tmpColDelim);
    
            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',
    
            
    
            // Data URI
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
            
            console.log(csv);
            
          if (window.navigator.msSaveBlob) { // IE 10+
            //alert('IE' + csv);
            window.navigator.msSaveOrOpenBlob(new Blob([csv], {type: "text/plain;charset=utf-8;"}), "csvname.csv")
          } 
          else {
            $(this).attr({ 'download': filename, 'href': csvData, 'target': '_blank' }); 
          }
    }
    
    // This must be a hyperlink
    $("#xx").on('click', function (event) {
      
        exportTableToCSV.apply(this, [$('#projectSpreadsheet'), 'BOM<?php echo $p_no ?>.csv']);
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });

});


});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

