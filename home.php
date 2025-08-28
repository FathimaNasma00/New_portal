<?php include('db_connect.php') ?>
<!-- Info boxes -->
<?php if($_SESSION['login_type'] == 1){ ?>
        <div class="row">
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Super Admin</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM users where type = 1")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Admin</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM users where type = 3")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM users where type = 2")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Freelancers</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM users where type = 4")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Documents</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents ")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
           <a href="./index.php?page=adminapproved"> 
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text">Total Approved</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents  where status =1")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
                </a>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
           <a href="./index.php?page=adminpending">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-times-circle"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text">Total Pending</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents  where status =0")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </a>
            <!-- /.info-box -->
          </div>
          
          <div class="col-12 col-sm-6 col-md-3">
           <a href="./index.php?page=adminreject">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times-circle"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text">Total Reject</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents  where status =2")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </a>
            <!-- /.info-box -->
          </div>
             
          <div class="col-6 col-sm-6 col-md-4">
            <div class="info-box">

              <span class="info-box-icon bg-light elevation-1" style="width: 239px;height: 128px;font-size:7rem;"><i class="fas fa-clock"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text"><b>Today Uploaded</b></span>
                <span class="info-box-number">
                  <?php
             date_default_timezone_set("Asia/colombo");
            $date = date("Y-m-d");
                                       
                                       
                $query="SELECT date FROM documents  where date ='$date'";
                                       $qry_run = mysqli_query($conn,$query);
                                       $row = mysqli_num_rows($qry_run);
                                       echo $row;
                                       
                    ?>
           
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
             
            <!-- /.info-box -->
          </div>
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <!-------------Chart.js------------------>
          <div class="col-12 col-sm-8 col-md-8">
            <div class="info-box">
            <div>
  <canvas id="myChart"></canvas>
</div>

<?php
date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");
$sql = "SELECT 
            DATE(start_datetime) AS event_date, 
            COUNT(*) AS total_records, 
            SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count
        FROM 
            events_calender 
        WHERE 
            MONTH(start_datetime) = MONTH('$date')
        GROUP BY 
            DATE(start_datetime)
        ORDER BY 
            event_date ASC";

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[$row['event_date']] = array(
            'total_records' => $row['total_records'],
            'status_1_count' => $row['status_1_count']
        );
    }
} else {
    echo "No data found";
}
?>


<script>
  // PHP data to JavaScript
  var eventData = <?php echo json_encode($data); ?>;
  
  // Extract dates and counts from PHP data
  var dates = Object.keys(eventData);
  var totalRecordsData = dates.map(function(date) {
    return eventData[date]['total_records'];
  });
  var status1CountData = dates.map(function(date) {
    return eventData[date]['status_1_count'];
  });
  
  // Define data for the chart
  const data = {
    labels: dates,
    datasets: [
      {
        label: 'Total Events',
        data: totalRecordsData,
        borderColor: 'rgba(54, 162, 235, 1)',
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        tension: 0.1,
        yAxisID: 'y'
      },
      {
        label: 'Done Status',
        data: status1CountData,
        borderColor: 'rgba(75, 192, 192, 1)',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        tension: 0.1,
        yAxisID: 'y'
      }
    ]
  };

  // Create the chart
  const ctx = document.getElementById('myChart');
  const myChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

                
            </div>
             
            <!-- /.info-box -->
          </div>
          <!-------------END Chart.js------------------>
      </div>
         <!----------------------------- Task Start-------------------------------------------->
       
       <div class="row">
        <div class="col-md-12">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h4 align="center"><p>MY ACCOUNT'S</p</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0 table-hover">
          
                <thead>
                  <th>#</th>
                  <th>Company</th>
                  <th>Role</th>
                  <th>Start</th>
                  <th>End Date</th>
                  <th></th>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $qry = $conn->query("SELECT project_list.id,project_list.name,project_list.rolname,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}' ");
                while($row= $qry->fetch_assoc()){
    
                  ?>
                  <tr>
                      <td>
                         <b><?php echo $i++ ?></b>
                      </td>
                      <td><b><?php echo ucwords($row['clint_name']) ?></b> </td>
                      <td><b><?php echo ucwords($row['rolname']) ?></b> </td>
                      <td><b><?php echo date("M d, Y",strtotime($row['start_date'])) ?></b> </td>
                      <td><b><?php echo date("M d, Y",strtotime($row['end_date'])) ?></b> </td>
                  
                  </tr>
                <?php } ?>
                </tbody>  
              </table>
            </div>
          </div>
        </div>
        </div>
       </div>
         <div class="row">
               <div class="col-md-12">
            <div class="card card-outline card-success">
          <div class="card-header">
            
                  <!----------------------------------------------- TEST-------------------------------------------------------------------------->
      
      
      <?php

// Select Query
$sql = "SELECT project_list.id,project_list.name,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}'";
$res = mysqli_query($conn, $sql);

// Create Array  and push your data 
$stack = array();
while ($datarows =mysqli_fetch_array( $res, MYSQLI_ASSOC )) {
  array_push($stack, $datarows);
 
}
// Encode your stack array
$Encoded_JSON_Array = json_encode( $stack );

?>


  <script type="text/javascript" src="https://unpkg.com/vis-timeline@latest/standalone/umd/vis-timeline-graph2d.min.js"></script>
  <link href="https://unpkg.com/vis-timeline@latest/styles/vis-timeline-graph2d.min.css" rel="stylesheet" type="text/css" />
 

<div class="col-md-12" id="visualization"></div>

<script type="text/javascript">
  // DOM element where the Timeline will be attached
  var container = document.getElementById('visualization');
// Create a DataSet (allows two way data-binding)
  

// CREATE NEW ARRAY, THEN CARRY ON AND CONVERT THE PHP ARRAY TO A JAVASCRIPT ARRAY
const new_Array = []
var Encoded_JSON_Array = <?php echo $Encoded_JSON_Array ?> ; // CONVERTS TO JS ARRAY

// !IMPORTANT 
// PUSH DATA INTO YOUR NEW ARRAY AS OBJECTS. NOTES! vis.js DATASET MUST HAVE THIS {id: , content: , start: }. THEY ARE CONSTANTS THAT YOU CANT CHANGE IT. 
for (let i = 0; i <Encoded_JSON_Array.length; i++){
  new_Array.push({id: Number(Encoded_JSON_Array[i].id),content: Encoded_JSON_Array[i].clint_name,start: Encoded_JSON_Array[i].start_date, end: Encoded_JSON_Array[i].end_date})
}

// CALL YOUR ARRAY IN DATASET, THEN YOU ARE GOOD TO GO!
var items = new vis.DataSet(new_Array);

  // Configuration for the Timeline
  var options = {};

  // Create a Timeline
  var timeline = new vis.Timeline(container, items, options);
</script>

      
      
      
      
      
      
        </div>
        </div>
        </div>
         </div>
  
      
      <!----------------------------- Task End-------------------------------------------->
      
      <!----------------------------- STRAT-------------------------------------------->
      
      <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
              <?php include'db_connect.php' ?>
                <div class="col-lg-12">
	            <div class="card card-outline card-success">
		            <div class="card-header">
		    
		     <form method="post" action="export.php">
                    <button type="submit" name="export" class="btn btn-success" value="Export" />Export&nbsp;<i class="fas fa-file-export"></i></button>
            </form>
		</div>
		 <h2 align="center">Duplicate Datasets List</h2> 
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
					<th>Ref_NO</th>  
                     <th>Phone number</th> 
                    <th>Email</th>  
                    <th>Recuiter</th>  
                   <th>Date And Time</th>
					</tr>
				</thead>
				<tbody>
			 
                 <?php
                 $query="SELECT `recruiter`,`ref_no`,`phonenumber`,`email`,`date_created`, MIN(`id`) AS ID
                            FROM documents
                            GROUP BY `phonenumber`,`email`
                            HAVING COUNT(email) > 1";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
                     if($row['ref_no'] <= 99){
						$recq=$row['recruiter'];
						$reqanswr=$recq."00".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}else{
						 $recq=$row['recruiter'];
						$reqanswr=$recq."0".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}
                    echo '  
                   <tr>  
                     <td> <a style="text-decoration: none;" target="_blank" href="./index.php?page=view_documentz&id='.$row["ID"].'"><b style="color:blue;">'.$string.'</b></a></td>  
                     <td>0'.$row["phonenumber"].'</td>  
                     <td>'.$row["email"].'</td>  
                     <td>'.$row["recruiter"].'</td>  
                     <td>'.$row["date_created"].'</td>
                    
                   </tr>  
                    ';  
                 }
                 ?>
           
				</tbody>
			</table>
		</div>
	</div>
</div>
          </div>
      </div>
      <script>
	$(document).ready(function(){
		$('#list').dataTable()
	})

</script>
      
      <!-------------------------------END------------------------------------------>
      
      
      
      
      
      
      <div class="row">
          <p class="text-center col-12"><b>TRACKERS SUMMARY</b></p>
           <div class="col-12 col-sm-6 col-md-4">
               <div class="info-box">
               <table class="table">
                  <thead>
                   <tr>
                       <th colspan="2"><h5 class="text-center"><b>DAILY SUMMARY</b></h5></th>
                   </tr>
                    <tr>

                      <th scope="col">TASKS</th>
                      <th scope="col">COUNT</th>

                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    date_default_timezone_set("Asia/colombo");
                    $date = date("Y-m-d");                   
                    $query="SELECT task,date,SUM(`count`)AS totacount FROM timetracker  where date ='$date' GROUP BY task";
                    $result = mysqli_query($conn,$query);
                    while($row=$result->fetch_object()){ ?>
                    
                    <tr>
                     <td><?php echo $row->task; ?></td>
                    <th scope="row"><?php echo $row->totacount;   ?></th>
                      

                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
          
          <div class="col-12 col-sm-8 col-md-8">
               <div class="info-box">
               <table class="table">
                  <thead>
                   <tr>
                       <th colspan="3"><h5 class="text-center"><b>MONTHLY SUMMARY</b></h5></th>
                   </tr>
                    <tr>

                      <th scope="col">TASKS</th>
                      <th scope="col">COUNT </th>

                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    date_default_timezone_set("Asia/colombo");
                    $date = date("Y-m-d");                   
                    $query="SELECT `date`,task,DATE_FORMAT(`date`, '%M') AS month, SUM(`count`)AS totacount FROM `timetracker` where MID(date,6,2)=MID(date,6,2) GROUP BY task";
                    $result = mysqli_query($conn,$query);
                    while($row=$result->fetch_object()){ ?>
                    
                    <tr>
                     <td><?php echo $row->task; ?></td>
                    <th scope="row"><?php echo $row->totacount;   ?></th>
                      

                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
      </div>
      <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
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
								<option></option>
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
						<td><?php echo $row['id']; ?></td>
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
          </div>
      </div>
<?php }elseif($_SESSION['login_type'] == 3){ ?>
     <div class="row">
          <!-- /.col -->
           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Documents</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
           <a href="./index.php?page=adminapproved">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text">Total Approved</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents  where status =1 ")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
                </a>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
           <a href="./index.php?page=adminpending">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times-circle"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text">Total Pending</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents  where status =0 ")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </a>
            <!-- /.info-box -->
          </div>
          
            <div class="col-12 col-sm-6 col-md-3">
           <a href="./index.php?page=adminreject">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times-circle"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text">Total Reject</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents  where status =2")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </a>
            <!-- /.info-box -->
          </div>
          
          
          <div class="col-6 col-sm-6 col-md-4">
            <div class="info-box">

              <span class="info-box-icon bg-light elevation-1" style="width: 239px;height: 128px;font-size:7rem;"><i class="fas fa-clock"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text"><b>Today Uploaded</b></span>
                <span class="info-box-number">
                  <?php
             date_default_timezone_set("Asia/colombo");
            $date = date("Y-m-d");
                                       
                                       
                $query="SELECT date FROM documents  where date ='$date' AND user_id = '{$_SESSION['login_id']}'";
                                       $qry_run = mysqli_query($conn,$query);
                                       $row = mysqli_num_rows($qry_run);
                                       echo $row;
                                       
                    ?>
           
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
             
            <!-- /.info-box -->
          </div>
             <!-------------Chart.js------------------>
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <div class="col-12 col-sm-8 col-md-8">
            <div class="info-box">
                <?php 

  $query = $conn->query("
            SELECT month as monthname, 
            SUM(amount) as amount 
            FROM sale_target
            GROUP BY month
            order by id asc
     
  ");

  foreach($query as $data)
  {
    $month[] = $data['monthname'];
    $amount[] = $data['amount'];
    $linez[] = 1000000;
  }

?>


<div style="width: 500px;">
  <canvas id="myChart"></canvas>
</div>
 
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($month) ?>;
 const monthtar =[
      {month:'Nov', amount:'2000000'},
      {month:'Dec', amount:'2000000'},
      {month:'Jan', amount:'2000000'},
      {month:'Feb', amount:'2000000'},
      {month:'Mar', amount:'2000000'},
      {month:'Apr', amount:'2000000'}
      ];

      
const data = {
  labels: labels,
  datasets: [{
    label: 'Revenue Data',
    data: <?php echo json_encode($amount) ?>,
    fill: false,
      backgroundColor: [
          'rgba(0,100,0)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(0,100,0)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
       tension: 0.1
  },
  {
        label: 'Monthly Revenue Target',
        data: monthtar,
        tension: 0.1,
        backgroundColor: 'rgba(255,0,0)',
        borderColor:'rgba(255,0,0)',
        parsing:{xAxisKey:'month', yAxisKey:'amount'}
   
  },
   {
       
        data:monthtar,
        label: 'Target',
        tension: 0.1,
        backgroundColor: 'rgba(255,0,0)',
        borderColor:'rgba(255,0,0)',
        parsing:{xAxisKey:'month', yAxisKey:'amount'}
   }   
  ]
};


  const config = {
    type: 'line',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
               
                
            </div>
             
            <!-- /.info-box -->
          </div>
          <!-------------END Chart.js------------------>
      </div>
         <!----------------------------- Task Start-------------------------------------------->
       <div class="row">
        <div class="col-md-12">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h4 align="center"><p>MY ACCOUNT'S</p</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0 table-hover">
          
                <thead>
                  <th>#</th>
                  <th>Company</th>
                  <th>Role</th>
                  <th>Start</th>
                  <th>End Date</th>
                  <th></th>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $qry = $conn->query("SELECT project_list.id,project_list.name,project_list.rolname,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}' ");
                while($row= $qry->fetch_assoc()){
    
                  ?>
                  <tr>
                      <td>
                         <b><?php echo $i++ ?></b>
                      </td>
                      <td><b><?php echo ucwords($row['clint_name']) ?></b> </td>
                      <td><b><?php echo ucwords($row['rolname']) ?></b> </td>
                      <td><b><?php echo date("M d, Y",strtotime($row['start_date'])) ?></b> </td>
                      <td><b><?php echo date("M d, Y",strtotime($row['end_date'])) ?></b> </td>
                  
                  </tr>
                <?php } ?>
                </tbody>  
              </table>
            </div>
          </div>
        </div>
        </div>
                
       </div>
       
       
         <div class="row">
               <div class="col-md-12">
            <div class="card card-outline card-success">
          <div class="card-header">
            
                  <!----------------------------------------------- TEST-------------------------------------------------------------------------->
      
      
      <?php

// Select Query
$sql = "SELECT project_list.id,project_list.name,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}'";
$res = mysqli_query($conn, $sql);

// Create Array  and push your data 
$stack = array();
while ($datarows =mysqli_fetch_array( $res, MYSQLI_ASSOC )) {
  array_push($stack, $datarows);
 
}
// Encode your stack array
$Encoded_JSON_Array = json_encode( $stack );

?>


  <script type="text/javascript" src="https://unpkg.com/vis-timeline@latest/standalone/umd/vis-timeline-graph2d.min.js"></script>
  <link href="https://unpkg.com/vis-timeline@latest/styles/vis-timeline-graph2d.min.css" rel="stylesheet" type="text/css" />
 

<div class="col-md-12" id="visualization"></div>

<script type="text/javascript">
  // DOM element where the Timeline will be attached
  var container = document.getElementById('visualization');
// Create a DataSet (allows two way data-binding)
  

// CREATE NEW ARRAY, THEN CARRY ON AND CONVERT THE PHP ARRAY TO A JAVASCRIPT ARRAY
const new_Array = []
var Encoded_JSON_Array = <?php echo $Encoded_JSON_Array ?> ; // CONVERTS TO JS ARRAY

// !IMPORTANT 
// PUSH DATA INTO YOUR NEW ARRAY AS OBJECTS. NOTES! vis.js DATASET MUST HAVE THIS {id: , content: , start: }. THEY ARE CONSTANTS THAT YOU CANT CHANGE IT. 
for (let i = 0; i <Encoded_JSON_Array.length; i++){
  new_Array.push({id: Number(Encoded_JSON_Array[i].id),content: Encoded_JSON_Array[i].clint_name,start: Encoded_JSON_Array[i].start_date, end: Encoded_JSON_Array[i].end_date})
}

// CALL YOUR ARRAY IN DATASET, THEN YOU ARE GOOD TO GO!
var items = new vis.DataSet(new_Array);

  // Configuration for the Timeline
  var options = {};

  // Create a Timeline
  var timeline = new vis.Timeline(container, items, options);
</script>

      
      
      
      
      
      
        </div>
        </div>
        </div>
         </div>
  
      
      <!----------------------------- Task End-------------------------------------------->
       <!----------------------------- STRAT-------------------------------------------->
      
      <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
              <?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
		    
		     <form method="post" action="export.php">
                    <button type="submit" name="export" class="btn btn-success" value="Export" />Export&nbsp;<i class="fas fa-file-export"></i></button>
            </form>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
					<th>Ref_NO</th>  
                     <th>Phone number</th> 
                    <th>Email</th>  
                    <th>Recuiter</th>  
                   <th>Date And Time</th>
					</tr>
				</thead>
				<tbody>
			 
                 <?php
                 $query="SELECT `recruiter`,`ref_no`,`phonenumber`,`email`,`date_created`, MIN(`id`) AS ID
                            FROM documents
                            GROUP BY `phonenumber`,`email`
                            HAVING COUNT(email) > 1";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
                     if($row['ref_no'] <= 99){
						$recq=$row['recruiter'];
						$reqanswr=$recq."00".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}else{
						 $recq=$row['recruiter'];
						$reqanswr=$recq."0".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						} 
                    echo '  
                   <tr>  
                     <td> <a style="text-decoration: none;" target="_blank" href="./index.php?page=view_documentz&id='.$row["ID"].'"><b style="color:blue;">'.$string.'</b></a></td>  
                     <td>0'.$row["phonenumber"].'</td>  
                     <td>'.$row["email"].'</td>  
                     <td>'.$row["recruiter"].'</td>  
                     <td>'.$row["date_created"].'</td>
                    
                   </tr>  
                    ';  
                 }
                 ?>
           
				</tbody>
			</table>
		</div>
	</div>
</div>
          </div>
      </div>
      <script>
	$(document).ready(function(){
		$('#list').dataTable()
	})

</script>
      
      <!-------------------------------END------------------------------------------>

<?php }else{ ?>
	 <div class="col-12">
          <div class="card">
          	<div class="card-body">
          		Welcome <?php echo $_SESSION['login_name'] ?>!
          	</div>
          </div>
      </div>
      <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">My Documents</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents  where user_id = {$_SESSION['login_id']}")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          
        <div class="col-12 col-sm-6 col-md-3">
           <a href="./index.php?page=myapproved">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">My Approved</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents  where status =1 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>
                </span>
              </div>
            </div>
                </a>
          </div>
          
          
          <div class="col-12 col-sm-6 col-md-3">
           <a href="./index.php?page=mypending">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-times-circle"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text">My Pendings</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents  where status =0 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </a>
            <!-- /.info-box -->
          </div>
          
          <div class="col-12 col-sm-6 col-md-3">
           <a href="./index.php?page=myreject">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times-circle"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text">My Rejects</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents  where status =2 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
              </a>
            <!-- /.info-box -->
          </div>
   
          <div class="col-6 col-sm-6 col-md-4">
            <div class="info-box">

              <span class="info-box-icon bg-light elevation-1" style="width: 239px;height: 128px;font-size:7rem;"><i class="fas fa-clock"></i></span>

              <div class="info-box-content">
                  <span class="info-box-text" ><b>Today Uploads</b></span>
                <span class="info-box-number" style="font-size:3rem;">
                  <?php 
             date_default_timezone_set("Asia/colombo");
            $date = date("Y-m-d");
            echo $conn->query("SELECT * FROM documents  where date ='$date' AND user_id = {$_SESSION['login_id']}")->num_rows; ?>
               
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
             
            <!-- /.info-box -->
          </div>
          
             <!-------------Chart.js------------------>
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <div class="col-12 col-sm-8 col-md-8">
            <div class="info-box">
                <?php 

  $query = $conn->query("
            SELECT month as monthname, 
            SUM(amount) as amount 
            FROM sale_target
            GROUP BY month
            order by id asc
     
  ");

  foreach($query as $data)
  {
    $month[] = $data['monthname'];
    $amount[] = $data['amount'];
    $linez[] = 1000000;
  }

?>


<div style="width: 500px;">
  <canvas id="myChart"></canvas>
</div>
 
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($month) ?>;
  const monthtar =[
      {month:'Nov', amount:'2000000'},
      {month:'Dec', amount:'2000000'},
      {month:'Jan', amount:'2000000'},
      {month:'Feb', amount:'2000000'},
      {month:'Mar', amount:'2000000'},
      {month:'Apr', amount:'2000000'}
      ];

      
const data = {
  labels: labels,
  datasets: [{
    label: 'Revenue Data',
    data: <?php echo json_encode($amount) ?>,
    fill: false,
      backgroundColor: [
          'rgba(0,100,0)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(0,100,0)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
       tension: 0.1
  },
  {
        label: 'Monthly Revenue Target',
        data: monthtar,
        tension: 0.1,
        backgroundColor: 'rgba(255,0,0)',
        borderColor:'rgba(255,0,0)',
        parsing:{xAxisKey:'month', yAxisKey:'amount'}
   
  },
   {
       
        data:monthtar,
        label: 'Target',
        tension: 0.1,
        backgroundColor: 'rgba(255,0,0)',
        borderColor:'rgba(255,0,0)',
        parsing:{xAxisKey:'month', yAxisKey:'amount'}
   }   
  ]
};


  const config = {
    type: 'line',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
               
                
            </div>
             
            <!-- /.info-box -->
          </div>
          <!-------------END Chart.js------------------>
          
          <!-- /.col -->
      </div>
      
         <!----------------------------- Task Start-------------------------------------------->
       <div class="row">
        <div class="col-md-12">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h4 align="center"><p>MY ACCOUNT'S</p</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0 table-hover">
          
                <thead>
                  <th>#</th>
                  <th>Company</th>
                  <th>Role</th>
                  <th>Start</th>
                  <th>End Date</th>
                  <th></th>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $qry = $conn->query("SELECT project_list.id,project_list.name,project_list.rolname,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}' ");
                while($row= $qry->fetch_assoc()){
    
                  ?>
                  <tr>
                      <td>
                         <b><?php echo $i++ ?></b>
                      </td>
                      <td><b><?php echo ucwords($row['clint_name']) ?></b> </td>
                      <td><b><?php echo ucwords($row['rolname']) ?></b> </td>
                      <td><b><?php echo date("M d, Y",strtotime($row['start_date'])) ?></b> </td>
                      <td><b><?php echo date("M d, Y",strtotime($row['end_date'])) ?></b> </td>
                  
                  </tr>
                <?php } ?>
                </tbody>  
              </table>
            </div>
          </div>
        </div>
        </div>
                
       </div>
       
       
         <div class="row">
               <div class="col-md-12">
            <div class="card card-outline card-success">
          <div class="card-header">
            
                  <!----------------------------------------------- TEST-------------------------------------------------------------------------->
      
      
      <?php

// Select Query
$sql = "SELECT project_list.id,project_list.name,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}'";
$res = mysqli_query($conn, $sql);

// Create Array  and push your data 
$stack = array();
while ($datarows =mysqli_fetch_array( $res, MYSQLI_ASSOC )) {
  array_push($stack, $datarows);
 
}
// Encode your stack array
$Encoded_JSON_Array = json_encode( $stack );

?>


  <script type="text/javascript" src="https://unpkg.com/vis-timeline@latest/standalone/umd/vis-timeline-graph2d.min.js"></script>
  <link href="https://unpkg.com/vis-timeline@latest/styles/vis-timeline-graph2d.min.css" rel="stylesheet" type="text/css" />
 

<div class="col-md-12" id="visualization"></div>

<script type="text/javascript">
  // DOM element where the Timeline will be attached
  var container = document.getElementById('visualization');
// Create a DataSet (allows two way data-binding)
  

// CREATE NEW ARRAY, THEN CARRY ON AND CONVERT THE PHP ARRAY TO A JAVASCRIPT ARRAY
const new_Array = []
var Encoded_JSON_Array = <?php echo $Encoded_JSON_Array ?> ; // CONVERTS TO JS ARRAY

// !IMPORTANT 
// PUSH DATA INTO YOUR NEW ARRAY AS OBJECTS. NOTES! vis.js DATASET MUST HAVE THIS {id: , content: , start: }. THEY ARE CONSTANTS THAT YOU CANT CHANGE IT. 
for (let i = 0; i <Encoded_JSON_Array.length; i++){
  new_Array.push({id: Number(Encoded_JSON_Array[i].id),content: Encoded_JSON_Array[i].clint_name,start: Encoded_JSON_Array[i].start_date, end: Encoded_JSON_Array[i].end_date})
}

// CALL YOUR ARRAY IN DATASET, THEN YOU ARE GOOD TO GO!
var items = new vis.DataSet(new_Array);

  // Configuration for the Timeline
  var options = {};

  // Create a Timeline
  var timeline = new vis.Timeline(container, items, options);
</script>

      
      
      
      
      
      
        </div>
        </div>
        </div>
         </div>
  
      
      <!----------------------------- Task End-------------------------------------------->
       <!----------------------------- STRAT-------------------------------------------->
      
      <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
              <?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
		    
		     <form method="post" action="export.php">
                    <button type="submit" name="export" class="btn btn-success" value="Export" />Export&nbsp;<i class="fas fa-file-export"></i></button>
            </form>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
					<th>Ref_NO</th>  
                     <th>Phone number</th> 
                    <th>Email</th>  
                    <th>Recuiter</th>  
                   <th>Date And Time</th>
					</tr>
				</thead>
				<tbody>
			 
                 <?php
                 $query="SELECT `recruiter`,`ref_no`,`phonenumber`,`email`,`date_created`, MIN(`id`) AS ID
                            FROM documents
                            GROUP BY `phonenumber`,`email`
                            HAVING COUNT(email) > 1";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
                     if($row['ref_no'] <= 99){
						$recq=$row['recruiter'];
						$reqanswr=$recq."00".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}else{
						 $recq=$row['recruiter'];
						$reqanswr=$recq."0".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}
                    echo '  
                   <tr>  
                     <td> <a style="text-decoration: none;" target="_blank" href="./index.php?page=view_documentz&id='.$row["ID"].'"><b style="color:blue;">'.$string.'</b></a></td>  
                     <td>0'.$row["phonenumber"].'</td>  
                     <td>'.$row["email"].'</td>  
                     <td>'.$row["recruiter"].'</td>  
                     <td>'.$row["date_created"].'</td>
                    
                   </tr>  
                    ';  
                 }
                 ?>
           
				</tbody>
			</table>
		</div>
	</div>
</div>
          </div>
      </div>
      <script>
	$(document).ready(function(){
		$('#list').dataTable()
	})

</script>
      
      <!-------------------------------END------------------------------------------>
      <div class="row">
          <p class="text-center col-12"><b>TRACKERS SUMMARY</b></p>
           <div class="col-12 col-sm-6 col-md-4">
               <div class="info-box">
               <table class="table">
                  <thead>
                   <tr>
                       <th colspan="2"><h5 class="text-center"><b>DAILY SUMMARY</b></h5></th>
                   </tr>
                    <tr>

                      <th scope="col">TASKS</th>
                      <th scope="col">COUNT</th>

                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    date_default_timezone_set("Asia/colombo");
                    $date = date("Y-m-d");                   
                    $query="SELECT task,count,date, SUM(`count`) AS totacount FROM timetracker  where date ='$date' AND user_id = {$_SESSION['login_id']} GROUP BY task";
                    $result = mysqli_query($conn,$query);
                    while($row=$result->fetch_object()){ ?>
                    
                    <tr>
                     <td><?php echo $row->task; ?></td>
                    <th scope="row"><?php echo $row->totacount;   ?></th>
                      

                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
          
          <div class="col-12 col-sm-8 col-md-8">
               <div class="info-box">
               <table class="table">
                  <thead>
                   <tr>
                       <th colspan="3"><h5 class="text-center"><b>MONTHLY SUMMARY</b></h5></th>
                   </tr>
                    <tr>

                      <th scope="col">TASKS</th>
                      <th scope="col">MONTH</th>
                      <th scope="col">COUNT </th>

                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    date_default_timezone_set("Asia/colombo");
                    $date = date("Y-m-d");                   
                    $query="SELECT `date`,count,task,DATE_FORMAT(`date`, '%M') AS month, SUM(`count`)AS totacount FROM `timetracker` where MID(date,6,2)=MID(date,6,2) AND user_id = {$_SESSION['login_id']}  GROUP BY task";
                    $result = mysqli_query($conn,$query);
                    while($row=$result->fetch_object()){ ?>
                    
                    <tr>
                     <td><?php echo $row->task; ?></td>
                     <td><?php echo $row->month; ?></td>
                    <th scope="row"><?php echo $row->totacount; ?></th>
                      

                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
      </div>
          
<?php } ?>
