         
<style>
    .hidden{
	display:none;
}
.show
{
	display:block;
}
</style>

  <main>

    <div class="pagetitle">
      <h1>Excuse Form</h1>
      <nav> 
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Excuse Form</li>
          <li class="breadcrumb-item active">Add Data</li>
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
              <h5 class="card-title">Excuse Form</h5>
              
    
        	
        			<form action="" id="upload-excuse">
                        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                        <input type="hidden" name="sesid" value="<?php echo $_SESSION['login_id']; ?> ">
                    <?php
                            include 'db_connect.php';
                            $qry = $conn->query("SELECT * FROM users where id = '{$_SESSION['login_id']}' ")->fetch_array();
                            foreach($qry as $k => $v){
                                if($k == 'recruiter')
                                    $k = 'rrecruiter';
                                $$k = $v;
                            }
                            ?>
                     <input type="hidden" name="recruiter" value="<?php echo $rrecruiter; ?> ">
                     
                        
        				
        				<div class="row">
        					<div class="col-md-12">
        						<div class="form-group">
        							<label for="" class="control-label">Mistake</label>
        							<input type="text" class="form-control form-control-sm" required name="mistake" value="<?php echo isset($mistake) ? $mistake : '' ?>">
        						</div>
        					</div>
        				</div>
        				
        				<div class="row">
        				<div class="col-md-12">
        						<div class="form-group">
        							<label for="" class="control-label">Reasons</label>
        							<textarea name="reason" required   class="summernote form-control">
        								<?php echo isset($reason) ? $reason : '' ?>
        							</textarea>
        						</div>
        				</div>
        				</div>
                    
                       
                    </form>
             
            	<div class="card-footer border-top border-info">
            		<div class="d-flex w-100 justify-content-center align-items-center">
            		    <button onclick="history.go(-1);" class="btn btn-secondary"><i class="fas fa-reply"></i> &nbsp; Back</button>
            			<button class="btn btn-primary  bg-gradient-primary mx-2" form="upload-excuse">Save</button>
            		</div>
            	</div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </section>

  
<script>
$('#upload-excuse').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_excuse',
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
						location.href = 'index2.php?page=myexcuses'
					},2000)
				}
			}
		})
	})
</script>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_tracker').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Tracker Details","view_trackerdet.php?id="+$(this).attr('data-id'))
	})
	$('.delete_tracker').click(function(){
	_conf("Are you sure to delete this data?","delete_tracker",[$(this).attr('data-id')])
	})
	})
	function delete_tracker($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_excuse',
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