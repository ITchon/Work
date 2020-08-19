
      <div class="layout-content">
        <div class="layout-content-body">
        
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <h3>MANAGE PERMISSION</h3>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-buttons-1" class="table table-hover  table-bordered dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th>Permission name</th>
                        <th width="30%">Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    <?php
                    foreach($result as $r){
            echo "<tr>";
                echo "<td>".$r->name."</td>";
                 if($r->enable!=1 ){?>
                  
                  <td class="text-center"><a type="button"  onclick="javascript:window.location='<?php
                  echo base_url() . 'permission/enable/' . $r->sp_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>

                  <td class="text-center"><a   onclick="javascript:window.location='<?php
                  echo base_url() . 'permission/disable/' . $r->sp_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                ?> <a type ='button' class=' '  onclick="javascript:window.location='<?php
                echo base_url() . 'permission/edit_permission/' . $r->sp_id;
                ?>';"><i class='btn-info btn-sm fa fa-wrench'> </i> </a>
                <?php 
                echo "<a  href='".base_url()."permission/deletepermission/".$r->sp_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";  
       
           
           
 
                
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
    
