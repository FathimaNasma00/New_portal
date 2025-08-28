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
                      title: 'Activated User SuccessFull',
                      showConfirmButton: false,
                      timer: 1500
                    })
            </script>
        <?php 
        unset($_SESSION['status']);
    }

?>
 <?php 
    session_start();
    
    if(isset($_SESSION['inacstatus']))
    {
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            	Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Inactivated User SuccessFull',
                      showConfirmButton: false,
                      timer: 1500
                    })
            </script>
        <?php 
        unset($_SESSION['inacstatus']);
    }

?>

<main>
  <div class="pagetitle">
      <h1>User Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">User Management</li>
          <li class="breadcrumb-item active">User List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

 <div class="col-sm-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter justify-content-end">
                  <a class="icon d-flex justify-content-end" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Export Data</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">
                        <form method="post" action="jobmangement_export.php">
                    <button type="submit" name="export" class="btn btn-success" /><span class="badge bg-success">export</span></button>
                 </form>
                        
                        </a></li>
      
                  </ul>
                </div>

                <div class="card-body">
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Recruiter</th>
                        <th scope="col">Role</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Join Date</th>
                        <th scope="col">User Type</th>
                         <?php if($_SESSION['login_type']==1){ ?>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                    		$i = 1;
					$type = array('',"Super Admin","User","Admin","Freelacer","Temporary User");
					$qry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users Group by  concat(lastname,', ',firstname,' ',middlename)  order by concat(lastname,', ',firstname,' ',middlename) asc");
					while($row= $qry->fetch_assoc()){
                      
                    ?>
					<tr>
						<th scope="row"><?php echo $i++; ?></th>
						<!--<td><a target= "_blank" href="./index.php?page=view_user&id=<?php echo $row['id']; ?>"><?php  echo $row["name"]; ?></a></td>-->
                        <td><a target= "_blank" href="./index2.php?page=edit_user&id=<?php echo $row['id']; ?>"><?php  echo $row["name"]; ?></a></td>
                        <td><?php echo $row["contact"]; ?></td>
                        <td><?php echo $row["recruiter"]; ?></td>
                        <td><?php echo $type[$row['type']]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["join_date"]; ?></td>
                         <td><?php echo $row["user_type"]; ?></td>
              
                       
                    <?php
                        if($_SESSION['login_type']==1){
                        ?>
                        <td>
                        <?php
                         $id=$row["id"];
                         $st=$row["status"];
                         $by=$_SESSION['login_id'];
                        if($row["active"]==1){
                                echo'<p><a href ="user_deactivate.php?inac_id='.$id.'&status=0&accesby='.$by.'" class="btn  btn-success">Active</a></p>';
                            }else{
                                 echo'<p><a href ="user_activate.php?ac_id='.$id.'&status=1&accesby='.$by.'" class="btn  btn-danger">INACTIVE</a></p>';
                            }
                        ?>
                        </td>
                        <td><a class="dropdown-item view_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="badge bg-secondary"><i class="bi bi-eye"></i></span></a>
                            <a class="dropdown-item" href="./index2.php?page=edit_user&id=<?php echo $row['id'] ?>"><span class="badge bg-primary"><i class="bi bi-slash-square"></i></span></a>
                            <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="badge bg-danger"><i class="bi bi-trash"></i> </span></a>
                           
                        </td>
                      </tr>
                      <?php
                 }
                     
                 }
						?>
                      
  
                     
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            
</main>

<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_user').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> User Details","view_user.php?id="+$(this).attr('data-id'))
	})
	$('.delete_user').click(function(){
	_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
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