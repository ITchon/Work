<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
         BOM////
             <a href="<?php echo base_url()?>part/show">BOOM</a>
    </h2><hr>
            
            <form class="form form-horizontal container" action="<?php echo base_url()?>bom/manage" method="post" data-toggle="validator">
            <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select Bom Master</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select name="bm" class="form-control select2"  required>
                   <option value="">- - - Select Part Master - - -</option>
                   <?php
                      foreach($result as $r){?>
                        <?php  echo $r->p_id ?>
             
                     <option value="<?php  echo $r->p_id ?>"><?php echo $r->p_name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div> 

                
                    </div>
                   
            
                  <div class="form-group">
                <br>
                    <button type="submit" id="btn" class="btn btn-primary btn-block">BOOOOOOM!</button>
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

