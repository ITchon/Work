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
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">DCN Number</label>    

        <div class="col-sm-6 col-md-4">
                   <select name="dcn_id" class="col-sm-5 col-md-4 control-label form-control select2" id="dcn_id"  required>
                   <option value="<?php echo $result[0]->dcn_no ?>" hidden> <?php echo $result[0]->dcn_no ?> </option>
                   <?php
                      foreach($result_dcn as $dcn){?>
                     <option value="<?php  echo $dcn->dcn_id ?>"><?php echo $dcn->dcn_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                </div>
                <input type="text" name="version" value="<?php echo $result[0]->version?>" hidden>
    
                  

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
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">File</label>      
                      <div class="col-sm-6 col-md-4">
                        <?php if($result[0]->file == null){ ?>
                        <input class="form-control" type="text" readonly value="Please add file">
                       <?php  }else { ?>
                   <input class="form-control" type="text" readonly value="<?php echo $result[0]->file ?>">
                   <?php } ?>
                    </div>
                    </div> 

                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Change File</label>  
                      <div class="col-sm-6 col-md-4">
                        <?php if($result[0]->file){ ?>
                              <input type="text" name="file_name" id="file_name" value="<?php echo $result[0]->file ?>" hidden>
                              <input type="file" name="file_name2" class="form-control" id="file_name2">         
                      <?php }else{ ?>
                          <input type="file" name="file_name" class="form-control" id="file_name" required>

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

