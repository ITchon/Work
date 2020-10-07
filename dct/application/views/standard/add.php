<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
             ADD STANDARD
            </h2><hr>
            <?php echo $this->session->flashdata("success"); ?>
            <form class="table form form-horizontal container" action="<?php echo base_url()?>standard/insert" method="post" data-toggle="validator" enctype="multipart/form-data">
            <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">SELECT CUSTOMER </label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select name="cus_id" id="cus_id" class="form-control select2"  data-placeholder=""  required>
                    <option></option>
                    <optgroup style="" data-head='head'>
                     
              
                   <?php
                      foreach($result_cus as $cus){?>
             
                     <option value="<?php  echo $cus->cus_id ?>"><?php echo $cus->cus_name?></option>

                    <?php
                      }
                      ?> 
                       </optgroup>
                   </select>
                    </div>
                    </div> 

                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">STANDARD NUMBER</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <input type="text" class="form-control" name="std_no">
                    </div>
                    </div> 
        
                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">STANDARD NAME</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <input type="text" class="form-control" name="std_name">
                    </div>
                    </div> 


                  <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">SELECT FOLDER</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select name="f_id" id="child" class="form-control select2" required>
          
                   </optgroup>
                   </select>
                    </div>
                    </div> 

                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">CUSTOMER REV</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <input type="text" class="form-control" name="cus_rev">
                    </div>
                    </div> 

                    <div class="form-group">
                    <label for="name-1" class="col-sm-3 col-md-4 control-label">FILE</label>

                    <div class="col-sm-6 col-md-4">
                    <input class="form-control" id="file_name" type="file" name="file_name" required>
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
      </div>
      <script>
        $(document).ready(function() {
          
        $('.select2').select2({
         templateResult: function(data) {
          var r = data.text.split('|');
          var $result = $(
            '<div class="row">' +
                '<div class="col-md-6">' + r[0] + '</div>' +
            '</div>'
        );
        return $result;
    }
}); 
    $('#cus_id').change(function(){
  var cus_id = $('#cus_id').val();
  if(cus_id != '')
  {

   $.ajax({
    url:"<?php echo base_url(); ?>ajax/fetch_folder",
    method:"POST",
    data:{cus_id:cus_id},
    success:function(data)
    {
      console.log(data);
     $('#child').html(data);

    }
   });
  }
});

    // var x = <?php echo $this->session->userdata('sug_id')?>;
    // document.getElementById('bom').value=2;
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

