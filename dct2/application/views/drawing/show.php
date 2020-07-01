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
              
              <?php
              $this->session->set_userdata('name',$name);
              $this->session->set_userdata('id',$id);
             ?>

              <h3><a href="<?php echo base_url()?>drawing/manage">MANAGE DRAWING </a> <?php if(isset($title)){?>
                <a class=""> </a> > <?php echo $name ?>  <?php echo $title ?>  <a  class="fa fa-undo " onClick="history.go(-1)"style="cursor: pointer;"> </a> 
                <?php  }?> 
                </h3>


                <form id='form' class="form-inline" action="<?php echo base_url()?>drawing/show" method="post">
                  <input type="hidden" name="id" value="<?php echo $id ?>">
                  <input type="hidden" name="name" value="<?php echo $name ?>">
                  <input type="text-center" class="form-control" name="search" placeholder="Search..." value="<?php echo $search ?>">

                  <select id="select" name="sort" class="form-control btn btn-primary">
                    <option value="Drawing">Drawing</option>
                    <option value="Part">Part</option>
                    <option value="DCN">DCN</option>
                  </select>
                  <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                </form>



                </div>
                <div class="card-body">
                <table id="demo-datatables-buttons-1" class="table table-hover  table-nowrap dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th width="10%">Drawing No</th>
                        <th width="10%">Part No</th>
                        <th width="10%">DCN</th>
                        <th width="3%">Version</th>
                        <th width="10%">Manage</th>
                        <th width="10%">Status</th>
                        <th>Path File</th>

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
                    <button  type="submit" style=" background-color: Transparent;border:none" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;"><a>
                      <?php echo $r->dcn_file ?></a></button>


                  </form>
                </td>

                <td class="text-center"><form id='form' action="<?php echo base_url()?>drawing/show_v" method="post">
                    <input type="hidden" name="p_id" value="<?php echo $r->p_id ?>">
                    <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                  <input type="hidden" name="name" value="<?php echo $name ?>">
                    <button  type="submit"  style=" background-color: Transparent;border:none" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ดูVersionทั้งหมด</h5>' ><a>
                      <?php echo $r->version ?></a></button>

                  </form></td>
                                         
                  <?php
                   if($r->enable!=1){?>
                  
                  <td class="text-center">

                  <form id="form" action="<?php echo base_url()?>drawing/enable" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <input type="hidden" name="id" value="<?php echo $id ?>">
                  <input type="hidden" name="name" value="<?php echo $name ?>">
                  <button class='btn-danger btn-sm fa fa-times' type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' aria-describedby='passHelp' title='<h5>เปิดการใช้งาน</h5>' style="border:none;"></button>

                  </form>

                  <?php
                }
                else{?>
                  <td class="text-center">
                  <form id="form" action="<?php echo base_url()?>drawing/disable" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <input type="hidden" name="id" value="<?php echo $id ?>">
                  <input type="hidden" name="name" value="<?php echo $name ?>">
                  <button class='btn-success btn-sm fa fa-check' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ปิดการใช้งาน</h5>' style="border:none;"></button>
                  
                  </form>                      
                  <?php
                }
              
              
                ?>
                <form id='form' action="<?php echo base_url()?>drawing/version_form" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <button class=" btn-primary btn-sm fa fa-plus" type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เพิ่มVersion</h5>' style="border:none;">
                  </button>
                  </form>
      
                    <form id="form" action="<?php echo base_url()?>drawing/deletedrawing" method="post">
                    <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                    <button class="btn-danger btn-sm fa fa-trash" onclick='return confirm("Confirm Delete Item")' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' style="border:none;"></button>
                    </form>

                     <form id='form' action="<?php echo base_url()?>drawing/openfile" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <input type="hidden" name="path" value="<?php echo $r->path_file ?>\">
                  <input type="hidden" name="file" value="<?php echo $r->file_name ?>">
                  <button class=" btn-primary btn-sm fa fa-inbox" type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;">
                  </button>
                  </form>
      
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

                <td style="font-size: 14px"><?php echo $r->path_file ?> </td>
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
        <?php if($sort == null){
          $sort = "Drawing";
        } ?>
      document.getElementById('select').value = "<?php echo $sort ?>";
</script>


     