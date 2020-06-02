<?php 
 if($result_bom!=null){
foreach($result_bom as $row){

   $max[] = array($row['lv']); 
}
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
        <div class="col-xs-1">
        </div>
        <div class="row gutter-xs">
        <div class="col-xs-10">
        <div class="card">
        <div class="card-header">
        <div class="col-xs-10">

        <form action="<?php echo base_url()?>bom/insert_bom" method="post" class="form-inline">
          <div class="col-xs-5">
                  <span class="text-center text-primary" id="header">BOM TABLE  <?php echo anchor(base_url().'bom/manage', 'Back',array('class'=>'btn btn-default')); ?></span>
                  </div>
                  <div class="col-sm-6 col-md-3">
                   <select name="p_id[]" class="form-control select2" multiple="multiple"  required>
                   <option value="">- - - Select Part - - -</option>
                   <?php
                      foreach($result_sub as $r){?>
             
                     <option value="<?php  echo $r->p_id ?>"><?php echo $r->p_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>   
                    <input type="hidden" name="bm" value="<?php echo $bm ?>" hidden>
                    <input type="submit" class="btn btn-outline-primary" value="Add part">
        </form>          
        
            </div>      
              </div>
       <div class="card-body">
         <table id="demo-datatables-buttons-2" class="table table-striped dataTable text-center" style="border: 1px groove #ddd !important;" cellspacing="0" width="100%"  >
            <thead> 
             <tr>
               <?php 
                for($i=1;$i<=$maxlv[0];$i++) { ?>
               <th width="40px" class="not-active" style='border-right: 1px groove ;'>lv <?php echo $i ?></th>
               <?php } ?>
              <th width="" class="not-active " style='border-right: 1px groove ;'>Part No</th>
              <th width="" class="not-active" style='border-right: 1px groove ;'>Part name</th>
              <th width="" class="not-active" style='border-right: 1px groove ;'>Drawing No</th>               
              <th width="20px">Manage</th>               
             </tr>
            </thead>
          <tbody>
             <?php  foreach($bom as $row){
                echo "<td style='border-right: 1px groove;border-bottom: 1px groove'>1</td>";
               for($i=1;$i<=$maxlv[0]-1;$i++) { 
                echo "<td style='border-right: 1px groove;border-bottom: 1px groove'></td>";
                }
                echo "<td class='text-danger' style='border-right: 1px groove '>$row->p_no</td>";
                echo "<td class='text-danger' style='border-right: 1px groove '>$row->p_name</td>";
                echo "<td class='text-danger' style='border-right: 1px groove '>$row->d_no</td>";
                echo "<td class='text-danger'><a type='button' href='".base_url()."bom/delete/".$row->p_id."' onclick='return confirm(\"Confirm Delete Item\")' ><button class='btn-danger btn-sm fa fa-trash'></button></a></td></td>";
              }
            foreach($result_bom as $row){
                 ?>
                          <tr>  
                             <?php for($i=1;$i<=$maxlv[0];$i++) { 
                               if($i== $row['lv']){
                                  echo "<td style='border-right: 1px groove ;border-bottom: 1px groove'>".$row['lv']."</td>";
                                }else{
                                 echo "<td style='border-right: 1px groove;border-bottom: 1px groove  '></td>";
                                }
                              }               
                              $p_id=$row['id'];
                              $query=$this->db->query("SELECT p.p_no,p.p_name,d.d_no from part as p inner join drawing as d on d.d_id = p.d_id where p.p_id = $p_id");
                              $data= $query->result();
                            foreach($data as $r){ 
                              echo "<td style='border-right: 1px groove '>".$r->p_no."</td>";
                              echo "<td style='border-right: 1px groove '>".$r->p_name."</td>";
                              echo "<td style='border-right: 1px groove '>".$r->d_no."</td>";
                          if($row['lv']!=2){?>
                            <form id="form" action="<?php echo base_url()?>bom/delete_sub" method="post">
                            <input type="hidden" name="m_id" value="<?php echo $row['m_id'] ?>" hidden>
                            <input type="hidden" name="bm" value="<?php echo $bm ?>" hidden>
                           <td><button type="submit" onclick='return confirm("Confirm Delete Item")' class="btn-danger btn-sm fa fa-trash"></button>
                           
                           </form>
                   <form id="form" action="<?php echo base_url()."part/add_sub/$bm"?>" method="post">
                   <input type="hidden" name="id" value="<?php echo $row['id'] ?>" hidden>
                   <button type="submit"  class="btn-success btn-sm fa fa-wrench"></button>
                   </form> 

                       <?php   }else{?>
                    <form id="form" action="<?php echo base_url()?>bom/delete" method="post">
                    <input type="hidden" name="m_id" value="<?php echo $row['m_id'] ?>" hidden>
                    <input type="hidden" name="bm" value="<?php echo $bm ?>" hidden>
                   <td><button type="submit" onclick='return confirm("Confirm Delete Item")' class="btn-danger btn-sm fa fa-trash"></button>
                   </form>
                   <form id="form" action="<?php echo base_url()."part/add_sub/$bm"?>" method="post">
                   <input type="hidden" name="id" value="<?php echo $row['id'] ?>" hidden>
                   <button type="submit"  class="btn-success btn-sm fa fa-wrench"></button>
                   
                   </form>  
                          <?php
                      
                          }                     
                            }
                               ?>
                              
                             
                          </tr>                         
            <?php
   
            }//End $result_bom
            ?>
  </tbody>
</table>

 <script>
$(document).ready( function () {
  $('.select2').select2();
});
</script>