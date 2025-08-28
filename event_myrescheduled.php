<main>
    <?php 
    session_start();
    
    if(isset($_SESSION['status']))
    {
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            	Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Data successfully deleted',
                      showConfirmButton: false,
                      timer: 1500
                    })
            </script>
        <?php 
        unset($_SESSION['status']);
    }

?>

  <div class="pagetitle">
      <h1>My Rescheduled List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Calendar</li>
          <li class="breadcrumb-item active">Rescheduled List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

 <div class="col-sm-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter justify-content-end">
                  <a class="icon d-flex justify-content-end" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                     
                    </li>

                 <!--   <li><a class="dropdown-item" href="#">-->
                 <!--       <form method="post" action="jobmangement_myjobexport.php"> -->
                 <!--   <button type="submit" name="export" class="btn btn-success" /><span class="badge bg-success">export</span></button>-->
                 <!--</form>-->
                        
                 <!--       </a></li>-->
      
                  </ul>
                </div>

                <div class="card-body">
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Interview Type</th>
                        <th scope="col">Candidate</th>
                        <th scope="col">Client</th>
                        <th scope="col">Job RefNo</th>
                         <th scope="col">Event Date & Time</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                 $query="SELECT* ,events_calender.id, events_calender.title AS eventitle,CONCAT(users.firstname, ', ', users.middlename, ' ', users.lastname) AS name ,documents.id AS caindiateid, CONCAT(documents.title, ' ', documents.last_name) AS candidate,job_management.id AS jobid,job_management.jb_title, job_management.jb_ref, clintmanege.clint_name
FROM events_calender 
INNER JOIN users ON (events_calender.user_id = users.id)
INNER JOIN documents ON (events_calender.candidate_id = documents.id)
INNER JOIN clintmanege ON (events_calender.client_id = clintmanege.clint_id)
INNER JOIN job_management ON (events_calender.job_id = job_management.id)
WHERE  events_calender.status='3' AND events_calender.user_id = '{$_SESSION['login_id']}' order by events_calender.id desc ";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
                    
                    ?>
						<tr>
				      	<th scope="row"><?php echo $i++; ?></th>
                        <td><?php echo $row["eventitle"]; ?></td>
                       <td><a target="_blank" href="./index2.php?page=view_documentz&id=<?php echo $row['caindiateid'] ?>"><?php echo $row["candidate"]; ?></a></td>
                        <td><?php echo $row["clint_name"]; ?></td>
                           <td><a target= "_blank" href="./index2.php?page=jobmangement_view&id=<?php echo $row["jobid"]; ?>" ><?php echo $row["jb_ref"]; ?></a></td>
                        <td><?php echo $row["start_datetime"]; ?></td>
                   
                          
                        <td>
                            <!--<a target= "_blank" href="./index2.php?page=event_edite&id=<?php echo $row["id"]; ?>"><span class="badge bg-secondary"><i class="bi bi-eye"></i></span></a>-->
                            <!--<a target= "_blank" href="./index2.php?page=event_edite&id=<?php echo $row["id"]; ?>"><span class="badge bg-primary"><i class="bi bi-slash-square"></i></span></a>-->
                            <a href="event_caldelete.php?d_id=<?php echo $row["id"]; ?>"  onclick="return confirm('Are You Sure Want To Delete This Record!'); "><span class="badge bg-danger"><i class="bi bi-trash"></i> </span></a>
                          </td>
                      </tr>
                      <?php
                 
                     
                 }
						?>
                      
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
</main>