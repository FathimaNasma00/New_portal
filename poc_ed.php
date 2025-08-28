
  <main>

    <div class="pagetitle">
      <h1>POC</h1>
      <nav> 
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">POC</li>
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
        <div class="justify-content-center ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">POC</h5>
           

              <!-- General Form Elements -->
              <form action="" id="manage_poc">
                  <input type="hidden" class="form-control" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                 <div class="row ">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label "><span class="required">*</span>Name</label>
                     <input type="text" class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
                  </div>
                </div>
                
                <div class="row ">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>Designation</label>
                    <input type="text" class="form-control" name="designation" value="<?php echo isset($designation) ? $designation : '' ?>" required>
                  </div>
                </div>
                
                
                <div class="row ">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>Division</label>
                    <input type="text" class="form-control" name="division" value="<?php echo isset($division) ? $division : '' ?>" required>
                  </div>
                </div>
                
                
                <div class="row ">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
                  </div>
                </div>
                
                
                <div class="row ">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span>Phone Number</label>
                    <input type="tel" class="form-control" name="phonenumber" value="<?php echo isset($phonenumber) ? $phonenumber : '' ?>" required>
                  </div>
                </div>
                
                <div class="col-sm-12"><br></div>
                    
                <div class="row ">
                  <div class="col-sm-12">
                    <button form="manage_poc" class="btn btn-primary">Submit Form</button>
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
    function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$('#manage_poc').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=manage_poc',
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
						location.href = 'index2.php?page=poc'
					},2000)
				}
			}
		})
	})
</script>