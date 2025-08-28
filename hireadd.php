
  <main>

    <div class="pagetitle">
      <h1>Hiring</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Hiring</li>
          <li class="breadcrumb-item active">Add Candidate</li>
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
        <div class=" justify-content-center ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Hiring</h5>
              
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
                         <button class="btn btn-primary  bg-gradient-primary mx-2" form="upload_saleform">Save</button>
                    
                        </form>
              
              
              </div>
              </div>
              </div>
              </div>
              </div>
              </section>
              
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