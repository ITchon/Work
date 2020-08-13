<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="demo-form-wrapper card" style="padding-top:8px;">
            <h2 class=" text-center text-primary">
            EDIT USER
            </h2><hr>
            <form class="table form form-horizontal container" action="<?php echo base_url()?>user/save_edit" method="post" data-toggle="validator">
            
                <input type="text" name="su_id" value="<?php echo $result[0]->su_id ?>" hidden>
                <div class="form-group has-feedback">
                    <label for="username" class="col-sm-3 col-md-4 control-label">Username</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="username" class="form-control" type="text" autocomplete="off" name="username" value="<?php echo $result[0]->username?>">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="password" class="col-sm-3 col-md-4 control-label">Password</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="password" class="form-control" type="password" autocomplete="off" name="password" value="<?php echo $result[0]->password?>">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
    
                  <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select</label>      
          
                      <div class="col-sm-6 col-md-3">
                   <select name="gender" class="form-control select2"  >
                   <option value="<?php echo $result_gen[0]->gender ?>"><?php echo $result[0]->gender ?></option>
                   <option value="male"><?php echo $result[0]->gender ?></option>
                   <option value="female"><?php echo $result[0]->gender ?></option>
                   </select>
                    </div>
                    </div>
                    <div class="form-group has-feedback">
                    <label for="password" class="col-sm-3 col-md-4 control-label">Firstname</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="firstname" class="form-control" type="text" autocomplete="off" name="fname"  value="<?php echo $result[0]->firstname?>">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                    <div class="form-group has-feedback">
                    <label for="Lastname" class="col-sm-3 col-md-4 control-label">Lastname</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="Lastname" class="form-control" type="text" autocomplete="off" name="lname"  value="<?php echo $result[0]->lastname?>">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                    <div class="form-group has-feedback">
                    <label for="Email" class="col-sm-3 col-md-4 control-label">Email</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="Email" class="form-control" type="email" autocomplete="off" name="email"  value="<?php echo $result[0]->email?>">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select Group</label>      
          
                      <div class="col-sm-6 col-md-3">
                   <select name="sug_id" class="form-control select2"  required>
                   <option value="<?php echo $result[0]->sug_id ?>"><?php echo $result[0]->name ?></option>
                    <?php foreach ($excLoadG as $r) {
                        ?>
                       <option value="<?php echo $r->sug_id ?>"><?php echo $r->name ?></option>
                  <?php
                   } ?>
                   </select>
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

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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

