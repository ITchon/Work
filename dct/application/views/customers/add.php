<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row gutter-xs">
            <div class="col-md-12">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary"><i class="fa fa-address-book"></i>
            ADD CUSTOMER
            </h2><hr>
              
            <form class="table form form-horizontal container" action="<?php echo base_url()?>customers/insert"  
              method="post" class="text-center" >

                 
                  <div class="form-group">
                    <label for="name-1" class="col-sm-3 col-md-4 control-label">CUSTOMER NAME</label>

                    <div class="col-sm-6 col-md-4">
                    <input class="form-control" type="text" name="cus_name" required>
                  </div>
                  </div>

                  <div class="form-group">
                    <label for="name-1" class="col-sm-3 col-md-4 control-label">CUSTOMER DESCRIPTION</label>

                    <div class="col-sm-12 col-md-4">
                      <textarea class="form-control" name="cus_des" rows="5" cols="50"></textarea>
                  </div>
                  </div>

          </div>
          <div class="form-group">
                    <button type="submit" id="btn" class="btn btn-primary btn-block ">Save Changes</button>
                  </div>
                </form>
              </div>
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

