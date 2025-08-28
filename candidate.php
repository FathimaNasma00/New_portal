<?php include'db_connect.php' ?>
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
<main>
  <div class="pagetitle">
      <h1>Candidate Summary</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Candidate Summary</li>
          <li class="breadcrumb-item active">All Summary List</li>
        </ol>
      </nav>
    </div>
<div class="col-lg-12">
	<div class="card recent-sales overflow-auto">
		<div class="card-header">
		    <div class="row">
		        <div class="col-2" style="flex: 0 0 11.666667%;"> <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button></div>
		        <div class="col-2">
		          <form method="post" action="candidatesumexport.php">
                    <button type="submit" name="export" class="btn btn-success" style="left:0px;" value="Export" />Export&nbsp;<i class="fas fa-file-export"></i></button>
                    </form>
		        </div>
		        <div class="col-8">
		      <div class="card-tools" style="right:0px;">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index2.php?page=candidateinput"><i class="fa fa-plus"></i> Add New Candidate</a>
			</div>
		        </div>
		    </div>
		   
			
		</div>
		<div class="card-body">
			<table class="table table-borderless datatable">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Ref No</th>
						<th>Application</th>
						<th>Client Name</th>
						<th>Feedback</th>
						<th>Job Ref</th>
						<th>Job Open Date</th>
						<th>Recruiter</th>
						<th>Account Manager</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				    <?php
$i = 1;

$qry = $conn->query("
    SELECT DISTINCT documents.ref_no, documents.title, documents.last_name, candidate_summery.application_id, 
                    clintmanege.clint_name, candidate_summery.feedback, documents.recruiter, candidate_summery.recuiter AS rec, 
                    candidate_summery.id, candidate_summery.date, CONCAT(users.firstname, ' ', users.lastname) AS name, 
                    job_management.jb_title, job_management.jb_ref,job_management.jb_date, job_management.id AS jobid,job_management.status,
                    (SELECT account_manager.recruiter
                     FROM users AS account_manager 
                     WHERE account_manager.id = job_management.jb_recuiters) AS account_manager
    FROM candidate_summery
    INNER JOIN documents ON candidate_summery.application_id = documents.id
    INNER JOIN clintmanege ON candidate_summery.clint_id = clintmanege.clint_id
    INNER JOIN users ON candidate_summery.source_by = users.id
    INNER JOIN job_management ON candidate_summery.job_refno = job_management.id
    WHERE (documents.ref_no, clintmanege.clint_name, candidate_summery.recuiter, candidate_summery.date) IN (
        SELECT documents.ref_no, clintmanege.clint_name, candidate_summery.recuiter, MAX(candidate_summery.date) AS max_date
        FROM candidate_summery
        INNER JOIN documents ON candidate_summery.application_id = documents.id
        INNER JOIN clintmanege ON candidate_summery.clint_id = clintmanege.clint_id
        INNER JOIN users ON candidate_summery.source_by = users.id
        INNER JOIN job_management ON candidate_summery.job_refno = job_management.id
        GROUP BY documents.ref_no, clintmanege.clint_name, candidate_summery.recuiter
    )
    ORDER BY candidate_summery.id DESC;
");

while ($row = $qry->fetch_assoc()) {
    $date = $row['date'];
    $recq = $row['recruiter'];
    if ($row['ref_no'] <= 99) {
        $recq = $row['recruiter'];
        $reqanswr = $recq . "00" . $row['ref_no'];
        $string = str_replace(' ', '', $reqanswr);
    } else {
        $recq = $row['recruiter'];
        $reqanswr = $recq . "0" . $row['ref_no'];
        $string = str_replace(' ', '', $reqanswr);
    }
?>
    <tr>
        <th class="text-center"><?php echo $i++; ?></th>
        <td><b><a target="_blank" href="./index2.php?page=view_documentz&id=<?php echo $row['application_id'] ?>"><?php echo $string; ?></a></b></td>
        <td><b><a target="_blank" href="./index2.php?page=edite_candidate&id=<?php echo $row['id'] ?>"><?php echo $row['title']; ?> &nbsp;<?php echo $row['last_name']; ?></a></b></td>
        <td><b><?php echo $row['clint_name']; ?></b></td>
        <td><b><?php 
            $feed = $row['feedback'];
            $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $feed);
            echo $words; 
        ?></b></td>
        <td><b><?php echo $row['jb_title']; ?> - </b> 
        <a target="_blank" href="<?php 
                                if ($row["status"] == 1) {
                                    echo "./index2.php?page=saledataview&id=" . $row["jobid"];
                                } else {
                                    echo "./index2.php?page=saledatainactiveview&id=" . $row["jobid"];
                                }
                            ?>"><b><?php echo $row['jb_ref']; ?> </b></a></td>
        <td><b><?php echo date("M d, Y", strtotime($row['jb_date'])); ?></b></td>
        <td><b><?php echo $row['name']; ?></b></td>
        <td><b><?php echo $row['account_manager']; ?></b></td>
        <td><b><?php echo date("M d, Y", strtotime($date)); ?></b></td>
        <td class="text-center">
            <div class="btn-group">
                <a href="./index2.php?page=edite_candidate&id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>" target="_blank" class="btn btn-primary btn-flat edit_candidate">
                    <i class="bi bi-slash-square"></i>
                </a>
                <?php if(($_SESSION['login_type'] == 1 )){ ?>
                   <a href="deletecandidate.php?delete_id=<?php echo $row['id']; ?>"  class="btn btn-danger btn-flat" onclick="return confirm('Are You Sure Want To Delete This Record!'); " >
		                            <i class="bi bi-trash-fill"></i>
		                        </a>
                <?php } ?>
            </div>
        </td>
    </tr>
<?php } ?>
</tbody>
			</table>
		</div>
	</div>
	</div>
</main>

<script>
	$(document).ready(function(){
		$('#list').dataTable()
// 	$('.view_candisdate').click(function(){
// 		_conf("<i class='fa fa-id-card'></i> Candidate Summery ","view_candidate.php?id="+$(this).attr('data-id'))
// 	})
//     $('.edit_candidate').click(function(){
// 		_conf("<i class='fa fa-id-card'></i>Are your Sure to Edit this Candidate Summery","editecandidate.php?id="+$(this).attr('data-id'))
// 	})
	$('#delete_candidate').click(function(){
	_conf("Are you sure to delete this Candidate Summery?","delete_candidate",[$(this).attr('data-id')])
	})
	})
	
		function delete_candidate($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_candidate',
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

<script>
    $('.feedback').change(function(){
        var responsceID = $(this).val();
        if(responsceID =="Other"){
            $('#othersec').removeClass("hidden");
             $('#othersec').addClass("show");
        }
        else{
              $('#othersec').removeClass("show");
             $('#othersec').addClass("hidden");
        }
        console.log(responsceID);
    });
     
 </script>