
        <style>
#form {
  display: inline-block;
}
</style>
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
         
            <p class="title-bar-description">
             
            </p>
          </div>

          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header ">
            
              <h3><a href="<?php echo base_url()?>drawing/manage">MANAGE DRAWING </a>
                </h3>
                </div>
                <br>
 <div class="col-xs-9"> 
   </div>
 <?php if($title!=null){?>
  <form class="form-inline" style="" id='form' action="<?php echo base_url()?>drawing/manage" method="post">
       <input type="hidden" name="d_id" value="<?php echo $d_id ?>">
      <input type="hidden" name="name" value="Drawing">
      <input  type="submit" class="btn btn-primary btn-sm" value="Clear">
    </form>
                <?php  }?> 
 <form class="form-inline"  id='form' action="<?php echo base_url()?>drawing/manage" method="post">
       <input type="hidden" name="d_id" value="<?php echo $d_id ?>">
      <input type="hidden" name="name" value="Drawing">
      <input type="text" class="form-control" name="p_no" placeholder="Part No" value="<?php echo $search ?>">
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
    </form>
                <div class="card-body">
                
                <table id="table" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th width="10%">Part No</th>
                        <th width="10%">Drawing No</th>
                        <th width="10%">DCN</th>
                        <th width="3%">Version</th>
                        <th width="10%">Manage</th>
                        <th width="10%">Status</th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php
                    foreach($result as $r){
                      echo "<tr>";
                   echo   "<td> <b>$r->p_no</b></td>";
                   echo   "<td> <b>$r->d_no</b></td>";
             ?>
                <td >
                  <form id='form' action="<?php echo base_url()?>drawing/open_dcn" method="post">
                    <input type="hidden" name="dcn_id" value="<?php echo $r->dcn_id ?>">
                    <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                    <button  type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;"><a>
                      <?php echo $r->dcn_no ?></a></button>


                  </form>
                </td>

                <td><a href="<?php echo base_url() . 'drawing/manage/' . $r->d_id ?>" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ดูVersionทั้งหมด</h5>'><?php echo $r->version ?></a></td>
                <?php 
      

                   if($r->enable!=1 ){?>
                  
                  <td class="text-center"><a type="button" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดการใช้งาน</h5>' data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'drawing/enable/' . $r->d_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>
                  <td class="text-center"><a type="button" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ปิดการใช้งาน</h5>'  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'drawing/disable/' . $r->d_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }

                ?>
                  <a type ='button' class=' ' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เพิ่มVersion</h5>' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'drawing/version_form/' . $r->d_id;
                ?>';"><i class='btn-info btn-sm fa fa-plus'> </i> </a>

                <?php 
             
                  ?>
                    <a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='<?php echo base_url()."drawing/deletedrawing/$r->d_id"?>' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a>
                  <form id='form' action="<?php echo base_url()?>drawing/openfile" method="post">
                    <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>" >
                    <input type="hidden" name="path" value="<?php echo $r->path_file ?>" >
                    <input type="hidden" name="file" value="<?php echo $r->file_name ?>" >
                    <button  type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;"><i class=" btn-primary btn-sm fa fa-inbox" aria-hidden="true"></i></button>
                  </form></td>
                
                <?php 
                if($r->enable!=1 ){?>
                  
                  <td class="text-center"><b><font color="red">disable</font></b></td>
                  <?php
                }
                else{?>
                  <td class="text-center"><b><font color="lightgreen">active</font></b></td>                   
                  <?php
                }
                ?>  

                
                <?php

            echo "</tr>";


        }
    ?>
            
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
  
            
          </div>
        </div>
      </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script>
                
        $(document).ready(function() {
          
    $('.select2').select2();
});

      </script>
