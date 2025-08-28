<?php
session_start(); // Start session

// Check if data exists in the session
if (isset($_SESSION['api_data'])) {
    $apiData = $_SESSION['api_data'];
} else {
    $apiData = []; // Default to an empty array if no data is available
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hunt - List</title>
 
    <style>
        body {
            font-size: 10px;
        }
    </style>
</head>
<body class="toggle-sidebar">
<main>
  <div class="pagetitle">
      <h1>HUNT</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Hunt</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div>
<div class="col-sm-12">
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <table class="table table-striped datatable mt-4">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Status</th>
            <th scope="col">Ref.No</th>
            <th scope="col">Name</th>
            <th scope="col">Skills</th>
            <th scope="col">Position</th>
            <th scope="col">Industry</th>
            <th scope="col">Gender</th>
            <th scope="col">Uploaded Date / Time</th>
          </tr>
        </thead>
        <tbody id="post_list">
          <?php
          $i = 1;
          foreach ($apiData as $candidate) {
              $status = "";
              if ($candidate['metadata']['status'] == 0) {
                  $status = '<span class="badge bg-warning">Pending</span>';
              } elseif ($candidate['metadata']['status'] == 1) {
                  $status = '<span class="badge bg-success">Approved</span>';
              } elseif ($candidate['metadata']['status'] == 2) {
                  $status = '<span class="badge bg-danger">Rejected</span>';
              }

              $refNo = htmlspecialchars($candidate['metadata']['ref_no']);
              if ($refNo <= 99) {
                  $reqanswr = $candidate['metadata']['recruiter'] . "00" . $refNo;
              } else {
                  $reqanswr = $candidate['metadata']['recruiter'] . "0" . $refNo;
              }
              $string = str_replace(' ', '', $reqanswr);

              $name = htmlspecialchars($candidate['metadata']['firstname'] . ' ' . $candidate['metadata']['lastname']);
              $skills = htmlspecialchars($candidate['metadata']['skills']);
              $position = htmlspecialchars($candidate['metadata']['position']);
              $industry = htmlspecialchars($candidate['metadata']['industry']);
              $gedner = htmlspecialchars($candidate['metadata']['gender'] ?? 'N/A');
              $uploadedDatetime = date("Y-m-d H:i", strtotime($candidate['metadata']['date'] ?? ''));

              echo "<tr>";
              echo "<td>" . $i++ . "</td>";
              echo "<td>$status</td>";
              echo "<td><a href='./index2.php?page=view_documentz&id={$candidate['metadata']['id']}' target='_blank'>$string</a></td>";
              echo "<td><a href='./index2.php?page=view_documentz&id={$candidate['metadata']['id']}' target='_blank'>$name</a></td>";
              echo "<td>$skills</td>";
              echo "<td>$position</td>";
              echo "<td>$industry</td>";
              echo "<td>$gedner</td>";
              echo "<td>$uploadedDatetime</td>";
              echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</main>
<script>
$(document).ready(function() {
    $('.datatable').DataTable({
        "searching": true
    });
});
</script>
</body>
</html>
