<?php include'db_connect.php' ?>


  <main>

    <div class="pagetitle">
      <h1>Time Tracker</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Time Tracker</a></li>
          <li class="breadcrumb-item">Time Tracker</li>
          <li class="breadcrumb-item active">All List</li>
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
              <h5 class="card-title">Time Tracker</h5>
                		<div class="card-body">

	                            <div class="card-header">
	        	<form action="timetrackerfilter.php" method="post">
	        	    <div class="row">
	        	     <div class="col-md-4">
	        	            <div class="dropdown">
                             <button class="form-control form-control-sm btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Recruiter
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
					    <input type="date"  class="form-control form-control-sm" name="starttime" value="<?php echo isset($starttime) ? $starttime : '' ?>">
					</div>
					<div class="col-md-3">
					    <input type="date"  class="form-control form-control-sm" name="endtime" value="<?php echo isset($starttime) ? $starttime : '' ?>">
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
		          <form method="post" action="alltimetracker.php">
                    <button type="submit" name="export" class="btn btn-success" style="left:0px;" value="Export" />Export&nbsp;<i class="fas fa-file-export"></i></button>
                    </form>
		        </div>
        			<div class="col-5 card-tools">
        				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index2.php?page=timetracker"><i class="fa fa-plus"></i> Add New Time Tracker</a>
        			</div>
        			</div>
		</div>
		                        <div class="card-body">
			<table class="table table-borderless datatable">
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
					$qry = $conn->query("SELECT timetracker.`id`, 
                                        timetracker.`log_id`, 
                                        timetracker.`recruiter`,
                                        timetracker.`task`,
                                        timetracker.`other_task`, 
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
                                        order by id desc");
					while($row= $qry->fetch_assoc()){
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><a target="_blank" href="./index2.php?page=view_trackerdet&id=<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></a></b></td>
						<td><b><?php 
						        if($row['task']=="Other"){
						         $feedoth = $row['other_task'];
                                $wordoth = preg_replace('/(?<!\ )[A-Z]/', ' $0', $feedoth); 
                                echo $wordoth;
                                }else{
                                $feedz = $row['task'];
                                $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $feedz); 
                                echo $words;
                                }?></b></td>
						<td><b><?php echo $row['starttime'] ?></b></td>
						<td><b><?php echo $row['endtime'] ?></b></td>
						<td><b><?php echo $row['count'] ?></b></td>
						<td><b><?php echo $row['recruiter'] ?></b></td>
						<td><b><?php echo $row['date'] ?></b></td>
					   <td class="text-left">
							    <a   class="btn btn-primary btn-flat" href="./index2.php?page=edite_timetecher&id=<?php echo $row['id'] ?>" onclick="return confirm('Are You Sure Want To Edit This Record!'); ">
		                            <i class="bi bi-slash-square"></i>
		                      </a>
		                      <a href="javascript:void(0)" class="btn btn-danger btn-flat delete_tracker" onclick="return confirm('Are You Sure Want To Delete This Record!'); " >
		                            <i class="bi bi-trash-fill"></i>
		                        </a>
		                        
						  </td>
					
					</tr>	
				<?php } ?>
				</tbody>
			</table>
		</div>
		                </div>
		                </div>
		                </div>
		                </div>
		                </div>
		                </div>
		                </section>

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