<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
             EDIT TYPE
            </h2><hr>
            <form class="table form form-horizontal container" action="<?php echo base_url()?>folder/save_edit" method="post" data-toggle="validator">
            
            <div class="form-group has-feedback">
                    <label for="fol" class="col-sm-5 col-md-4 control-label">FOLDER GROUP</label>    

                <div class="col-sm-5 col-md-4">
                   <select id="select" name="fg_id" class="form-control select2"  required>
                   <option value="" hidden> - - - Select FOLDER- - - </option>
                   <?php
                   
                      foreach($result_folg as $fg){?>
                     <option value="<?php  echo $fg->fg_id ?>"><?php echo $fg->foldergroup_name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div>
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Type name</label>
                    <div class="col-sm-6 col-md-4">
                      <input type="text" name="f_id" value="<?php echo $result[0]->f_id?>" hidden>
                    <input class="form-control" type="text" name="type_name" value="<?php echo $result[0]->name ?>">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Folder Name</label>
                    <div class="col-sm-6 col-md-4">
                      <input class="form-control" name="fol_name" value="<?php echo $result[0]->folder_name ?>">
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
       document.getElementById('select').value = "<?php echo $result[0]->fg_id ?>";
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

