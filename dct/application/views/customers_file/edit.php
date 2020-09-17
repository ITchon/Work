<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
             EDIT CUSTOMERS FILE
            </h2><hr>
            <form class="table form form-horizontal container" action="<?php echo base_url()?>customersfile/save_edit" method="post" data-toggle="validator" enctype="multipart/form-data">
            
                      <input type="hidden" name="cusf_id" value="<?php echo $result[0]->cusf_id?>" >
                      <input type="hidden" id="chkf" name="fold" value="<?php echo $result[0]->f_id?>" >
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
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">SELECT FOLDER</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select name="f_id" id="child" class="form-control select2" required>
          
                   </optgroup>
                   </select>
                    </div>
                    </div> 

                      <div class="form-group has-feedback">
                          <label for="part" class="col-sm-5 col-md-4 control-label">CUSTOMER DESCRIPTION</label>
                          <div class="col-sm-6 col-md-4">
                            <textarea class="form-control" name="cus_des" rows="5" cols="50"><?php echo $result[0]->cusf_des ?></textarea>
                          </span>
                          </div>
                      </div>

                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">CUSTOMER FILE</label>
                    <div class="col-sm-6 col-md-4">
                      <input type="text" readonly class="form-control" name="file_name2" value="<?php echo $result[0]->file_name ?>">
                    </span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">NEW FILE</label>
                    <div class="col-sm-6 col-md-4">
                      <input type="file" id="file_name" class="form-control" name="file_name" value="<?php echo $result[0]->file_name ?>">
                    </span>
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
      </div>
      <script>
        $(document).ready(function() {
            document.getElementById('cus_id').value = "<?php echo $result[0]->cus_id ?>";
                document.getElementById('f_id').value = "<?php echo $result[0]->f_id ?>";

});
      </script>

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

  var cus_id = $('#cus_id').val();
  var chkf = $('#chkf').val();
  if(cus_id != '')
  {

   $.ajax({
    url:"<?php echo base_url(); ?>ajax/fetch_folder",
    method:"POST",
    data:{cus_id:cus_id,chkf:chkf},
    success:function(data)
    {
      console.log(data);
     $('#child').html(data);

    }
   });
  }


    // var x = <?php echo $this->session->userdata('sug_id')?>;
    // document.getElementById('bom').value=2;
});
      </script>
            <script>
        $(document).ready(function() {
            $('#cus_id').change(function(){
  var cus_id = $('#cus_id').val();
  var chkf = $('#chkf').val();
  if(cus_id != '')
  {

   $.ajax({
    url:"<?php echo base_url(); ?>ajax/fetch_folder",
    method:"POST",
    data:{cus_id:cus_id,chkf:chkf},
    success:function(data)
    {
      console.log(data);
     $('#child').html(data);

    }
   });
  }
});

});
      </script>

