
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
            </h1>
          </div>
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="button" class="card-action card-reload" title="Reload"></button>
                    <button type="button" class="card-action card-remove" title="Remove"></button>
                  </div>
                  <h3>MANAGE CUSTOMERS <i class="fa fa-file-pdf-o" aria-hidden="true"></i></h3>
                </div>
                <?php echo $this->session->flashdata("success"); ?>
                <div class="card-body">
                  <table id="demo-datatables-buttons-1" class="table table-hover  dataTable text-center" cellspacing="0" width="100%">
                  <thead>
                      <tr>
    
                        <th width="20%">TYPE</th>
                        <th width="20%">Customer name</th>
                        <th width="20%">Customer File Description</th>
                        <th width="20%">Customer File Name</th>
                        <th width="20%">Manage</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($result as $r){
            echo "<tr>";
                echo "<td>".$r->type."</td>";
                echo "<td>".$r->cusname."</td>";
                echo "<td>".$r->cusf_des."</td>";
                echo "<td>".$r->file_name."</td>";
                echo "<td><div class='text-center'>";
                if (file_exists("uploads/$r->foldergroup_name/$r->folder_name/$r->file_name")) echo "<a href='javascript:void(0)'  data-id='".$r->cusf_id."' class='view_img '><i class='btn-success no-border btn-sm fa fa-search'> </i></a>";

                if($this->session->flashdata("edit")!== null )
                echo "<a  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>แก้ไขข้อมูล</h5>' data-original-title='Rule' href='".base_url()."customersfile/edit/".$r->cusf_id."'  ><i class='btn-info no-border fa fa-pencil-square-o'></i></a>";
                
                if($this->session->flashdata("delete")!== null )
                echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."customersfile/delete/".$r->cusf_id ."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border fa fa-trash'></i></a></td>";  
      
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
      <script type="text/javascript">
        $(document).ready(function() {
       $('body').on('click', '.view_img', function () {
      var id = $(this).data("id");
       console.log(id);
 
       $.ajax({
       type: "Post",
       url:'<?php echo base_url() ?>ajax/view_customersfile_pdf',
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

