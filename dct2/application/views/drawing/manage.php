<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
         Drawing
  
    </h2><hr>
            
            <form class="table form form-horizontal container" action="<?php echo base_url()?>drawing/show" method="post">
            <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select Drawing</label>      
          
                    <div class="col-sm-6 col-md-4">
                    <div class="input-group" >
                    <input type="hidden" name="name" value="Drawing">
                    <select name="id" class="form-control select2" required>
                    <option value="">- - - Select Drawing - - -</option>
                   <?php
                      foreach($result_d as $r){?>
             
                     <option value="<?php echo $r->d_id ?>"><?php echo $r->d_no ?></option>
                     <?php
                      }
                      ?> 
                   </select>
                          <div class="input-group-btn">    
                       <button type="submit" id="btn" class="btn btn-primary btn-block">SEARCH</button>
                      </form>
                      </div>
                    </div>
                   </div> 
                </div> 
      
           

                <form class="table form form-horizontal container" action="<?php echo base_url()?>drawing/show" method="post">
            <div class="form-group">
                    <label for="email-2" class="col-sm-3 col-md-4 control-label">Select Part</label>      
                    <div class="col-sm-6 col-md-4">
                    <div class="input-group" >
                    <input type="hidden" name="name" value="Part">
                   <select name="id" class="form-control select2" required>
                   <option value="">- - - Select Part - - -</option>
                   <?php
                      foreach($result_p as $r){?>
             
                     <option value="<?php echo $r->p_id ?>"><?php echo $r->p_no ?></option>
                     <?php
                      }
                      ?> 
                   </select>
                   <div class="input-group-btn">    
                       <button type="submit" id="btn" class="btn btn-primary btn-block">SEARCH</button>
                      </form>
                      </div>
                    </div>
                   </div> 
                </div> 

                <form class="table form form-horizontal container" action="<?php echo base_url()?>drawing/show" method="post">
            <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select DCN</label>      
                      <div class="col-sm-6 col-md-4">
                      <div class="input-group" >
                      <input type="hidden" name="name" value="DCN">
                      <select name="id" class="form-control select2" required>
                      <option value="">- - - Select DCN - - -</option>
                      <?php
                      foreach($result_dcn as $r){?>            
                     <option value="<?php echo $r->dcn_id ?>"><?php echo $r->dcn_no ?></option>
                       <?php
                      }
                      ?> 
                   </select>
                   <div class="input-group-btn">    
                       <button type="submit" id="btn" class="btn btn-primary btn-block">SEARCH</button>
                      </form>
                      </div>
                    </div>
                   </div> 
                </div> 

                    </div>
                    
                  
                
                
                </div>

   
   
      <script>
        $(document).ready(function() {
          $('.select2').select2();
          });
          if(performance.navigation.type == 2){
             location.reload(true);
          }
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