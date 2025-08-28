         
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
      <h1>Time Tracker</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Time Tracker</a></li>
          <li class="breadcrumb-item">Time Tracker</li>
          <li class="breadcrumb-item active">Add Time Tracker</li>
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
        <div class="d-flex justify-content-center ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Time Tracker</h5>
                		<div class="card-body">
                		<div class="card-body">
                			<form action="" id="upload-timetracker">
                                <input type="hidden" name="sesid" value="<?php echo $_SESSION['login_id']; ?> ">
                            <?php
                                    include 'db_connect.php';
                                    $qry = $conn->query("SELECT * FROM users where id = '{$_SESSION['login_id']}' ")->fetch_array();
                                    foreach($qry as $k => $v){
                                        if($k == 'recruiter')
                                            $k = 'rrecruiter';
                                        $$k = $v;
                                    }
                                    ?>
                             <input type="hidden" name="recruiter" value="<?php echo $rrecruiter; ?> ">
                             
                                
                                <div class="row mb-3">
                					<div class="col-md-12">
                						<div class="form-group">
                							 <label for="inputText" class="form-label"><span class="required">*</span> Task</label>
                								<select required name="task" id="task" class="form-control form-control-sm select2 tasks">
                								<option value="<?php if(isset($_GET['task'])){echo $_GET['task'];}else{} ?>"></option>
                                                <option value="ScreeningInterviews" <?php echo isset($task) && $task == "ScreeningInterviews" ? 'selected' : '' ?>>Screening Interviews</option>
                                                 <option value="LinkedInMessages" <?php echo isset($task) && $task == "LinkedInMessages" ? 'selected' : '' ?>>LinkedIn Messages</option>
                                                  <option value="Cvsuploaded" <?php echo isset($task) && $task == "Cvsuploaded" ? 'selected' : '' ?>>Cvs Uploaded</option>
                                                  <option value="CvsShortlisted" <?php echo isset($task) && $task == "CvsShortlisted" ? 'selected' : '' ?>>Cvs Shortlisted</option>
                                                  <option value="Other"<?php echo isset($task) && $task == "Other" ? 'selected' : '' ?> >Other</option>>
                                                </select>
                						</div>
                						<div id="othersec" class="hidden">
                						    <label for="inputText" class="form-label"><span class="required">(*optional)</span> Other Task</label>
                						<input type="text" class="form-control form-control-sm" name="other_task" value="<?php echo isset($other_task) ? $other_task : '' ?>">
                						</div>
                						
                					</div>
                				</div>
                				
                				<div class="row mb-3">
                					<div class="col-md-6">
                						<div class="form-group">
                						    <label for="inputText" class="form-label"><span class="required">*</span> Strat Time</label>
                							<input type="time" class="form-control form-control-sm" required name="starttime" value="<?php echo isset($starttime) ? $starttime : '' ?>">
                						</div>
                					</div>
                					<div class="col-md-6">
                						<div class="form-group">
                						    <label for="inputText" class="form-label">End Time</label>
                							<input type="time" class="form-control form-control-sm" required name="endtime" value="<?php echo isset($endtime) ? $endtime : '' ?>">
                						</div>
                					</div>
                				</div>
                              <div class="row mb-3">
                					<div class="col-md-4">
                						<div class="form-group">
                						    <label for="inputText" class="form-label"> Count</label>
                							<input type="text" class="form-control form-control-sm" name="count" value="<?php echo isset($count) ? $count : '' ?>">
                						</div>
                					</div>
                					<div class="col-md-8">
                						<div class="form-group">
                						    <label for="inputText" class="form-label">Type</label>
                							
                							<input type="text" class="form-control form-control-sm" name="types" value="<?php echo isset($types) ? $types : '' ?>">
                						</div>
                					</div>
                				</div>
                              <div class="row mb-3">
                					<div class="col-md-12">
                						<div class="form-group">
                						    <label for="inputText" class="form-label">Summary</label>
                							<textarea name="description" id="" cols="10" rows="2" class=" form-control">
                								<?php echo isset($description) ? $description : '' ?>
                							</textarea>
                						</div>
                					</div>
                				</div>
                               
                            </form>
                        </div>
                    	<div class="card-footer border-top border-info">
                    		<div class="d-flex w-100 justify-content-center align-items-center">
                    		    <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button>
                    			<button class="btn btn-primary  bg-gradient-primary mx-2" form="upload-timetracker">Save</button>
                    		</div>
                    	</div>
                    	</div>
                    	</div>
                    	</div>
                    	</div>
                    	</div>
                    	</div>
        </section>

 <script>
    $('.tasks').change(function(){
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
$('#upload-timetracker').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_timetracker',
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
						location.href = 'index2.php?page=viewtimetracker'
					},2000)
				}
			}
		})
	})
</script>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_tracker').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Tracker Details","view_trackerdet.php?id="+$(this).attr('data-id'))
	})
	$('.delete_tracker').click(function(){
	_conf("Are you sure to delete this data?","delete_tracker",[$(this).attr('data-id')])
	})
	})
	function delete_tracker($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_tracker',
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