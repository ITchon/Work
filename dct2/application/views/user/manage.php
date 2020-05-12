
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">DataTables
                <small>Responsive Extension</small>
              </span>

            </h1>
            <p class="title-bar-description">
              <small>The tables presented below use <a href="https://datatables.net/extensions/responsive/" target="_blank">DataTables Responsive Extension</a>, the styling of which is completely rewritten in SASS, without modifying however anything in JavaScript.</small>
            </p>
          </div>

          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
              
                  <strong>Responsive Table</strong>
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
                  <td class="text-center"><a type="button" data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'user/enable/' . $r->su_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>
                  <!-- echo "<td><a href='".base_url()."index.php/user/permission/".$r->user_id."' class='btn btn-success'>Enable</a>"; -->
                  <td class="text-center"><a type="button"  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'user/disable/' . $r->su_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                ?> 


                <a class='btn-primary' onclick="javascript:window.location='<?php
                echo base_url() . 'user/rule/' . $r->su_id;
                ?>';"><i class='btn-info btn-sm fa fa-wrench'> </i></a> &nbsp


                <a type ='button' class=' ' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'user/rule_ug/' . $r->su_id;
                ?>';"><i class='btn-info btn-sm fa fa-key'> </i> </a>
                <?php 
                echo "<a type='button' href='".base_url()."user/deleteuser/".$r->su_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";  
           
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
    
