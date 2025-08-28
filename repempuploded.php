
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
            
			<form action="reprtemp.php" method="get">
                  

                <div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Employee</label>
                    
							<select class="form-control form-control-sm" name="employeeid">
                                 <?php
					$i = 1;

					$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users order by concat(firstname,' ',lastname) asc");
					while($row= $qry->fetch_assoc()):
					?>
                                <option value="<?php echo ucwords($row['id']) ?>"><?php echo ucwords($row['name']) ?></option>
                                  <?php endwhile; ?>
                            </select>
                           
						</div>
					</div>
				</div>
               
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">From</label>
							<input type="date" class="form-control form-control-sm" name="frmDate" >
						</div>
					</div>
				</div>
                
                <div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">To</label>
							<input type="date" class="form-control form-control-sm" name="toDate" >
						</div>
					</div>
				</div>
                
                <div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Type</label>
                    <br>
				
                           <?php
                                include "db_connect.php";

                                $brand_query = "SELECT * FROM status";
                                $brand_query_run  = mysqli_query($conn, $brand_query);

                                if(mysqli_num_rows($brand_query_run) > 0)
                                {
                                    foreach($brand_query_run as $brandlist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['status']))
                                        {
                                            $checked = $_GET['status'];
                                        }
                                        ?>
                                            <div>
                                                <input type="checkbox" name="status[]" value="<?= $brandlist['status_id']; ?>" 
                                                    <?php if(in_array($brandlist['status_id'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $brandlist['status']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "No Brands Found";
                                }
                            ?>
                           
						</div>
					</div>
				</div>
				

				
			<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    		    <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button>
    			<button class="btn btn-flat  bg-gradient-primary mx-2" name="generate_report">Generate</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" >Cancel</button>
    			
    		</div>
    	</div>	



		
        </form>
    	</div>
    	
	</div>
</div>
<script> 


	$('#manage-upload').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_upload',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.href = 'index.php?page=document_list'
					},2000)
				}
			}
		})
	})
</script>