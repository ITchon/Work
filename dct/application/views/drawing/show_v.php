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
                <table id="demo-datatables-responsive-1" class="table table-hover  table-nowrap dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th>Type</th>
                        <th width="10%">Part No</th>
                        <th width="15%">Drawing Name</th>
                        <th width="15%">Drawing No</th>
                        <th width="15%">Model</th>
                        <th width="15%">POS</th>
                        <th width="5%">Customer</th>
                        <th width="10%">DCN</th>
                        <th width="3%">Rev</th>
                        <th width="10%">Manage</th>
                        <th width="10%">Status</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                    foreach($result_last as $r){
             echo "<tr>";?>
                    <td><?php echo "<b>".$r->type_name."</b>" ?></td>
                    <td><?php echo "<b>".$r->p_no."</b>" ?></td>
                    <td><?php echo "<b>".$r->d_name."</b>" ?></td>
                    <td><?php echo "<b>".$r->d_no."</b>" ?></td>
                    <td><?php echo "<b>".$r->model."</b>" ?></td>
                    <td><?php echo "<b>".$r->pos."</b>" ?></td>
                    <td><?php echo "<b>".$r->cus_name."</b>" ?></td>
                    <?php  if($this->session->flashdata("link")!== null ){ 
                      echo "<td><a href='".base_url()."dcn/manage/".$r->dcn_id."'>$r->dcn_no</a></td>"; 
                    }
                    else{ 
                      echo "<td>$r->dcn_no</td>";
                       }  ?>

                <td class="text-center">
                <?php echo $r->rev ?>
                </td>                               
                <td>
                  <?php 
                  echo " <a href='javascript:void(0)'  data-id='".$r->d_id."' class='view_img'><i class='btn-success no-border btn-sm fa fa-search'> </i></a>";
                  if($this->session->flashdata("download")!== null ) echo "<a href='".base_url()."drawing/openfile/".$r->d_id."'  ><i class='btn-info no-border fa fa-inbox'></i></a>";
                  if($this->session->flashdata("edit")!== null ) echo "<a  href='".base_url()."drawing/edit/".$r->d_id."'  ><i class='btn-info no-border fa fa-pencil-square-o'></i></a>";

                if($r->enable!=1 ){?>
                  
                  <td class="text-center"><b><font color="red">disable</font></b></td>
                  <?php
                }
                else{?>
                  <td class="text-center"><b><font color="lightgreen">active</font></b></td>                   
                  <?php
                }

            echo "</tr>";
        } ?>


                      <?php
                    foreach($result_rev as $r){
                 echo "<tr>";?>
                    <td><?php echo "<b>".$r->type_name."</b>" ?></td>
                    <td><?php echo "<b>".$r->p_no."</b>" ?></td>
                    <td><?php echo "<b>".$r->d_name."</b>" ?></td>
                    <td><?php echo "<b>".$r->d_no."</b>" ?></td>
                    <td><?php echo "<b>".$r->model."</b>" ?></td>
                    <td><?php echo "<b>".$r->pos."</b>" ?></td>
                    <td><?php echo "<b>".$r->cus_name."</b>" ?></td>
                    <?php  if($this->session->flashdata("link")!== null ){ 
                      echo "<td><a href='".base_url()."dcn/manage/".$r->dcn_no."'>$r->dcn_no</a></td>"; 
                    }
                    else{ 
                      echo "<td>$r->dcn_no</td>";
                       }  ?>

                <td class="text-center">
                <?php echo $r->rev ?>
                </td>

                <td>
                  <?php
                  echo " <a href='javascript:void(0)'  data-id='".$r->rd_id."' class='view_imgv'><i class='btn-success no-border btn-sm fa fa-search'> </i></a>";
                  if($this->session->flashdata("download")!== null ) echo "<a href='".base_url()."drawing/openfile_v/".$r->rd_id."'  ><i class='btn-info no-border fa fa-inbox'></i></a>";
                  if($this->session->flashdata("edit")!== null ) echo "<a  href='".base_url()."drawing/edit_v/".$r->rd_id."/".$r->rev."'  ><i class='btn-info no-border fa fa-pencil-square-o'></i></a>";

                if($r->enable!=1 ){?>
                  
                  <td class="text-center"><b><font color="red">disable</font></b></td>
                  <?php
                }
                else{?>
                  <td class="text-center"><b><font color="lightgreen">active</font></b></td>                   
                  <?php
                }
                ?>
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
       url:'<?php echo base_url() ?>/ajax/view_dwg_pdf',
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
        var path ='uploads/'+res.data[0].foldergroup_name+'/'+res.data[0].folder_name+'/'+res.data[0].file_name;
        console.log(path);
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
      var path ='uploads/'+res.data[0].foldergroup_name+'/'+res.data[0].folder_name+'/'+res.data[0].file_name;
      console.log(path);
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


     