<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM documents where md5(id) = '{$_GET['id']}' ")->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title')
		$k = 'ftitle';
	$$k = $v;
}
?>
<div class="col-lg-12">
      <?php if(isset($_SESSION['login_id'])): ?>
	<div class="row">
	    <div class="col-md-8 mb-2">
	        <?php 
	                 $id=html_entity_decode($id);
                    $st=html_entity_decode($status);
    
                        	if($st == 1){
						  		echo '<div class="alert alert-success" role="alert">
                                        This '.$ftitle.' '. html_entity_decode($last_name).'  CV is APPROVED! 	&nbsp;&nbsp;  <b>by '.  html_entity_decode($recruiter).'</b>
                                     </div>';
                        	}elseif($st == 0){
						    	echo '<div class="alert alert-warning" role="alert">
                                        This '.$ftitle.' '. html_entity_decode($last_name).' CV  is Pending! 	&nbsp;&nbsp;  <b>by '.  html_entity_decode($recruiter).'</b>
                                     </div>';
                        	}elseif($st== 2){
						  	    echo '<div class="alert alert-danger" role="alert">
                                        This '.$ftitle.' '. html_entity_decode($last_name).'  CV is Rejected! 	&nbsp;&nbsp; <b>by '.  html_entity_decode($recruiter).'</b>
                                     </div>
                                     <div class="alert alert-info" role="alert">
                                        RESONS OF REJECTION  : '. html_entity_decode($reject_resons).' </b>
                                     </div>
                                     
                                     ';
                        	}
                        	?>
	   </div>
		<div class="col-md-4 mb-2">
			<button class="btn bg-light border float-right" type="button" id="share"><i class="fa fa-share"></i> Share This Document</button>
		</div>
	</div>
    <?php endif; ?>
	<div class="row">
		<div class="col-md-8">
			<div class="card card-outline card-info">
				<div class="card-header">
					<div class="card-tools">
					    <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button>
						<small class="text-muted">
							Date Uploaded: <?php echo date("M d, Y",strtotime($date_created)) ?>
						</small>
					</div>
				</div>
				<div  class="card-body">
				    <div id="vk_pdf_viewer">
                         <table width="100%" border="0">
                      <tr>
                        <td align="left">
                        <div id="navigation_controls">
                                <button id="go_previous" class="Previous"><span>Previous </span></button>
                                <input id="current_page" value="1" type="text" readonly="true"/>
                                <button id="go_next" class="Next"><span>Next </span></button>
                            </div>
                            </td>
                        <td align="right">
                        <div id="zoom_controls">  
                                <button id="zoom_in" class="zoom">+</button>
                                <button id="zoom_out" class="zoom">-</button>
                            </div>
                        </td>
                      </tr>
                    </table>
                    <div id="canvas_container">
                        <canvas id="pdf_renderer"></canvas>    
                    </div>
                </div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3><b>Details</b></h3>
				</div>
					<div class="card-body">
					<div class="callout callout-info">
						<dl>
							<dt>First Name</dt>
							<dd><?php echo $ftitle ?></dd>
						</dl>
					</div>
					<div class="callout callout-info">
						<dl>
							<dt>Last Name</dt>
							<dd><?php echo html_entity_decode($last_name) ?></dd>
						</dl>
					</div>
					<div class="callout callout-info">
						<dl>
							<dt>Phone Number</dt>
							<dd><?php echo html_entity_decode($phonenumber) ?></dd>
						</dl>
					</div>
				<div class="callout callout-info">
						<dl>
							<dt>Email</dt>
							<dd><?php echo html_entity_decode($email) ?></dd>
						</dl>
					</div>
					<div class="callout callout-info">
						<dl>
							<dt>Tags</dt>
							<dd><?php echo html_entity_decode($tag) ?></dd>
						</dl>
					</div>
					<div class="callout callout-info">
						<dl>
							<dt>Candidate Summary</dt>
							<dd><?php echo html_entity_decode($description) ?></dd>
						</dl>
					</div>
				</div>
				<div class="card-header">
					<h3><b>File/s</b></h3>
				</div>
				<div class="card-body">
					<div class="col-md-12">
						<div class="alert alert-info px-2 py-1"><i class="fa fa-info-circle"></i> Click the file to download.</div>
						<div class="row">
							 <?php
					            if(isset($file_json) && !empty($file_json)){
					              foreach(json_decode($file_json) as $k => $v){
					                if(is_file('assets/uploads/'.$v)){
					                $_f = file_get_contents('assets/uploads/'.$v);
					                $dname = explode('_', $v);
                                    $filepdf=$v;
					         ?>
		 
							<div class="col-sm-6">
								<a href="download.php?f=<?php echo $v ?>" target="_blank" class="text-white border-rounded file-item p-1">
			                      <span class="img-fluid bg-dark border-rounded px-2 py-2 d-flex justify-content-center align-items-center" style="width: 100px;height: 100px">
			                      	<h3 class="bg-dark"><i class="fa fa-download"></i></h3>
			                      </span>
			                      <span class="text-dark"><?php echo $dname[1] ?></span>
			                      <a id="shardoc" href="assets/uploads/<?php echo $v ?>" target="_blank" class="alert alert-info px-2 py-1"><i class="fa fa-eye"></i> view </a>
			                    </a>
							</div>
							 <?php }?>
					         <?php } ?>
					         <?php } ?>
						</div>
					</div>
				</div>
				
			</div>
    
			  <?php if($_SESSION['login_type'] == 1){?>
			<div class="card card-outline card-primary">
			<div class="card-header">
					<h3><b>Status</b></h3>
				</div>
				<div class="card-header">
                   <?php
                    $id=html_entity_decode($id);
                    $st=html_entity_decode($status);
                  
                        echo'<p><a href ="status.php?d_id='.$id.'&status=1" class="btn btn-success">APPROVE</a></p>';
                   
                         echo'<p><a href ="document_reject.php?d_id='.$id.'&status=2" class="btn btn-danger">REJECT</a></p>';
                    
                       
                    ?>
                </div>
                </div>
        
                <?php }elseif($_SESSION['login_type'] == 3){ ?>
                <div class="card card-outline card-primary">
				<div class="card-header">
                   <?php
                    $id=html_entity_decode($id);
                    $st=html_entity_decode($status);
                    echo'<p><a href ="status.php?d_id='.$id.'&status=1" class="btn btn-success">APPROVE</a></p>';
                   
                         echo'<p><a href ="document_reject.php?d_id='.$id.'&status=2" class="btn btn-danger">REJECT</a></p>';
                    ?>
                </div>
                </div>
                <?php } ?>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
<style type="text/css">
    #vk_pdf_viewer{
        width: 605px;
        margin: auto;
        height: auto;
    }
    #canvas_container{
        width: 602px;
        margin: auto;
        height: auto;
        overflow: auto;
        background: #333;
        text-align: center;
        border: solid 3px #007bff;
        border-radius: 5px;
    }
    #current_page{
        width: 30px;
        height: 21px;
        border-radius: 0px;
        border: 2px solid #007bff;
        text-align: center;
         border-radius: 5px;
    }
    .zoom{
        background-color: #007bff;
        border: none;
        color: #FFFFFF;
        text-align: center;
        transition: all 0.5s;
        cursor: pointer;
        padding: 5px;
        width: 30px;
         border-radius: 5px;
    }
    .Previous {
  background-color: #007bff;
  border: none;
  color: #FFFFFF;
  text-align: center;
  transition: all 0.5s;
  cursor: pointer;
  padding: 5px;
  width: 90px;
 border-radius: 5px;
}

.Previous span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.Previous span:after {
  content: '\00ab';
  position: absolute;
  opacity: 0;
  top: 0;
  left: -65px;
  transition: 0.5s;
}

.Previous:hover span {
  padding-left: 15px;
}
.Previous:hover span:after{
    opacity: 1;
    right: 0;
}

.Next {
  background-color: #007bff;
  border: none;
  color: #FFFFFF;
  text-align: center;
  transition: all 0.5s;
  cursor: pointer;
  padding: 5px;
  width: 90px;
     border-radius: 5px;
}

.Next span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.Next span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.Next:hover span {
  padding-right: 25px;
}
.Next:hover span:after{
    opacity: 1;
    right: 0;
}
</style>
               
                     
                <script type="text/javascript">
  var myState = {
    pdf:null,
    currentPage:1,
    zoom:1
  }  
  var pdfjsLib = window['pdfjs-dist/build/pdf'];

  //get pdf file
  pdfjsLib.getDocument('assets/uploads/<?php echo $v ?>').then((pdf) => {
    myState.pdf = pdf;
    render();

  }); 
//pdf page previous & next function
document.getElementById('go_previous').addEventListener('click', (e) =>{
    if(myState.pdf == null || myState.currentPage == 1)
        return;
    myState.currentPage -=1;
    document.getElementById('current_page').value = myState.currentPage;
    render();

});
document.getElementById('go_next').addEventListener('click', (e) =>{
    if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages)
        return;
    myState.currentPage +=1;
    document.getElementById('current_page').value = myState.currentPage;
    render();

});


//current page function
document.getElementById('current_page').addEventListener('keypress', (e) => {
    if(myState.pdf == null) return;
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13){
        var desiredPage = document.getElementById('current_page').valueAsNumber;
        if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages){
            myState.currentPage = desiredPage;
            document.getElementById("current_page").value=desiredPage;
            render();

        }

    }

});


// zoom in & out function
document.getElementById('zoom_in').addEventListener( 'click',(e) => {
    if(myState.pdf == null) return;
    myState.zoom += 0.5;
    render();
});
document.getElementById('zoom_out').addEventListener( 'click',(e) => {
    if(myState.pdf == null) return;
    myState.zoom -= 0.5;
    render();
});


  // pdf file render function
 function render(){
    myState.pdf.getPage(myState.currentPage).then((page) => {
        var canvas = document.getElementById("pdf_renderer");
        var ctx = canvas.getContext('2d');
        var viewport = page.getViewport(myState.zoom);
        canvas.width = viewport.width;
        canvas.height = viewport.height;

        page.render({
            canvasContext:ctx,
            viewport:viewport
        });

    });

 }
</script>
		</div>
        
	</div>
</div>
<script>

	$('.file-item').hover(function(){
		$(this).addClass("active")
	})
	$('file-item').mouseout(function(){
		$(this).removeClass("active")
	})
	$('.file-item').click(function(e){
		e.preventDefault()
		_conf("Are you sure to download this file?","dl",['"'+$(this).attr('href')+'"'])
	})
	function dl($link){
		start_load()
		window.open($link,"_blank")
		end_load()
	}
	$('#share').click(function(){
		uni_modal("<i class='fa fa-share'></i> Share this document using the link.","modal_share_link.php?did=<?php echo md5($id) ?>")
	})
</script>























































































