<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
         Part
         <i class="fa fa-cogs" aria-hidden="true"></i>
    </h2><hr>
            
            <form class="table form form-horizontal container" action="<?php echo base_url()?>part/manage" method="post" data-toggle="validator">
            <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select Part</label>      
          
                      <div class="col-sm-6 col-md-4">
                    <input type="hidden" name="name" value="Part">
                   <select name="p_id" class="form-control select2"  required>
                   <option value="">- - - Select Part - - -</option>
                   <?php
                      foreach($result as $r){?>
             
                     <option value="<?php  echo $r->p_id ?>"><?php echo $r->p_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div> 

                
                    </div>
                   
            
                  <div class="form-group">
                  <br>
                    <button type="submit" id="btn" class="btn btn-primary btn-block">SEARCH</button>
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

