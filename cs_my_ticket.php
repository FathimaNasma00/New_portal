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
                title: '<?php echo $_SESSION['status']; ?>',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                location.reload(); // Refresh the page
            });
        </script>
        <?php 
        unset($_SESSION['status']);
    }

?>
<main>
  <div class="pagetitle">
      <h1>Customer Support Center</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Ticket</li>
          <li class="breadcrumb-item active">My Open Ticket</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

 
<div class="col-lg-12">
	<div class="card card-outline card-info">
		<div class="card-body">
			<table class="table table-borderless datatable" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="25%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Ticket</th>
						<th>Subject</th>
						<th>Description</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$where = '';
					if($_SESSION['login_type'] == 2)
						$where .= " where t.customer_id = {$_SESSION['login_id']} ";
					if($_SESSION['login_type'] == 3)
						$where .= " where t.customer_id = {$_SESSION['login_id']} ";
					$qry = $conn->query("SELECT t.*,concat(c.lastname,', ',c.firstname,' ',c.middlename) as cname FROM customer_support_tickets t inner join users c on c.id= t.customer_id $where order by unix_timestamp(t.date_created) desc");
					while($row= $qry->fetch_assoc()):
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						$desc = strtr(html_entity_decode($row['description']),$trans);
						$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo date("M d, Y",strtotime($row['date_created'])) ?></b></td>
						<td><b><?php echo ucwords($row['cname']) ?></b></td>
						<td><b><?php echo $row['subject'] ?></b></td>
						<td><b class="truncate"><?php echo strip_tags($desc) ?></b></td>
						<td>
							<?php if($row['status'] == 0): ?>
								<span class="badge bg-primary">Pending/Open</span>
							<?php elseif($row['status'] == 1): ?>
								<span class="badge bg-info">Processing</span>
							<?php elseif($row['status'] == 2): ?>
								<span class="badge bg-success">Done</span>
							<?php else: ?>
								<span class="badge bg-secondary">Closed</span>
							<?php endif; ?>
						</td>
						<td class="text-center">
                             <a target= "_blank" href="./index.php?page=cs_ticket_view&id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="badge bg-secondary"><i class="bi bi-eye"></i></span></a>
                            <a target= "_blank" href="./index2.php?page=cs_ticket_edit&id=<?php echo $row["id"]; ?>" data-id="<?php echo $row['id'] ?>"><span class="badge bg-primary"><i class="bi bi-slash-square"></i></span></a>
                            <a onclick="return confirm('Are You Sure Want To Delete This Record!'); " href="cs_ticket_delete.php?d_id=<?php echo $row["id"]; ?>" ><span class="badge bg-danger"><i class="bi bi-trash"></i> </span></a>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</main>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.delete_ticket').click(function(){
	_conf("Are you sure to delete this ticket?","delete_ticket",[$(this).attr('data-id')])
	})
	})
	function delete_ticket($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_ticket',
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