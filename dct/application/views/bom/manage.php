<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary">    
         <i class="fa fa-sitemap" aria-hidden="true"></i>
         BOM
    </h2><hr>
        
            <form class="table form form-horizontal " action="<?php echo base_url()?>bom/manage" method="post" data-toggle="validator">
            <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">Select BOM</label>      
          
                      <div class="col-sm-6 col-md-4">
                      <div class="input-group" >
                   <select name="bm" id="selectSubstance" class="form-control select2"  data-placeholder="" required>
                   <option></option>
                   <optgroup  label='P/NO|DWG/NO' style="" data-head='head'>
              
                   <?php
                      foreach($result as $r){?>
            
                     <option value="<?php  echo $r->b_id ?>"><?php echo "P/NO ".$r->p_no." | DWG ".$r->d_no?></option>

                    <?php
                      }
                      ?> 
                      </optgroup>
                   </select>
                    <div class="input-group-btn"> 
                    <button type="submit" id="btn" class="btn btn-primary btn-block">SEARCH</button>
                  </div>
                  </div>
                    </div> 
                    </div>
                   
            
                  
                </form>
                
              </div>
            </div>
          </div>
         
        </div>
      </div>
      <script>
        $(document).ready(function() {
          $('#selectSubstance').select2({
    
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

