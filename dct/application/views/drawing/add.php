
<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
       
           
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="demo-form-wrapper card" style="padding-top:8px;">
              <h2 class=" text-center text-primary">
             ADD DRAWING
            </h2><hr>

                <?php echo $this->session->flashdata("success"); ?>
                           
                <form name="form1" method="post" class="table form form-horizontal containe" action="<?php echo base_url()?>drawing/upload" enctype="multipart/form-data">
                <?php $d_no = $this->session->flashdata('d_no'); ?>
                <?php $p_no = $this->session->flashdata('p_no'); ?>

                    <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Drawing No</label>
                    <div class="col-sm-5 col-md-4">
                    <input id="d_no" class="form-control" required type="text" value="<?php echo $d_no ?>" name="d_no">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                  </div>

                  <div class="form-group has-feedback">
                    <label for="p_name" class="col-sm-3 col-md-4 control-label">Drawing Name</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="d_name" class="form-control" type="text" name="d_name">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>


                <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">DCN Number</label>    

                <div class="col-sm-5 col-md-4">
                   <select name="dcn_id" class="form-control select2" id="dcn_id"  required>
                   <option value="" hidden> - - - Select DCN- - - </option>
                   <?php
                   
                      foreach($result_dcn as $dcn){?>
                     <option value="<?php  echo $dcn->dcn_id ?>"><?php echo $dcn->dcn_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">CUSTOMERS</label>    

                <div class="col-sm-5 col-md-4">
                   <select name="cus_id" class="form-control select2" id="dcn_id" >
                   <option value="" hidden> - - - Select CUSTOMERS- - - </option>
                   <?php
                   
                      foreach($result_cus as $cus){?>
                     <option value="<?php  echo $cus->cus_id ?>"><?php echo $cus->cus_name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                </div>

                <div class="form-group">
                      <label for="email-2" class="col-sm-5 col-md-4 control-label">File</label>  
                      <div class="col-sm-6 col-md-4">
                          <input type="file" name="file_name" class="form-control" id="file_name" required>
                   </div>
                    </div>

                <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">TYPE</label>    

                <div class="col-sm-5 col-md-4">
                   <select name="tf_id" class="form-control select2"  required>
                   <option value="" hidden> - - - Select TYPE- - - </option>
                   <?php
                   
                      foreach($result_type as $t){?>
                     <option value="<?php  echo $t->tf_id ?>"><?php echo $t->tf_name ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>
                    </div>

                    <div class="form-group has-feedback">
                    <label for="dcn" class="col-sm-5 col-md-4 control-label">PART</label>    

                <div class="col-sm-5 col-md-4">
                   <select name="p_id" class="form-control select2" id="dcn_id" multiple="multiple">
                   <option value="" hidden> - - - Select PART- - - </option>
                   <?php
                   
                      foreach($result_p as $p){?>
                     <option value="<?php  echo $p->p_id ?>"><?php echo $p->p_no ?></option>
                    <?php
                      }
                      ?> 
                   </select>
                    </div>

               


                    <div class="col-sm-6 col-md-2">
                    <a class="btn btn-outline-primary" onclick="myFunction()"><b>เพิ่ม Part</b></a> 
 </div>
                  </div>
                  




                  <div id="myDIV" style="display: none;">
                  
                 
                <div class="form-group has-feedback">
                    <label for="part" class="col-sm-5 col-md-4 control-label">Part Number</label>

                    <div class="col-sm-6 col-md-4">

                    <input id="part" class="form-control" value="<?php echo $p_no ?>" type="text" name="p_no" placeholder="Part Number">

                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="p_name" class="col-sm-5 col-md-4 control-label">Part Name</label>
                    <div class="col-sm-6 col-md-4">
                    <input id="p_name" class="form-control" type="text" name="p_name" placeholder="Part Name">
                    <span class="form-control-feedback" aria-hidden="true">
                    <span class="icon"></span>
                    </span>
                    </div>
                </div>

                </div>

                    

                    


            </div>
                  <div class="form-group">
                    <button type="submit" id="btn" class="btn btn-primary btn-block">Save Changes</button>
                  </div>
                </form>
                </div>
                
      <script>
        $(document).ready(function() {
    $('.select2').select2();

});
      </script>

<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>

