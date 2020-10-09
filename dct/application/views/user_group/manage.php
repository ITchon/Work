
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
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="button" class="card-action card-reload" title="Reload"></button>
                    <button type="button" class="card-action card-remove" title="Remove"></button>
                  </div>
                  <h3>MANAGE USERGROUP <i class="fa fa-group" aria-hidden="true"></i></h3>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-buttons-1" class="table table-hover  dataTable" cellspacing="0" width="100%">
                  <thead>
                  <tr>
								    	<td colspan="12">
                        <a class="btn btn-outline-primary" href='<?= base_url() ?>usergroup/exportCSV'>Csv</a>
								    	</td>
								    </tr>	
                      <tr>
    
                        <th width="20%">Group name</th>
                        <th width="20%">Manage</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($result_all as $r){
            echo "<tr>";
                echo "<td class='text-center'>".$r->name."</td>";
                if($r->enable!=1 ){?>
                  <!-- <td><a href='".base_url()."index.php/user/permission/".$r->user_id."' class='btn btn-danger'>Disable</a>"; -->
                  <td class="text-center"><a type="button" onclick="javascript:window.location='<?php
                  echo base_url() . 'usergroup/enable/' . $r->sug_id;
                  ?>';"><i class='btn-danger no-border btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>
                  <!-- echo "<td><a href='".base_url()."index.php/user/permission/".$r->user_id."' class='btn btn-success'>Enable</a>"; -->
                  <td class="text-center"><a type="button"  onclick="javascript:window.location='<?php
                  echo base_url() . 'usergroup/disable/' . $r->sug_id;
                  ?>';"><i class='btn-success no-border btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                ?>
                <a  onclick="javascript:window.location='<?php
                echo base_url() . 'usergroup/edit_ug/' . $r->sug_id;
                ?>';"><i class='btn-info no-border btn-sm fa fa-pencil-square-o'></i></a>

                 <a onclick="javascript:window.location='<?php
                echo base_url() . 'usergroup/rule_ug/' . $r->sug_id;
                ?>';"><i class='btn-info no-border btn-sm fa fa-key'> </i> </a>

                <?php 
                echo "<a  href='".base_url()."usergroup/deletegroup/".$r->sug_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border btn-sm fa fa-trash'></i></a></td>";
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
     <script type="text/javascript">
//      $(document).ready(function() {
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
//    $("#btn").on("click",function(){
//      
//        $.ajax({
//           url: "<?php echo base_url(); ?>usergroup/insert",
//           type: 'POST',
//           data: $("#form").serialize(),
//           success: function() {
//            
//           }
//        });
//       });
//     
//    });
//
//
//</script>

