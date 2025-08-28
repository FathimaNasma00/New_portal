<?php include'db_connect.php' ?>
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
    <!-- -------------------------------------End Page Title---------------------------------------------------------- -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css" />
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
    
  <style>
  .bootstrap-tagsinput {
   width: 100%;
  }
  </style>
  
  
    
 <div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <form method="post" action="">
                <div class="form-group col-sm-3">
                    <label for="byskills" class="form-label">Skills:</label>
                    <input type="text" id="byskills" name="byskills" class="form-control" data-role="tagsinput" placeholder="Enter skills">
                </div>
                <div class="form-group col-sm-3">
                    <label for="bypostion" class="form-label">Position:</label>
                    <input type="text" id="bypostion" name="bypostion" class="form-control" data-role="tagsinput" placeholder="Enter position">
                </div>
                <div class="form-group col-sm-3">
                    <label for="byindistry" class="form-label">Industry:</label>
                    <input type="text" id="byindistry" name="byindistry" class="form-control" data-role="tagsinput" placeholder="Enter industry">
                </div>
                 <div class="form-group col-sm-3">
                    <label for="byfilter" class="form-label"> &nbsp;</label>
                   <button type="submit" name="filter" class="btn btn-primary form-control">Filter  &nbsp; <i class="bi bi-funnel-fill"></i></button>
                </div>
                
            </form>
        </div>
    </div>
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
            <th scope="col">Phone No</th>
            <th scope="col">Uploaded Date / Time</th>
          </tr>
        </thead>
     
         <tbody id="post_list">
    <?php
    date_default_timezone_set("Asia/Colombo");
    $i = 1;
    $where = '';
    if ($_SESSION['login_type'] == 1) {
        $user = $conn->query("SELECT * FROM users WHERE id IN (SELECT user_id FROM documents)");
        while ($row = $user->fetch_assoc()) {
            $uname[$row['id']] = ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']);
        }
    } else {
        $where = " WHERE user_id = '{$_SESSION['login_id']}'";
    }

    if (isset($_POST["filter"])) {
        // Initialize an array to hold filter conditions
$filterConditions = [];

// Check if each filter is set and add to the conditions array
if (!empty($_POST["byskills"])) {
    // Sanitize and format the input for REGEXP
    $byskills = str_replace(",", "|", $_POST["byskills"]);
    $filterConditions[] = "tag REGEXP '{$byskills}'";
}

if (!empty($_POST["bypostion"])) {
    // Sanitize and format the input for REGEXP
    $bypostion = str_replace(",", "|", $_POST["bypostion"]);
    $filterConditions[] = "position REGEXP '{$bypostion}'";
}

if (!empty($_POST["byindistry"])) {
    // Sanitize and format the input for REGEXP
    $byindistry = str_replace(",", "|", $_POST["byindistry"]);
    $filterConditions[] = "industry REGEXP '{$byindistry}'";
}

// Construct the WHERE clause based on the filter conditions
$whereClause = '';
if (!empty($filterConditions)) {
    $whereClause = 'WHERE ' . implode(' AND ', $filterConditions);
}

// Build the query with the dynamic WHERE clause
$qry = $conn->query("SELECT * FROM documents {$whereClause}
    ORDER BY unix_timestamp(date_created) DESC
   ");
    } else {
        $qry = $conn->query("SELECT * FROM documents ORDER BY unix_timestamp(date_created) DESC ");
    }

    while ($row = $qry->fetch_assoc()) {
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['description']), $trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
        if ($row['ref_no'] <= 99) {
            $recq = $row['recruiter'];
            $reqanswr = $recq . "00" . $row['ref_no'];
            $string = str_replace(' ', '', $reqanswr);
        } else {
            $recq = $row['recruiter'];
            $reqanswr = $recq . "0" . $row['ref_no'];
            $string = str_replace(' ', '', $reqanswr);
        }

        $status_badge = "";
        if ($row['status'] == 0) {
            $status_badge = '<span class="badge bg-warning">Pending</span>';
        } elseif ($row['status'] == 1) {
            $status_badge = '<span class="badge bg-success">Approved</span>';
        } elseif ($row['status'] == 2) {
            $status_badge = '<span class="badge bg-danger">Rejected</span>';
        }
    ?>
        <tr>
            <th class="text-center" style="font-size:12px;"><?php echo $i++; ?></th>
            <td><?php echo $status_badge; ?></td>
            <td><a href="./index2.php?page=view_documentz&id=<?php echo $row['id']; ?>" target="_blank"><b style="font-size:14px;"><?php echo $string; ?></b></a></td>
            <td><a href="./index2.php?page=view_documentz&id=<?php echo $row['id']; ?>" target="_blank"><b style="font-size:14px;"><?php echo ucwords($row['title']); ?> <?php echo ucwords($row['last_name']); ?></b></a></td>
            <td><b style="font-size:10px;"><?php echo ucwords($row['tag']); ?></b></td>
            <td><b style="font-size:10px;"><?php echo ucwords($row['position']); ?></b></td>
            <td><b style="font-size:10px;"><?php echo ucwords($row['industry']); ?></b></td>
            <td><b style="font-size:14px;"><?php echo ucwords($row['phonenumber']); ?></b></td>
            <td><b style="font-size:14px;"><?php echo ucwords($row['date']); ?> <?php echo ucwords($row['time']); ?></b></td>
        </tr>
    <?php } ?>
</tbody>

        </tbody>
      </table>
    </div>
  </div>
</div>

            
</main>

</div>


<script>
$(document).ready(function() {
    // Initialize DataTables
    $('.datatable').DataTable({
        "pageLength": 10, // Default number of rows per page
        "lengthMenu": [ [5, 10, 15, 20, 25, 50, 100, 150, 200, 500, -1], 
                        [5, 10, 15, 20, 25, 50, 100, 150, 200, 500, "All"] ], // Options for page length
        "ordering": true, // Enable column ordering
        "searching": true, // Enable search functionality
        "info": true // Show table information
    });
});
</script>
</body> 



<script>
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        fetch('hunt_filter_logic.php', { // URL should be the script that processes the AJAX request
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('post_list').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    });
</script>

<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.delete_document').click(function(){
	_conf("Are you sure to delete this document?","delete_document",[$(this).attr('data-id')])
	})
	})
	function delete_document($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_file',
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
