<?php include 'db_connect.php'; ?>
<body class="card card-body">
<main >
  
 <!-- Sales Pipeline Report -->
    <div class="col-12">
        <div class="sales-report overflow-auto">
            <div class="">
<?php
$jobid = $_GET['id'];
$current_user_id = $_SESSION['login_id'];

$sql = "SELECT 
            candidate_summery.feedback,
            candidate_summery.application_id,
            job_management.id AS jobid,
            job_management.jb_title,
            job_management.jb_ref,
            job_management.emp_type,
            job_management.jb_type,
            job_management.min_sal,
            job_management.max_sal,
            job_management.jb_descrption,
            job_management.opencount,
            job_management.initialforecasted,
            clintmanege.clint_name,
            job_management.user_id,
            COUNT(*) AS total_count,
            CONCAT(users.firstname, ' ', users.lastname) AS name,
            CONCAT(documents.title, ' ', documents.Last_name) AS docname,
            candidate_summery.recuiter AS recruiter,
            candidate_summery.date AS summery_date, candidate_summery.recuiter AS summery_recuiter,
            CASE
                WHEN candidate_summery.feedback = 'ClientReview' THEN 'ClientView'
                WHEN candidate_summery.feedback = 'InterviewInProcess' THEN 'InterviewProgress'
                WHEN candidate_summery.feedback  = 'OfferInProcess' THEN 'OfferInProgress'
                WHEN candidate_summery.feedback = 'CandidateHired' THEN 'CandidateHired'
                WHEN candidate_summery.feedback  = 'CandidateRejected' THEN 'CandidateRejected'
                ELSE 'OtherCategory'
            END AS category
        FROM job_management
        LEFT JOIN (
            SELECT *
            FROM candidate_summery
            WHERE candidate_summery.id IN (
                SELECT MAX(id)
                FROM candidate_summery
                GROUP BY application_id
            )
        ) AS candidate_summery ON (job_management.id = candidate_summery.job_refno)
        LEFT JOIN clintmanege ON (job_management.jb_client = clintmanege.clint_id)
        LEFT JOIN users ON (job_management.jb_recuiters = users.id)
        LEFT JOIN documents ON (candidate_summery.application_id = documents.id)
        WHERE job_management.id=$jobid AND job_management.jb_date = (
                SELECT MAX(jb_date)
                FROM job_management j
                WHERE j.jb_ref = job_management.jb_ref
            )  AND job_management.status = 1
        ORDER BY job_management.jb_title, clintmanege.clint_name";

$result = $conn->query($sql);

$current_jb_title = null;
$current_clint_name = null;

echo '<div class="container">';
    $a = 1;
    $b = 1;
    $c = 1;
    $d = 1;
    $e = 1;
    
while ($row = $result->fetch_assoc()) {
    $jb_titles = $row['jb_title'];
    $jb_descrption = $row['jb_descrption'];
    $Hiringmanger = $row['name'];
    $jb_type = $row['jb_type'];
    $jb_userid = $row['user_id'];
 
$jb = ($jb_type == "NW") ? 'New' : (($jb_type == "RO") ? 'Re-open' : 'Closed');

    
    if ($current_jb_title !== $row['jb_title'] || $current_clint_name !== $row['clint_name']) {
        if ($current_jb_title !== null) {
            echo '</ul></div>';
            
        }
        echo '<div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
      <img src="assets/img/user.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
      <div class="d-flex gap-2 w-100 justify-content-between">
        <div>
          <h6 class="mb-0">' . $row['name'] . '</h6>
          <p class="mb-0 opacity-75" style="font-size: 12px; color: rgb(155, 161, 166);">Account Manager</p>
        </div>
        <small class="opacity-50 text-nowrap">
    ';
      if($_SESSION['login_id']==$jb_userid){ 
       echo'<a target="_blank"  href="./index2.php?page=jobmangement_edit&id=' . $row["jobid"] . ' "><i class="bi bi-pencil-square"></i></a>';
      }
       
    echo '
        <a target="_blank"  href="jobmangement_pdf.php?&id=' . $row["jobid"] . ' "><i class="bi bi-box-arrow-down"></i></a>
        </small>
      </div>
    </div>';
            
        echo '<div class="container">';
        echo '<h4 class="text-start">' . $row['jb_title'] . ' - ' . $row['jb_ref'] . '</h4>';
        echo '<h6 style="font-size: 16px; color: rgb(144 148 153);"> <i class="bi bi-people-fill"></i> ' . $row['clint_name'] . ' &nbsp;&nbsp;
        <i class="bi bi-dot"></i> 
        <i class="bi bi-briefcase"></i> ' . $jb . '   &nbsp;&nbsp;
        <i class="bi bi-dot"></i> 
        <i class="bi bi-person-workspace"></i> ' . $row['emp_type'] . '  &nbsp;&nbsp;
        <i class="bi bi-dot"></i> 
        <i class="bi bi-cash-stack"></i> Rs. ' . number_format($row['min_sal'], 2)  . ' - Rs. ' . number_format($row['max_sal'], 2)  . '  &nbsp;&nbsp;
        <i class="bi bi-person-workspace"></i> <span>Job Status : </span> <span style="color:green;">Active</span> &nbsp;&nbsp;
        </h6>';
        echo '
        <div class="row" style="margin-top: 2.75rem; -bs-bg-opacity: 1;border-color: rgb(4 83 125);--bs-border-opacity: 1;background-color: rgb(4 83 125 / 8%);">
       <div  class="col-6 p-3 bg-opacity-10 border  rounded-end">
       
        <div class="list-group-item list-group-item-action d-flex" aria-current="true">
     
      <div class="d-flex gap-2 w-100 justify-content-between">
        <div>
           <i class="bi bi-people"></i> Candidates  
        
        </div>
        <span class="opacity-50 text-nowrap">
       
        <a href="./index2.php?page=saleview&id=' . $row["jobid"] . ' "></a>
        </span>
      </div>
    </div>';
   $is_owner = ($row['user_id'] === $current_user_id);
if ($is_owner) {
    echo '
    <form method="post" action="">
        <label for="opencount">Open Jobs Count:</label>
        <input type="number" name="opencount" id="opencount" min="0" required value="' . htmlspecialchars($row['opencount']) . '">
        <input type="hidden" name="jobid" value="' . htmlspecialchars($row['jobid']) . '">
        <input type="submit" value="Update Count">
    </form>';
} else {
    echo '<p>Open Jobs Count: ' . htmlspecialchars($row['opencount']) . '</p>';
}
     echo'</div>';
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $jobid = $_POST['jobid'];
        $openJobsCount = intval($_POST['opencount']); // Get the number from the input field
    
        // Prepare the SQL statement to update the opencount
        $updateSql = "UPDATE job_management SET opencount = ? WHERE id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ii", $openJobsCount, $jobid);
        
        if ($stmt->execute()) {
            $_SESSION['status'] = "Data successfully updated";
        } else {
            echo "Error updating open jobs count: " . $stmt->error;
        }
        
        $stmt->close();
    }
echo '
       <div class=" col-6 p-3 bg-opacity-10 border  rounded-end">
       
        <div class="list-group-item list-group-item-action d-flex" aria-current="true">
     
      <div class="d-flex gap-2 w-100 justify-content-between">
        <div>
           <i class="bi bi-briefcase-fill"></i> Jobs  
        
        </div>
        <span class="opacity-50 text-nowrap">
       
        <a href="./index2.php?page=saleview&id=' . $row["jobid"] . ' "></a>
        </span>
      </div>
    </div>';
$is_owners = ($row['user_id'] === $current_user_id);
if ($is_owners) {
    echo '
    <form method="post" action="">
        <label for="initialforecasted">Initial Forecasted Count:</label>
        <input type="number" name="initialforecasted" id="initialforecasted" min="0" required value="' . htmlspecialchars($row['initialforecasted']) . '">
        <input type="hidden" name="jobids" value="' . htmlspecialchars($row['jobid']) . '">
        <input type="submit" value="Update Count">
    </form>';
} else {
    echo '<p>Initial Forecasted Count: ' . htmlspecialchars($row['initialforecasted']) . '</p>';
}
     echo'</div>';
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $jobids = $_POST['jobids'];
        $initialforecasted = intval($_POST['initialforecasted']); // Get the number from the input field
    
        // Prepare the SQL statement to update the initialforecasted
        $updateSqls = "UPDATE job_management SET initialforecasted = ? WHERE id = ?";
        $stmt = $conn->prepare($updateSqls);
        $stmt->bind_param("ii", $initialforecasted, $jobids);
        
        if ($stmt->execute()) {
            $_SESSION['status'] = "Data successfully updated";
        } else {
            echo "Error updating initial forecasted count: " . $stmt->error;
        }
        
        $stmt->close();
    }

    echo'</div>';
    
 if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    unset($_SESSION['status']); // Unset the session variable
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '<?php echo $status; ?>',
            showConfirmButton: false,
            timer: 500
        }).then(() => {
            window.location.href = window.location.href; // Redirect to the same page
        });
    </script>
    
    <?php
}
        echo '<ul class="list-group">';
        $current_jb_title = $row['jb_title'];
        $current_clint_name = $row['clint_name'];

        
        // Reset the header flags for each new category
        unset($clientViewHeaderShown, $interviewProgressHeaderShown, $offerInProgressHeaderShown, $candidateHiredHeaderShown, $candidateRejectedHeaderShown);
    }

    // Display each document under the corresponding category
 
}

// Close the last container
echo '</ul></div>';
echo '</div>';
?>
<style>.nav-link{color: rgb(4 83 125);}.colors{color: rgb(108 116 122);}</style>
<section class="section" style="margin-top: 2.75rem;">
      <div class="row">
          
          
        <div class="col-lg-12">

          <div class="">
            <div class="">
                
              <!-- Default Tabs -->
              <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">Details</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">Hiring team</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-justified" type="button" role="tab" aria-controls="contact" aria-selected="false">Hiring Process </button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="myTabjustifiedContent">
                <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                    
                    <div class="container py-5" style="font-size: 16px; line-height: 1.6rem;">
                <h6 class=" fw-bold">Description of  <?php echo $jb_titles; ?></h6>
                <p class="col-md-12" style="color: rgb(108 116 122);">
                    <?php echo htmlspecialchars_decode($jb_descrption); ?>
                    </p>
                 </div>
                   
                    
                    
                </div>
               
                <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="ant-col ant-col-24" style="padding-bottom: 0.5rem; border-bottom: 1px solid rgb(229, 231, 232);">
                            <span style="color: rgb(155, 161, 166); font-weight: 600;">Hiring manager</span>
                            </div>
                    
                    
                        <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                              <img src="assets/img/user.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                              <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                  <h6 class="mb-0"><?php echo $Hiringmanger ; ?></h6>
                                  <p class="mb-0 opacity-75" style="font-size: 12px; color: rgb(155, 161, 166);">Account Manager</p>
                                </div>
                             </div>
                        </div>
                 </div>
                
                <div class="tab-pane fade" id="contact-justified" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="ant-col ant-col-24" style="padding-bottom: 0.5rem; border-bottom: 1px solid rgb(229, 231, 232);">
                            <span style="color: rgb(155, 161, 166); font-weight: 600;"> Hiring Process</span>
                    </div>
                    <!-- Sales Pipeline Report -->
    <div class="col-12" style="margin-top: 2.75rem;">
        <div class="card sales-report overflow-auto">
            <div class="card-body">
               
            <div>
                <style>
  .containerz {
    display: flex;
    overflow-x: auto;
    background-color: transparent;
  }

  .list {
    display: flex;
    flex-direction: column;
    min-width: 230px;
    min-height: 300px;
    max-height: 100%;
    overflow-y: auto;
    margin: 5px;
    padding: 5px;
    padding-bottom: 15px;
    box-sizing: border-box;
    border-radius: 8px; /* Increased border radius for a smoother look */
    background-color: rgba(255, 255, 255, 0.5); /* Transparent white background */
    backdrop-filter: blur(20px); /* Increased blur effect */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Soft shadow effect */
    font-family: "Helvetica", sans-serif; /* Using a more iOS-like font */
  }

  .list h3 {
    color: #333; /* Slightly darker text color */
    font-size: 1.1em;
    font-weight: bold;
    padding: 10px; /* Increased padding for better spacing */
    display: flex;
    align-items: center;
    justify-content: center; /* Center aligning the heading */
  }

  .list-entry {
    display: flex;
    flex-direction: column;
    width: 100%;
    min-height: 50px; /* Increased minimum height */
    margin: 5px 0; /* Increased margin for better separation */
    padding: 10px; /* Increased padding for better spacing */
    border-radius: 8px; /* Increased border radius */
    box-sizing: border-box;
    background-color: rgba(255, 255, 255, 0.8); /* Slightly opaque white background */
    backdrop-filter: blur(10px); /* Apply blur effect */
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2); /* Soft shadow effect */
    color: #333; /* Slightly darker text color */
    font-size: 1em; /* Slightly larger font size */
    border: 2px solid transparent; /* Transparent border */
    transition: border-color 0.3s ease; /* Smooth transition for border color */
  }

  .list-entry .list-entry {
    min-height: 40px;
    border: none; /* Removing border for nested entries */
  }

  .list-entry:hover {
    border-color: rgba(0, 123, 255, 0.5); /* Highlight border on hover */
  }

  .list-entry:active {
    transform: scale(0.95); /* Slightly reduce size on active state */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); /* Adjusted shadow on active state */
    opacity: .9; /* Slight opacity change on active state */
  }

  .tmp-entry {
    display: flex;
    flex-direction: column;
    width: 100%;
    min-height: 80px;
    max-height: 80px;
    margin: 5px 0; /* Increased margin for better separation */
    padding: 10px; /* Increased padding for better spacing */
    border-radius: 8px; /* Increased border radius */
    box-sizing: border-box;
    background-color: rgba(255, 255, 255, 0.8); /* Slightly opaque white background */
    backdrop-filter: blur(10px); /* Apply blur effect */
    color: #333; /* Slightly darker text color */
    font-size: 1em; /* Slightly larger font size */
  }
  
</style>
               

<?php
$jobid = $_GET['id'];
// Your query with modifications
$sql = "SELECT 
            candidate_summery.feedback,
            candidate_summery.application_id,
            job_management.jb_title,
            job_management.jb_ref,
            clintmanege.clint_name,
            CONCAT(users.firstname, ' ', users.lastname) AS name,
            CONCAT(documents.title, ' ', documents.Last_name) AS docname,
            candidate_summery.recuiter AS recruiter,
            CASE
                WHEN candidate_summery.feedback = 'ClientReview' THEN 'ClientView'
                WHEN candidate_summery.feedback = 'InterviewInProcess' THEN 'InterviewProgress'
                WHEN candidate_summery.feedback  = 'OfferInProcess' THEN 'OfferInProgress'
                WHEN candidate_summery.feedback = 'CandidateHired' THEN 'CandidateHired'
                WHEN candidate_summery.feedback  = 'CandidateRejected' THEN 'CandidateRejected'
                ELSE 'OtherCategory'
            END AS category
        FROM job_management
        INNER JOIN (
            SELECT *
            FROM candidate_summery
            WHERE candidate_summery.id IN (
                SELECT MAX(id)
                FROM candidate_summery
                GROUP BY application_id
            )
        ) AS candidate_summery ON (job_management.id = candidate_summery.job_refno)
        INNER JOIN clintmanege ON (job_management.jb_client = clintmanege.clint_id)
        INNER JOIN users ON (job_management.user_id = users.id)
        INNER JOIN documents ON (`candidate_summery`.`application_id` = `documents`.`id`)
        WHERE job_management.id=$jobid AND job_management.jb_date = (
                SELECT MAX(jb_date)
                FROM job_management j
                WHERE j.jb_ref = job_management.jb_ref
                
            )  AND job_management.status = 1
        ORDER BY job_management.jb_title, clintmanege.clint_name";

$result = $conn->query($sql);

// Initialize arrays to hold data for each category
$clientViewData = [];
$interviewProgressData = [];
$offerInProgressData = [];
$candidateHiredData = [];
$candidateRejectedData = [];

$candidateIds = [];

// Fetch data from the MySQL query result
while ($row = $result->fetch_assoc()) {
    $candidate_id=$row['application_id'];
    $candidateIds[$candidate_id] = $candidate_id;
    // Append data to the corresponding category data array
    switch ($row['category']) {
        case 'ClientView':
            $clientViewData[$candidate_id] = $row['docname'];
            break;
        case 'InterviewProgress':
            $interviewProgressData[$candidate_id] = $row['docname'];
            break;
        case 'OfferInProgress':
            $offerInProgressData[$candidate_id] = $row['docname'];
            break;
        case 'CandidateHired':
            $candidateHiredData[$candidate_id] = $row['docname'];
            break;
        case 'CandidateRejected':
            $candidateRejectedData[$candidate_id] = $row['docname'];
            break;
    }
} 


// Encode the PHP arrays into JSON format
$clientViewJson = json_encode($clientViewData);
$interviewProgressJson = json_encode($interviewProgressData);
$offerInProgressJson = json_encode($offerInProgressData);
$candidateHiredJson = json_encode($candidateHiredData);
$candidateRejectedJson = json_encode($candidateRejectedData);

?>

<div class="containerz"  id="list-table"></div>

<script>
const items = [
  {
    "name": "Client Review",
    "items": <?php echo json_encode($clientViewData); ?>
  },
  {
    "name": "Interview Progress",
    "items": <?php echo json_encode($interviewProgressData); ?>
  },
  {
    "name": "Offer in Progress",
    "items": <?php echo json_encode($offerInProgressData); ?>
  },
  {
    "name": "Candidate Hired",
    "items": <?php echo json_encode($candidateHiredData); ?>
  },
  {
    "name": "Candidate Rejected",
    "items": <?php echo json_encode($candidateRejectedData); ?>
  }
];

// Populate the list-table with items
const listTable = document.getElementById('list-table');

items.forEach(item => {
  const newListElement = document.createElement('div');
  const newHeadlineElement = document.createElement('h3');
  const newHeadlineTextNode = document.createTextNode(item.name);
  
  newHeadlineElement.appendChild(newHeadlineTextNode);
  newListElement.id = item.name.replace(" ", "");
  newListElement.classList.add('list');
  newListElement.appendChild(newHeadlineElement);
  
  Object.keys(item.items).forEach(candidateId => {
    const entry = document.createElement('div');
    const entryContent = document.createTextNode(item.items[candidateId]);
    const anchor = document.createElement('a');
    anchor.href = "./index2.php?page=view_documentz&id=" + candidateId; // Use candidateId for each document
    anchor.target = "_blank";
    anchor.appendChild(entryContent);
    
    entry.classList.add('list-entry');
    entry.appendChild(anchor);
    
    newListElement.appendChild(entry);
  });
  
  listTable.appendChild(newListElement);
});
</script>


               
            </div> 
                
            </div>
        </div>
    </div>
    <!-- End Sales Pipeline Report -->
                   

                </div>
              </div><!-- End Default Tabs -->

            </div>
          </div>


        </div>

          
          </div>
          </section>
          
            </div>
        </div>
    </div>
</main>
</body>

<?php
$conn->close();
?>
