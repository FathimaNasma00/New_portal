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
                title: '<?php echo $_SESSION['status']; ?>',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                location.reload(); // Refresh the page
            });
        </script>
        <?php 
        unset($_SESSION['status']);
    }

?>

<main>
  <div class="pagetitle">
      <h1>Job Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Job Management</li>
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
		          <form method="post" action="jobmangement_export.php">
                    <button type="submit" name="export" class="btn btn-success" style="left:0px;" value="Export" />Export&nbsp;<i class="fas fa-file-export"></i></button>
                    </form>
		        </div>
		       
		    </div>
		   
			
		</div>

                <div class="card-body">
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jb-Ref.No</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Job Type</th>
                        <th scope="col">Job Open Date</th>
                        <th scope="col">Client</th>
                        <th scope="col">Working Type</th>
                        <th scope="col">Min Salary</th>
                        <th scope="col">Max Salary</th>
                        <th scope="col">Recruiter</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Status</th>
                         <?php if($_SESSION['login_type']==1){ ?>
                        <th scope="col">Action</th>
                        <?php } ?>
                        
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                 $query="SELECT job_management.id, job_management.jb_ref, job_management.jb_title, job_management.jb_type, job_management.jb_date, job_management.jb_workingtype,job_management.min_sal,job_management.max_sal,
       job_management.status, job_management.deadline, CONCAT(users.firstname, ', ', users.middlename, ' ', users.lastname) AS name,
       clintmanege.clint_name
            FROM job_management
            INNER JOIN users ON (job_management.jb_recuiters = users.id)
            INNER JOIN clintmanege ON (job_management.jb_client = clintmanege.clint_id)
            WHERE job_management.id IN (
                SELECT MAX(id)
                FROM job_management
                GROUP BY jb_ref
            )
            ORDER BY job_management.id DESC;
            ";
                 $result = mysqli_query($conn,$query);
                 while($row = mysqli_fetch_array($result))  
                 { 
                    
                      if($row["jb_type"]== "NW"){
                       $jb_type='New';
                      }elseif($row["jb_type"] == "RO"){
                      $jb_type='Re-open';
                      }elseif($row["jb_type"] == "Closed"){
                      $jb_type='Closed';
                      }
                      
                    ?>
					<tr>
						<th scope="row"><?php echo $i++; ?></th>
						<td><a target="_blank" href="<?php 
                                if ($row["status"] == 1) {
                                    echo "./index2.php?page=saledataview&id=" . $row["id"];
                                } else {
                                    echo "./index2.php?page=saledatainactiveview&id=" . $row["id"];
                                }
                            ?>"><?php echo $row["jb_ref"]; ?></a></td>

						 <?php
                        if($_SESSION['login_type']==1){
                        ?>
                        <td><a target= "_blank" href="./index2.php?page=jobmangement_edit&id=<?php echo $row["id"]; ?>"><?php  echo$row["jb_title"]; ?></a></td>
                        <?php }else{ ?>
                        <td><a target= "_blank" href="./index2.php?page=jobmangement_view&id=<?php echo $row["id"]; ?>"><?php  echo$row["jb_title"]; ?></a></td>
                        <?php } ?>
                        <td><?php echo $jb_type; ?></td>
                        <td><span class="badge bg-success"><?php echo date("M d, Y", strtotime($row['jb_date'])); ?></span></td>
                        <td><?php echo $row["clint_name"]; ?></td>
                        <td><?php echo $row["jb_workingtype"]; ?></td>
                        <td><?php echo "Rs." . number_format($row['min_sal'], 2); ?></td>
                        <td><?php echo "Rs." . number_format($row['max_sal'], 2);; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><span class="badge bg-success"><?php echo $row["deadline"]; ?></span></td>
                         <td>
                        <?php
                            if (isset($_SESSION['login_id']) && in_array($_SESSION['login_id'], [5,6, 13, 15, 57])) {
                               $id=$row["id"];
                                 $st=$row["status"];
                                 $by=$_SESSION['login_id'];
                             if($st==1){
                                echo'<p><a href ="jobmangement_inacstatus.php?inac_id='.$id.'&status=0&accesby='.$by.'" class="btn  btn-success">Active</a></p>';
                            }else{
                                 echo'<p><a href ="jobmangement_acstatus.php?ac_id='.$id.'&status=1&accesby='.$by.'" class="btn  btn-danger">INACTIVE</a></p>';
                            }
                            
                            } else {
                                  $id=$row["id"];
                             $st=$row["status"];
                             $by=$_SESSION['login_id'];
                  
                             if($st==1){
                                echo'<span class="badge bg-success">ACTIVE</span>';
                            }else{
                                
                                 echo'<span class="badge bg-danger">INACTIVE</span>';
                            }
                            }
                            ?>
                       
                        
                         
                        </td>
                                          <?php
                        if($_SESSION['login_type']==1){
                        ?>
                        <td>
                            <!--<a target= "_blank" href="./index2.php?page=jobmangement_view&id=<?php echo $row["id"]; ?>"><span class="badge bg-secondary"><i class="bi bi-eye"></i></span></a>-->
                            <!--<a target= "_blank" href="./index2.php?page=jobmangement_edit&id=<?php echo $row["id"]; ?>"><span class="badge bg-primary"><i class="bi bi-slash-square"></i></span></a>-->
                            <a onclick="return confirm('Are You Sure Want To Delete This Record!'); " href="jobmangement_delete.php?d_id=<?php echo $row["id"]; ?>" ><span class="badge bg-danger"><i class="bi bi-trash"></i> </span></a>
                            <a target= "_blank" href="jobmangement_pdf.php?id=<?php echo $row["id"]; ?>"><span class="badge bg-info"><i class="bi bi-download"></i> </span></a>
                        </td>
                      </tr>
                      <?php
                 } else if ($_SESSION['login_id'] == 6 || $_SESSION['login_id'] == 15){ ?>
                   <td>
                            <!--<a target= "_blank" href="./index2.php?page=jobmangement_view&id=<?php echo $row["id"]; ?>"><span class="badge bg-secondary"><i class="bi bi-eye"></i></span></a>-->
                            <a target= "_blank" href="./index2.php?page=jobmangement_edit&id=<?php echo $row["id"]; ?>"><span class="badge bg-primary"><i class="bi bi-slash-square"></i></span></a>
                            <a onclick="return confirm('Are You Sure Want To Delete This Record!'); " href="jobmangement_delete.php?d_id=<?php echo $row["id"]; ?>" ><span class="badge bg-danger"><i class="bi bi-trash"></i> </span></a>
                            <a target= "_blank" href="jobmangement_pdf.php?id=<?php echo $row["id"]; ?>"><span class="badge bg-info"><i class="bi bi-download"></i> </span></a>
                        </td>
                        </tr>
                 
                 <?php
                 } }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
</main>