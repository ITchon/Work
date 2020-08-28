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
  
                <h3 class=" "><a href="<?php echo base_url()?>dcn/manage">MANAGE DCN</a> </h3>
                  <?php
                  $this->session->set_flashdata('chk',$chk); 
                  ?>
                </div>
                <div class="card-body">
                <table id="demo-datatables-buttons-1" class="table table-hover dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                      <th>DCN no</th>
                      <th width="16%">Manage</th>
                      <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                    foreach($result as $r){
             echo "<tr>";
            
             echo"<td><b>".$r->dcn_no."</b></td>" ;
          
             ?>

                    <?php
                      echo "<td><div class='text-center'>";
                      if (file_exists("uploads/$r->foldergroup_name/$r->folder_name/$r->file_name")) echo "<a href='javascript:void(0)'  data-id='".$r->dcn_id."' class='view_img '><i class='btn-success no-border btn-sm fa fa-search'> </i></a>";
                      if($this->session->flashdata("download")!== null ){
                     
                           echo "<a href='".base_url()."drawing/open_dcn/".$r->dcn_id."'  ><i class='btn-info no-border fa fa-inbox'></i></a>";
                       
                     
                          }
                        if($this->session->flashdata("edit")!== null )
                        echo "<a  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>แก้ไขข้อมูล</h5>' data-original-title='Rule' href='".base_url()."dcn/edit_dcn/".$r->dcn_id."'  ><i class='btn-info no-border fa fa-pencil-square-o'></i></a>";
                        if($this->session->flashdata("delete") !==null)
                        echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."dcn/deletedcn/".$r->dcn_id ."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border fa fa-trash'></i></a>";  
                        echo "</div></td>";
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
                      if($this->session->flashdata("enable")!== null ){ echo "<a  href='".base_url()."dcn/enable/".$r->dcn_id ."'><i class='$icon'> $text</i></a></td>";}
                      else{ echo "<span style='$color'>$text </span>"; }
                      echo "</td>";
                      echo "</tr>";
                  
                  } ?>
            
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
  
          </div>
        </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
       $('body').on('click', '.view_img', function () {
      var id = $(this).data("id");
       console.log(id);
 
       $.ajax({
       type: "Post",
       url:'<?php echo base_url() ?>ajax/view_dcn_pdf',
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

