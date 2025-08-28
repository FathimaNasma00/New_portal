         
<style>
    .hidden{
	display:none;
}
.show
{
	display:block;
}
</style>
            

  <main>

    <div class="pagetitle">
      <h1>Candidate Summary</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Candidate Summary</li>
          <li class="breadcrumb-item active">Add Summary</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <style>
        .required{
            display: inline-block;
    margin-right: 4px;
    color: #e93e3e;
    font-size: 16px;
    font-family: SimSun,sans-serif;
    line-height: 1;
    content: "*";
        }
        .card .card-body{background:;#f6f9ff;}
    </style>
    <section class="section">
         <div class="col-md-12">
      <div class="row ">
        <div class=" justify-content-center ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Candidate Summary</h5>
			            <form action="" id="upload_candidate">
                <input type="hidden" name="sesid" value="<?php echo $_SESSION['login_id']; ?> ">
             
                
                <div class="row ">
					<div class="col-md-10">
						<div class="form-group">
                              <label for="inputText" class="form-label"><span class="required">*</span> Client</label>
                            <select class="form-control form-control-sm select2"  required name="clints" id="clientSelect">
                            <option></option>
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
				
				<div class="row ">
                     <div class="col-md-12">
                        <div class="form-group">
                        <label for="inputText" class="form-label"><span class="required">*</span> Application <span style="font-size:11px;">(Name - Recruiter - RefNo)</span></label>
                          <select class="form-control form-control-sm select2" required  name="appli_ids">
                            <option></option>
                            <?php 
                            $employees = $conn->query("SELECT *,concat(title,' ',last_name) as name , recruiter, ref_no FROM documents where status	 = 1 order by id asc ");
                            while($row= $employees->fetch_assoc()):
                            	if($row['ref_no'] <= 99){
        						$recq=$row['recruiter'];
        						$reqanswr=$recq."00".$row['ref_no'];
        						$string = str_replace(' ','',$reqanswr);
        						}else{
        						 $recq=$row['recruiter'];
        						$reqanswr=$recq."0".$row['ref_no'];
        						$string = str_replace(' ','',$reqanswr);
        						}  
                            ?>
                            <option value="<?php echo $row['id'] ?>" <?php echo isset($appli_ids) && in_array($row['id'],explode(',',$appli_ids)) ? "selected" : '' ?>>
                            <?php echo ucwords($row['name']). "&nbsp&nbsp - &nbsp&nbsp " .$row['recruiter']. "&nbsp&nbsp - &nbsp&nbsp ". $string ;
                            ?>
                              </option>
                             <?php endwhile; ?>
                          </select>
                          
                        </div>
                    </div>
				</div>
                 <div class="row">
					<div class="col-md-12">
						<div class="form-group">
						    <label for="inputText" class="form-label"><span class="required">*</span> Feedback</label>
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
                      <label for="inputText" class="form-label"><span class="required">*</span> Job RefNo <span style="font-size:11px;">(Reference Name - RefNo - Client - Type)</span></label>
                      <select class="form-control form-control-sm select2" required name="job_refno" id="jobRefSelect">
                        <option></option>
                        <!-- Job RefNo options will be populated dynamically based on the selected client -->
                      </select>
                    </div>
                  </div>
                </div>
				
				<script>
                  $(document).ready(function() {
                    $('#clientSelect').change(function() {
                      var clientId = $(this).val();
                      // Make an AJAX request to fetch Job RefNos based on the selected client
                      $.ajax({
                        url: 'candidate_getref.php', // Replace with the actual PHP file to fetch Job RefNos
                        method: 'POST',
                        data: { clientId: clientId },
                        success: function(response) {
                          $('#jobRefSelect').html(response);
                        }
                      });
                    });
                  });
                </script>
				
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
						    
						    <label for="inputText" class="form-label"><span class="required">*</span> CV Source by</label>
                            
                            <select class="form-control form-control-sm select2" required  name="source_by">
                            <option></option>
                            <?php 
                            $employees = $conn->query("SELECT * FROM users WHERE type IN (1, 2, 3) AND active = 1 AND id NOT IN (5, 13, 19, 25,39) GROUP BY email order by id asc ");
                            while($row= $employees->fetch_assoc()){
                            ?>
                                
                             <option value="<?php echo $row['id'] ?>" <?php echo isset($recuiter) && in_array($row['recruiter'],explode(',',$recuiter)) ? "selected" : '' ?>>
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
						    
						    <label for="inputText" class="form-label"><span class="required">*</span>Date</label>
					        <input type="date" name="candi_updatedate"  required class="form-control">
						</div>
					</div>
				</div>
						
                
              <div class="row">
					<div class="col-md-12">
						<div class="form-group">
						    
						    <label for="inputText" class="form-label"> Description (*optional)</label>
							<textarea name="description" id="" cols="10" rows="2" class=" form-control">
								<?php echo isset($description) ? $description : '' ?>
							</textarea>
						</div>
					</div>
				</div>
                
                <div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    		    <button onclick="history.go(-1);" class="btn btn-secondary"><i class="fas fa-reply"></i> &nbsp; Back</button>
    			<button class="btn btn-primary  bg-gradient-primary mx-2" form="upload_candidate">Save</button>
    		</div>
    	</div>
               
            </form>
             </div>
             </div>
             </div>
             </div>
             </div>
     </section>

			<!------------------------------------- POP UP--------------------------------------------->
			
				<div class="container">
    				<div id="modalDialog" class="col-6 align-middle" style="background:#fff;padding:10px;position: fixed;margin-top:20%;top: 0;z-index: 1050;display: none;width: 50%;height: 50%;overflow: hidden;outline: 0;">
                            <div class="modal-content animate-top align-middle card" style="padding:10px;">
                                <div class="modal-header">
                                    <h5 class="card-title">Sale Revenue</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form  action="" id="contactFrm" method="post">
                                <div class="modal-body">
                                    <!-- Form submission status -->
                                    <div class="response"></div>
                                    
                                    <!-- Contact form -->
                            <div class="form-group">
    							<label for="" class="control-label">Client</label>
                                
                                <select class="form-control form-control-sm select2"  required name="clints">
                                <option></option>
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
    						
                                    <div class="form-group">
                                        <label>Candidate <span style="font-size:11px;">(Name - Recruiter - RefNo)</span></label>
                                        <select class="form-control form-control-sm select2" required  name="appli_ids" id="appli_ids">
                                        <option></option>
                                        <?php 
                                        $employees = $conn->query("SELECT *,concat(title,' ',last_name) as name , recruiter, ref_no FROM documents where status	 = 1 order by id asc ");
                                        while($row= $employees->fetch_assoc()):
                                	       $date=$row['date'];
                    					    if($row['ref_no'] <= 99){
                    						$recq=$row['recruiter'];
                    						$reqanswr=$recq."00".$row['ref_no'];
                    						$string = str_replace(' ','',$reqanswr);
                    						}else{
                    						 $recq=$row['recruiter'];
                    						$reqanswr=$recq."0".$row['ref_no'];
                    						$string = str_replace(' ','',$reqanswr);
                    						}
                                        ?>
                                        <option value="<?php echo $row['id'] ?>" <?php echo isset($appli_ids) && in_array($row['id'],explode(',',$appli_ids)) ? "selected" : '' ?>>
                                        <?php echo ucwords($row['name']). "&nbsp&nbsp - &nbsp&nbsp " .$row['recruiter']. "&nbsp&nbsp - &nbsp&nbsp ". $string ;
                                        ?>
                                          </option>
                                         <?php endwhile; ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount:</label>
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Date Of Join:</label>
                                        <input type="date" name="join_date" id="join_date"  class="form-control">
                                    </div>
					
            						<div class="form-group">
            							<label for="" class="control-label">Account Manager</label>
                                        
                                        <select class="form-control form-control-sm select2"  required name="recuiter" id="recuiter">
                                        <option></option>
                                        <?php 
                                        $employees = $conn->query("SELECT * FROM users WHERE type IN (1, 2, 3) AND active = 1 AND id NOT IN (5, 13, 19, 25,39) GROUP BY email order by id asc ");
                                        while($row= $employees->fetch_assoc()){
                                        ?>
                                            
                                         <option value="<?php echo $row['recruiter'] ?>" <?php echo isset($recuiter) && in_array($row['recruiter'],explode(',',$recuiter)) ? "selected" : '' ?>>
                                        <?php echo ucwords($row['recruiter']) ?>
                                          
                                          </option>
                                            
                
                                        <?php } ?>
                                      </select>
                                        
            						</div>
						
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['login_id']; ?>">
                                </div>
                                <br>
                                <div class="modal-footer">
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                            </div>
                    </div>
                    </div>

                    
                    <script>
                    
                        $('.feedback').change(function(){
                        var modal = $('#modalDialog');
                        var responsceID = $(this).val();
                        var span = $(".close");
                        if(responsceID =="Hired"){
                            modal.show();
                        }else if(responsceID =="Selected"){
                          modal.show();  
                        }else if(responsceID =="Offered"){
                            modal.show();
                        }else{
                             modal.hide();
                        }
                        console.log(responsceID);
                    });
                                    /*
                     * Modal popup
                     */
                    // Get the modal
                    var modal = $('#modalDialog');
                    
                    // Get the button that opens the modal
                    var btn = $("#mbtn");
                    
                    // Get the  element that closes the modal
                    var span = $(".close");
                    
                    $(document).change(function(){
                        // When the user clicks the button, open the modal 
                        btn.on('click', function() {
                            modal.show();
                        });
                        
                        // When the user clicks on  (x), close the modal
                        span.on('click', function() {
                            modal.hide();
                        });
                    });
                    
                    // When the user clicks anywhere outside of the modal, close it
                    $('body').bind('click', function(e){
                        if($(e.target).hasClass("modal")){
                            modal.hide();
                        }
                    });
                    </script>
                    
                     <script>
                        $(document).ready(function(){
                            $('#contactFrm').submit(function(e){
                                e.preventDefault();
                                $('.modal-body').css('opacity', '0.5');
                                $('.btn').prop('disabled', true);
                                
                                $form = $(this);
                                $.ajax({
                                    type: "POST",
                                    url: 'popajax_submit.php',
                                    data: 'contact_submit=1&'+$form.serialize(),
                                    dataType: 'json',
                                    success: function(response){
                                        if(response.status == 1){
                                            $('#contactFrm')[0].reset();
                                            $('.response').html(''+response.message+'');
                                        }else{
                                            $('.response').html(''+response.message+'');
                                        }
                                        $('.modal-body').css('opacity', '');
                                        $('.btn').prop('disabled', false);
                                    }
                                });
                            });
                        });
                        </script>
                    
                        
                

				<!------------------------------------------END POP UP----------------------------------------------->
				
				
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
						location.href = 'index2.php?page=candidate'
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