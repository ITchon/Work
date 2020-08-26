<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
             EDIT DRAWING
            </h2><hr>
            <?php $search =  $this->session->flashdata('search');
              $this->session->set_flashdata('search',$search);
              ?>
            
<form name="form1" method="post" class="table form form-horizontal containe" action="<?php echo base_url()?>drawing/save_edit_v" enctype="multipart/form-data">
<input hidden type="text" name="fold" value="<?php echo $result->f_id ?>" >
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Drawing Number</label>
                    <div class="col-sm-6 col-md-4">
                    <input hidden type="text" name="v_id" value="<?php echo $result->v_id ?>" >
                    <input hidden type="text" name="d_id" value="<?php echo $result->d_id ?>" >
                    <input id="part" class="form-control " type="text" name="d_no" value="<?php echo $result->d_no ?>">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="p_name" class="col-sm-3 col-md-4 control-label">Drawing Name</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="d_name" class="form-control" type="text" name="d_name" value="<?php echo $result->d_name ?>">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="p_name" class="col-sm-3 col-md-4 control-label">POS NUMBER</label>
                    <div class="col-sm-6 col-md-4">
                    <input type="text" name="pos" style="width:120px;" class="form-control" value="<?php echo $result->pos ?>">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select DCN</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select id="dcn" name="dcn_id" class="form-control select2" >
                   <?php
                      foreach($result_dcn as $rg){?>
             
                     <option value="<?php  echo $rg->dcn_id ?>"><?php echo $rg->dcn_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div> 

                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select Customer</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select id="cus" name="cus_id" class="form-control select2" >
                   <?php
                      foreach($result_cus as $rg){?>
             
                     <option value="<?php  echo $rg->cus_id ?>"><?php echo $rg->cus_name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div> 

                                        <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">File</label>      
                      <div class="col-sm-6 col-md-4">
                        <?php if($result->file_name == null){ ?>
                <input class="form-control" type="text" readonly value="Please add file">
                <input class="form-control" type="hidden" name="path" value="<?php echo $result->path_file ?>">
                       <?php  }else { ?>
                <input class="form-control" type="text" readonly value="<?php echo $result->file_name ?>">
                <input class="form-control" type="hidden" name="path" value="<?php echo $result->path_file ?>">
                   <?php } ?>
                    </div>
                    </div> 

                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select Type</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select id="f" name="f_id" class="form-control select2" >
                   <?php
                      foreach($result_folder as $f){?>
                     <option value="<?php  echo $f->f_id ?>"><?php echo $f->name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div> 

                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Change File</label>  
                      <div class="col-sm-6 col-md-4">
                        <?php if($result->file_name){ ?>
                              <input type="text" name="file_name2" id="file_name2" value="<?php echo $result->file_name ?>" hidden>
                            <input type="hidden" name="file_code" id="file_code" hidden value="<?php echo $result->file_code ?>" class="form-control">
                              <input type="file" name="file_name" class="form-control" id="file_name" >
                      <?php }else{ ?>
                          <input type="file" name="file_name" class="form-control" id="file_name" required>

                      <?php } ?>

                   </div>
                    </div>

                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Version</label>      
                      <div class="col-sm-6 col-md-4">
                   <input class="form-control" type="text" readonly value="<?php echo $result->version ?>">
                   <input class="form-control" type="hidden" name="code" value="<?php echo $result->file_code ?>">

                    </div>
                    </div> 

                
                    <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">ADD PART</label>    

                <div class="col-sm-5 col-md-4">
                   <select name="p_id[]" class="form-control select2" id="dcn_id" multiple="multiple">
                   <option value="" hidden> - - - Select PART- - - </option>
                   <?php
                   
                      foreach($result_p as $p){?>
                     <option value="<?php  echo $p->p_id ?>"><?php echo $p->p_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                 
                      <button class="btn btn-outline-primary " type="button" id="add">Add NEW PART</button>
                      <div></div>
                    <button type="button" class="btn btn-outline-danger btn_remove hidden">Remove</button><br>
                      <div id="dynamic_field"></div>
                      
                     

                      <table class="table text-center">
                      <thead>
                      <tr>
                      
                      </tr>
                      </thead>

                      <?php 
                      foreach($result_pd as $r){ ?>
                      
                      <tbody>
                      <td style='text-align:center;'>
                 <label class='pos-rel'>
                     <input type='checkbox' name='chk_uid[]' value='<?php echo $r->pd_id ?>'/>
                     <span class='lbl'></span>
                   </label>
               </td>
                      <td><?php echo $r->p_no ?></td>
                  <?php
                      }
                       ?>
                       <?php if($result_pd != null){ ?>
                       <input type="button" class="btn btn-danger" id="toggle" value="delete all" onClick="do_this()" />
                       <?php } ?>
                      </tbody>
                      </table>
                      </div>
                    </div>
                      
                  </div>


                  <div class="form-group">
                    <button type="submit" id="btn" class="btn btn-primary btn-block">Save Changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
         
        </div>
      </div>
      <script>
      function do_this(){

var checkboxes = document.getElementsByName('chk_uid[]');
var button = document.getElementById('toggle');

if(button.value == 'delete all'){
    for (var i in checkboxes){
        checkboxes[i].checked = 'FALSE';
    }
    button.value = 'undelete all'
}else{
    for (var i in checkboxes){
        checkboxes[i].checked = '';
    }
    button.value = 'delete all';
}
}
        $(document).ready(function() {
document.getElementById('f').value = "<?php echo $result->f_id ?>";
document.getElementById('dcn').value = "<?php echo $result->dcn_id ?>";
document.getElementById('cus').value = "<?php echo $result->cus_id ?>";
    $('.select2').select2();
});
      </script>

<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>

<script>
$(document).ready(function() {
  var i = 1;
  $('#add').click(function() {
    if (i <= 5) {
      $('#dynamic_field').append('<div id="row' + i + '"><label>Part No</label><input type="text" class="form-control" name="p_no[]" value="" required><br><label>Part Name</label><input type="text" class="form-control" name="p_name[]" value="" required><br><hr style="height:2px;border-width:0;color:gray;background-color:gray"></div>')
      //$('#dynamic_field').append('<div id="row' + i + '"><label for="email-2">Part No (' + i + ')</label><input type="text" class="form-control" name="p_no[]" value=""></div></div><div class="form-group"><label class="col-sm-3 col-md-4 control-label">Part Name (' + i + ')</label><div class="col-sm-6 col-md-4"><input type="text" class="form-control" name="p_name[]" value=""></div></div><br><hr style="height:2px;border-width:0;color:gray;background-color:red"></div>')
      i++;
      $('.btn_remove').removeClass('hidden');
    }
  });
  $(document).on('click', '.btn_remove', function() {
    var button_id = $(this).attr("id");
    i--;
    $('#row' + $('#dynamic_field div').length).remove();
    if (i<=1) {
      $('.btn_remove').addClass('hidden');
    }
  });
});
</script>
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script type="text/javascript">
    $("#form").submit(function(){
        $.ajax({
           url: "<?php echo base_url(); ?>user/insert",
           type: 'POST',
           data: $("#form").serialize(),
           success: function() {
            alert('Success');
           }
        });


    });


</script> -->

