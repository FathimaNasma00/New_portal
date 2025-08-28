<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE); 
    include "db_connect.php";
	session_start();
  if(!isset($_SESSION["login_id"])){
    header("location:./login.php");
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>
<?php 
	include 'header.php' 
?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <?php include 'topbar.php' ?>
  <?php include 'sidebar.php' ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	 <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
	    <div class="toast-body text-white">
	    </div>
	  </div>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
        <div class="card-tools">
            	<button class="btn btn-flat btn-sm bg-gradient-success btn-success" id="print"><i class="fa fa-print"></i> Print</button>
            </div>
        </div><!-- /.row -->
            <hr class="border-primary">
           <?php
                    date_default_timezone_set("Asia/colombo");
                    $date = date("Y-m-d");
    
                 if(isset($_GET['generate_report'])){
                        $empID = $_GET['employeeid'];
                        $frmDate = $_GET['frmDate'];
                        $toDate = $_GET['toDate'];
                        $statuss = [];
                        $statuss= $_GET['status'];
                        foreach($statuss as $status)
                        {
  
        
                    $qry = "SELECT COUNT(`id`) as DOCS FROM `documents` WHERE documents.`date` BETWEEN '$frmDate' AND '$toDate' AND documents.user_id='$empID' AND documents.`status` IN($status)
                          ";
                        }

                            $qry_run= mysqli_query($conn,$qry);
                            if(mysqli_num_rows($qry_run)>0)
                            {
                                foreach($qry_run as $row)
                                {
                                ?>
                                <div>
                                    Date From : <b><?php echo $frmDate; ?></b> To : <b><?php echo $toDate; ?></b>
                                
                                    <form action="generatepdf.php" method="get">
							         <input type="hidden" class="form-control form-control-sm" name="employeeid" value="<?php echo $empID; ?>">
							         <input type="hidden" class="form-control form-control-sm" name="frmDate" value="<?php echo $frmDate; ?>">
							         <input type="hidden" class="form-control form-control-sm" name="toDate" value="<?php echo $toDate; ?>">
                                        <?php
                                         $statuss = [];
                                        $statuss= $_GET['status'];
                                        foreach($statuss as $status)
                                        {
                                        ?>
							         <input type="hidden" class="form-control form-control-sm" name="status[]" value="<?php echo $status; ?>">
                                        <?php } ?>
                                    </form>
                                </div>
                
                        
                     <?php
                                }
                            }else{
                                echo"NO RECORD FOUND";
                            }
                    }
                                          

    
                        ?>

                  
      </div><!-- /.container-fluid -->
    </div>
<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-body table-responsive" id="printable">
			<table class="table tabe-hover table-bordered" >
			<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Name</th>
						<th>Status</th>
					     <?php if($_SESSION['login_type'] == 1 ){ ?>
					     <th>Date</th>
						<th>Upload by</th>
					    <?php } ?>
						
					</tr>
				</thead>
				<tbody>
                    
                    
					<?php
                        $i = 1;
                           if($_SESSION['login_type'] == 1 ){
					$user = $conn->query("SELECT * FROM users where id in (SELECT user_id FROM documents) ");
					while($row = $user->fetch_assoc()){
						$uname[$row['id']] = ucwords($row['firstname'].', '.$row['lastname']);
					}
                    }else{
						$where = " where user_id = '{$_SESSION['login_id']}' ";
                    }
                    
                        if(isset($_GET['generate_report'])){
                        $empID = $_GET['employeeid'];
                        $frmDate = $_GET['frmDate'];
                        $toDate = $_GET['toDate'];
                            $statuss = [];
                         $statuss= $_GET['status'];
                        foreach($statuss as $status)
                        {

                         $qry = "SELECT documents.`id`,documents. `title`, documents.`last_name`,documents. `phonenumber`, documents.`job`, documents.`tag`, documents.`description`, documents.`file_json`, documents.`user_id`, documents.`date`, documents.`recruiter`, documents.`date_created`, documents.`status`,concat(users.firstname,', ',users.middlename,' ',users.lastname) as name FROM `documents` INNER JOIN users ON (`documents`.`user_id` = `users`.`id`)  WHERE documents.`date` BETWEEN '$frmDate' AND '$toDate' AND documents.user_id='$empID'  AND documents.`status` IN($status) 
                          ";
                           
                       
                            $qry_run= mysqli_query($conn,$qry);
                            if(mysqli_num_rows($qry_run)>0)
                            {
                                foreach($qry_run as $row)
                                {
                                ?>
                               
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['title']) ?><?php echo ucwords($row['last_name']) ?></b></td>
						<td><b>
                            <?php 
    
                        	if($row['status'] == 1){
						  		echo "<span class='badge badge-success'>APPROVED</span>";
                        	}elseif($row['status'] == 0){
						  		echo "<span class='badge badge-danger'>PENDING</span>";
                        	}elseif($row['status'] == 2){
						  		echo "<span class='badge badge-danger'>REJECT</span>";
                        	}
                        	?></b>
						</td>

						  <?php if($_SESSION['login_type'] == 1 ){ ?>
				        <td><b><?php echo ucwords($row['date']) ?></b></td>
						 <td><?php echo  $uname[$row['user_id']]  ?></td>
						
					    <?php } ?>
					
					</tr>
                  	 
                                <?php
                                }
                            }else{
                                echo"NO RECORD FOUND";
                            }
                    }
                             }
    
                        ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<!-- Bootstrap -->
<?php include 'footer.php' ?>
</body>
</html>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.delete_document').click(function(){
	_conf("Are you sure to delete this document?","delete_document",[$(this).attr('data-id')])
	})
	})

</script>
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
