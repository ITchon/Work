
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
            </h1>
          </div>

          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <h3>MANAGE FOLDER GROUP <i class="fa fa-folder" aria-hidden="true"></i></h3>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-buttons-1" class="table table-hover  table-bordered dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th>foldergroup Name</th>
                        <th>Status</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      
                    <?php
                    foreach($result as $r){
                echo "<tr>";
                echo "<td>".$r->foldergroup_name."</td>";
                if($this->session->flashdata("edit")!== null )
                echo "<td class='text-center'><a   href='".base_url()."foldergroup/edit/".$r->fg_id."'  ><i class='btn-info no-border fa fa-pencil-square-o'></i></a>";
                
                if($this->session->flashdata("delete")!== null )
                echo "<a  href='".base_url()."foldergroup/delete/".$r->fg_id ."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border fa fa-trash'></i></a></td>";  
      
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
    
