<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
             ADD VERSION
            </h2><hr>
            <form class="form form-horizontal container" action="<?php echo base_url()?>drawing/update_v" method="post" data-toggle="validator">
            
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Drawing No</label>
                    <div class="col-sm-6 col-md-4">
                      <input type="text" name="d_id" value="<?php echo $result[0]->d_id?>" hidden>
                    <input id="d_no" class="form-control " type="text" name="d_no" placeholder="Drawing No"  value="<?php echo $result[0]->d_no ?>">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-3 col-md-4 control-label">DCN</label>
                    <div class="col-sm-6 col-md-5">
                    <input type="text" name="dcn_id" value="<?php echo $result[0]->dcn_id?>" hidden>
                    <input id="dcn" class="form-control" type="text" placeholder="DCN"  value="<?php echo $result[0]->dcn_no ?>">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <input type="text" name="version" value="<?php echo $result[0]->version?>" hidden>
    
                  <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">File</label>      
                      <div class="col-sm-6 col-md-4">
                   <input class="form-control" type="text"  value="<?php echo $result[0]->file ?>">
                    </div>
                    </div> 

                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Version</label>      
                      <div class="col-sm-6 col-md-4">
                   <input class="form-control" type="text" readonly value="<?php echo $result[0]->version ?>">

                    </div>
                    </div> 

                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Status</label>  
                      <div class="col-sm-6 col-md-4">
                   <?php 
                   foreach ($result as $r) {
                     if($r->enable!=1 ){?>
                 <b><font color="red">
                 <label class="control-label">disable</label> 
                 </font></b>
                  <?php
                }
                else{?>
                  <b><font color="lightgreen">
                 <label class="control-label">active</label> 
                 </font></b>
                  <?php
                   }
                }
                ?>
                   </div>
                    </div> 
                    

                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Change</label>  
                      <div class="col-sm-6 col-md-4">
                        <?php if($result[0]->file){ ?>
                          <input type="text" name="file_name" value="<?php echo $result[0]->file ?>">
                   <input type="file" name="file_name" class="form-control" id="file_name" value="<?php echo $result[0]->file ?>">
                      <?php }else{ ?>
                          <input type="file" name="file_name" class="form-control" id="file_name">

                      <?php } ?>

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

