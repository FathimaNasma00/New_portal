<?php
    include "db_connect.php";
	session_start();
  if(!isset($_SESSION["login_id"])){
    header("location:./login.php");
  }
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard -MyCareers</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!--<link href="assets/img/favicon.png" rel="icon">-->
  <!--<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">-->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  
   <!-- jQuery UI 1.11.4 -->
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index2.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">MyCareers</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">0</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
             Soon
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

      
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/user.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">
                <?php
                include "db_connect.php";
                $id=$_SESSION["login_id"];
                $qry = $conn->query("SELECT * ,concat(firstname,', ',lastname,' ',middlename) as name FROM users where id='$id' ");
                  while($row= $qry->fetch_assoc())
                  {
                      echo $row['name'];
                      $name= $row['name'];
                      $recruiter = $row['recruiter'];
                  }
                ?>
                </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $name; ?></h6>
              <span><?php echo $recruiter; ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="ajax.php?action=logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
         <?php include 'sidbar2.php' ?>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">
<main>
  <div class="pagetitle">
      <h1>HUNT</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item"><a href="./index2.php?page=huntz"></a>Hunt</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div>
    <!-- -------------------------------------End Page Title---------------------------------------------------------- -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css" />
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
    
  <style>
  .bootstrap-tagsinput {
   width: 100%;
  }
  </style>
  
  
    
     <div class="col-sm-12">
                 <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <span style="font-size:20px;color:#5bc0de;">Filter&nbsp;<i class="fa fa-filter" aria-hidden="true" style="font-size:20px;color:#5bc0de;"></i></span>
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse col-12" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                         
                         <div class="card">
                             <div class="card-body">
                                 <form action="huttag.php" method="post" class="row" >
                                 <label for="inputName5" class="form-label"></label>
                                <div class="col-2">
                                    <label for="inputText" class="form-label">Recruiter</label>
                                    <select class="form-select" id="floatingSelect"   name="jb_recuiters"  required>
                                        <?php 
                                      	$employees = $conn->query("SELECT *,concat(firstname ,' ', lastname) as name from users ");
                                      	while($row= $employees->fetch_assoc()){
                                      	?>
                                      	<option value="<?php echo $row['id'] ?>" <?php echo isset($jb_recuiters) && in_array($row['name'],explode(',',$jb_recuiters)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                                      	<?php } ?>
                                  </select>
                                    </div>
                                <div class="col-2">
                                    <label for="inputText" class="form-label">Skills</label>
                                    <input type="text" name="skills" class="form-control" id="tags" value="<?php echo isset($_POST['skills']) ? $_POST['skills'] : '' ?>" data-role="tagsinput">
                                    </div>
                                <div class="col-2">
                                    <label for="inputText" class="form-label">Position</label>
                                    <input type="text" name="postion" class="form-control" id="tags" value="<?php echo isset($_POST['postion']) ? $_POST['postion'] : '' ?>"  data-role="tagsinput" >
                                    </div>
                                <div class="col-2">
                                    <label for="inputText" class="form-label">Industry</label>
                                    <input type="text" name="indistry" class="form-control" id="tags" value="<?php echo isset($_POST['indistry']) ? $_POST['indistry'] : '' ?>" data-role="tagsinput" >
                                    </div>
                                <div class="col-2">
                                    <label for="inputText" class="form-label">Start Date</label>
                                    <input type="date" name="stdate" class="form-control" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate'] : '' ?>">
                                    </div>
                                <div class="col-2">
                                    <label for="inputText" class="form-label">End Date</label>
                                    <input type="date" name="enddate" class="form-control" value="<?php echo isset($_POST['enddate']) ? $_POST['enddate'] : '' ?>">
                                    </div>
                                <label for="inputName5" class="form-label"></label>
                                <div class="col-md-2">
            					    <button type="submit" name="submit" class="btn btn-info" style="left:0px;" value="Filter" />Filter&nbsp;<i class="fa fa-filter"></i></button>
            					</div>
                                 </form> 
                             </div>
                         </div>

                    </div>
                  </div>
                </div>
              </div>
     </div>
              
              
              
 
 
 

 <div class="col-sm-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <table class="table table-striped datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ref.No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Skills</th>
                        <th scope="col">Position</th>
                        <th scope="col">Industry</th>
                        <th scope="col">Phone No</th>
                        <th scope="col">Uploaded Date / Time</th>
                      </tr>
                    </thead>
                    <tbody id="post_list">
					<?php
					 if(isset($_POST['submit']))
                    {
                    $name = $_POST["jb_recuiters"];
                    $skills =$_POST["skills"];
                    $possition = $_POST['postion'];
                    $industry = $_POST["indistry"];
                    $stdate = $_POST['stdate'];
                    $endate = $_POST['enddate'];
        
					date_default_timezone_set("Asia/colombo");
					$i = 1;
                    if($name != "" || $skills != "" || $possition != "" || $industry != "" || $stdate != "" || $endate != "")
                     {
					$qry = "SELECT * FROM documents Where status = '1' AND user_id='$name' OR tag = '$skills' OR position = '$possition' OR industry='$industry' OR date >= '$stdate' AND date <= '$endate' order by unix_timestamp(date) desc ";
					$data = mysqli_query($conn, $qry) or die ('error');
					 if(mysqli_num_rows($data) > 0){
			        	while($row = mysqli_fetch_assoc($data)){
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						$desc = strtr(html_entity_decode($row['description']),$trans);
						$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
						if($row['ref_no'] <= 99){
						$recq=$row['recruiter'];
						$reqanswr=$recq."00".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}else{
						 $recq=$row['recruiter'];
						$reqanswr=$recq."0".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						} 
					?>
					<tr>
						<th class="text-center" style="font-size:12px;"><?php echo $i++ ?></th>
						<td> <a  href="./index.php?page=view_documentz&id=<?php echo $row['id']; ?>" target="_blank" ><b style="font-size:14px;"><?php echo $string; ?></b></a></td>
						<td> <a  href="./index.php?page=view_documentz&id=<?php echo $row['id']; ?>" target="_blank" ><b style="font-size:14px;"><?php echo ucwords($row['title']); ?> <?php echo ucwords($row['last_name']); ?></b></a></td>
					
					
						<td><b style="font-size:10px;"><?php echo ucwords($row['tag']); ?></b></td>
						<td><b style="font-size:10px;"><?php echo ucwords($row['position']); ?></b></td>
						<td><b style="font-size:10px;"><?php echo ucwords($row['industry']); ?></b></td>
	                    <td><b style="font-size:14px;"><?php echo ucwords($row['phonenumber']); ?></b></td>
				
				        <td><b style="font-size:14px;"><?php echo ucwords($row['date']); ?> <?php echo ucwords($row['time']); ?></b></td>
					
					</tr>	      
				<?php 
					} 
					}else{
                        echo "ERROR";
                    }
                    
                    }
				    } ?>
				</tbody>
		
                  </table>

                </div>

              </div>
            </div>
            
</main>

</div>

</main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <!--<footer id="footer" class="footer">-->
  <!--  <div class="copyright">-->
  <!--    &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved-->
  <!--  </div>-->
  <!--  <div class="credits">-->
  <!--    Designed by <a href="">BootstrapMade</a>-->
  <!--  </div>-->
  <!--</footer>-->
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.delete_document').click(function(){
	_conf("Are you sure to delete this document?","delete_document",[$(this).attr('data-id')])
	})
	})
	function delete_document($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_file',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <!---------------------------------------------------------------------------->
  <!-- SweetAlert2 -->
<script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="assets/plugins/toastr/toastr.min.js"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- dropzonejs -->
<script src="assets/plugins/dropzone/min/dropzone.min.js"></script>
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
	$(document).ready(function(){
	  $('.select2').select2({
	    placeholder:"Please select here",
	    width: "100%"
	  });
  })
	 window.start_load = function(){
	    $('body').prepend('<div id="preloader2"></div>')
	  }
	  window.end_load = function(){
	    $('#preloader2').fadeOut('fast', function() {
	        $(this).remove();
	      })
	  }
	 window.viewer_modal = function($src = ''){
	    start_load()
	    var t = $src.split('.')
	    t = t[1]
	    if(t =='mp4'){
	      var view = $("<video src='"+$src+"' controls autoplay></video>")
	    }else{
	      var view = $("<img src='"+$src+"' />")
	    }
	    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
	    $('#viewer_modal .modal-content').append(view)
	    $('#viewer_modal').modal({
	            show:true,
	            backdrop:'static',
	            keyboard:false,
	            focus:true
	          })
	          end_load()  

	}
	  window.uni_modal = function($title = '' , $url='',$size=""){
	      start_load()
	      $.ajax({
	          url:$url,
	          error:err=>{
	              console.log()
	              alert("An error occured")
	          },
	          success:function(resp){
	              if(resp){
	                  $('#uni_modal .modal-title').html($title)
	                  $('#uni_modal .modal-body').html(resp)
	                  if($size != ''){
	                      $('#uni_modal .modal-dialog').addClass($size)
	                  }else{
	                      $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
	                  }
	                  $('#uni_modal').modal({
	                    show:true,
	                    backdrop:'static',
	                    keyboard:false,
	                    focus:true
	                  })
	                  end_load()
	              }
	          }
	      })
	  }
	  window._conf = function($msg='',$func='',$params = []){
	     $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
	     $('#confirm_modal .modal-body').html($msg)
	     $('#confirm_modal').modal('show')
	  }
	   
	   window.alert_toast= function($msg = 'TEST',$bg = 'success' ,$pos=''){
	   	var Toast = Swal.mixin({
	      toast: true,
	      position: $pos || 'top-end',
	      showConfirmButton: false,
	      timer: 5000
	    });
	    //   $('#alert_toast').removeClass('bg-success')
	    //   $('#alert_toast').removeClass('bg-danger')
	    //   $('#alert_toast').removeClass('bg-info')
	    //   $('#alert_toast').removeClass('bg-warning')

	    // if($bg == 'success')
	    //   $('#alert_toast').addClass('bg-success')
	    // if($bg == 'danger')
	    //   $('#alert_toast').addClass('bg-danger')
	    // if($bg == 'info')
	    //   $('#alert_toast').addClass('bg-info')
	    // if($bg == 'warning')
	    //   $('#alert_toast').addClass('bg-warning')
	    // $('#alert_toast .toast-body').html($msg)
	    // $('#alert_toast').toast({delay:3000}).toast('show');
	    console.log('TEST')
	      Toast.fire({
	        icon: $bg,
	        title: $msg
	      })
	  }
$(function () {
  bsCustomFileInput.init();

    $('.summernote').summernote({
        height: 300,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    })

  })

</script>
  <!---------------------------------------------------------------------------->

</body>

</html>
