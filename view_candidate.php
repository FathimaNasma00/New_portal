         
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
		<h1>Candidate Summary Details</h1>
			<form action="" id="upload_candidate">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                <input type="hidden" name="sesid" value="<?php echo $_SESSION['login_id']; ?> ">
             
                
                <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="" class="control-label">Client</label>
                            
                            <select class="form-control form-control-sm select2" readonly required name="clints">
                              <?php 
                            $employees = $conn->query("SELECT * FROM clintmanege Where clint_id = '$clint_id' ");
                            while($row= $employees->fetch_assoc()){
                            ?>   
                            <option  value="<?php echo $row['clint_id'] ?>" selected><?php echo ucwords($row['clint_name']) ?></option>
                             <?php } ?>
                            <?php 
                            $employees = $conn->query("SELECT * FROM clintmanege order by clint_id asc ");
                            while($row= $employees->fetch_assoc()){
                            ?>
                                
                             <option value="<?php echo $row['clint_id'] ?>" <?php echo isset($clints) && in_array($row['clint_id'],explode(',',$clints)) ? "selected" : '' ?>>
                            <?php echo ucwords($row['clint_name']) ?>
                              
                              </option>
                                
    
                            <?php } ?>
                          </select>
                            
						</div>
						
						
					</div>
				</div>
				
				<div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label for="" class="control-label">Application</label>
                          <select class="form-control form-control-sm select2" required readonly  name="appli_ids">
                              <?php 
                            $employees = $conn->query("SELECT *,concat(title,' ',last_name) as name FROM documents where status	 = 1 AND id ='$application_id'  ");
                            while($row= $employees->fetch_assoc()){
                            ?>   
                            <option  value="<?php echo $row['id'] ?>" selected><?php echo ucwords($row['name']) ?></option>
                             <?php } ?>
                            <?php 
                            $employees = $conn->query("SELECT *,concat(title,' ',last_name) as name FROM documents where status	 = 1 order by id asc ");
                            while($row= $employees->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row['id'] ?>" <?php echo isset($appli_ids) && in_array($row['id'],explode(',',$appli_ids)) ? "selected" : '' ?>>
                            <?php echo ucwords($row['name']) ?>
                              
                              </option>
                            <?php endwhile; ?>
                          </select>
                        </div>
                    </div>
				</div>
                 <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="" class="control-label">Feedback</label>
								<select name="feedback" id="feedback" required readonly class="custom-select custom-select-sm select2 feedback">
								<option value="<?php if(isset($_GET['feedback'])){echo $_GET['feedback'];}else{} ?>"></option>
							<option value="SentForClientReview" <?php echo isset($feedback) && $feedback == "SentForClientReview" ? 'selected' : '' ?>>Sent For Client Review</option>
                            <option value="PendingReview" <?php echo isset($feedback) && $feedback == "PendingReview" ? 'selected' : '' ?>>Pending Review</option>
                                    
                            <option value="CVRejected" <?php echo isset($feedback) && $feedback == "CVRejected" ? 'selected' : '' ?>>CV Rejected</option>
                                    
                             <option value="CandidateNotResponding" <?php echo isset($feedback) && $feedback == "CandidateNotResponding" ? 'selected' : '' ?>>Candidate Not Responding</option>
                                    
                             <option value="InterviewScheduled" <?php echo isset($feedback) && $feedback == "InterviewScheduled" ? 'selected' : '' ?>>Interview Scheduled</option>
                                    
                                    
                             <option value="CandidateDidNot" <?php echo isset($feedback) && $feedback == "CandidateDidNot" ? 'selected' : '' ?>>Candidate Did Not</option>
                                    
                                    
                             <option value="ParticipateForInterview " <?php echo isset($feedback) && $feedback == "ParticipateForInterview" ? 'selected' : '' ?>>Participate For Interview</option>
                                    
                                    
                             <option value="L1Rejected" <?php echo isset($feedback) && $feedback == "L1Rejected" ? 'selected' : '' ?>>L1 Rejected</option>
                                    
                                    
                             <option value="L2Rejected" <?php echo isset($feedback) && $feedback == "L2Rejected" ? 'selected' : '' ?>> L2 Rejected</option>
                                    
                                    
                             <option value="L3Rejected" <?php echo isset($feedback) && $feedback == "L3Rejected" ? 'selected' : '' ?>>L3 Rejected</option>
                                    
                                    
                             <option value="Selected" <?php echo isset($feedback) && $feedback == "Selected" ? 'selected' : '' ?>>Selected</option>
                                    
                                    
                             <option value="Offered" <?php echo isset($feedback) && $feedback == "Offered" ? 'selected' : '' ?>>Offered</option>
                                    
                                    
                             <option value="Hired" <?php echo isset($feedback) && $feedback == "Hired" ? 'selected' : '' ?>>Hired</option>
                                    
                                    
                             <option value="CandidateDeclindedOffer" <?php echo isset($feedback) && $feedback == "CandidateDeclindedOffer" ? 'selected' : '' ?>>Candidate Declinded Offer</option>
                                    
                                    
                             <option value="PendingFeedBack" <?php echo isset($feedback) && $feedback == "PendingFeedBack" ? 'selected' : '' ?>>Pending FeedBack</option>
                                    
                                    
                             <option value="OnHold" <?php echo isset($feedback) && $feedback == "OnHold" ? 'selected' : '' ?>>On Hold</option>
                                    
                                     <option value="PositionClosed" <?php echo isset($feedback) && $feedback == " PositionClosed" ? 'selected' : '' ?>> Position Closed</option>
                                
                            <option value="Other"<?php echo isset($feedback) && $feedback == "Other" ? 'selected' : '' ?> >Other</option>>
                                </select>
						</div>
						<div id="othersec" class="hidden">
						    <label for="" class="control-label">Other Feedback(*optional)</label>
						<input type="text" class="form-control form-control-sm" name="other_feedback" value="<?php echo isset($other_feedback) ? $other_feedback : '' ?>">
						</div>
						
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="" class="control-label">Recruiter</label>
                            
                            <select class="form-control form-control-sm select2" readonly  required name="recuiter">
                            <option></option>
                            <?php 
                            $employees = $conn->query("SELECT * FROM users order by id asc ");
                            while($row= $employees->fetch_assoc()){
                            ?>
                                
                             <option readonly value="<?php echo $row['recruiter'] ?>" <?php echo isset($recuiter) && in_array($row['recruiter'],explode(',',$recuiter)) ? "selected" : '' ?>>
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
							<label for="" class="control-label">Description (*optional)</label>
							<textarea readonly name="description" id="" cols="10" rows="2" class=" form-control">
								<?php echo isset($description) ? $description : '' ?>
							</textarea>
						</div>
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