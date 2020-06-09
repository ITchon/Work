
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
            </h1>
          </div>

          <div class="row gutter-xs">
            <div class="col-xs-8">
              <div class="card">
                <div class="card-header">
                  <h3>MANAGE PERMISSION GROUP</h3>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-buttons-1" class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th>Group name</th>
                        <th>Status</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      
                    <?php
                    foreach($result as $r){
            echo "<tr>";
                echo "<td>".$r->name."</td>";
                if($r->enable!=1 ){?>
                  
                  <td class="text-center"><a type="button" data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'permissiongroup/enable/' . $r->spg_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>
                  <td class="text-center"><a type="button"  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'permissiongroup/disable/' . $r->spg_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                ?> <a type ='button' class=' ' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'permissiongroup/edit_pg/' . $r->spg_id;
                ?>';"><i class='btn-info btn-sm fa fa-wrench'> </i> </a>
                <?php 
                echo "<a type='button' href='".base_url()."permissiongroup/delete_pg/".$r->spg_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";
                
            echo "</tr>";
        }
    ?>
                  
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-xs-4 card" >
            
            <form id="form" action="<?php echo base_url()?>permissiongroup/insert" method="post"  class="text-center" >
                 
                  <div class="form-group">
                    <label for="name-1" class="control-label">Permission Group</label>
                    <input  class="form-control" type="text" name="gname" required>
                  </div>
                  <div class="form-group">
                    <button type="submit" id="btn" class="btn btn-primary ">Save Changes</button>
                  </div>
                </form>
          </div>
          </div>
        </div>
      </div>


//            <script type="text/javascript">
//      
//      $(document).ready(function() {
//        $("#form").submit(function(){
//      
//        $.ajax({
//           url: "<?php echo base_url(); ?>permissiongroup/insert",
//           type: 'POST',
//           data: $("#form").serialize(),
//           success: function() {
//             
//            alert('Insert permissiongroup success');
//           }
//        });
//       });
//        
//        $('#table').DataTable({
//          dom: 'Bfrtip',
//        buttons: [
//            'colvis'
//        ]
//       
//    });
//
//     
//    });
//
//
//</script>
    
