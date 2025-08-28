<?php include'db_connect.php' ?>
<?php 
$query = "SELECT users.id,concat(users.firstname,', ',users.middlename,' ',users.lastname) as name FROM users ";
$result = mysqli_query($conn, $query);
?>

<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
		   <div class="row">
		     <div class="col-2">
		          <form method="post" action="alltimetracker.php">
                    <button type="submit" name="export" class="btn btn-success" style="left:0px;" value="Export" />Export&nbsp;<i class="fas fa-file-export"></i></button>
                    </form>
		        </div>
        			<div class="card-tools">
        				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=timetracker"><i class="fa fa-plus"></i> Add New Time Tracker</a>
        			</div>
        			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="product_data">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th><select name="category" id="category" class="form-control">
                       <option value="">Name</option>
                                 <?php 
                                 while($row = mysqli_fetch_array($result))
                                 {
                                  echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                 }
                                 ?>
                         </th>
						<th>Task</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Count</th>
						<th>Recruiter</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_category)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":{
    url:"timetrackerfetch.php",
    type:"POST",
    data:{is_category:is_category}
   },
   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],
  });
 }

 $(document).on('change', '#category', function(){
  var category = $(this).val();
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>

<script>
	$(document).ready(function(){
	
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
			url:'ajax.php?action=delete_tracker',
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