
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
         
            <p class="title-bar-description">
             
            </p>
          </div>

          <div class="row gutter-xs">
            <div class="col-xs-8">
              <div class="card">
                <div class="card-header">
            
                  <h3><a href="">Drawing Table</a> <?php if(isset($title)){?>
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
                        <th>Manage</th>
              
                       
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
                ?> <a type ='button' class=' ' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'drawing/edit_permissiongroup/' . $r->d_id;
                ?>';"><i class='btn-info btn-sm fa fa-key'> </i> </a>

                <a type ='button' class=' ' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'drawing/version_form/' . $r->d_id;
                ?>';"><i class='btn-danger btn-sm fa fa-odnoklassniki'> </i> </a>


                <?php 
                echo "<a type='button' href='".base_url()."drawing/deletedrawing/".$r->d_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";
                ?>
                <td class="text-center"><b><font color="green">active</font></b></td>
                <?php
            echo "</tr>";
        }
    ?>
            
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
  
            <div class="col-xs-4  card" >
            
            <form id="form"  method="post"  class="text-center" >
                 
                  <div class="form-group">
                  <label for="name-1" class="control-label">Add Drawing No</label>
                    <input id="d_no" class="form-control" type="text" name="d_no" required>
                  </div>
                  <div class="form-group">
                  <label for="name-1" class="control-label">DCN Number</label>      
          
                     
                   <select name="dcn_id" class="form-control select2"  required>
                   <option value=""> - - - Select DCN- - - </option>
                   <?php
                   
                      foreach($result_dcn as $dcn){?>
             
                     <option value="<?php  echo $dcn->dcn_id ?>"><?php echo $dcn->dcn_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
             
                    </div>
                  <div class="form-group">
                    <button  id="btn" class="btn btn-primary ">Save Changes</button>
                  </div>
                </form>
          </div>
          </div>
        </div>
      </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script type="text/javascript">
      
      $(document).ready(function() {
           $('.select2').select2();  
        $('#table').DataTable({
     


          dom: 'Bfrtip',
        buttons: [
            'colvis'
        ]
       
    });


    $("#btn").on("click",function(){
      chk = $("#d_no").val();
      if(chk != ''){
        $.ajax({
           url: "<?php echo base_url(); ?>drawing/insert",
           type: 'POST',
           data: $("#form").serialize(),
           success: function() {
            $('#demo-datatables-buttons-1').DataTable().ajax.reload();
            alert('Insert Drawing success');
           }
        });
      }else{

      }
       });
     
    });


</script>

    