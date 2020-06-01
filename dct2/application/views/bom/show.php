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
</style>
<div class="layout-content">
    <div class="layout-content-body">
        <div class="title-bar">
          <h1 class="title-bar-title">
      
          </h1>
          <p class="title-bar-description">
          </p>
        </div>
        <div class="col-xs-1">
        </div>
        <div class="row gutter-xs">
        <div class="col-xs-10">
            <div class="card">
              <div class="card-header">

                  <h3>Bom Table <?php echo anchor(base_url().'bom/manage', 'Back',array('class'=>'btn btn-default')); ?></h3>

    </div>
 
                <div class="card-body">
      <table id="" class="table table-striped dataTable text-center" style="border: 1px groove #ddd !important;" cellspacing="0" width="100%"  >
      <thead> 
       <tr>
         <?php 
          for($i=1;$i<=$maxlv[0];$i++) { 
           ?>
         <th width="40px" style='border-right: 1px groove ;'>lv <?php echo $i ?></th>
        
          <?php } ?>
    
        <th width="" style='border-right: 1px groove ;'>Part No</th>
        <th width="" style='border-right: 1px groove ;'>Part name</th>
        <th width="" style='border-right: 1px groove ;'>Drawing No</th>               
        <th width="20px">Manage</th>               
       </tr>
     </thead>
       <tbody>

 <?php  foreach($bom as $row){
    echo "<td style='border-right: 1px groove;border-bottom: 1px groove'>1</td>";
   for($i=1;$i<=$maxlv[0]-1;$i++) { 
    echo "<td style='border-right: 1px groove;border-bottom: 1px groove'></td>";
    }
    echo "<td style='border-right: 1px groove '>$row->p_no</td>";
    echo "<td style='border-right: 1px groove '>$row->p_name</td>";
    echo "<td style='border-right: 1px groove '>$row->d_no</td>";
    echo "<td style='border-right: 1px groove '><a type='button' href='".base_url()."bom/delete/".$row->p_id."' onclick='return confirm(\"Confirm Delete Item\")' ><button class='btn-danger btn-sm fa fa-trash'></button></a></td></td>";
       

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
                            <form action="<?php echo base_url()?>bom/delete_sub" method="post">
                            <input type="hidden" name="m_id" value="<?php echo $row['m_id'] ?>" hidden>
                            <input type="hidden" name="bm" value="<?php echo $bm ?>" hidden>
                           <td><button type="submit" onclick='return confirm("Confirm Delete Item")' class="btn-danger btn-sm fa fa-trash"></button></td> 
                           </form>
                       <?php   }else{?>
                    <form action="<?php echo base_url()?>bom/delete" method="post">
                    <input type="hidden" name="m_id" value="<?php echo $row['m_id'] ?>" hidden>
                    <input type="hidden" name="bm" value="<?php echo $bm ?>" hidden>
                   <td><button type="submit" onclick='return confirm("Confirm Delete Item")' class="btn-danger btn-sm fa fa-trash"></button></td> 
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
 $(document).ready(function() {
        
 
     
    });


</script>