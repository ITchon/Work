
     
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
          

            </h1>
            <p class="title-bar-description">
            </p>
          </div>

          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
            
                  <h3>MANAGE PART</h3>

                </div>
                <div class="card-body">
                <table id="demo-datatables-buttons-1" class="table  table-hover table-bordered dataTable" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th width="10%">Part No</th>
                      <th width="10%">Part Name</th>
                      <th class="no_print" width="10%">Manage</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($result as $r){
                echo "<tr>";
                echo "<td>".$r->p_no."</td>";
                echo "<td>".$r->p_name."</td>";
                
                if($r->enable!=1 ){?>
                  
                  <td class="text-center"><a type="button"  onclick="javascript:window.location='<?php
                  echo base_url() . 'part/enable/' . $r->p_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>

                  <td class="text-center"><a type="button"  onclick="javascript:window.location='<?php
                  echo base_url() . 'part/disable/' . $r->p_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                ?> <a type ='button' class=' ' onclick="javascript:window.location='<?php
                echo base_url() . 'part/edit_part/' . $r->p_id;
                ?>';"><i class='btn-info btn-sm fa fa-wrench'> </i> </a>
                <?php 
                echo "<a type='button' href='".base_url()."part/deletepart/".$r->p_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";  

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

    
