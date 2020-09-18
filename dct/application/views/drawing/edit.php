<style>
tr{
  color:#495057;
  font-size:16px; 
  font-weight: bold;
  background-color: white;
  
}

.hidden {
  display: none;
}

</style>
<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
             EDIT DRAWING
            </h2><hr>
            <?php echo $this->session->flashdata("success"); ?>
            <?php $d_no = $this->session->flashdata('d_no'); ?>
            <?php $p_no = $this->session->flashdata('p_no'); ?>
            
<form name="form1" method="post" class="table form form-horizontal containe" action="<?php echo base_url()?>drawing/save_edit" enctype="multipart/form-data">
<input hidden type="text" name="search" value="<?php echo $search ?>" >
<input hidden type="text" name="fold" value="<?php echo $result->f_id ?>" >
<?php $search =  $this->session->flashdata('search');
$this->session->set_flashdata('search',$search);
?>
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Drawing Number</label>
                    <div class="col-sm-6 col-md-4">
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
                    <option value="">- - -NONE- - -</option>
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
                    <option value="">- - -NONE- - -</option>
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

                <input class="form-control" type="text" name="file_name2" readonly value="<?php echo $result->file_name ?>">
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
                              <input type="file" name="file_name" class="form-control" id="file_name" >
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
                 
                    <table class="table table-bordered text-center" >
                      <thead>
     
                    </thead>

                      <tbody id="part_drawing">


                      </tbody>
                    </table>
                    
                    <button class="btn btn-outline-primary " type="button" id="add">Add NEW PART</button>
                  
                  <button type="button" class="btn btn-outline-danger btn_remove hidden" >Remove</button>
                          
                    <div id="dynamic_field"></div>
                  
                      </div>
                    </div>
                      
                  </div>

           
                  <div class="form-group" style="paddig-bottom:20px">
                    <button type="submit" id="btn" class="btn btn-primary btn-block">Save Changes</button>
                  </div>
                </form>
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
<script>
    $(document).ready(function() {
      var d_id = <?php echo $this->uri->segment('3')?>;
       $.ajax({
        url:"<?php echo base_url(); ?>ajax/fetch_part_drw",
        method:"POST",
        data:{d_id:d_id},
        success:function(data)
        {
          console.log(data);
         $('#part_drawing').html(data);
        
        },
        error:function(data){
          console.log(data);
        }
      });
    $(document).on('click', '.delete', function() {
      var r = confirm("Confirm delete?");
      if (r == true) {
    		var $ele = $(this).parent().parent();//?????
        var id = $(this).attr("data-id");
    		$.ajax({
    			url: "<?php echo base_url("ajax/delete_part_drw");?>",
    			type: "POST",
    			cache: false,
    			data:{
    				id: id
    			},
    			success: function(data){
    				var data = JSON.parse(data);
    				if(data.statusCode==200){// what is this????
    					$ele.fadeOut().remove();
    				}
    			},
          error:function(data){
            console.log("error");
          }
    		});
      } 
    });
   });
</script>
 

