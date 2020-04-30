
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
            <div class="col-xs-8">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="button" class="card-action card-reload" title="Reload"></button>
                    <button type="button" class="card-action card-remove" title="Remove"></button>
                  </div>
                  <strong>Responsive Table</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-buttons-1" class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th>Group id</th>
                        <th>Group name</th>
                        <th width="10%">Manage</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      
                    <?php
                    foreach($result as $r){
            echo "<tr>";
                echo "<td>".$r->sug_id."</td>";
                echo "<td>".$r->name."</td>";
                if($r->enable!=1 ){?>
                  <!-- <td><a href='".base_url()."index.php/user/permission/".$r->user_id."' class='btn btn-danger'>Disable</a>"; -->
                  <td><a type="button" data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'usergroup/enable/' . $r->sug_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>
                  <!-- echo "<td><a href='".base_url()."index.php/user/permission/".$r->user_id."' class='btn btn-success'>Enable</a>"; -->
                  <td><a type="button"  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'usergroup/disable/' . $r->sug_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                ?> <a type ='button' class=' ' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'usergroup/rule_ug/' . $r->sug_id;
                ?>';"><i class='btn-info btn-sm fa fa-key'> </i> </a>
                <?php 
                echo "<a type='button' href='".base_url()."usergroup/deletegroup/".$r->sug_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";
            echo "</tr>";
        }
    ?>
                  
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
  
            <div class="col-xs-4  card" >
            
            <form id="form"  method="post"  class="text-center" >
                 
                  <div class="form-group">
                    <label for="name-1" class="control-label">Group</label>
                    <input  class="form-control" type="text" name="gname" required>
                  </div>
                  <div class="form-group">
                    <button  id="btn" class="btn btn-primary ">Save Changes</button>
                  </div>
                </form>
          </div>
          </div>
        </div>
      </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script type="text/javascript">
      $(document).ready(function() {

        $('#table').DataTable({
          dom: 'Bfrtip',
        buttons: [
            'colvis'
        ]
       
    });

        
    $("#btn").on("click",function(){
      
        $.ajax({
           url: "<?php echo base_url(); ?>Usergroup/insert",
           type: 'POST',
           data: $("#form").serialize(),
           success: function() {
             
            alert('Insert usergroup success');
           }
        });
       });
     
    });


</script>

