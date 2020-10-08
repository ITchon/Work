
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
                  <h3>MANAGE STANDARD <i class="fa fa-file-pdf-o" aria-hidden="true"></i></h3>
                </div>
                <?php echo $this->session->flashdata("success"); ?>
                <div class="card-body">
                  <table id="demo-datatables-buttons-1" class="table table-hover  dataTable " cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <td colspan="12">
                         <div id="btn_enable" class="btn  btn-success"><span class="fa fa-check"></span></div>
									      	<div id="btn_disable" class="btn  btn-danger"><span class="fa fa-times"></span></div>
									    	  <div id="btn_delete" class="btn btn-default"><span class="fa fa-trash-o"></span></div>
								    	  </td>
								      </tr>	
                      <tr>
                        <th  width="3%" class="text-center">
															<label class="pos-rel">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
												</th>
                        <th>Customer name</th>
                        <th>Standard No</th>
                        <th>Standard Name</th>
                        <th>DCN No</th>
                        <th>Cust Rev</th>
                        <th>Rev</th>
                        <th>Manage</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($result as $r){
            echo "<tr>";
            echo "<td style='text-align:center;'>
            <label class='pos-rel'>
                <input type='checkbox' class='ace' name='chk_uid[]' value='$r->std_id'/>
                <span class='lbl'></span>
              </label>
          </td>";
                echo "<td>".$r->cusname."</td>";
                echo "<td>".$r->std_no."</td>";
                echo "<td>".$r->std_name."</td>";
                echo "<td>".$r->dcn_no."</td>";
                echo "<td>".$r->cus_rev."</td>";
                if($this->session->flashdata("show_version")!== null){ echo "<td><a  href='".base_url()."standard/show_v?std_id=".$r->std_id."'  >$r->rev</a></td>";
                }else{
                  echo "<td class='text-center'>$r->rev</td>";
                }    
                echo "<td><div class='text-center'>";
                if (file_exists("uploads/$r->foldergroup_name/$r->folder_name/$r->file_name")) echo "<a href='javascript:void(0)'  data-id='".$r->std_id."' class='view_img '><i class='btn-success no-border btn-sm fa fa-search'> </i></a>";

                if($this->session->flashdata("edit")!== null )
                echo "<a  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>แก้ไขข้อมูล</h5>' data-original-title='Rule' href='".base_url()."standard/edit/".$r->std_id."'  ><i class='btn-info no-border fa fa-pencil-square-o'></i></a>";
                if($this->session->flashdata("version")!== null ) 
                echo "<a href='".base_url()."standard/add_version/".$r->std_id."'  ><i class='btn-info no-border fa fa-plus'></i></a>";
                if($this->session->flashdata("delete")!== null )
                echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."standard/delete/".$r->std_id ."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border fa fa-trash'></i></a></td>";  
      
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
       url:'<?php echo base_url() ?>ajax/view_standard_pdf',
      data: {
       id: id
      },
      dataType: "json",
      success: function (res) {
      var html = '';
      var pdfjsLib = window['pdfjs-dist/build/pdf'];
      console.log(res);

      // The workerSrc property shall be specified.
      pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

      // if(res.success != false){ 
      var path ='uploads/'+res.data[0].foldergroup_name+'/'+res.data[0].folder_name+'/'+res.data[0].file_name;
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
    alert('NO DATA');
    }
 });
});

});
$(document).ready(function() {
var myTable = 	$('#demo-datatables-buttons-1').DataTable();
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
         		
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			

    $('#demo-datatables-buttons-1 > thead > tr > th input[type=checkbox], #demo-datatables-buttons-1 input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#demo-datatables-buttons-1').find('tbody > tr').each(function(index ){
						if(th_checked) $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
						else  	$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#demo-datatables-buttons-1').on('click', 'td input[type=checkbox]' , function(index){
					var row = $(this).closest('tr').get(0);
					if(this.checked) $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					else 	$( myTable.row( row ).node() ).find('input:checkbox').prop('checked', false);
        });
        $('#btn_enable').click(function(e) {
		
    if(confirm('คุณต้องการเปิดการใช้งานนี้ใช่หรือไม่')){
      
      $('#frm_usermanagement').attr('action', '<?php echo base_url().'user/checkall_enable'; ?>');
      $('#frm_usermanagement').submit();
      
    }else{
      
      return false;
    }
    
       
    
    });
  
  $('#btn_disable').click(function(e) {
    
    if(confirm('คุณต้องการระงับรายการนี้ใช่หรือไม่')){
    
           $('#frm_usermanagement').attr('action', '<?php echo base_url().'user/checkall_disable'; ?>');
      $('#frm_usermanagement').submit();
    
    }else{
    
      return false;	
    }
    
    });
  
  $('#btn_delete').click(function(e) {
    
    if(confirm('คุณต้องการลบรายการใช้งานนี้ใช่หรือไม่')){
    
          $('#frm_usermanagement').attr('action', '<?php echo base_url().'user/checkall_delete'; ?>');
      $('#frm_usermanagement').submit();
    
    }else{
      
      return false;
    }
    
    });
    });
</script>

