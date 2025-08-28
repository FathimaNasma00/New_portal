<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>KPI -MyCareers</title>
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
  <main>

    <style>
        .required{
            display: inline-block;
    margin-right: 4px;
    color: #e93e3e;
    font-size: 16px;
    font-family: SimSun,sans-serif;
    line-height: 1;
    content: "*";
        }KPI - 
        .card .card-body{background:;#f6f9ff;}
    </style>
    <section class="section">
        <div class="col-md-12">
      <div class="row ">
        <div class="justify-content-center ">

          <div class="card">
            <div class="card-body">
                <h1> </h1><br>
              <h2 style="text-align:center;"  ><b>KPI - Total Revenue Per/Month</b></h2>
               <div >
               <form action="kpirevenueexport.php" method="post">
                      <?php if (isset($_GET['generate_report'])) {

                      ?>
                      
                      <input type="hidden" name="jb_recuiters" value="<?php echo $_GET['jb_recuiters']; ?>">
                      <input type="hidden" name="st_date" value="<?php echo $_GET['st_date']; ?>">
                      <input type="hidden" name ="end_date" value="<?php echo $_GET['end_date']; ?>">
                      <?php } ?>
                      
  <!-- Other form elements -->

  <div style="text-align: center;">
    <button type="submit" name="export" class="btn btn-flat btn-sm bg-gradient-success btn-success">
      Export&nbsp;<i class="fas fa-file-export"></i>
    </button>
  </div><br>


                  </form>
            </div>
                    
		<div class="card-body table-responsive" id="printable">
			<table class="table tabe-hover table-bordered" >
			  
			<thead>
			    			<?php
include 'db_connect.php';
$i = 1;

if (isset($_GET['generate_report'])) {
    $empID = $_GET['jb_recuiters'];
    $frmDate = $_GET['st_date'];
    $toDate = $_GET['end_date'];

    $qry = "SELECT sale_target.id, sale_target.candidate, sale_target.amount,sale_target.user_id, sale_target.account_manger, sale_target.join_date, sale_target.status,
            documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name
            FROM `sale_target`
            INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
            INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
            INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
            WHERE sale_target.user_id = $empID
            AND sale_target.join_date BETWEEN '$frmDate' AND '$toDate'
            ORDER BY sale_target.id ASC LIMIT 1";

    $qry_run = mysqli_query($conn, $qry);
      if (mysqli_num_rows($qry_run) > 0) {
        while ($row = mysqli_fetch_array($qry_run)) {
            ?>
                <tr><th colspan="5" style="border-bottom: 2px solid black;text-align:center;font-size: 23px;"><b><?php echo $row['name'] ?>'S Total Revenue <?php echo $frmDate; ?> - <?php echo $toDate; ?> </b></th></tr>
           <?php
        }
        
    } else {
        echo "NO RECORD FOUND";
    }
}
?>
					<tr style="background:#6877f5;">
					                    <th style="border-bottom: 2px solid black;border-left: 2px solid black;color:#fff;text-align:center;">No</th>
                						<th style="border-bottom: 2px solid black;color:#fff;text-align:center;">Candidate</th>
                						<th style="border-bottom: 2px solid black;color:#fff;text-align:center;">Client</th>
                						<th style="border-bottom: 2px solid black;color:#fff;text-align:center;">Date of Join</th>
                						<th style="border-bottom: 2px solid black;border-right: 2px solid black;color:#fff;text-align:center;">Amount</th>
						
					</tr>
				</thead>
				<tbody>
                    
				<?php
include 'db_connect.php';
$i = 1;

if (isset($_GET['generate_report'])) {
    $empID = $_GET['jb_recuiters'];
    $frmDate = $_GET['st_date'];
    $toDate = $_GET['end_date'];

    $qry = "SELECT sale_target.id, sale_target.candidate, sale_target.amount,sale_target.user_id, sale_target.account_manger, sale_target.join_date, sale_target.status,
            documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name
            FROM `sale_target`
            INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
            INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
            INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
            WHERE sale_target.user_id = $empID
            AND sale_target.join_date BETWEEN '$frmDate' AND '$toDate'
            ORDER BY sale_target.id ASC";

    $qry_run = mysqli_query($conn, $qry);
    if (mysqli_num_rows($qry_run) > 0) {
        while ($row = mysqli_fetch_array($qry_run)) {
            ?>
            
            <tr style="border: 2px solid black">
                <td><b><?php echo $i++ ;?></b></td>
                <td><b><?php echo ucwords($row['title']) ?> <?php echo ucwords($row['last_name']) ?></b></td>
                <td><b><?php echo $row['clint_name'] ?></b></td>
                <td><b><?php echo $row['join_date'] ?></b></td>
                 <td><b><?php echo "Rs." . number_format($row['amount'], 2) ?></b></td>
            </tr>
            <?php
        }
        
    } else {
        echo "NO RECORD FOUND";
    }

?>

<?php
 $qry = "SELECT sale_target.id, sale_target.candidate, sale_target.amount,sale_target.user_id, sale_target.account_manger, sale_target.join_date, sale_target.status,
            documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name
            ,SUM(sale_target.amount) AS total_amount
            FROM `sale_target`
            INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
            INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
            INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
            WHERE sale_target.user_id = $empID
            AND sale_target.join_date BETWEEN '$frmDate' AND '$toDate'
            ORDER BY sale_target.id ASC";

    $qry_run = mysqli_query($conn, $qry);
    if (mysqli_num_rows($qry_run) > 0) {
        while ($row = mysqli_fetch_array($qry_run)) {
            $amt = $row['total_amount'];
            ?>
 <tr >
                <td colspan="4" style="border-top: 2px solid black;border-bottom: 2px solid black;text-align:center;border-left: 2px solid black;"><b>Total Revenue Per/month</b></td>
                <td style="border: 2px solid black;border-bottom: 2px solid black;">
                    <b>
                    <?php
                    $sum = 0;
                    $sum += $amt;
                    echo "Rs." . number_format($sum, 2);
                    ?>
                    </b>
                </td>
 </tr>
 <?php
        }
        ?>
    
        <?php
    } else {
      
    }
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
    </section>
  </main><!-- End #main -->
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
</body>
  <script>
	$('#print').click(function(){
		start_load()
		var _h = $('head').clone()
		var _p = $('#printable').clone()
		var _d = "<p class='text-center'><b> Report as of (<?php echo $frmDate; ?>) To (<?php echo $toDate; ?>)</b></p>"
		_p.prepend(_d)
		_p.prepend(_h)
		var nw = window.open("","","width=900,height=600")
		nw.document.write(_p.html())
		nw.document.close()
		nw.print()
		setTimeout(function(){
			nw.close()
			end_load()
		},750)
	})
</script>
 