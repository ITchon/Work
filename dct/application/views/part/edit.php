<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
             EDIT PART
            </h2><hr>
            
            
              <?php if(isset($gg)){ ?>
                <form class="form form-horizontal container" action="<?php echo base_url()?>part/save_editb" method="post" data-toggle="validator">
                <input type="text" name="bom" value="<?php echo $gg ?>"hidden >
                <input type="text" name="p_id" value="<?php echo $result[0]->p_id ?>" hidden>
              <?php }else{ ?>
                <form class="form form-horizontal container" action="<?php echo base_url()?>part/save_edit" method="post" data-toggle="validator">
              <input type="text" name="p_id" value="<?php echo $result[0]->p_id ?>" hidden>
              <?php } ?>
            

                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Part Number</label>
                    <div class="col-sm-6 col-md-4">
                    <input type="text" name="p_id " value="<?php echo $result[0]->p_id ?>"hidden>
                    <input id="part" class="form-control " type="text" name="p_no" value="<?php echo $result[0]->p_no ?>">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="p_name" class="col-sm-3 col-md-4 control-label">Part Name</label>
                    <div class="col-sm-6 col-md-5">
                    <input id="p_name" class="form-control" type="text" name="p_name" value="<?php echo $result[0]->p_name ?>">
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

