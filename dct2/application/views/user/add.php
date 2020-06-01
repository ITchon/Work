<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card"><br> 
              <h2 class=" text-center text-primary">
             Add User
            </h2><hr>
            <form class="form form-horizontal container" action="<?php echo base_url()?>user/insert" method="post" data-toggle="validator">
                  <?php echo $this->session->flashdata("error"); ?>
                <div class="form-group has-feedback">
                    <label for="username" class="col-sm-3 col-md-2 control-label">Username</label>
                    <div class="col-sm-6 col-md-8">
                    <input id="username" class="form-control" type="text" autocomplete="off" name="username" placeholder="Username" required>
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="password" class="col-sm-3 col-md-2 control-label">Password</label>
                    <div class="col-sm-6 col-md-8">
                    <input id="password" class="form-control" type="password" autocomplete="off" name="password" placeholder="Password" required>
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
    
                  <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-2 control-label">Select</label>      
          
                      <div class="col-sm-6 col-md-2">
                   <select name="gender" class="form-control select2" >
                   <option value="">- - - - - -</option>
                       <option value="Male">Male</option>
                       <option value="Female">Female</option>
                   </select>
                    </div>
                    </div>
                    <div class="form-group has-feedback">
                    <label for="password" class="col-sm-3 col-md-2 control-label">Firstname</label>
                    <div class="col-sm-6 col-md-3">
                    <input id="firstname" class="form-control" type="text" autocomplete="off" name="fname"  placeholder="Firstname" required>
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                    <div class="form-group has-feedback">
                    <label for="Lastname" class="col-sm-3 col-md-2 control-label">Lastname</label>
                    <div class="col-sm-6 col-md-3">
                    <input id="Lastname" class="form-control" type="text" autocomplete="off" name="lname"  placeholder="Lastname" required>
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                    <div class="form-group has-feedback">
                    <label for="Email" class="col-sm-3 col-md-2 control-label">Email</label>
                    <div class="col-sm-6 col-md-8">
                    <input id="Email" class="form-control" type="email" autocomplete="off" name="email"  placeholder="Email" required>
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-2 control-label">Select Group</label>      
          
                      <div class="col-sm-6 col-md-2">
                   <select name="sug_id" class="form-control select2" id="" required>
                   <option value="" hidden>- - - - - -</option>
                    <?php foreach ($excLoadG as $r) {
                        ?>
                       <option value="<?php echo $r->sug_id ?>"><?php echo $r->name ?></option>
                  <?php
                   } ?>
                   </select>
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

