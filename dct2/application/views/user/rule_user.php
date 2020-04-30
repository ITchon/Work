<script>
    $(document).ready(function(){
    
      $('#rule').modal({

backdrop: 'static'
})
  });
  </script>
  <div class="modal fade" id="rule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="bg-primary modal-header">
        
      </div>
      <div class="modal-body">
      <?php  echo form_open('user/save_user_permission'); ?>

          <div class="form-group">
             <div class="row">
            <?php
             $id = $this->uri->segment('3'); 
            ?>
            <input type="text" name="su_id"  value="<?php echo $id ?> " hidden>
            <input type="text"  value="<?php echo $id ?> " hidden>
            <?php
                 foreach($result_group as $rg){          
          ?>

                <div class="col-xs-6" style="padding-top: 20px;">
              <input type="checkbox" value="<?php echo $rg->sp_id ?>" name="sp_id[]" id="sp_id" <?php
              foreach($result_user as $rs ){
                    if($rs ->sp_id == $rg->sp_id){
                    echo 'checked';
                  }
                  }?>  > 
          <?php echo $rg->name ?>
              
 </div>
            <?php
            
          }
            ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      <?php echo anchor(base_url().'user/manage', 'Back',array('class'=>'btn btn-default'));

        echo form_submit(array('user_id'=>'submit','value'=>'Add','class'=>'btn btn-primary')); 
         
     
        echo form_close(); 
      ?>


      </div>
    </div>
  </div>
</div>
</form>











