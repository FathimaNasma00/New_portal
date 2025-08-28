<?php include 'db_connect.php'; ?>
<body class="card card-body">
<main >
  
 <!-- Sales Pipeline Report -->
    <div class="col-12">
        <div class="sales-report overflow-auto">
            <div class="">
<?php
$jobid = $_GET['id'];

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
            clintmanege.clint_name,
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
            )  AND job_management.status = 0
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
        <a target="_blank"  href="./index2.php?page=jobmangement_edit&id=' . $row["jobid"] . ' "><i class="bi bi-pencil-square"></i></a>
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
        <i class="bi bi-person-workspace"></i> <span>Job Status : </span> <span style="color:red;">Inactive</span> &nbsp;&nbsp;
        </h6>';
        echo '
       <div style="margin-top: 2.75rem; -bs-bg-opacity: 1;border-color: rgb(4 83 125);--bs-border-opacity: 1;background-color: rgb(4 83 125 / 8%);" class="p-3 bg-opacity-10 border  rounded-end">
       
        <div class="list-group-item list-group-item-action d-flex" aria-current="true">
     
      <div class="d-flex gap-2 w-100 justify-content-between">
        <div>
           <i class="bi bi-people"></i> Candidates   
        
        </div>
        <span class="opacity-50 text-nowrap">
       
        <a href="./index2.php?page=saleview&id=' . $row["jobid"] . ' "></a>
        </span>
      </div>
    </div>
      </div>';
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
                <p class="col-md-12" style="color: rgb(108 116 122);"><?php
                    $jb_descrption = $jb_descrption;
                    
                    // Split the description into an array of lines
                    $lines = explode("\n", $jb_descrption);
                    
                    // Start an unordered list
                    echo "<ul>";
                    
                    // Loop through each line and wrap it with <li> tags
                    foreach ($lines as $line) {
                        echo "<li class='colors'>" . $line . "</li>";
                    }
                    
                    // End the unordered list
                    echo "</ul>";
                    ?>
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
               

<?php
// Your MySQLi connection code here
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
                
            )  AND job_management.status = 0
        ORDER BY job_management.jb_title, clintmanege.clint_name";

$result = $conn->query($sql);

?>
   <table class="table table-bordered table-striped table-hover border border-start datatable">
                    <thead>
                        <tr>
                            <th scope="col">Client Review </th>
                            <th scope="col">Interview Progress</th>
                            <th scope="col">Offer in Progress</th>
                            <th scope="col">Candidate Hired</th>
                            <th scope="col">Candidate Rejected</th>
                        </tr>
                    </thead>
<tbody class="datatable">
<?php
$current_jb_title = null;
$current_clint_name = null;

// Initialize arrays to store data for each category
$clientViewData = $interviewProgressData = $offerInProgressData = $candidateHiredData = $candidateRejectedData = array();

while ($row = $result->fetch_assoc()) {
    // Check if jb_title or clint_name changed
    if ($current_jb_title !== $row['jb_title'] || $current_clint_name !== $row['clint_name']) {
        if ($current_jb_title !== null) {
            // Close the previous row
         echo '<td style="font-size:11px; position: relative;">';
if (count($clientViewData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0;  color: black; padding: 3px 6px; border-radius: 50%;">' . count($clientViewData) . '</span>';
}
echo implode(',', $clientViewData) . '</td>';


echo '<td style="font-size:11px; position: relative;">';
if (count($interviewProgressData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0; color: black; padding: 3px 6px; border-radius: 50%;">' . count($interviewProgressData) . '</span>';
}
echo implode(',', $interviewProgressData) . '</td>';



echo '<td style="font-size:11px; position: relative;">';
if (count($offerInProgressData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0; color: black; padding: 3px 6px; border-radius: 50%;">' . count($offerInProgressData) . '</span>';
}
echo implode(',', $offerInProgressData) . '</td>';



echo '<td style="font-size:11px; position: relative;">';
if (count($candidateHiredData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0; color: black; padding: 3px 6px; border-radius: 50%;">' . count($candidateHiredData) . '</span>';
}
echo implode(',', $candidateHiredData) . '</td>';


echo '<td style="font-size:11px; position: relative;">';
if (count($candidateRejectedData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0; color: black; padding: 3px 6px; border-radius: 50%;">' . count($candidateRejectedData) . '</span>';
}
echo implode(',', $candidateRejectedData) . '</td>';

            echo '</tr>';
        }
        // Start a new row
        echo '<tr>';
        
        // Initialize category data arrays
        $clientViewData = $interviewProgressData = $offerInProgressData = $candidateHiredData = $candidateRejectedData = array();
        $current_jb_title = $row['jb_title'];
        $current_clint_name = $row['clint_name'];
    }

    // Append data to the corresponding category data array
    switch ($row['category']) {
        case 'ClientView':
            $clientViewData[] = '<a href="./index2.php?page=view_documentz&id=' . $row['application_id'] . '" target="_blank">' . $row['docname'] . '<br></a>';
            break;
        case 'InterviewProgress':
            $interviewProgressData[] = '<a href="./index2.php?page=view_documentz&id=' . $row['application_id'] . '" target="_blank">' . $row['docname'] . '<br></a>';
            break;
        case 'OfferInProgress':
            $offerInProgressData[] = '<a href="./index2.php?page=view_documentz&id=' . $row['application_id'] . '" target="_blank">' . $row['docname'] . '<br></a>';
            break;
        case 'CandidateHired':
            $candidateHiredData[] = '<a href="./index2.php?page=view_documentz&id=' . $row['application_id'] . '" target="_blank">' . $row['docname'] . '<br></a>';
            break;
        case 'CandidateRejected':
            $candidateRejectedData[] ='<a href="./index2.php?page=view_documentz&id=' . $row['application_id'] . '" target="_blank">' . $row['docname'] . '<br></a>';
            break;
    }
}

// Close the last row
echo '<td style="font-size:11px; position: relative;">';
if (count($clientViewData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0; color: black; padding: 3px 6px; border-radius: 50%;">' . count($clientViewData) . '</span>';
}
echo implode(',', $clientViewData) . '</td>';


echo '<td style="font-size:11px; position: relative;">';
if (count($interviewProgressData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0; color: black; padding: 3px 6px; border-radius: 50%;">' . count($interviewProgressData) . '</span>';
}
echo implode(',', $interviewProgressData) . '</td>';



echo '<td style="font-size:11px; position: relative;">';
if (count($offerInProgressData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0; color: black; padding: 3px 6px; border-radius: 50%;">' . count($offerInProgressData) . '</span>';
}
echo implode(',', $offerInProgressData) . '</td>';



echo '<td style="font-size:11px; position: relative;">';
if (count($candidateHiredData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0; color: black; padding: 3px 6px; border-radius: 50%;">' . count($candidateHiredData) . '</span>';
}
echo implode(',', $candidateHiredData) . '</td>';


echo '<td style="font-size:11px; position: relative;">';
if (count($candidateRejectedData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0; color: black; padding: 3px 6px; border-radius: 50%;">' . count($candidateRejectedData) . '</span>';
}
echo implode(',', $candidateRejectedData) . '</td>';

echo '</tr>';

?>
           </tbody>
                </table>
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
