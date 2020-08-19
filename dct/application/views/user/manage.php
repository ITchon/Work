    <style type="text/css">

    </style>
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
                <?php echo $this->session->flashdata("success"); ?>

                  <table id="demo-datatables-buttons-1" class="table table-hover  table-bordered dataTable" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <?php if($this->session->userdata('sug_id')==1){
                         echo "<td>Password</td>";
                      }             
                        ?>
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
                    $encrypted_id = base64_encode($r->su_id);
                echo "<tr>";
                echo "<td>".$r->username."</td>";
                if($this->session->userdata('sug_id')==1){
                   echo "<td>".base64_decode($r->password)."</td>";
                 }
                echo "<td>".$r->firstname." ".$r->lastname."</td>";
                echo "<td>".$r->gender."</td>"; 
                echo "<td>".$r->name."</td>";
                echo "<td>".$r->email."</td>";
                echo "<td class='text-center'>";
                
    
                if($r->name == "MEMBER" || $this->session->userdata('sug_id')==1){
                  if($r->enable!=1 ){  
                    if($this->session->flashdata("enable")!== null )
                   echo "<a  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เเก้ไขสิทธิ์</h5>' data-original-title='Rule' href='".base_url()."user/enable/".$encrypted_id."'><i class='btn-danger no-border fa fa-close'></i></a>";
                      }
                else{ 
                   if($this->session->flashdata("disable")!== null )
                 echo "<a  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เเก้ไขสิทธิ์</h5>' data-original-title='Rule' href='".base_url()."user/disable/".$encrypted_id."'><i class='btn-success no-border fa fa-check'></i></a>";
                }

                 if($this->session->flashdata("rule")!== null )
                echo "<a  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เเก้ไขสิทธิ์</h5>' data-original-title='Rule' href='".base_url()."user/rule/".$encrypted_id."'  ><i class='btn-info no-border fa fa-gear'></i></a>";
                 if( $this->session->flashdata("edit")!== null )
                  echo "<a  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เเก้ไขข้อมูล</h5>' data-original-title='Rule' href='".base_url()."user/edit_u/".$encrypted_id."'  ><i class='btn-info no-border fa fa-wrench'></i></a>";

                 if($this->session->flashdata("delete") !==null)
                     echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."user/deleteuser/".$encrypted_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border fa fa-trash'></i></a></td>";  
                  
             
                }
              
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

