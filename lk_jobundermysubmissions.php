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

<main>
  <div class="pagetitle">
      <h1>All CV's Under My Job Ref_No</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Resume</li>
          <li class="breadcrumb-item active">All Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

 <div class="col-sm-12">
              <div class="card recent-sales overflow-auto">

          
                
                    <div class="card-header">
		    <div class="row">
		        <div class="col-2" style="flex: 0 0 11.666667%;"> <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button></div>
		        <div class="col-2">
		      
		        </div>
		       
		    </div>
		   
			
		</div>

                <div class="card-body">
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jb-Ref.No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Dead Line</th>
                         <th scope="col">Date & Time</th>
                         <?php if($_SESSION['login_type']==1){ ?>
                        <th scope="col">Action</th>
                        <?php } ?>
                        
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                         include "lkcareers_con.php";
                        $i=1;
                 $query="SELECT cv_documation.id,cv_documation.first_name,cv_documation.last_name,cv_documation.phone_number,cv_documation.resume_path, cv_documation.job_idselect,cv_documation.date
     
            FROM cv_documation
            WHERE cv_documation.userid= '{$_SESSION['login_id']}' 
            ORDER BY cv_documation.id DESC;
            ";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
                    $resumePath = $row["resume_path"];
					$fileName = str_replace('C:Inetpubvhostslkcareers.lkhttpdocs/cvfiles/', '', $resumePath);
					$selids = $row["job_idselect"]; 
					  include 'db_connect.php';
					 $query2 = "SELECT jb_ref,jb_title,deadline FROM job_management WHERE id = $selids";
   					 $result2 = mysqli_query($conn, $query2);
                 while($row1 = mysqli_fetch_array($result2))  
                 {
					 		 $jb_ref   = $row1["jb_ref"];
							 $jb_title = $row1["jb_title"];
							 $deadline = $row1["deadline"];
				 }

                    ?>
					<tr>
						<th scope="row"><?php echo $i++; ?></th>
						 <?php
                        if($_SESSION['login_type']==1){
                        ?>
                        <td><a target= "_blank" href="./index2.php?page=saledataview&id=<?php echo $row["id"]; ?>"><?php  echo $jb_ref; ?></a></td>
                        <?php }else{ ?>
                        <td><a target= "_blank" href="./index2.php?page=saledataview&id=<?php echo $row["id"]; ?>"><?php  echo $jb_ref; ?></a></td>
                        <?php } ?>
                        <td><a target= "_blank" href="./index2.php?page=lk_cv_view&id=<?php echo $row["id"]; ?>"><?php echo $row["first_name"]; ?> <?php echo $row["last_name"]; ?></a></td>
                        <td><?php echo $jb_title; ?></td>
                        <td><?php echo $row["phone_number"]; ?></td>
                        <td><span class="badge bg-success"><?php echo $deadline; ?></span></td>
                         <td><?php echo $row["date"]; ?></td>
                        <?php
                        if($_SESSION['login_type']==1){
                        ?>
                        <td>
                            <!--<a target= "_blank" href="./index2.php?page=jobmangement_view&id=<?php echo $row["id"]; ?>"><span class="badge bg-secondary"><i class="bi bi-eye"></i></span></a>-->
                            <!--<a target= "_blank" href="./index2.php?page=jobmangement_edit&id=<?php echo $row["id"]; ?>"><span class="badge bg-primary"><i class="bi bi-slash-square"></i></span></a>-->
                            <a onclick="return confirm('Are You Sure Want To Delete This Record!'); " href="deletemvcv.php?d_id=<?php echo $row["id"]; ?>" ><span class="badge bg-danger"><i class="bi bi-trash"></i> </span></a>
                            <a target= "_blank" href="../cvfiles/<?php echo $fileName; ?>"><span class="badge bg-info"><i class="bi bi-download"></i> </span></a>
                        </td>
                      </tr>
                      <?php
                 }
                     
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
</main>