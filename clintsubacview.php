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
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
		     <div class="row">
		       
		        <div class="col-2">
		          <form method="post" action="clintsubtaskexport.php">
                    <button type="submit" name="export" class="btn btn-success" style="left:0px;" value="Export" />Export&nbsp;<i class="fas fa-file-export"></i></button>
                    </form>
		        </div>
		   
		    </div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-condensed" id="list">
				<colgroup>
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Client Name</th>
						<th>Sub Accounts </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT clintmanege.clint_name,clintsubaccount.subacount,clintsubaccount.id FROM `clintsubaccount`
                                        INNER JOIN clintmanege ON (clintsubaccount.clintname = clintmanege.clint_id)");
					while($row= $qry->fetch_assoc()){
			


					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td>
							<p><b><?php echo ucwords($row['clint_name']) ?></b></p>
						</td>
						<td><b><?php echo ucwords($row['subacount']) ?></b></td>
					
							<td class="text-left">
		                      <a href="clintsubacdelete.php?delete_id=<?php echo $row['id']; ?>"  class="btn btn-danger btn-flat" onclick="return confirm('Are You Sure Want To Delete This Record!'); " >
		                            <i class="fas fa-trash"></i>
		                        </a>
						    </td>
			              
					</tr>	
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
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