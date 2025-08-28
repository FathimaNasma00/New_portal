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
      <h1>Excuse</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Excuse</li>
          <li class="breadcrumb-item active">All List</li>
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
              <h5 class="card-title">Excuse All List</h5>
                		<div class="card-body">

		        <div class="row card-header">
		            <div class="col-2 card-tools">
		    <button onclick="history.go(-1);" class="btn btn-primary"><i class="fas fa-reply"></i> &nbsp; Back</button>
		    </div>
			<div class="col-4 card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index2.php?page=excuseform"><i class="fa fa-plus"></i> Add New Excuse</a>
			</div>
		</div>
		        <div class="card-body">
			<table class="table table-borderless datatable">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Name</th>
						<th>Mistake</th>
						<th>Reasons</th>
						<th>Recr uiter</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT
					                    excuse_list.id,excuse_list.user_id,excuse_list.recuiter,excuse_list.mistake,excuse_list.reason,excuse_list.date ,
					                    concat(users.firstname,', ',users.middlename,' ',users.lastname) as name
					                    FROM `excuse_list`
					                    INNER JOIN users
                                        ON (`excuse_list`.`user_id` = `users`.`id`) 
                                        order by excuse_list.id desc");
					while($row= $qry->fetch_assoc()){
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo ucwords($row['mistake']) ?></b></td>
						<td><b><?php echo $row['reason'] ?></b></td>
						<td><b><?php echo $row['recuiter'] ?></b></td>
						<td><b><?php echo $row['date'] ?></b></td>
							<td class="text-left">
		                      <a   class="btn btn-danger btn-flat delete_excuse"  onclick="return confirm('Are You Sure Want To Delete This Record!'); ">
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
	
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_tracker').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Tracker Details","view_trackerdet.php?id="+$(this).attr('data-id'))
	})
	$('.delete_excuse').click(function(){
	_conf("Are you sure to delete this data?","delete_excuse",[$(this).attr('data-id')])
	})
	})
	function delete_excuse($id){
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