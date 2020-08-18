<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
        <?php  

          ?>
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
             EDIT BOM
             <?php echo anchor(base_url().'bom/manage/'.$bm.'', 'Back',array('class'=>'btn btn-default ')); ?>
            </h2><hr>
            <form class="form form-horizontal container" action="<?php echo base_url()."bom/insert_edit_bom/$bm"?>" method="post" data-toggle="validator">
            <input type="hidden" name="m_id" value="<?php echo $m_id ?>">
            <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Main Part</label>      
                      <div class="col-sm-6 col-md-4">
                      <input type="text" class="form-control" name="p_no" value="<?php echo $result[0]->p_no ?>" readonly>
                    </div>
                    </div> 
            <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Quantity</label>      
                      <div class="col-sm-6 col-md-2">
                      <input type="number" class="form-control" name="quantity" value="<?php echo $result[0]->quantity ?>" >
                    </div>
                    </div> 
            <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Unit</label>      
                      <div class="col-sm-6 col-md-1">
                      <input type="text" class="form-control" name="unit" value="<?php echo $result[0]->unit ?>" >
                      </div>
                      </div> 
            <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Common Part</label>      
                      <div class="col-sm-6 col-md-4">
                      <input type="text" class="form-control" name="common_part" value="<?php echo $result[0]->common_part  ?>" >
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

