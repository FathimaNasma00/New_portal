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
      <h1>Task</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Task</li>
          <li class="breadcrumb-item active">Task List</li>
        </ol>
      </nav>
    </div>
<div class="col-lg-12">
	<div class="card recent-sales overflow-auto">
		<div class="card-header">
		     <div class="row">
		       
		        <div class="col-2">
		          <form method="post" action="taskexport.php">
                    <button type="submit" name="export" class="btn btn-success" style="left:0px;" value="Export" />Export&nbsp;<i class="fas fa-file-export"></i></button>
                    </form>
		        </div>
		    
		    
			<div  class="col-5 card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary view_Task" href="./index2.php?page=new_task"><i class="fa fa-plus"></i> Add New project</a>
			</div>
		    </div>
		</div>
		<div class="card-body">
			<table class="table table-borderless datatable">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Account Manager</th>
						<th>Project Started</th>
						<th>Project Due Date</th>
						<th>Client Name</th>
						<th>Role</th>
						<th>Recruiter</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT project_list.id,concat(users.firstname,' ',users.lastname) as name,project_list.rolname,project_list.start_date,project_list.end_date,project_list.user_ids,clintmanege.clint_name FROM `project_list`
                                            INNER JOIN users ON (project_list.name = users.id)
                                            INNER JOIN clintmanege ON (project_list.clint_id = clintmanege.clint_id)");
					while($row= $qry->fetch_assoc()){
			


					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td>
							<a target="_blank" href="./index2.php?page=taskedite&id=<?php echo $row['id'] ?>" ><b><?php echo $row['name']; ?></b></a>
						</td>
						<td><b><?php echo date("M d, Y",strtotime($row['start_date'])) ?></b></td>
						<td><b><?php echo date("M d, Y",strtotime($row['end_date'])) ?></b></td>
						<td><b><?php echo ucwords($row['clint_name']) ?></b></td>
						<td><b><?php echo ucwords($row['rolname']) ?></b></td>
						<td><b><?php echo ucwords($row['user_ids']) ?></b></td>
					
							<td class="text-left">
							    <a   class="btn btn-primary btn-flat" href="./index2.php?page=taskedite&id=<?php echo $row['id'] ?>" onclick="return confirm('Are You Sure Want To Edit This Record!'); ">
		                            <i class="bi bi-slash-square"></i>
		                      </a>
		                      <a href="deleteTask.php?delete_id=<?php echo $row['id']; ?>"  class="btn btn-danger btn-flat" onclick="return confirm('Are You Sure Want To Delete This Record!'); " >
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
</main>
<style>
	table p{
		margin: unset !important;
	}
	table td{
		vertical-align: middle !important
	}
</style>
<script>
	$(document).ready(function(){
	$('#list').dataTable();
// 	$('.view_Task').click(function(){
// 		uni_modal("<i class='fa fa-id-card'></i> ADD TASK","new_task.php")
// 	})
	$('.new_productivity').click(function(){
		uni_modal("<i class='fa fa-plus'></i> New Progress for: "+$(this).attr('data-task'),"manage_progress.php?pid="+$(this).attr('data-pid')+"&tid="+$(this).attr('data-tid'),'large')
	})
	})
	function delete_project($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_project',
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