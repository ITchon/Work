<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       

          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary"><i class="fa fa-clipboard" aria-hidden="true"></i>
             ADD DCN
            </h2><hr>
            <?php echo $this->session->flashdata("success"); ?>
           <form name="form1" method="post" class="table form form-horizontal containe" action="<?php echo base_url()?>dcn/upload" enctype="multipart/form-data">
              <?php $dcn_no = $this->session->flashdata('dcn_no'); ?>
              <?php $dcn_name = $this->session->flashdata('dcn_name'); ?>

                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">DCN Number</label>
                    <div class="col-sm-6 col-md-4">

                  <input id="part" class="form-control " type="text" name="dcn_no" value="<?php echo $dcn_no ?>" required>

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">DCN Name</label>
                    <div class="col-sm-6 col-md-4">

                  <input id="part" class="form-control " type="text" name="dcn_name"  value="" >

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Model</label>
                    <div class="col-sm-6 col-md-4">

                  <input class="form-control " type="text" name="model"  value="">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>


                    <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">Customer</label>  
                    <div class="col-sm-5 col-md-4">
                   <select name="cus_id" class="form-control select2" >
                   <option value="" hidden> - - - Select Customer- - - </option>
                   <?php
                   
                      foreach($result_cus as $cus){?>
                     <option value="<?php  echo $cus->cus_id ?>"><?php echo $cus->cus_name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                  </div>


                 <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">TYPE</label>  
                    <div class="col-sm-5 col-md-4">
                   <select name="f_id" class="form-control select2"  required>
                   <option value="" hidden> - - - Select TYPE- - - </option>
                   <?php
                   
                      foreach($result_folder as $t){?>
                     <option value="<?php  echo $t->f_id ?>"><?php echo $t->name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                  </div>

                      <div class="form-group">
                      <label for="email-2" class="col-sm-5 col-md-4 control-label">File</label>  
                      <div class="col-sm-6 col-md-4">
                          <input type="file" name="file_name" class="form-control" id="file_name" required>
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

