<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px"><br> 
              <h2 class=" text-center text-primary">
             Change Password
            </h2><hr>

            <form class="table form form-horizontal container" action="<?php echo base_url()?>changepassword/changed_pass" method="post" data-toggle="validator">
            <?php echo $this->session->flashdata("error"); ?>
	              <div class="form-group has-feedback">
	                    <label for="Username" class="col-sm-3 col-md-4 control-label">Username</label>
	                    <div class="col-sm-6 col-md-4">
	                    <input id="Username" class="form-control" type="text" autocomplete="off" name="Username" value="<?php echo $result[0]->username ?>" readonly>
	                    <span class="form-control-feedback" aria-hidden="true">
	                    <span class="icon"></span>
	                    </span>
	                    </div>
	                </div>

                   <div class="form-group has-feedback">
                      <label for="password" class="col-sm-3 col-md-4 control-label">Current Password</label>
                      <div class="col-sm-6 col-md-4">
                      <input id="password" class="form-control" type="password" autocomplete="off" name="cur_password"  />
                      <span class="form-control-feedback" aria-hidden="true">
                      <span class="icon"></span>
                      </span>
                      </div>
                  </div>

                   <div class="form-group has-feedback">
                      <label for="password" class="col-sm-3 col-md-4 control-label">New Password</label>
                      <div class="col-sm-6 col-md-4">
                      <input id="password" class="form-control" type="password" autocomplete="off" name="new_password"  required />
                      <span class="form-control-feedback" aria-hidden="true">
                      <span class="icon"></span>
                      </span>
                      </div>
                  </div>

                   <div class="form-group has-feedback">
                      <label for="password" class="col-sm-3 col-md-4 control-label">Confirm New Password</label>
                      <div class="col-sm-6 col-md-4">
                      <input id="password" class="form-control" type="password" autocomplete="off" name="con_password"  required />
                      <span class="form-control-feedback" aria-hidden="true">
                      <span class="icon"></span>
                      </span>
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
   
      <script type="text/javascript">

</script> -->

