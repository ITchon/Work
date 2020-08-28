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
          
            <form class="form form-horizontal container" action="<?php echo base_url()?>dcn/save_edit_dcn" method="post" >
            

                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">DCN Number</label>
                    <div class="col-sm-6 col-md-4">
                    <input type="text" name="dcn_id" value="<?php echo $result->dcn_id ?>" hidden>
                    <input type="text" name="fold" value="<?php echo $result->f_id ?>" hidden>
                    <input id="part" class="form-control " type="text" name="dcn_no" value="<?php echo $result->dcn_no ?>">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select Type</label>      
          
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
            </div>
          </div>
         
        </div>
      </div>
      <script>
        $(document).ready(function() {
        document.getElementById('f').value = "<?php echo $result->f_id ?>";
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

