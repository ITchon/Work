<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
        <?php  

          ?>
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">
             ADD SUB PART
             <?php echo anchor(base_url().'bom/manage/'.$bm.'', 'Back',array('class'=>'btn btn-default ')); ?>
            </h2><hr>
            <form class="form form-horizontal container " action="<?php echo base_url()."part/insert_bom_sub"?>" method="post" data-toggle="validator">
            <input type="hidden" name="b_master" value="<?php echo $p_id ?>">
            <input type="hidden" name="bm" value="<?php echo $bm ?>">
            <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Main Part</label>      
          
                      <div class="col-sm-6 col-md-4">
                      <input type="text" class="form-control " style="" name="" value="<?php echo $p_no ?>" readonly>
                    </div>
                    </div> 
                  <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select Secondary Part</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select name="p_id[]" class="form-control select2" multiple="multiple" required>
                   <optgroup  label='P/NO|DWG/NO' style="" data-head='head'>

                   <?php
                        $genres = array();
                        foreach($res_chk as $sg){ 
                           $genres[] = $sg['parent_id'];
                        }
                        $genres[] = $p_id;
                      foreach($result_p as $r){ 
                        if (!in_array($r->p_id,$genres)) {?>
                          <option value="<?php  echo $r->pd_id ?>"><?php echo $r->p_no." | ".$r->d_no ?></option>
                          
                        <?php
                        }
                      }
                      ?> 
                      </option>
                   </select>
                    </div>
            <?php echo anchor(base_url().'part/add/'.$bm.'', 'Create Part',array('class'=>'btn btn-primary'));        ?>
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
      </div>
      <script>
        $(document).ready(function() {
          $('.select2').select2({
         templateResult: function(data) {
        var r = data.text.split('|');
        var $result = $(
            '<div class="row">' +
                '<div class="col-md-6">' + r[0] + '</div>' +
                '<div class="col-md-6">' + r[1] + '</div>' +
            '</div>'
           );
         return $result;
         }
        }); 
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

