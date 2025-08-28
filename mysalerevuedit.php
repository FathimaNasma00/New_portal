<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT sale_target.id,sale_target.candidate,sale_target.client,sale_target.amount,sale_target.account_manger,sale_target.join_date,concat(documents.title , documents.last_name ) as namez ,documents.recruiter, documents.ref_no
					                     ,concat(users.firstname ,' ' ,users.lastname) as name,clintmanege.clint_name
					                     FROM `sale_target`
					                     
					                     INNER JOIN documents ON (`sale_target`.`candidate` = `documents`.`id`)
					                     INNER JOIN users ON (`sale_target`.`user_id` = `users`.`id`)
					                     INNER JOIN clintmanege ON (`sale_target`.`client` = `clintmanege`.`clint_id`)
                                         where sale_target.id =".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>

 <div class="col-lg-8">
	<div class="card card-outline card-primary">
		<div class="card-body">                
                   <div class="modal-body">
                    <form action="" id="upload_saleform">
                    <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                         <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                          <label for="" class="control-label">Candidate <span style="font-size:11px;">(Name - Recruiter - RefNo)</span></label>
                          <select class="form-control form-control-sm select2" required  name="appli_ids">
                             
                            <option value="<?php echo isset($candidate) ? $candidate: '' ?>"><?php echo isset($namez) ? $namez: '' ?>
                            &nbsp;-&nbsp; 
                            <?php  if($ref_no <= 99){
        						$recq=$recruiter;
        						$reqanswr=$recq."00".$ref_no;
        						$string = str_replace(' ','',$reqanswr);
        						}else{
        						 $recq=$recruiter;
        						$reqanswr=$recq."0".$ref_no;
        						$string = str_replace(' ','',$reqanswr);
        						} echo ($string) ? $string: '' ?>
        						</option>
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
                                <option value="<?php echo isset($client) ? $client: '' ?>"><?php echo isset($clint_name) ? $clint_name: '' ?></option>
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
                         <input type="text" name="amount" id="amount" value="<?php echo isset($amount) ? $amount: '' ?>" class="form-control" />
                         <br />
                         <label>Date Of Join</label>
                         <input type="date" name="join_date" id="join_date" class="form-control" value="<?php echo isset($join_date) ? $join_date: '' ?>" />
                         <br />
                         <div class="row">
					   <div class="col-md-12">
						<div class="form-group">
							<label for="" class="control-label">Account Manager</label>
                            
                            <select class="form-control form-control-sm select2"  required name="recuiter" id="recuiter">
                            <option value="<?php echo isset($account_manger) ? $account_manger: '' ?>"><?php echo isset($account_manger) ? $account_manger: '' ?>
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
         </div>
    </div>
</div>
                    
 <style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>
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
						location.href = 'index.php?page=mysalerevue'
					},1500)
				
			}
		})
	})
</script>
