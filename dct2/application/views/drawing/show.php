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
                <a class=""> </a><a  onClick="history.go(-1)"style="cursor: pointer;">Back </a> > <?php echo $name ?>  <?php echo $title ?>
                <?php  }?> 
                <?php echo $name ?>
                </h3>

                <form id='form' action="<?php echo base_url()?>drawing/manage" method="post">
                    <input type="text" name="d_no" placeholder="Drawing No">
                    <?php if(isset($d_id)){ ?>
                      <input type="hidden" name="d_id" value="<?php echo $d_id ?>">
                   <?php  } ?>
                   <?php if(isset($dcn_id)){ ?>
                      <input type="hidden" name="dcn_id" value="<?php echo $dcn_id ?>">
                   <?php  } ?>
                    <input type="hidden" name="name" value="Drawing">
                    <input hidden type="submit" name="search" value="search">
                  </form>

                  <form id='form' action="<?php echo base_url()?>drawing/manage" method="post">
                    <input type="text" name="p_no" placeholder="Part No">
                    <?php if(isset($d_id)){ ?>
                      <input type="hidden" name="d_id" value="<?php echo $d_id ?>">
                   <?php  } ?>
                   <?php if(isset($dcn_id)){ ?>
                      <input type="hidden" name="dcn_id" value="<?php echo $dcn_id ?>">
                   <?php  } ?>
                    <input type="hidden" name="name" value="Part">
                    <input hidden type="submit" name="search" value="search">
                  </form>

                </div>
                <div class="card-body">
                <table id="demo-datatables-buttons-1" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th width="10%">Drawing No</th>
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
                    <?php echo "<b>".$r->d_no."</b>" ?>
                    <td><?php echo "<b>".$r->p_no."</b>" ?></td>
                    <?php
                echo"</td>";?>
                <td class="text-center">
                  <form id='form' action="<?php echo base_url()?>drawing/open_dcn" method="post">
                    <input type="hidden" name="dcn_id" value="<?php echo $r->dcn_id ?>">
                    <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                    <button  type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;"><a>
                      <?php echo $r->dcn_no ?></a></button>


                  </form>
                </td>

                <td><form id='form' action="<?php echo base_url()?>drawing/manage" method="post">
                    <input type="hidden" name="p_id" value="<?php echo $r->p_id ?>">
                    <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                    <input type="hidden" name="name" value="Version">
                    <button  type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ดูVersionทั้งหมด</h5>' style="border:none;"><a>
                      <?php echo $r->version ?></a></button>



                  </form></td>
                <?php 
                if(isset($r->v_id)){
                    if($r->v_id != 'v_id'){
              if($r->enable!=1 ){?>
                  
                  <td class="text-center">
                    <form id="form" action="<?php echo base_url()?>drawing/enable_v" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <input type="hidden" name="v_id" value="<?php echo $r->v_id ?>">
                  <button type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดการใช้งาน</h5>' style="border:none;"><i class='btn-danger btn-sm fa fa-times'></i></button>

                  </form>
                  <?php
                }
                else{?>
                  <td class="text-center">
                  <form id="form" action="<?php echo base_url()?>drawing/disable_v" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <input type="hidden" name="v_id" value="<?php echo $r->v_id ?>">
                  <button data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ปิดการใช้งาน</h5>' style="border:none;"><i class='btn-success btn-sm fa fa-check'></i></button>
                  
                  </form>                                  
                  <?php
                }
                }else{


                if($r->enable!=1 ){?>
                  
                  <td class="text-center">

                  <form id="form" action="<?php echo base_url()?>drawing/enable" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <?php if(isset($dcn_id)){ ?>
                  <input type="hidden" name="dcn_id" value="<?php echo $r->dcn_id ?>">
                  <?php  } ?>
                  <button type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดการใช้งาน</h5>' style="border:none;"><i class='btn-danger btn-sm fa fa-times'></i></button>

                  </form>

                  <?php
                }
                else{?>
                  <td class="text-center">
                  <form id="form" action="<?php echo base_url()?>drawing/disable" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <?php if(isset($dcn_id)){ ?>
                  <input type="hidden" name="dcn_id" value="<?php echo $r->dcn_id ?>">
                  <?php  } ?>
                  <button data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ปิดการใช้งาน</h5>' style="border:none;"><i class='btn-success btn-sm fa fa-check'></i></button>
                  
                  </form>                       
                  <?php
                }
                }
                 if($r->v_id != 'v_id'){ ?>
              <input type="text" name="v_id" value="<?php echo $r->v_id ?>" hidden >
              <?php
                }
              }

              else{
                   if($r->enable!=1){?>
                  
                  <td class="text-center">

                  <form id="form" action="<?php echo base_url()?>drawing/enable" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <?php if(isset($dcn_id)){ ?>
                  <input type="hidden" name="dcn_id" value="<?php echo $r->dcn_id ?>">
                  <?php  } ?>
                  <button type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดการใช้งาน</h5>' style="border:none;"><i class='btn-danger btn-sm fa fa-times'></i></button>

                  </form>

                  <?php
                }
                else{?>
                  <td class="text-center">
                  <form id="form" action="<?php echo base_url()?>drawing/disable" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <?php if(isset($dcn_id)){ ?>
                  <input type="hidden" name="dcn_id" value="<?php echo $r->dcn_id ?>">
                  <?php  } ?>
                  <button data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ปิดการใช้งาน</h5>' style="border:none;"><i class='btn-success btn-sm fa fa-check'></i></button>
                  
                  </form>                      
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
                  echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."drawing/deletedrawing_v/".$r->v_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a>"; 
                  ?>

                  <form id='form' action="<?php echo base_url()?>drawing/openfile" method="post">
    <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>" >
    <input type="hidden" name="path" value="<?php echo $r->path_file ?>\" >
    <input type="hidden" name="file" value="<?php echo $r->file_name ?>" >
    <button  type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;"><i class=" btn-primary btn-sm fa fa-inbox" aria-hidden="true"></i>
    </button>
                  </form></td>

<?php
                }else{
                  echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."drawing/deletedrawing/".$r->d_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a>"; 
                  ?>

                  <form id='form' action="<?php echo base_url()?>drawing/openfile" method="post">
    <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>" >
    <input type="hidden" name="path" value="<?php echo $r->path_file ?>\" >
    <input type="hidden" name="file" value="<?php echo $r->file_name ?>" >
    <button  type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;"><i class=" btn-primary btn-sm fa fa-inbox" aria-hidden="true"></i>
    </button>
                  </form></td>

<?php
                }
                }else{
                  echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."drawing/deletedrawing/".$r->d_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a>";
                  ?>

                  <form id='form' action="<?php echo base_url()?>drawing/openfile" method="post">
    <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>" >
    <input type="hidden" name="path" value="<?php echo $r->path_file ?>\" >
    <input type="hidden" name="file" value="<?php echo $r->file_name ?>" >
    <button  type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;"><i class=" btn-primary btn-sm fa fa-inbox" aria-hidden="true"></i>
    </button>
                  </form></td>

<?php

                }
                ?>
                
                
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
      <script>
    $(document).ready(function() {
      $("#button").click();
  });
</script>


    