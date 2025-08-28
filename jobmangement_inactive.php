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
      <h1>Inactive Jobs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Job Management</li>
          <li class="breadcrumb-item active">Inactive</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

 <div class="col-sm-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-header">
            		    <div class="row">
            		        <div class="col-2" style="flex: 0 0 11.666667%;"> <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button></div>
            		        <div class="col-2">
            		          <form method="post" action="jobmangement_inactiveexport.php">
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
                        <th scope="col">Client</th>
                        <th scope="col">Working Type</th>
                        <?php if($_SESSION['login_type']==1){ ?>
                        <th scope="col">Recruiter</th>
                        <th scope="col">Deadline</th>
                          <?php } ?>
                        <th scope="col">Status</th>
                         <?php if($_SESSION['login_type']==1){ ?>
                        <th scope="col">Action</th>
                        <?php } ?>
                        
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                     $query="SELECT job_management.id,job_management.jb_ref,job_management.jb_title,job_management.jb_type,job_management.jb_workingtype,job_management.status,
                            job_management.deadline, concat(users.firstname,', ',users.middlename,' ',users.lastname) as name,clintmanege.clint_name,job_designation.reasons  FROM job_management
                            INNER JOIN users ON (job_management.jb_recuiters = users.id)
                            INNER JOIN clintmanege  ON (job_management.jb_client = clintmanege.clint_id)
                            INNER JOIN job_designation ON (job_management.id = job_designation.job_id) 
                            WHERE job_management.status = '0' AND job_designation.status= '0'
                            order by job_management.id desc";
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
							<td><a target= "_blank" href="./index2.php?page=saledatainactiveview&id=<?php echo $row["id"]; ?>"><?php echo $row["jb_ref"]; ?></a></td>
						 <?php
                        if($_SESSION['login_type']==1){
                        ?>
                        <td><a target= "_blank" href="./index2.php?page=jobmangement_edit&id=<?php echo $row["id"]; ?>"><?php  echo$row["jb_title"]; ?></a></td>
                        <?php }else{ ?>
                        <td><a target= "_blank" href="./index2.php?page=jobmangement_view&id=<?php echo $row["id"]; ?>"><?php  echo$row["jb_title"]; ?></a></td>
                        <?php } ?>
                        <td><?php echo $jb_type; ?></td>
                        <td><?php echo $row["clint_name"]; ?></td>
                        <td><?php echo $row["jb_workingtype"]; ?></td>
                          <?php if($_SESSION['login_type']==1){ ?>
                        <td><?php echo $row["name"]; ?></td>
                        <td><span class="badge bg-success"><?php echo $row["deadline"]; ?></span></td>
                          <?php } ?>
                         <td><?php
                         $id=$row["id"];
                         $st=$row["status"];
                         $by=$_SESSION['login_id'];
                        if($st==0){
                            ?>
                            
                                
                                  <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown"><p><span class="badge bg-danger">INACTIVE</span></p></a>
                                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                                    <li class="dropdown-header">
                                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Rejected Reasons</span>
                                    </li>
                                     <li>
                                      <hr class="dropdown-divider">
                                    </li>
                                    
                                    <li class="dropdown-header">
                                     <?php     
                                 
                                       echo $row["reasons"]; ;
                                   
                                     ?>
                                    </li>
                                    <li>
                                      <hr class="dropdown-divider">
                                    </li>
                                
                                  </ul><!-- End Messages Dropdown Items -->
                               <!-- End Messages Nav -->
                   
                         <?php
                            }
                         ?>
                         </td>
                                          <?php
                        if($_SESSION['login_type']==1){
                        ?>
                        <td><a target= "_blank" href="./index2.php?page=jobmangement_view&id=<?php echo $row["id"]; ?>"><span class="badge bg-secondary"><i class="bi bi-eye"></i></span></a>
                            <a target= "_blank" href="./index2.php?page=jobmangement_edit&id=<?php echo $row["id"]; ?>"><span class="badge bg-primary"><i class="bi bi-slash-square"></i></span></a>
                            <a onclick="return confirm('Are You Sure Want To Delete This Record!');" href="jobmangement_delete.php?d_id=<?php echo $row["id"]; ?>"  ><span class="badge bg-danger"><i class="bi bi-trash"></i> </span></a>
                            <a target= "_blank" href="jobmangement_pdf.php?id=<?php echo $row["id"]; ?>"><span class="badge bg-info"><i class="bi bi-download"></i> </span></a>
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