<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
             EDIT DCN
            </h2><hr>
            <?php echo $this->session->flashdata("success"); ?>
          
            <form class="form form-horizontal container" action="<?php echo base_url()?>dcn/save_edit_dcn" method="post" >
            


                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">DCN Number</label>
                    <div class="col-sm-6 col-md-4">
                    <input type="text" name="dcn_id" value="<?php echo $result[0]->dcn_id ?>" hidden>
                    <input id="part" class="form-control " type="text" name="dcn_no" value="<?php echo $result[0]->dcn_no ?>">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Path File</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="part" class="form-control " type="text" name="path_file" value="<?php echo $result[0]->path_file ?>">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Old File</label>
                    <div class="col-sm-6 col-md-5">
                    <input id="part" class="form-control" readonly type="text" name="file_name_old" value="<?php echo $result[0]->file_name ?> ">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">New File</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="part" class="form-control " type="file" name="file_name" value="<?php echo $result[0]->file_name ?>">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>



                
                    </div>
                   
            
                  <div class="form-group">
                <br>
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
