<?php 
 if($result_bom!=null){

foreach($result_bom as $row){

   $max[] = array($row['lv']); 
}
 $maxlv = max($max);
 }else{
  $max[]=array(1);
  $maxlv = max($max);
 }

?>

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
        <form action="<?php echo base_url()?>bom/insert_sub" method="post" class="form-inline">
          <div class="col-xs-5">
                  <span class="text-center text-primary" id="header">BOM TABLE  <?php echo anchor(base_url().'bom/manage', 'Back',array('class'=>'btn btn-default')); ?></span>
                  </div>
                  <div class="col-sm-6 col-md-3">
                   <select name="p_id[]" class="form-control select2" multiple="multiple"  required>
                 
                   <?php
                   $genres = array();
                    $genres[] = $bm_id;
                      foreach($result_sub as $r){
                        if (!in_array($r->p_id,$genres)) {?>
             
                     <option value="<?php  echo $r->p_id ?>"><?php echo $r->p_no ?></option>
                    <?php
                        }
                      }
                      ?> 
                   </select>
                    </div>   
                    
                    <input type="hidden" name="bm" value="<?php echo $bm ?>" hidden>
                    <input type="submit" class="btn btn-outline-primary" value="Add Part lv 2">
        </form>          
            </div>      
          </div>
          <br>
          
          <form id="" class="" action="<?php echo base_url()."bom/manage/$bm "?>" style="padding-left:60%" method="post">
          <select name="sort" class="btn btn-primary" id="">
          <option value="down">Tree down</option>
          <option value="up">Tree up</option>
          </select>
          <div class="col-sm-6 col-md-4">
                   <select name="sub_id" class="form-control select2"  required>
                   <option>- - - Search - - - </option>
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
                      foreach($data as $row){?>           
                     <option value="<?php  echo $row['sub_id'] ?>"><?php echo $row['p_no'] ?></option>
                    <?php                       
                      }
                      ?> 
                   </select>
                    </div>   
                    
                    <input type="hidden" name="search" value="search" hidden>
                    <input type="submit" class="btn btn-outline-primary" value="Search">
        </form>          
</form>
       <div class="card-body">
         <table id="" class="table table-striped dataTable" style="border: 1px groove #ddd !important;" cellspacing="0" width="100%"  >
            <thead> 
             <tr>
               <?php 
                for($i=1;$i<=$maxlv[0];$i++) { ?>
               <th width="40px" class="not-active " style='border-right: 1px groove ;'>lv <?php echo $i ?></th>
               <?php } ?>
              <th width="" class="not-active " style='border-right: 1px groove ;'>Part No</th>
              <th width="" class="not-active" style='border-right: 1px groove ;'>Part name</th>
              <th width="" class="not-active" style='border-right: 1px groove ;'>Qty</th>               
              <th width="" class="not-active" style='border-right: 1px groove ;'>Unit</th>               
              <th width="" class="not-active" style='border-right: 1px groove ;'>Drawing No</th>               
              <th width="" class="not-active">Manage</th>               
             </tr>
            </thead>
          <tbody>
             <?php  
             foreach($bom as $row){
                echo "<td class='text-danger text-center' style='border-right: 1px groove;border-bottom: 1px groove'>1</td>";
               for($i=1;$i<=$maxlv[0]-1;$i++) { 
                echo "<td style='border-right: 1px groove;border-bottom: 1px groove'></td>";
                }
                echo "<td class='text-danger' style='border-right: 1px groove '>$row->p_no</td>";
                echo "<td class='text-danger' style='border-right: 1px groove '>$row->p_name</td>";
                echo "<td class='text-danger' style='border-right: 1px groove '>$row->quantity</td>";
                echo "<td class='text-danger' style='border-right: 1px groove '>$row->unit</td>";
                echo "<td class='text-danger' style='border-right: 1px groove '>$row->d_no</td>";
                echo "<td class='text-danger'><a type='button' href='".base_url()."bom/delete_bom/".$bm."' onclick='return confirm(\"Confirm Delete Item\")' ><button class='btn-danger btn-sm fa fa-trash' data-toggle='tooltip' data-html='true' data-placement='left' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>'></button></a>";
                ?>
  
                <a type="button" href="<?php echo base_url()?>bom/edit_bom/$bm" ><button class="btn-success btn-sm fa fa-wrench" data-toggle="tooltip" data-html="true" data-placement="bottom" aria-describedby="passHelp" title="<h5>แก้ไขจำนวน</h5>"></button></a>
         
                <form id="form" action="<?php echo base_url()?>part/edit_part" method="post">
                  <?php $bm = $row->b_id; ?>
                <input type="text" name="bom" value="<?php echo $bm ?>" hidden>
                <input type="text" name="p_id" value="<?php echo $row->p_id ?>" hidden>
               <?php echo "<a type='button'><button class='btn-default btn-sm fa fa-search' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ดูข้อมูล</h5>'></button></a></td>"; ?>
                </form>
                    <?php
               
           
              }
              foreach($result_bom as $row){ ?>
                          <tr>  
                             <?php for($i=1;$i<=$maxlv[0];$i++) { 
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
                                echo "<td style='border-right: 1px groove '>".$row['d_no']."</td>";
                         ?>
                        
                        <td >
                    <form id="form" action="<?php echo base_url()?>bom/delete" method="post">
                    <input type="hidden" name="m_id" value="<?php echo $row['sub_id'] ?>" >
                    <input type="hidden" name="bm" value="<?php echo $bm ?>" >
                    <button type="submit" onclick='return confirm("Confirm Delete Item")' class="btn-danger btn-sm fa fa-trash" data-toggle="tooltip" data-html="true" data-placement="left" aria-describedby="passHelp" title="<h5>ลบข้อมูล</h5>"></button>
                    </form>

                    <form id="form" action="<?php echo base_url()."bom/edit_part/$bm" ?>" method="post">
                    <input type="hidden" name="m_id" value="<?php echo $row['sub_id'] ?>" >
                    <input type="hidden" name="p_no" value="<?php echo $row['p_no'] ?>" >
                    <button type="submit"  class="btn-success btn-sm fa fa-wrench" data-toggle="tooltip" data-html="true" data-placement="bottom" aria-describedby="passHelp" title="<h5>แก้ไขจำนวน</h5>"></button>
                    </form>       
                    <form id="form" action="<?php echo base_url()?>part/edit_part" method="post">
                    <input type="hidden" name="bom" value="<?php echo $bm ?>" >
                    <input type="hidden" name="p_id" value="<?php echo $row['p_id'] ?>" >
                    <?php echo "<a type='button'><button class='btn-default btn-sm fa fa-search' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ดูข้อมูล</h5>'></button></a> "?>
                    </form>
                    <form id="form" action="<?php echo base_url()."part/add_sub/$bm"?>" method="post">
                    <input type="text" name="sub_id" value="<?php echo $row['sub_id'] ?>" >
                    <input type="hidden" name="id" value="<?php echo $row['p_id'] ?>" >
                    <input type="hidden" name="p_no" value="<?php echo $row['p_no'] ?>" >
                    <button type="submit"  class="btn-primary btn-sm fa fa-plus" data-toggle="tooltip" data-html="true" data-placement="bottom" aria-describedby="passHelp" title="<h5>Add Part Lv <?php echo $row['lv']+1 ?></h5>"></button>
                    </form>  
             
                              </td>

                          <?php                      
                                              
                            }
                               ?>                                                        
                          </tr>                         
      
  </tbody>
</table>
 <script>
$(document).ready( function () {
  $('.select2').select2();
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>