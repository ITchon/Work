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
            
                  <h3><a href="<?php echo base_url()?>drawing/manage">MANAGE DRAWING </a> <?php if(isset($title)){?>
                  >
                <a class=""> </a><a  onClick="history.go(-1)"style="cursor: pointer;">Back </a> > <?php echo $name ?>  <?php echo $title ?>
                <?php  }?> 
                </h3>
                </div>
                <div class="card-body">
                <table id="demo-datatables-buttons-1" class="table table-bordered table-striped table-nowrap dataTable " cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th width="10%">Drawing</th>
                        <th width="10%">Part No</th>
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
                echo "<td> " ?>
                
        <form action="<?php echo base_url()?>part_drawing/manage" method="post">
                    <input type="text" name="d_id" value="<?php echo $r->d_id ?>" hidden>
                    <input type="text" name="title" value="<?php echo $r->d_no ?>" hidden>
                    <input type="text" name="name" value="Drawing" hidden>
                    <button type="submit" data-toggle='tooltip' data-html='true' data-placement='right' aria-describedby='passHelp' title='<h5>ค้นหาPartที่เกี่ยวข้อง</h5>' class="btn btn-sm btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <?php echo "<b>".$r->d_no."</b>" ?>
        </form>

                    <td><?php echo "<b>".$r->p_no."</b>" ?></td>
                    <?php
                echo"</td>";?>
                <td class="text-center"><a data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดการใช้งาน</h5>' data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'drawing/open_dcn/' . $r->dcn_id;
                  ?>';"> <?php echo $r->dcn_no ?></a></td>

                <td><a href="<?php echo base_url() . 'drawing/manage/' . $r->d_id ?>" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ดูVersionทั้งหมด</h5>'><?php echo $r->version ?></a></td>
                <?php 
                if(isset($r->v_id)){
                    if($r->v_id != 'v_id'){
              if($r->enable!=1 ){?>
                  
                  <td class="text-center"><a type="button" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดการใช้งาน</h5>' data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'drawing/enable_v/' . $r->v_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>
                  <td class="text-center"><a type="button" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ปิดการใช้งาน</h5>'  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'drawing/disable_v/' . $r->v_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                }else{


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
                }
                 if($r->v_id != 'v_id'){ ?>
              <input type="text" name="v_id" value="<?php echo $r->v_id ?>" hidden >
              <?php
                }
              }

              else{
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
              }
              
                ?>

                <?php 
                if(isset($r->v_id)){
                  if($r->v_id != 'v_id'){ ?>
                  <a type ='button' class=' ' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เพิ่มVersion</h5>' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'drawing/version_form_v/' . $r->v_id;
                ?>';"><i class='btn-info btn-sm fa fa-plus'> </i> </a>
                <?php
                }else{ ?>
                  <a type ='button' class=' ' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เพิ่มVersion</h5>' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'drawing/version_form/' . $r->d_id;
                ?>';"><i class='btn-info btn-sm fa fa-plus'> </i> </a>
                <?php 
                }
                }else{ ?>
                  <a type ='button' class=' ' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เพิ่มVersion</h5>' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'drawing/version_form/' . $r->d_id;
                ?>';"><i class='btn-info btn-sm fa fa-plus'> </i> </a>
                <?php } ?>




                <?php 
                if(isset($r->v_id)){
                  if($r->v_id != 'v_id'){
                  echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."drawing/deletedrawing_v/".$r->v_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";
                }else{
                  echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."drawing/deletedrawing/".$r->d_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";
                }
                }else{
                  echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."drawing/deletedrawing/".$r->d_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a>";
                }
                ?>
                <form id='form' action="<?php echo base_url()?>part_drawing/openfile" method="post">
    <input type="text" name="path" value="<?php echo $r->path_file ?>" hidden>
    <input type="text" name="file" value="<?php echo $r->file_name ?>" hidden>
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


    