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
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header ">

              <h3><a href="<?php echo base_url()?>drawing/show">MANAGE DRAWING</a> 
                <a href="" class="btn btn-default no_print" onclick="window.history.go(-1); return false;"> Back </a>
                </h3>
                <?php  
                $s_pno[] =null;
                $search = $this->session->flashdata('search');
                $this->session->set_flashdata('search',$search)
                ?>


                <form   action="<?php echo base_url()?>drawing/show" method="get">
                  <div class="col-xs-3">
                      <div class="input-group" >
                         <div class="input-group-btn">
                              <a href="" class="no_print btn btn-primary ">Drawing No.</a> 
                         </div>
                              <input type="text" class="form-control" name="s_dno" value="<?php echo $s_dno; ?>">
                      </div>
                  </div>

                  <div class="col-xs-3">
                             <div class="input-group" >
                         <div class="input-group-btn">
                              <a href="" class="no_print btn btn-primary ">Drawing Name</a> 
                         </div>
                    <input type="text" class="form-control" name="s_name" value="<?php echo $s_name; ?>">
                   </div> 
                 </div>

                  <div class="col-xs-3">

                               <div class="input-group" >
                         <div class="input-group-btn">
                              <a href="" class="no_print btn btn-primary ">Part No.</a> 
                         </div>

                  <select class="lol" id="demo-select2-3" name="s_pno[]" class="form-control" multiple="multiple">
                    <?php foreach ($resultp as $r) { ?>
                     <option value="<?php echo $r->p_no ?>" <?php 
                foreach ($s_pno as $s) {
                  if($r->p_no == $s){
                    echo 'selected';
                  }
                  }?>>
                  <?php echo $r->p_no?></option>
                    <?php } ?>
                </select>
                  </div>

            </div>
                           <div class="col-xs-3">
                  <button type="submit" class="btn btn-primary">SEARCH</button>
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
                    <td class="text-center"><?php echo "<a  href='".base_url()."dcn/show/".$r->d_id."'  > $r->dcn_no </a>"?></td>
                     
                    <td class="text-center">
                       <form  action="<?php echo base_url()?>drawing/show_v" method="get">
                         <input type="hidden" name="p_id" value="<?php echo $r->p_id ?>">
                         <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
     
                         <button  type="submit"  style=" background-color: Transparent;border:none" ><a>
                           <?php echo $r->version ?></a></button>
     
                       </form>
                    </td>
                <?php 
                echo "<td class='text-center'>";
                echo " <a href='javascript:void(0)'  data-id='".$r->d_id."' class='view_img'><i class='btn-success no-border btn-sm fa fa-search'> </i></a>";
                  if($this->session->flashdata("open")!== null ) echo "<a href='".base_url()."drawing/openfile/".$r->d_id."'  ><i class='btn-info no-border fa fa-inbox'></i></a>";
                  if($this->session->flashdata("edit")!== null ) echo "<a  href='".base_url()."drawing/edit/".$r->d_id."'  ><i class='btn-info no-border fa fa-wrench'></i></a>";
                  if( $this->session->flashdata("version")!== null ) echo "<a href='".base_url()."drawing/version_form/".$r->d_id."'  ><i class='btn-info no-border fa fa-plus'></i></a>";
                  if($this->session->flashdata("delete") !==null) echo "<a href='".base_url()."drawing/deletedrawing/".$r->d_id ."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border fa fa-trash'></i></a></td>";  
                
                  echo "<td class='text-center'>";
                  if($r->enable!=1 ){  
                    if($this->session->flashdata("enable")!== null ){ echo "<a  href='".base_url()."drawing/enable/".$r->d_id ."'><i class='btn-danger no-border fa fa-check'> DISABLE</i></a>";}
                     else{ echo "<b class='text-danger'>DISABLE</b>"; }
                    }
                else{ 
                  if($this->session->flashdata("disable")!== null ){ echo "<a  href='".base_url()."drawing/disable/".$r->d_id."'><i class='btn-success no-border fa fa-check'> ENABLE</i></a>";}
                  else{echo "<b style='color:#43a047'>ENABLE</b>"; }
                }
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


     



     