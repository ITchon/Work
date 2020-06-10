
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
                  <h3>MANAGE USERGROUP</h3>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-buttons-1" class="table table-bordered table-striped dataTable text-center" cellspacing="0" width="100%">
                  <thead>
                      <tr>
    
                        <th width="20%">Group name</th>
                        <th width="20%">Manage</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($result_all as $r){
            echo "<tr>";
                echo "<td>".$r->name."</td>";
                if($r->enable!=1 ){?>
                  <!-- <td><a href='".base_url()."index.php/user/permission/".$r->user_id."' class='btn btn-danger'>Disable</a>"; -->
                  <td class="text-center"><a type="button" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดการใช้งาน</h5>' data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'usergroup/enable/' . $r->sug_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>
                  <!-- echo "<td><a href='".base_url()."index.php/user/permission/".$r->user_id."' class='btn btn-success'>Enable</a>"; -->
                  <td class="text-center"><a type="button" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ปิดการใช้งาน</h5>'  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'usergroup/disable/' . $r->sug_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                ?> <a class='' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เเก้ไขสิทธิ์</h5>' onclick="javascript:window.location='<?php
                echo base_url() . 'usergroup/rule_ug/' . $r->sug_id;
                ?>';"><i class='btn-info btn-sm fa fa-wrench'> </i> </a>

                <a type ='button' class=' ' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เเก้ไขข้อมูล</h5>' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'usergroup/edit_ug/' . $r->sug_id;
                ?>';"><i class='btn-info btn-sm fa fa-child'></i></a>

                <?php 
                echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."usergroup/deletegroup/".$r->sug_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";
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
//          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
//      <script type="text/javascript">
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

