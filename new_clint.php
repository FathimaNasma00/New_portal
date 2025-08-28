<?php include'db_connect.php' ?>
<main>

    <div class="pagetitle">
      <h1>Client Information</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Client Information</li>
          <li class="breadcrumb-item active">Add Client</li>
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
              <h5 class="card-title">Client Information</h5>
                		<div class="card-body">

	                            <div class="card-header">
                                            		<div class="card-body">
                                            			<form action="" id="save_clint">
                                            				<div class="row">
                                            					<div class="col-md-12">
                                                                    	<div class="row mb-3">
				                                                    	<div class="col-sm-12">
                                            						<div class="form-group">
                                            						     <label for="inputText" class="form-label"><span class="required">*</span> Name</label>
                                            							<input type="text" name="clintname" class="form-control form-control-sm" required value="<?php echo isset($clint_name) ? $clint_name : '' ?>">
                                            						</div>
                                            							</div>
				                                                    </div>
                                            							<div class="row mb-3">
				                                                    	<div class="col-sm-12">
                                            						<div class="form-group">
                                            						     <label for="inputText" class="form-label"><span class="required">*</span> Location</label>
                                            							<input type="text" name="location" class="form-control form-control-sm" required value="<?php echo isset($location) ? $location : '' ?>">
                                            						</div>
                                            						
                                            							</div>
				                                                    </div>
                                            							<div class="row mb-3">
				                                                    	<div class="col-sm-12">
                                            						<div class="form-group">
                                            						     <label for="inputText" class="form-label"><span class="required">*</span> Address</label>
                                            							<input type="text" name="address" class="form-control form-control-sm" required value="<?php echo isset($address) ? $address : '' ?>">
                                            						</div>
                                            							</div>
				                                                    </div>
                                            							<div class="row mb-3">
				                                                    	<div class="col-sm-12">
                                            							<div class="form-group">
                                            							   <label for="inputText" class="form-label"><span class="required">*</span> Type</label><br>  
                                            							   <label for="" class="control-label">IT </label>&nbsp;
                                            						       <input type="radio" id="IT" name="type" value="IT"  >&nbsp;&nbsp;&nbsp;
                                            						       <label for="" class="control-label">NON IT </label>&nbsp;
                                            						       <input type="radio" id="NONIT" name="type" value="NONIT" >
                                            						</div>
                                            							</div>
				                                                    </div>
                                            							<div class="row mb-3">
				                                                    	<div class="col-sm-12">
                                            						<div class="form-group">
                                            						     <label for="inputText" class="form-label">Sub Account</label>
                                            							<input type="text" name="subacount" class="form-control form-control-sm" value="<?php echo isset($subacount) ? $subacount : '' ?>">
                                            						</div>
                                            							</div>
				                                                    </div>
                                            							<div class="row mb-3">
				                                                    	<div class="col-sm-12">
                                            						
                                            						<div class="form-group">
                                            						     <label for="inputText" class="form-label"><span class="required">*</span> Agreement Start Date</label>
                                            							<input type="date" name="agstart" class="form-control form-control-sm" required value="<?php echo isset($agstart) ? $agstart : '' ?>">
                                            						</div>
                                            							</div>
				                                                    </div>
                                            							<div class="row mb-3">
				                                                    	<div class="col-sm-12">
                                            						<div class="form-group">
                                            						     <label for="inputText" class="form-label"><span class="required">*</span> Agreement End Date</label>
                                            							<input type="date" name="agend" class="form-control form-control-sm" required value="<?php echo isset($agstart) ? $agstart : '' ?>">
                                            						</div>
                                            							</div>
				                                                    </div>
                                                                    
                                                                    	<div class="row mb-3">
				                                                    	<div class="col-sm-12">
                                            						<div class="form-group">
                                            						     <label for="inputText" class="form-label"> Image(optional)</label>
                                            		                      <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
                                            		                      <label class="custom-file-label" for="customFile">Choose file</label>
                                            		                    </div>
                                            						</div>
                                            							</div>
				                                                    </div>
                                            							<div class="row mb-3">
				                                                    	<div class="col-sm-12">
                                            						<div class="form-group d-flex justify-content-center">
                                            							<img src="<?php echo isset($img) ? 'assets/uploads/'.$img :'' ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                                            						</div>
                                            					</div>
				                                                    </div>
                                            
                                            					</div>
                                            				</div>
                                            				<hr>
                                            				<div class="col-lg-12 text-right justify-content-center d-flex">
                                            				    <button onclick="history.go(-1);" class="btn btn-secondary"><i class="fas fa-reply"></i> &nbsp; Back</button> &nbsp;
                                            				    
                                            					<button class="btn btn-primary mr-2" form="save_clint">Save</button>
                                            				</div>
    </form>
                                            		</div>
                                </div>
                          </div>
                        </div>
                        </div>
                     </div>
                    </div>
                </div>
     </section>
	
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

	$('#save_clint').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_clint',
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
						location.href = 'index2.php?page=new_clint'
					},2000)
				}
			}
		})
	})
</script>