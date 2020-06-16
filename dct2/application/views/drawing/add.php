<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="demo-form-wrapper card" style="padding-top:8px;">
              <h2 class=" text-center text-primary">
             ADD DRAWING
            </h2><hr>

               <form class="table form form-horizontal container" action="<?php echo base_url()?>drawing/insert" method="post" data-toggle="validator">

                    <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Drawing No</label>
                    <div class="col-sm-5 col-md-4">
                    <input id="d_no" class="form-control " type="text" name="d_no" placeholder="Drawing No">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                  </div>


                <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">DCN Number</label>    

                <div class="col-sm-5 col-md-4">
                   <select name="dcn_id" class="form-control select2" id="dcn_id"  required>
                   <option value="" hidden> - - - Select DCN- - - </option>
                   <?php
                   
                      foreach($result_dcn as $dcn){?>
                     <option value="<?php  echo $dcn->dcn_id ?>"><?php echo $dcn->dcn_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                </div>

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
                    <label for="p_name" class="col-sm-5 col-md-4 control-label">Part Name</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="p_name" class="form-control" type="text" name="p_name" placeholder="Part Name" required>
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Path File</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="path" class="form-control " type="text" name="path" placeholder="Path File">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                  </div>
                    

                    <div class="form-group">
                      <label for="email-2" class="col-sm-5 col-md-4 control-label">File</label>  
                      <div class="col-sm-6 col-md-4">
                          <input type="file" name="file_name" class="form-control" id="file_name" required>
                   </div>
                    </div>

            </div>
                  <div class="form-group">
                    <button type="submit" id="btn" class="btn btn-primary btn-block">Save Changes</button>
                  </div>
                </form>
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

