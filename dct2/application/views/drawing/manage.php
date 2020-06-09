
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
         
            <p class="title-bar-description">
             
            </p>
          </div>
          <div class="col-xs-12 card" >
            

              <?php echo form_open_multipart('drawing/insert');?>
                 
                  <div class="form-group">
                  <label for="name-1" class="control-label">Add Drawing No</label>
                    <input id="d_no" class="form-control" type="text" name="d_no" required>
                  </div>
                  <div class="form-group">
                  <label for="name-2" class="control-label">DCN Number</label>      
          
                     
                   <select name="dcn_id" class="form-control select2" id="dcn_id"  required>
                   <option value="" hidden> - - - Select DCN- - - </option>
                   <?php
                   
                      foreach($result_dcn as $dcn){?>
                     <option value="<?php  echo $dcn->dcn_id ?>"><?php echo $dcn->dcn_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                   <div class="form-group">
                  <label for="name-1" class="control-label">File</label>
                    <input id="file_name" class="form-control" type="file" name="file_name" required>
                  </div>
                    

                  <div class="form-group">
                    <button  id="btn" class="btn btn-primary ">Save Changes</button>
                  </div>
                </form>
          </div>

          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header ">
            
                  <h3><a href="<?php echo base_url()?>drawing/manage"  >MANAGE DRAWING </a> <?php if(isset($title)){?>
                  >
                <a class=""> </a><a  onClick="history.go(-1)"style="cursor: pointer;">Back </a> > <?php echo $name ?>  <?php echo $title ?>
                <?php  }?> 
                </h3>
                </div>
                <div class="card-body">
                <table id="demo-datatables-buttons-1" class="table table-bordered table-striped table-nowrap dataTable " cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th>Drawing</th>
                        <th>DCN</th>
                        <th>Version</th>
                        <th>Manage</th>
                        <th>Status</th>
                        <th>Open File</th>
              
                       
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
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <?php echo "<b>".$r->d_no."</b>" ?>
        </form>

                    
                    <?php
                echo"</td>";
                echo "<td>$r->dcn_no</td>";
                ?><td><a href="<?php echo base_url() . 'drawing/manage/' . $r->d_id ?>"><?php echo $r->version ?></a></td>
                <?php 
                if(isset($r->v_id)){
                    if($r->v_id != 'v_id'){
              if($r->enable!=1 ){?>
                  
                  <td class="text-center"><a type="button" data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'drawing/enable_v/' . $r->v_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>
                  <td class="text-center"><a type="button"  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'drawing/disable_v/' . $r->v_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                }else{


                if($r->enable!=1 ){?>
                  
                  <td class="text-center"><a type="button" data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'drawing/enable/' . $r->d_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>
                  <td class="text-center"><a type="button"  data-original-title='Rule' onclick="javascript:window.location='<?php
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
                  
                  <td class="text-center"><a type="button" data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'drawing/enable/' . $r->d_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>
                  <td class="text-center"><a type="button"  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'drawing/disable/' . $r->d_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
              }
              
                ?>

                <?php 
                if(isset($r->v_id)){
                  if($r->v_id != 'v_id'){ ?>
                  <a type ='button' class=' ' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'drawing/version_form_v/' . $r->v_id;
                ?>';"><i class='btn-info btn-sm fa fa-key'> </i> </a>
                <?php
                }else{ ?>
                  <a type ='button' class=' ' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'drawing/version_form/' . $r->d_id;
                ?>';"><i class='btn-info btn-sm fa fa-key'> </i> </a>
                <?php 
                }
                }else{ ?>
                  <a type ='button' class=' ' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'drawing/version_form/' . $r->d_id;
                ?>';"><i class='btn-info btn-sm fa fa-key'> </i> </a>
                <?php } ?>




                <?php 
                if(isset($r->v_id)){
                  if($r->v_id != 'v_id'){
                  echo "<a type='button' href='".base_url()."drawing/deletedrawing_v/".$r->v_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";
                }else{
                  echo "<a type='button' href='".base_url()."drawing/deletedrawing/".$r->d_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";
                }
                }else{
                  echo "<a type='button' href='".base_url()."drawing/deletedrawing/".$r->d_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";
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

                <td><form action="<?php echo base_url()?>drawing/openfile" method="post">
    <input type="text" name="file" value="\<?php echo $r->file_name ?>"hidden>
    <input type="text" name="path" value="<?php echo $r->path_file ?>"hidden>
    <button type="submit" style="border:none;"><a><b><?php echo $r->file_name ?></b></a></button>
</form></td>
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


    