
  <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<?php include('db_connect.php'); ?>   
<?php if($_SESSION['login_type'] == 1){ ?>
    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Total</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Super Admin <span class="text-muted small pt-2 ps-1">- </span><span class="text-success small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM users where type = 1")->num_rows; ?></span></a></li>
                    <li><a class="dropdown-item" href="#">Admin <span class="text-muted small pt-2 ps-1">-</span> <span class="text-success small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM users where type = 3")->num_rows; ?></span></a></a></li>
                    <li><a class="dropdown-item" href="#">Users <span class="text-muted small pt-2 ps-1">-</span> <span class="text-success small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM users where type = 2")->num_rows; ?></span></a></a></li>
                    <li><a class="dropdown-item" href="#">Freelancers <span class="text-muted small pt-2 ps-1">-</span> <span class="text-success small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM users where type = 4")->num_rows; ?></span></a></a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Users <span>| Data</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                         <?php $count1 = $conn->query("SELECT * FROM users where type = 1")->num_rows; ?>
                         <?php $count2 = $conn->query("SELECT * FROM users where type = 2")->num_rows; ?>
                         <?php $count3 = $conn->query("SELECT * FROM users where type = 3")->num_rows; ?>
                         <?php $count4 = $conn->query("SELECT * FROM users where type = 4")->num_rows; ?>
                         <?php echo $count1+$count2+$count3+$count4; ?>
                      </h6>
                      <!--<span class="text-success small pt-1 fw-bold">Current</span> <span class="text-muted small pt-2 ps-1">Data's</span>-->

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Documents Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Documents</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Total Documents <span class="text-muted small pt-2 ps-1">- </span><span class="text-primary small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents ")->num_rows; ?> </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=adminapproved">Total Approved <span class="text-muted small pt-2 ps-1">- </span><span class="text-success small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =1")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=adminpending">Total Pending <span class="text-muted small pt-2 ps-1">- </span><span class="text-warning small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =0")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=adminreject">Total Reject <span class="text-muted small pt-2 ps-1">- </span><span class="text-danger small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =2")->num_rows; ?>  </span></a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Documents <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-files"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                       date_default_timezone_set("Asia/colombo");
                       $month = date("m");
                       $year = date("Y");
                        $query = $conn->query("
                        SELECT count(*) AS count FROM `documents` WHERE EXTRACT(YEAR FROM date) ='$year' AND EXTRACT(MONTH FROM date)='$month'");
                        foreach($query as $data)
                        {$count= $data['count'];}
                        echo  $count;
                      ?>
                      &nbsp;/&nbsp;
                      <span>0 </span>
                      </h6>
                      
                      <span class="text-success small pt-1 fw-bold">Monthly</span> <span class="text-muted small pt-2 ps-1">Weekly</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
              <div class="col-xxl-12 col-md-12">
                 
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>My Documents</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">My Documents <span class="text-muted small pt-2 ps-1">- </span><span class="text-primary small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents where user_id = {$_SESSION['login_id']} ")->num_rows; ?> </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=myapproved">My Approved <span class="text-muted small pt-2 ps-1">- </span><span class="text-success small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =1 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=mypending">My Pending <span class="text-muted small pt-2 ps-1">- </span><span class="text-warning small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =0 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=myreject">My Reject <span class="text-muted small pt-2 ps-1">- </span><span class="text-danger small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =2 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">My Documents <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-files"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                       date_default_timezone_set("Asia/colombo");
                       $month = date("m");
                       $year = date("Y");
                        $query = $conn->query("
                        SELECT count(*) AS count FROM `documents` WHERE EXTRACT(YEAR FROM date) ='$year' AND EXTRACT(MONTH FROM date)='$month' AND user_id = {$_SESSION['login_id']}");
                        foreach($query as $data)
                        {$count= $data['count'];}
                        echo  $count;
                      ?>
                      &nbsp;/&nbsp;
                      <span>0 </span>
                      </h6>
                      
                      <span class="text-success small pt-1 fw-bold">Monthly</span> <span class="text-muted small pt-2 ps-1">Weekly</span>

                    </div>
                  </div>
                </div>

              </div> 
            </div><!-- End Customers Card -->
            
                            <!--  Calender line chart Sales -->
            
        
             <div class="col-lg-12">
                     <div class="card">
                         <div class="card-body">
                                <h5 class="card-title"> Interviews <span>/ Graph </span></h5>
                                    <?php include "calenderinrerview_graph.php"; ?>
                        </div>
                    </div>
            </div>
        <!--  Calender line chart Sales -->
                
              
            
             <!-- Recent Calender -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Maximize</h6>
                    </li>
                        <li><a class="dropdown-item" href="/index2.php?page=event_calallviews"> [] View 
                            
                        
                        </a></li>

                 <!--   <li><a class="dropdown-item" href="#">-->
                 <!--       <form method="post" action="export.php">-->
                 <!--   <button type="submit" name="export" class="btn btn-success" /><span class="badge bg-success">export</span></button>-->
                 <!--</form>-->
                        
                 <!--       </a></li>-->
      
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Interviews  <span>/ Calender </span> </h5>
                    <?php include "event_calallviews.php";?>

                </div>

              </div>
            </div>
            
            
            <!--  Revenu Datats  -->
              <div class="col-xxl-12 col-md-12">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Revenue</h6>
                    </li>
                       <?php
                $i = 1;
                $year = date("Y");
                $qry = $conn->query("SELECT month as monthname, year, SUM(amount) as amount FROM sale_target WHERE month in ('Sep','Oct','Nov','Dec','Jan','Feb') AND  year='$year' GROUP BY month ORDER BY FIELD(month, 'Sep','Oct','Nov','Dec','Jan','Feb')");
                while($row= $qry->fetch_assoc()){?>

                    <li><a class="dropdown-item" href="#"><?php echo $row['monthname'];?>-<?php echo $row['year'];?><span class="text-muted small pt-2 ps-1">Rs. </span><span class="text-success small pt-1 fw-bold"><?php echo number_format($row['amount'],2);?></span></a></li>
                <?php } ?>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Revenue <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                       date_default_timezone_set("Asia/colombo");
                       $month = date("M");
                       $year = date("Y");
                        $query = $conn->query("
                        SELECT month as monthname, 
                        SUM(amount) as amount 
                        FROM sale_target
                        WHERE month='$month' AND year='$year'
                        GROUP BY month
                        order by id asc");
                        foreach($query as $data)
                        {$amount= $data['amount'];}
                        echo "Rs." . number_format($amount);
                      ?></h6>
                      <!--<span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>-->

                    </div>
                  </div>
                </div>

              </div>
            </div>
              <!-- Reports -->
             <!-- Line Chart -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div><!-- End Reports -->
              <div class="col-lg-12">
                     <div class="card">
                         <div class="card-body">
                                <h5 class="card-title">Revenue <span>/Graph </span></h5>
                    
                                  <?php 
                                // WHERE month in ('Aug','Oct','Nov','Dec')   AND `year` = '$year'
                                  date_default_timezone_set("Asia/colombo");
                                   $year = date("Y");
                                   $currentMonth = date("M");
                                   $months = [];
                                    for ($i = -3; $i <= 2; $i++) {
                                        $timestamp = strtotime("$i month");
                                        $months[] = [
                                            'month' => date("M", $timestamp),
                                            'year' => date("Y", $timestamp)
                                        ];
                                    }
                                    $monthList = implode("','", array_column($months, 'month'));
                                $yearList = array_column($months, 'year');
                                
                                // Build SQL query
                                $queryParts = [];
                                foreach ($months as $m) {
                                    $queryParts[] = "(month = '{$m['month']}' AND `year` = {$m['year']})";
                                }
                                
                                $queryCondition = implode(" OR ", $queryParts);

                                $query = $conn->query("
                                            SELECT month as monthname, 
                                           SUM(amount) as amount 
                                    FROM sale_target
                                    WHERE $queryCondition
                                    GROUP BY month
                                    ORDER BY FIELD(month, '$monthList')
                                     
                                  ");
                                  
                                  $month = [];
                                  $amount = [];
                                
                                  foreach($query as $data)
                                  {
                                    $month[] = $data['monthname'];
                                    $amount[] = $data['amount'];
                            
                                  }
                                
                                ?>
                      
                   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                   <canvas id="lineChart" style="max-height: 400px;"></canvas>
          
                     
                    <script>
                      // === include 'setup' then 'config' above ===
                     const labels = <?php echo json_encode($month) ?>;
                     const monthtar =[
                           {month:'Feb', amount:'2000000'},
                           {month:'Mar', amount:'2000000'},
                           {month:'Apr', amount:'2000000'},
                           {month:'May', amount:'2000000'},
                           {month:'Jun', amount:'2000000'},
                           {month:'Jul', amount:'2000000'}
                           
                           
                          ];
                    
                          
                    const data = {
                      labels: labels,
                      datasets: [{
                        label: 'Revenue Data',
                        data: <?php echo json_encode($amount) ?>,
                        fill: false,
                          backgroundColor: [
                              'rgba(0,100,0)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(255, 159, 64, 0.2)',
                              'rgba(0, 0, 0, 0.2)'
                            ],
                            borderColor: [
                              'rgba(0,100,0)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)',
                              'rgba(255, 159, 64, 1)',
                              'rgba(0, 0, 0, 1)'
                            ],
                           tension: 0.1
                      },
                      {
                            label: 'Monthly Revenue Target',
                            data: monthtar,
                            tension: 0.1,
                            backgroundColor: 'rgba(255,0,0)',
                            borderColor:'rgba(255,0,0)',
                            parsing:{xAxisKey:'month', yAxisKey:'amount'}
                       
                      }   
                      ]
                    };
                    
                    
                      const config = {
                        type: 'line',
                        data: data,
                        options: {
                          scales: {
                            y: {
                              beginAtZero: true
                            }
                          }
                        },
                      };
                    
                      var lineChart = new Chart(
                        document.getElementById('lineChart'),
                        config
                      );
                    </script>
                     
   
                  
                  <!-- End Line Chart -->

                
                        </div>
                    </div>
                </div>
                  <!-- End Reports -->

              </div>
            </div><!-- End Grapgh Reports -->
            
<!---------------------------------------------------------------------------- Performace Data---------------------------------------------------------------------------------------->
        
        <!-----------------------Recruiter Wise Kpi  Revenu line chart Sales-------------------------------------------------------------------------------------- -->
             <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Revenue Year Wise <span>Recruiter Wise</span></h5>
                  
               
                  <table class="table table-borderless ">
                    <thead>
                      <tr>
                        <th scope="col">Year</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                 $query="SELECT year,SUM(amount) AS total_amount FROM `sale_target` Group By year;";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["year"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
            <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - This Year Month Wise <span>Recruiter Wise</span></h5>
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        date_default_timezone_set("Asia/colombo");
                       $month = date("M");
                       $year = date("Y");
                 $query="SELECT 
    month,
    SUM(amount) AS total_amount
FROM 
    `sale_target`
WHERE  YEAR(join_date) = '$year'
GROUP BY 
   month
ORDER BY 
    month";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["month"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
        
              <div class="col-12">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Revenue Per/Month <span>Recruiter Wise</span></h5>
                         <span>Recruiter Wise</span>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Client</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                 $query="SELECT sale_target.id, sale_target.candidate, SUM(sale_target.amount) AS total_amount,sale_target.user_id, sale_target.account_manger, sale_target.join_date, sale_target.status,
            documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name
            FROM `sale_target`
            INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
            INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
            INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
 
  
GROUP BY 
    EXTRACT(YEAR FROM sale_target.join_date), EXTRACT(MONTH FROM sale_target.join_date)
ORDER BY 
    sale_target.id ASC; ";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["join_date"].'</td>
                        <td> '.$row["clint_name"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
         <!-----------------------Account Manger Wise Kpi  Revenu line chart Sales-------------------------------------------------------------------------------------- -->
             <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Revenue Year Wise <span>Account Manger Wise</span></h5>
               
                  <table class="table table-borderless ">
                    <thead>
                      <tr>
                        <th scope="col">Year</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                 $query="SELECT year,SUM(amount) AS total_amount FROM `sale_target`  Group By year;";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["year"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
            <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - This Year Month Wise <span>Account Manger Wise</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        date_default_timezone_set("Asia/colombo");
                       $month = date("M");
                       $year = date("Y");
                 $query="SELECT 
    month,
    SUM(amount) AS total_amount
FROM 
    `sale_target`
WHERE 
    YEAR(join_date) = '$year'
GROUP BY 
   month
ORDER BY 
    month";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["month"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
        
              <div class="col-12">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Revenue Per/Month <span>Account Manger Wise</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Client</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                 $query="SELECT sale_target.id, sale_target.candidate, SUM(sale_target.amount) AS total_amount,sale_target.user_id, sale_target.account_manger, sale_target.join_date, sale_target.status,
            documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name
            FROM `sale_target`
            INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
            INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
            INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
            
  
GROUP BY 
    EXTRACT(YEAR FROM sale_target.join_date), EXTRACT(MONTH FROM sale_target.join_date)
ORDER BY 
    sale_target.id ASC; ";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["join_date"].'</td>
                        <td> '.$row["clint_name"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>    
            
        <!-----------------------End Account Manger Wise Kpi  Revenu line chart Sales-------------------------------------------------------------------------------------- -->
            
        <!------------------------------------------------------------KPI Total Cv----------------------------------------------------------------------------->
        
        <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Cv Sent / This Month</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Cilnet Name</th>
                        <th scope="col">Total Cv's</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                         date_default_timezone_set("Asia/colombo");
                       $month = date("m");
                       $year = date("Y");
                        
                 $query="SELECT 
    clintmanege.clint_name AS client_name,
    COUNT(candidate_summery.id) AS total_feedback_count
FROM 
    candidate_summery 
INNER JOIN 
    documents ON (candidate_summery.application_id = documents.id) 
INNER JOIN 
    clintmanege ON (candidate_summery.clint_id = clintmanege.clint_id) 
INNER JOIN 
    users ON (candidate_summery.user_id = users.id) 
WHERE 
 
    candidate_summery.feedback = 'ClientReview' 
    AND MONTH(candidate_summery.date) = '$month' AND YEAR(candidate_summery.date) = '$year'
GROUP BY 
    clintmanege.clint_name
ORDER BY 
    clintmanege.clint_name ASC;";
                 $result = mysqli_query($conn,$query);
                 $total_count = 0;
while($row = mysqli_fetch_array($result)) {
    // Increment the total count by the count for the current row
    $total_count += $row['total_feedback_count'];

    // Output the current row
    echo '<tr>
            <td>'.$row['client_name'].'</td>
            <td>'.$row['total_feedback_count'].'</td>
          </tr>';
}

// Add the total row after iterating through all rows
echo '<tr>
        <td><strong>Total</strong></td>
        <td>'.$total_count.'</td>
      </tr>';
?>
					
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
       <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Cv Sent / Previous Month</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Cilnet Name</th>
                        <th scope="col">Total Cv's</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                         date_default_timezone_set("Asia/colombo");
                       $current_month = date("m");
                        $current_year = date("Y");

                        // Calculate the previous month and year
                        $previous_month = date("m", strtotime("-1 month"));

                        
                 $query="SELECT 
    clintmanege.clint_name AS client_name,
    COUNT(candidate_summery.id) AS total_feedback_count
FROM 
    candidate_summery 
INNER JOIN 
    documents ON (candidate_summery.application_id = documents.id) 
INNER JOIN 
    clintmanege ON (candidate_summery.clint_id = clintmanege.clint_id) 
INNER JOIN 
    users ON (candidate_summery.user_id = users.id) 
WHERE 
   candidate_summery.feedback = 'ClientReview' 
    AND MONTH(candidate_summery.date) = '$previous_month' AND YEAR(candidate_summery.date) = '$year'
GROUP BY 
    clintmanege.clint_name
ORDER BY 
    clintmanege.clint_name ASC;";
    
    $result = mysqli_query($conn, $query);
$total_count = 0;

while ($row = mysqli_fetch_array($result)) {
    // Increment the total count by the count for the current row
    $total_count += $row['total_feedback_count'];

    // Output the current row
    echo '<tr>
            <td>' . $row['client_name'] . '</td>
            <td>' . $row['total_feedback_count'] . '</td>
          </tr>';
}

// Add the total row after iterating through all rows
echo '<tr>
        <td><strong>Total</strong></td>
        <td>' . $total_count . '</td>
      </tr>';
?>
					
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>     
        
         <div class="col-lg-12">
                     <div class="card">
                         <div class="card-body">
                                <h5 class="card-title"> KPI - Total Cv Sent <span>/ Month </span></h5>
                                    <?php include "kpi_totalmonth_graph.php"; ?>
                        </div>
                    </div>
            </div>
        
        
        <!--------------------------------------------------------------KPi END Total CV---------------------------------------------------------------------------->
 <!----------------------------------------------------------------------------END Performace Data---------------------------------------------------------------------------------------->           
            
<!---------------------- Data Existing Checker---------------------------------->
        <div class="col-12">
              <div class="card recent-sales overflow-auto">
              
                  <div class="card-body">
                    <h5 class="card-title"> Data Existing Checker</h5>
                                  <form method="POST" class="row g-3">
  <div class="col-md-4">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" >
  </div>
  <div class="col-md-4">
    <label for="phone" class="form-label">Phone Number</label>
    <input type="text" name="phone" class="form-control" >
     <div class="form-text">Enter the last 6 digits of mobile number.</div>
  </div>
  <div class="col-md-4 align-self-end">
    <button type="submit" name="check_data" class="btn btn-primary">Check Data</button>
  </div>
</form>
<?php
if (isset($_POST['check_data'])) {
    $conditions = [];
    
    if (!empty($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $conditions[] = "email = '$email'";
    }

    if (!empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $last6 = substr($phone, -6);
        $conditions[] = "phonenumber LIKE '%$last6'";
    }

    if (!empty($conditions)) {
        $whereClause = implode(" OR ", $conditions);
        $query = "SELECT `recruiter`, `ref_no`, `phonenumber`, `email`, `date_created`, `id` 
                  FROM documents 
                  WHERE $whereClause";
        
        $result = mysqli_query($conn, $query);

        echo '<div class="mt-4">';
        if (mysqli_num_rows($result) > 0) {
            echo '<h5 class="card-title">Matching Records</h5>';
            echo '<table class="table table-bordered">';
            echo '<thead><tr><th>Ref No</th><th>Email</th><th>Phone</th><th>Recruiter</th><th>Upload Date</th></tr></thead><tbody>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                $refFormatted = $row['ref_no'] <= 99 
                                ? str_replace(' ','', $row['recruiter']."00".$row['ref_no']) 
                                : str_replace(' ','', $row['recruiter']."0".$row['ref_no']);
                
                echo "<tr>
                        <td><a target='_blank' href='./index2.php?page=view_documentz&id={$row['id']}'>#{$refFormatted}</a></td>
                        <td>{$row['email']}</td>
                        <td>{$row['phonenumber']}</td>
                        <td>{$row['recruiter']}</td>
                        <td><span class='badge bg-success'>{$row['date_created']}</span></td>
                      </tr>";
            }

            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-success" role="alert">No data found</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Please enter at least Email or Phone Number.</div>';
    }
}
?>

                </div>

              </div>
            </div>    
            
            
            
            <!--------- Duplicated Data Checker -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Export Data</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">
                        <form method="post" action="export.php">
                    <button type="submit" name="export" class="btn btn-success" /><span class="badge bg-success">export</span></button>
                 </form>
                        
                        </a></li>
      
                  </ul>
                </div>
              

                <div class="card-body">
                  <h5 class="card-title">Duplicate Datasets List</h5>

                      <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Recruiter</th>
                        <th scope="col">Date/Time</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                 $query="SELECT `recruiter`,`ref_no`,`phonenumber`,`email`,`date_created`, MIN(`id`) AS ID
                            FROM documents
                            GROUP BY `phonenumber`,`email`
                            HAVING COUNT(email) > 0";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
                     if($row['ref_no'] <= 99){
						$recq=$row['recruiter'];
						$reqanswr=$recq."00".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}else{
						 $recq=$row['recruiter'];
						$reqanswr=$recq."0".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}
						
				// 		echo'<tr>
    //                     <th scope="row"><a target="_blank" href="./index2.php?page=view_documentz&id='.$row["ID"].'" style="color:#0d6efd;">#'.$string.'</a></th>
    //                     <td> 0'.$row["phonenumber"].'</td>
    //                     <td><a target="_blank" href="./index2.php?page=view_documentz&id='.$row["ID"].'" class="text-primary"> '.$row["email"].'</a></td>
    //                     <td>'. $row["recruiter"].'</td>
    //                     <td><span class="badge bg-success">'. $row["date_created"].'</span></td>
    //                   </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
                   <!--------------------Ats------------------->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Application Tracking System</h5>

                         <div class="activity">
                             <div class="alert alert-primary alert-dismissible fade show "  style="text-align:center;" role="alert">
                                 <i class="bi bi-card-checklist"></i> Reports
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                     
                                    <a href="./index2.php?page=saledashtest" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">View</a>

                                 </div>
                             </div>
                            </div>
                     </div>
                </div>
                
                 <!--------------------MY Ats------------------->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Candidate ATS</h5>

                         <div class="activity">
                             <div class="alert alert-primary alert-dismissible fade show "  style="text-align:center;" role="alert">
                                 <i class="bi bi-card-checklist"></i> Reports
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                     
                                    <a href="./index2.php?page=ats_saledash_data" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">View</a>

                                 </div>
                             </div>
                            </div>
                     </div>
                </div>
        <!--------------------Lkcareers Login------------------->
        <!--------------------Rooster Login------------------->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rooster Portal </h5>

                         <div class="activity">
                             <div class="alert alert-primary alert-dismissible fade show "  style="text-align:center;" role="alert">
                                 <i class="bi bi-card-checklist"></i> Panel
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                     
                                    <a href="https://app.rooster.org/dashboard" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">Login</a>

                                 </div>
                             </div>
                            </div>
                     </div>
                </div>
        <!--------------------Rooster Login------------------->
        
            <!--------------------Lkcareers Login------------------->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lkcareers <span>| Admin panel</span></h5>

                         <div class="activity">
                             <div class="alert alert-primary alert-dismissible fade show " role="alert">
                                 <i class="bi bi-link-45deg"></i> Lkcareers Admin panel
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                     
                                    <a href="https://lkcareers.lk/LKAdmin" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">Login</a>

                                 </div>
                             </div>
                            </div>
                     </div>
                </div>
        <!--------------------Lkcareers Login------------------->
            <!------------My Role Accounts------------>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">My Login Role <span>| Accounts</span></h5>

              <div class="activity">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <i class="bi bi-folder me-1"></i> Can Switch Your Accounts From Here
                
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
                  
                <?php
        if (isset($_SESSION['login_email'])) {
            $selectedEmails = $_SESSION['login_email'];
            $emails = explode(',', $selectedEmails);

            foreach ($emails as $email) {
                $email = trim($email);

                $query = "SELECT * FROM `users` WHERE `email` = '$email'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    
                    $query1 = "SELECT email, password, type FROM `users` WHERE `email` = '$email'";
                    $result1 = mysqli_query($conn, $query1);

                    if ($result1 && mysqli_num_rows($result1) > 0) {
                        while ($row1 = mysqli_fetch_array($result1)) {
                            ?>
                            <form class="flex-c login-form">
                                <div class="input-box">
                                    <div class="flex-r input">
                                        <input type="hidden" name="email" value="<?php echo $row1["email"]; ?>">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>

                                <div class="input-box">
                                    <div class="flex-r input">
                                        <input type="hidden" name="password" value="<?php echo $row1["password"]; ?>">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>

                                <div style="padding:3px;">
                                    <center>
                                        <button class="btn btn-6 btn-6e btn btn-outline-primary" type="submit">
                                            <?php
                                            if ($row1["type"] == 1) {
                                                echo "Super Admin";
                                            } elseif ($row1["type"] == 2) {
                                                echo "User";
                                            } elseif ($row1["type"] == 3) {
                                                echo "Admin";
                                            } elseif ($row1["type"] == 4) {
                                                echo "Freelancer";
                                            } elseif ($row1["type"] == 5) {
                                                echo "Tempuser";
                                            } else {
                                                echo "Error";
                                            }
                                            ?>
                                        </button>
                                         
                                    </center>
                                </div>
                            </form>
                            <?php
                        }
                    } else {
                        echo "Error executing the query for $email";
                    }
                } else {
                    echo "No user found for email: $email";
                }
            }
        } else {
            echo "Login User is not set.";
        }
        ?>

              </div>

            </div>
          </div>
           <!------------End My Role Accounts------------>
          <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">My Account <span>| List</span></h5>

              <div class="activity">
                  
                   <?php
                $i = 1;
                $qry = $conn->query("SELECT project_list.id,project_list.name,project_list.rolname,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}' ");
                while($row= $qry->fetch_assoc()){
    
                  ?>

                <div class="activity-item d-flex">
                  <div class="activite-label"><?php echo date("M d, Y",strtotime($row['start_date'])); ?></div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    <?php echo $row['rolname']; ?> To <a href="#" class="fw-bold text-dark"><?php echo $row['clint_name']; ?></a>
                  </div>
                </div>
                <div class="activity-item d-flex">
                  <div class="activite-label"><?php echo date("M d, Y",strtotime($row['end_date'])); ?></div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                </div>
                
                <!-- End activity item-->

                <?php } ?>

              </div>

            </div>
          </div><!-- End Recent Activity -->

          <!-- Sprint Report -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Sprint Report <span>| This Month</span></h5>

                <?php

// Select Query
$sql = "SELECT project_list.id,project_list.name,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}'";
$res = mysqli_query($conn, $sql);

// Create Array  and push your data 
$stack = array();
while ($datarows =mysqli_fetch_array( $res, MYSQLI_ASSOC )) {
  array_push($stack, $datarows);
 
}
// Encode your stack array
$Encoded_JSON_Array = json_encode( $stack );

?>


  <script type="text/javascript" src="https://unpkg.com/vis-timeline@latest/standalone/umd/vis-timeline-graph2d.min.js"></script>
  <link href="https://unpkg.com/vis-timeline@latest/styles/vis-timeline-graph2d.min.css" rel="stylesheet" type="text/css" />
 

<div class="col-md-12" style="min-height: 200px;" id="visualization"></div>

<script type="text/javascript">
  // DOM element where the Timeline will be attached
  var container = document.getElementById('visualization');
// Create a DataSet (allows two way data-binding)
  

// CREATE NEW ARRAY, THEN CARRY ON AND CONVERT THE PHP ARRAY TO A JAVASCRIPT ARRAY
const new_Array = []
var Encoded_JSON_Array = <?php echo $Encoded_JSON_Array ?> ; // CONVERTS TO JS ARRAY

// !IMPORTANT 
// PUSH DATA INTO YOUR NEW ARRAY AS OBJECTS. NOTES! vis.js DATASET MUST HAVE THIS {id: , content: , start: }. THEY ARE CONSTANTS THAT YOU CANT CHANGE IT. 
for (let i = 0; i <Encoded_JSON_Array.length; i++){
  new_Array.push({id: Number(Encoded_JSON_Array[i].id),content: Encoded_JSON_Array[i].clint_name,start: Encoded_JSON_Array[i].start_date, end: Encoded_JSON_Array[i].end_date})
}

// CALL YOUR ARRAY IN DATASET, THEN YOU ARE GOOD TO GO!
var items = new vis.DataSet(new_Array);

  // Configuration for the Timeline
  var options = {};

  // Create a Timeline
  var timeline = new vis.Timeline(container, items, options);
</script>

      
      
      
              

            </div>
          </div><!-- End Sprint Report -->

          <!-- Donut Pie Chart Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>
                 <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">Today</a></li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">This Week</a></li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">This Month</a></li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">This Year</a></li>
                
         
              </ul>
            </div>
            <div class="card-body pb-0">
              <h5 class="card-title">Weekly Summary<span> |This Week</span></h5>
                 	<div class="card-body pie-chart">
                         <canvas id="doughnut_chart"  class="echart"></canvas>
                    </div>
            </div>
            <input type="hidden" name="post_id" id="post_id" value="<?php echo $_SESSION['login_id']; ?>"> 
            <script>
	
$(document).ready(function(){
  
	makechart();
	function makechart()
	{
	    var post_id = $('#post_id').val();
	    
		$.ajax({
			url:"homepiechrtdata.php",
			method:"POST",
			data:{action:'fetch', post_id:post_id},
			dataType:"JSON",
			success:function(data)
			{
				var language = [];
				var total = [];
				var color = [];

				for(var count = 0; count < data.length; count++)
				{
					language.push(data[count].language);
					total.push(data[count].total);
					color.push(data[count].color);
				}

				var chart_data = {
					labels:language,
					datasets:[
						{
							label:'Count',
							backgroundColor:color,
							color:'#fff',
							data:total
						}
					]
				};

				var options = {
					responsive:true,
					scales:{
						yAxes:[{
							ticks:{
								min:0
							}
						}]
					}
				};

				var group_chart1 = $('#pie_chart');

				var graph1 = new Chart(group_chart1, {
					type:"pie",
					data:chart_data
				});

				var group_chart2 = $('#doughnut_chart');

				var graph2 = new Chart(group_chart2, {
					type:"doughnut",
					data:chart_data
				});

				var group_chart3 = $('#bar_chart');

				var graph3 = new Chart(group_chart3, {
					type:'bar',
					data:chart_data,
					options:options
				});
			}
		})
	}

});

</script>
          </div>
          <!-- End Donut Pie Chart Traffic -->

          <!-- News & Updates Traffic -->
          
                  <!--<div class="card">-->
                  <!--  <div class="filter">-->
                  <!--    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>-->
                  <!--    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">-->
                  <!--      <li class="dropdown-header text-start">-->
                  <!--        <h6>Filter</h6>-->
                  <!--      </li>-->
        
                  <!--      <li><a class="dropdown-item" href="#">Today</a></li>-->
                  <!--      <li><a class="dropdown-item" href="#">This Month</a></li>-->
                  <!--      <li><a class="dropdown-item" href="#">This Year</a></li>-->
                  <!--    </ul>-->
                  <!--  </div>-->
        
                  <!--  <div class="card-body pb-0">-->
                  <!--    <h5 class="card-title">Events &amp; Updates <span>| Today</span></h5>-->
                    
                  <!--  </div>-->
                  <!--</div>-->

        </div><!-- End Right side columns -->

      </div>
    </section>
 <!-- --------------------------------------------------------------End  Admin Dashboard ------------------------------------------------------------------------>   
<?php }elseif($_SESSION['login_type'] == 2){ ?>

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

     

            <!-- Customers Card -->
              <div class="col-xxl-4 col-md-5">
                 
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>My Documents</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">My Documents <span class="text-muted small pt-2 ps-1">- </span><span class="text-primary small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents where user_id = {$_SESSION['login_id']} ")->num_rows; ?> </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=myapproved">My Approved <span class="text-muted small pt-2 ps-1">- </span><span class="text-success small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =1 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=mypending">My Pending <span class="text-muted small pt-2 ps-1">- </span><span class="text-warning small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =0 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=myreject">My Reject <span class="text-muted small pt-2 ps-1">- </span><span class="text-danger small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =2 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Documents <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-files"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                       date_default_timezone_set("Asia/colombo");
                       $month = date("m");
                       $year = date("Y");
                        $query = $conn->query("
                        SELECT count(*) AS count FROM `documents` WHERE EXTRACT(YEAR FROM date) ='$year' AND EXTRACT(MONTH FROM date)='$month' AND user_id = {$_SESSION['login_id']}");
                        foreach($query as $data)
                        {$count= $data['count'];}
                        echo  $count;
                      ?>
                      &nbsp;/&nbsp;
                      <span>0 </span>
                      </h6>
                      
                      <span class="text-success small pt-1 fw-bold">Monthly</span> <span class="text-muted small pt-2 ps-1">Weekly</span>

                    </div>
                  </div>
                </div>

              </div> 
            </div><!-- End Customers Card -->
               <div class="col-xxl-5 col-md-7">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Revenue</h6>
                    </li>
                         <?php
                $i = 1;
                $year = date("Y");
                $qry = $conn->query("SELECT month as monthname, year, SUM(amount) as amount FROM sale_target WHERE month in ('Sep','Oct','Nov','Dec','Jan','Feb') AND  year='$year' GROUP BY month ORDER BY FIELD(month, 'Sep','Oct','Nov','Dec','Jan','Feb')");
                while($row= $qry->fetch_assoc()){?>

                    <li><a class="dropdown-item" href="#"><?php echo $row['monthname'];?>-<?php echo $row['year'];?><span class="text-muted small pt-2 ps-1">Rs. </span><span class="text-success small pt-1 fw-bold"><?php echo number_format($row['amount'],2);?></span></a></li>
                <?php } ?>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Revenue <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                       date_default_timezone_set("Asia/colombo");
                       $month = date("M");
                       $year = date("Y");
                        $query = $conn->query("
                        SELECT month as monthname, 
                        SUM(amount) as amount 
                        FROM sale_target
                        WHERE month='$month' AND year='$year'
                        GROUP BY month
                        order by id asc");
                        foreach($query as $data)
                        {$amount= $data['amount'];}
                        echo "Rs." . number_format($amount);
                      ?></h6>
                      <!--<span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>-->

                    </div>
                  </div>
                </div>

              </div>
            </div>
            

            <!-- Reports -->
             <!--  Calender line chart Sales -->
            
        
             <div class="col-lg-12">
                     <div class="card">
                         <div class="card-body">
                                <h5 class="card-title"> Interviews <span>/ Graph </span></h5>
                                    <?php include "calenderinrerview_graph.php"; ?>
                        </div>
                    </div>
            </div>
        <!--  Calender line chart Sales -->
          
            
            
              <!-- Recent Calender -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Export Data</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">
                        <form method="post" action="export.php">
                    <button type="submit" name="export" class="btn btn-success" /><span class="badge bg-success">export</span></button>
                 </form>
                        
                        </a></li>
      
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title"> Interviews <span>/ Calender </span></h5>
                    <?php include "event_calender.php";?>

                </div>

              </div>
            </div><!-- End Calender Sales -->
            
             <!--  Revenu line chart Sales -->
               <!-- Reports -->
             <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div><!-- End Reports -->
                
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-body">
                                <h5 class="card-title">Revenue <span>/Graph </span></h5>
                    
                                  <?php 
                                 date_default_timezone_set("Asia/colombo");
                                   $year = date("Y");
                                  $query = $conn->query("
                                            SELECT month as monthname, 
                                            SUM(amount) as amount 
                                            FROM sale_target
                                           Where (month IN ('Feb','Mar','Apr','May','Jun','Jul') AND `year` = 2025)
                                            
                                            GROUP BY month
                                            ORDER BY FIELD(month, 'Feb','Mar','Apr','May','Jun','Jul')
                                     
                                  ");
                                  
                                  $month= array();
                                  $amount= array();
                                
                                  foreach($query as $data)
                                  {
                                    $month[] = $data['monthname'];
                                    $amount[] = $data['amount'];
                            
                                  }
                                
                                ?>
                      
                   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                   <canvas id="lineChart" style="max-height: 400px;"></canvas>
          
                     
                    <script>
                      // === include 'setup' then 'config' above ===
                     const labels = <?php echo json_encode($month) ?>;
                     const monthtar =[
                            
                         
                           {month:'Feb', amount:'2000000'},
                           {month:'Mar', amount:'2000000'},
                           {month:'Apr', amount:'2000000'},
                           {month:'May', amount:'2000000'},
                           {month:'Jun', amount:'2000000'},
                           {month:'Jul', amount:'2000000'}
                           
                          ];
                    
                          
                    const data = {
                      labels: labels,
                      datasets: [{
                        label: 'Revenue Data',
                        data: <?php echo json_encode($amount) ?>,
                        fill: false,
                          backgroundColor: [
                              'rgba(0,100,0)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(255, 159, 64, 0.2)',
                              'rgba(0, 0, 0, 0.2)'
                            ],
                            borderColor: [
                              'rgba(0,100,0)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)',
                              'rgba(255, 159, 64, 1)',
                              'rgba(0, 0, 0, 1)'
                            ],
                           tension: 0.1
                      },
                      {
                            label: 'Monthly Revenue Target',
                            data: monthtar,
                            tension: 0.1,
                            backgroundColor: 'rgba(255,0,0)',
                            borderColor:'rgba(255,0,0)',
                            parsing:{xAxisKey:'month', yAxisKey:'amount'}
                       
                      }   
                      ]
                    };
                    
                    
                      const config = {
                        type: 'line',
                        data: data,
                        options: {
                          scales: {
                            y: {
                              beginAtZero: true
                            }
                          }
                        },
                      };
                    
                      var lineChart = new Chart(
                        document.getElementById('lineChart'),
                        config
                      );
                    </script>
                     
   
                  
                  <!-- End Line Chart -->

                
                        </div>
                    </div>
                </div><!-- End Reports -->

              </div>
            </div>
            <!-- End Reports -->
        
             
             <!-- Sprint Reports -->
              <!-- Sprint Report -->
          <div class="col-md-12 card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Sprint Report <span>| This Month</span></h5>

                <?php

// Select Query
$sql = "SELECT project_list.id,project_list.name,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}'";
$res = mysqli_query($conn, $sql);

// Create Array  and push your data 
$stack = array();
while ($datarows =mysqli_fetch_array( $res, MYSQLI_ASSOC )) {
  array_push($stack, $datarows);
 
}
// Encode your stack array
$Encoded_JSON_Array = json_encode( $stack );

?>


  <script type="text/javascript" src="https://unpkg.com/vis-timeline@latest/standalone/umd/vis-timeline-graph2d.min.js"></script>
  <link href="https://unpkg.com/vis-timeline@latest/styles/vis-timeline-graph2d.min.css" rel="stylesheet" type="text/css" />
 

<div class="col-md-12" style="min-height: 200px;" id="visualization"></div>

<script type="text/javascript">
  // DOM element where the Timeline will be attached
  var container = document.getElementById('visualization');
// Create a DataSet (allows two way data-binding)
  

// CREATE NEW ARRAY, THEN CARRY ON AND CONVERT THE PHP ARRAY TO A JAVASCRIPT ARRAY
const new_Array = []
var Encoded_JSON_Array = <?php echo $Encoded_JSON_Array ?> ; // CONVERTS TO JS ARRAY

// !IMPORTANT 
// PUSH DATA INTO YOUR NEW ARRAY AS OBJECTS. NOTES! vis.js DATASET MUST HAVE THIS {id: , content: , start: }. THEY ARE CONSTANTS THAT YOU CANT CHANGE IT. 
for (let i = 0; i <Encoded_JSON_Array.length; i++){
  new_Array.push({id: Number(Encoded_JSON_Array[i].id),content: Encoded_JSON_Array[i].clint_name,start: Encoded_JSON_Array[i].start_date, end: Encoded_JSON_Array[i].end_date})
}

// CALL YOUR ARRAY IN DATASET, THEN YOU ARE GOOD TO GO!
var items = new vis.DataSet(new_Array);

  // Configuration for the Timeline
  var options = {};

  // Create a Timeline
  var timeline = new vis.Timeline(container, items, options);
</script>

      
      
      
              

            </div>
          </div>
          <!-- End Sprint Report -->
          
          <!---------------------------------------------------------------------------- Performace Data---------------------------------------------------------------------------------------->
        
        <!-----------------------Recruiter Wise Kpi  Revenu line chart Sales-------------------------------------------------------------------------------------- -->
             <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Revenue Year Wise <span>Recruiter Wise</span></h5>
                  
               
                  <table class="table table-borderless ">
                    <thead>
                      <tr>
                        <th scope="col">Year</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                 $query="SELECT year,SUM(amount) AS total_amount FROM `sale_target` WHERE `user_id` = '{$_SESSION['login_id']}' Group By year;";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["year"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
            <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - This Year Month Wise <span>Recruiter Wise</span></h5>
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        date_default_timezone_set("Asia/colombo");
                       $month = date("M");
                       $year = date("Y");
                 $query="SELECT 
    month,
    SUM(amount) AS total_amount
FROM 
    `sale_target`
WHERE 
    `user_id` = '{$_SESSION['login_id']}' 
    AND YEAR(join_date) = '$year'
GROUP BY 
   month
ORDER BY 
    month";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["month"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
        
              <div class="col-12">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Revenue Per/Month <span>Recruiter Wise</span></h5>
                         <span>Recruiter Wise</span>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Client</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                 $query="SELECT sale_target.id, sale_target.candidate, SUM(sale_target.amount) AS total_amount,sale_target.user_id, sale_target.account_manger, sale_target.join_date, sale_target.status,
            documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name
            FROM `sale_target`
            INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
            INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
            INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
            WHERE 
    sale_target.user_id = '{$_SESSION['login_id']}' 
  
GROUP BY 
    EXTRACT(YEAR FROM sale_target.join_date), EXTRACT(MONTH FROM sale_target.join_date)
ORDER BY 
    sale_target.id ASC; ";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["join_date"].'</td>
                        <td> '.$row["clint_name"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
         <!-----------------------Account Manger Wise Kpi  Revenu line chart Sales-------------------------------------------------------------------------------------- -->
             <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Revenue Year Wise <span>Account Manger Wise</span></h5>
               
                  <table class="table table-borderless ">
                    <thead>
                      <tr>
                        <th scope="col">Year</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                 $query="SELECT year,SUM(amount) AS total_amount FROM `sale_target` WHERE `account_manger` = '{$_SESSION['login_recruiter']}' Group By year;";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["year"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
            <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - This Year Month Wise <span>Account Manger Wise</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        date_default_timezone_set("Asia/colombo");
                       $month = date("M");
                       $year = date("Y");
                 $query="SELECT 
    month,
    SUM(amount) AS total_amount
FROM 
    `sale_target`
WHERE 
    `account_manger` = '{$_SESSION['login_recruiter']}' 
    AND YEAR(join_date) = '$year'
GROUP BY 
   month
ORDER BY 
    month";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["month"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
        
              <div class="col-12">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Revenue Per/Month <span>Account Manger Wise</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Client</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                 $query="SELECT sale_target.id, sale_target.candidate, SUM(sale_target.amount) AS total_amount,sale_target.user_id, sale_target.account_manger, sale_target.join_date, sale_target.status,
            documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name
            FROM `sale_target`
            INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
            INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
            INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
            WHERE 
    sale_target.account_manger = '{$_SESSION['login_recruiter']}' 
  
GROUP BY 
    EXTRACT(YEAR FROM sale_target.join_date), EXTRACT(MONTH FROM sale_target.join_date)
ORDER BY 
    sale_target.id ASC; ";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["join_date"].'</td>
                        <td> '.$row["clint_name"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>    
            
        <!-----------------------End Account Manger Wise Kpi  Revenu line chart Sales-------------------------------------------------------------------------------------- -->
            
        <!------------------------------------------------------------KPI Total Cv----------------------------------------------------------------------------->
        
        <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Cv Sent / This Month</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Cilnet Name</th>
                        <th scope="col">Total Cv's</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                         date_default_timezone_set("Asia/colombo");
                       $month = date("m");
                       $year = date("Y");
                        
                 $query="SELECT 
    clintmanege.clint_name AS client_name,
    COUNT(candidate_summery.id) AS total_feedback_count
FROM 
    candidate_summery 
INNER JOIN 
    documents ON (candidate_summery.application_id = documents.id) 
INNER JOIN 
    clintmanege ON (candidate_summery.clint_id = clintmanege.clint_id) 
INNER JOIN 
    users ON (candidate_summery.user_id = users.id) 
WHERE 
    candidate_summery.user_id = '{$_SESSION['login_id']}' 
    AND candidate_summery.feedback = 'ClientReview' 
    AND MONTH(candidate_summery.date) = '$month' AND YEAR(candidate_summery.date) = '$year'
GROUP BY 
    clintmanege.clint_name
ORDER BY 
    clintmanege.clint_name ASC;";
                 $result = mysqli_query($conn,$query);
                 $total_count = 0;
while($row = mysqli_fetch_array($result)) {
    // Increment the total count by the count for the current row
    $total_count += $row['total_feedback_count'];

    // Output the current row
    echo '<tr>
            <td>'.$row['client_name'].'</td>
            <td>'.$row['total_feedback_count'].'</td>
          </tr>';
}

// Add the total row after iterating through all rows
echo '<tr>
        <td><strong>Total</strong></td>
        <td>'.$total_count.'</td>
      </tr>';
?>
					
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
       <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Cv Sent / Previous Month</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Cilnet Name</th>
                        <th scope="col">Total Cv's</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                         date_default_timezone_set("Asia/colombo");
                       $current_month = date("m");
                        $current_year = date("Y");

                        // Calculate the previous month and year
                        $previous_month = date("m", strtotime("-1 month"));

                        
                 $query="SELECT 
    clintmanege.clint_name AS client_name,
    COUNT(candidate_summery.id) AS total_feedback_count
FROM 
    candidate_summery 
INNER JOIN 
    documents ON (candidate_summery.application_id = documents.id) 
INNER JOIN 
    clintmanege ON (candidate_summery.clint_id = clintmanege.clint_id) 
INNER JOIN 
    users ON (candidate_summery.user_id = users.id) 
WHERE 
    candidate_summery.user_id = '{$_SESSION['login_id']}' 
    AND candidate_summery.feedback = 'ClientReview' 
    AND MONTH(candidate_summery.date) = '$previous_month' AND YEAR(candidate_summery.date) = '$year'
GROUP BY 
    clintmanege.clint_name
ORDER BY 
    clintmanege.clint_name ASC;";
    
    $result = mysqli_query($conn, $query);
$total_count = 0;

while ($row = mysqli_fetch_array($result)) {
    // Increment the total count by the count for the current row
    $total_count += $row['total_feedback_count'];

    // Output the current row
    echo '<tr>
            <td>' . $row['client_name'] . '</td>
            <td>' . $row['total_feedback_count'] . '</td>
          </tr>';
}

// Add the total row after iterating through all rows
echo '<tr>
        <td><strong>Total</strong></td>
        <td>' . $total_count . '</td>
      </tr>';
?>
					
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>     
        
         <div class="col-lg-12">
                     <div class="card">
                         <div class="card-body">
                                <h5 class="card-title"> KPI - Total Cv Sent <span>/ Month </span></h5>
                                    <?php include "kpi_totalmonth_graph.php"; ?>
                        </div>
                    </div>
            </div>
        
        
        <!--------------------------------------------------------------KPi END Total CV---------------------------------------------------------------------------->
 <!----------------------------------------------------------------------------END Performace Data---------------------------------------------------------------------------------------->           
         
<!---------------------- Data Existing Checker---------------------------------->
        <div class="col-12">
              <div class="card recent-sales overflow-auto">
              
                  <div class="card-body">
                    <h5 class="card-title"> Data Existing Checker</h5>
                                  <form method="POST" class="row g-3">
  <div class="col-md-4">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" >
  </div>
  <div class="col-md-4">
    <label for="phone" class="form-label">Phone Number</label>
    <input type="text" name="phone" class="form-control" >
     <div class="form-text">Enter the last 6 digits of mobile number.</div>
  </div>
  <div class="col-md-4 align-self-end">
    <button type="submit" name="check_data" class="btn btn-primary">Check Data</button>
  </div>
</form>
<?php
if (isset($_POST['check_data'])) {
    $conditions = [];
    
    if (!empty($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $conditions[] = "email = '$email'";
    }

    if (!empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $last6 = substr($phone, -6);
        $conditions[] = "phonenumber LIKE '%$last6'";
    }

    if (!empty($conditions)) {
        $whereClause = implode(" OR ", $conditions);
        $query = "SELECT `recruiter`, `ref_no`, `phonenumber`, `email`, `date_created`, `id` 
                  FROM documents 
                  WHERE $whereClause";
        
        $result = mysqli_query($conn, $query);

        echo '<div class="mt-4">';
        if (mysqli_num_rows($result) > 0) {
            echo '<h5 class="card-title">Matching Records</h5>';
            echo '<table class="table table-bordered">';
            echo '<thead><tr><th>Ref No</th><th>Email</th><th>Phone</th><th>Recruiter</th><th>Upload Date</th></tr></thead><tbody>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                $refFormatted = $row['ref_no'] <= 99 
                                ? str_replace(' ','', $row['recruiter']."00".$row['ref_no']) 
                                : str_replace(' ','', $row['recruiter']."0".$row['ref_no']);
                
                echo "<tr>
                        <td><a target='_blank' href='./index2.php?page=view_documentz&id={$row['id']}'>#{$refFormatted}</a></td>
                        <td>{$row['email']}</td>
                        <td>{$row['phonenumber']}</td>
                        <td>{$row['recruiter']}</td>
                        <td><span class='badge bg-success'>{$row['date_created']}</span></td>
                      </tr>";
            }

            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-success" role="alert">No data found</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Please enter at least Email or Phone Number.</div>';
    }
}
?>

                </div>

              </div>
            </div>    
            
            
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Export Data</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">
                        <form method="post" action="export.php">
                    <button type="submit" name="export" class="btn btn-success" /><span class="badge bg-success">export</span></button>
                 </form>
                        
                        </a></li>
      
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Duplicate Datasets List</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Recuiter</th>
                        <th scope="col">Date/Time</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                 $query="SELECT `recruiter`,`ref_no`,`phonenumber`,`email`,`date_created`, MIN(`id`) AS ID
                            FROM documents
                            GROUP BY `phonenumber`,`email`
                            HAVING COUNT(email) > 1";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
                     if($row['ref_no'] <= 99){
						$recq=$row['recruiter'];
						$reqanswr=$recq."00".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}else{
						 $recq=$row['recruiter'];
						$reqanswr=$recq."0".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}
				// 	echo'<tr>
    //                     <th scope="row"><a target="_blank" href="./index2.php?page=view_documentz&id='.$row["ID"].'" style="color:#0d6efd;">#'.$string.'</a></th>
    //                     <td> 0'.$row["phonenumber"].'</td>
    //                     <td><a target="_blank" href="./index2.php?page=view_documentz&id='.$row["ID"].'" class="text-primary"> '.$row["email"].'</a></td>
    //                     <td>'. $row["recruiter"].'</td>
    //                     <td><span class="badge bg-success">'. $row["date_created"].'</span></td>
    //                   </tr>';
                 }
						?>
                      
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
               <!--------------------MY Ats------------------->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Candidate ATS</h5>

                         <div class="activity">
                             <div class="alert alert-primary alert-dismissible fade show "  style="text-align:center;" role="alert">
                                 <i class="bi bi-card-checklist"></i> Reports
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                     
                                    <a href="./index2.php?page=ats_saledash_data" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">View</a>

                                 </div>
                             </div>
                            </div>
                     </div>
                </div>
            <!--------------------Rooster Login------------------->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rooster Portal </h5>

                         <div class="activity">
                             <div class="alert alert-primary alert-dismissible fade show "  style="text-align:center;" role="alert">
                                 <i class="bi bi-card-checklist"></i> Panel
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                     
                                    <a href="https://app.rooster.org/dashboard" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">Login</a>

                                 </div>
                             </div>
                            </div>
                     </div>
                </div>
        <!--------------------Rooster Login------------------->
        
             <!--------------------Lkcareers Login------------------->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lkcareers <span>| Admin panel</span></h5>

                         <div class="activity">
                             <div class="alert alert-primary alert-dismissible fade show " role="alert">
                                 <i class="bi bi-link-45deg"></i> Lkcareers Admin panel
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                     
                                    <a href="https://lkcareers.lk/LKAdmin" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">Login</a>

                                 </div>
                             </div>
                            </div>
                     </div>
                </div>
        <!--------------------Lkcareers Login------------------->
                 <!------------My Role Accounts------------>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">My Login Role <span>| Accounts</span></h5>

              <div class="activity">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <i class="bi bi-folder me-1"></i> Can Switch Your Accounts From Here
                
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
                  
                <?php
        if (isset($_SESSION['login_email'])) {
            $selectedEmails = $_SESSION['login_email'];
            $emails = explode(',', $selectedEmails);

            foreach ($emails as $email) {
                $email = trim($email);

                $query = "SELECT * FROM `users` WHERE `email` = '$email'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    
                    $query1 = "SELECT email, password, type FROM `users` WHERE `email` = '$email'";
                    $result1 = mysqli_query($conn, $query1);

                    if ($result1 && mysqli_num_rows($result1) > 0) {
                        while ($row1 = mysqli_fetch_array($result1)) {
                            ?>
                            <form class="flex-c login-form">
                                <div class="input-box">
                                    <div class="flex-r input">
                                        <input type="hidden" name="email" value="<?php echo $row1["email"]; ?>">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>

                                <div class="input-box">
                                    <div class="flex-r input">
                                        <input type="hidden" name="password" value="<?php echo $row1["password"]; ?>">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>

                                <div style="padding:3px;">
                                    <center>
                                        <button class="btn btn-6 btn-6e btn btn-outline-primary" type="submit">
                                            <?php
                                            if ($row1["type"] == 1) {
                                                echo "Super Admin";
                                            } elseif ($row1["type"] == 2) {
                                                echo "User";
                                            } elseif ($row1["type"] == 3) {
                                                echo "Admin";
                                            } elseif ($row1["type"] == 4) {
                                                echo "Freelancer";
                                            } elseif ($row1["type"] == 5) {
                                                echo "Tempuser";
                                            } else {
                                                echo "Error";
                                            }
                                            ?>
                                        </button>
                                         
                                    </center>
                                </div>
                            </form>
                            <?php
                        }
                    } else {
                        echo "Error executing the query for $email";
                    }
                } else {
                    echo "No user found for email: $email";
                }
            }
        } else {
            echo "Login User is not set.";
        }
        ?>

              </div>

            </div>
          </div>
           <!------------End My Role Accounts------------>

          <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">My Account</h5>

              <div class="activity">
                  
                   <?php
                $i = 1;
                $qry = $conn->query("SELECT project_list.id,project_list.name,project_list.rolname,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}' ");
                while($row= $qry->fetch_assoc()){
    
                  ?>

                <div class="activity-item d-flex">
                  <div class="activite-label"><?php echo date("M d, Y",strtotime($row['start_date'])); ?></div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    <?php echo $row['rolname']; ?> To <a href="#" class="fw-bold text-dark"><?php echo $row['clint_name']; ?></a>
                  </div>
                </div>
                <div class="activity-item d-flex">
                  <div class="activite-label"><?php echo date("M d, Y",strtotime($row['end_date'])); ?></div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                </div>
                
                <!-- End activity item-->

                <?php } ?>

              </div>

            </div>
          </div><!-- End Recent Activity -->

         

           <!-- Donut Pie Chart Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">Today</a></li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">This Week</a></li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">This Month</a></li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">This Year</a></li>
              </ul>
            </div>
            <div class="card-body pb-0">
              <h5 class="card-title">Weekly Summery<span>|This Week</span></h5>
                 	<div class="card-body pie-chart">
                         <canvas id="doughnut_chart"  class="echart"></canvas>
                    </div>
            </div>
            <input type="hidden" name="post_id" id="post_id" value="<?php echo $_SESSION['login_id']; ?>"> 
            <script>
	
$(document).ready(function(){
  
	makechart();
	function makechart()
	{
	    var post_id = $('#post_id').val();
	    
		$.ajax({
			url:"homepiechrtdata.php",
			method:"POST",
			data:{action:'fetch', post_id:post_id},
			dataType:"JSON",
			success:function(data)
			{
				var language = [];
				var total = [];
				var color = [];

				for(var count = 0; count < data.length; count++)
				{
					language.push(data[count].language);
					total.push(data[count].total);
					color.push(data[count].color);
				}

				var chart_data = {
					labels:language,
					datasets:[
						{
							label:'Vote',
							backgroundColor:color,
							color:'#fff',
							data:total
						}
					]
				};

				var options = {
					responsive:true,
					scales:{
						yAxes:[{
							ticks:{
								min:0
							}
						}]
					}
				};

				var group_chart1 = $('#pie_chart');

				var graph1 = new Chart(group_chart1, {
					type:"pie",
					data:chart_data
				});

				var group_chart2 = $('#doughnut_chart');

				var graph2 = new Chart(group_chart2, {
					type:"doughnut",
					data:chart_data
				});

				var group_chart3 = $('#bar_chart');

				var graph3 = new Chart(group_chart3, {
					type:'bar',
					data:chart_data,
					options:options
				});
			}
		})
	}

});

</script>
          </div>
          <!-- End Donut Pie Chart Traffic -->

          

        </div><!-- End Right side columns -->

      </div>
    </section>
<?php }elseif($_SESSION['login_type'] == 3){ ?>

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Documents Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Documents</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Total Documents <span class="text-muted small pt-2 ps-1">- </span><span class="text-primary small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents ")->num_rows; ?> </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=adminapproved">Total Approved <span class="text-muted small pt-2 ps-1">- </span><span class="text-success small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =1")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=adminpending">Total Pending <span class="text-muted small pt-2 ps-1">- </span><span class="text-warning small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =0")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=adminreject">Total Reject <span class="text-muted small pt-2 ps-1">- </span><span class="text-danger small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =2")->num_rows; ?>  </span></a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Documents <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-files"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                       date_default_timezone_set("Asia/colombo");
                       $month = date("m");
                       $year = date("Y");
                        $query = $conn->query("
                        SELECT count(*) AS count FROM `documents` WHERE EXTRACT(YEAR FROM date) ='$year' AND EXTRACT(MONTH FROM date)='$month'");
                        foreach($query as $data)
                        {$count= $data['count'];}
                        echo  $count;
                      ?>
                      &nbsp;/&nbsp;
                      <span>0 </span>
                      </h6>
                      
                      <span class="text-success small pt-1 fw-bold">Monthly</span> <span class="text-muted small pt-2 ps-1">Weekly</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
              <div class="col-xxl-4 col-md-6">
                 
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>My Documents</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">My Documents <span class="text-muted small pt-2 ps-1">- </span><span class="text-primary small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents where user_id = {$_SESSION['login_id']} ")->num_rows; ?> </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=myapproved">My Approved <span class="text-muted small pt-2 ps-1">- </span><span class="text-success small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =1 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=mypending">My Pending <span class="text-muted small pt-2 ps-1">- </span><span class="text-warning small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =0 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=myreject">My Reject <span class="text-muted small pt-2 ps-1">- </span><span class="text-danger small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =2 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Documents <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-files"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                       date_default_timezone_set("Asia/colombo");
                       $month = date("m");
                       $year = date("Y");
                        $query = $conn->query("
                        SELECT count(*) AS count FROM `documents` WHERE EXTRACT(YEAR FROM date) ='$year' AND EXTRACT(MONTH FROM date)='$month' AND user_id = {$_SESSION['login_id']}");
                        foreach($query as $data)
                        {$count= $data['count'];}
                        echo  $count;
                      ?>
                      &nbsp;/&nbsp;
                      <span>0</span>
                      </h6>
                      
                      <span class="text-success small pt-1 fw-bold">Monthly</span> <span class="text-muted small pt-2 ps-1">Weekly</span>

                    </div>
                  </div>
                </div>

              </div> 
            </div><!-- End Customers Card -->
             
            

            <!-- Reports -->
            
 <!--  Calender line chart Sales -->
            
        
             <div class="col-lg-12">
                     <div class="card">
                         <div class="card-body">
                                <h5 class="card-title"> Interviews <span>/ Graph </span></h5>
                                    <?php include "calenderinrerview_graph.php"; ?>
                        </div>
                    </div>
            </div>
        <!--  Calender line chart Sales -->
      
            
            
              <!-- Recent Calender -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Export Data</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">
                        <form method="post" action="export.php">
                    <button type="submit" name="export" class="btn btn-success" /><span class="badge bg-success">export</span></button>
                 </form>
                        
                        </a></li>
      
                  </ul>
                </div>

                <div class="card-body">
                   <h5 class="card-title"> Interviews <span>/ Calender </span></h5>
                    <?php include "event_calender.php";?>

                </div>

              </div>
            </div><!-- End Calender Sales -->

                 <!--  Revenue  -->
                  <div class="col-xxl-12 col-md-12">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Revenue</h6>
                    </li>
                        <?php
                $i = 1;
                $year = date("Y");
                $qry = $conn->query("SELECT month as monthname, year, SUM(amount) as amount FROM sale_target WHERE month in ('Sep','Oct','Nov','Dec','Jan','Feb') AND  year='$year' GROUP BY month ORDER BY FIELD(month, 'Sep','Oct','Nov','Dec','Jan','Feb')");
                while($row= $qry->fetch_assoc()){?>

                    <li><a class="dropdown-item" href="#"><?php echo $row['monthname'];?>-<?php echo $row['year'];?><span class="text-muted small pt-2 ps-1">Rs. </span><span class="text-success small pt-1 fw-bold"><?php echo number_format($row['amount'],2);?></span></a></li>
                <?php } ?>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Revenue <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                       date_default_timezone_set("Asia/colombo");
                       $month = date("M");
                       $year = date("Y");
                        $query = $conn->query("
                        SELECT month as monthname, 
                        SUM(amount) as amount 
                        FROM sale_target
                        WHERE month='$month' AND year='$year'
                        GROUP BY month
                        order by id asc");
                        foreach($query as $data)
                        {$amount= $data['amount'];}
                        echo "Rs." . number_format($amount);
                      ?></h6>
                      <!--<span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>-->

                    </div>
                  </div>
                </div>

              </div>
            </div>
                   <!-- Line Chart -->
                       <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div><!-- End Reports -->
                
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-body">
                                <h5 class="card-title">Revenue <span>/Graph </span></h5>
                    
                                  <?php 
                                  date_default_timezone_set("Asia/colombo");
                                   $year = date("Y");
                                  $query = $conn->query("
                                            SELECT month as monthname, 
                                            SUM(amount) as amount 
                                            FROM sale_target
                                          Where (month IN ('Feb','Mar','Apr','May','Jun','Jul') AND `year` = 2025)
                                            
                                            GROUP BY month
                                            ORDER BY FIELD(month, 'Feb','Mar','Apr','May','Jun','Jul')
                                     
                                  ");
                                  
                                  $month= array();
                                  $amount= array();
                                
                                  foreach($query as $data)
                                  {
                                    $month[] = $data['monthname'];
                                    $amount[] = $data['amount'];
                            
                                  }
                                
                                ?>
                      
                   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                   <canvas id="lineChart" style="max-height: 400px;"></canvas>
          
                     
                    <script>
                      // === include 'setup' then 'config' above ===
                     const labels = <?php echo json_encode($month) ?>;
                     const monthtar =[
                         
                           {month:'Feb', amount:'2000000'},
                           {month:'Mar', amount:'2000000'},
                           {month:'Apr', amount:'2000000'},
                           {month:'May', amount:'2000000'},
                           {month:'Jun', amount:'2000000'},
                           {month:'Jul', amount:'2000000'}
                           
                          ];
                    
                          
                    const data = {
                      labels: labels,
                      datasets: [{
                        label: 'Revenue Data',
                        data: <?php echo json_encode($amount) ?>,
                        fill: false,
                          backgroundColor: [
                              'rgba(0,100,0)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(255, 159, 64, 0.2)',
                              'rgba(0, 0, 0, 0.2)'
                            ],
                            borderColor: [
                              'rgba(0,100,0)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)',
                              'rgba(255, 159, 64, 1)',
                              'rgba(0, 0, 0, 1)'
                            ],
                           tension: 0.1
                      },
                      {
                            label: 'Monthly Revenue Target',
                            data: monthtar,
                            tension: 0.1,
                            backgroundColor: 'rgba(255,0,0)',
                            borderColor:'rgba(255,0,0)',
                            parsing:{xAxisKey:'month', yAxisKey:'amount'}
                       
                      }   
                      ]
                    };
                    
                    
                      const config = {
                        type: 'line',
                        data: data,
                        options: {
                          scales: {
                            y: {
                              beginAtZero: true
                            }
                          }
                        },
                      };
                    
                      var lineChart = new Chart(
                        document.getElementById('lineChart'),
                        config
                      );
                    </script>
                     
   
                  
                  <!-- End Line Chart -->

                
                        </div>
                    </div>
                </div><!-- End Reports -->

              </div>
            </div>
            <!-- End Reports -->
        
           
        <!--Sprint Report section -->
                <!-- Sprint Report -->
          <div class=" col-md-12 card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Sprint Report <span>| This Month</span></h5>

                <?php

// Select Query
$sql = "SELECT project_list.id,project_list.name,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}'";
$res = mysqli_query($conn, $sql);

// Create Array  and push your data 
$stack = array();
while ($datarows =mysqli_fetch_array( $res, MYSQLI_ASSOC )) {
  array_push($stack, $datarows);
 
}
// Encode your stack array
$Encoded_JSON_Array = json_encode( $stack );

?>


  <script type="text/javascript" src="https://unpkg.com/vis-timeline@latest/standalone/umd/vis-timeline-graph2d.min.js"></script>
  <link href="https://unpkg.com/vis-timeline@latest/styles/vis-timeline-graph2d.min.css" rel="stylesheet" type="text/css" />
 

<div class="col-md-12" style="min-height: 200px;" id="visualization"></div>

<script type="text/javascript">
  // DOM element where the Timeline will be attached
  var container = document.getElementById('visualization');
// Create a DataSet (allows two way data-binding)
  

// CREATE NEW ARRAY, THEN CARRY ON AND CONVERT THE PHP ARRAY TO A JAVASCRIPT ARRAY
const new_Array = []
var Encoded_JSON_Array = <?php echo $Encoded_JSON_Array ?> ; // CONVERTS TO JS ARRAY

// !IMPORTANT 
// PUSH DATA INTO YOUR NEW ARRAY AS OBJECTS. NOTES! vis.js DATASET MUST HAVE THIS {id: , content: , start: }. THEY ARE CONSTANTS THAT YOU CANT CHANGE IT. 
for (let i = 0; i <Encoded_JSON_Array.length; i++){
  new_Array.push({id: Number(Encoded_JSON_Array[i].id),content: Encoded_JSON_Array[i].clint_name,start: Encoded_JSON_Array[i].start_date, end: Encoded_JSON_Array[i].end_date})
}

// CALL YOUR ARRAY IN DATASET, THEN YOU ARE GOOD TO GO!
var items = new vis.DataSet(new_Array);

  // Configuration for the Timeline
  var options = {};

  // Create a Timeline
  var timeline = new vis.Timeline(container, items, options);
</script>

      
      
      
              

            </div>
          </div>
          <!-- End Sprint Report -->
          
          <!---------------------------------------------------------------------------- Performace Data---------------------------------------------------------------------------------------->
        
        <!-----------------------Recruiter Wise Kpi  Revenu line chart Sales-------------------------------------------------------------------------------------- -->
             <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Revenue Year Wise <span>Recruiter Wise</span></h5>
                  
               
                  <table class="table table-borderless ">
                    <thead>
                      <tr>
                        <th scope="col">Year</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                 $query="SELECT year,SUM(amount) AS total_amount FROM `sale_target` WHERE `user_id` = '{$_SESSION['login_id']}' Group By year;";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["year"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
            <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - This Year Month Wise <span>Recruiter Wise</span></h5>
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        date_default_timezone_set("Asia/colombo");
                       $month = date("M");
                       $year = date("Y");
                 $query="SELECT 
    month,
    SUM(amount) AS total_amount
FROM 
    `sale_target`
WHERE 
    `user_id` = '{$_SESSION['login_id']}' 
    AND YEAR(join_date) = '$year'
GROUP BY 
   month
ORDER BY 
    month";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["month"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
        
              <div class="col-12">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Revenue Per/Month <span>Recruiter Wise</span></h5>
                         <span>Recruiter Wise</span>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Client</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                 $query="SELECT sale_target.id, sale_target.candidate, SUM(sale_target.amount) AS total_amount,sale_target.user_id, sale_target.account_manger, sale_target.join_date, sale_target.status,
            documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name
            FROM `sale_target`
            INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
            INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
            INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
            WHERE 
    sale_target.user_id = '{$_SESSION['login_id']}' 
  
GROUP BY 
    EXTRACT(YEAR FROM sale_target.join_date), EXTRACT(MONTH FROM sale_target.join_date)
ORDER BY 
    sale_target.id ASC; ";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["join_date"].'</td>
                        <td> '.$row["clint_name"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
         <!-----------------------Account Manger Wise Kpi  Revenu line chart Sales-------------------------------------------------------------------------------------- -->
             <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Revenue Year Wise <span>Account Manger Wise</span></h5>
               
                  <table class="table table-borderless ">
                    <thead>
                      <tr>
                        <th scope="col">Year</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                 $query="SELECT year,SUM(amount) AS total_amount FROM `sale_target` WHERE `account_manger` = '{$_SESSION['login_recruiter']}' Group By year;";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["year"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
            <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - This Year Month Wise <span>Account Manger Wise</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        date_default_timezone_set("Asia/colombo");
                       $month = date("M");
                       $year = date("Y");
                 $query="SELECT 
    month,
    SUM(amount) AS total_amount
FROM 
    `sale_target`
WHERE 
    `account_manger` = '{$_SESSION['login_recruiter']}' 
    AND YEAR(join_date) = '$year'
GROUP BY 
   month
ORDER BY 
    month";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["month"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
        
              <div class="col-12">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Revenue Per/Month <span>Account Manger Wise</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Client</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                 $query="SELECT sale_target.id, sale_target.candidate, SUM(sale_target.amount) AS total_amount,sale_target.user_id, sale_target.account_manger, sale_target.join_date, sale_target.status,
            documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name
            FROM `sale_target`
            INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
            INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
            INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
            WHERE 
    sale_target.account_manger = '{$_SESSION['login_recruiter']}' 
  
GROUP BY 
    EXTRACT(YEAR FROM sale_target.join_date), EXTRACT(MONTH FROM sale_target.join_date)
ORDER BY 
    sale_target.id ASC; ";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
   
						
						echo'<tr>
						<td> '.$row["join_date"].'</td>
                        <td> '.$row["clint_name"].'</td>
                        <td>Rs. '. number_format($row['total_amount'], 2).'</td>
                
                      </tr>';
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>    
            
        <!-----------------------End Account Manger Wise Kpi  Revenu line chart Sales-------------------------------------------------------------------------------------- -->
            
        <!------------------------------------------------------------KPI Total Cv----------------------------------------------------------------------------->
        
        <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Cv Sent / This Month</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Cilnet Name</th>
                        <th scope="col">Total Cv's</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                         date_default_timezone_set("Asia/colombo");
                       $month = date("m");
                       $year = date("Y");
                        
                 $query="SELECT 
    clintmanege.clint_name AS client_name,
    COUNT(candidate_summery.id) AS total_feedback_count
FROM 
    candidate_summery 
INNER JOIN 
    documents ON (candidate_summery.application_id = documents.id) 
INNER JOIN 
    clintmanege ON (candidate_summery.clint_id = clintmanege.clint_id) 
INNER JOIN 
    users ON (candidate_summery.user_id = users.id) 
WHERE 
    candidate_summery.user_id = '{$_SESSION['login_id']}' 
    AND candidate_summery.feedback = 'ClientReview' 
    AND MONTH(candidate_summery.date) = '$month' AND YEAR(candidate_summery.date) = '$year'
GROUP BY 
    clintmanege.clint_name
ORDER BY 
    clintmanege.clint_name ASC;";
                 $result = mysqli_query($conn,$query);
                 $total_count = 0;
while($row = mysqli_fetch_array($result)) {
    // Increment the total count by the count for the current row
    $total_count += $row['total_feedback_count'];

    // Output the current row
    echo '<tr>
            <td>'.$row['client_name'].'</td>
            <td>'.$row['total_feedback_count'].'</td>
          </tr>';
}

// Add the total row after iterating through all rows
echo '<tr>
        <td><strong>Total</strong></td>
        <td>'.$total_count.'</td>
      </tr>';
?>
					
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
       <div class="col-6">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">KPI - Total Cv Sent / Previous Month</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Cilnet Name</th>
                        <th scope="col">Total Cv's</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                         date_default_timezone_set("Asia/colombo");
                       $current_month = date("m");
                        $current_year = date("Y");

                        // Calculate the previous month and year
                        $previous_month = date("m", strtotime("-1 month"));

                        
                 $query="SELECT 
    clintmanege.clint_name AS client_name,
    COUNT(candidate_summery.id) AS total_feedback_count
FROM 
    candidate_summery 
INNER JOIN 
    documents ON (candidate_summery.application_id = documents.id) 
INNER JOIN 
    clintmanege ON (candidate_summery.clint_id = clintmanege.clint_id) 
INNER JOIN 
    users ON (candidate_summery.user_id = users.id) 
WHERE 
    candidate_summery.user_id = '{$_SESSION['login_id']}' 
    AND candidate_summery.feedback = 'ClientReview' 
    AND MONTH(candidate_summery.date) = '$previous_month' AND YEAR(candidate_summery.date) = '$year'
GROUP BY 
    clintmanege.clint_name
ORDER BY 
    clintmanege.clint_name ASC;";
    
    $result = mysqli_query($conn, $query);
$total_count = 0;

while ($row = mysqli_fetch_array($result)) {
    // Increment the total count by the count for the current row
    $total_count += $row['total_feedback_count'];

    // Output the current row
    echo '<tr>
            <td>' . $row['client_name'] . '</td>
            <td>' . $row['total_feedback_count'] . '</td>
          </tr>';
}

// Add the total row after iterating through all rows
echo '<tr>
        <td><strong>Total</strong></td>
        <td>' . $total_count . '</td>
      </tr>';
?>
					
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>     
        
         <div class="col-lg-12">
                     <div class="card">
                         <div class="card-body">
                                <h5 class="card-title"> KPI - Total Cv Sent <span>/ Month </span></h5>
                                    <?php include "kpi_totalmonth_graph.php"; ?>
                        </div>
                    </div>
            </div>
        
        
        <!--------------------------------------------------------------KPi END Total CV---------------------------------------------------------------------------->
 <!----------------------------------------------------------------------------END Performace Data---------------------------------------------------------------------------------------->           
         <!---------------------- Data Existing Checker---------------------------------->
        <div class="col-12">
              <div class="card recent-sales overflow-auto">
              
                  <div class="card-body">
                    <h5 class="card-title"> Data Existing Checker</h5>
                                  <form method="POST" class="row g-3">
  <div class="col-md-4">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" >
  </div>
  <div class="col-md-4">
    <label for="phone" class="form-label">Phone Number</label>
    <input type="text" name="phone" class="form-control" >
     <div class="form-text">Enter the last 6 digits of mobile number.</div>
  </div>
  <div class="col-md-4 align-self-end">
    <button type="submit" name="check_data" class="btn btn-primary">Check Data</button>
  </div>
</form>
<?php
if (isset($_POST['check_data'])) {
    $conditions = [];
    
    if (!empty($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $conditions[] = "email = '$email'";
    }

    if (!empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $last6 = substr($phone, -6);
        $conditions[] = "phonenumber LIKE '%$last6'";
    }

    if (!empty($conditions)) {
        $whereClause = implode(" OR ", $conditions);
        $query = "SELECT `recruiter`, `ref_no`, `phonenumber`, `email`, `date_created`, `id` 
                  FROM documents 
                  WHERE $whereClause";
        
        $result = mysqli_query($conn, $query);

        echo '<div class="mt-4">';
        if (mysqli_num_rows($result) > 0) {
            echo '<h5 class="card-title">Matching Records</h5>';
            echo '<table class="table table-bordered">';
            echo '<thead><tr><th>Ref No</th><th>Email</th><th>Phone</th><th>Recruiter</th><th>Upload Date</th></tr></thead><tbody>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                $refFormatted = $row['ref_no'] <= 99 
                                ? str_replace(' ','', $row['recruiter']."00".$row['ref_no']) 
                                : str_replace(' ','', $row['recruiter']."0".$row['ref_no']);
                
                echo "<tr>
                        <td><a target='_blank' href='./index2.php?page=view_documentz&id={$row['id']}'>#{$refFormatted}</a></td>
                        <td>{$row['email']}</td>
                        <td>{$row['phonenumber']}</td>
                        <td>{$row['recruiter']}</td>
                        <td><span class='badge bg-success'>{$row['date_created']}</span></td>
                      </tr>";
            }

            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-success" role="alert">No data found</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Please enter at least Email or Phone Number.</div>';
    }
}
?>

                </div>

              </div>
            </div>    
            
            

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Export Data</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">
                        <form method="post" action="export.php">
                    <button type="submit" name="export" class="btn btn-success" /><span class="badge bg-success">export</span></button>
                 </form>
                        
                        </a></li>
      
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Duplicate Datasets List</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Recruiter</th>
                        <th scope="col">Date/Time</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                 $query="SELECT `recruiter`,`ref_no`,`phonenumber`,`email`,`date_created`, MIN(`id`) AS ID
                            FROM documents
                            GROUP BY `phonenumber`,`email`
                            HAVING COUNT(email) > 1";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
                     if($row['ref_no'] <= 99){
						$recq=$row['recruiter'];
						$reqanswr=$recq."00".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}else{
						 $recq=$row['recruiter'];
						$reqanswr=$recq."0".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}
				// 			echo'<tr>
    //                     <th scope="row"><a target="_blank" href="./index2.php?page=view_documentz&id='.$row["ID"].'" style="color:#0d6efd;">#'.$string.'</a></th>
    //                     <td> 0'.$row["phonenumber"].'</td>
    //                     <td><a target="_blank" href="./index2.php?page=view_documentz&id='.$row["ID"].'" class="text-primary"> '.$row["email"].'</a></td>
    //                     <td>'. $row["recruiter"].'</td>
    //                     <td><span class="badge bg-success">'. $row["date_created"].'</span></td>
    //                   </tr>';
                 }
						?>
                     
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
              <!--------------------Lkcareers Login------------------->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Application Tracking System</h5>

                         <div class="activity">
                             <div class="alert alert-primary alert-dismissible fade show "  style="text-align:center;" role="alert">
                                 <i class="bi bi-card-checklist"></i> Reports
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                     
                                    <a href="./index2.php?page=saledashtest" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">View</a>

                                 </div>
                             </div>
                            </div>
                     </div>
                </div>
                   <!--------------------MY Ats------------------->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Candidate ATS</h5>

                         <div class="activity">
                             <div class="alert alert-primary alert-dismissible fade show "  style="text-align:center;" role="alert">
                                 <i class="bi bi-card-checklist"></i> Reports
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                     
                                    <a href="./index2.php?page=ats_saledash_data" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">View</a>

                                 </div>
                             </div>
                            </div>
                     </div>
                </div>
        <!--------------------Lkcareers Login------------------->
            <!--------------------Rooster Login------------------->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rooster Portal </h5>

                         <div class="activity">
                             <div class="alert alert-primary alert-dismissible fade show "  style="text-align:center;" role="alert">
                                 <i class="bi bi-card-checklist"></i> Panel
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                     
                                    <a href="https://app.rooster.org/dashboard" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">Login</a>

                                 </div>
                             </div>
                            </div>
                     </div>
                </div>
        <!--------------------Rooster Login------------------->
             <!--------------------Lkcareers Login------------------->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lkcareers <span>| Admin panel</span></h5>

                         <div class="activity">
                             <div class="alert alert-primary alert-dismissible fade show " role="alert">
                                 <i class="bi bi-link-45deg"></i> Lkcareers Admin panel
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                     
                                    <a href="https://lkcareers.lk/LKAdmin" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">Login</a>

                                 </div>
                             </div>
                            </div>
                     </div>
                </div>
        <!--------------------Lkcareers Login------------------->
     <!------------My Role Accounts------------>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">My Login Role <span>| Accounts</span></h5>

              <div class="activity">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <i class="bi bi-folder me-1"></i> Can Switch Your Accounts From Here
                
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
                  
                <?php
        if (isset($_SESSION['login_email'])) {
            $selectedEmails = $_SESSION['login_email'];
            $emails = explode(',', $selectedEmails);

            foreach ($emails as $email) {
                $email = trim($email);

                $query = "SELECT * FROM `users` WHERE `email` = '$email'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    
                    $query1 = "SELECT email, password, type FROM `users` WHERE `email` = '$email'";
                    $result1 = mysqli_query($conn, $query1);

                    if ($result1 && mysqli_num_rows($result1) > 0) {
                        while ($row1 = mysqli_fetch_array($result1)) {
                            ?>
                            <form class="flex-c login-form">
                                <div class="input-box">
                                    <div class="flex-r input">
                                        <input type="hidden" name="email" value="<?php echo $row1["email"]; ?>">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>

                                <div class="input-box">
                                    <div class="flex-r input">
                                        <input type="hidden" name="password" value="<?php echo $row1["password"]; ?>">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>

                                <div style="padding:3px;">
                                    <center>
                                        <button class="btn btn-6 btn-6e btn btn-outline-primary" type="submit">
                                            <?php
                                            if ($row1["type"] == 1) {
                                                echo "Super Admin";
                                            } elseif ($row1["type"] == 2) {
                                                echo "User";
                                            } elseif ($row1["type"] == 3) {
                                                echo "Admin";
                                            } elseif ($row1["type"] == 4) {
                                                echo "Freelancer";
                                            } elseif ($row1["type"] == 5) {
                                                echo "Tempuser";
                                            } else {
                                                echo "Error";
                                            }
                                            ?>
                                        </button>
                                         
                                    </center>
                                </div>
                            </form>
                            <?php
                        }
                    } else {
                        echo "Error executing the query for $email";
                    }
                } else {
                    echo "No user found for email: $email";
                }
            }
        } else {
            echo "Login User is not set.";
        }
        ?>

              </div>

            </div>
          </div>
           <!------------End My Role Accounts------------>
          <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">My Account</h5>

              <div class="activity">
                  
                   <?php
                $i = 1;
                $qry = $conn->query("SELECT project_list.id,project_list.name,project_list.rolname,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}' ");
                while($row= $qry->fetch_assoc()){
    
                  ?>

                <div class="activity-item d-flex">
                  <div class="activite-label"><?php echo date("M d, Y",strtotime($row['start_date'])); ?></div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    <?php echo $row['rolname']; ?> To <a href="#" class="fw-bold text-dark"><?php echo $row['clint_name']; ?></a>
                  </div>
                </div>
                <div class="activity-item d-flex">
                  <div class="activite-label"><?php echo date("M d, Y",strtotime($row['end_date'])); ?></div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                </div>
                
                <!-- End activity item-->

                <?php } ?>

              </div>

            </div>
          </div><!-- End Recent Activity -->

          

          <!-- Donut Pie Chart Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">Today</a></li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">This Week</a></li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">This Month</a></li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">This Year</a></li>
              </ul>
            </div>
            <div class="card-body pb-0">
              <h5 class="card-title">Weekly Summary<span> |This Week</span></h5>
                 	<div class="card-body pie-chart">
                         <canvas id="doughnut_chart"  class="echart"></canvas>
                    </div>
            </div>
            <input type="hidden" name="post_id" id="post_id" value="<?php echo $_SESSION['login_id']; ?>"> 
            <script>
	
$(document).ready(function(){
   
	makechart();
	function makechart()
	{
	    var post_id = $('#post_id').val();
	    
		$.ajax({
			url:"homepiechrtdata.php",
			method:"POST",
			data:{action:'fetch', post_id:post_id},
			dataType:"JSON",
			success:function(data)
			{
				var language = [];
				var total = [];
				var color = [];

				for(var count = 0; count < data.length; count++)
				{
					language.push(data[count].language);
					total.push(data[count].total);
					color.push(data[count].color);
				}

				var chart_data = {
					labels:language,
					datasets:[
						{
							label:'Count',
							backgroundColor:color,
							color:'#fff',
							data:total
						}
					]
				};

				var options = {
					responsive:true,
					scales:{
						yAxes:[{
							ticks:{
								min:0
							}
						}]
					}
				};

				var group_chart1 = $('#pie_chart');

				var graph1 = new Chart(group_chart1, {
					type:"pie",
					data:chart_data
				});

				var group_chart2 = $('#doughnut_chart');

				var graph2 = new Chart(group_chart2, {
					type:"doughnut",
					data:chart_data
				});

				var group_chart3 = $('#bar_chart');

				var graph3 = new Chart(group_chart3, {
					type:'bar',
					data:chart_data,
					options:options
				});
			}
		})
	}

});

</script>
          </div>
          <!-- End Donut Pie Chart Traffic -->

          

        </div><!-- End Right side columns -->

      </div>
    </section>

<!-- --------------------------------------------------------------End  Admin Dashboard ------------------------------------------------------------------------> 
<?php }else{ ?>

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

     

            <!-- Customers Card -->
              <div class="col-xxl-5 col-md-5">
                 
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>My Documents</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">My Documents <span class="text-muted small pt-2 ps-1">- </span><span class="text-primary small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents where user_id = {$_SESSION['login_id']} ")->num_rows; ?> </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=myapproved">My Approved <span class="text-muted small pt-2 ps-1">- </span><span class="text-success small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =1 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=mypending">My Pending <span class="text-muted small pt-2 ps-1">- </span><span class="text-warning small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =0 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=myreject">My Reject <span class="text-muted small pt-2 ps-1">- </span><span class="text-danger small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =2 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Documents <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-files"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                       date_default_timezone_set("Asia/colombo");
                       $month = date("m");
                       $year = date("Y");
                        $query = $conn->query("
                            SELECT count(*) AS count FROM `documents` WHERE EXTRACT(YEAR FROM date) ='$year' AND EXTRACT(MONTH FROM date)='$month' AND user_id = {$_SESSION['login_id']}
                        ");
                        
                        // Check if the query was successful
                        if ($query) {
                            // Fetch the results as an associative array
                           $data = $query->fetch_assoc();
                        
                            // Check if any rows were returned
                            if ($data) {
                                $count = $data['count'];
                                echo $count;
                            } else {
                                echo "No rows found";
                            }
                        } else {
                            // Handle query error
                            echo "Error executing the query";
                        }

                      ?>
                      &nbsp;/&nbsp;
                      <span>0 </span>
                      </h6>
                      
                      <span class="text-success small pt-1 fw-bold">Monthly</span> <span class="text-muted small pt-2 ps-1">Weekly</span>

                    </div>
                  </div>
                </div>

              </div> 
            
            </div>
            <!-- End Customers Card -->
            
            <!-- Customers Card -->
              <div class="col-xxl-7 col-md-7">
                 
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>My Pending Documents</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">My Documents <span class="text-muted small pt-2 ps-1">- </span><span class="text-primary small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents where user_id = {$_SESSION['login_id']} ")->num_rows; ?> </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=myapproved">My Approved <span class="text-muted small pt-2 ps-1">- </span><span class="text-success small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =1 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=mypending">My Pending <span class="text-muted small pt-2 ps-1">- </span><span class="text-warning small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =0 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                    <li><a class="dropdown-item" href="./index.php?page=myreject">My Reject <span class="text-muted small pt-2 ps-1">- </span><span class="text-danger small pt-1 fw-bold"><?php echo $conn->query("SELECT * FROM documents  where status =2 AND user_id = {$_SESSION['login_id']}")->num_rows; ?>  </span></a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">My Pending Documents <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-files"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                       date_default_timezone_set("Asia/colombo");
                       $month = date("m");
                       $year = date("Y");
                        $query = $conn->query("
                            SELECT count(*) AS count FROM `documents` WHERE status =0 AND EXTRACT(YEAR FROM date) ='$year' AND EXTRACT(MONTH FROM date)='$month' AND user_id = {$_SESSION['login_id']}
                        ");
                        
                        // Check if the query was successful
                        if ($query) {
                            // Fetch the results as an associative array
                           $data = $query->fetch_assoc();
                        
                            // Check if any rows were returned
                            if ($data) {
                                $count = $data['count'];
                                echo $count;
                            } else {
                                echo "No rows found";
                            }
                        } else {
                            // Handle query error
                            echo "Error executing the query";
                        }

                      ?>
                      </h6>
                      
                     

                    </div>
                  </div>
                </div>

              </div> 
            
            </div>
            <!-- End Customers Card -->
            <!---------------------- Data Existing Checker---------------------------------->
        <div class="col-md-12">
              <div class="card recent-sales overflow-auto">
              
                  <div class="card-body">
                    <h5 class="card-title"> Data Existing Checker</h5>
                                  <form method="POST" class="row g-3">
  <div class="col-md-4">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" >
  </div>
  <div class="col-md-4">
    <label for="phone" class="form-label">Phone Number</label>
    <input type="text" name="phone" class="form-control" >
     <div class="form-text">Enter the last 6 digits of mobile number.</div>
  </div>
  <div class="col-md-4 d-flex align-items-center ">
    <button type="submit" name="check_data" class="col-md-8 btn btn-primary">Check Data</button>
  </div>
</form>
<?php
if (isset($_POST['check_data'])) {
    $conditions = [];
    
    if (!empty($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $conditions[] = "email = '$email'";
    }

    if (!empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $last6 = substr($phone, -6);
        $conditions[] = "phonenumber LIKE '%$last6'";
    }

    if (!empty($conditions)) {
        $whereClause = implode(" OR ", $conditions);
        $query = "SELECT `recruiter`, `ref_no`, `phonenumber`, `email`, `date_created`, `id` 
                  FROM documents 
                  WHERE $whereClause";
        
        $result = mysqli_query($conn, $query);

        echo '<div class="mt-4">';
        if (mysqli_num_rows($result) > 0) {
            echo '<h5 class="card-title">Matching Records</h5>';
            echo '<table class="table table-bordered">';
            echo '<thead><tr><th>Ref No</th><th>Email</th><th>Phone</th><th>Recruiter</th><th>Upload Date</th></tr></thead><tbody>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                $refFormatted = $row['ref_no'] <= 99 
                                ? str_replace(' ','', $row['recruiter']."00".$row['ref_no']) 
                                : str_replace(' ','', $row['recruiter']."0".$row['ref_no']);
                
                echo "<tr>
                        <td><a target='_blank' href='./index2.php?page=view_documentz&id={$row['id']}'>#{$refFormatted}</a></td>
                        <td>{$row['email']}</td>
                        <td>{$row['phonenumber']}</td>
                        <td>{$row['recruiter']}</td>
                        <td><span class='badge bg-success'>{$row['date_created']}</span></td>
                      </tr>";
            }

            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-success" role="alert">No data found</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Please enter at least Email or Phone Number.</div>';
    }
}
?>

                </div>

              </div>
            </div>    
            
            

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
               <!--------------------MY Ats------------------->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Candidate ATS</h5>

                         <div class="activity">
                             <div class="alert alert-primary alert-dismissible fade show "  style="text-align:center;" role="alert">
                                 <i class="bi bi-card-checklist"></i> Reports
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                     
                                    <a href="./index2.php?page=ats_saledash_data" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">View</a>

                                 </div>
                             </div>
                            </div>
                     </div>
                </div>
             <!--------------------Lkcareers Login------------------->
                <!--<div class="card">-->
                <!--    <div class="card-body">-->
                <!--        <h5 class="card-title">Lkcareers <span>| Admin panel</span></h5>-->

                <!--         <div class="activity">-->
                <!--             <div class="alert alert-primary alert-dismissible fade show " role="alert">-->
                <!--                 <i class="bi bi-link-45deg"></i> Lkcareers Admin panel-->
                <!--                 <div class="d-grid gap-2 col-6 mx-auto">-->
                                     
                <!--                    <a href="https://lkcareers.lk/LKAdmin" target= "_blank" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;text-align:center;">Login</a>-->

                <!--                 </div>-->
                <!--             </div>-->
                <!--            </div>-->
                <!--     </div>-->
                <!--</div>-->
        <!--------------------Lkcareers Login------------------->
       
     <!------------My Role Accounts------------>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">My Login Role <span>| Accounts</span></h5>

              <div class="activity">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <i class="bi bi-folder me-1"></i> Can Switch Your Accounts From Here
                
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
                  
                <?php
        if (isset($_SESSION['login_email'])) {
            $selectedEmails = $_SESSION['login_email'];
            $emails = explode(',', $selectedEmails);

            foreach ($emails as $email) {
                $email = trim($email);

                $query = "SELECT * FROM `users` WHERE `email` = '$email'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    
                    $query1 = "SELECT email, password, type FROM `users` WHERE `email` = '$email'";
                    $result1 = mysqli_query($conn, $query1);

                    if ($result1 && mysqli_num_rows($result1) > 0) {
                        while ($row1 = mysqli_fetch_array($result1)) {
                            ?>
                            <form class="flex-c login-form">
                                <div class="input-box">
                                    <div class="flex-r input">
                                        <input type="hidden" name="email" value="<?php echo $row1["email"]; ?>">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>

                                <div class="input-box">
                                    <div class="flex-r input">
                                        <input type="hidden" name="password" value="<?php echo $row1["password"]; ?>">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>

                                <div style="padding:3px;">
                                    <center>
                                        <button class="btn btn-6 btn-6e btn btn-outline-primary" type="submit">
                                            <?php
                                            if ($row1["type"] == 1) {
                                                echo "Super Admin";
                                            } elseif ($row1["type"] == 2) {
                                                echo "User";
                                            } elseif ($row1["type"] == 3) {
                                                echo "Admin";
                                            } elseif ($row1["type"] == 4) {
                                                echo "Freelancer";
                                            } elseif ($row1["type"] == 5) {
                                                echo "Tempuser";
                                            } else {
                                                echo "Error";
                                            }
                                            ?>
                                        </button>
                                         
                                    </center>
                                </div>
                            </form>
                            <?php
                        }
                    } else {
                        echo "Error executing the query for $email";
                    }
                } else {
                    echo "No user found for email: $email";
                }
            }
        } else {
            echo "Login User is not set.";
        }
        ?>

              </div>

            </div>
          </div>
           <!------------End My Role Accounts------------>
          <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">My Account</h5>

              <div class="activity">
                  
                   <?php
                $i = 1;
                $qry = $conn->query("SELECT project_list.id,project_list.name,project_list.rolname,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}' ");
                while($row= $qry->fetch_assoc()){
    
                  ?>

                <div class="activity-item d-flex">
                  <div class="activite-label"><?php echo date("M d, Y",strtotime($row['start_date'])); ?></div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    <?php echo $row['rolname']; ?> To <a href="#" class="fw-bold text-dark"><?php echo $row['clint_name']; ?></a>
                  </div>
                </div>
                <div class="activity-item d-flex">
                  <div class="activite-label"><?php echo date("M d, Y",strtotime($row['end_date'])); ?></div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                </div>
                
                <!-- End activity item-->

                <?php } ?>

              </div>

            </div>
          </div><!-- End Recent Activity -->

          <!-- Sprint Report -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Sprint Report <span>| This Month</span></h5>

                <?php

// Select Query
$sql = "SELECT project_list.id,project_list.name,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id) 
                                            WHERE project_list.name='{$_SESSION['login_id']}'";
$res = mysqli_query($conn, $sql);

// Create Array  and push your data 
$stack = array();
while ($datarows =mysqli_fetch_array( $res, MYSQLI_ASSOC )) {
  array_push($stack, $datarows);
 
}
// Encode your stack array
$Encoded_JSON_Array = json_encode( $stack );

?>


  <script type="text/javascript" src="https://unpkg.com/vis-timeline@latest/standalone/umd/vis-timeline-graph2d.min.js"></script>
  <link href="https://unpkg.com/vis-timeline@latest/styles/vis-timeline-graph2d.min.css" rel="stylesheet" type="text/css" />
 

<div class="col-md-12" style="min-height: 200px;" id="visualization"></div>

<script type="text/javascript">
  // DOM element where the Timeline will be attached
  var container = document.getElementById('visualization');
// Create a DataSet (allows two way data-binding)
  

// CREATE NEW ARRAY, THEN CARRY ON AND CONVERT THE PHP ARRAY TO A JAVASCRIPT ARRAY
const new_Array = []
var Encoded_JSON_Array = <?php echo $Encoded_JSON_Array ?> ; // CONVERTS TO JS ARRAY

// !IMPORTANT 
// PUSH DATA INTO YOUR NEW ARRAY AS OBJECTS. NOTES! vis.js DATASET MUST HAVE THIS {id: , content: , start: }. THEY ARE CONSTANTS THAT YOU CANT CHANGE IT. 
for (let i = 0; i <Encoded_JSON_Array.length; i++){
  new_Array.push({id: Number(Encoded_JSON_Array[i].id),content: Encoded_JSON_Array[i].clint_name,start: Encoded_JSON_Array[i].start_date, end: Encoded_JSON_Array[i].end_date})
}

// CALL YOUR ARRAY IN DATASET, THEN YOU ARE GOOD TO GO!
var items = new vis.DataSet(new_Array);

  // Configuration for the Timeline
  var options = {};

  // Create a Timeline
  var timeline = new vis.Timeline(container, items, options);
</script>

      
      
      
              

            </div>
          </div><!-- End Sprint Report -->

           <!-- Donut Pie Chart Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">Today</a></li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">This Week</a></li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">This Month</a></li>
                <li><a class="dropdown-item" href="./index2.php?page=candidate_summerychart">This Year</a></li>
              </ul>
            </div>
            <div class="card-body pb-0">
              <h5 class="card-title">Weekly Summary<span> |This Week</span></h5>
                 	<div class="card-body pie-chart">
                         <canvas id="doughnut_chart"  class="echart"></canvas>
                    </div>
            </div>
            <input type="hidden" name="post_id" id="post_id" value="<?php echo $_SESSION['login_id']; ?>"> 
            <script>
	
$(document).ready(function(){
  
	makechart();
	function makechart()
	{
	    var post_id = $('#post_id').val();
	    
		$.ajax({
			url:"homepiechrtdata.php",
			method:"POST",
			data:{action:'fetch', post_id:post_id},
			dataType:"JSON",
			success:function(data)
			{
				var language = [];
				var total = [];
				var color = [];

				for(var count = 0; count < data.length; count++)
				{
					language.push(data[count].language);
					total.push(data[count].total);
					color.push(data[count].color);
				}

				var chart_data = {
					labels:language,
					datasets:[
						{
							label:'Count',
							backgroundColor:color,
							color:'#fff',
							data:total
						}
					]
				};

				var options = {
					responsive:true,
					scales:{
						yAxes:[{
							ticks:{
								min:0
							}
						}]
					}
				};

				var group_chart1 = $('#pie_chart');

				var graph1 = new Chart(group_chart1, {
					type:"pie",
					data:chart_data
				});

				var group_chart2 = $('#doughnut_chart');

				var graph2 = new Chart(group_chart2, {
					type:"doughnut",
					data:chart_data
				});

				var group_chart3 = $('#bar_chart');

				var graph3 = new Chart(group_chart3, {
					type:'bar',
					data:chart_data,
					options:options
				});
			}
		})
	}

});

</script>
          </div>
          <!-- End Donut Pie Chart Traffic -->

          

        </div><!-- End Right side columns -->

      </div>
    </section>

<?php } ?>