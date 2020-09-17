<script>
    $(document).ready(function(){
    
      $('#rule').modal({

backdrop: 'static'
})
  });
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <div class="modal fade" id="rule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="bg-primary modal-header">
        <h1><?php echo $result_name[0]->su_name; ?></h1>
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
                   $i = 0;
                 foreach($result_group as $r){     

                  if($i !=  $r->spg_id){
                      echo "<div class='col-xs-12'>
                      <hr>
                      <label style='cursor:pointer' for='".$r->spg_id."'  class='text-primary'>".$r->g_name."</label>
                      <input value ='.$r->spg_id.' type='checkbox' name='pg' id=".$r->spg_id."> 
                      </div>";
                    }
                   ?>
                <div class="col-xs-6" style="padding-top: 20px;">
         
                   <input type="checkbox"  value="<?php echo $r->sp_id ?>" name="sp_id[]" id="<?php echo $r->controller ?>" class="<?php echo $r->spg_id ?>" <?php
              foreach($result_user as $rs ){
                    if($r ->sp_id == $rs->sp_id){
                    echo 'checked';
                   }
                } ?> > <label for="<?php echo $r->controller ?>" style="cursor: pointer;color:#5b6572"> <?php echo $r->p_name ?></label>
              </div>
             <?php
                  $i = $r->spg_id;  
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
<script type="text/javascript">
    $(":checkbox").on("change", function() {
  
      var p_id = $(this).attr('id');
        if (this["name"] === "pg" && this.checked) {
                $(':checkbox').each(function () {
                  if(p_id == $(this).attr("class")){
                    this.checked = true;
                  }
          
                });
        }else{
            $(':checkbox').each(function () {
                  if(p_id == $(this).attr("class")){
                    this.checked = false;
                  }
          
                });
        }
    })
</script>











