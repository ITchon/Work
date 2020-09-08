
     
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
          
                  <h3>MANAGE PART <i class="fa fa-cogs" aria-hidden="true"></i></h3>

                </div>
                <div class="card-body">
                <?php echo form_open('#', array('id' => 'frm_usermanagement', 'name'=>'frm_usermanagement', 'class'=>'form-horizontal'));?>
                <table id="demo-datatables-buttons-1" class="table  table-hover table-bordered dataTable" cellspacing="0" width="100%">
                  <thead>
                  <tr>
								    	<td colspan="12">
                        <div id="btn_enable" class="btn  btn-success"><span class="fa fa-check"></span></div>
									    	<div id="btn_disable" class="btn  btn-danger"><span class="fa fa-times"></span></div>
									    	<div id="btn_delete" class="btn btn-default"><span class="fa fa-trash-o"></span></div>
								    	</td>
								    </tr>	
                    <tr>
                    <th  width="1%" >
															<label>
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th>
                      <th width="10%">Part No</th>
                      <th width="10%">Part Name</th>
                      <th class="no_print" width="10%">Manage</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($result as $r){
                echo "<tr>";
                echo "<td >
                <label>
                  <input type='checkbox' class='ace' name='chk_uid[]' value='$r->p_id'/>
                  <span class='lbl'></span>
                </label>
                </td>";
                echo "<td>".$r->p_no."</td>";
                echo "<td>".$r->p_name."</td>";
                
                if($r->enable!=1 ){?>
                  
                  <td class="text-center"><a type="button"  onclick="javascript:window.location='<?php
                  echo base_url() . 'part/enable/' . $r->p_id;
                  ?>';"><i class='btn-danger btn-sm no-border fa fa-times'></i></a>
                  <?php
                }
                else{?>

                  <td class="text-center"><a type="button"  onclick="javascript:window.location='<?php
                  echo base_url() . 'part/disable/' . $r->p_id;
                  ?>';"><i class='btn-success btn-sm no-border fa fa-check'></i></a>                      
                  <?php
                }
                ?> <a type ='button' class=' ' onclick="javascript:window.location='<?php
                echo base_url() . 'part/edit_part/' . $r->p_id;
                ?>';"><i class='btn-info btn-sm no-border fa fa-pencil-square-o'> </i> </a>
                <?php 
                echo "<a type='button' href='".base_url()."part/deletepart/".$r->p_id."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border btn-sm fa fa-trash'></i></a></td>";  

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

      
      <script type="text/javascript">
      

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

    
