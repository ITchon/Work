<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row gutter-xs">
            <div class="col-md-12">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
            ADD PERMISSION
            </h2><hr>
              
            <form class="table form form-horizontal container" action="<?php echo base_url()?>permission/insert" method="post" data-toggle="validator">
                 
                  <div class="form-group">
                    <br>
                    <label for="name-1" class="col-sm-3 col-md-4 control-label">Permission Name</label>
                    <div class="col-sm-6 col-md-4">
                    <input  class="form-control" type="text" name="gname" required>
                  </div>
                  </div>

                  <div class="form-group">
                    <label for="name-1" class="col-sm-3 col-md-4 control-label">Controller</label>
                    <div class="col-sm-6 col-md-4">
                    <input  class="form-control" type="text" name="controller" required>
                  </div>
                  </div>

                  
                    <label for="name-1" class="col-sm-3 col-md-4 control-label">Controller</label>
                    <div class="col-sm-6 col-md-3">
                  <select name="spg_id" id="" class="form-control select2" required>
             <option value="" hidden >Select Group</option>
                  <?php 
              foreach($excLoadG as $r){?>
             
               <option value="<?php  echo $r->spg_id ?>"><?php echo $r->name ?></option>
               <?php
            }
       ?>     
          </select><br><br>
          </div>

                  
              </div>
              <div class="form-group">
                    <button type="submit" id="btn" class="btn btn-primary form-control ">Save Changes</button>
                  </div>
                  
                </form>
            </div>
          </div>
         
        </div>
      </div>
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script>
        $(document).ready(function() {
    $('.select2').select2();
});
      </script>

      <!--<script type="text/javascript">
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

