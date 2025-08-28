<?php if(!isset($conn)){ include 'db_connect.php'; } ?>


  <main>

    <div class="pagetitle">
      <h1>Task</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Task</li>
          <li class="breadcrumb-item active">Add Task</li>
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
              <h5 class="card-title">Add Task</h5>
                		<div class="card-body">
                			<form action="" id="manage-task">
                		<div class="row">
                			<div class="col-md-12">
                				<div class="form-group">
                					 <label for="inputText" class="form-label"><span class="required">*</span> Account Manager</label>
                					<select class="form-control form-control-sm select2" name="name" required>
                                      	<option></option>
                                      	<?php 
                                      	$managers = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users WHERE type IN (1, 2, 3) AND active = 1 AND id NOT IN (5, 13, 19, 25,39) GROUP BY email;");
                                      	while($row= $managers->fetch_assoc()):
                                      	?>
                                      	<option value="<?php echo $row['id'] ?>" <?php echo isset($name) && $name == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                                      	<?php endwhile; ?>
                              </select>
                				</div>
                			</div>
                		</div>
                		<div class="row">
                			<div class="col-md-12">
                            <div class="form-group">
                               <label for="inputText" class="form-label"><span class="required">*</span>Start Date</label>
                              <input type="date" class="form-control form-control-sm"  required autocomplete="off" name="start_date" value="<?php echo isset($start_date) ? date("Y-m-d",strtotime($start_date)) : '' ?>">
                            </div>
                          </div>
                          </div>
                         <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                               <label for="inputText" class="form-label"><span class="required">*</span>End Date</label>
                              <input type="date" class="form-control form-control-sm" required  autocomplete="off" name="end_date" value="<?php echo isset($end_date) ? date("Y-m-d",strtotime($end_date)) : '' ?>">
                            </div>
                          </div>
                		</div>
                        <div class="row">
                        	<?php if($_SESSION['login_type'] == 1 ): ?>
                           <div class="col-md-12">
                            <div class="form-group">
                               <label for="inputText" class="form-label"><span class="required">*</span>Client</label>
                              <select class="form-control form-control-sm select2" name="clint_id" required>
                              	<option></option>
                              	<?php 
                              	$managers = $conn->query("SELECT * FROM clintmanege ");
                              	while($row= $managers->fetch_assoc()):
                              	?>
                              	<option value="<?php echo $row['clint_id'] ?>" <?php echo isset($clint_name) && $clint_name == $row['clint_id'] ? "selected" : '' ?>><?php echo ucwords($row['clint_name']) ?></option>
                              	<?php endwhile; ?>
                              </select>
                            </div>
                          </div>
                      	<input type="hidden" name="manager_id" value="<?php echo $_SESSION['login_id']; ?>">
                      <?php endif; ?>
                          <div class="col-md-12">
                				<div class="form-group">
                					 <label for="inputText" class="form-label"><span class="required">*</span> Role </label>
                                        <select class="form-control form-control-sm select2" required name="rolname">
                                            <option></option>
                                            <option value="AccountManager">Account Manager</option>
                                            <option value="TeamLead">Team Lead</option>
                                        </select>
                				</div>
                          </div>
                    
                        </div>
                        <div class="row">
                			<div class="col-md-12">
                            <div class="form-group">
                               <label for="inputText" class="form-label"><span class="required">*</span>Recuiters</label>
                              <select class="form-control form-control-sm select2" required multiple="multiple" name="user_ids[]">
                              	<option></option>
                              	<?php 
                              	$employees = $conn->query("SELECT *,concat(firstname ,' ', lastname) as name from users WHERE type IN (1, 2, 3) AND active = 1 AND id NOT IN (5, 13, 19, 25,39) GROUP BY email; ");
                              	while($row= $employees->fetch_assoc()):
                              	?>
                              	<option value="<?php echo $row['name'] ?>" <?php echo isset($user_ids) && in_array($row['name'],explode(',',$user_ids)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                              	<?php endwhile; ?>
                              </select>
                            </div>
                			    
                			</div>
                		</div>
            </form>
                    	</div>
                    	<div class="card-footer border-top border-info">
                    		<div class="d-flex w-100 justify-content-center align-items-center">
                    			<button class="btn btn-primary  bg-gradient-primary mx-2" form="manage-task">Save</button>
                    			<button class="btn btn-secondary bg-gradient-secondary mx-2" type="button" onclick="location.href='index2.php?page=new_task'">Cancel</button>
                    		</div>
                    	</div>
                </div>
            </div>
            </div>
            </div>
            </div>
            </section>
     </main>	

<script>
	$('#manage-task').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_task',
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
						location.href = 'index2.php?page=task_list'
					},2000)
				}
			}
		})
	})
</script>