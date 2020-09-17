
<!DOCTYPE html>
<html>
<head>
    <title>Jquery FullCalendar Integration with Codeigniter using Ajax</title>

   





    <script>
    $(document).ready(function(){
        var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;

        var calendar = $('#calendar').fullCalendar({
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay',
             
            },


            

            timeFormat: 'HH:mm',
            slotLabelFormat:'HH:mm',
            minTime:'00:00',
            maxTime:'24:00',
            timezone: 'Asia/Bangkok',
            selectable:true,
            allDaySlot: false,
            eventTextColor: '#FFFFFF',
            nextDayThreshold : "00:00:01",
			displayEventEnd:true,
            editable:true,
            events:"<?php echo base_url(); ?>fullcalendar/load",
                    eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },

            select:function(start, end, allDay)
            {   
                

                date_last_clicked = $(this);
             $(this).css('background-color', '#bed7f3'); 
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
     
            var str = start; 
            var time = str.slice(11, 20);
            var start = str.slice(0, 10);
            var end = end; 
            var end_time = end.slice(11, 20);
            var end_start = end.slice(0, 10);
            document.getElementById("start_time").value = time;
            document.getElementById("start_date").value = start;
            document.getElementById("end_time").value = end_time;
            document.getElementById("end_date").value = end_start;
           if(start <today){
                alert('the day has pass');
           }else{
                  $('#addModal').modal();
           }
         
            },
          
            eventResize:function(event)
            {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                var title = event.title;

       
                var id = event.id;
                if(start <today){
                alert('the day has pass');
                }else{
                $.ajax({
                    url:"<?php echo base_url(); ?>fullcalendar/update",
                    type:"POST",
                    data:{title:title, start:start, end:end, id:id},
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                       
                    }
                }) 
           }
                
            },
            
  
         

            eventDrop:function(event)
            {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                //alert(start);
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                //alert(end
                var id = event.id;
                if(start<today){
                calendar.fullCalendar('refetchEvents');
                alert('the day has pass');
                 }else{
                    $.ajax({
                    url:"<?php echo base_url(); ?>fullcalendar/update",
                    type:"POST",
                    data:{ start:start, end:end, id:id},
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');

                    }
                })
           }
            
            },

            eventClick:function(event)
            {

                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
             var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
             var str = start; 
            var time = str.slice(11, 20);
            var start = str.slice(0, 10);
             var end = end; 
            var end_time = end.slice(11, 20);
            var end_start = end.slice(0, 10);
                $('#name').val(event.title);
                $('#description').val(event.description);
                $('#color').val(event.color);
                $('#edit_start_time').val((time));
                $('#edit_start_date').val((start));
                $('#edit_end_time').val((end_time));
                $('#edit_end_date').val((end_start));
                $('#event_id').val(event.id);
                $('#editModal').modal();
            }

            
        });
         $('#insert').on("click", function () {
        var data = $('#form').serialize();
        start = $("#start_date").val();
        end = $("#end_date").val();
        start_time = $("#start_time").val();
        end_time = $("#end_time").val();
          if(start <today){
                alert('the day has pass');
            }
         else if(end<start){
            alert('Wrong date');
          }
          else if( start==end &&start_time ==  end_time ){
            alert('Wrong time');
          }
          else if(start==end && start_time > end_time){
            alert('End time must more than start time!');
          }
          else{
            $.ajax({
            url:"<?php echo base_url(); ?>fullcalendar/insert",
                    type:"POST",
                    data: data,
                    success:function()
                    {           
                        calendar.fullCalendar('refetchEvents');
                        $('#addModal').modal('hide');
                    }
                  
            });
          }
    });

    $('#editsave').on("click",function () {
        var data = $('#form2').serialize();
        start = $("#edit_start_date").val();
        end = $("#edit_end_date").val();
        start_time = $("#edit_start_time").val();
        end_time = $("#edit_end_time").val();
        if(start <today){
                alert('the day has pass');
            }
         else if(end<start){
            alert('Wrong date');
          }
          else if( start==end &&start_time ==  end_time ){
            alert('Wrong time');
          }
          else if(start==end && start_time > end_time){
            alert('End time must more than start time!');
          }
          else{
            $.ajax({
            url:"<?php echo base_url(); ?>fullcalendar/edit_event",
                    type:"POST",
                    data: data,
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                        $('#editModal').modal('hide');
                    }
            });
          }
    });

    $('#delete').on("click", function () {
        
             var data = $('#form2').serialize();
            $.ajax({
            url:"<?php echo base_url(); ?>fullcalendar/delete",
                    type:"POST",
                    data: data,
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                        $('#editModal').modal('hide');
                    }
            });
    });
    });
        


    
    </script>
</head>
    <body style="background-color:#343a40">
    <div class="" style="width:90%" >
      <div class="page-content-wrapper">
        <div class="row" style="padding-left:200px">
        <div class="col-md-0"></div>
                <div class="col-md-12 ">
            <div id="calendar"  style="background-color:#ffffff"></div>
            
        </div>
        </div>
    </div>
</div>
<div id="modalSignUpSm" tabindex="-1" role="dialog" class="modal fade">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h4 class="modal-title">Sign up with your email address</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label class="control-label">Email address</label>
                <input class="form-control" type="email" name="email">
              </div>
              <div class="form-group">
                <label class="control-label">Username</label>
                <input class="form-control" type="text" name="username">
              </div>
              <div class="form-group">
                <label class="control-label">Password</label>
                <input class="form-control" type="password" name="password">
              </div>
              <button class="btn btn-success btn-block btn-next" type="button">Create an account</button>
            </form>
          </div>
        </div>
      </div>
    </div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">ADD EVENT</h4>
      </div>
      <div class="modal-body">

     <form name="form" id="form" class='form' method="post">
      <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Event Name</label>
                <div class="col-md-8 ui-front">
                    <input type="text" class="form-control" name="title" value=""><br>
                </div>
        </div>
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Description</label>
                <div class="col-md-8 ui-front">

                    <textarea name="description" id="" class="form-control" cols="20" rows="3"></textarea><br>
                </div>
        </div>
        <div class="form-group">
        <label for="p-in" class="col-md-4 label-heading">Color</label>
                <div class="col-md-8 ui-front">
                    <input type="color" class="form-control" name="color" value="#0071c5"><br>
                </div>              
        </div>

       
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Start Date</label>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="start_day" id="start_date" required>
                </div>
                <div class="col-md-4">
                    <input type="time" class="form-control" name="start_time" id="start_time" required><br>
                </div>
        </div>
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">End Date</label>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="end_day" id="end_date" required>
                </div>
                <div class="col-md-4">
                    <input type="time" class="form-control" name="end_time" id="end_time" required><br>
                </div>
        </div>
      </div>

      <div class="modal-footer">
          <input type="button" class="btn btn-primary" id="insert" value="Add Event">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
    
        <h4 class="modal-title" id="myModalLabel">Update Calendar Event</h4>
      </div>


      <form name="form2" id="form2" class='form2' method="post">
      <div class="modal-body">
      <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Event Title</label>
                <div class="col-md-8 ui-front">
                    <input type="text" class="form-control" name="title" value="" id="name"><br>
                </div>
        </div>
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Description</label>
                <div class="col-md-8 ui-front">
                <textarea name="description" id="description" class="form-control" cols="20" rows="3"></textarea><br>
                </div>
        </div>
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Color</label>
                <div class="col-md-8 ui-front">
                    <input type="color" class="form-control" name="color" id="color"><br>
                </div>
        </div>
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Start Date</label>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="start_day" id="edit_start_date" required>
                </div>
                <div class="col-md-4">
                    <input type="time" class="form-control" name="start_time" id="edit_start_time" required><br>
                </div>
        </div>
        <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">End Date</label>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="end_day" id="edit_end_date" required>
                </div>
                <div class="col-md-4">
                    <input type="time" class="form-control" name="end_time" id="edit_end_time" required><br>
                </div>
        </div>

            <input type="hidden" name="eventid" id="event_id" value="0" />
      </div>
      <div class="modal-footer">
        <button type="button" id="delete" name="delete" class="btn btn-danger">Delete</button>
        <input type="button" class="btn btn-primary" value="Update Event" id="editsave">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form>
    </body>
</html>
