<style>
form {
  display: inline-block;

}
.form-control{
  height: 38px
}
</style>



<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>

  <!-- Trigger the modal with a button -->

  <!-- Modal -->



      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
         
            <p class="title-bar-description">
             
            </p>
          </div>
          

          <div class="row gutter-xs">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header ">

                <h3>
                <a href="<?php echo base_url()?>drawing/show">MANAGE DRAWING</a> 
                <a href="" class="btn btn-default no_print" onclick="window.history.go(-1); return false;"> Back </a>
                </h3>
                <?php  
                $search = $this->session->flashdata('search');
                $this->session->set_flashdata('search',$search);
                ?>
                <form action="<?php echo base_url()?>drawing/show" method="get">
                <div class="col-md-3"> 
                <input type="checkbox" name="all" value="21313" id="all" checked>      
                <label  for="all" style="cursor: pointer;color:#5b6572" >ALL</label><br>  
                <?php  
                foreach($result_type as $r){ ?>
                   <input type="checkbox" name="type[]" value="" id="<?php echo $r->tf_id ?>" >      
                   <label  for="<?php echo $r->tf_id ?>" style="cursor: pointer;color:#5b6572" ><?php echo $r->tf_name ?></label><br>  
                <?php  } ?>
                </div>
                <br>
                <div class="col-md-2"> 
                  <div class="input-group" >
                    <div class="input-group-btn">
                        <a href="" class="no_print btn btn-primary ">Part No.</a> 
                    </div>
                    <input type="text" name="s_pno" class="form-control" value="<?php echo $s_pno ?>">
                  </div>
                </div>
  

                  <div class="col-md-3">
                             <div class="input-group" >
                         <div class="input-group-btn">
                              <a href="" class="no_print btn btn-primary ">Drawing Name</a> 
                         </div>
                    <input type="text" class="form-control" name="s_name" value="<?php echo $s_name; ?>">
                   </div> 
                 </div>

                 <div class="col-md-3">
                      <div class="input-group" >
                         <div class="input-group-btn">
                              <a href="" class="no_print btn btn-primary ">Drawing No.</a> 
                         </div>
                              <input type="text" class="form-control" name="s_dno" value="<?php echo $s_dno; ?>">
                      </div>
                  </div>
                           <div class="col-md">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
                </form>



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
                    <?php  if($this->session->flashdata("link")!== null ){ 
                      echo "<td><a href='".base_url()."dcn/manage/".$r->dcn_id."'>$r->dcn_no</a></td>"; 
                    }
                    else{ 
                      echo "<td>$r->dcn_no</td>";
                       }  
                       if($this->session->flashdata("show_version")!== null){ ?>           
                       <td class="text-center">
                        <form  action="<?php echo base_url()?>drawing/show_v" method="get">
                          <input type="hidden" name="p_id" value="<?php echo $r->p_id ?>">
                          <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
      
                          <button  type="submit"  style=" background-color: Transparent;border:none" ><a>
                            <?php echo $r->version ?></a></button>
                        </form>
                     </td>
                  <?php 
                     }else{
                          echo "<td class='text-center'>$r->version</td>";
                     }
                  echo "<td class='text-center'>";
                  echo " <a href='javascript:void(0)'  data-id='".$r->d_id."' class='view_img'><i class='btn-success no-border btn-sm fa fa-search'> </i></a>";
                  if($this->session->flashdata("download")!== null ) echo "<a href='".base_url()."drawing/openfile/".$r->d_id."'  ><i class='btn-info no-border fa fa-inbox'></i></a>";
                  if($this->session->flashdata("edit")!== null ) echo "<a  href='".base_url()."drawing/edit/".$r->d_id."'  ><i class='btn-info no-border fa fa-wrench'></i></a>";
                  if( $this->session->flashdata("version")!== null ) echo "<a href='".base_url()."drawing/version_form/".$r->d_id."'  ><i class='btn-info no-border fa fa-plus'></i></a>";
                  if($this->session->flashdata("delete") !==null) echo "<a href='".base_url()."drawing/deletedrawing/".$r->d_id ."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border fa fa-trash'></i></a></td>";  
                
                  echo "<td class='text-center'>";
                  if($r->enable==1 ){  
                    $icon = "btn-success no-border fa fa-check";
                    $text = "ENABLE";
                    $color = "color:#43a047";
                    }
                else{ 
                  $icon = "btn-danger no-border fa fa-close";
                  $text = "DISABLE";
                  $color = "color:#D50000";
                }
                if($this->session->flashdata("enable")!== null ){ echo "<a  href='".base_url()."drawing/enable/".$r->d_id ."'><i class='$icon'> $text</i></a>";}
                else{ echo "<span style='$color'>$text </span>"; }
                    echo "</td>";
                    echo "<td style='font-size: 14px'>".$r->path_file.''.$r->file_name ."</td>";   
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


     



     