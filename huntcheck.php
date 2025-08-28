<?php include'db_connect.php' ?>
 
<main>
  <div class="pagetitle">
      <h1>HUNT</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Hunt</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div>
    <!-- -------------------------------------End Page Title---------------------------------------------------------- -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css" />
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
    
  <style>
  .bootstrap-tagsinput {
   width: 100%;
  }
  </style>
  
  
    
     <div class="col-sm-12">
                 <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <span style="font-size:20px;color:#5bc0de;">Filter&nbsp;<i class="fa fa-filter" aria-hidden="true" style="font-size:20px;color:#5bc0de;"></i></span>
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse col-12" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                         
                         <div class="card">
                             <div class="card-body">
                                 <form action="huttag.php" method="post" class="row" >
                                 <label for="inputName5" class="form-label"></label>
                                <div class="col-2">
                                    <label for="inputText" class="form-label">Recruiter</label>
                                    <select class="form-select" id="floatingSelect"   name="jb_recuiters"  required>
                                        <?php 
                                      	$employees = $conn->query("SELECT *,concat(firstname ,' ', lastname) as name from users ");
                                      	while($row= $employees->fetch_assoc()){
                                      	?>
                                      	<option value="<?php echo $row['id'] ?>" <?php echo isset($jb_recuiters) && in_array($row['name'],explode(',',$jb_recuiters)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                                      	<?php } ?>
                                  </select>
                                    </div>
                                <div class="col-2">
                                    <label for="inputText" class="form-label">Skills</label>
                                    <input type="text" name="skills" class="form-control" id="tags"  data-role="tagsinput">
                                    </div>
                                <div class="col-2">
                                    <label for="inputText" class="form-label">Position</label>
                                    <input type="text" name="postion" class="form-control" id="tags"  data-role="tagsinput" >
                                    </div>
                                <div class="col-2">
                                    <label for="inputText" class="form-label">Industry</label>
                                    <input type="text" name="indistry" class="form-control" id="tags"  data-role="tagsinput" >
                                    </div>
                                <div class="col-2">
                                    <label for="inputText" class="form-label">Start Date</label>
                                    <input type="date" name="stdate" class="form-control" >
                                    </div>
                                <div class="col-2">
                                    <label for="inputText" class="form-label">End Date</label>
                                    <input type="date" name="enddate" class="form-control">
                                    </div>
                                <label for="inputName5" class="form-label"></label>
                                <div class="col-md-2">
            					    <button type="submit" name="submit" class="btn btn-info" style="left:0px;" value="Filter" />Filter&nbsp;<i class="fa fa-filter"></i></button>
            					</div>
                                 </form>   
                             </div>
                         </div>

                    </div>
                  </div>
                </div>
              </div>
     </div>
              
              
              
 
 
 

 <div class="col-sm-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <table class="table table-striped datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ref.No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Skills</th>
                        <th scope="col">Position</th>
                        <th scope="col">Industry</th>
                        <th scope="col">Phone No</th>
                        <th scope="col">Uploaded Date / Time</th>

                
                        
                      </tr>
                    </thead>
                    <?php if(isset($_POST["filter"])){ ?>
                    	<tbody id="post_list">
					<?php
					date_default_timezone_set("Asia/colombo");
					$i = 1;
					$where = '';
					if($_SESSION['login_type'] == 1 ){
					$user = $conn->query("SELECT * FROM users where id in (SELECT user_id FROM documents) ");
					while($row = $user->fetch_assoc()){
						$uname[$row['id']] = ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']);
					}
                    }else{
						$where = " where  AND user_id = '{$_SESSION['login_id']}'  ";
                    }

                     $byname = str_replace(",", "|", $_POST["byname"]);
                     $byskills = str_replace(",", "|", $_POST["byskills"]);
                     $bypostion = str_replace(",", "|", $_POST["bypostion"]);
                     $byindistry = str_replace(",", "|", $_POST["byindistry"]);
                     $bystdate = $_POST["bystdate"];
                     $byenddate = $_POST["byenddate"];

					$qry = $conn->query("SELECT * FROM documents Where status = '1' AND
				  	 concat(`title` ,' ', `last_name`) = '".$byname."'
                     AND tag REGEXP '".$byskills."' 
                     AND position REGEXP '".$bypostion."' 
                     AND industry REGEXP '".$byindistry."' 
                     AND date BETWEEN '$bystdate' AND '$byenddate'
                     order by unix_timestamp(date_created) desc ");
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
						<th class="text-center" style="font-size:12px;"><?php echo $i++ ?></th>
						<td> <a  href="./index.php?page=view_documentz&id=<?php echo $row['id']; ?>" target="_blank" ><b style="font-size:14px;"><?php echo $string; ?></b></a></td>
						<td> <a  href="./index.php?page=view_documentz&id=<?php echo $row['id']; ?>" target="_blank" ><b style="font-size:14px;"><?php echo ucwords($row['title']); ?> <?php echo ucwords($row['last_name']); ?></b></a></td>
					
					
						<td><b style="font-size:10px;"><?php echo ucwords($row['tag']); ?></b></td>
						<td><b style="font-size:10px;"><?php echo ucwords($row['position']); ?></b></td>
						<td><b style="font-size:10px;"><?php echo ucwords($row['industry']); ?></b></td>
	                    <td><b style="font-size:14px;"><?php echo ucwords($row['phonenumber']); ?></b></td>
				
				        <td><b style="font-size:14px;"><?php echo ucwords($row['date']); ?> <?php echo ucwords($row['time']); ?></b></td>
					
					</tr>	      
				<?php } ?>
				</tbody>
				
				    <?php }else{ ?>
				    
                    	<tbody id="post_list">
					<?php
					date_default_timezone_set("Asia/colombo");
					$i = 1;
					$where = '';
					if($_SESSION['login_type'] == 1 ){
					$user = $conn->query("SELECT * FROM users where id in (SELECT user_id FROM documents) ");
					while($row = $user->fetch_assoc()){
						$uname[$row['id']] = ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']);
					}
                    }else{
						$where = " where  AND user_id = '{$_SESSION['login_id']}'  ";
                    }
					$qry = $conn->query("SELECT * FROM documents Where status = '1'  order by unix_timestamp(date_created) desc ");
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
						<th class="text-center" style="font-size:12px;"><?php echo $i++ ?></th>
						<td> <a  href="./index.php?page=view_documentz&id=<?php echo $row['id']; ?>" target="_blank" ><b style="font-size:14px;"><?php echo $string; ?></b></a></td>
						<td> <a  href="./index.php?page=view_documentz&id=<?php echo $row['id']; ?>" target="_blank" ><b style="font-size:14px;"><?php echo ucwords($row['title']); ?> <?php echo ucwords($row['last_name']); ?></b></a></td>
					
					
						<td><b style="font-size:10px;"><?php echo ucwords($row['tag']); ?></b></td>
						<td><b style="font-size:10px;"><?php echo ucwords($row['position']); ?></b></td>
						<td><b style="font-size:10px;"><?php echo ucwords($row['industry']); ?></b></td>
	                    <td><b style="font-size:14px;"><?php echo ucwords($row['phonenumber']); ?></b></td>
				
				        <td><b style="font-size:14px;"><?php echo ucwords($row['date']); ?> <?php echo ucwords($row['time']); ?></b></td>
					
					</tr>	      
				<?php } ?>
				</tbody>
				    <?php } ?>
                  </table>

                </div>

              </div>
            </div>
            
</main>

</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.delete_document').click(function(){
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
