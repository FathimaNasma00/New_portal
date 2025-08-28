<style>
    .hidden{
	display:none;
}
.show
{
	display:block;
}
</style
  <main>

    <div class="pagetitle">
      <h1>Event Calendar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Calendar</li>
          <li class="breadcrumb-item active">Add Event</li>
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
        <div class="justify-content-center ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Calendar</h5>
           
              <!-- General Form Elements -->
              <form action="" id="calender">

                
                <div class="row mb-4">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>Interview Type</label>
                    <input type="text" class="form-control" name="title" required>
                  </div>
                </div>
                 <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>Candidate</label>
                            <select class="form-control form-control-sm select2" required  name="candidate">
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
                            <?php echo ucwords($row['name']). "&nbsp&nbsp - &nbsp&nbsp " . $string ;
                            ?>
                              </option>
                             <?php endwhile; ?>
                          </select>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label">Client <span class="required">*</span></label>
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
                
                  <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label">Job RefNo<span class="required">*</span></label>
                             <select class="form-control form-control-sm select2" required name="job_refno" id="jobRefSelect">
                        <option></option>
                        <!-- Job RefNo options will be populated dynamically based on the selected client -->
                      </select>
                  </div>
                  
                </div>
                
              
                 <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>Event Date & Time</label>
                    <input type="datetime-local" class="form-control" name="start_date" required>
                  </div>
                </div>
                
              
            
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button form="calender" class="btn btn-primary">Submit Form</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
      </div>
    </section>
  </main><!-- End #main -->
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
                
  <script>
	$('#calender').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=calender',
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
						location.href = 'index2.php?page=event_list'
					},2000)
				}
			}
		})
	})
</script>