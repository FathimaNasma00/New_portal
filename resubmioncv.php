<?php
include 'lkcareers_con.php';
error_reporting(E_ERROR | E_PARSE);
$qry = $con->query("SELECT * FROM cv_documation where id = '{$_GET['rsubid']}' ")->fetch_array();
foreach($qry as $k => $v){
	if($k == 'first_name')
		$k = 'ffirst_name';
	$$k = $v;
}
?>
  <main>

    <div class="pagetitle">
      <h1>RE SUBMITE Documents</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Documents</li>
          <li class="breadcrumb-item active">Add CV</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <style>
        .required{
            display: inline-block;
    margin-right: 4px;
    color: #e93e3e;
    font-size: 16px;
    font-family: SimSun,sans-serif;
    line-height: 1;
    content: "*";
        }
        .card .card-body{background:;#f6f9ff;}
    </style>
    <section class="section">
         <div class="col-md-12">
      <div class="row ">
        <div class="d-flex justify-content-center ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Documents</h5>

		
			<form action="" id="manage-upload" autocomplete="off">

        
         <?php
                                include 'db_connect.php';
                                error_reporting(E_ALL ^ E_NOTICE && E_WARNING); 
                                
               
                                $query2 = "SELECT COUNT(*) as ids from `documents` WHERE user_id='{$_SESSION['login_id']}' order by id desc limit 1";
                                $result2 = mysqli_query($conn,$query2);
                                $row = mysqli_fetch_array($result2);
                                
                               
                                 $next_auto_inc =$row['ids'] + 1;
                                
                            ?>
                        <input type="hidden" class="form-control form-control-sm" id="id"  name="refno" value="<?php echo $next_auto_inc; ?>" readonly>


				<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						     <label for="inputText" class="form-label"><span class="required">*</span> First Name</label>
							<input type="text" class="form-control form-control-sm" required name="title" value="<?php echo isset($ffirst_name) ? $ffirst_name : '' ?>">
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label"><span class="required">*</span> Last Name</label>
							<input type="text" class="form-control form-control-sm" name="lastname" value="<?php echo isset($last_name) ? $last_name: '' ?>">
						</div>
					</div>
				</div>
				
				<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						     <label for="inputText" class="form-label"><span class="required">*</span> Phone Number</label>
							<input type="tel" class="form-control form-control-sm check_phoenumber" maxlength="14" name="phonenumber" required  value="<?php echo isset($phone_number) ? $phone_number: '' ?>">
							<small class="error_email" style="color:red;"></small>
							<div class="error_message"  style="color:red;"></div>
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
				
				<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						       <label for="inputText" class="form-label"><span class="required">*</span>Email</label>
							<input type="text" class="form-control form-control-sm email" required name="email" value="<?php echo isset($email) ? $email : '' ?>">
								<small class="error_emaills" style="color:red;"></small>
								<div class="error_message"  style="color:red;"></div>

								
								
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
				
				<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label"><span class="required">*</span>Skills</label><br/>
							<input type="text" class="form-control form-control-sm tag-container" required name="tag" data-role="tagsinput"  >
						</div>
					</div>
				</div>
				
				<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label"><span class="required">*</span>Position</label><br/>
							<input type="text" class="form-control form-control-sm tag-container" required name="position" data-role="tagsinput"  >
						</div>
					</div>
				</div>
				
				<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label"><span class="required">*</span>Industry</label><br/>
							<input type="text" class="form-control form-control-sm tag-container" required  name="industry" data-role="tagsinput" >
						</div>
					</div>
				</div>
				
				
				<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						     <label for="inputText" class="form-label">Candidate Summary</label>
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

		<div class="row mb-3">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="inputText" class="form-label">CV</label>
            <?php if (isset($resume_path) && !empty($resume_path)) : ?>
                <input type="file" id="cvFileInput" name="file" value="$resume_path" style="display: none;">
                <label for="cvFileInput" id="cvFileLabel">
                    <span>Selected File: <?php echo basename($resume_path); ?></span>
                    <span>(<a href="https://lkcareers.lk/cvfiles/<?php echo basename($resume_path); ?>" target="_blank">Preview</a>)</span>
                </label>
            <?php else : ?>
                <span>No CV uploaded</span>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('cvFileInput').addEventListener('change', function (event) {
        var fileName = event.target.files[0].name;
        document.getElementById('cvFileLabel').innerHTML = '<span>Selected File: ' + fileName + '</span>';
    });
</script>



        </form>
    	
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    		    <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button>
    			<button class="btn btn-flat  btn btn-primary mx-2 submit_btn" form="manage-upload" id="uploadBtn">Upload</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" >Cancel</button>
    			
    		</div>
    	</div>
    	</div>
    	</div>
    	</div>
    	</div>
    	</div>
	

</section>
</main>
<script> 

$(document).ready(function(){
    $('.check_phoenumber, .email').keyup(function(e){
        var phonenumber = $('.check_phoenumber').val();
        var email = $('.email').val();
        $.ajax({
            type: "POST",
            url: "check_mail.php",
            data: {
                "check_submit_btn": 1,
                "phonenumber": phonenumber,
                "email": email,
            },
            success: function(response){
                if (response.trim() !== "") {
                    $('.error_message').text(response); // Show the error message
                    $('.submit_btn').prop('disabled', true); // Disable the submit button
                } else {
                    $('.error_message').text(""); // Clear the error message
                    $('.submit_btn').prop('disabled', false); // Enable the submit button
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Error:", errorThrown); // Log any errors to the console
            }
        });
    });
});


 $('#uploadBtn').click(function (e) {
    e.preventDefault(); // Prevent the default form submission
    var filePath = "https://lkcareers.lk/cvfiles/<?php echo basename($resume_path); ?>";

    $.ajax({
        url: "ajax.php?action=upload_file",
        type: "POST",
        data: { file_path: filePath },
        success: function (resp) {
            console.log(resp);
            // After successful file upload, submit the form
            $('#manage-upload').submit();
        },
        error: function (error) {
            console.error(error);
        }
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
  
  $('#manage-upload').submit(function (e) {
    e.preventDefault();
    start_load();
    $.ajax({
        url: 'ajax.php?action=save_upload',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function (resp) {
            if (resp == 1) {
                alert_toast('Data successfully saved', "success");
                setTimeout(function () {
                    location.href = 'index2.php?page=document_list';
                }, 2000);
            }
            end_load(); // Add this line to end the loading animation
        }
    });
});


</script>