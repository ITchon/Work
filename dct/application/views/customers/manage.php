
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
                  <h3>MANAGE CUSTOMERS</h3>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-buttons-1" class="table table-hover  dataTable text-center" cellspacing="0" width="100%">
                  <thead>
                      <tr>
    
                        <th width="20%">Customer name</th>
                        <th width="20%">Customer Description</th>
                        <th width="20%">Manage</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($result_all as $r){
            echo "<tr>";
                echo "<td>".$r->cus_name."</td>";
                echo "<td>".$r->cus_des."</td>";
                ?><td> 
                <a type ='button' class=' ' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เเก้ไขข้อมูล</h5>' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'customers/edit/' . $r->cus_id;
                ?>';"><i class='btn-info btn-sm fa fa-wrench'></i></a>

                <?php 
                echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."customers/delete/".$r->cus_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";
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

