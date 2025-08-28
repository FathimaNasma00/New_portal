
<?php include'db_connect.php' ?>
<?php 
    session_start();
    
    if(isset($_SESSION['datastatusz']))
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
        unset($_SESSION['datastatusz']);
    }

?>

<main>
  <div class="pagetitle">
      <h1>All Pending Documents</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Documents</li>
          <li class="breadcrumb-item active">All Pending</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

 <div class="col-sm-12">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ref No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Skills</th>
                        <th scope="col">Status</th>
                        <?php if($_SESSION['login_type']==1){ ?>
                        <th scope="col">Recruiter</th>
                        <?php } ?>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                        
                        
                      </tr>
                    </thead>
                    	<tbody>
					<?php
					$i = 1;
					$where = '';
					if($_SESSION['login_type'] == 1 ){
					$user = $conn->query("SELECT * FROM users where id in (SELECT user_id FROM documents) ");
					while($row = $user->fetch_assoc()){
						$uname[$row['id']] = ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']);
					}
                    }else{
						$where = " where user_id = '{$_SESSION['login_id']}' ";
                    }
					$qry = $conn->query("SELECT * FROM documents where status=0 order by unix_timestamp(date_created) desc");
					while($row= $qry->fetch_assoc()){
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						$desc = strtr(html_entity_decode($row['description']),$trans);
						$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
						if($row['ref_no'] <= 99){
						$recq=$row['recruiter'];
						$reqanswr=$recq."00".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}else{
						 $recq=$row['recruiter'];
						$reqanswr=$recq."0".$row['ref_no'];
						$string = str_replace(' ','',$reqanswr);
						}
						 
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b style="font-size:14px;"><a target="_blank" href="./index2.php?page=view_documentz&id=<?php echo $row['id']; ?>" class=""><?php echo $string; ?></a></b></td>
						<td><b style="font-size:14px;"><a target="_blank" href="./index2.php?page=view_documentz&id=<?php echo $row['id']; ?>" class=""><?php echo ucwords($row['title']) ?> <?php echo ucwords($row['last_name']) ?></a></b></td>

						<td style="width:10px;"><b style="font-size:10px;"><?php echo ucwords($row['tag']) ?></b></td>
						<td><b>
                            <?php 
    
                        	if($row['status'] == 1){
						  		echo "<span class='badge bg-success'>APPROVED</span>";
                        	}elseif($row['status'] == 0){
						  		echo "<span class='badge bg-danger'>PENDING</span>";
                        	}elseif($row['status'] == 2){
						  		echo "<span class='badge bg-danger'>REJECT</span>";
                        	}
                        	?></b>
						</td>

						  <?php if($_SESSION['login_type'] == 1 ){ ?>
				        <td><b><?php echo ucwords($row['recruiter']) ?></b></td>
						
					    <?php } ?>
					    <td><b style="font-size:14px;"><?php echo ucwords($row['date']) ?></b></td>
						<td class="text-center">
                          <div class="btn-group">
							 <?php if(($_SESSION['login_type'] == 4 ) AND ($row['status'] == 1) ){ ?>
		                   
		                        <a  href="./index2.php?page=view_documentz&id=<?php echo md5($row['id']) ?>"   target="_blank">
		                         <span class="badge bg-secondary"><i class="bi bi-eye"></i></span>
		                        </a>
		                 
	                      
	                       <?php } elseif(($_SESSION['login_type'] == 2 ) AND ($row['status'] == 1) ){ ?>
                                              <a  href="./index2.php?page=view_documentz&id=<?php echo md5($row['id']) ?>"  target="_blank">
                                             <span class="badge bg-secondary"><i class="bi bi-eye"></i></span>
                                            </a>
                            <?php } elseif(($_SESSION['login_type'] == 4 ) AND ($row['status'] == 2) ){ ?>
                                             <a  href="./index2.php?page=view_documentz&id=<?php echo md5($row['id']) ?>"  target="_blank">
                                             <span class="badge bg-secondary"><i class="bi bi-eye"></i></span>
                                            </a>
                            <?php } elseif(($_SESSION['login_type'] == 5 ) AND ($row['status'] == 2) ){ ?>
                                             <a  href="./index2.php?page=view_documentz&id=<?php echo md5($row['id']) ?>"  target="_blank">
                                             <span class="badge bg-secondary"><i class="bi bi-eye"></i></span>
                                            </a>
                            <?php } elseif(($_SESSION['login_type'] == 2 ) AND ($row['status'] == 2) ){ ?>
                                             <a  href="./index2.php?page=view_documentz&id=<?php echo md5($row['id']) ?>"  target="_blank" >
                                              <span class="badge bg-secondary"><i class="bi bi-eye"></i></span>
                                            </a>
                           <?php }else{ ?>
	                           <a href="./index.php?page=edit_document&id=<?php echo $row['id'] ?>" target="_blank">
		                         <span class="badge bg-primary"><i class="bi bi-slash-square"></i></span>
		                        </a>
		                        </a>
		                         &nbsp;
		                         <a onclick="return confirm('Are You Sure Want To Delete This Record!'); " href="deleteadmindocuments.php?delete_id=<?php echo $row['id'] ?>"><span class="badge bg-danger"><i class="bi bi-trash"></i> </span></a>
		                     
	                       <?php } ?>
	                       
	                       </div>
						</td>
					</tr>	      
				<?php } ?>
				</tbody>
                  </table>

                </div>

              </div>
            </div>
            
</main>

<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('#delete_document').click(function(){
	_conf("Are you sure to delete this document?","delete_document",[$(this).attr('data-id')])
	})
	})
	function delete_document($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_file',
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