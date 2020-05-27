<div  style="padding-top:100px">
<div class="container card" style="width:800px">
<h3></h3>
          
         <?php 
            echo form_open('usergroup/save_userg_permission');
       ?>
   

            <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Manage Permission Level</h3>
                <h3><?php echo $result[0]->sug_name; ?></h3></input>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm">
                <div class="card-body">
                  <div class="form-group">
                    <input type="text" name="sug_id" value="<?php echo $result[0]->sug_id; ?>" hidden >
                    
                    
                    <?php
                 foreach($result_group as $r){          
          ?>
              <br>

              <input type="checkbox" value="<?php echo $r->spg_id ?>" name="spg_id[]" <?php
              foreach($result_user as $rs ){
                    if($r ->spg_id == $rs->spg_id){
                    echo 'checked';
                  }
                  }?>  ><?php echo $r->name ?>
              <br>

            <?php
            
          }
            ?>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <?php
            echo form_submit(array('ID'=>'submit','value'=>'Add','class'=>'btn btn-primary')); 
         
     
      
            echo anchor(base_url().'Usergroup/manage', 'Back',array('class'=>'btn btn-default'));
            
            echo form_close(); 
         ?>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->


          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
            
             

