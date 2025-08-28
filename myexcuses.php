
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
        <div class=" justify-content-center ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">My Excuse List</h5>

		<div class="card-body">
			<table class="table table-borderless datatable">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Mistake</th>
						<th>Reasons</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM `excuse_list`
                                        where logid = '{$_SESSION['login_id']}'
                                        order by id desc");
					while($row= $qry->fetch_assoc()){
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo htmlspecialchars_decode($row['mistake']); ?></b></td>
						<td><b><?php echo htmlspecialchars_decode($row['reason']); ?></b></td>
						<td><b><?php echo $row['date'] ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item delete_excuse" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                    </div>
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