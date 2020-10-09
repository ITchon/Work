<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12  ">
              <div class="demo-form-wrapper card" style="padding-top:8px">
              <h2 class=" text-center text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
             EDIT STANDARD
            </h2><hr>
            <form class="table form form-horizontal container" action="<?php echo base_url()?>standard/save_edit_v" method="post" data-toggle="validator" enctype="multipart/form-data">
            
                      <input type="hidden" name="rs_id" value="<?php echo $result->rs_id?>" >
                      <input type="hidden" id="chkf" name="fold" value="<?php echo $result->f_id?>" >
                      <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">SELECT CUSTOMER </label>      
          
                      <div class="col-sm-6 col-md-4">
                   <select name="cus_name" id="cus_name" class="form-control select2"  data-placeholder=""  required>
                   <option value=" " >- - - None - - - </option>
                   <?php
                      foreach($result_cus as $cus){?>
             
                     <option value="<?php  echo $cus->cus_name ?>"><?php echo $cus->cus_name?></option>

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
                   <input type="text" class="form-control" name="std_no" value="<?php echo $result->std_no ?>">
                    </div>
                    </div> 
        
                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">STANDARD NAME</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <input type="text" class="form-control" name="std_name" value="<?php echo $result->std_name ?>">
                    </div>
                    </div> 

                    <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">DCN NUMBER</label>    
                <div class="col-sm-5 col-md-4">
                   <select name="dcn_no" class="form-control select2" id="dcn">
                   <option value="" >- - - None - - - </option>
                   <?php
                   
                      foreach($result_dcn as $dcn){?>
                     <option value="<?php  echo $dcn->dcn_no ?>"><?php echo $dcn->dcn_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                </div>
 
                    
                    <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">FOLDER</label>    

                <div class="col-sm-5 col-md-4">
                   <select name="f_id" class="form-control select2" id="f_id" required>
                   <option value="" >- - - None - - - </option>
                   <?php
                   
                      foreach($result_fol as $fol){?>
                     <option value="<?php  echo $fol->f_id ?>"><?php echo $fol->name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                </div>

                    <div class="form-group">
                      <label for="email-2" class="col-sm-3 col-md-4 control-label">CUSTOMER REV</label>      
          
                      <div class="col-sm-6 col-md-4">
                   <input type="text" class="form-control" name="cus_rev" value="<?php echo $result->cus_rev ?>">
                    </div>
                    </div> 

                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">FILE</label>
                    <div class="col-sm-6 col-md-4">
                      <input type="text" readonly class="form-control" name="file_name2" value="<?php echo $result->file_name ?>">
                    </span>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">CHANGE FILE</label>
                    <div class="col-sm-6 col-md-4">
                      <input type="file" id="file_name" class="form-control" name="file_name" value="<?php echo $result->file_name ?>">
                    </span>
                    </div>
                </div>

                <div class="form-group">
                   <label for="email-2" class="col-sm-3 col-md-4 control-label">VERSION</label>      
                   <div class="col-sm-6 col-md-4">
                   <input class="form-control" type="text" name="version" readonly value="<?php echo $result->rev?>" >
                               
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
            document.getElementById('cus_name').value = "<?php echo $result->cus_name ?>";
            document.getElementById('f_id').value = "<?php echo $result->f_id ?>";
            document.getElementById('dcn').value = "<?php echo $result->dcn_no ?>";

});
      </script>

      <script>
        $(document).ready(function() {
          
        $('.select2').select2({
         templateResult: function(data) {
          var r = data.text.split('|');
          var $result = $(
            '<div class="row">' +
                '<div class="col-md-6">' + r + '</div>' +
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

