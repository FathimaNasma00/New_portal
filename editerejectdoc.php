<?php
include 'db_connect.php';
error_reporting(E_ERROR | E_PARSE);
$qry = $conn->query("SELECT * FROM documents where id = '{$_GET['id']}' ")->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title')
		$k = 'ftitle';
	$$k = $v;
}
?>

<div class="col-lg-12">
      
	<div class="row">
	    	<div class="col-md-12">
					<div class="callout callout-info">
					    <form action="" id="manage-upload">
					          <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
					           <input type="hidden" class="form-control form-control-sm" name="refno" value="<?php echo isset($ref_no) ? $ref_no : '' ?>">
						<dl>
						    <dt>Rejected Applicant Details</dt>
						    <dt>Reject Resons &nbsp;&nbsp; : &nbsp;&nbsp; <?php echo $reject_resons; ?></dt>
						    <?php
				
						    $reqanswr=$recruiter."0".$ref_no;
						    $string = str_replace(' ','',$reqanswr);
						    ?>
						    <dd style="font-size:13px;font-weight:bold;" >Ref.No &nbsp;:&nbsp; <?php echo $string; ?></dd>
							<dd style="font-size:13px;font-weight:bold;" >First Name &nbsp;:&nbsp; <input type="text"  name="title" value="<?php echo isset($ftitle) ? $ftitle : '' ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Last Name &nbsp;:&nbsp;<input type="text" class="" name="lastname" value="<?php echo isset($last_name) ? $last_name : '' ?>"> </dd>
							<dd style="font-size:13px;font-weight:bold;" >Phone Number &nbsp;:&nbsp; <input type="text" class="" name="phonenumber" value="<?php echo isset($phonenumber) ? $phonenumber : '' ?>"></dd>
							<dd style="font-size:13px;font-weight:bold;" >Email &nbsp;:&nbsp; <input type="text" class="" name="email" value="<?php echo isset($email) ? $email: '' ?>"></dd>
					    	<input type="hidden" name="logid" value="<?php echo isset($user_id) ? $user_id: '' ?>">
					         <input type="hidden" name="recruiter" value="<?php echo isset($recruiter) ? $recruiter: '' ?>">
					  <!--TAGS STYLE SHEETS-->
                    			 <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
                                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
                                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css" />
                                  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
                                  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
					<!--END TAGS STYLE SHEETS-->
						    <dd style="font-size:13px;font-weight:bold;" >Skills &nbsp;:&nbsp; <input type="text" class="tag-container" name="tag" data-role="tagsinput" value="<?php echo isset($tag) ? $tag : '' ?>"></dd>
						    <dd style="font-size:13px;font-weight:bold;" >Position &nbsp;:&nbsp; <input type="text" class="tag-container" name="position" data-role="tagsinput" value="<?php echo isset($position) ? $position : '' ?>"></dd>
						    <dd style="font-size:13px;font-weight:bold;" >Industry &nbsp;:&nbsp; <input type="text" class="tag-container" name="industry" data-role="tagsinput" value="<?php echo isset($industry) ? $industry : '' ?>"></dd>
							<dd style="font-size:13px;font-weight:bold;" >Summary &nbsp;:&nbsp; <textarea name="description" id="" cols="50" rows="2" class="">
								
								<?php echo isset($description) ? $description : '' ?>
								
							</textarea></dd>
				            <dd>
				        	<div id="f-inputs" class="d-none"></div> 
				        	
			<div class="callout callout-info">
            <div id="actions" class="row">
              <div class="col-lg-6">
                <div class="btn-group w-100" id="upload_btns">
                  <span class="btn btn-success btn-flat col-sm-4 col fileinput-button dz-clickable">
                    <i class="fas fa-plus"></i>
                    <span>Add files</span>
                  </span>
                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center">
                <div class="fileupload-process w-100">
                  <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table table-striped files" id="previews">
              <div id="template" class="row mt-2">
                <div class="col-auto">
                    <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                </div>
                <div class="col d-flex align-items-center">
                    <p class="mb-0">
                      <span class="lead" data-dz-name></span>
                      (<span data-dz-size></span>)
                    </p>
                    <strong class="error text-danger" data-dz-errormessage></strong>
                </div>
                <div class="col-4 d-flex align-items-center">
                    <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                </div>
                <div class="col-auto d-flex align-items-center">
                  <div class="btn-group">
                  	  <button class="btn btn-primary start d-none">
                      <i class="fas fa-upload"></i>
                      <span>Start</span>
                    </button>
                    <button  class="btn btn-danger delete">
                      <i class="fas fa-trash"></i>
                      <span>Delete</span>
                    </button>
                  </div>
                </div>
              </div>
              <div id="default-preview">
          <?php
            if(isset($file_json) && !empty($file_json)){
              foreach(json_decode($file_json) as $k => $v){
                if(is_file('assets/uploads/'.$v)){
                $_f = file_get_contents('assets/uploads/'.$v);
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
            </div>
            </div>
          </div>
				            </dd>
				
						<dd><button class="btn btn-flat  btn-primary mx-2" form="manage-upload">Re-Upload</button></dd>
						</dl>
						</form>
						
<script> 

 $(document).ready(function(){
      $('.check_phoenumber').keyup(function(e){
          var phonenumber = $('.check_phoenumber').val();
          $.ajax({
              type:"POST",
              url:"check_mail.php",
              data:{
                  "check_submit_btn": 1,
                  "email_id":phonenumber,
              },
              success: function(response){
                 $('.error_email').text(response);
              }
          });
      });
  }); 
  
  $('#default-preview .delete').click(function(){
      var uuid = $(this).attr('data-uuid');
      var _this = $(this)
      start_load()
      if($('.inp-file[data-uuid="'+uuid+'"]').length > 0){
          var fname = $('.inp-file[data-uuid="'+uuid+'"]').val()
          $.ajax({
            url:'ajax.php?action=remove_file',
            method:'POST',
            data:{fname:fname},
            success:function(resp){
              if(resp == 1){
                $('.inp-file[data-uuid="'+uuid+'"]').remove()
                _this.closest('.def-item').remove()
                end_load()
                
              }
            }
          })
        }
  })
$(function () {

  Dropzone.autoDiscover = false;
  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "ajax.php?action=upload_file", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    acceptedFiles:'application/pdf',
    autoQueue: true, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  });

  myDropzone.on("addedfile", function(file) {
		    document.querySelector("#total-progress .progress-bar").style.width = "0%";
    setTimeout(function(){
    myDropzone.enqueueFile(file);
    },500)
    file.previewElement.querySelector(".delete").onclick = function() { 
		start_load()
    		if($('.inp-file[data-uuid="'+file.upload.uuid+'"]').length > 0){
    			var fname = $('.inp-file[data-uuid="'+file.upload.uuid+'"]').val()
    			$.ajax({
    				url:'ajax.php?action=remove_file',
    				method:'POST',
    				data:{fname:fname},
    				success:function(resp){
    					if(resp == 1){
    						$('.inp-file[data-uuid="'+file.upload.uuid+'"]').remove()
    						end_load()
    						myDropzone.removeFile(file);
    					}
    				}
    			})
    		}
    	 };
    myDropzone.on("error",function(resp){
  })
      myDropzone.on("totaluploadprogress", function(progress) {
  	console.log(progress)
		    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
		  });
  });

 

  myDropzone.on("sending", function(file) {
    document.querySelector("#total-progress").style.opacity = "1";
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
    
  });
  myDropzone.on("success",function(file,resp){
  	if(resp){
  		resp = JSON.parse(resp)
  		if(resp.status == 1){
  			var inp = $('<input type="hidden" class="inp-file" name="fname[]" value="'+resp.fname+'" data-uuid="'+file.upload.uuid+'">')
  			$('#f-inputs').append(inp)
  		}
  	}
  })
 
  })

	$('#manage-upload').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=rejectssave_reupload',
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
						location.href = 'index.php?page=editreject_document&id=<?php echo $id ?>'
					},2000)
				}
			}
		})
	})
</script>
					</div>
				</div>
	</div>

	<div class="row">
		<div class="col-lg-9">
			<div class="card card-outline card-info">
				<div class="card-header">
					<div class="card-tools">
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
                            
                            
                            <td>
                                	
			  <?php if($_SESSION['login_type'] == 1){?>
			 <div class="">
				<div class="">
                   <?php
                    $id=html_entity_decode($id);
                    $st=html_entity_decode($status);
                            echo'
                            <div class=row>
                            <div class="col-2"><p><a href ="status.php?d_id='.$id.'&status=1" class="btn btn-success"><i style=" font-size:20px;"   class="fa fa-check" aria-hidden="true"></i></a></p></div>
                            <div class="col-2">&nbsp; </div>
                            <div class="col-2"><p><a href ="document_reject.php?d_id='.$id.'&status=2" class="btn btn-danger"><i style="font-size:20px;"  class="fa fa-times" aria-hidden="true"></i></a></p></div>
                            </div>';
                   
            
                       
                    ?>
                </div>
                </div>
        
                <?php }elseif($_SESSION['login_type'] == 3){ ?>
              <div class="">
				<div class="">
                   <?php
                    $id=html_entity_decode($id);
                    $st=html_entity_decode($status);
                            echo'
                            <div class=row>
                            <div class="col-2"><p><a href ="status.php?d_id='.$id.'&status=1" class="btn btn-success"><i style=" font-size:20px;"   class="fa fa-check" aria-hidden="true"></i></a></p></div>
                            <div class="col-2">&nbsp; </div>
                            <div class="col-2"><p><a href ="document_reject.php?d_id='.$id.'&status=2" class="btn btn-danger"><i style="font-size:20px;"  class="fa fa-times" aria-hidden="true"></i></a></p></div>
                            </div>';
                   
            
                       
                    ?>
                </div>
                </div>
                <?php } ?>
                                
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>
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
								<a href="assets/uploads/<?php echo $v ?>" target="_blank" class="">
			                   <i style="color:#007bff; font-size:30px;" class="fa fa-download"></i>
			                   </a>
							</div>
							 <?php }?>
					         <?php } ?>
					         <?php } ?>
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
		<div class="col-lg-3">
			  <div class="card card-outline card-primary">
		        <div class="card-header">
					<h4 style="text-align:center;"><b>COMMENT SECTION</b></h4>
				</div>
		        <div class="card-body">
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
							<dt>Comment</dt>
							<dd><textarea name="comment" id="comment" cols="5" required rows="3" class=" form-control">
							</textarea></dd>
							
						</dl>
						<div class="d-flex w-100 justify-content-center align-items-center">
                                        <button class="btn btn-flat  bg-gradient-primary mx-2" form="comment-upload">Save</button>
                                    </div>
						
					</div>
				
		        	     </div>
		        	 </form>
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
</div>
<script>
  
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























































































