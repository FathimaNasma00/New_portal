<?php include'db_connect.php'; ?>
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


<div class="col-lg-12">
     <h4><b>Payment Status List <i class="nav-icon fas fa-poll"></i></b></h4>
	<div class="card card-outline card-success">
		<div class="card-header">
		    
		    
		    
		    <div class="row">
		        <div class="col-2" style="flex: 0 0 11.666667%;"> <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button></div>
		        <div class="col-2">
		          <form method="post" action="paymentstatus_export.php">
                    <button type="submit" name="export" class="btn btn-success" style="left:0px;" value="Export" />Export&nbsp;<i class="fas fa-file-export"></i></button>
                    </form>
		        </div>
		    </div>
		   
			
		</div>
		<div class="card-body col-12">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-left">RefNo</th>
						<th>Candidate</th>
						<th>Amount</th>
						<th>Client</th>
						<th>Date of Join</th>
						<th>Status</th>
						<th>Payment Action</th>
						   <!--INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`) -->
						   <!--,clintmanege.clint_name-->
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT sale_target.id,sale_target.candidate,sale_target.amount,sale_target.account_manger,sale_target.join_date,sale_target.status,documents.id AS dmid,documents.ref_no,documents.title, documents.last_name,
					                     documents.recruiter,concat(users.firstname ,' ' ,users.lastname) as name,clintmanege.clint_name
					                     FROM `sale_target`
					                     INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
					                     INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
					                     INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
					                  
                                        order by id desc");
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
						<th class="text-center"><a href="./index.php?page=view_documentz&id=<?php echo $row['dmid']; ?>" target="_blank"><?php echo $string ?></a></th>
						<td><b><a href="./index.php?page=salereveueview&id=<?php echo $row['id'] ?>" target="_blank"><?php echo ucwords($row['title']) ?> <?php echo ucwords($row['last_name']) ?></a></b></td>
						<td><b><?php echo "Rs." . number_format($row['amount'],2) ?></b></td>
						<td><b><?php echo $row['clint_name'] ?></b></td>
						<td><b><?php echo $row['join_date'] ?></b></td>
						 <td>  
                           <?php  
                           if ($row['status']==0) {  
                                echo "Payment Due";  
                           }if ($row['status']==1) {  
                                echo "Pending PO";  
                           }if ($row['status']==2) {  
                                echo "Pending Invoice";  
                           }if ($row['status']==3) {  
                                echo "Pending Payment";  
                           }if ($row['status']==4) {  
                                echo "Payment Received";  
                           }   
                           ?>  
                      </td> 
						<td>
						      <select class="form-control form-control-sm select2" onchange="status_update(this.options[this.selectedIndex].value,'<?php echo $row['id'] ?>')">  
                                <option value="">Update Status</option> 
                                <option value="0">Payment Due</option>
                                <option value="1">Pending PO</option>  
                                <option value="2">Pending Invoice</option>  
                                <option value="3">Pending Payment</option>  
                                <option value="4">Payment Received</option>  
                           </select>
						</td>
					</tr>	
				<?php } ?>
				</tbody>
			</table>
			 <script type="text/javascript">  
                      function status_update(value,id){  
                           //alert(id);  
                           let url = "payment_status.php";  
                           window.location.href= url+"?id="+id+"&statusid="+value;  
                      }  
                 </script> 
		</div>
	</div>
</div>

                <div id="add_data_Modal" class="modal fade">
                 <div class="modal-dialog">
                  <div class="modal-content">
                   <div class="modal-header">
                    <button type="button" class="close btn btn-danger btn-flat" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ADD DATA</h4>
                   </div>
                   <div class="modal-body">
                    <form action="" id="upload_saleform">
                    <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <label for="" class="control-label">Candidate <span style="font-size:11px;">(Name - Recruiter - RefNo)</span></label>
                          <select class="form-control form-control-sm select2" required  name="appli_ids">
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
                                
                                <select class="form-control form-control-sm select2"  required name="clints">
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
                            
                            <select class="form-control form-control-sm select2"  required name="recuiter" id="recuiter">
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
                         <button class="btn btn-flat  bg-gradient-primary mx-2" form="upload_saleform">Save</button>
                    
                        </form>
                       </div>
                       <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       </div>
                      </div>
                     </div>
                    </div>


 
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