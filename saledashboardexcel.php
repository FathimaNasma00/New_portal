<?php include 'db_connect.php'; ?>
<?php
// Your MySQLi connection code here

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
        WHERE job_management.jb_date = (
                SELECT MAX(jb_date)
                FROM job_management j
                WHERE j.jb_ref = job_management.jb_ref
                
            )  AND job_management.status = 1
        ORDER BY job_management.jb_title, clintmanege.clint_name";

$result = $conn->query($sql);

// Set CSV headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="job_report.csv"');
header('Pragma: no-cache');
header('Expires: 0');

// Open output stream for writing CSV data
$output = fopen('php://output', 'w');

// Write CSV headers
fputcsv($output, ['Job Name', 'Client', 'Client Review', 'Interview Progress', 'Offer in Progress', 'Candidate Hired', 'Candidate Rejected']);

$current_jb_title = null;
$current_clint_name = null;

// Initialize arrays to store data for each category
$clientViewData = $interviewProgressData = $offerInProgressData = $candidateHiredData = $candidateRejectedData = array();

while ($row = $result->fetch_assoc()) {
    // Check if jb_title or clint_name changed
    if ($current_jb_title !== $row['jb_title'] || $current_clint_name !== $row['clint_name']) {
        if ($current_jb_title !== null) {
            // Write data to CSV
            fputcsv($output, [
                $current_jb_title,
                $current_clint_name,
                implode(',', $clientViewData),
                implode(',', $interviewProgressData),
                implode(',', $offerInProgressData),
                implode(',', $candidateHiredData),
                implode(',', $candidateRejectedData)
            ]);
        }
        // Start a new row
        $current_jb_title = $row['jb_title'];
        $current_clint_name = $row['clint_name'];
        // Initialize category data arrays
        $clientViewData = $interviewProgressData = $offerInProgressData = $candidateHiredData = $candidateRejectedData = array();
    }

    // Append data to the corresponding category data array
    switch ($row['category']) {
        case 'ClientView':
            $clientViewData[] = $row['docname'];
            break;
        case 'InterviewProgress':
            $interviewProgressData[] = $row['docname'];
            break;
        case 'OfferInProgress':
            $offerInProgressData[] = $row['docname'];
            break;
        case 'CandidateHired':
            $candidateHiredData[] = $row['docname'];
            break;
        case 'CandidateRejected':
            $candidateRejectedData[] = $row['docname'];
            break;
    }
}

// Close the last row
fputcsv($output, [
    $current_jb_title,
    $current_clint_name,
    implode(',', $clientViewData),
    implode(',', $interviewProgressData),
    implode(',', $offerInProgressData),
    implode(',', $candidateHiredData),
    implode(',', $candidateRejectedData)
]);

// Close the output stream
fclose($output);

// Close your MySQLi connection here
$conn->close();
?>
