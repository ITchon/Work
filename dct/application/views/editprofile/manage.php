<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card"><br> 
              <h2 class=" text-center text-primary">
             Edit Profile
            </h2><hr>

            <form class="table form form-horizontal container" action="<?php echo base_url()?>editprofile/updated_profile" method="post" data-toggle="validator">
            <?php echo $this->session->flashdata("success"); ?>
            			<?php echo form_hidden('su_id',$result[0]->su_id);  ?>
	              <div class="form-group has-feedback">
	                    <label for="password" class="col-sm-3 col-md-4 control-label">Firstname</label>
	                    <div class="col-sm-6 col-md-4">
	                    <input id="password" class="form-control" type="text" autocomplete="off" name="fname" value="<?php echo $result[0]->firstname ?>" required>
	                    <span class="form-control-feedback" aria-hidden="true">
	                    <span class="icon"></span>
	                    </span>
	                    </div>
	                </div>
	                    <div class="form-group has-feedback">
	                    <label for="Lastname" class="col-sm-3 col-md-4 control-label">Lastname</label>
	                    <div class="col-sm-6 col-md-4">
	                    <input id="Lastname" class="form-control" type="text" autocomplete="off" name="lname"  value="<?php echo $result[0]->lastname ?>" required>
	                    <span class="form-control-feedback" aria-hidden="true">
	                    <span class="icon"></span>
	                    </span>
	                    </div>
	                </div>

                  <div class="form-group has-feedback">
                    <label for="Email" class="col-sm-3 col-md-4 control-label">Email</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="Email" class="form-control" type="email" autocomplete="off" name="email"  value="<?php echo $result[0]->email ?>" required>
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
    
                  <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select</label>      
          
                      <div class="col-sm-6 col-md-3">
                   <select id="select" name="gender" class="form-control select2" required >
                      <option value="male">male</option>
                      <option value="female">female</option>
                       
                   </select>
                    </div>
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

      <script>
        <?php if($result[0]->gender == null){
        } ?>
      document.getElementById('select').value = "<?php echo $result[0]->gender ?>";
</script>

