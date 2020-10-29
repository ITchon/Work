
     
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
                <?php
                $search = $this->session->flashdata('search');
                $this->session->set_flashdata('search',$search);
                ?>

                  <form name="search" action="<?php echo base_url()?>part/manage" method="get">
                <br>
                <div class="col-md-3">
                      <div class="input-group" >
                         <div class="input-group-btn">
                            <a class=" btn btn-primary ">Part No.</a>
                         </div>
                            <input type="text" class="form-control" name="s_pno" value="<?php echo $s_pno; ?>">
                      </div>
                </div>

                  <div class="col-md-3">
                        <div class="input-group" >
                         <div class="input-group-btn">
                              <a class=" btn btn-primary ">Part Name</a> 
                         </div>
                    <input type="text" class="form-control" name="s_pname" value="<?php echo $s_pname; ?>">
                   </div> 
                 </div>
                  
                  <div class="col-md">
                  <button type="submit" class="btn btn-primary" "><i class="fa fa-search"></i></button>
                </div>
                </form>
                </div>
                <div class="card-body">
                <?php echo form_open('#', array('id' => 'frm_usermanagement', 'name'=>'frm_usermanagement', 'class'=>'form-horizontal'));?>
                <table id="demo-datatables-buttons-1" class="table  table-hover table-bordered dataTable" cellspacing="0" width="100%">
                  <thead>
                  <tr>
								    	<td colspan="12">
                        <!-- <?php if($this->session->flashdata("chkall")!== null ) echo "<div id='btn_enable' class='btn  btn-success'><span class='fa fa-check'></span></div>
                        <div id='btn_disable' class='btn  btn-danger'><span class='fa fa-times'></span></div>
                        <div id='btn_delete' class='btn btn-default'><span class='fa fa-trash-o'></span></div>"; ?> -->
                        <?php if($this->session->flashdata("csv")!== null ){?>
                        <a class="btn btn-outline-primary" href='<?= base_url() ?>part/exportCSV'>Csv</a><?php } ?>                      </td>
								    </tr>	
                    <tr>
                    <th width="3%" class="text-center" >
															<label class="pos-rel">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th>
                      <th>Part No</th>
                      <th>Part Name</th>
                      <?php foreach($type as $t){ ?>
                      <th><?php echo $t->name ?></th><?php } ?> 
                      <th>Manage</th>
                      <th>Status</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    if(isset($result_p)){
                    foreach($result_p as $r){
                echo "<tr>";
                echo "<td >
                <label>
                  <input type='checkbox' class='ace' name='chk_uid[]' value='$r->p_id'/>
                  <span class='lbl'></span>
                </label>
                </td>";
                echo "<td>".$r->p_no."</td>";
                echo "<td>".$r->p_name."</td>";
                echo "<td>"." "."</td>";
                echo "<td>"." "."</td>";
                echo "<td>"." "."</td>";
                echo "<td>"." "."</td>";
                
                echo "<td class='text-center'>";
                if($this->session->flashdata("edit")!== null )
                 echo "<a  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>แก้ไขข้อมูล</h5>' data-original-title='Rule' href='".base_url()."part/edit_part/".$r->p_id."'  ><i class='btn-info no-border fa fa-pencil-square-o'></i></a>"; 
                
                 if($this->session->flashdata("delete") !==null)
                  echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."part/deletepart/".$r->p_id ."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border fa fa-trash'></i></a>";  
                echo "</div></td>";
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
                      if($this->session->flashdata("enable")!== null ){ echo "<a  href='".base_url()."part/enable/".$r->p_id ."' onclick='return confirm(\"Confirm $toggle Item\")'><i class='$icon'> $text</i></a></td>";}
                      else{ echo "<span style='$color'>$text </span></td>"; }

            echo "</tr>";
                    }
                  }
                  if(isset($result)){
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
                foreach($type as $t){
                  if($r->f_id == $t->f_id){
                    $chk_dwg = $r->d_no;
                    if($this->session->flashdata("link")!== null ){ 
                      echo "<td><a href='".base_url()."drawing/show/".$r->d_id."'>$chk_dwg</a></td>"; 
                    }
                    else{ 
                      echo "<td>$chk_dwg</td>";
                       } 
                  }else{
                    $chk_dwg = '';
                     if($this->session->flashdata("link")!== null ){ 
                      echo "<td><a href='".base_url()."drawing/show/".$r->d_id."'>$chk_dwg</a></td>"; 
                    }
                    else{ 
                      echo "<td>$chk_dwg</td>";
                       } 
                  }
                }
                echo "<td class='text-center'>";
                if($this->session->flashdata("edit")!== null )
                 echo "<a  data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>แก้ไขข้อมูล</h5>' data-original-title='Rule' href='".base_url()."part/edit_part/".$r->p_id."'  ><i class='btn-info no-border fa fa-pencil-square-o'></i></a>"; 
                
                 if($this->session->flashdata("delete") !==null)
                  echo "<a type='button' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' href='".base_url()."part/deletepart/".$r->p_id ."' onclick='return confirm(\"Confirm Delete Item\")' ><i class='btn-default no-border fa fa-trash'></i></a>";  
                echo "</div></td>";
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
                      if($this->session->flashdata("enable")!== null ){ echo "<a  href='".base_url()."part/enable/".$r->p_id ."' onclick='return confirm(\"Confirm $toggle Item\")'><i class='$icon'> $text</i></a></td>";}
                      else{ echo "<span style='$color'>$text </span></td>"; }

            echo "</tr>";
        }
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

    
