
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
        

            </h1>
            <p class="title-bar-description">
            </p>
          </div>

          <div class="row gutter-xs">
          <div class="col-xs-7">
              <div class="card">
                <div class="card-header">

                  <h3>DCN Table</h3>
                  <small>The tables presented below use <a href="https://datatables.net/extensions/responsive/" target="_blank">DataTables Responsive Extension</a>, the styling of which is completely rewritten in SASS, without modifying however anything in JavaScript.</small>

                </div>
                <div class="card-body">
                <table id="demo-datatables-buttons-1" class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                      <th>DCN no</th>
                        <th width="">Manage</th>
                       
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                    foreach($result as $r){
             echo "<tr>";
                echo "<td>" ?>
        <form action="<?php echo base_url()?>drawing/manage" method="post">
                    <input type="text" name="dcn_Tid" value="<?php echo $r->dcn_id ?>" hidden>
                    <input type="text" name="title" value="<?php echo $r->dcn_no ?>" hidden>
                    <input type="text" name="name" value="DCN" hidden>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <?php echo"<b>".$r->dcn_no."</b>" ?>
        </form>

                    <?php
                echo"</td>";
                if($r->enable!=1 ){?>
                  
                  <td class="text-center"><a type="button" data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'drawing/enable/' . $r->dcn_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>
                  <td class="text-center"><a type="button"  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'drawing/disable/' . $r->dcn_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                ?> <a type ='button' class=' ' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'drawing/edit_permissiongroup/' . $r->dcn_id;
                ?>';"><i class='btn-info btn-sm fa fa-key'> </i> </a>
                <?php 
                echo "<a type='button' href='".base_url()."drawing/deletedrawing/".$r->dcn_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";
            echo "</tr>";
        }
    ?>
            
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
  
            <div class="col-xs-5  card" >
            
            <form id="form"  method="post"  class="text-center" >
                 
                  <div class="form-group">
                    <label for="name-1" class="control-label">Add Drawing</label>
                    <input id="dcn_no" class="form-control" type="text" name="dcn_no" required>
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
      chk = $("#dcn_no").val();

      if(chk != ''){
        $.ajax({
           url: "<?php echo base_url(); ?>dcn/insert",
           type: 'POST',
           data: $("#form").serialize(),
           success: function() {
            $('#demo-datatables-buttons-1').DataTable().ajax.reload();
            alert('Insert Dcn success');
           }
        });
      }else{

      }
       });
     
    });


</script>

