<main>
    <?php 
    session_start();
    
    if(isset($_SESSION['status']))
    {
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            	Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Data successfully deleted',
                      showConfirmButton: false,
                      timer: 1500
                    })
            </script>
        <?php 
        unset($_SESSION['status']);
    }

?>


  <div class="pagetitle">
      <h1>Job Management</h1>
<?php
include 'db_connect.php';
include 'lkcareers_con.php';

$query1 = "SELECT `id`, `first_name`, `last_name`, `phone_number`, `email`, `resume_path`, `job_idselect` FROM `cv_documation`";
$result1 = mysqli_query($con, $query1);

if (!$result1) {
    die("Query 1 failed: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($result1)) {
    $jbid = $row["job_idselect"];

    $query2 = "SELECT job_management.id, job_management.jb_ref, job_management.jb_title, job_management.user_id FROM job_management
               ";
    $result2 = mysqli_query($conn, $query2);

    if (!$result2) {
        die("Query 2 failed: " . mysqli_error($conn));
    }

    while ($row2 = mysqli_fetch_array($result2)) {
        $jbidred = $row2["jb_ref"];
        $jbuserif = $row2["user_id"];
        $jbtitle = $row2["jb_title"];

 
    }
}

?>

      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Job Management</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

 <div class="col-sm-12">
              <div class="card recent-sales overflow-auto">

                <!--<div class="filter justify-content-end">-->
                <!--  <a class="icon d-flex justify-content-end" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>-->
                <!--  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">-->
                <!--    <li class="dropdown-header text-start">-->
                <!--      <h6>Export Data</h6>-->
                <!--    </li>-->

                <!--    <li><a class="dropdown-item" href="#">-->
                <!--        <form method="post" action="jobmangement_myjobexport.php">-->
                <!--        <input type="hidden" name="id" value="<?php echo $_SESSION['login_id']; ?>">    -->
                <!--    <button type="submit" name="export" class="btn btn-success" /><span class="badge bg-success">export</span></button>-->
                <!-- </form>-->
                        
                <!--        </a></li>-->
      
                <!--  </ul>-->
                <!--</div>-->
        <div class="card-header">
		
		   
			
		</div>

                <div class="card-body">
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Jb-Ref.No</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                 $query="SELECT `id`, `first_name`, `last_name`, `phone_number`, `email`, `resume_path`, `job_idselect`,userid  FROM `cv_documation`
                             ";
                 $result = mysqli_query($con,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
                    
               
                    ?>
						<tr>
						<th scope="row"><?php echo $i++; ?></th>
                        <td><a target= "_blank" href="./index2.php?page=resubmioncv&rsubid=<?php echo $row["id"]; ?>"><?php  echo$row["first_name"]; ?> <?php  echo$row["last_name"]; ?></a></td>
                        <td><a target= "_blank" href="./index2.php?page=jobmangement_view&id=<?php echo $jbid; ?>"><?php echo $jbidred; ?></a></td>
                        <td><?php echo $jbtitle; ?></td>
                        <td><?php echo $row["phone_number"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                 
                          
                        <td><a target= "_blank" href="./index2.php?page=jobmangement_view&id=<?php echo $row["id"]; ?>"><span class="badge bg-secondary"><i class="bi bi-eye"></i></span></a>
                    
                            <a href="#?d_id=<?php echo $row["id"]; ?>"  onclick="return confirm('Are You Sure Want To Delete This Record!'); "><span class="badge bg-danger"><i class="bi bi-trash"></i> </span></a>
                           
                        </td>
                      </tr>
                      <?php
                 
                     
                 }
						?>
                      
                      
  
                     
                    </tbody>
                  </table>
             
                </div>

              </div>
            </div>
            
</main>