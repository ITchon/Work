<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
             ADD Relation
            </h2><hr>
            <form class="form form-horizontal container" action="<?php echo base_url()?>part_drawing/insert" method="post" data-toggle="validator">
            
           
    
                 
                  <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Part Name</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select name="p_id[]" class="form-control select2"  multiple="multiple" required>
                   <?php
                      foreach($part as $p){?>
             
                     <option value="<?php  echo $p->p_id ?>"><?php echo $p->p_name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div>

                    
                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Drawing Number</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select name="d_id[]" class="form-control select2"  multiple="multiple" required>

                   <?php
                      foreach($drawing as $d){?>
             
                     <option value="<?php  echo $d->d_id ?>"><?php echo $d->d_no ?></option>
                    <?php
                      }
                      ?> 
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

