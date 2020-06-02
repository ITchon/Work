
      <div class="layout-content">
        <div class="layout-content-body">
        
          <div class="row gutter-xs">
            <div class="col-xs-8">
              <div class="card">
                <div class="card-header">
                  <h4>Permission Table</h4>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-buttons-1" class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Permission name</th>
                        <th width="15%">Manage</th>
  
     
                 
                  
                       
                      </tr>
                    </thead>
                    <tbody>
                      
                    <?php
                    foreach($result as $r){
            echo "<tr>";
                echo "<td>".$r->spg_id."</td>";
                echo "<td>".$r->name."</td>";
                 if($r->enable!=1 ){?>
                  
                  <td class="text-center"><a type="button" data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'permission/enable/' . $r->sp_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>

                  <td class="text-center"><a type="button"  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'permission/disable/' . $r->sp_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                ?> <a type ='button' class=' ' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'permission/edit_permission/' . $r->sp_id;
                ?>';"><i class='btn-info btn-sm fa fa-key'> </i> </a>
                <?php 
                echo "<a type='button' href='".base_url()."permission/deletepermission/".$r->sp_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";  
       
           
           
 
                
            echo "</tr>";
        }
    ?>
                  
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
      <div class="col-xs-4 card" >
            
            <form id="form"  method="post"  class="text-center conta" >
                 
                  <div class="form-group">
                    <br>
                    <label for="name-1" class="control-label">Add Permission</label>
                    <input  class="form-control" type="text" name="gname" required>
                  </div>
                  <div class="form-group">
                    <label for="name-1" class="control-label">Controller</label>
                    <input  class="form-control" type="text" name="controller" required>
                  </div>

                  <select name="spg_id" id="" class="form-control select2" required>
             <option value="" hidden>Select Group</option>
                  <?php 
              foreach($excLoadG as $r){?>
             
               <option value="<?php  echo $r->spg_id ?>"><?php echo $r->name ?></option>
               <?php
            }
       ?>     
          </select><br><br>
                  <div class="form-group">
                    <button type="submit" id="btn" class="btn btn-primary ">Save Changes</button>
                  </div>
                </form>
          </div>


          </div>
        </div>
      </div>
      <br><br>
      <script>
        $(document).ready(function() {
    $('.select2').select2();
});
      </script>

            <script type="text/javascript">
      
      $(document).ready(function() {

        $("#form").submit(function(){
      
        $.ajax({
           url: "<?php echo base_url(); ?>permission/insert",
           type: 'POST',
           data: $("#form").serialize(),
           success: function() {
            alert('Insert permissiongroup success');
           }
        });
       });
        
        $('#table').DataTable({
          dom: 'Bfrtip',
        buttons: [
            'colvis'
        ]
       
    });



     
    });


</script>
    
