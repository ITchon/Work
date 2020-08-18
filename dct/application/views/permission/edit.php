<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
             EDIT PERMISSION
            </h2><hr>
            <form class="table form form-horizontal container" action="<?php echo base_url()?>permission/save_edit" method="post" data-toggle="validator">
            
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Permission Name</label>
                    <div class="col-sm-6 col-md-4">
                      <input type="text" name="sp_id" value="<?php echo $result[0]->sp_id?>" hidden>
                    <input id="sp_name" class="form-control " type="text" name="sp_name" value="<?php echo $result[0]->sp_name ?>">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-3 col-md-4 control-label">Permission Group</label>
                    <div class="col-sm-6 col-md-3">
                    <input type="text" name="spg_id" value="<?php echo $result[0]->spg_name?>" hidden>
                    <select name="spg_id" id="" class="form-control select2" required>
             <option value="<?php echo $result[0]->spg_id ?>" hidden> <?php echo $result[0]->spg_name ?> </option>
                  <?php 
              foreach($result_g as $r){?>
               <option value="<?php  echo $r->spg_id ?>"><?php echo $r->name ?></option>
               <?php
            }
       ?>     
          </select><br>
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

