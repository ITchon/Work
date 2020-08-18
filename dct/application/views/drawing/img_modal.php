
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
  padding-left: 10%;
  padding-top: 10%
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
</div>


<script type="text/javascript">
  
// Loaded via <script> tag, create shortcut to access PDF.js exports.

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