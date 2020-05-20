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
                   <select  name="name" value="eiei" class="form-control select2" val  required>
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


<!-- <?php 
foreach($result as $row){
  foreach($row as $r){
    }
  }
    $maxlv = (max(array($r['lv']))); 
  ?>
  
   -->
  <div class="layout-content">
          <div class="layout-content-body">
            <div class="title-bar">
              <h1 class="title-bar-title">
          
  
              </h1>
              <p class="title-bar-description">
              </p>
            </div>
  
            <div class="row gutter-xs">
            <div class="col-xs-7">
                <div class="card">
                  <div class="card-header">
  
                    <h3>Bom Table</h3>
                    <small>The tables presented below use <a href="https://datatables.net/extensions/responsive/" target="_blank">DataTables Responsive Extension</a>, the styling of which is completely rewritten in SASS, without modifying however anything in JavaScript.</small>
  
                  </div>
                  <div class="card-body">
  <table id="demo-datatables-buttons-1" class="table table-bordered dataTable" cellspacing="0" width="100%">
                    <thead>
  
             
                        <tr>
                        <?php for($i=1;$i<=$maxlv;$i++) { ?>
                          <th width="5%">lv <?php echo $i ?></th>
                      <?php } ?>
                          <th width="">Id</th>
                         
                        </tr>
                      </thead>
                      <tbody>
  
                      <?php 
                      
           
  foreach($result as $row){
  
  foreach($row as $r){?>
  
  <tr>  
  <?php for($i=1;$i<=$maxlv;$i++) { 
    if($i== $r['lv']){
       echo "<td>".$r['lv']."</td>";
    }else{
      echo "<td></td>";
     }
    }
    ?>
  
   <td><?php echo $r['id'] ?></td>
   
     </tr>
  
     <?php
  }
  
  }
  
  ?>
                    
              
                      </tbody>
                    </table>
   <script>
   $(document).ready(function() {
          
   
       
      });
  
  
  </script>


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

