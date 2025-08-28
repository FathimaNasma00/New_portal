<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query(" SELECT timetracker.`id`, 
                                        timetracker.`log_id`, 
                                        timetracker.`recruiter`,
                                        timetracker.`task`, 
                                         timetracker.`other_task`, 
                                        timetracker.`starttime`, 
                                        timetracker.`endtime`,
                                        timetracker.`count`, 
                                        timetracker.`types`, 
                                        timetracker.`description`,
                                        timetracker.`date`, 
                                        timetracker.`action_date`, 
                                        timetracker.`user_id`,
                                        concat(users.firstname,', ',users.middlename,' ',users.lastname) as name
                                        FROM `timetracker`
                                        INNER JOIN users
                                        ON (`timetracker`.`user_id` = `users`.`id`) 
                                        where timetracker.id = ".$_GET['id'])->fetch_array();
    
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>
<div class="container-fluid">
	<div class="card card-widget widget-user shadow">
      <div class="widget-user-header bg-dark">
        <h3 class="widget-user-username"><?php echo ucwords($name) ?></h3>
        <h5 class="widget-user-desc"><?php echo $date ?></h5>
      </div>
     
      <div class="card-footer">
        <div class="container-fluid">
        	<dl>
        		<dt>TASK</dt>
        		<dd><?php echo $task ?></dd>
        	</dl>
        	<dl>
        		<dt>OTHER TASK</dt>
        		<dd><?php echo $other_task ?></dd>
        	</dl>
        	
        	<dl>
        		<dt>TIME</dt>
        		<dd><?php echo $starttime ?> to <?php echo $endtime ?></dd>
        	</dl>
        	
        	<dl>
        		<dt>COUNT</dt>
        		<dd><?php echo $count ?></dd>
        	</dl>
        	<dl>
        		<dt>TYPE</dt>
        		<dd><?php echo $types ?></dd>
        	</dl>
        	<dl>
        		<dt>DESCRIPTION</dt>
        		<dd><?php echo $description?></dd>
        	</dl>
        </div>
    </div>
	</div>
</div>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>