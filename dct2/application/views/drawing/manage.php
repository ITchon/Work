<style>
#form {
  display: inline-block;
}
</style>
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

                  <h3>MANAGE DCN</h3>

                </div>
                <div class="card-body">
                <table id="demo-datatables-buttons-1" class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                      <th>DCN no</th>
                      <th width="30%">Manage</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                    foreach($result as $r){
             echo "<tr>";
             echo "<td>" ?>
              <form id="form" action="<?php echo base_url()?>drawing/manage" method="post">
                    <input type="text" name="dcn_id" value="<?php echo $r->dcn_id ?>" hidden>
                    <input type="text" name="title" value="<?php echo $r->dcn_no ?>" hidden>
                    <input type="text" name="name" value="DCN" hidden>
                    <button type="submit" class="btn btn-sm btn-primary" data-toggle='tooltip' data-html='true' data-placement='right' aria-describedby='passHelp' title='<h5>ดูข้อมูล Drawing ที่เกี่ยวข้อง</h5>'><i class="fa fa-search" aria-hidden="true"></i></button>
                    <?php echo"<b>".$r->dcn_no."</b>" ?>
                    </td>
                    
        </form>
        
        

                    <?php
                echo"</td>";
                if($r->enable!=1 ){?>
                  
                  <td class="text-center"><a type="button" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดการใช้งาน</h5>' data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'dcn/enable/' . $r->dcn_id;
                  ?>';"><i class='btn-danger btn-sm fa fa-times'></i></a>
                  <?php
                }
                else{?>

                  <td class="text-center"><a type="button" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ปิดการใช้งาน</h5>'  data-original-title='Rule' onclick="javascript:window.location='<?php
                  echo base_url() . 'dcn/disable/' . $r->dcn_id;
                  ?>';"><i class='btn-success btn-sm fa fa-check'></i></a>                     
                  <?php
                }
                ?> <a type ='button' class=' ' data-original-title='Rule'  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>แก้ไขข้อมูล</h5>' onclick="javascript:window.location='<?php
                echo base_url() . 'dcn/edit_dcn/' . $r->dcn_id;
                ?>';"><i class='btn-info btn-sm fa fa-wrench'> </i> </a>
                <?php 
                echo "<a type='button' href='".base_url()."dcn/deletedcn/".$r->dcn_id."'  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default btn-sm fa fa-trash'></i></a></td>"; ?>
                <?php
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
//          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
//      <script type="text/javascript">
//      
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
//      chk = $("#dcn_no").val();
//
//      if(chk != ''){
//        $.ajax({
//           url: "<?php echo base_url(); ?>dcn/insert",
//           type: 'POST',
//           data: $("#form").serialize(),
//           success: function() {
//            $('#demo-datatables-buttons-1').DataTable().ajax.reload();
//            alert('Insert Dcn success');
//           }
//        });
//      }else{
//
//      }
//       });
//     
//    });
//
//
//</script>

