  <main>

    <div class="pagetitle">
      <h1>KPI</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">KPI</li>
          <li class="breadcrumb-item active">Total Revenue Per/month</li>
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
              <h5 class="card-title">Total Revenue Per/month</h5>
               <form action="kpitotalrevenugen.php" method="GET">
                    <div class="col-sm-12">
                        <label for="inputText" class="form-label"><span class="required">*</span>Team Lead</label>
                        <select class="form-select" id="floatingSelect"   name="jb_recuiters"   required>
                            <?php 
                          	$employees = $conn->query("SELECT *,concat(firstname ,' ', lastname) as name from users WHERE id in (6,9,15) AND active=1 GROUP BY email ");
                          	while($row= $employees->fetch_assoc()){
                          	?>
                          	<option value="<?php echo $row['id'] ?>" <?php echo isset($jb_recuiters) && in_array($row['name'],explode(',',$jb_recuiters)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                          	<?php } ?>
                      </select>
                    </div>
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
 