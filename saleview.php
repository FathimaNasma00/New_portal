<?php include 'db_connect.php'; ?>
<style>
  .container {
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






<body class="card card-body">
<main >
  
 <!-- Sales Pipeline Report -->
    <div class="col-12">
        <div class="sales-report overflow-auto">
            <div>

<!-- Sales Pipeline Report -->
    <div class="col-12" style="margin-top: 2.75rem;">
        <div class="card sales-report overflow-auto">
            <div class="container"  id="list-table">
               

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

// Fetch data from the MySQL query result
while ($row = $result->fetch_assoc()) {
    $candidate_id=$row['application_id'];
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


// Encode the PHP arrays into JSON format
$clientViewJson = json_encode($clientViewData);
$interviewProgressJson = json_encode($interviewProgressData);
$offerInProgressJson = json_encode($offerInProgressData);
$candidateHiredJson = json_encode($candidateHiredData);
$candidateRejectedJson = json_encode($candidateRejectedData);

?>

<div class="container"  id="list-table"></div>

<script>
const items = [
    
    {
    "name": "Client Review",
    "items":  <?php echo json_encode($clientViewData); ?>
  },
  {
    "name": "Interview Progress",
    "items":  <?php echo json_encode($interviewProgressData); ?>
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
  
  item.items.forEach(itemName => {
    const entry = document.createElement('div');
    const entryContent = document.createTextNode(itemName);
    const anchor = document.createElement('a');
    const candidateId = <?php echo json_encode($candidate_id); ?>;
    anchor.href = "./index2.php?page=view_documentz&id=" + candidateId; // Assuming you have an id for each document
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
    <!-- End Sales Pipeline Report -->
          
            </div>
        </div>
    </div>
</main>

</body>

<?php
$conn->close();
?>
