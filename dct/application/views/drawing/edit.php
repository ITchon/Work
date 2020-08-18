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
            <?php $d_no = $this->session->flashdata('d_no'); ?>
            <?php $p_no = $this->session->flashdata('p_no'); ?>
            
<form name="form1" method="post" class="table form form-horizontal containe" action="<?php echo base_url()?>drawing/save_edit" enctype="multipart/form-data">
<input hidden type="text" name="search" value="<?php echo $search ?>" >
<input hidden type="text" name="tfold" value="<?php echo $result->tf_id ?>" >
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
                   <select id="tf" name="tf_id" class="form-control select2" >
                   <?php
                      foreach($result_type as $tf){?>
                     <option value="<?php  echo $tf->tf_id ?>"><?php echo $tf->tf_name ?></option>
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
            </div>
                  <div class="form-group">
                    <button type="submit" id="btn" class="btn btn-primary btn-block">Save Changes</button>
                  </div>
                </form>
                </div>
                
      <script>
        $(document).ready(function() {
document.getElementById('tf').value = "<?php echo $result->tf_id ?>";
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

