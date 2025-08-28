
  <main>

    <div class="pagetitle">
      <h1>User Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">User Management</li>
          <li class="breadcrumb-item active">Add Data</li>
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
              <h5 class="card-title">Personal Information</h5>
           

              <!-- General Form Elements -->
              <form action="" id="manage_user">
                  <!--<input type="hidden" class="form-control" name="id" value="<?php echo isset($id) ? $id : '' ?>">-->
                  <input type="hidden" id="recruiter" name="recruiter" value="<?php echo $_SESSION['login_id']; ?>">

                 <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label "><span class="required">*</span> First Name</label>
                     <input type="text" class="form-control" name="firstname" value="<?php echo isset($firstname) ? $firstname : '' ?>" required>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>Last Name</label>
                    <input type="text" class="form-control" name="lastname" value="<?php echo isset($lastname) ? $lastname : '' ?>" required>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label">Join Date </label>
                    <input type="date" class="form-control" name="join_date" >
                  </div>
                </div>
                
                
                <div class="row mb-3">
                  <div class="col-sm-12">
                     <label for="inputText" class="form-label"> User Type</label>
                    <select class="form-select" aria-label="Default select example" name="user_type" >
                      <option value="Internship">Internship</option>
                      <option value="Permanent ">Permanent </option>
                    </select>
                  </div>
                </div>
                
                 <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label">Probation Confirmed Date</label>
                    <input type="date" class="form-control" name="confirmed_date">
                  </div>
                </div>
                
                 <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label">Contact</label>
                    <input type="tel" class="form-control" name="contact" >
                  </div>
                </div>
                
                 <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Choose File</label>
                  <div class="col-sm-10">
                     <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
                  </div>
                </div>
                	<div class="form-group d-flex justify-content-center">
							<img src="<?php echo isset($avatar) ? 'assets/uploads/'.$avatar :'' ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
					</div>
        
                <hr>
                  <h5 class="card-title">User Credentials</h5>
                  
                 <div class="row mb-3">
                  <div class="col-md-6">
                  <label for="inputState" class="form-label"><span class="required">*</span>Recruiter</label>
                  <?php
                    function getNextRecruiterCodes($prefix, $existing, $count = 5) {
                        $numbers = [];
                        foreach ($existing as $rec) {
                            if (strpos($rec, $prefix) === 0) {
                                $num = intval(substr($rec, strlen($prefix)));
                                $numbers[] = $num;
                            }
                        }
                        $max = empty($numbers) ? 0 : max($numbers);
                        $result = [];
                        for ($i = 1; $i <= $count; $i++) {
                            $num = $max + $i;
                            $result[] = sprintf("%s%02d", $prefix, $num);
                        }
                        return $result;
                    }
                    
                    $recruiter = isset($recruiter) ? $recruiter : null;
                    
                    $existing = [];
                    $qry = $conn->query("SELECT recruiter FROM users WHERE recruiter IS NOT NULL");
                    while ($row = $qry->fetch_assoc()) {
                        $existing[] = $row['recruiter'];
                    }
                    
                    $nextR  = getNextRecruiterCodes('R', $existing, 5);
                    $nextFR = getNextRecruiterCodes('FR', $existing, 5);
                    $nextTPU = getNextRecruiterCodes('TPU', $existing, 5);
               
                    ?>
                    <select name="recruiter" id="recruiter" class="form-select" required>
                        <?php foreach ($nextR as $code): ?>
                            <option value="<?= $code ?>" <?= $recruiter == $code ? 'selected' : '' ?>><?= $code ?></option>
                        <?php endforeach; ?>
                        <?php foreach ($nextFR as $code): ?>
                            <option value="<?= $code ?>" <?= $recruiter == $code ? 'selected' : '' ?>><?= $code ?></option>
                        <?php endforeach; ?>
                        <?php foreach ($nextTPU as $code): ?>
                            <option value="<?= $code ?>" <?= $recruiter == $code ? 'selected' : '' ?>><?= $code ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
                </div>
                
                 <div class="row mb-3">
                  <div class="col-md-6">
                  <label for="inputState" class="form-label"><span class="required">*</span>User Role</label>
                  <select name="type" id="type" class="form-select" required>
                    <option value="4" <?php echo isset($type) && $type == 4 ? 'selected' : '' ?>>FreeLancer</option>
								<option value="5" <?php echo isset($type) && $type == 5 ? 'selected' : '' ?>>Temporary User</option>
								<option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>User</option>
								<option value="3" <?php echo isset($type) && $type == 3 ? 'selected' : '' ?>>Admin</option>
								<option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Super Admin</option>
                  </select>
                </div>
                </div>
                
                 <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>User Name</label>
                    <input type="text" class="form-control"  name="email" required value="<?php echo isset($email) ? $email : '' ?>">
                    <small id="#msg"></small>
                  </div>
                </div>
                   <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>Password</label>
                    <input type="password" class="form-control"  name="password" <?php echo isset($id) ? "":'required' ?>>
                    	<small><i><?php echo isset($id) ? "Leave this blank if you dont want to change you password":'' ?></i></small>
                  </div>
                </div>
                   <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>Confirm Password</label>
                    <input type="password" class="form-control" name="cpass" <?php echo isset($id) ? 'required' : '' ?>>
                    	<small id="pass_match" data-status=''></small>
                  </div>
                </div>
                
                
                
                

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button form="manage_user" class="btn btn-primary">Submit Form</button>
                    <button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=user_list'">Cancel</button>
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
  
<style>
	img#cimg{
		max-height: 15vh;
		/*max-width: 6vw;*/
	}
</style>
<script>
	$('[name="password"],[name="cpass"]').keyup(function(){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','')
		}else{
			if(cpass == pass){
				$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
			}else{
				$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
			}
		}
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage_user').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		if($('#pass_match').attr('data-status') != 1){
			if($("[name='password']").val() !=''){
				$('[name="password"],[name="cpass"]').addClass("border-danger")
				end_load()
				return false;
			}
		}
		$.ajax({
			url:'ajax.php?action=save_user',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.replace('index2.php?page=user_list')
					},750)
				}else if(resp == 2){
					$('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
					$('[name="email"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
</script>