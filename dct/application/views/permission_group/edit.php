<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
             EDIT PERMISSION GROUP
            </h2><hr>
            <form class="table form form-horizontal container" action="<?php echo base_url()?>permissiongroup/save_edit" method="post" data-toggle="validator">
            
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Permission_Group Name</label>
                    <div class="col-sm-6 col-md-4">
                      <input type="text" name="spg_id" value="<?php echo $result[0]->spg_id?>" hidden>
                    <input id="spg_name" class="form-control " type="text" name="spg_name" value="<?php echo $result[0]->spg_name ?>">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
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

