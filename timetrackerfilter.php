<?php
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
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

<div class="col-lg-12">
	<div class="card card-outline card-success">
	    <div class="card-header">
	        	<form action="timetrackerfilter.php" method="post">
	        	    <div class="row">
	        	     <div class="col-md-4">
	        	            <div class="dropdown">
                             <button class="form-control form-control-sm btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Recuiter
                              <span class="caret"></span>
                              </button>
                               <ul class="dropdown-menu col-md-6">
					   <?php
                                include "db_connect.php";

                                $brand_query = " SELECT *,concat(firstname ,' ', lastname) as name from users";
                                $brand_query_run  = mysqli_query($conn, $brand_query);

                                if(mysqli_num_rows($brand_query_run) > 0)
                                {
                                    foreach($brand_query_run as $brandlist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['name']))
                                        {
                                            $checked = $_GET['name'];
                                        }
                                        ?>
                                        
                                       
                                              <li class"col-md-6 form-control form-control-sm ">
                                                  <input type="checkbox" class"col-md-6 form-control form-control-sm " name="name[]" value="<?= $brandlist['id']; ?>" 
                                                    <?php if(in_array($brandlist['id'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $brandlist['name']; ?>
                                              </li>

                     
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "No Users Found";
                                }
                            ?>
                                </ul>
                               </div>
					</div>
					<div class="col-md-3">
					    <input type="date"  class="form-control form-control-sm" name="starttime" value="<?php echo isset($_POST['starttime']) ? $_POST['starttime'] : '' ?>">
					</div>
					<div class="col-md-3">
					    <input type="date"  class="form-control form-control-sm" name="endtime" value="<?php echo isset($_POST['endtime']) ? $_POST['endtime'] : '' ?>">
					</div>
					<div class="col-md-2">
					    <button type="submit" name="filter" class="btn btn-info" style="left:0px;" value="Filter" />Filter&nbsp;<i class="fas fa-filter"></i></button>
					</div>
					</div>
	        	 </form>
	   </div>
		<div class="card-header">
		   <div class="row">
		     <div class="col-2">
		          <form method="post" action="trackerfilterexport.php">
		              <?php
		              if(isset($_POST["filter"]))
                    {
                      
                        $names= $_POST['name'];
                        $frmDate = $_POST['starttime'];
                        $toDate = $_POST['endtime'];
                    }
		              ?>
		               <input type="hidden" name="name" value="<?php echo $names; ?>">    
		               <input type="hidden" name="frmdate" value="<?php echo $frmDate; ?>">    
		               <input type="hidden" name="todate" value="<?php echo $toDate; ?>">    
		              
                    <button type="submit" name="export" class="btn btn-success" style="left:0px;" value="Export" />Export&nbsp;<i class="fas fa-file-export"></i></button>
                    </form>
		        </div>
        			<div class="card-tools">
        				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=timetracker"><i class="fa fa-plus"></i> Add New Time Tracker</a>
        			</div>
        			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Name</th>
						<th>Task</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Count</th>
						<th>Recruiter</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					if(isset($_POST["filter"]))
                    {
                        $names = [];
                        $names= $_POST['name'];
                        $frmDate = $_POST['starttime'];
                        $toDate = $_POST['endtime'];
                        foreach($names as $name)
                        {
					$qry = $conn->query("SELECT timetracker.`id`, 
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
                                        Where timetracker.`user_id` IN($name) AND timetracker.`date` BETWEEN '$frmDate' AND '$toDate'
                                        order by id desc");
                        }
					while($row= $qry->fetch_assoc()){
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo $row['task'] ?></b></td>
						<td><b><?php echo $row['starttime'] ?></b></td>
						<td><b><?php echo $row['endtime'] ?></b></td>
						<td><b><?php echo $row['count'] ?></b></td>
						<td><b><?php echo $row['recruiter'] ?></b></td>
						<td><b><?php echo $row['date'] ?></b></td>
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
				<?php } }?>
				</tbody>
			</table>
		</div>
	</div>
</div>

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
</div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
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
