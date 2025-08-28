            

  <main>

    <div class="pagetitle">
      <h1>Documents</h1>
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

		
<form action="" id="manage-upload" autocomplete="off" enctype="multipart/form-data" method="post">
    
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
							<input type="text" class="form-control form-control-sm" required name="title" value="<?php echo isset($ftitle) ? $ftitle : '' ?>">
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label"><span class="required">*</span> Last Name</label>
							<input type="text" class="form-control form-control-sm" name="lastname" value="<?php echo isset($last_name) ? $last_name : '' ?>">
						</div>
					</div>
				</div>
				
				<div class="row mb-3">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="inputText" class="form-label"><span class="required">*</span> Gender</label>
                            <div class="d-flex align-items-center gap-3">
                                <label class="d-flex align-items-center">
                                    <input type="radio" class="custom-radio" id="male" name="gender" value="male" required>
                                    <span class="ms-2">Male</span>
                                </label>
                                <label class="d-flex align-items-center">
                                    <input type="radio" class="custom-radio" id="female" name="gender" value="female" required>
                                    <span class="ms-2">Female</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <style>
                    .custom-radio {
                        width: 16px;
                        height: 16px;
                        appearance: none;
                        background-color: #fff;
                        border: 2px solid #000;
                        border-radius: 50%;
                        display: inline-block;
                        position: relative;
                        cursor: pointer;
                        outline: none;
                    }
                
                    .custom-radio:checked {
                        background-color: #000;
                    }
                </style>
                
                				
				<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						     <label for="inputText" class="form-label"><span class="required">*</span> Phone Number</label>
							<input type="tel" class="form-control form-control-sm check_phoenumber" maxlength="14" name="phonenumber" required  value="<?php echo isset($phonenumber) ? $phonenumber: '' ?>">
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
				
					<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label">Home Address </label>
						    <textarea class="form-control" id="home_address" name="home_address"></textarea>
						    
						</div>
					</div>
				  </div>
				  
				  	<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label">Home Town or City </label>
						    <textarea class="form-control" id="home_address" name="home_address"></textarea>
						    
						</div>
					</div>
				  </div>
				  
				  	<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label">Total Years of Experience </label>
						    <input type="text" class="form-control" id="years_of_experience" name="years_of_experience">
						    
						</div>
					</div>
				  </div>
				  
				  	<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label">Education  </label>
						     <textarea class="form-control" id="education" name="education" rows="5"> </textarea>
						    
						</div>
					</div>
				  </div>
				  
				  <div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label">LinkedIn Link</label>
						     <textarea class="form-control" id="LinkedIn_link" name="linkedIn_link" rows="5"> </textarea>
						    
						</div>
					</div>
				  </div>
				  
				  
				  	<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label">Experience  </label>
						    <textarea class="form-control" id="experience" name="experience" rows="6"></textarea>
						    
						</div>
					</div>
				  </div>
			
				
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
						    <label for="inputText" class="form-label"><span class="required">*</span>Industry</label><br/>
							<input type="text" class="form-control form-control-sm tag-container" required  name="industry" data-role="tagsinput"  value="<?php echo isset($industry) ? $industry : '' ?>">
						</div>
					</div>
				</div>
				
				<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label"><span class="required">*</span>Skills</label><br/>
							<input type="text" class="form-control form-control-sm tag-container" required name="tag" data-role="tagsinput"  value="<?php echo isset($tag) ? $tag : '' ?>">
						</div>
					</div>
				</div>
				
				<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						    <label for="inputText" class="form-label"><span class="required">*</span>Position</label><br/>
							<input type="text" class="form-control form-control-sm tag-container" required name="position" data-role="tagsinput"  value="<?php echo isset($position) ? $position : '' ?>">
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
	<div class="row mb-3">
					<div class="col-sm-12">
						<div class="form-group">
						     <label for="inputText" class="form-label">Candidate Summary</label>
							<input type ="file" name="fname" id="fname" class=" form-control">
								<?php echo isset($filename) ? $filename: '' ?>
							</textarea>
						</div>
					</div>
				</div>
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
	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    		    <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button>
    			<input type="submit" class="btn btn-flat  btn btn-primary mx-2 submit_btn" value="Upload">
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" >Cancel</button>
    			
    		</div>
    	</div>
 </form>
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
</script>

 <script src=\"//cdn.jsdelivr.net/npm/sweetalert2@11\"></script>
<?php
date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");
$time = date("h:i:sa");
$datetime = date("Y-m-d h:i:sa");

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    $doc = $conn->query("SELECT ref_no FROM `documents` WHERE `recruiter`='$recruiter' ORDER BY `id` DESC LIMIT 1")->fetch_array();
    $docsz = $doc['ref_no'] + 1;

    // File upload handling
    $file = $_FILES['fname'];
    $filename = $file['name'];
    $file_tmp = $file['tmp_name'];
    move_uploaded_file($file_tmp, 'assets/uploads/' . $filename);
    $fname ="[".json_encode($filename)."]";

    // Build the data string
    $data = " ref_no ='$docsz' ";
    $data .= ", title ='$title' ";
    $data .= ", last_name ='$lastname' ";
    $data .= ", gender ='$gender' ";
    $data .= ", phonenumber ='$phonenumber' ";
    $data .= ", email ='$email' ";
    $data .= ", tag ='$tag' ";
    $data .= ", position ='$position' ";
    $data .= ", industry ='$industry' ";
    $data .= ", home_address ='$home_address' ";
    $data .= ", home_town ='$home_town' ";
    $data .= ", years_of_experience ='$years_of_experience' ";
    $data .= ", education ='$education' ";
    $data .= ", linkedIn_link ='$linkedIn_link' ";
    $data .= ", experience ='$experience' ";
    $data .= ", description ='".htmlentities(str_replace("'", "&#x2019;", $description))."' ";
    $data .= ", user_id ='".$_SESSION['login_id']."' ";
    $data .= ", file_json ='$fname' "; // Assuming $fname is already JSON encoded
    $data .= ", status ='0' ";
    $data .= ", recruiter ='$recruiter' ";
    $data .= ", date ='$date' ";
    $data .= ", time ='" . date("H:i:s") . "' ";  
    $data .= ", created_datetime ='" . date("Y-m-d H:i:s") . "' ";

    // Insert data into the database
    $query = "INSERT INTO `documents` SET $data";

    // Execute the query
   if (mysqli_query($conn, $query)) {
        // Success message and redirect
        echo "
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data successfully saved',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.href = 'index2.php?page=document_list';
                });
            </script>"; // Sending '1' as a success response
    } else {
        // Error message
        echo mysqli_error($conn);
    }
}
?>
<script>
    // JavaScript section
    $(document).ready(function () {
        success: function (resp) {
    if (resp == 1) {
        alert_toast('Data successfully saved', 'success');
        setTimeout(function () {
            location.href = 'index2.php?page=document_list';
        }, 2000);
    } else {
        alert_toast('Failed to save data. Server response: ' + resp, 'error');
    }

    // Hide loading spinner or message
    end_load();
}

    });
</script>


