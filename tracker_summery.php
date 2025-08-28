<?php
error_reporting(E_ALL ^ E_NOTICE);  
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

        </div><!-- /.row -->
            <hr class="border-primary">
      </div><!-- /.container-fluid -->
    </div>
<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
		    <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=timetracker"><i class="fa fa-plus"></i> Add New Time Tracker</a>
			</div>
		</div>
		<div class="card-body">
		<form action="tracker_summery.php" method="GET">
        <div class="row">
           <div class="col-md-4">
               <div class="form-group">
                   <label for="">From date</label>
                   <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){echo $_GET['from_date'];}else{} ?>" class="form-control" placeholder="From date">
               </div>
           </div>
            <div class="col-md-4">
               <div class="form-group">
                   <label for="">To date</label>
                   <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){echo $_GET['to_date'];}else{} ?>"  class="form-control" placeholder="To date">
               </div>
           </div>
            <div class="col-md-2">
               <div class="form-group">
                   <label for="">TASK</label>
                   	<select name="task" class="custom-select custom-select-sm">
								<option value="<?php if(isset($_GET['task'])){echo $_GET['task'];}else{} ?>"><?php if(isset($_GET['task'])){echo $_GET['task'];}else{} ?></option>
                                <option value="ScreeningInterviews" <?php echo isset($task) && $task == "ScreeningInterviews" ? 'selected' : '' ?>>Screening Interviews</option>
                                 <option value="LikdineMessages" <?php echo isset($task) && $task == "LikdineMessages" ? 'selected' : '' ?>>Likdine Messages</option>
                                  <option value="Cvsuploaded" <?php echo isset($task) && $task == "Cvsuploaded" ? 'selected' : '' ?>>Cvs uploaded</option>
                                  <option value="CvsShortlisted" <?php echo isset($task) && $task == "CvsShortlisted" ? 'selected' : '' ?>>Cvs Shortlisted</option>
                                  <option value="Other"<?php echo isset($task) && $task == "Other" ? 'selected' : '' ?> >Other</option>>
                    </select>
               </div>
           </div>
           
        <div class="col-md-2">
               <div class="form-group">
                   <label for="">Check</label>
                   <button type="submit" class="btn btn-primary form-control">Fillter</button>
               </div>
           </div>
            
        </div>
		    
		</form>
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Name</th>
						<th>Task</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Count</th>
						<th>Type</th>
						<th>Recruiter</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
                        $i = 1;
                        if(isset($_GET['from_date']) && isset($_GET['to_date']) && isset($_GET['task']))
                        {
                            $fromdate=$_GET['from_date'];
                            $todate=$_GET['to_date'];
                            $task=$_GET['task'];
                            $qry = "SELECT timetracker.`id`, 
                                        timetracker.`log_id`, 
                                        timetracker.`recruiter`,
                                        timetracker.`task`, 
                                        timetracker.`starttime`, 
                                        timetracker.`endtime`,
                                        timetracker.`count`, 
                                        timetracker.`types`, 
                                        timetracker.`description`,
                                        timetracker.`date`, 
                                        timetracker.`action_date`, 
                                        timetracker.`user_id`,
                                        concat(users.firstname,', ',users.middlename,' ',users.lastname) as name
                                        FROM `timetracker`
                                        INNER JOIN users
                                        ON (`timetracker`.`user_id` = `users`.`id`) 
                                       WHERE date BETWEEN '$fromdate' AND '$todate' AND task='$task'
                                        order by id asc";
                            $qry_run= mysqli_query($conn,$qry);
                            if(mysqli_num_rows($qry_run)>0)
                            {
                                foreach($qry_run as $row)
                                {
                                ?>
                                	<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><?php echo $row['name']; ?></td>
						<td><b><?php echo $row['task']; ?></b></td>
						<td><b><?php echo $row['starttime']; ?></b></td>
						<td><b><?php echo $row['endtime']; ?></b></td>
						<td><b><?php echo $row['count']; ?></b></td>
						<td><b><?php echo $row['types'];?></b></td>
						<td><b><?php echo $row['recruiter'];?></b></td>
						<td><b><?php echo $row['date']; ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_tracker" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edite_timetecher&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_tracker" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                    </div>
						</td>
					</tr>
                                <?php
                                }
                            }else{
                                echo"NO RECORD FOUND";
                            }
                        }
    
                        ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
 <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
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
	$('.view_tracker').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Tracker Details","view_trackerdet.php?id="+$(this).attr('data-id'))
	})
	$('.delete_tracker').click(function(){
	_conf("Are you sure to delete this data?","delete_tracker",[$(this).attr('data-id')])
	})
	})
	function delete_tracker($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_tracker',
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
