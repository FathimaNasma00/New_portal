<?php
include 'db_connect.php';
$qry = $conn->query("SELECT*, job_management.id,job_management.jb_ref,job_management.jb_title,job_management.jb_type,job_management.jb_workingtype,job_management.opencount,job_management.initialforecasted,
                          job_management.deadline, concat(users.firstname,', ',users.middlename,' ',users.lastname) as name,clintmanege.clint_name  FROM job_management
                            INNER JOIN users ON (job_management.jb_recuiters = users.id)
                            INNER JOIN clintmanege  ON (job_management.jb_client = clintmanege.clint_id) where job_management.id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title')
		$k = 'ftitle';
	$$k = $v;
}
?>

 <main>

    <div class="pagetitle">
      <h1>Job Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Job Management</li>
          <li class="breadcrumb-item active">Edit Data</li>
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
              <h5 class="card-title">Job Information</h5>
           

              <!-- General Form Elements -->
              <form>
                 <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label "><span class="required">*</span> Job Ref.No</label>
               
                     <input type="hidden" class="form-control" name="jb_refcount" value="<?php echo isset($jb_refco) ? $jb_refco : '' ?>" required readonly style="color:#969b9f;" >
                     <input type="text" class="form-control" name="jb_ref" value="<?php echo isset($jb_ref) ? $jb_ref : '' ?>" required readonly style="color:#969b9f;" >
                  </div>
                </div>
                
                <div class="row mb-3">
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"><span class="required">*</span> Job Title</label>
                    <input type="text" class="form-control" name="jb_title" value="<?php echo isset($jb_title) ? $jb_title : '' ?>" required readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-12">
                     <label for="inputText" class="form-label"><span class="required">*</span> Job Type</label>
                    <select class="form-select" aria-label="Default select example" name="jb_type" required readonly>
                    <?php 
                      if($jb_type == "NW"){
                       echo '<option value="NW">New</option>';
                      }elseif($jb_type == "RO"){
                      echo'<option value="RO">Re-open</option>';
                      }elseif($jb_type == "Closed"){
                      echo'<option value="Closed">Closed</option>';
                      }
                      ?>
                      <option value="NW">New</option>
                      <option value="RO">Re-open</option>
                      <option value="Closed">Closed</option>
                    </select>
                  </div>
                </div>
    
                  <div class="row mb-3">
                       <div class="col-sm-12">
                        <label for="inputText" class="form-label"><span class="required">*</span>Employment Type</label>
                        <select class="form-select" id="floatingSelect" name="emp_type" aria-label="Floating label select example" required readonly>
                         <option value="<?php echo isset($emp_type) ? $emp_type: '' ?>"><?php echo isset($emp_type) ? $emp_type: '' ?></option>
                        <option value="Full-time">Full-time</option>
                        <option value="Internship">Internship</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Casual">Casual</option>
                        <option value="Contract">Contract</option>
                      </select>
                        </div>
                   </div>
                    
                <div class="row mb-3">
                       <div class="col-sm-12">
                        <label for="inputText" class="form-label"><span class="required">*</span>Client</label>
                        <select class="form-select" id="floatingSelect" name="jb_client" aria-label="Floating label select example" required readonly>
                            <option value="<?php echo isset($jb_client) ? $jb_client: '' ?>"><?php echo isset($clint_name) ? $clint_name: '' ?></option>
                            <?php 
                          	$managers = $conn->query("SELECT * FROM clintmanege ");
                          	while($row= $managers->fetch_assoc()){
                          	?>
                            <option value="<?php echo $row['clint_id'] ?>" <?php echo isset($jb_client) && $jb_client == $row['clint_id'] ? "selected" : '' ?>><?php echo ucwords($row['clint_name']) ?></option>
                          	<?php } ?>
                      </select>
                        </div>
                   </div>
                <div class="row mb-3">
                       <div class="col-sm-12">
                        <label for="inputText" class="form-label"><span class="required">*</span>Working Type</label>
                        <select class="form-select" id="floatingSelect" name="jb_workingtype" aria-label="Floating label select example" required readonly>
                         <option value="<?php echo isset($jb_workingtype) ? $jb_workingtype: '' ?>"><?php echo isset($jb_workingtype) ? $jb_workingtype: '' ?></option>
                        <option value="Work-Space">Work-Space</option>
                        <option value="Remote">Remote</option>
                        <option value="hybrid">hybrid</option>
                        <option value="Onsite">Onsite</option>
                      </select>
                        </div>
                 </div>
                <div class="row mb-3">
                  <div class="col-sm-12">
                     <label for="inputText" class="form-label">Job Description</label>
                    <textarea class="form-control" name="jb_descrption"  style="height: 300px" readonly>
                       <?php echo isset($jb_descrption) ? $jb_descrption : '' ?>
                    </textarea>
                  </div>
                   
                </div>
               
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-10 col-form-label">File Uploads</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="file" id="formFile" name="jb_fiels">
                  </div>
                </div>
                
                <hr>
                  <h5 class="card-title">Salary information</h5>
                
                    <div class="row mb-3">
                  <div class="col-md-6">
                  <label for="inputState" class="form-label"><span class="required">*</span>Currency</label>
                  <select id="inputState" class="form-select" name="currency" required readonly>
                    <option value="<?php echo isset($currency) ? $currency: '' ?>"><?php echo isset($currency) ? $currency: '' ?></option>
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
                    <option value="LKR">LKR </option>
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
                  <select id="inputState" class="form-select" name="paid_details" required readonly>
                      <option value="<?php echo isset($paid_details) ? $paid_details: '' ?>"><?php echo isset($paid_details) ? $paid_details: '' ?></option>
                    <option value="Hour">Hour</option>
                    <option value="Day">Day</option>
                    <option value="Week">Week</option>
                    <option value="2Week">2Week</option>
                    <option value="Month">Month</option>
                    <option value="Year">Year</option>
                  </select>
                </div>
                </div>
                
                <div class="row mb-3">
                
                  <div class="col-sm-6">
                      <label for="inputNumber" class="form-label"><span class="required">*</span>Minimum Salary</label>
                    <input type="number" name="min_sal" class="form-control" value="<?php echo isset($min_sal) ? $min_sal : '' ?>" required readonly>
                  </div>
                
               
                  <div class="col-sm-6">
                      <label for="inputNumber" class="form-label"><span class="required">*</span>Maximum Salary</label>
                    <input type="number" name="max_sal" class="form-control" value="<?php echo isset($max_sal) ? $max_sal : '' ?>" required readonly>
                  </div>
               
                </div>
                <hr>
                <div class="row mb-3">
                  <div class="col-sm-6">
                 <label for="inputNumber" class="form-label">Deadline</label>
                    <input type="date" name="deadline" value="<?php echo isset($deadline) ? $deadline : '' ?>" class="form-control" readonly>
                  </div>
                  <div class="col-sm-6">
                        <label for="inputText" class="form-label"><span class="required">*</span>Recruiter</label>
                        <select class="form-select" id="floatingSelect" name="jb_recuiters"  required readonly>
                            <option value="<?php echo isset($jb_recuiters) ? $jb_recuiters: '' ?>"><?php echo isset($name) ? $name: '' ?></option>
                            <?php 
                          	$employees = $conn->query("SELECT *,concat(firstname ,' ', lastname) as name from users ");
                          	while($row= $employees->fetch_assoc()){
                          	?>
                          	<option value="<?php echo $row['id'] ?>" <?php echo isset($jb_recuiters) && in_array($row['name'],explode(',',$jb_recuiters)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                          	<?php } ?>
                      </select>
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
//   <script>
// 	$('#job-management').submit(function(e){
// 		e.preventDefault()
// 		start_load()
// 		$.ajax({
// 			url:'ajax.php?action=job_management',
// 			data: new FormData($(this)[0]),
// 		    cache: false,
// 		    contentType: false,
// 		    processData: false,
// 		    method: 'POST',
// 		    type: 'POST',
// 			success:function(resp){
// 				if(resp == 1){
// 					alert_toast('Data successfully saved',"success");
// 					setTimeout(function(){
// 						location.href = 'index2.php?page=jobmangement_list'
// 					},2000)
// 				}
// 			}
// 		})
// 	})
// </script>