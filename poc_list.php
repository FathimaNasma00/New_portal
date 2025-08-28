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
      <h1>POC</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">POC</li>
          <li class="breadcrumb-item active">list</li>
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
        <div class="d-flex justify-content-center ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">POC Information</h5>
                		<div class="card-body">
            		<div class="row card-header">
            		    <div class="col-2">  <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button></div>
            		  
            			<div class="col-5 card-tools">
            				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index2.php?page=poc"><i class="fa fa-plus"></i> Add POC</a>
            			</div>
            		</div>
            		<div class="card-body">
            			<table class="table table-borderless datatable">
            				<thead>
            					<tr>
            						<th class="text-center">#</th>
            						<th>Name</th>
            						<th>Designation</th>
            						<th>Division</th>
            						<th>Email</th>
            						<th>Phone Number</th>
            						<th>Action</th>
            					</tr>
            				</thead>
            				<tbody>
            					<?php
            					$i = 1;
            					$qry = $conn->query("SELECT * FROM poc_mage order by id asc");
            					while($row= $qry->fetch_assoc()){
            					?>
            					<tr>
            						<th class="text-center"><?php echo $i++; ?></th>
            						<td><b><a target="_blank" href="./index2.php?page=poc_edit&id=<?php echo $row['id'] ?>"><?php echo $row['name']; ?></a></b></td>
            						<td><b><?php echo $row['designation']; ?></b></td>
            						<td><b><?php echo $row['division']; ?></b></td>
            						<td><b><?php echo $row['email']; ?></b></td>
            						<td><b><?php echo $row['phonenumber']; ?></b></td>
            			<td class="text-left">
							    <a   class="btn btn-primary btn-flat" href="./index2.php?page=poc_edit&id=<?php echo $row['id'] ?>" onclick="return confirm('Are You Sure Want To Edit This Record!'); ">
		                            <i class="bi bi-slash-square"></i>
		                      </a>
		                      <a   class="btn btn-primary btn-flat" href="./index2.php?page=poc_delete&poc_id=<?php echo $row['id'] ?>" onclick="return confirm('Are You Sure Want To Delete This Record!'); ">
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
            						</div>
            							</section>
            		</main>
            		

<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_user').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> User Details","view_user.php?id="+$(this).attr('data-id'))
	})
	$('.delete_clint').click(function(){
	_conf("Are you sure to delete this Clint?","delete_clint",[$(this).attr('data-id')])
	})
	})
	function delete_clint($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_clint',
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