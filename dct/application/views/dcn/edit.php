<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
             EDIT DCN
            </h2><hr>
            <?php echo $this->session->flashdata("success"); ?>
          
            <form class="form form-horizontal container" action="<?php echo base_url()?>dcn/save_edit_dcn" method="post" enctype="multipart/form-data">
          
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">DCN Number</label>
                    <div class="col-sm-6 col-md-4">
                    <input type="text" name="dcn_id" value="<?php echo $result->dcn_id ?>" hidden>
                    <input type="text" name="chk" value="<?php echo $chk ?>" hidden >
                    <input type="text" name="fold" value="<?php echo $result->f_id ?>" hidden>
                    <input id="part" class="form-control " type="text" name="dcn_no" value="<?php echo $result->dcn_no ?>">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">DCN Number</label>
                    <div class="col-sm-6 col-md-4">
                    <input class="form-control " type="text" name="dcn_name" value="<?php echo $result->dcn_name ?>">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>


                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Model</label>
                    <div class="col-sm-6 col-md-4">
                    <input class="form-control " type="text" name="model" value="<?php echo $result->model ?>">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>


                <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Customer</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select id="cus" name="cus_id" class="form-control select2" >
                    <option value="" hidden> - - - None- - - </option>
                   <?php
                      foreach($result_cus as $cus){?>
                     <option value="<?php echo $cus->cus_id ?>"><?php echo $cus->cus_name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div> 



                <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Type</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select id="f" name="f_id" class="form-control select2" >
                   <?php
                      foreach($result_folder as $f){?>
                     <option value="<?php echo $f->f_id ?>"><?php echo $f->name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div> 

                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">File</label>      
                      <div class="col-sm-6 col-md-4">
                <input class="form-control" readonly name="file_name2" type="text" value="<?php echo $result->file_name ?>">
                    </div>
                    </div> 
                <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Change File</label>  
                      <div class="col-sm-6 col-md-4">
                      <input type="file" name="file_name" class="form-control" id="file_name" >

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
        $(document).ready(function() {
        document.getElementById('f').value = "<?php echo $result->f_id ?>";
        document.getElementById('cus').value = "<?php echo $result->cus_id ?>";
    $('.select2').select2();
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

