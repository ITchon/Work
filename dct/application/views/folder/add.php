<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row gutter-xs">
            <div class="col-md-12">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary"><i class="fa fa-folder-open" aria-hidden="true"></i>
            ADD TYPE
            </h2><hr>
              
            <form class="table form form-horizontal container" action="<?php echo base_url()?>folder/insert"  method="post" class="text-center" >


            <div class="form-group has-feedback">
                    <label for="fol" class="col-sm-5 col-md-4 control-label">FOLDER GROUP</label>    

                <div class="col-sm-5 col-md-4">
                   <select name="fg_id" class="form-control select2"  required>
                   <option value="" hidden> - - - Select FOLDER- - - </option>
                   <?php
                   
                      foreach($result_folg as $fg){?>
                     <option value="<?php  echo $fg->fg_id ?>"><?php echo $fg->name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div>
                 
                  <div class="form-group">
                    <label for="name-1" class="col-sm-3 col-md-4 control-label">TYPE NAME</label>
                    <div class="col-sm-6 col-md-4">
                    <input class="form-control" type="text" name="type_name" required>
                  </div>
                  </div>

                  <div class="form-group">
                    <label for="name-1" class="col-sm-3 col-md-4 control-label">FOLDER NAME</label>

                    <div class="col-sm-6 col-md-4">
                    <input class="form-control" type="text" name="fol_name" required>
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

