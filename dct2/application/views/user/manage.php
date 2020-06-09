
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
                  <h3>MANAGE USER</h3>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-buttons-1" class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>Name</th>
                        <th>Gender</th>
                        <th>Group</th>
                        <th>Email</th>
                        <th width="20%">Manage</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      
                    <?php
                    foreach($result as $r){
            echo "<tr>";
                echo "<td>".$r->username."</td>";
                echo "<td>".$r->firstname." ".$r->lastname."</td>";
                echo "<td>".$r->gender."</td>"; 
                echo "<td>".$r->name."</td>";
                echo "<td>".$r->email."</td>";
                if($r->enable!=1 ){?>
                  <!-- <td><a href='".base_url()."index.php/user/permission/".$r->user_id."' class='btn btn-danger'>Disable</a>"; -->
                  <td class="text-center"><a type="button" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดการใช้งาน</h5>' data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'user/enable/' . $r->su_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>
                  <!-- echo "<td><a href='".base_url()."index.php/user/permission/".$r->user_id."' class='btn btn-success'>Enable</a>"; -->
                  <td class="text-center"><a type="button" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ปิดการใช้งาน</h5>'  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'user/disable/' . $r->su_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                ?> 


                <a class='btn-primary' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เเก้ไขสิทธิ์</h5>' onclick="javascript:window.location='<?php
                echo base_url() . 'user/rule/' . $r->su_id;
                ?>';"><i class='btn-info btn-sm fa fa-wrench'> </i></a>


                <a type ='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เเก้ไขข้อมูล</h5>' class=' ' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'user/edit_u/' . $r->su_id;
                ?>';"><i class='btn-info btn-sm fa fa-child'></i></a>
                <?php 
                echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."user/deleteuser/".$r->su_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";  
           
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

            <script type="text/javascript">
      
      $(document).ready(function() {
        
        $('#table').DataTable({
          dom: 'Bfrtip',
        buttons: [
            'colvis'
        ]
       
    });

     
    });


</script>
    
