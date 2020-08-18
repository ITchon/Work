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
                <table id="demo-datatables-buttons-1" class="table table-hover dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                      <th>DCN no</th>
                      <th>DCN File</th>
                      <th>Path File</th>
                      <th>Manage</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                    foreach($result as $r){
             echo "<tr>";
             echo "<td>" ?>
                    <?php echo"<b>".$r->dcn_no."</b>" ?>

        <td class="text-center">
                  <form id='form' action="<?php echo base_url()?>drawing/open_dcn" method="post">
                  <input type="hidden" name="dcn_id" value="<?php echo $r->dcn_id ?>">
                  <input type="hidden" name="path" value="C:\inetpub\wwwroot\dct\uploads\">
                  <input type="hidden" name="filename" value="<?php echo $r->dcn_file ?>">
                  <input type="hidden" name="file" value="<?php echo $r->dcn_code ?>">
                    <button  type="submit" style=" background-color: Transparent;border:none" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;"><a>
                      <?php echo $r->dcn_file ?></a></button>
                  </form>
                </td>
                <td style="font-size: 14px"><?php echo $r->dcn_path ?> </td>
        
                <?php 
                echo "<td class='text-center'>";
                if($r->enable!=1 ){
                   if($this->session->flashdata("disable")!== null )
                   echo "<a  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เเก้ไขสิทธิ์</h5>' data-original-title='Rule' href='".base_url()."dcn/enable/".$r->dcn_id."'><i class='btn-danger no-border fa fa-close'></i></a>";
                   }
                else{ 
                 if($this->session->flashdata("enable")!== null )
                 echo "<a  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เเก้ไขสิทธิ์</h5>' data-original-title='Rule' href='".base_url()."dcn/disable/".$r->dcn_id."'><i class='btn-success no-border fa fa-check'></i></a>";  
                 }
                  if($this->session->flashdata("edit")!== null )
                  echo "<a  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>แก้ไขข้อมูล</h5>' data-original-title='Rule' href='".base_url()."dcn/edit_dcn/".$r->dcn_id."'  ><i class='btn-info no-border fa fa-wrench'></i></a>";
                  if($this->session->flashdata("delete") !==null)
                  echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."dcn/deletedcn/".$r->dcn_id ."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border fa fa-trash'></i></a></td>";  
                  echo "</td>";
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

