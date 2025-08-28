<?php include 'db_connect.php'; ?>
<body class="toggle-sidebar">
<main>
    <div class="pagetitle">
        <h1>Sales Dashboard Report</h1>
    </div>

    <!-- Sales Pipeline Report -->
    <div class="col-12">
        <div class="card sales-report overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Sales Pipeline Report : <a href ="saledashboardexcel.php">Print</a> </h5>

<?php
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
        WHERE job_management.jb_date = (
                SELECT MAX(jb_date)
                FROM job_management j
                WHERE j.jb_ref = job_management.jb_ref
                
            )  AND job_management.status = 1
        ORDER BY job_management.jb_title, clintmanege.clint_name";

$result = $conn->query($sql);

?>
   <table class="table table-bordered table-striped table-hover border border-start datatable">
                    <thead>
                        <tr>
                           
                            <th scope="col">Job Name</th>
                            <th scope="col">Client</th>
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
            echo '<td style="font-size:11px;">' . implode(',', $clientViewData) . '</td>';
            echo '<td style="font-size:11px;">' . implode(',', $interviewProgressData) . '</td>';
            echo '<td style="font-size:11px;">' . implode(',', $offerInProgressData) . '</td>';
            echo '<td style="font-size:11px;">' . implode(',', $candidateHiredData) . '</td>';
             echo '<td style="font-size:11px; position: relative;">';
if (count($clientViewData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0;  color: black; padding: 3px 6px; border-radius: 50%;">' . count($candidateRejectedData) . '</span>';
}
echo implode(',', $candidateRejectedData) . '</td>';
            echo '</tr>';
        }
        // Start a new row
        echo '<tr>';
        echo '<td style="font-size:13px;" >' . $row['jb_title'] . ' - ' . $row['jb_ref'] . '</td>';
        echo '<td style="font-size:13px;">' . $row['clint_name'] . '</td>';
        // Initialize category data arrays
        $clientViewData = $interviewProgressData = $offerInProgressData = $candidateHiredData = $candidateRejectedData = array();
        $current_jb_title = $row['jb_title'];
        $current_clint_name = $row['clint_name'];
    }

    // Append data to the corresponding category data array
    switch ($row['category']) {
        case 'ClientView':
            $clientViewData[] = '<a href="./index2.php?page=view_documentz&id=' . $row['application_id'] . '" target="_blank">' . $row['docname'] . '</a>';
            break;
        case 'InterviewProgress':
            $interviewProgressData[] = '<a href="./index2.php?page=view_documentz&id=' . $row['application_id'] . '" target="_blank">' . $row['docname'] . '</a>';
            break;
        case 'OfferInProgress':
            $offerInProgressData[] = '<a href="./index2.php?page=view_documentz&id=' . $row['application_id'] . '" target="_blank">' . $row['docname'] . '</a>';
            break;
        case 'CandidateHired':
            $candidateHiredData[] = '<a href="./index2.php?page=view_documentz&id=' . $row['application_id'] . '" target="_blank">' . $row['docname'] . '</a>';
            break;
        case 'CandidateRejected':
            $candidateRejectedData[] ='<a href="./index2.php?page=view_documentz&id=' . $row['application_id'] . '" target="_blank">' . $row['docname'] . '</a>';
            break;
    }
}

// Close the last row
 echo '<td style="font-size:11px; position: relative;">';
if (count($clientViewData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0;  color: black; padding: 3px 6px; border-radius: 50%;">' . count($clientViewData) . '</span>';
}
echo implode(',', $clientViewData) . '</td>';
echo '<td style="font-size:11px;">' . implode(',', $interviewProgressData) . '</td>';
echo '<td style="font-size:11px;">' . implode(',', $offerInProgressData) . '</td>';
echo '<td style="font-size:11px;">' . implode(',', $candidateHiredData) . '</td>';
 echo '<td style="font-size:11px; position: relative;">';
if (count($clientViewData) > 0) {
echo '<span style="position: absolute; top: 0; right: 0;  color: black; padding: 3px 6px; border-radius: 50%;">' . count($candidateRejectedData) . '</span>';
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
</main>
</body>

<?php

// Close your MySQLi connection here
$conn->close();
?>
