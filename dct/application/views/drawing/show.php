<style>

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
                <a href="<?php echo base_url()?>drawing/show">MANAGE DRAWING <i class="fa fa-leanpub" aria-hidden="true"></i></a> 
              
                </h3>
                <?php
                $folder[] = '';
                $search = $this->session->flashdata('search');
                $this->session->set_flashdata('search',$search);
            
                ?>
                <form name="search" action="<?php echo base_url()?>drawing/show" method="get">
                <div class="col-md-2"> 
                <input type="checkbox" name="folder[]" id="select_all"> <label for="select_all" style="cursor: pointer;color:#5b6572">  ALL</label> <br>
                <?php
                foreach($result_folder as $r){ ?>
                   <input type="checkbox" name="folder[]" id="<?php echo $r->f_id ?>" class="child"
                   <?php
                   foreach($folder as $t){ 
                     if($r->f_id == $t){
                       echo 'checked';
                     }
                   } ?>
                  value="<?php echo $r->f_id ?>" > 
                   <label for="<?php echo $r->f_id ?>" style="cursor: pointer;color:#5b6572" ><?php echo $r->name ?></label><br>  
                <?php  } ?>
                </div>
                <br>
                <div class="col-md-3 "> 
                  <div class="input-group" >
                    <div class="input-group-btn">
                        <a class=" btn btn-primary ">Part No.</a> 
                    </div>
                    <input type="text" name="s_pno" class="form-control" value="<?php echo $s_pno ?>">
                  </div>
                 </div>

                  <div class="col-md-3">
                             <div class="input-group" >
                         <div class="input-group-btn">
                              <a class=" btn btn-primary ">Drawing Name</a> 
                         </div>
                    <input type="text" class="form-control" name="s_name" value="<?php echo $s_name; ?>">
                   </div> 
                 </div>

                <div class="col-md-3">
                      <div class="input-group" >
                         <div class="input-group-btn">
                            <a class=" btn btn-primary ">Drawing No.</a> 
                         </div>
                            <input type="text" class="form-control" name="s_dno" value="<?php echo $s_dno; ?>">
                      </div>
                </div>
                  
                  <div class="col-md">
                  <button type="submit" class="btn btn-primary" "><i class="fa fa-search"></i></button>
                </div>
                </form>

                </div>
                <div class="card-body">
                <?php echo form_open('#', array('id' => 'frm_drawingmanagement', 'name'=>'frm_drawingmanagement', 'class'=>'form-horizontal'));?>

                <table id="demo-datatables-buttons-1" class="table table-hover  table-nowrap dataTable" cellspacing="0" width="100%">
                  <thead>
                  <tr>
								    	<td colspan="12">
                      <!-- <?php if($this->session->flashdata("chkall")!== null ) echo "<div id='btn_enable' class='btn  btn-success'><span class='fa fa-check'></span></div>
                        <div id='btn_disable' class='btn  btn-danger'><span class='fa fa-times'></span></div>
                        <div id='btn_delete' class='btn btn-default'><span class='fa fa-trash-o'></span></div>"; ?> -->
                        <?php if($this->session->flashdata("csv")!== null ){?>
                        <a class="btn btn-outline-primary" href='<?= base_url() ?>drawing/exportCSV'>Csv</a><?php } ?>
								    	</td>
								    </tr>	
                      <tr>
                        <th width="1%">
															<label>
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
												</th>
                        <th>Type</th>
                        <th>Part No</th>
                        <th>Drawing Name</th>
                        <th>Drawing No</th>
                        <th>MODEL</th>
                        <th>REMARK</th>
                        <th>POS</th>
                        <th>Customer</th>
                        <th>DCN</th>
                        <th>Rev</th>
                        <th>Manage</th>
                        <th>Status</th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php
                    foreach($result as $r){
                    echo "<tr>";
                    echo "<td >
                            <label>
                              <input type='checkbox' class='ace' name='d_id[]' value='$r->d_id' />
                              <span class='lbl'></span>
                            </label>
                          </td>";
                     ?>
                    <td><?php echo "<b>".$r->type_name."</b>" ?></td>
                    <?php  if($this->session->flashdata("link")!== null ){ 
                      echo "<td><a href='".base_url()."part/manage/".$r->p_id."'>$r->p_no</a></td>"; 
                    }
                    else{ 
                      echo "<td>$r->p_no</td>";
                       } ?>
                    <td><?php echo "<b>".$r->d_name."</b>" ?></td>
                    <td><?php echo "<b>".$r->d_no."</b>" ?></td>
                    <td><?php echo "<b>".$r->model."</b>" ?></td>
                    <td><?php echo "<b>".$r->remark."</b>" ?></td>
                    <td><?php echo "<b>".$r->pos."</b>" ?></td>
                    <td><?php echo "<b>".$r->cus_name."</b>" ?></td>
                    <?php  if($this->session->flashdata("link")!== null ){ 
                      echo "<td><a href='".base_url()."dcn/manage/".$r->dcn_id."'>$r->dcn_no</a></td>"; 
                    }
                    else{ 
                      echo "<td>$r->dcn_no</td>";
                       }  
                    if($this->session->flashdata("show_version")!== null){ echo "<td><a  href='".base_url()."drawing/show_v?d_id=".$r->d_id."'  >$r->rev</a></td>";
                     }else{
                       echo "<td class='text-center'>$r->rev</td>";
                     }    
                       echo "<td><div class='text-center'>";
                  if (file_exists("uploads/$r->foldergroup_name/$r->folder_name/$r->file_name"))echo " <a href='javascript:void(0)'  data-id='".$r->d_id."' class='view_img '><i class='btn-success no-border btn-sm fa fa-search'> </i></a>";
                  if($this->session->flashdata("download")!== null ) echo "<a href='".base_url()."drawing/openfile/".$r->d_id."'  ><i class='btn-info no-border fa fa-inbox'></i></a>";
                  if($this->session->flashdata("edit")!== null ) echo "<a  href='".base_url()."drawing/edit/".$r->d_id."'  ><i class='btn-info no-border fa fa-pencil-square-o'></i></a>";
                  if($this->session->flashdata("version")!== null ) echo "<a href='".base_url()."drawing/version_form/".$r->d_id."'  ><i class='btn-info no-border fa fa-plus'></i></a>";
                  if($this->session->flashdata("delete") !==null) echo "<a href='".base_url()."drawing/deletedrawing/".$r->d_id ."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border fa fa-trash'></i></a></td>";  
                  echo "<td class='text-center'>";
                  if($r->enable==1 ){  
                    $icon = "btn-success no-border fa fa-check";
                    $text = "ENABLE";
                    $color = "color:#43a047";
                    $toggle = "Disable"; 
                  }
                  else{ 
                    $icon = "btn-danger no-border fa fa-close";
                    $text = "DISABLE";
                    $color = "color:#D50000";
                    $toggle = "Enable"; 
                  }

                  if($this->session->flashdata("enable")!== null ){ echo "<a  href='".base_url()."drawing/enable/".$r->d_id ."' onclick='return confirm(\"Confirm $toggle Item\")'><i class='$icon'> $text</i></a>";}
                  else{ 
                    echo "<span style='$color'>$text </span>"; }
                    echo "</div></td>";
                    echo "</tr>";
                 }
              ?>
                  	<?php echo form_close();?>
            
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

      <script>
      $(document).ready(function() {
      $('body').on('click', '.view_img', function () {
      var id = $(this).data("id");

       $.ajax({
       type: "Post",
       url:'<?php echo base_url() ?>ajax/view_dwg_pdf',
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
      
      pdfjsLib.getDocument('<?php echo base_url()?>'+path).promise.then(function(pdfDoc_) {
      pdfDoc = pdfDoc_;


      // wmContext.fillText(res.text,-width/2,-height/6);
          document.getElementById('page_count').textContent = pdfDoc.numPages;
          document.getElementById('status').textContent = res.text;
 
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
</script>

<SCRIPT language="javascript">
$(function() {
  $('#select_all').on('change', function() {
    $('.child').prop('checked', this.checked);
  });
  $('.child').on('change', function() {
    $('#select_all').prop('checked', $('.child:checked').length===$('.child').length);
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
      
      $('#frm_drawingmanagement').attr('action', '<?php echo base_url().'drawing/enable/ea'; ?>');
      $('#frm_drawingmanagement').submit();
      
    }else{
      
      return false;
    }
    
       
    
    });
  
  $('#btn_disable').click(function(e) {
    
    if(confirm('คุณต้องการระงับรายการนี้ใช่หรือไม่')){
    
           $('#frm_drawingmanagement').attr('action', '<?php echo base_url().'drawing/enable/da'; ?>');
      $('#frm_drawingmanagement').submit();
    
    }else{
    
      return false;	
    }
    
    });
  
  $('#btn_delete').click(function(e) {
    
    if(confirm('คุณต้องการลบรายการใช้งานนี้ใช่หรือไม่')){
    
          $('#frm_drawingmanagement').attr('action', '<?php echo base_url().'drawing/deletedrawing/d'; ?>');
      $('#frm_drawingmanagement').submit();
    
    }else{
      
      return false;
    }
    
    });
    });

</SCRIPT>


<!-- <script>
$(document).ready(function() { 
  var str = <?php echo $folder ?>;

    for (i=0; i!=str.length;i++) {
        var checkbox = $("input[type='checkbox'][value='"+str[i]+"']");
        checkbox.attr("checked","checked");
    }

});
</script> -->
     



     