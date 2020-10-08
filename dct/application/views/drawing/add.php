
<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="demo-form-wrapper card" style="padding-top:8px;">
              <h2 class=" text-center text-primary"><i class="fa fa-leanpub" aria-hidden="true"></i>
             ADD DRAWING
            </h2><hr>

                <?php echo $this->session->flashdata("success"); ?>
                           
                <form name="form1" method="post" class="table form form-horizontal containe" action="<?php echo base_url()?>drawing/upload" enctype="multipart/form-data">
                <?php $d_no = $this->session->flashdata('d_no'); ?>
                <?php $p_no = $this->session->flashdata('p_no'); ?>

                    <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">DRAWING NUMBER</label>
                    <div class="col-sm-5 col-md-4">
                    <input id="d_no" class="form-control" required type="text" value="<?php echo $d_no ?>" name="d_no">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                  </div>

                  <div class="form-group has-feedback">
                    <label for="p_name" class="col-sm-3 col-md-4 control-label">DRAWING NAME</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="d_name" class="form-control" type="text" name="d_name">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="p_name" class="col-sm-3 col-md-4 control-label">MODEL</label>
                    <div class="col-sm-6 col-md-4">
                    <input class="form-control" type="text" name="model">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="p_name" class="col-sm-3 col-md-4 control-label">REMARK</label>
                    <div class="col-sm-6 col-md-4">
                    <input class="form-control" type="text" name="remark">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="p_name" class="col-sm-3 col-md-4 control-label">POS NUMBER</label>
                    <div class="col-sm-6 col-md-4">
                    <input type="text" name="pos" style="width:120px;" class="form-control">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>


                <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">DCN NUMBER</label>    

                <div class="col-sm-5 col-md-4">
                   <select name="dcn_id" class="form-control select2" id="dcn_id">
                   <option value="" >- - - None - - - </option>
                   <?php
                   
                      foreach($result_dcn as $dcn){?>
                     <option value="<?php  echo $dcn->dcn_id ?>"><?php echo $dcn->dcn_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">CUSTOMERS</label>    

                <div class="col-sm-5 col-md-4">
                   <select name="cus_id" class="form-control select2" id="dcn_id" >
                   <option value="" hidden> - - - None - - - </option>
                   <?php
                   
                      foreach($result_cus as $cus){?>
                     <option value="<?php  echo $cus->cus_id ?>"><?php echo $cus->cus_name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                </div>

                <div class="form-group">
                      <label for="email-2" class="col-sm-5 col-md-4 control-label">FILE</label>  
                      <div class="col-sm-6 col-md-4">
                          <input type="file" name="file_name" class="form-control" id="file_name" onchange="file()" required> 
                   </div>
                    </div>

                <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">TYPE</label>    

                <div class="col-sm-5 col-md-4">
                   <select name="f_id" class="form-control select2"  required>
                   <option value="" hidden> - - - None - - - </option>
                   <?php
                   
                      foreach($result_folder as $t){?>
                     <option value="<?php  echo $t->f_id ?>"><?php echo $t->name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div>

                    <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">ADD PART</label>    

                <div class="col-sm-5 col-md-4">
                   <select name="p_id[]" class="form-control select2" id="dcn_id" multiple="multiple" required>
                   <option value="" hidden> - - - None - - - </option>
                   <?php
                   
                      foreach($result_p as $p){?>
                     <option value="<?php  echo $p->p_id ?>"><?php echo $p->p_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                   <button class="btn btn-outline-primary" type="button" id="add">Add NEW PART</button>
                    <button type="button" class="btn btn-outline-danger btn_remove hidden">Remove</button><br>
                      <div id="dynamic_field"></div>
                    </div>
                  </div>


            </div>
                  <div class="form-group">
                    <button type="submit" id="btn" class="btn btn-primary btn-block">Save Changes</button>
                  </div>
                </form>
                </div>
                
      <script>
//       function file() {
//   var x = document.getElementById("file_name").value;
//   var file = x.split("\\");
//   var fileName = file[file.length-1];
//  var url='<?php echo base_url() ?>uploads/A_TYPE-drawing/'+fileName;
//    console.log(fileName);
//    $.get(url)
//     .done(function() { 
//       alert('File already exist!');
//     }).fail(function() { 
//         // not exists code
//     })
 
// };
        $(document).ready(function() {
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

