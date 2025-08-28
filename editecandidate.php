<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
             $qry = $conn->query("SELECT * FROM candidate_summery where id = ".$_GET['id'])->fetch_array();
                    foreach($qry as $k => $v){
                        $$k = $v;
                    }
}
?>
<div class="container-fluid">
	<div class="card card-widget widget-user shadow">
      <div class="card-footer">
        <div class="container-fluid">
          
			<form action="" id="update_candidate">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>" readonly>
             
				
                 <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="" class="control-label">Feed Back</label>
								<select name="feedback" id="feedback" required class="custom-select custom-select-sm feedback" readonly>
								<option value="<?php if(isset($_GET['feedback'])){echo $_GET['feedback'];}else{} ?>"></option>
                            	<option value="SentForClientReview" <?php echo isset($feedback) && $feedback == "SentForClientReview" ? 'selected' : '' ?>>Sent For Client Review</option>
                            <option value="PendingReview" <?php echo isset($feedback) && $feedback == "PendingReview" ? 'selected' : '' ?>>Pending Review</option>
                                    
                            <option value="CVRejected" <?php echo isset($feedback) && $feedback == "CVRejected" ? 'selected' : '' ?>>CV Rejected</option>
                                    
                             <option value="CandidateNotResponding" <?php echo isset($feedback) && $feedback == "CandidateNotResponding" ? 'selected' : '' ?>>Candidate Not Responding</option>
                             
                             <option value="CandidateDidNotParticipateForTheInterview" <?php echo isset($feedback) && $feedback == "CandidateDidNotParticipateForTheInterview" ? 'selected' : '' ?>>Candidate Did Not Participate For The Interview</option>
                                    
                             <option value="InterviewScheduled" <?php echo isset($feedback) && $feedback == "InterviewScheduled" ? 'selected' : '' ?>>Interview Scheduled</option>
                                    
                             <option value="ParticipateForInterview " <?php echo isset($feedback) && $feedback == "ParticipateForInterview" ? 'selected' : '' ?>>Participate For Interview</option>
                             
                             <option value="YettoSchedule" <?php echo isset($feedback) && $feedback == "YettoSchedule" ? 'selected' : '' ?>>Yet to Schedule</option>       
                                    
                             <option value="L1Rejected" <?php echo isset($feedback) && $feedback == "L1Rejected" ? 'selected' : '' ?>>L1 Rejected</option>
                                    
                                    
                             <option value="L2Rejected" <?php echo isset($feedback) && $feedback == "L2Rejected" ? 'selected' : '' ?>> L2 Rejected</option>
                                    
                                    
                             <option value="L3Rejected" <?php echo isset($feedback) && $feedback == "L3Rejected" ? 'selected' : '' ?>>L3 Rejected</option>
                                    
                                    
                             <option value="Selected" <?php echo isset($feedback) && $feedback == "Selected" ? 'selected' : '' ?>>Selected</option>
                                    
                                    
                             <option value="Offered" <?php echo isset($feedback) && $feedback == "Offered" ? 'selected' : '' ?>>Offered</option>
                                    
                                    
                             <option value="Hired" <?php echo isset($feedback) && $feedback == "Hired" ? 'selected' : '' ?>>Hired</option>
                                    
                                    
                             <option value="CandidateDeclindedOffer" <?php echo isset($feedback) && $feedback == "CandidateDeclindedOffer" ? 'selected' : '' ?>>Candidate Declinded Offer</option>
                              
                             <option value="CandidateAcceptedAnotherOffer" <?php echo isset($feedback) && $feedback == "CandidateAcceptedAnotherOffer" ? 'selected' : '' ?>>Candidate Accepted Another Offer</option>
                             
                             <option value="PositionOnHold&PositionClosed" <?php echo isset($feedback) && $feedback == "PositionOnHold&PositionClosed" ? 'selected' : '' ?>>Position on hold & Position Closed</option>
                                    
                                    
                             <option value="PendingFeedBack" <?php echo isset($feedback) && $feedback == "PendingFeedBack" ? 'selected' : '' ?>>Pending FeedBack</option>
                                    
                                    
                             <option value="OnHold" <?php echo isset($feedback) && $feedback == "OnHold" ? 'selected' : '' ?>>On Hold</option>
                                    
                                    
                                
                            <option value="Other"<?php echo isset($feedback) && $feedback == "Other" ? 'selected' : '' ?> >Other</option>>
                                </select>
						</div>
						<div id="othersec" class="hidden">
						    <label for="" class="control-label">Other Task(*optional)</label>
						<input type="text" class="form-control form-control-sm feedback" name="other_feedback" readonly value="<?php echo isset($other_feedback) ? $other_feedback : '' ?>">
						</div>
						
					</div>
				</div>
                
              <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="" class="control-label">Description (*optional)</label>
							<textarea name="description" id="" cols="10" rows="2" class=" form-control" readonly>
								<?php echo isset($description) ? $description : '' ?>
							</textarea>
						</div>
					</div>
				</div>
                
             <div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    		     <?php 
          $candidateHis = "SELECT documents.id AS docid,documents.recruiter, documents.title, documents.last_name, documents.ref_no, documents.accesby, documents.status, documents.reject_resons, documents.date AS Ddate, users.recruiter AS acces,candidate_summery.feedback,candidate_summery.id AS can_id, candidate_summery.date AS summery_date, candidate_summery.recuiter AS summery_recuiter, clintmanege.clint_name
                          FROM documents
                          INNER JOIN users ON (documents.accesby = users.id)
                          LEFT JOIN candidate_summery ON (documents.id = candidate_summery.application_id)
                          LEFT JOIN clintmanege ON (candidate_summery.clint_id = clintmanege.clint_id)
                         
                          WHERE documents.id = '{$_GET['id']}' Order By candidate_summery.id DESC ";

          $candidate_His = mysqli_query($conn, $candidateHis);
          
          while ($rowz = mysqli_fetch_assoc($candidate_His)) {
        ?>
    		      <a class="btn btn-danger  bg-gradient-primary mx-2" href="deletecandidateview.php?cand_id=<?php echo $rowz['can_id']; ?>&logid=<?php echo $_GET['logid']; ?>" onclick="return confirm('Are You Sure Want To Delete This Record!'); " ><i class="bi bi-trash-fill"></i></a>
         <?php } ?>      
    		    <!--<button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button>-->
    			<!--<button class="btn btn-flat  bg-gradient-primary mx-2" form="upload_candidate">Save</button>-->
    			<!--<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" >Cancel</button>-->
    		</div>
    	</div>
				
				    <div class="col-12">
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <i class="bi bi-folder me-1"></i> This Read Only ("If you want Change Feedback Please Add New from Cadidate Summery Via Or Roadmap Via")
                
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>
               
            </form>
        </div>
    </div>
	</div>
</div>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>
<script>
$('#update_candidate').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=update_candidate',
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