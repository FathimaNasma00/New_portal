            

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
      
       <!-- USEING FOR TAGS DETAILS STYLE -->
				 <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css" />
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
<!-- USEING END TAGS DETAILS STYLE-->
      
    <section class="section">
         <div class="col-md-12">
      <div class="row ">
        <div class="d-flex justify-content-center ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Documents</h5>
                                <div class="container">
    <h2 class="my-4 text-center">Candidate Information</h2>
    
    <?php
    include 'db_connect.php';
    if (isset($_GET['ocresponse']) && isset($_GET['file_name'])) {
        $response = urldecode($_GET['ocresponse']);
        $fileName = urldecode($_GET['file_name']);
        $json_response = json_decode($response, true);
        
        if ($json_response === null && json_last_error() !== JSON_ERROR_NONE) {
            echo '<div class="alert alert-danger">Invalid JSON response: ' . htmlspecialchars($response) . '</div>';
        } else {
            $data = $json_response['data'][0]; 
            echo '<form action="" id="manage-upload" autocomplete="off" enctype="multipart/form-data" method="post">';
            
            error_reporting(E_ALL ^ E_NOTICE && E_WARNING);

            $query2 = "SELECT COUNT(*) as ids FROM `documents` WHERE user_id='{$_SESSION['login_id']}' ORDER BY id DESC LIMIT 1";
            $result2 = mysqli_query($conn, $query2);
            $row = mysqli_fetch_array($result2);
            $next_auto_inc = $row['ids'] + 1;
            echo '<input type="hidden" class="form-control form-control-sm" name="refno" value="' . htmlspecialchars($next_auto_inc) . '" readonly>';
            
            
            $qry = $conn->query("SELECT * FROM users where id = '{$_SESSION['login_id']}' ")->fetch_array();
            foreach ($qry as $k => $v) {
                if ($k == 'recruiter') {
                    $k = 'rrecruiter';
                }
                $$k = $v;
            }
            echo '<input type="hidden" class="form-control" id="recruiter" name="recruiter" value="' . htmlspecialchars($rrecruiter) . '">';
    
            // First Name
            echo '<div class="form-group col-sm-11">';
            echo '<label for="firstname" class="form-label">First Name</label>';
            echo '<input type="text" class="form-control" id="firstname" name="firstname" value="' . htmlspecialchars($data['firstname']) . '">';
            echo '</div>';

            // Last Name
            echo '<div class="form-group col-sm-11">';
            echo '<label for="lastname" class="form-label">Last Name</label>';
            echo '<input type="text" class="form-control" id="lastname" name="lastname" value="' . htmlspecialchars($data['lastname']) . '">';
            echo '</div>';
            
            
            // Gender Field (required)
            echo '<div class="form-group col-sm-11">';
            echo '<label for="gender" class="form-label">Gender</label>';
            echo '<div>';
            echo '<input type="radio" id="male" name="gender" value="male" required> Male ';
            echo '<input type="radio" id="female" name="gender" value="female" required> Female';
            echo '</div>';
            echo '</div>';


            // Email
            echo '<div class="form-group col-sm-11">';
            echo '<label for="email" class="form-label">Email</label>';
            echo '<input type="email" class="form-control" id="email" name="email" value="' . htmlspecialchars($data['email']) . '">';
             echo '<small class="error_email" style="color:red;"></small>
                  <div class="error_message"  style="color:red;"></div>';
            echo '</div>';

            // Contact Number
            echo '<div class="form-group col-sm-11">';
            echo '<label for="contact_number" class="form-label">Contact Number</label>';
            echo '<input type="text" class="form-control check_phoenumber" id="contact_number" name="phonenumber" value="' . htmlspecialchars($data['contact_number']) . '">';
            echo '<small class="error_email" style="color:red;"></small>
                  <div class="error_message"  style="color:red;"></div>';
            echo '</div>';

            // Full Home Address
            echo '<div class="form-group col-sm-11">';
            echo '<label for="home_address" class="form-label">Full Home Address</label>';
            echo '<textarea class="form-control" id="home_address" name="home_address">' . htmlspecialchars($data['home_address']) . '</textarea>';
            echo '</div>';

            // Home Town
            echo '<div class="form-group col-sm-11">';
            echo '<label for="home_town" class="form-label">Home Town or City</label>';
            echo '<input type="text" class="form-control" id="home_town" name="home_town" value="' . htmlspecialchars($data['home_town'] ?? '') . '">';
            echo '</div>';

            // Total Years of Experience
            echo '<div class="form-group col-sm-11">';
            echo '<label for="total_years_of_experience" class="form-label">Total Years of Experience</label>';
            echo '<input type="text" class="form-control" id="years_of_experience" name="years_of_experience" value="' . htmlspecialchars($data['total_years_of_experience']) . '">';
            echo '</div>';

            // Education
            echo '<div class="form-group col-sm-11">';
            echo '<label for="education" class="form-label">Education</label>';
            $education = is_array($data['education']) ? $data['education'] : explode(', ', $data['education'] ?? '');
            echo '<textarea class="form-control" id="experience" name="education" rows="5">' .  implode(', ', $education) . '</textarea>';
            echo '</div>';

            // LinkedIn Link
            echo '<div class="form-group col-sm-11">';
            echo '<label for="LinkedIn_link" class="form-label">LinkedIn Link</label>';
            $baseURL = "https://www.linkedin.com/in/";
            $rawLink = $data['LinkedIn_link'];

            // Remove unwanted prefixes
            $cleanedLink = preg_replace("#^https?://(www\.)?linkedin\.com/in/#", "", $rawLink);
            $cleanedLink = preg_replace("#^www\.linkedin\.com/in/#", "", $cleanedLink);

            // Ensure final link structure
            $finalLink = $baseURL . $cleanedLink;
            echo '<input type="text" class="form-control" id="LinkedIn_link" name="linkedIn_link" value="' . htmlspecialchars($finalLink, ENT_QUOTES) . '">';
            echo '</div>';
            
            // Experience
            echo '<div class="form-group col-sm-11">';
            echo '<label for="experience" class="form-label">Experience</label>';
            echo '<textarea class="form-control" id="experience" name="experience" rows="6">' . htmlspecialchars($data['experience']) . '</textarea>';
            echo '</div>';

             // Industry Experience
            echo '<div class="form-group col-sm-11">';
            echo '<label for="industry_experience" class="form-label">Industry</label>';
            echo '<input type="text" class="form-control form-control-sm tag-container" name="industry" data-role="tagsinput"  value="' . implode(', ', (array)($data['industry'] ?? [])) . '">';
            echo '</div>';

            
            // Skills
            echo '<div class="form-group col-sm-11">';
            echo '<label for="skills" class="form-label">Skills</label>';
             echo '<input type="text" class="form-control form-control-sm tag-container" name="tag" data-role="tagsinput"  value="' . implode(', ', $data['skills'] ?? '')  . '">';
            echo '</div>';

            // Positions
            echo '<div class="form-group col-sm-11">';
            echo '<label for="positions" class="form-label">Positions</label>';
             echo '<input type="text" class="form-control form-control-sm tag-container" name="position" data-role="tagsinput"  value="' .  implode(', ', (array)($data['positions'] ?? [])) . '">';
            echo '</div>';
            
            // Experience
            echo '<div class="form-group col-sm-11">';
            echo '<label for="experience" class="form-label">Summary</label>';
            echo '<textarea class="form-control" id="description" name="description" rows="8">' . htmlspecialchars($data['summary']) . '</textarea>';
            echo '</div>';
            
            echo '<input class="form-group col-sm-11" type="hidden" name="fname" value="' . htmlspecialchars($fileName) . '">';
    
           
            //Save Button Section
            echo '<div class=" col-sm-10 card-footer border-top border-info">';
            echo '<div class="d-flex justify-content-center align-items-center">';
            echo '<button onclick="history.go(-1);" class="btn btn-primary">Back</button>';
            echo '<input type="submit" class="btn btn-primary mx-2 submit_btn" value="Upload">';
            echo '<button class="btn btn-secondary mx-2" type="button">Cancel</button>';
            echo '</div></div>';

            echo '</form>';
        }
    } else {
        echo '<div class="alert alert-warning">No response received.</div>';
    }
    ?>
</div>
		
  	     </div>
    	</div>
    	</div>
    	</div>
    	</div>
	

</section>
</main>


	<script>
				    var userName = document.querySelector('.check_phoenumber');

                        userName.addEventListener('input', restrictNumber);
                        function restrictNumber (e) {  
                          var newValue = this.value.replace(new RegExp(/[^/+/0-9]/g, ''), ""); 
                          this.value = newValue;
                        }
   </script>
   <script>
				    var email = document.querySelector('.email');

                   
                    
				</script>
<script>
$(document).ready(function () {
    function validateInputs() {
        var phonenumber = $('#contact_number').val();
        var email = $('#email').val();
        
        $.ajax({
            type: "POST",
            url: "check_mail.php",
            data: {
                "check_submit_btn": 1,
                "phonenumber": phonenumber,
                "email": email,
            },
            success: function (response) {
                if (response.trim() !== "") {
                    $('.error_message').text(response); // Show the error message
                    $('.submit_btn').prop('disabled', true); // Disable the submit button
                } else {
                    $('.error_message').text(""); // Clear the error message
                    $('.submit_btn').prop('disabled', false); // Enable the submit button
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Error:", errorThrown); // Log any errors to the console
            }
        });
    }

    // Validate on form load
    validateInputs();

    // Validate on input change
    $('#contact_number, #email').change(function () {
        validateInputs();
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

    // Build the data string
    $data = " ref_no ='$docsz' ";
    $data .= ", title ='$firstname' ";
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
    $data .= ", file_json ='".json_encode([$fname])."' ";
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


