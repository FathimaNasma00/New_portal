
  <main>

    <div class="pagetitle">
      <h1>Job Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Job Management</li>
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
              <h5 class="card-title">Job Information</h5>
           

              <!-- General Form Elements -->
              <form action="" id="job_management">
                 <div class="row mb-3">
                  <div class="col-sm-6">
                      <label for="inputText" class="form-label "><span class="required">*</span> Job Ref.No</label>
                       <?php 
    // Include database connection
    include 'db_connect.php';

    // Set the default timezone
    date_default_timezone_set("Asia/Colombo");

    // Get the current month and year
    $month = date("m");
    $year = date("Y");
    $yearz = date("y");// Use "Y" for 4-digit year

    // Get the latest job reference for the current month and year
    $query = $conn->query("SELECT MAX(jb_refco) AS max_ref 
FROM `job_management` 
WHERE MONTH(jb_date) = '$month' 
AND YEAR(jb_date) = '$year' 
AND jb_ref LIKE 'JB/$yearz/$month/%';
");
    
    // Fetch the result
    $result = $query->fetch_assoc();

    // Get the maximum job reference for the current month and year
    $max_ref = $result['max_ref'];

    // If no job references exist for the current month and year, set count to 1
    if ($max_ref === null) {
        $count = 1;
    } else {
        // Increment the count
        $count = $max_ref + 1;
    }

    // Generate the job reference number
    $jbref = "JB".'/'.$yearz.'/'.$month.'/'.$count;
    
    
?>


<input type="hidden" class="form-control" name="jb_refcount" value="<?php echo $count; ?>" required readonly style="color:#969b9f;">
<input type="text" class="form-control" name="jb_ref" value="<?php echo $jbref; ?>" required readonly style="color:#969b9f;">

                  </div>
                
                
                
                  <div class="col-sm-6">
                      <label for="inputText" class="form-label"><span class="required">*</span> Job Title</label>
                    <input type="text" class="form-control" name="jb_title" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-6">
                     <label for="inputText" class="form-label"><span class="required">*</span> Job Type</label>
                    <select class="form-select" aria-label="Default select example" name="jb_type" required>
                      <option value="NW">New</option>
                      <option value="RO">Re-open</option>
                    </select>
                  </div>
            
                       <div class="col-sm-6">
                        <label for="inputText" class="form-label"><span class="required">*</span>Employment Type</label>
                        <select class="form-select" id="floatingSelect" name="emp_type" aria-label="Floating label select example" required>
                        <option value="Full-time">Full-time</option>
                        <option value="Internship">Internship</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Casual">Casual</option>
                        <option value="Contract">Contract</option>
                      </select>
                        </div>
                   </div>
                    
                <div class="row mb-3">
                       <div class="col-sm-6">
                        <label for="inputText" class="form-label"><span class="required">*</span>Client</label>
                        <select class="form-select" id="floatingSelect" name="jb_client" aria-label="Floating label select example" required>
                            <?php 
                          	$managers = $conn->query("SELECT * FROM clintmanege ");
                          	while($row= $managers->fetch_assoc()){
                          	?>
                            <option value="<?php echo $row['clint_id'] ?>" <?php echo isset($jb_client) && $jb_client == $row['clint_id'] ? "selected" : '' ?>><?php echo ucwords($row['clint_name']) ?></option>
                          	<?php } ?>
                      </select>
                        </div>
                   
                       <div class="col-sm-6">
                        <label for="inputText" class="form-label"><span class="required">*</span>Working Type</label>
                        <select class="form-select" id="floatingSelect" name="jb_workingtype" aria-label="Floating label select example" required>
                        <option value="Work-Space">Work-Space</option>
                        <option value="Remote">Remote</option>
                        <option value="Hybrid">Hybrid</option>
                        <option value="Onsite">Onsite</option>
                      </select>
                        </div>
                 </div>
                  <div class="row mb-3">
            
                   
                       <div class="col-sm-6">
                        <label for="inputText" class="form-label"><span class="required">*</span>Job Opening Counts</label>
                        <input type="number" class="form-control" name="opencount" id="opencount" min="0" required>
                        </div>
                        
                        <div class="col-sm-6">
                        <label for="inputText" class="form-label"><span class="required">*</span>Initial Forecasted Counts</label>
                        <input type="number" class="form-control" name="initialforecasted" id="initialforecasted" min="0" required>
                        </div>
                 </div>
                 <style>
                      .box
                     {
                      width:100%;
                      max-width:600px;
                      background-color:#f9f9f9;
                      border:1px solid #ccc;
                      border-radius:5px;
                      padding:16px;
                      margin:0 auto;
                     }
                     .ck-editor__editable[role="textbox"] {
                                    /* editing area */
                                    min-height: 300px;
                                }
                 </style>
                <div class="row mb-3">
                  <div class="col-sm-12">
                     <label for="inputText" class="form-label ">Job Description</label>
                    <textarea class="form-control" name="jb_descrption" id="jb_descrption"  style="height: 300px"></textarea>
                  </div>
                   
                </div>
               
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-10 col-form-label">File Uploads</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="file" id="formFile" name="jb_fiels" placeholder="No Fiels Chosen">
                  </div>
                </div>
                
                <hr>
                  <h5 class="card-title">Salary Information</h5>
                
                    <div class="row mb-3">
                  <div class="col-md-6">
                  <label for="inputState" class="form-label"><span class="required">*</span>Currency</label>
                  <select id="inputState" class="form-select" name="currency" required>

                    <option value="AFN">AFN</option>
                    <option value="ALL">ALL </option>
                    <option value="DZD">DZD </option>
                    <option value="AOA">AOA </option>
                    <option value="ARS">ARS </option>
                    <option value="AMD">AMD </option>
                    <option value="AWG">AWG </option>
                    <option value="AUD">AUD </option>
                    <option value="AZN">AZN </option>
                    <option value="BSD">BSD </option>
                    <option value="BHD">BHD </option>
                    <option value="BDT">BDT </option>
                    <option value="BBD">BBD </option>
                    <option value="BYR">BYR </option>
                    <option value="BEF">BEF </option>
                    <option value="BZD">BZD </option>
                    <option value="BMD">BMD </option>
                    <option value="BTN">BTN </option>
                    <option value="BTC">BTC </option>
                    <option value="BOB">BOB </option>
                    <option value="BAM">BAM </option>
                    <option value="BWP">BWP </option>
                    <option value="BRL">BRL </option>
                    <option value="GBP">GBP </option>
                    <option value="BND">BND </option>
                    <option value="BGN">BGN </option>
                    <option value="BIF">BIF </option>
                    <option value="KHR">KHR </option>
                    <option value="CAD">CAD </option>
                    <option value="CVE">CVE </option>
                    <option value="KYD">KYD </option>
                    <option value="XOF">XOF </option>
                    <option value="XAF">XAF </option>
                    <option value="XPF">XPF </option>
                    <option value="CLP">CLP </option>
                    <option value="CNY">CNY </option>
                    <option value="COP">COP </option>
                    <option value="KMF">KMF </option>
                    <option value="CDF">CDF </option>
                    <option value="CRC">CRC </option>
                    <option value="HRK">HRK </option>
                    <option value="CUC">CUC </option>
                    <option value="CZK">CZK </option>
                    <option value="DKK">DKK </option>
                    <option value="DJF">DJF </option>
                    <option value="DOP">DOP </option>
                    <option value="XCD">XCD </option>
                    <option value="EGP">EGP </option>
                    <option value="ERN">ERN </option>
                    <option value="EEK">EEK </option>
                    <option value="ETB">ETB </option>
                    <option value="EUR">EUR </option>
                    <option value="FKP">FKP </option>
                    <option value="FJD">FJD </option>
                    <option value="GMD">GMD </option>
                    <option value="GEL">GEL </option>
                    <option value="DEM">DEM </option>
                    <option value="GHS">GHS </option>
                    <option value="GIP">GIP </option>
                    <option value="GRD">GRD </option>
                    <option value="GTQ">GTQ </option>
                    <option value="GNF">GNF </option>
                    <option value="GYD">GYD </option>
                    <option value="HTG">HTG </option>
                    <option value="HNL">HNL </option>
                    <option value="HKD">HKD </option>
                    <option value="HUF">HUF </option>
                    <option value="ISK">ISK </option>
                    <option value="INR">INR </option>
                    <option value="IDR">IDR </option>
                    <option value="IRR">IRR </option>
                    <option value="IQD">IQD </option>
                    <option value="ILS">ILS </option>
                    <option value="ITL">ITL </option>
                    <option value="JMD">JMD </option>
                    <option value="JPY">JPY </option>
                    <option value="JOD">JOD </option>
                    <option value="KZT">KZT </option>
                    <option value="KES">KES </option>
                    <option value="KWD">KWD </option>
                    <option value="KGS">KGS </option>
                    <option value="LAK">LAK </option>
                    <option value="LVL">LVL </option>
                    <option value="LBP">LBP </option>
                    <option value="LSL">LSL </option>
                    <option value="LRD">LRD </option>
                    <option value="LYD">LYD </option>
                    <option value="LTL">LTL </option>
                    <option value="MOP">MOP </option>
                    <option value="MKD">MKD </option>
                    <option value="MGA">MGA </option>
                    <option value="MWK">MWK </option>
                    <option value="MYR">MYR </option>
                    <option value="MVR">MVR </option>
                    <option value="MRO">MRO </option>
                    <option value="MUR">MUR </option>
                    <option value="MXN">MXN </option>
                    <option value="MDL">MDL </option>
                    <option value="MNT">MNT </option>
                    <option value="MAD">MAD </option>
                    <option value="MZM">MZM </option>
                    <option value="MMK">MMK </option>
                    <option value="NAD">NAD </option>
                    <option value="NPR">NPR </option>
                    <option value="ANG">ANG </option>
                    <option value="TWD">TWD </option>
                    <option value="NZD">NZD </option>
                    <option value="NIO">NIO </option>
                    <option value="NGN">NGN </option>
                    <option value="KPW">KPW </option>
                    <option value="NOK">NOK </option>
                    <option value="OMR">OMR </option>
                    <option value="PKR">PKR </option>
                    <option value="PAB">PAB </option>
                    <option value="PGK">PGK </option>
                    <option value="PYG">PYG </option>
                    <option value="PEN">PEN </option>
                    <option value="PHP">PHP </option>
                    <option value="PLN">PLN </option>
                    <option value="QAR">QAR </option>
                    <option value="RON">RON </option>
                    <option value="RUB">RUB </option>
                    <option value="RWF">RWF </option>
                    <option value="SVC">SVC </option>
                    <option value="WST">WST </option>
                    <option value="SAR">SAR </option>
                    <option value="RSD">RSD </option>
                    <option value="SCR">SCR </option>
                    <option value="SLL">SLL </option>
                    <option value="SGD">SGD </option>
                    <option value="SKK">SKK </option>
                    <option value="SBD">SBD </option>
                    <option value="SOS">SOS </option>
                    <option value="ZAR">ZAR </option>
                    <option value="KRW">KRW </option>
                    <option value="XDR">XDR </option>
                    <option value="LKR" selected>LKR </option>
                    <option value="SHP">SHP </option>
                    <option value="SDG">SDG </option>
                    <option value="SRD">SRD </option>
                    <option value="SZL">SZL </option>
                    <option value="SEK">SEK </option>
                    <option value="CHF">CHF </option>
                    <option value="SYP">SYP </option>
                    <option value="STD">STD </option>
                    <option value="TJS">TJS </option>
                    <option value="TZS">TZS </option>
                    <option value="THB">THB </option>
                    <option value="TOP">TOP </option>
                    <option value="TTD">TTD </option>
                    <option value="TND">TND </option>
                    <option value="TRY">TRY </option>
                    <option value="TMT">TMT </option>
                    <option value="UGX">UGX </option>
                    <option value="UAH">UAH </option>
                    <option value="AED">AED </option>
                    <option value="UYU">UYU </option>
                    <option value="USD">USD </option>
                    <option value="UZS">UZS </option>
                    <option value="VUV">VUV </option>
                    <option value="VEF">VEF </option>
                    <option value="VND">VND </option>
                    <option value="YER">YER </option>
                    <option value="ZMK">ZMK </option>
                  </select>
                </div>
                
                <div class="col-md-6">
                  <label for="inputState" class="form-label"><span class="required">*</span>Paid Every</label>
                  <select id="inputState" class="form-select" name="paid_details" required>
                    <option value="Hour">Hour</option>
                    <option value="Day">Day</option>
                    <option value="Week">Week</option>
                    <option value="2Week">2Week</option>
                    <option value="Month" selected>Month</option>
                    <option value="Year">Year</option>
                  </select>
                </div>
                </div>
                
                <div class="row mb-3">
                
                  <div class="col-sm-6">
                      <label for="inputNumber" class="form-label"><span class="required">*</span>Minimum Salary</label>
                    <input type="number" name="min_sal" class="form-control" required>
                  </div>
                
               
                  <div class="col-sm-6">
                      <label for="inputNumber" class="form-label"><span class="required">*</span>Maximum Salary</label>
                    <input type="number" name="max_sal" class="form-control" required>
                  </div>
               
                </div>
                <hr>
                <div class="row mb-3">
                  <div class="col-sm-6">
                      <?php 
                       date_default_timezone_set("Asia/colombo");
                        $format = "Y-m-d";
                        $PD=1;
                        $PM=1;
                        $PY=1;
                        $FD=1;
                        $FM=1;
                        $FY=1;
                        $PDT = date($format, strtotime(" -$PD days -$PM months -$PY years"));
                        $CDT=date($format);
                        $FDT = date($format, strtotime(" +$FD days +$FM months +$FY years"));
                      ?>
                 <label for="inputNumber" class="form-label"><span class="required">*</span>Deadline</label>
                    <input type="date" min="<?=$CDT; ?>" max="<?=$FDT; ?>" name="deadline" class="form-control" required>
                  </div>
                  
                  <div class="col-sm-6">
                        <label for="inputText" class="form-label"><span class="required">*</span>Recruiter</label>
                        <select class="form-select" id="floatingSelect"   name="jb_recuiters[]" multiple="multiple"  required>
                            <?php 
                          	$employees = $conn->query("SELECT *,concat(firstname ,' ', lastname) as name from users WHERE type IN (1, 2, 3) AND active = 1 AND id NOT IN (5, 13, 19, 25,39) GROUP BY email; ");
                          	while($row= $employees->fetch_assoc()){
                          	?>
                          	<option value="<?php echo $row['id'] ?>" <?php echo isset($jb_recuiters) && in_array($row['name'],explode(',',$jb_recuiters)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                          	<?php } ?>
                      </select>
                        </div>
                </div>
                

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button form="job_management" class="btn btn-primary">Submit Form</button>
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
  <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#jb_descrption' ))
        .catch( error => {
            console.error( error );
        });
</script>

  <script>
	$('#job_management').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=job_management',
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
						location.href = 'index2.php?page=jobmangement_list'
					},2000)
				}
			}
		})
	})
</script>
