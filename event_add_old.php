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
                      <label for="inputText" class="form-label"><span class="required">*</span>Title</label>
                    <input type="text" class="form-control" name="title" required>
                  </div>
                </div>
                 <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>Descrption</label>
                    <input type="text" class="form-control" name="describ" required>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"> Meeting Type<span class="required">*</span></label>
                      <select name="meeting_type"  id="feedback" class="form-select  feedback" required>
                          <option></option>
                           <option value="InPerson">In Person</option>
                          <option value="Online">Online</option>
                         
                      </select>
                  </div>
                  <div class="col-sm-12 hidden" id="othersec">
                      <label for="inputText" class="form-label">URL</label>
                    <input type="text" class="form-control" name="url">
                  </div>
                </div>
              
                 <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span> Start Date</label>
                    <input type="datetime-local" class="form-control" name="start_date" required>
                  </div>
                </div>
                 <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span> End Date</label>
                    <input type="datetime-local" class="form-control" name="end_date" required>
                  </div>
                </div>
                 <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>Participates </label>
                        <select class="form-select" id="floatingSelect"   name="jb_recuiters[]" multiple="multiple"  required>
                                <?php 
                              	$employees = $conn->query("SELECT *,concat(firstname ,' ', lastname) as name from users WHERE type in (1,2,3) AND active=1 GROUP BY email");
                              	while($row= $employees->fetch_assoc()){
                              	?>
                              	<option value="<?php echo $row['id'] ?>" <?php echo isset($jb_recuiters) && in_array($row['name'],explode(',',$jb_recuiters)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                              	<?php } ?>
                          </select>
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
    $('.feedback').change(function(){
        var responsceID = $(this).val();
        if(responsceID =="Online"){
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