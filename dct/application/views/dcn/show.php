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
                $search = $this->session->flashdata('search');
                $this->session->set_flashdata('search',$search);
            
                ?>
                <form name="search" action="<?php echo base_url()?>dcn/manage" method="get">
                <br>
                <div class="col-md-3">
                      <div class="input-group" >
                         <div class="input-group-btn">
                            <a href="" class=" btn btn-primary ">DCN No.</a>
                         </div>
                            <input type="text" class="form-control" name="s_dcno" value="<?php echo $s_dcno; ?>">
                      </div>
                </div>

                  <div class="col-md-3">
                        <div class="input-group" >
                         <div class="input-group-btn">
                              <a href="" class=" btn btn-primary ">DCN Name</a> 
                         </div>
                    <input type="text" class="form-control" name="s_name" value="<?php echo $s_name; ?>">
                   </div> 
                 </div>
                  
                  <div class="col-md">
                  <button type="submit" class="btn btn-primary" "><i class="fa fa-search"></i></button>
                </div>
                </form>
                  <?php
                  $this->session->set_flashdata('chk',$chk); 
                  ?>
                </div>
                <div class="card-body">
                <?php echo form_open('#', array('id' => 'frm_usermanagement', 'name'=>'frm_usermanagement', 'class'=>'form-horizontal'));?>
                <table id="demo-datatables-buttons-1" class="table table-hover dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
								    	<td colspan="12">
                        <?php if($this->session->flashdata("chkall")!== null ) echo "<div id='btn_enable' class='btn  btn-success'><span class='fa fa-check'></span></div>
                        <div id='btn_disable' class='btn  btn-danger'><span class='fa fa-times'></span></div>
                        <div id='btn_delete' class='btn btn-default'><span class='fa fa-trash-o'></span></div>"; ?>
                        <?php if($this->session->flashdata("csv")!== null ){?>
                        <a class="btn btn-outline-primary" href='<?= base_url() ?>dcn/exportCSV'>Csv</a><?php } ?>                      </td>
								      </tr>	
                      <tr>
                      <th  width="3%" class="text-center">
															<label class="pos-rel">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th>
                      <th>DCN No</th>
                      <th>DCN Name</th>
                      <th>Model</th>
                      <th>Customer</th>
                      <th width="16%">Manage</th>
                      <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                    foreach($result as $r){
             echo "<tr>";
             echo "<td style='text-align:center;'>
             <label class='pos-rel'>
                 <input type='checkbox' class='ace' name='chk_uid[]' value='$r->dcn_id'/>
                 <span class='lbl'></span>
               </label>
           </td>";
             echo"<td><b>".$r->dcn_no."</b></td>" ;
             echo"<td><b>".$r->dcn_name."</b></td>" ;
             echo"<td><b>".$r->model."</b></td>" ;
             echo"<td><b>".$r->cus_name."</b></td>" ;
          
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

