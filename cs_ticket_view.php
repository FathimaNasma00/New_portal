<?php include 'db_connect.php' ?>
<?php 
$qry = $conn->query("SELECT t.*,concat(c.lastname,', ',c.firstname,' ',c.middlename) as cname, d.name as dname FROM customer_support_tickets t inner join users c on c.id= t.customer_id inner join customer_support_departments d on d.id = t.department_id  where  t.id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
?>
<main>
  <div class="pagetitle">
      <h1>Customer Support Center</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Ticket</li>
          <li class="breadcrumb-item active">View Ticket</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<style>
	.d-list {
	    display: list-item;
	}
</style>
<div class="col-lg-12">
	<div class="row">
		<div class="col-md-8">
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title">Ticket</h3>
				</div>
				<div class="card-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<label for="" class="control-label border-bottom border-primary">Subject</label>
								<p class="ml-2 d-list"><b><?php echo $subject ?></b></p>
								<label for="" class="control-label border-bottom border-primary">Customer</label>
								<p class="ml-2 d-list"><b><?php echo $cname ?></b></p>
							</div>
							<div class="col-md-6">
								<label for="" class="control-label border-bottom border-primary">Status</label>
								<p class="ml-2 d-list">
									<?php if($status == 0): ?>
										<span class="badge bg-primary">Pending/Open</span>
									<?php elseif($status == 1): ?>
										<span class="badge bg-info">Processing</span>
									<?php elseif($status == 2): ?>
										<span class="badge bg-success">Done</span>
									<?php else: ?>
										<span class="badge bg-secondary">Closed</span>
									<?php endif; ?>
									<?php if($_SESSION['login_type'] != 3): ?>
									<span class="badge btn-outline-primary btn update_status" data-id = '<?php echo $id ?>'>Update Status</span>
									<?php endif; ?>
								</p>
								<label for="" class="control-label border-bottom border-primary">Need Support From</label>
								<p class="ml-2 d-list"><b><?php echo $dname ?></b></p>
							</div>
						</div>
						<hr class="border-primary">
						<div>
							<?php echo html_entity_decode($description) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">Comment/s</h3>
				</div>
				<div class="card-body p-0 py-2">
					<div class="container-fluid">
						<?php 
						$comments = $conn->query("SELECT * FROM customer_support_comments where ticket_id = '$id' order by unix_timestamp(date_created) asc");
						while($row = $comments->fetch_assoc()):
							if($row['user_type'] == 1)
								$uname = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users where id = {$row['user_id']}")->fetch_array()['name'];
							if($row['user_type'] == 2)
								$uname = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM customer_support_staff where id = {$row['user_id']}")->fetch_array()['name'];
							if($row['user_type'] == 3)
								$uname = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users where id = {$row['user_id']}")->fetch_array()['name'];
						?>
						<div class="card card-outline card-info">
							<div class="card-header">
								<h5 class="card-title"><?php echo ucwords($uname) ?></h5>
								<div class="card-tools">
									<span class="text-muted"><?php echo date("M d, Y",strtotime($row['date_created'])) ?></span>
									<?php if($row['user_type'] == $_SESSION['login_type'] && $row['user_id'] == $_SESSION['login_id']): ?>
									<span class="dropleft">
										<a class="fa fa-ellipsis-v text-muted" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
										<div class="dropdown-menu" style="">
									        <a class="dropdown-item edit_comment" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
									        <div class="dropdown-divider"></div>
									        <a class="dropdown-item delete_comment" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
									     </div>
									</span>	
								<?php endif; ?>
								</div>
							</div>
							<div class="card-body">
								<div>
									<?php echo html_entity_decode($row['comment']) ?>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
					</div>
					<hr class="border-primary">
					<div class="px-2">
						<form action="" id="manage-comment">
							<div class="form-group">
								<input type="hidden" name="id" value="">
								<input type="hidden" name="ticket_id" value="<?php echo $id ?>">
								<label for="" class="control-label">New Comment</label>
								<textarea name="comment" id="" cols="30" rows="" class="fom-control summernote2"></textarea>
							</div>
							<button class="btn btn-primary btn-sm float-right">Save</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</main>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(function () {
    $('.summernote2').summernote({
        height: 150,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'view', [ 'undo', 'redo'] ]
        ]
    })

  })
	$('.edit_comment').click(function(){
		uni_modal("Edit Comment","cs_ticket_manger_comment.php?id="+$(this).attr('data-id'))
	})
	$('.update_status').click(function(){
		uni_modal("Update Ticket's Status","cs_manage_ticket.php?id="+$(this).attr('data-id'))
	})
	$('#manage-comment').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_tkcomment',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Comment successfully saved.',"success");
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	})
	$('.delete_comment').click(function(){
	_conf("Are you sure to delete this comment?","delete_comment",[$(this).attr('data-id')])
	})
	function delete_comment($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_tkcomment',
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