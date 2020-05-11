<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
             ADD PART
            </h2><hr>
            <form class="form form-horizontal container" action="<?php echo base_url()?>part/insert" method="post" data-toggle="validator">
            
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Part Number</label>
                    <div class="col-sm-6 col-md-4">

                    <input id="part" class="form-control " type="text" name="p_no" placeholder="Part Number" required>

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="p_name" class="col-sm-3 col-md-4 control-label">Part Name</label>
                    <div class="col-sm-6 col-md-5">
                    <input id="p_name" class="form-control" type="text" name="p_name" placeholder="Part Name" required>
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
    
                  <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Drawing Number</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select name="d_id[]" class="form-control select2" multiple="multiple" required>
                   <?php
                      foreach($result_d as $r){?>
             
                     <option value="<?php  echo $r->d_id ?>"><?php echo $r->d_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div>
                    <div class="form-group has-feedback">
                    <label for="password" class="col-sm-3 col-md-4 control-label">DCN</label>
                    <div class="col-sm-6 col-md-3">
                    <input id="password" class="form-control" type="text" name="dcn"  placeholder="DCN" required>
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
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

