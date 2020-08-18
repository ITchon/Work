<style>
#form {
  display: inline-block;
}
</style>
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
         
            <p class="title-bar-description">
             
            </p>
          </div>

          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header ">
              

              <font color="#2189de"><h3><p href="<?php echo base_url()?>drawing/show">MANAGE DRAWING Version <a href="" class="btn btn-default no_print" onclick="window.history.go(-1); return false;"> Back </a> </p> <?php if(isset($title)){?>
                <a class=""> </a> > <?php echo $name ?>  <?php echo $title ?>  <a  class="fa fa-undo " onClick="history.go(-1)"style="cursor: pointer;"> </a> 
                <?php  }?> 
                </h3>
              </font>
              <?php $search =  $this->session->flashdata('search');
                  $this->session->set_flashdata('search',$search);
                  ?>


                </div>
                <div class="card-body">
                <table id="demo-datatables-buttons-1" class="table table-hover  table-nowrap dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th width="15%">Drawing No</th>
                        <th width="15%">Drawing Name</th>
                        <th width="10%">Part No</th>
                        <th width="5%">Customer</th>
                        <th width="10%">DCN</th>
                        <th width="3%">Version</th>
                        <th width="10%">Manage</th>
                        <th width="10%">Status</th>
                        <th>Path File</th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php
                    foreach($result as $r){
             echo "<tr>";?>
                    <td><?php echo "<b>".$r->d_no."</b>" ?></td>
                    <td><?php echo "<b>".$r->d_name."</b>" ?></td>
                    <td><?php echo "<b>".$r->p_no."</b>" ?></td>
                    <td><?php echo "<b>".$r->cus_name."</b>" ?></td>
                <td class="text-center">
                  <form id="form" action="<?php echo base_url()?>drawing/open_dcn" method="post">
                  <input type="hidden" name="dcn_id" value="<?php echo $r->dcn_id ?>">
                  <input type="hidden" name="path" value="C:\inetpub\wwwroot\dct\uploads\">
                  <input type="hidden" name="file" value="<?php echo $r->dcn_file ?>">
                  <input type="hidden" name="file" value="<?php echo $r->dcn_code ?>">
                    <button  type="submit" style=" background-color: Transparent;border:none" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;"><a>
                      <?php echo $r->dcn_no ?></a></button>
                  </form>
                </td>

                <td class="text-center"><form  action="<?php echo base_url()?>drawing/show_v" method="post">
                    <input type="hidden" name="p_id" value="<?php echo $r->p_id ?>">
                    <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                    <button  type="submit"  style=" background-color: Transparent;border:none" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ดูVersionทั้งหมด</h5>' ><a>
                      <?php echo $r->version ?></a></button>

                  </form></td>                               
                <td>
                  <?php if ($r->v_id !='v_id') {
                  echo " <a href='javascript:void(0)'  data-id='".$r->v_id."' class='view_imgv'><i class='btn-success no-border btn-sm fa fa-search'> </i></a>";
                  ?>
                  <form id="form" action="<?php echo base_url()?>drawing/openfile" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->v_id ?>">
                  <input type="hidden" name="path" value="C:\inetpub\wwwroot\dct\uploads\">
                  <input type="hidden" name="filename" value="<?php echo $r->file_name ?>">
                  <input type="hidden" name="file" value="<?php echo $r->file_code?>">
                  <button class=" btn-primary btn-sm fa fa-inbox" type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;">
                  </button>
                  </form>

                  
                  <form id="form" action="<?php echo base_url()?>drawing/edit_v" method="post">
                  <input type="hidden" name="v_id" value="<?php echo $r->v_id ?>">
                  <button class=" btn-primary btn-sm fa fa-wrench" type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>แก้ไขข้อมูล</h5>' style="border:none;">
                  </button>
                  </form>

                  <?php }else{ 
                  echo " <a href='javascript:void(0)'  data-id='".$r->d_id."' class='view_img'><i class='btn-success no-border btn-sm fa fa-search'> </i></a>";
                  ?>
                  <form id="form" action="<?php echo base_url()?>drawing/openfile" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <input type="hidden" name="path" value="\\192.168.82.4\tbkk$\RD\Drawing\01_Drawings\A_Production Dwg\">
                  <input type="hidden" name="filename" value="<?php echo $r->file_name ?>">
                  <input type="hidden" name="file" value="<?php echo $r->file_code?>">
                  <button class=" btn-primary btn-sm fa fa-inbox" type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;">
                  </button>
                  </form>

                  <form id="form" action="<?php echo base_url()?>drawing/edit" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <button class=" btn-primary btn-sm fa fa-wrench" type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>แก้ไขข้อมูล</h5>' style="border:none;">
                  </button>
                  </form>

                  <?php } ?>


        
                <?php 
                if($r->enable!=1 ){?>
                  
                  <td class="text-center"><b><font color="red">disable</font></b></td>
                  <?php
                }
                else{?>
                  <td class="text-center"><b><font color="lightgreen">active</font></b></td>                   
                  <?php
                }
                ?>

                <td style="font-size: 14px"><?php echo $r->path_file ?> </td>
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
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script>
        $(document).ready(function() {
    $('.select2').select2();
});
      </script>
      <script>
        <?php if($sort == null){
          $sort = "Drawing";
        } ?>
      document.getElementById('select').value = "<?php echo $sort ?>";
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script>
        $(document).ready(function() {
    $('body').on('click', '.view_img', function () {
      var id = $(this).data("id");
       console.log(id);
 
       $.ajax({
       type: "Post",
       url:'<?php echo base_url() ?>/ajax/view_pdf',
      data: {
       id: id
      },
      dataType: "json",
      success: function (res) {
      var html = '';
      var pdfjsLib = window['pdfjs-dist/build/pdf'];

      // The workerSrc property shall be specified.
      pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

      // if(res.success != false){ 
        var path ='uploads/'+res.data[0].tf_fol+res.data[0].file_code;
 
      pdfjsLib.getDocument('<?php echo base_url()?>'+path).promise.then(function(pdfDoc_) {
          
  
      pdfDoc = pdfDoc_;
      document.getElementById('page_count').textContent = pdfDoc.numPages;
      // Initial/first page rendering
      renderPage(pageNum);
      });

             $('#modal_form').modal('show'); 
        // }else{

        // alert('No PDF File');
        // }
       
    },
    error: function (res) {
    console.log(res);
     
    alert('NO DATA');
    }
 });
});

});


</script>

<script>
        $(document).ready(function() {
    $('body').on('click', '.view_imgv', function () {
      var id = $(this).data("id");
       console.log(id);
 
       $.ajax({
       type: "Post",
       url:'<?php echo base_url() ?>/ajax/view_pdf2',
      data: {
       id: id
      },
      dataType: "json",
      success: function (res) {
      var html = '';
      var pdfjsLib = window['pdfjs-dist/build/pdf'];

      // The workerSrc property shall be specified.
      pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

      // if(res.success != false){ 
        var path ='uploads/'+res.data[0].tf_fol+res.data[0].file_code;
 
      pdfjsLib.getDocument('<?php echo base_url()?>'+path).promise.then(function(pdfDoc_) {
          
  
      pdfDoc = pdfDoc_;
      document.getElementById('page_count').textContent = pdfDoc.numPages;
      // Initial/first page rendering
      renderPage(pageNum);
      });

             $('#modal_form').modal('show'); 
        // }else{

        // alert('No PDF File');
        // }
       
    },
    error: function (res) {
    console.log(res);
     
    alert('NO DATA');
    }
 });
});

});


</script>


     