  <main>

    <div class="pagetitle">
      <h1>KPI</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">KPI</li>
          <li class="breadcrumb-item active">Screening Ratio</li>
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
              <h5 class="card-title">Screening Ratio</h5>
               <form action="kpi_screeningratiogen.php" method="GET">
                   <div class="col-sm-12">
    <label for="inputText" class="form-label"><span class="required">*</span>Select</label>
    <select id="teamLeadSelect" class="form-select" >
        <option value="TeamLead">Team Lead</option>
        <option value="AccountManager">Account Manager</option>
        <option value="Recruiter">Recruiter</option>
    </select>
    <select class="form-select" id="floatingSelect" name="jb_recuiters" >
         <option></option>
         <?php 
                          	$employees = $conn->query("SELECT *,concat(firstname ,' ', lastname) as name from users WHERE id in (6,9,15) AND active=1 GROUP BY email ");
                          	while($row= $employees->fetch_assoc()){
                          	?>
                          	<option value="<?php echo $row['id'] ?>" <?php echo isset($jb_recuiters) && in_array($row['name'],explode(',',$jb_recuiters)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
        <?php } ?>
    </select>
    <select class="form-select" id="floatingSelect1" name="jb_recuiters" >
        <option></option>
         <?php 
                          	$employees = $conn->query("SELECT *,concat(firstname ,' ', lastname) as name from users WHERE id in (6,9,10,15,23) AND active=1 GROUP BY email ");
                          	while($row= $employees->fetch_assoc()){
                          	?>
                          	<option value="<?php echo $row['id'] ?>" <?php echo isset($jb_recuiters) && in_array($row['name'],explode(',',$jb_recuiters)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                          	<?php } ?>
    </select>
    <select class="form-select" id="floatingSelect2" name="jb_recuiters" >
         <option></option>
           <?php 
                          	$employees = $conn->query("SELECT *, CONCAT(firstname, ' ', lastname) AS name FROM users WHERE type IN (1, 2, 3) AND active = 1 AND id NOT IN (5, 13, 19,25,39) GROUP BY email;");
                          	while($row= $employees->fetch_assoc()){
                          	?>
                          	<option value="<?php echo $row['id'] ?>" <?php echo isset($jb_recuiters) && in_array($row['name'],explode(',',$jb_recuiters)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
       <?php } ?>
    </select>
</div>
<script>
    // Get references to the select elements
    const teamLeadSelect = document.getElementById("teamLeadSelect");
    const floatingSelect = document.getElementById("floatingSelect");
    const floatingSelect1 = document.getElementById("floatingSelect1");
    const floatingSelect2 = document.getElementById("floatingSelect2");

    // Function to show/hide and enable/disable the appropriate select element based on the selected value
    function handleTeamLeadSelectChange() {
        const selectedValue = teamLeadSelect.value;

        // Hide all select elements
        floatingSelect.style.display = "none";
        floatingSelect1.style.display = "none";
        floatingSelect2.style.display = "none";

        // Disable all select elements
        disableSelect(floatingSelect);
        disableSelect(floatingSelect1);
        disableSelect(floatingSelect2);

        // Show the corresponding select element based on the selected value
        if (selectedValue === "TeamLead") {
            floatingSelect.style.display = "block";
            enableSelect(floatingSelect);
        } else if (selectedValue === "AccountManager") {
            floatingSelect1.style.display = "block";
            enableSelect(floatingSelect1);
        } else if (selectedValue === "Recruiter") {
            floatingSelect2.style.display = "block";
            enableSelect(floatingSelect2);
        }
    }

    // Function to disable a select element and hide its label
    function disableSelect(selectElement) {
        selectElement.disabled = true;
        selectElement.previousElementSibling.style.display = "none";
    }

    // Function to enable a select element
    function enableSelect(selectElement) {
        selectElement.disabled = false;
        selectElement.previousElementSibling.style.display = "block";
    }

    // Attach an event listener to the teamLeadSelect element
    teamLeadSelect.addEventListener("change", handleTeamLeadSelectChange);

    // Call the function initially to set the initial state
    handleTeamLeadSelectChange();
</script>

                     <div class="col-sm-12">
                        <label for="inputText" class="form-label"><span class="required">*</span>Start Date</label>
                        <input type="date" name="st_date" class="form-control" required>
                    </div>
                    <div class="col-sm-12">
                        <label for="inputText" class="form-label"><span class="required">*</span>End Date</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                    
                  <div class="col-sm-12">
                      <label for="inputText" class="form-label"></label>
                    <button name="generate_report" class="form-control btn btn-primary">Submit Form</button>
                  </div>
                  
                </form>
              </div>
          </div>

        </div>
      </div>
      </div>
    </section>
  </main><!-- End #main -->
 