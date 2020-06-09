
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

                  <h3><a href=""> Part-Drawing Table </a> <?php if(isset($title)){?>
                  >
                <a class=""> </a><a  onClick="history.go(-1)"style="cursor: pointer;">Back </a> > <?php echo $name ?>  <?php echo $title ?>
                <?php  }?> 
                </h3>
  
                </div>
                <div class="card-body">
                <table id="demo-datatables-buttons-1" class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
          
                        <th>Part name</th>
                        <th>Drawing no</th>
                        <th>Part no</th>
                        <th width="15%">Manage</th>
    
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                    foreach($result as $r){
            echo "<tr>";
                echo "<td>".$r->p_name."</td>";
                echo "<td>".$r->d_no."</td>";
                echo "<td>".$r->p_no."</td>";
                  
                  ?><td class="text-center"><?php

                echo "<a type='button' href='".base_url()."part_drawing/deletePartD/".$r->pd_id."'  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>";   

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
