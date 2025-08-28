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
      <h1>Calendar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Calendar</li>
          <li class="breadcrumb-item active">List</li>
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
                         <th scope="col">Status</th>
                         <th scope="col">Event Date & Time</th>
                          <th scope="col">Update By</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                 $query="SELECT* ,events_calender.id,events_calender.id AS eventid,events_calender.status, events_calender.title AS eventitle,CONCAT(users.firstname, ', ', users.middlename, ' ', users.lastname) AS name ,documents.id AS caindiateid, CONCAT(documents.title, ' ', documents.last_name) AS candidate,job_management.id AS jobid,job_management.jb_title, job_management.jb_ref, clintmanege.clint_name
FROM events_calender 
INNER JOIN users ON (events_calender.user_id = users.id)
INNER JOIN documents ON (events_calender.candidate_id = documents.id)
INNER JOIN clintmanege ON (events_calender.client_id = clintmanege.clint_id)
INNER JOIN job_management ON (events_calender.job_id = job_management.id)
order by events_calender.id desc ";
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
                         <td>
    <?php
     $status_badge = "";
        if ($row['status'] == 0) {
            $status_badge = '<span class="badge bg-danger">NotCompleted</span>';
        } elseif ($row['status'] == 2) {
            $status_badge = '<span class="badge bg-danger">NotCompleted</span>';
        } elseif ($row['status'] == 1) {
            $status_badge = '<span class="badge bg-success">Completed</span>';
        } elseif ($row['status'] == 3) {
            $status_badge = '<span class="badge bg-warning">Rescheduled</span>';
        }
    ?>

    <span style="font-size: 10px; color: black; padding: 5px; border-radius: 3px;">
        <b><?php echo $status_badge; ?></b>
    </span>
</td>
                        <!--  <td>-->
                        <!--    <select class="form-select status-dropdown" data-id="<?php echo $row['eventid']; ?>">-->
                        <!--        <option value="1" <?php echo ($event['status'] == 1) ? 'selected' : ''; ?>>Not Completed</option>-->
                        <!--        <option value="2" <?php echo ($event['status'] == 2) ? 'selected' : ''; ?>>Completed</option>-->
                        <!--        <option value="3" <?php echo ($event['status'] == 3) ? 'selected' : ''; ?>>Rescheduled</option>-->
                        <!--    </select>-->
                        
                        <!--    <input type="datetime-local" class="form-control reschedule-datetime mt-2" name="start_date" data-id="<?php echo $row['eventid']; ?>" style="display: none;">-->
                        
                        <!--    <button class="btn btn-primary mt-2 save-reschedule" data-id="<?php echo $row['eventid']; ?>" style="display: none;">Save</button>-->
                        <!--</td>-->
                        <td><?php echo $row["start_datetime"]; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                   
                          
                        <td>
                            <!--<a target= "_blank" href="./index2.php?page=event_edite&id=<?php echo $row["id"]; ?>"><span class="badge bg-secondary"><i class="bi bi-eye"></i></span></a>-->
                            <a target= "_blank" href="./index2.php?page=event_edite&id=<?php echo $row["id"]; ?>"><span class="badge bg-primary"><i class="bi bi-slash-square"></i></span></a>
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

 <script>
                  $(document).ready(function () {
    // Handle status change
    $(document).on('change', '.status-dropdown', function () {
        var eventId = $(this).data('id');
        var newStatus = $(this).val();

        // Hide all reschedule inputs first
        $('.reschedule-datetime, .save-reschedule').hide();

        if (newStatus === "3") { // If "Rescheduled" is selected
            $('input.reschedule-datetime[data-id="' + eventId + '"]').show();
            $('button.save-reschedule[data-id="' + eventId + '"]').show();
        } else {
            // Update status immediately if NOT Rescheduled
            $.ajax({
                url: 'eventstaus_update.php',
                type: 'POST',
                data: { id: eventId, status: newStatus },
                success: function (response) {
                    console.log("Response from server:", response);
                    alert("Status updated successfully!");
                    location.reload(); // Refresh to reflect changes
                },
                error: function (xhr, status, error) {
                    console.log("AJAX Error:", status, error);
                    alert("Failed to update. Please try again.");
                }
            });
        }
    });

    // Handle "Save" button click for rescheduling
    $(document).on('click', '.save-reschedule', function () {
        var eventId = $(this).data('id');
        var newDate = $('input.reschedule-datetime[data-id="' + eventId + '"]').val().trim();

        if (newDate === '') {
            alert("Please select a new date and time.");
            return;
        }

        $.ajax({
            url: 'eventstaus_update.php',
            type: 'POST',
            data: { id: eventId, status: 3, new_date: newDate },
            success: function (response) {
                console.log("Response from server:", response);
                if (response.includes("Success")) {
                    alert("Event rescheduled successfully!");
                    location.reload();
                } else {
                    alert("Error: " + response); // Show actual error
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", status, error);
                alert("AJAX request failed: " + xhr.responseText);
            }
        });
    });
});

                  </script>