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
                  $icon = "btn-danger no-border fa fa-close";
                      }
                else{ 
                  $icon = "btn-success no-border fa fa-check";
                }
                  if($this->session->flashdata("enable")!== null ) echo "<a  href='".base_url()."user/enable/".$encrypted_id."'><i class='$icon'></i></a>";
                  if($this->session->flashdata("rule")!== null ) echo "<a  href='".base_url()."user/rule/".$encrypted_id."'  ><i class='btn-info no-border fa fa-gear'></i></a>";
                  if($this->session->flashdata("edit")!== null ) echo "<a  href='".base_url()."user/edit_u/".$encrypted_id."'  ><i class='btn-info no-border fa fa-wrench'></i></a>";
                  if($this->session->userdata('sug_id')==1){
                  if($r->mobile!=1 ){
                      $icon = "btn-danger no-border fa fa-building-o";
                      $text = "Enable mobile device";
                    }else{
                      $icon = "btn-success no-border fa fa-building-o";
                      $text = "Disable mobile device?";
                    }
                    echo "<a href='".base_url()."user/mobile/".$encrypted_id."' onclick='return confirm(\"$text\")' ><i class='$icon'></i></a>";  
                  }
                  if($this->session->flashdata("delete") !==null) echo "<a  href='".base_url()."user/deleteuser/".$encrypted_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border fa fa-trash'></i></a></td>";  
                
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

