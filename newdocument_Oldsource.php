            
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-upload" autocomplete="off">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
         <?php
                                include 'db_connect.php';
                                error_reporting(E_ALL ^ E_NOTICE && E_WARNING); 
                                
               
                                $query2 = "SELECT COUNT(*) as ids from `documents` WHERE user_id='{$_SESSION['login_id']}' order by id desc limit 1";
                                $result2 = mysqli_query($conn,$query2);
                                $row = mysqli_fetch_array($result2);
                                
                               
                                 $next_auto_inc =$row['ids'] + 1;
                                
                            ?>
                        <input type="hidden" class="form-control form-control-sm" id="id"  name="refno" value="<?php echo $next_auto_inc; ?>" readonly>


				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">First Name</label>
							<input type="text" class="form-control form-control-sm" required name="title" value="<?php echo isset($ftitle) ? $ftitle : '' ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Last Name</label>
							<input type="text" class="form-control form-control-sm" name="lastname" value="<?php echo isset($last_name) ? $last_name : '' ?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Phone Number</label>
							<input type="tel" class="form-control form-control-sm check_phoenumber" maxlength="14" name="phonenumber" required  value="<?php echo isset($phonenumber) ? $phonenumber: '' ?>">
							<small class="error_email" style="color:red;"></small>
						</div>
					</div>
				</div>
				<script>
				    var userName = document.querySelector('.check_phoenumber');

                        userName.addEventListener('input', restrictNumber);
                        function restrictNumber (e) {  
                          var newValue = this.value.replace(new RegExp(/[^/+/0-9]/g, ''), ""); 
                          this.value = newValue;
                        }
				</script>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Email</label>
							<input type="text" class="form-control form-control-sm email" required name="email" value="<?php echo isset($email) ? $email : '' ?>">
								<small class="error_emaills" style="color:red;"></small>
						</div>
					</div>
				</div>
				<script>
				    var email = document.querySelector('.email');

                   
                    
				</script>
			
				
				<!-- USEING FOR TAGS DETAILS STYLE -->
				 <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css" />
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
                  <!-- USEING END TAGS DETAILS STYLE-->
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Skills</label> <br/>
							<input type="text" class="form-control form-control-sm tag-container" required name="tag" data-role="tagsinput"  value="<?php echo isset($tag) ? $tag : '' ?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Position</label> <br/>
							<input type="text" class="form-control form-control-sm tag-container" required name="position" data-role="tagsinput"  value="<?php echo isset($position) ? $position : '' ?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Industry</label> <br/>
							<input type="text" class="form-control form-control-sm tag-container" required  name="industry" data-role="tagsinput"  value="<?php echo isset($industry) ? $industry : '' ?>">
						</div>
					</div>
				</div>
				
				
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							<label for="" class="control-label">Candidate Summary</label>
							<textarea name="description" id="" cols="10" rows="2" class="summernote form-control">
								<?php echo isset($description) ? $description : '' ?>
							</textarea>
						</div>
					</div>
				</div>
				<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM users where id = '{$_SESSION['login_id']}' ")->fetch_array();
foreach($qry as $k => $v){
	if($k == 'recruiter')
		$k = 'rrecruiter';
	$$k = $v;
}
?>
             <input type="hidden" name="recruiter" value="<?php echo $rrecruiter; ?> ">
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
        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    		    <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button>
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-upload">Upload</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" >Cancel</button>
    			
    		</div>
    	</div>
	</div>
</div>
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
  
  $(document).ready(function(){
      $('.email').keyup(function(e){
          var email = $('.email').val();
          $.ajax({
              type:"POST",
              url:"check_mail.php",
              data:{
                  "check_email_btn": 1,
                  "email_id":email,
              },
              success: function(response){
                 $('.error_emaills').text(response);
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
			url:'ajax.php?action=save_upload',
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
						location.href = 'index.php?page=document_list'
					},2000)
				}
			}
		})
	})
</script>
