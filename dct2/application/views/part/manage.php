
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
                <table id="demo-datatables-buttons-1" class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>P/NO</th>
                      <th>Part Name</th>
                        <th width="10%">Manage</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($result as $r){
            echo "<tr>";
            echo "<td>" ?>
        <form action="<?php echo base_url()?>part_drawing/manage" method="post">
                    <input type="text" name="p_id" value="<?php echo $r->p_id ?>" hidden>
                    <input type="text" name="title" value="<?php echo $r->p_no ?>" hidden>
                    <input type="text" name="name" value="Part" hidden>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <?php echo "<b>".$r->p_no."</b>" ?>
        </form>

                    <?php
                echo"</td>";
                echo "<td>".$r->p_name."</td>";
                
                if($r->enable!=1 ){?>
                  
                  <td class="text-center"><a type="button" data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'part/enable/' . $r->p_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>

                  <td class="text-center"><a type="button"  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'part/disable/' . $r->p_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                      
                  <?php
                }
                ?> <a type ='button' class=' ' data-original-title='Rule' onclick="javascript:window.location='<?php
                echo base_url() . 'part/edit_part/' . $r->p_id;
                ?>';"><i class='btn-info btn-sm fa fa-key'> </i> </a>
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

    
