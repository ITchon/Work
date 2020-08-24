<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       

          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
             ADD PART
              <?php  
               $bm = $this->uri->segment('3');
              if(isset($bm)){
                echo '<a class="btn btn-default" href="javascript:window.history.go(-1);">Back</a>';
              }else{
                 echo '<a class="btn btn-default" href="'.base_url().'part/manage">Back</a>';
              }
              ?>
            
            </h2><hr>
            <?php echo $this->session->flashdata("success"); ?>
            <form class="table form form-horizontal container" action="<?php echo base_url()?>part/insert" method="post" data-toggle="validator">
              <?php $p_no = $this->session->flashdata('p_no'); ?>

                <input type="hidden" name="bm" value="<?php echo $bm ?>">
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Part Number</label>
                    <div class="col-sm-6 col-md-4">

                    <input id="part" class="form-control" value="<?php echo $p_no ?>" type="text" name="p_no" required>

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="p_name" class="col-sm-5 col-md-4 control-label">Part Name</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="p_name" class="form-control" type="text" name="p_name" required>
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

