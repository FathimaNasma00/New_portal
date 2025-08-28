         
<style>
    .hidden{
	display:none;
}
.show
{
	display:block;
}
</style>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
		<h1>Candidate Summary</h1>
			<form action="" id="upload_candidate">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                <input type="hidden" name="sesid" value="<?php echo $_SESSION['login_id']; ?> ">
             
                
                <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="" class="control-label">Client  <span style="font-size:11px;color:red;">Read Only</span></label>
                            
                            <select class="form-control form-control-sm select2" Readonly  required name="clints" >
                              <?php 
                            $employees = $conn->query("SELECT * FROM clintmanege Where clint_id = '$clint_id' ");
                            while($row= $employees->fetch_assoc()){
                            ?>   
                            <option  value="<?php echo $row['clint_id'] ?>" selected><?php echo ucwords($row['clint_name']) ?></option>
                             <?php } ?>
                            
                          </select>
                            
						</div>
						
						
					</div>
				</div>
				
				<div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label for="" class="control-label">Application <span style="font-size:11px;color:red;">Read Only</span></label>
                          <select class="form-control form-control-sm select2" required Readonly  name="appli_ids">
                              <?php 
                            $employees = $conn->query("SELECT *,concat(title,' ',last_name) as name FROM documents where status	 = 1 AND id ='$application_id'  ");
                            while($row= $employees->fetch_assoc()){
                        $recq=$row['recruiter'];
						$reqanswr=$recq."0".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
                            ?>   
                            <option  value="<?php echo $row['id'] ?>" selected><?php echo ucwords($row['name']) ?>
                            <?php echo ucwords($row['name']). "&nbsp&nbsp - &nbsp&nbsp " .$row['recruiter']. "&nbsp&nbsp - &nbsp&nbsp ". $string ;
                            ?>
                            </option>
                             <?php } ?>
                              <?php 
                            $employees = $conn->query("SELECT *,concat(title,' ',last_name) as name FROM documents where status	 = 1 ");
                            while($row= $employees->fetch_assoc()){
                        $recq=$row['recruiter'];
						$reqanswr=$recq."0".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
                            ?>   
                            <option  value="<?php echo $row['id'] ?>" ><?php echo ucwords($row['name']) ?>
                            <?php echo ucwords($row['name']). "&nbsp&nbsp - &nbsp&nbsp " .$row['recruiter']. "&nbsp&nbsp - &nbsp&nbsp ". $string ;
                            ?>
                            </option>
                             <?php } ?>
                             
                    
                          </select>
                        </div>
                    </div>
				</div>
                 <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="" class="control-label">Feedback</label>
								<select name="feedback" id="feedback" required class="custom-select custom-select-sm select2 feedback">
								<option value="<?php if(isset($_GET['feedback'])){echo $_GET['feedback'];}else{} ?>"></option>
							 <option value="ClientReview" <?php echo isset($feedback) && $feedback == "ClientReview" ? 'selected' : '' ?>>Client Review</option>
                            <option value="InterviewInProcess" <?php echo isset($feedback) && $feedback == "InterviewInProcess" ? 'selected' : '' ?>> Interview In Process</option>
                                    
                            <option value="OfferInProcess" <?php echo isset($feedback) && $feedback == "OfferInProcess" ? 'selected' : '' ?>>Offer In Process</option>
                                    
                             <option value="CandidateHired" <?php echo isset($feedback) && $feedback == "CandidateHired" ? 'selected' : '' ?>>Candidate Hired</option>
                             
                             <option value="CandidateRejected" <?php echo isset($feedback) && $feedback == "CandidateRejected" ? 'selected' : '' ?>>Candidate Rejected</option>
                                 
                                
                                </select>
						</div>
						<div id="othersec" class="hidden">
						    <label for="" class="control-label">Rejected Reasons</label>
						    <select name="other_feedback"  class="custom-select custom-select-sm select2 feedback">
								<option value="<?php if(isset($_GET['feedback'])){echo $_GET['feedback'];}else{} ?>"></option>
							 <option value="CvRejected" <?php echo isset($feedback) && $feedback == "CvRejected" ? 'selected' : '' ?>>Cv Rejected</option>
                            <option value="HRScreeningRejected" <?php echo isset($feedback) && $feedback == "HRScreeningRejected" ? 'selected' : '' ?>>HR Screening Rejected</option>
                                    
                            <option value="TechnicalAssessmentRejected" <?php echo isset($feedback) && $feedback == "TechnicalAssessmentRejected" ? 'selected' : '' ?>>Technical Assessment Rejected</option>
                                    
                             <option value="BackgroundCheckingRejected" <?php echo isset($feedback) && $feedback == "BackgroundCheckingRejected" ? 'selected' : '' ?>>Background Checking Rejected</option>
                             
                             <option value="Level1Rejected" <?php echo isset($feedback) && $feedback == "Level1Rejected" ? 'selected' : '' ?>>Level 1 Rejected</option>
                             <option value="Level2Rejected" <?php echo isset($feedback) && $feedback == "Level2Rejected" ? 'selected' : '' ?>>Level 2 Rejected</option>
                             <option value="FinalInterviewRejected" <?php echo isset($feedback) && $feedback == "FinalInterviewRejected" ? 'selected' : '' ?>>Final Interview Rejected</option>
                             <option value="ClientRoundRejected" <?php echo isset($feedback) && $feedback == "ClientRoundRejected" ? 'selected' : '' ?>>Client Round Rejected</option>
                             <option value="PositionOnHold" <?php echo isset($feedback) && $feedback == "PositionOnHold" ? 'selected' : '' ?>>Position On Hold</option>
                             <option value="CandidateDidNotParticipateForTheInterview" <?php echo isset($feedback) && $feedback == "CandidateDidNotParticipateForTheInterview" ? 'selected' : '' ?>>Candidate Did Not Participate For The Interview</option>
                             <option value="CandidateNotResponding" <?php echo isset($feedback) && $feedback == "CandidateNotResponding" ? 'selected' : '' ?>>Candidate Not Responding</option>
                             <option value="CandidateDeclinedTheOffer" <?php echo isset($feedback) && $feedback == "CandidateDeclinedTheOffer" ? 'selected' : '' ?>>Candidate Declined The Offer</option>
                             <option value="CandidateGotAnotherOffer" <?php echo isset($feedback) && $feedback == "CandidateGotAnotherOffer" ? 'selected' : '' ?>>Candidate Got Another Offer</option>
                             <option value="CandidateIsNotWillingToChangeTheJob" <?php echo isset($feedback) && $feedback == "CandidateIsNotWillingToChangeTheJob" ? 'selected' : '' ?>>Candidate is not willing to change the job</option>
                             <option value="PositionClosedByClient" <?php echo isset($feedback) && $feedback == "PositionClosedByClient" ? 'selected' : '' ?>>Position Closed by Client</option>
                                 
                                
                                </select>
					
						</div>
						
					</div>
				</div>
				
				<div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="inputText" class="form-label"><span class="required">*</span> Job RefNo <span style="font-size:11px;">(Reference Name - RefNo - Client - Type)</span> <span style="font-size:11px;color:red;">Read Only</span></label>
                      <select class="form-control form-control-sm select2" Readonly name="job_refno" id="jobRefSelect">
                        <?php 
                            $jobrefno = $conn->query("SELECT job_management.id, job_management.jb_ref, job_management.jb_title, job_management.jb_type,
                              job_management.jb_workingtype, job_management.status, job_management.user_id, job_management.deadline,
                              CONCAT(users.firstname, ', ', users.middlename, ' ', users.lastname) AS name, clintmanege.clint_name
                              FROM job_management
                              INNER JOIN users ON (job_management.jb_recuiters = users.id)
                              INNER JOIN clintmanege ON (job_management.jb_client = clintmanege.clint_id)
                              WHERE job_management.status ='1' AND job_management.id = $job_refno AND job_management.id IN (
                                SELECT MAX(id)
                                FROM job_management
                                WHERE job_management.status = '1' 
                                GROUP BY jb_ref
                              )
                              ORDER BY job_management.id DESC ");
                            while($row= $jobrefno->fetch_assoc()){
                         $jb_type = '';
                            if($row['jb_type'] == "NW"){
                              $jb_type = 'New';
                            } elseif($row['jb_type'] == "RO") {
                              $jb_type = 'Re-open';
                            } elseif($row['jb_type'] == "Closed") {
                              $jb_type = 'Closed';
                            }
                            ?>   
                            <option  value="<?php echo $row['id'] ?>" selected <?php echo isset($job_refno) && in_array($row['job_refno'],explode(',',$job_refno)) ? "selected" : '' ?>>
                            <?php echo ucwords($row['jb_title']). "&nbsp&nbsp - &nbsp&nbsp " .$row['jb_ref']. "&nbsp&nbsp - &nbsp&nbsp ".$row['clint_name']. "&nbsp&nbsp - &nbsp&nbsp " . $jb_type ;
                            ?>
                            </option>
                             <?php } ?>
                             
                        <!-- Job RefNo options will be populated dynamically based on the selected client -->
                      </select>
                    </div>
                  </div>
                </div>
                
                	<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						    
						    <label for="inputText" class="form-label"><span class="required">*</span> CV Source by <span style="font-size:11px; color:red;">Read Only</span></label>
                            
                            <select class="form-control form-control-sm select2" Readonly  name="source_by">
                            <?php 
                            $employees = $conn->query("SELECT * FROM users WHERE type IN (1, 2, 3) AND active = 1 AND id NOT IN (5, 13, 19, 25,39) AND id = $source_by GROUP BY email order by id asc ");
                            while($row= $employees->fetch_assoc()){
                            ?>
                                
                             <option value="<?php echo $row['id'] ?> " selected <?php echo isset($recruiter) && in_array($row['recruiter'],explode(',',$recuiter)) ? "selected" : '' ?>>
                            <?php echo ucwords($row['recruiter']) ?>
                              
                              </option>
                                
    
                            <?php } ?>
                          </select>
                            
						</div>
						
						
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						     <?php 
                            $employees = $conn->query("SELECT * FROM users WHERE id='{$_SESSION['login_id']}' GROUP BY email order by id asc ");
                            while($row= $employees->fetch_assoc()){
                                $reprojectman= $row['recruiter'];
                            }
                            ?>
						    <input type="hidden" name="recuiter" value="<?php echo $reprojectman; ?> ">
                            
						</div>
						
						
					</div>
				</div>
				
		        <div class="row">
					<div class="col-md-12">
						<div class="form-group">
						    
						    <label for="inputText" class="form-label"><span class="required">*</span>Date  <span style="font-size:11px; color:red;">Read Only</span></label>
					        <input type="date" name="candi_updatedate"  class="form-control" value="<?php echo isset($date) ? $date : '' ?>">
						</div>
					</div>
				</div>
				
                
              <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="" class="control-label">Description (*optional)  <span style="font-size:11px;color:red">Read Only</span></label>
							<textarea name="description" id="" cols="10" rows="2" class=" form-control" Readonly>
								<?php echo isset($description) ? $description : '' ?>
							</textarea>
						</div>
					</div>
				</div>
				  <div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    		      <!--<a class="btn btn-danger  bg-gradient-primary mx-2" href="deletecandidateview.php?cand_id=<?php echo  $id; ?>&logid=<?php echo $_GET['logid']; ?>" onclick="return confirm('Are You Sure Want To Delete This Record!'); " ><i class="bi bi-trash-fill"></i></a>-->
               
    		    
    			<button class="btn btn-primary mx-2" form="upload_candidate">Save</button>
    			<button class="btn btn-secondary mx-2" type="button" >Cancel</button>
    		</div>
    	</div>
				
	
                
              
               
            </form>
        </div>
    </div>
    	
</div>
  
<script>
$('#upload_candidate').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_candidate',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.href = 'index.php?page=candidate'
					},2000)
				}
			}
		})
	})
</script>

 <script>
    $('.feedback').change(function(){
        var responsceID = $(this).val();
        if(responsceID =="CandidateRejected"){
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

<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_tracker').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Tracker Details","view_trackerdet.php?id="+$(this).attr('data-id'))
	})
	$('.delete_candidate').click(function(){
	_conf("Are you sure to delete this data?","delete_candidate",[$(this).attr('data-id')])
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