<?php include'db_connect.php' ?>
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
      <h1>Hiring</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Hiring</li>
          <li class="breadcrumb-item active">My List</li>
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
              <h5 class="card-title">My List OF Hiring</h5>
                	
                		<div class="card-header">
                		    
                		    
                		    
                		    <div class="row">
                		        <div class="col-2" style="flex: 0 0 11.666667%;"> <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button></div>
                		        <div class="col-2">
                		            <form method="post" action="mysaletargetexport.php">
                    		              <input type="hidden" name="id" value="<?php echo $_SESSION['login_id']; ?>">    
                                        <button type="submit" name="export" class="btn btn-success" style="left:0px;" value="Export" />Export&nbsp;<i class="fas fa-file-export"></i></button>
                                        </form>
                		        </div>
                		        <div class="col-6">
                		            <div class="card-tools">
                			            <div class="card-tools">
                			                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">Add Data<i class="nav-icon fas fa-hand-point-up"></i></button>
                			            </div>
                		        	</div>
                		        </div>
                		    </div>
                		   
                			
    </div>
                		<div class="card-body">
                			<table class="table table-borderless datatable">
                				<thead>
                					<tr>
                						<th class="text-center">#</th>
                						<th class="text-left">RefNo</th>
                						<th>Candidate</th>
                						<th>Amount</th>
                						<th>Client</th>
                						<th>Date of Join</th>
                						<th>Account Manager</th>
                						<th>Job Title</th>
						              <th>Job Ref</th>
                						<th>Action</th>
                						   <!--INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`) -->
                						   <!--,clintmanege.clint_name-->
                					</tr>
                				</thead>
                				<tbody>
                					<?php
                					$i = 1;
                					$qry = $conn->query("SELECT DISTINCT sale_target.id, sale_target.candidate, sale_target.amount, sale_target.account_manger, sale_target.join_date, 
                   documents.id AS dmid, documents.ref_no, documents.title, documents.last_name, documents.recruiter, 
                   CONCAT(users.firstname, ' ', users.lastname) AS name, clintmanege.clint_name, job_management.id AS jobid, 
                   job_management.status, job_management.jb_title, job_management.jb_ref
            FROM sale_target
            INNER JOIN documents ON (sale_target.candidate = documents.id)
            INNER JOIN users ON (sale_target.user_id = users.id)
            INNER JOIN clintmanege ON (sale_target.client = clintmanege.clint_id)
            LEFT JOIN candidate_summery ON sale_target.candidate = candidate_summery.application_id
            LEFT JOIN job_management ON candidate_summery.job_refno = job_management.id
            WHERE sale_target.user_id = '{$_SESSION['login_id']}'
            ORDER BY sale_target.id DESC;
            ");
                					while($row= $qry->fetch_assoc()){
                					   	if($row['ref_no'] <= 99){
                						$recq=$row['recruiter'];
                						$reqanswr=$recq."00".$row['ref_no'];
                						$string = str_replace(' ','',$reqanswr);
                						}else{
                						 $recq=$row['recruiter'];
                						$reqanswr=$recq."0".$row['ref_no'];
                						$string = str_replace(' ','',$reqanswr);
                						}
                					?>
                					<tr>
                						<th class="text-center"><?php echo $i++ ?></th>
                						<th class="text-center"><a href="./index2.php?page=view_documentz&id=<?php echo $row['dmid']; ?>" target="_blank"><?php echo $string ?></a></th>
                						<td><b><a href="./index2.php?page=salereveueview&id=<?php echo $row['id'] ?>"><?php echo ucwords($row['title']) ?> <?php echo ucwords($row['last_name']) ?></a></b></td>
                						<td><b><?php echo "Rs." . number_format($row['amount'],2) ?></b></td>
                						<td><b><?php echo $row['clint_name'] ?></b></td>
                						<td><b><?php echo $row['join_date'] ?></b></td>
                						<td><b><?php echo $row['account_manger'] ?></b></td>
                						<td><b><?php echo $row['jb_title'] ?></b></td>
                						<td><a target="_blank" href="<?php 
                                            if ($row["status"] == 1) {
                                                echo "./index2.php?page=saledataview&id=" . $row["jobid"];
                                            } else {
                                                echo "./index2.php?page=saledatainactiveview&id=" . $row["jobid"];
                                            }
                                        ?>"><b><?php echo $row["jb_ref"]; ?></b></a></td>
                            
                						<td class="text-center">
                						    <a   class="btn btn-primary btn-flat" href="./index2.php?page=salereveueview&id=<?php echo $row['id'] ?>" onclick="return confirm('Are You Sure Want To Edit This Record!'); "  target="_blank">
                		                            <i class="bi bi-slash-square"></i>
                		                        </a>
                		                      <a href="deletesalerevenu.php?delete_id=<?php echo $row['id']; ?>"  class="btn btn-danger btn-flat" onclick="return confirm('Are You Sure Want To Delete This Record!'); " >
                		                            <i class="bi bi-trash-fill"></i>
                		                        </a>
                						</td>
                					
                			
                					</tr>	
                				<?php } ?>
                				</tbody>
                			</table>
                	
    </div>

          
            </div>
            </div>
            </div>
            </div>
            </div>
            </section>
            
</main>



                  <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add Data</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                    <form action="" id="upload_saleform">
                    <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label for="" class="control-label">Candidate <span style="font-size:11px;">(Name - Recruiter - RefNo)</span></label>
                          <select class="form-control form-control-sm select" required  name="appli_ids">
                            <option></option>
                            <?php 
                            $employees = $conn->query("SELECT *,concat(title,' ',last_name) as name , recruiter, ref_no FROM documents where status	 = 1 order by id asc ");
                            while($row= $employees->fetch_assoc()):
        					    $date=$row['date'];
        					   		if($row['ref_no'] <= 99){
        						$recq=$row['recruiter'];
        						$reqanswr=$recq."00".$row['ref_no'];
        						$string = str_replace(' ','',$reqanswr);
        						}else{
        						 $recq=$row['recruiter'];
        						$reqanswr=$recq."0".$row['ref_no'];
        						$string = str_replace(' ','',$reqanswr);
        						}
                            ?>
                            <option value="<?php echo $row['id'] ?>" <?php echo isset($appli_ids) && in_array($row['id'],explode(',',$appli_ids)) ? "selected" : '' ?>>
                            <?php echo ucwords($row['name']). "&nbsp&nbsp - &nbsp&nbsp " .$row['recruiter']. "&nbsp&nbsp - &nbsp&nbsp ". $string ;
                            ?>
                              </option>
                             <?php endwhile; ?>
                          </select>
                          
                        </div>
                        </div>
                    	</div>
                    	<div class="row">
    				    	<div class="col-md-12">
    						<div class="form-group">
    							<label for="" class="control-label">Client</label>
                                
                                <select class="form-control form-control-sm select"  required name="clints">
                                <option></option>
                                <?php 
                                $employees = $conn->query("SELECT * FROM clintmanege order by clint_id asc ");
                                while($row= $employees->fetch_assoc()){
                                ?>
                                    
                                 <option value="<?php echo $row['clint_id'] ?>" <?php echo isset($clints) && in_array($row['clint_id'],explode(',',$clints)) ? "selected" : '' ?>>
                                <?php echo ucwords($row['clint_name']) ?>
                                  
                                  </option>
                                    
        
                                <?php } ?>
                              </select>
                                
    						</div>
    						
    						
    					</div>
			    	</div>
                         <label>Amount</label>
                         <input type="text" name="amount" id="amount" class="form-control" />
                         <br />
                         <label>Date Of Join</label>
                         <input type="date" name="join_date" id="join_date" class="form-control" />
                         <br />
                         <div class="row">
					   <div class="col-md-12">
						<div class="form-group">
							<label for="" class="control-label">Account Manager</label>
                            
                            <select class="form-control form-control-sm select"  required name="recuiter" id="recuiter">
                            <option></option>
                            <?php 
                            $employees = $conn->query("SELECT * FROM users order by id asc ");
                            while($row= $employees->fetch_assoc()){
                            ?>
                                
                             <option value="<?php echo $row['recruiter'] ?>" <?php echo isset($recuiter) && in_array($row['recruiter'],explode(',',$recuiter)) ? "selected" : '' ?>>
                            <?php echo ucwords($row['recruiter']) ?>
                              
                              </option>
                                
    
                            <?php } ?>
                          </select>
                            
						</div>
						
						
					</div>
				</div>
				<br/>
                         <button class="btn btn-primary  bg-gradient-primary mx-2" form="upload_saleform">Save</button>
                    
                        </form>
                       
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->

 
 <script>
$('#upload_saleform').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_saleform',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
			     $('#add_data_Modal').modal('hide');  
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.reload()
					},1500)
				
			}
		})
	})
</script>

<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_salerevnue').click(function(){
	_conf("Are you sure to Edit this data?","add_data_Modal",[$(this).attr('data-id')])
	})
	$('.delete_saleform').click(function(){
	_conf("Are you sure to delete this data?","delete_saleform",[$(this).attr('data-id')])
	})
	})
	function delete_saleform($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_saleform',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>