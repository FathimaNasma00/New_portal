
<?php
include 'lkcareers_con.php';
error_reporting(E_ERROR | E_PARSE);
$qry = $conn->query("SELECT * FROM cv_documation where id = '{$_GET['id']}' ")->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title')
		$k = 'ftitle';
	$$k = $v;
}

include 'db_connect.php';
$qry1 = $conn->query("SELECT jb_ref,jb_title,deadline FROM job_management WHERE id = $job_idselect")->fetch_array();
foreach($qry1 as $k => $v){
	if($k == 'jb_ref')
		$k = 'fjb_ref';
	$$k = $v;
}
?>

<div class="col-lg-12">
      
	<div class="row">
	    <div class="card card-outline card-info">
	    	<div class="col-md-12">
					<div class="callout callout-info">
					    <div class="card-header">
					<div class="card-tools">
						<small class="text-muted">
							Details of Applicant
						</small>
					</div>
				</div>
					<div class="card-header">
					<div class="card-tools">
					     <form action="" id="manage-upload">
						<dl>
						    <dd style="font-size:13px;font-weight:bold;" >Job Ref.No &nbsp;:&nbsp; <?php echo $fjb_ref; ?> &nbsp; - &nbsp; <?php echo $jb_title; ?> </dd>
							<dd style="font-size:13px;font-weight:bold;" >First Name &nbsp;:&nbsp; <input type="text"  name="title" value="<?php echo isset($first_name) ? $first_name : '' ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Last Name &nbsp;:&nbsp;<input type="text" class="" name="lastname" value="<?php echo isset($last_name) ? $last_name : '' ?>"> </dd>
							<dd style="font-size:13px;font-weight:bold;" >Phone Number &nbsp;:&nbsp; <input type="text" class="check_phoenumber" name="phonenumber" value="<?php echo isset($phone_number) ? $phone_number : '' ?>"></dd>
            				<script>
            				    var userName = document.querySelector('.check_phoenumber');
            
                                    userName.addEventListener('input', restrictNumber);
                                    function restrictNumber (e) {  
                                      var newValue = this.value.replace(new RegExp(/[^/+/0-9]/g, ''), ""); 
                                      this.value = newValue;
                                    }
            				</script>
							<dd style="font-size:13px;font-weight:bold;" >Email &nbsp;:&nbsp; <input type="text" class="" name="email" value="<?php echo isset($email) ? $email: '' ?>"></dd>

					  <!--TAGS STYLE SHEETS-->
                    			 <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
                                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
                                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css" />
                                  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
                                  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
					<!--END TAGS STYLE SHEETS-->
						    <dd style="font-size:13px;font-weight:bold;" >Skills &nbsp;:&nbsp; <input type="text" class="tag-container" name="tag" data-role="tagsinput" ></dd>
						    <dd style="font-size:13px;font-weight:bold;" >Position &nbsp;:&nbsp; <input type="text" class="tag-container" name="position" data-role="tagsinput" ></dd>
						    <dd style="font-size:13px;font-weight:bold;" >Industry &nbsp;:&nbsp; <input type="text" class="tag-container" name="industry" data-role="tagsinput"></dd>
							<dd style="font-size:13px;font-weight:bold;" >Summary &nbsp;:&nbsp; <textarea name="description" id="" cols="50" rows="2" class="">
								
								
								
							</textarea></dd>
							 	 <?php
							 	  $resumePath = $resume_path;
                                  $fileName =  $resumePath;
            if(isset($fileName) && !empty($fileName)){
              foreach(json_decode($fileName) as $k => $v){
                if(is_file('https://lkcareers.lk/'.$v)){
                $_f = file_get_contents('https://lkcareers.lk/'.$v);
                $dname = explode('_', $v);
           ?>
           <div class="def-item">
            <input type="hidden" class="inp-file" name="fname[]" value="<?php echo $v ?>" data-uuid="<?php echo $k; ?>">
                  <div id="" class="row mt-2 dz-processing dz-success dz-complete">
                      <div class="col-auto">
                          <span class="preview"><img src="data:," alt="" data-dz-thumbnail=""></span>
                      </div>
                      <div class="col d-flex align-items-center">
                          <p class="mb-0">
                            <span class="lead"><?php echo $dname[1]; ?></span>
                            (<span><strong><?php echo filesize('assets/uploads/'.$v) ?></strong> Bytes</span>)
                          </p>
                          <strong class="error text-danger" data-dz-errormessage=""></strong>
                      </div>
                      <div class="col-4 d-flex align-items-center">
                          <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
                          </div>
                      </div>
                      <div class="col-auto d-flex align-items-center">
                        <div class="btn-group">
                          <button class="btn btn-danger delete" type="button" data-uuid="<?php echo $k ?>">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                          </button>
                        </div>
                      </div>
                    </div>
              </div>
         <?php } ?>
         <?php } ?>
         <?php } ?>
						<dd><button class="btn btn-primary  bg-gradient-primary mx-2" form="manage-upload">Save</button></dd>
						</dl>
						</form>
						</div>
						</div>
					</div>
				</div>
		</div>
	</div>
    
    


	<div class="row">
		<div class="col-md-9">
			<div class="card card-outline card-info">
				<div class="card-header">
					<div class="card-tools">
						<small class="text-muted">
							Date Uploaded: <?php echo date("M d, Y",strtotime($date)) ?>
						</small>
					</div>
				</div>
				<div  class="card-body">
				    <style>
    #pdf-container {
      width: 100%;
      height: 100vh;
      overflow: hidden;
      position: relative;
    }
    #pdf-container iframe {
      width: 100%;
      height: calc(100vh - 50px); /* Adjust as needed */
    }
    #navigation {
      position: absolute;
      bottom: 0;
      width: 100%;
      text-align: center;
    }
  </style>
				    <div id="pdf-container">
    <iframe id="pdf-viewer" src="https://lkcareers.lk/<?php echo $resume_path; ?>" frameborder="0"></iframe>
  </div>
  <div id="navigation">
    <!--<button onclick="previousPage()">Previous</button>-->
    <!--<button onclick="nextPage()">Next</button>-->
  </div>

  <script>
    const pdfViewer = document.getElementById('pdf-viewer').contentWindow;

    function nextPage() {
      pdfViewer.postMessage('nextPage', '*');
    }

    function previousPage() {
      pdfViewer.postMessage('previousPage', '*');
    }
  </script>
				</div>
			
				
			</div>
		</div>
	<?php 
    session_start();
    
    if(isset($_SESSION['status']))
    {
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            	Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Data successfully deleted',
                      showConfirmButton: false,
                      timer: 1500
                    })
            </script>
        <?php 
        unset($_SESSION['status']);
    }

?>
	
		
		<div class="col-md-3">
		    
                    	      <div class="card card-outline card-primary">
		        <div class="card-header">
					<h5 style="text-align:center;"><b>COMMENT SECTION</b></h5>
				</div>
		        <div class="">
		             <?php
                    date_default_timezone_set("Asia/colombo");
                    $logidz = $_SESSION['login_id'];
                    $date = date("Y-m-d");                   
                    $query="SELECT comment.id,comment.file_id,comment.comment,comment.date,comment.recuiter,users.recruiter FROM comment 
                            INNER JOIN documents ON ( `documents`.`id`=`comment`.`file_id`) INNER JOIN users ON ( `comment`.`recuiter`=`users`.`id`) WHERE comment.file_id='{$_GET['id']}'";
                    $result = mysqli_query($conn,$query);
                    while($row=$result->fetch_object()){ 
                     $recuitercom= $row->recuiter;
                    ?>
                    
                    <div class="card">
     
                    
					<div class="callout callout-info">
					   
					    <div class="card-header">
				    	<div class="card-tools">
					    
						<dl>
							<dt style="font-size:12px;"><i class="ri-calendar-fill"></i>&nbsp; : &nbsp;<?php echo $row->date; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="ri-map-pin-user-fill" ></i> &nbsp; : &nbsp;<?php echo $row->recruiter; ?> 
							        
					
		                        </dt>
							<dd><i class="ri-todo-fill" aria-hidden="true"></i> &nbsp; : &nbsp;<?php echo $row->comment;?></dd>
								 <?php if(($row->recuiter == $logidz)){ ?>
							      <dd> 
							      <div style="text-align:center;">
                                   <a onclick="return confirm('Are You Sure Want To Delete This Comment!'); " class="btn  btn-flat" href="comment_delete.php?d_id=<?php echo $row->id; ?>" ><i style="color:red;font-size:16px;" class="ri-delete-bin-5-fill"></i></a>
							     </div>
							    </dd>
		                        <?php } ?>
						</dl>
						</div>
						</div>
						
					</div>
				
					  <?php } ?>
					
				</div>
			
		        	<form action="" id="comment-upload">
		        	     <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		        	     
		        	     <div class="card-body">
		        	 <div class="callout callout-info">
						<dl>
							<dt>Add Comment</dt>
							<dd><textarea name="comment" id="comment" cols="6" required rows="4" class=" form-control">
							</textarea></dd>
							
						</dl>
						<div class="d-flex w-100 justify-content-center align-items-center">
                                        <button class="btn btn-primary  bg-gradient-primary mx-2" form="comment-upload">Save</button>
                                    </div>
						
					</div>
				
		        	     </div>
		        	 </form>
		   </div>
                    	</div>
           
		  </div>
    
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
<script>
	$('#manage-upload').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=editsave_upload',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.href = 'index.php?page=edit_document&id=<?php echo $id ?>'
					},2000)
				}
			}
		})
	})
</script>
<script>
	$('#comment-upload').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=comment_upload',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Comment successfully saved',"success");
					setTimeout(function(){
						location.href = 'index.php?page=edit_document&id=<?php echo $id ?>'
					},2000)
				}
			}
		})
	})
</script>
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
<script>
	$(document).ready(function(){
	$('.delete_comment').click(function(){
	_conf("Are you sure to delete this Comment?","delete_comment",[$(this).attr('data-id')])
	})
	})
	function delete_comment($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_comment',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Comment successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>























































































