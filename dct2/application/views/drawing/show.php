<style>
#form {
  display: inline-block;
}
</style>



<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>

  <!-- Trigger the modal with a button -->

  <!-- Modal -->



      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
         
            <p class="title-bar-description">
             
            </p>
          </div>

          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header ">
              
              <?php
             ?>

              <h3><a href="<?php echo base_url()?>drawing/show">MANAGE DRAWING </a> <?php if(isset($title)){?>
                <a class=""> </a> >   <?php echo $title ?>  <a  class="fa fa-undo " onClick="history.go(-1)"style="cursor: pointer;"> </a> 
                <?php  }?> 
                <a href="" class="btn btn-default no_print" onclick="window.history.go(-1); return false;"> Back </a>
                </h3>
                <?php  
                $s_pno[] =null;

                ?>


                <form id='form' class="form-inline" action="<?php echo base_url()?>drawing/show" method="get">
                  <div class="col-xs-3">
                  <input type="hidden" class="form-control">
                  <a class="form-control btn btn-primary">Drawing No.</a>
                    <input type="text" class="form-control" name="s_dno" value="<?php echo $s_dno; ?>">
                  </div>

                  <div class="col-xs-3">
                    <a class="form-control btn btn-primary">Drawing Name</a>
                    <input type="text" class="form-control" name="s_name" value="<?php echo $s_name; ?>">
                  </div>

                  <div class="col-xs-3">
                    <a class="form-control btn btn-primary">Part No.</a>
                  <select class="lol" id="demo-select2-3" name="s_pno[]" class="form-control" multiple="multiple">
                    <?php foreach ($resultp as $r) { ?>
                     <option value="<?php echo $r->p_no ?>" <?php 
                foreach ($s_pno as $s) {
                  if($r->p_no == $s){
                    echo 'selected';
                  }
                  }?>>
                  <?php echo $r->p_no?></option>
                    <?php } ?>
                </select>
                  </div>


                  <div class="col-xs-3">
                  <button type="submit" class="btn btn-primary">SEARCH</button>
                  </div>
                </form>



                </div>
                <div class="card-body">
                <table id="demo-datatables-buttons-1" class="table table-hover  table-nowrap dataTable" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th width="15%">Drawing No</th>
                        <th width="15%">Drawing Name</th>
                        <th width="10%">Part No</th>
                        <th width="5%">Customer</th>
                        <th width="10%">DCN</th>
                        <th width="3%">Version</th>
                        <th width="10%">Manage</th>
                        <th width="10%">Status</th>
                        <th>Path File</th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php
                    foreach($result as $r){
             echo "<tr>";?>
                    <td><?php echo "<b>".$r->d_no."</b>" ?></td>
                    <td><?php echo "<b>".$r->d_name."</b>" ?></td>
                    <td><?php echo "<b>".$r->p_no."</b>" ?></td>
                    <td><?php echo "<b>".$r->cus_name."</b>" ?></td>

                <td class="text-center">
                  <form id='form' action="<?php echo base_url()?>drawing/open_dcn" method="post">
                  <input type="hidden" name="dcn_id" value="<?php echo $r->dcn_id ?>">
                  <input type="hidden" name="path" value="C:\inetpub\wwwroot\dct\uploads\">
                  <input type="hidden" name="filename" value="<?php echo $r->dcn_file ?>">
                  <input type="hidden" name="file" value="<?php echo $r->dcn_code ?>">
                    <button  type="submit" style=" background-color: Transparent;border:none" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;"><a>
                      <?php echo $r->dcn_no ?></a></button>
                  </form>
                </td>

                <td class="text-center">
                  <form id='form' action="<?php echo base_url()?>drawing/show_v" method="get">
                    <input type="hidden" name="p_id" value="<?php echo $r->p_id ?>">
                    <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                    <button  type="submit"  style=" background-color: Transparent;border:none" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ดูVersionทั้งหมด</h5>' ><a>
                      <?php echo $r->version ?></a></button>

                  </form>
                </td>
                  <td class="text-center">
                  <a href="javascript:void(0)"  data-id="<?php echo $r->d_id;?>" class="view_img"><i class='btn-success btn-sm fa fa-search'> </i></a>
                  <form id='form' action="<?php echo base_url()?>drawing/openfile" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <input type="hidden" name="path" value="\\192.168.82.4\tbkk$\RD\Drawing\01_Drawings\A_Production Dwg\">
                  <input type="hidden" name="filename" value="<?php echo $r->file_name ?>">
                  <input type="hidden" name="file" value="_FLANGE_cancelled.XDW">
                  <button class=" btn-primary btn-sm fa fa-inbox" type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เปิดไฟล์</h5>' style="border:none;">
                  </button>
                  </form>
                                         
                  <?php
                   if($r->enable!=1){?>

                  <form id="form" action="<?php echo base_url()?>drawing/enable" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <input type="hidden" name="search" value="<?php echo $search ?>">

                  <button class='btn-danger btn-sm fa fa-times' type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' aria-describedby='passHelp' title='<h5>เปิดการใช้งาน</h5>' style="border:none;"></button>

                  </form>

                  <?php
                }
                else{?>
                
                  <form id="form" action="<?php echo base_url()?>drawing/disable" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <input type="hidden" name="search" value="<?php echo $search ?>">

                  <button class='btn-success btn-sm fa fa-check' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ปิดการใช้งาน</h5>' style="border:none;"></button>
                  
                  </form>                      
                  <?php
                }
              
              
                ?>

                <form id='form' action="<?php echo base_url()?>drawing/edit" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <input type="hidden" name="search" value="<?php echo $search ?>">
                  <button class=" btn-primary btn-sm fa fa-wrench" type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>แก้ไขข้อมูล</h5>' style="border:none;">
                  </button>
                  </form>

                <form id='form' action="<?php echo base_url()?>drawing/version_form" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                  <input type="hidden" name="search" value="<?php echo $search ?>">
                  <button class=" btn-primary btn-sm fa fa-plus" type="submit" data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>เพิ่มVersion</h5>' style="border:none;">
                  </button>
                  </form>
      
                    <form id="form" action="<?php echo base_url()?>drawing/deletedrawing" method="post">
                    <input type="hidden" name="d_id" value="<?php echo $r->d_id ?>">
                    <input type="hidden" name="search" value="<?php echo $search ?>">
                    <button class="btn-default btn-sm fa fa-trash" onclick='return confirm("Confirm Delete Item")' data-toggle='tooltip' data-html='true' data-placement='bottom' aria-describedby='passHelp' title='<h5>ลบข้อมูล</h5>' style="border:none;"></button>
                    </form>

                     

      
                <?php 
                if($r->enable!=1 ){?>
                  
                  <td class="text-center"><b><font color="red">disable</font></b></td>
                  <?php
                }
                else{?>
                  <td class="text-center"><b><font color="lightgreen">active</font></b></td>                   
                  <?php
                }
                ?>

                <td style="font-size: 14px"><?php echo $r->path_file ?>\<?php echo $r->file_name ?>

                </td>
                <?php

            echo "</tr>";

        }
    ?>
            
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
  
            
          </div>
        </div>
      </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script>
        $(document).ready(function() {
    $('body').on('click', '.view_img', function () {
 var id = $(this).data("id");
 console.log(id);
 
 $.ajax({
    type: "Post",
    url:'<?php echo base_url() ?>/ajax/view_pdf',
    data: {
       id: id
    },
    dataType: "json",
    success: function (res) {
      var html = '';
      // if(res.success != false){ 
      var path ='uploads/'+res.data[0].file_code;
 
      pdfjsLib.getDocument('<?php echo base_url()?>'+path).promise.then(function(pdfDoc_) {
             var container=document.getElementById("pageContainer")
    var origCanvas=document.getElementById("the-canvas");
    var wmCanvas=document.createElement("canvas");
    wmCanvas.id="watermark";
    wmCanvas.setAttribute("style","position:absolute; ")

if(container.firstChild)
    container.insertBefore(wmCanvas, container.firstChild);
else
    container.appendChild(wmCanvas);

var wmContext=wmCanvas.getContext('2d');

// setup text for filling
wmContext.font = "24px Comic Sans MS" ;
wmContext.fillStyle = "red";
// get the metrics with font settings
var metrics = wmContext.measureText("WaterMark Demo");
var width = metrics.width;
// height is font size
var height = 72;

// change the origin coordinate to the middle of the context
wmContext.translate(origCanvas.width/2, origCanvas.height/2);
// rotate the context (so it's rotated around its center)
wmContext.rotate(-Math.atan(origCanvas.height/origCanvas.width));
// as the origin is now at the center, just need to center the text
wmContext.fillText("<?php echo $this->session->userdata('fname')."  ". $this->session->userdata('lname'); ?>",-width/2,height/2);
  
      pdfDoc = pdfDoc_;
      document.getElementById('page_count').textContent = pdfDoc.numPages;
  // Initial/first page rendering
      renderPage(pageNum);
      });

             $('#modal_form').modal('show'); 
        // }else{

        // alert('No PDF File');
        // }
       
    },
    error: function (res) {
    console.log(res);
     
    alert('NO DATA');
    }
 });
});

});


</script>

<style>


#the-canvas {
  border: 1px solid black;
  direction: ltr;
}
#pageContainer{

  overflow:auto;
  background: #333;

}
#watermark{
  opacity: 0.5;

}
</style>


<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>

  <!-- Trigger the modal with a button -->
  <div class="modal fade text-center" id="modal_form" role="dialog">
    <div id="header" class="modal-dialog" style="width:1350px;height:900px">
        <div class="modal-content" >

            <div class="modal-body  " onContextMenu="return false;">
         
    <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">×</span>
              <span class="sr-only">Close</span>
            </button>
         <button class="btn btn-primary" id="prev">Prev</button >
  <button class="btn btn-primary">  <span class=" " style="color:#ffffff">Page: <span id="page_num"></span> / <span id="page_count"></span></span></button>
  <button class="btn btn-primary" id="next">Next</button>        
  <div style="padding-top:5px;padding-bottom: 5px">  
  <button class=" btn-outline-default" id="zoom_in"><i class="fa fa-lg fa-search-plus"></i></button>
  <button class="btn-default" id="reset"><i class="fa fa-lg fa-refresh" aria-hidden="true"></i></button>
  <button class=" btn-outline-default" id="zoom_out"><i class="fa fa-lg fa-search-minus"></i></button>

  </div>

             <div id="pageContainer" style="width:1300px;height:870px; border: 3px solid">
                  <canvas id="the-canvas" ></canvas>
              </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
  
// Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];

// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

var pdfDoc = null,

    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
      scale = 1,
    canvas = document.getElementById('the-canvas'),
    ctx = canvas.getContext('2d');
  var container=document.getElementById("pageContainer")
    var origCanvas=document.getElementById("the-canvas");
    var wmCanvas=document.createElement("canvas");
    wmCanvas.id="watermark";

    wmCanvas.setAttribute("style","position:absolute; ")

if(container.firstChild)
    container.insertBefore(wmCanvas, container.firstChild);
else
    container.appendChild(wmCanvas);

var wmContext=wmCanvas.getContext('2d');

// setup text for filling
wmContext.font = "24px Comic Sans MS" ;
wmContext.fillStyle = "red";
// get the metrics with font settings
var metrics = wmContext.measureText("WaterMark Demo");
var width = metrics.width;
// height is font size
var height = 72;

// change the origin coordinate to the middle of the context
wmContext.translate(origCanvas.width/2, origCanvas.height/2);
// rotate the context (so it's rotated around its center)
wmContext.rotate(-Math.atan(origCanvas.height/origCanvas.width));
// as the origin is now at the center, just need to center the text
wmContext.fillText("<?php echo $this->session->userdata('fname')."  ". $this->session->userdata('lname'); ?>",-width/2,height/2);
  
function renderPage(num) {
  pageRendering = true;

  // Using promise to fetch the page
  pdfDoc.getPage(num).then(function(page) {

    var viewport = page.getViewport({scale});
    canvas.height = viewport.height;
    canvas.width = viewport.width;
    document.getElementById("watermark").style.width = viewport.width;


    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);

    // Wait for rendering to finish
    renderTask.promise.then(function() {
      pageRendering = false;
      if (pageNumPending !== null) {
        // New page rendering is pending
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });

  // Update page counters
  document.getElementById('page_num').textContent = num;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}

/**
 * Displays previous page.
 */
function onPrevPage() {
  if (pageNum <= 1) {
    return;
  }
  pageNum--;
  queueRenderPage(pageNum);
}
document.getElementById('prev').addEventListener('click', onPrevPage);

/**
 * Displays next page.
 */
function onNextPage() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
  pageNum++;
  queueRenderPage(pageNum);
}
document.getElementById('next').addEventListener('click', onNextPage);

function zoomIn() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
   scale = scale + 0.5  ;
 queueRenderPage(pageNum);
 }

document.getElementById('zoom_in').addEventListener('click', zoomIn);

function zoomOut() {
  if (scale <=1) {
    return;
  }
   scale = scale - 0.5  ;
 queueRenderPage(pageNum);
 }

document.getElementById('zoom_out').addEventListener('click', zoomOut);
function reset() {
   scale = 1  ;
 queueRenderPage(pageNum);
 }

document.getElementById('reset').addEventListener('click', reset);
</script>

     



     