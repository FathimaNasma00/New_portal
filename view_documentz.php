<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM documents where id = '{$_GET['id']}' ")->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title')
		$k = 'ftitle';
	$$k = $v;
}
?>
<!-------------------------------------------------------- DETAILS VIEW-------------------------------------------------------------------->
<div class="col-lg-12">
    
					    <div class="card card-outline card-info">
					    <div class="col-md-12">
					    
					<div class="callout callout-info">
					  <div class="card-header">
					<div class="card-tools">
						<small class="text-muted">
							Details of Applicant
						</small>
					</div>
				</div>
				<div class="card-header">
					<div class="card-tools">
						<dl>
						    <dd style="font-size:13px;font-weight:bold;" >Ref.No &nbsp;:&nbsp; 
						    <?php  
						    	if($ref_no <= 99){
            						$recq=$recruiter;
            						$reqanswr=$recq."00".$ref_no;
            						$string = str_replace(' ','',$reqanswr);
            						}else{
            						 $recq=$recruiter;
            						$reqanswr=$recq."0".$ref_no;
            						$string = str_replace(' ','',$reqanswr);
            						}
						    echo $string;
						    ?></dd>
							<dd style="font-size:13px;font-weight:bold;" >Name &nbsp;:&nbsp; <?php echo $ftitle ?> <?php echo $last_name ?></dd>
							<dd style="font-size:13px;font-weight:bold;" >Gender &nbsp;:&nbsp; <?php echo $gender ?></dd>
							<dd style="font-size:13px;font-weight:bold;" >Phone Number &nbsp;:&nbsp;<?php echo html_entity_decode($phonenumber) ?></dd>
							<dd style="font-size:13px;font-weight:bold;" >Email &nbsp;:&nbsp; <?php echo html_entity_decode($email) ?></dd>
                            <dd style="font-size:13px;font-weight:bold;" >Address &nbsp;:&nbsp; <?php echo html_entity_decode($home_address) ?></dd>
                            <dd style="font-size:13px;font-weight:bold;" >Home Town &nbsp;:&nbsp; <?php echo html_entity_decode($home_town) ?></dd>
                            <dd style="font-size:13px;font-weight:bold;" >Total Years of experience &nbsp;:&nbsp; <?php echo html_entity_decode($years_of_experience) ?></dd>
                            <dd style="font-size:13px;font-weight:bold;" >Experience &nbsp;:&nbsp; <?php echo html_entity_decode($experience) ?></dd>
                            <dd style="font-size:13px;font-weight:bold;" >Education &nbsp;:&nbsp; <?php echo html_entity_decode($education) ?></dd>
                            <dd style="font-size:13px;font-weight:bold;" >Social Media &nbsp;:&nbsp; <a href="<?php echo $linkedIn_link; ?>" target="_blank"><?php echo html_entity_decode($linkedIn_link) ?></a></dd>
							<dd style="font-size:13px;font-weight:bold;" >Skills &nbsp;:&nbsp; <?php echo html_entity_decode($tag) ?></dd>
							<dd style="font-size:13px;font-weight:bold;" >Summary &nbsp;:&nbsp; <?php echo html_entity_decode($description) ?></dd>
							<dd style="font-size:13px;font-weight:bold;" >Recruiter &nbsp;:&nbsp; <?php echo html_entity_decode($recruiter) ?></dd>
							<dd style="font-size:13px;font-weight:bold;" >Uploded Date & Time &nbsp;:&nbsp; <?php echo html_entity_decode($date_created) ?></dd>
						</dl>
						</div>
						</div>
					</div>
					</div>
					</div>
				
</div>
<!----------------------------------------------------------END View ---------------------------------------------------------------------->

<!------------------------------------------------------------Duplication Views------------------------------------------------------------------->

<!--------------------------------------------------------ENd Duplications------------------------------------------------------------------------------>

<!-------------------------------------------------------- LATEST FEEDBACK VIEW-------------------------------------------------------------------->
<div class="col-lg-12">
    <!----------------------------------------------------------Latest Update Feedback--------------------------------------------------->
	  <?php 
          $candidateHis = "SELECT documents.recruiter, documents.title, documents.last_name, documents.ref_no, documents.accesby, documents.status, documents.reject_resons, documents.date AS Ddate, users.recruiter AS acces, candidate_summery.feedback,candidate_summery.id AS can_id, candidate_summery.date AS summery_date, candidate_summery.recuiter AS summery_recuiter, clintmanege.clint_name
                          FROM documents
                          LEFT JOIN users ON (documents.accesby = users.id)
                          LEFT JOIN candidate_summery ON (documents.id = candidate_summery.application_id)
                          LEFT JOIN clintmanege ON (candidate_summery.clint_id = clintmanege.clint_id)
                          WHERE documents.id = '{$_GET['id']}' ORDER BY candidate_summery.id DESC LIMIT 1";

          $candidate_His = mysqli_query($conn, $candidateHis);
          
          while ($rowz = mysqli_fetch_assoc($candidate_His)) {
        ?>
        <div class="col-12">
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
                <i class="bi bi-folder me-1"></i>
                Latest Feedback :  <a style='text-decoration: none;' target='_blank' href='index2.php?page=edite_candidate&id=<?php echo $rowz['can_id']; ?>'>
             <?php $feed = $rowz['feedback'];
                $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $feed); 
                echo $words; ?></a>
                &nbsp;&nbsp;&nbsp;&nbsp;
              <i class="bi bi-person-circle"></i> <?php echo " : ". $rowz['clint_name']; ?> &nbsp;&nbsp;
               <i class="bi bi-calendar-check-fill"></i><?php echo " : ". $rowz['summery_date']; ?> &nbsp;&nbsp;
              <i class="bi bi-person-check"></i>  <?php echo " : ". $rowz['summery_recuiter']; ?>
                
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>
        
        <?php } ?>
	<!-----------------------------------------------------------Latest Feedback End---------------------------------------------------->
</div>
<!----------------------------------------------------------Latest feedback END View ---------------------------------------------------------------------->
<div class="row">
    <div class="col-lg-9">
        
			<div class="card card-outline card-info">
				<div class="card-header">
					<div class="card-tools">
						<small class="text-muted">
							Date Uploaded: <?php echo date("M d, Y",strtotime($date_created)) ?>
						</small>
					</div>
				</div><br>
				<div  class="card-body">
				    <div id="vk_pdf_viewer">
                         <table width="100%" border="0">
                      <tr>
                        <td align="left">
                        <div id="navigation_controls">
                                <button id="go_previous" class="Previous"><span>Previous </span></button>
                                <input id="current_page" value="1" type="text" readonly="true"/>
                                <button id="go_next" class="Next"><span>Next </span></button>
                            </div>
                            </td>
                             <td>
                                	
			  <?php if($_SESSION['login_type'] == 1){?>
			 <div class="">
				<div class="">
                   <?php
                    $id=html_entity_decode($id);
                    $st=html_entity_decode($status);
                    $by=$_SESSION['login_id'];
                            echo'
                            <div class=row>
                            <div class="col-2"><p><a href ="status.php?d_id='.$id.'&status=1&accesby='.$by.'" class="btn btn-success"><i    class="bi bi-check" aria-hidden="true"></i></a></p></div>
                            <div class="col-2">&nbsp; </div>
                            <div class="col-2"><p><a href ="document_reject.php?d_id='.$id.'&status=2&accesby='.$by.'" class="btn btn-danger"><i   class="bi bi-backspace" aria-hidden="true"></i></a></p></div>
                            </div>';
                   
            
                       
                    ?>
                </div>
                </div>
        
                <?php }elseif($_SESSION['login_type'] == 3){ ?>
              <div class="">
				<div class="">
                   <?php
                    $id=html_entity_decode($id);
                    $st=html_entity_decode($status);
                    $by=$_SESSION['login_id'];
                            echo'
                            <div class=row>
                            <div class="col-2"><p><a href ="status.php?d_id='.$id.'&status=1&accesby='.$by.'" class="btn btn-success"><i    class="bi bi-check" aria-hidden="true"></i></a></p></div>
                            <div class="col-2">&nbsp; </div>
                            <div class="col-2"><p><a href ="document_reject.php?d_id='.$id.'&status=2&accesby='.$by.'" class="btn btn-danger"><i   class="bi bi-backspace" aria-hidden="true"></i></a></p></div>
                            </div>';
                   
            
                       
                    ?>
                </div>
                </div>
                <?php }elseif($_SESSION['login_type'] == 4){ ?>
              <div class="">
				<div class="">
                   <?php
                    $id=html_entity_decode($id);
                    $st=html_entity_decode($status);
                    $by=$_SESSION['login_id'];
                            echo'
                            <div class=row>
                            <div class="col-2"><p><a href ="status.php?d_id='.$id.'&status=1&accesby='.$by.'" class="btn btn-success"><i    class="bi bi-check" aria-hidden="true"></i></a></p></div>
                            <div class="col-2">&nbsp; </div>
                            <div class="col-2"><p><a href ="document_reject.php?d_id='.$id.'&status=2&accesby='.$by.'" class="btn btn-danger"><i   class="bi bi-backspace" aria-hidden="true"></i></a></p></div>
                            </div>';
                   
            
                       
                    ?>
                </div>
                </div>
                <?php } ?>
                                
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>
                              <div class="row">
							 <?php
					            if(isset($file_json) && !empty($file_json)){
					                $ip_address = $_SERVER['REMOTE_ADDR'];
                                    $file_downloads = [];
                                    
					              foreach(json_decode($file_json) as $k => $v){
					                if(is_file('assets/uploads/'.$v)){
					                $_f = file_get_contents('assets/uploads/'.$v);
					                $dname = explode('_', $v);
                                    $filepdf=$v;
					         ?>
		 
							<div class="col-sm-6">
								<a href="assets/uploads/<?php echo $v ?>" target="_blank" class="text-white border-rounded" id="download_link_<?php echo $v ?>">
			                   <i style="color:#007bff; font-size:30px;" class="ri-download-2-fill"></i></a>
							</div>
							 <?php }?>
					         <?php } ?>
					         <?php } ?>
					         <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach (json_decode($file_json) as $k => $v) { ?>
            var downloadLink = document.getElementById('download_link_<?php echo $v ?>');
            downloadLink.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default behavior of the link
                var fileId = <?php echo $file_id; ?>; // Replace with the actual file ID
                var downloadCount = <?php echo isset($file_downloads[$v]) ? $file_downloads[$v] : 0; ?>;
                var ipAddress = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
                var userid = "<?php echo $_SESSION['login_id']; ?>";

                // Make an AJAX request to update the download count
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_download_count.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Update the download count in the UI
                        downloadCount++;
                        var countElement = downloadLink.querySelector('.download-count');
                        if (countElement) {
                            countElement.textContent = 'Downloads: ' + downloadCount;
                        }
                    }
                };
                xhr.send('fileId=' + fileId + '&downloadCount=' + downloadCount + '&ipAddress=' + ipAddress + '&userid=' + userid);
            });
        <?php } ?>
    });
</script>

						</div>  
                            </td>
                        <td align="right">
                        <div id="zoom_controls">  
                                <button id="zoom_in" class="zoom">+</button>
                                <button id="zoom_out" class="zoom">-</button>
                            </div>
                        </td>
                      </tr>
                    </table>
                    <div id="canvas_container">
                        <canvas id="pdf_renderer"></canvas>    
                    </div>
                </div>
				</div>
			</div>
    </div>
    
<!-----------------------------------------------------------------------CV VIEWS------------------------------------------------------------------------ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
<style type="text/css">
    #vk_pdf_viewer{
        width: 605px;
        margin: auto;
        height: auto;
    }
    #canvas_container{
        width: 602px;
        margin: auto;
        height: auto;
        overflow: auto;
        background: #333;
        text-align: center;
        border: solid 3px #007bff;
        border-radius: 5px;
    }
    #current_page{
        width: 30px;
        height: 21px;
        border-radius: 0px;
        border: 2px solid #007bff;
        text-align: center;
         border-radius: 5px;
    }
    .zoom{
        background-color: #007bff;
        border: none;
        color: #FFFFFF;
        text-align: center;
        transition: all 0.5s;
        cursor: pointer;
        padding: 5px;
        width: 30px;
         border-radius: 5px;
    }
    .Previous {
  background-color: #007bff;
  border: none;
  color: #FFFFFF;
  text-align: center;
  transition: all 0.5s;
  cursor: pointer;
  padding: 5px;
  width: 90px;
 border-radius: 5px;
}

.Previous span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.Previous span:after {
  content: '\00ab';
  position: absolute;
  opacity: 0;
  top: 0;
  left: -65px;
  transition: 0.5s;
}

.Previous:hover span {
  padding-left: 15px;
}
.Previous:hover span:after{
    opacity: 1;
    right: 0;
}

.Next {
  background-color: #007bff;
  border: none;
  color: #FFFFFF;
  text-align: center;
  transition: all 0.5s;
  cursor: pointer;
  padding: 5px;
  width: 90px;
     border-radius: 5px;
}

.Next span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.Next span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.Next:hover span {
  padding-right: 25px;
}
.Next:hover span:after{
    opacity: 1;
    right: 0;
}
</style>
               
                     
                <script type="text/javascript">
  var myState = {
    pdf:null,
    currentPage:1,
    zoom:1
  }  
  var pdfjsLib = window['pdfjs-dist/build/pdf'];

  //get pdf file
  pdfjsLib.getDocument('assets/uploads/<?php echo $v ?>').then((pdf) => {
    myState.pdf = pdf;
    render();

  }); 
//pdf page previous & next function
document.getElementById('go_previous').addEventListener('click', (e) =>{
    if(myState.pdf == null || myState.currentPage == 1)
        return;
    myState.currentPage -=1;
    document.getElementById('current_page').value = myState.currentPage;
    render();

});
document.getElementById('go_next').addEventListener('click', (e) =>{
    if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages)
        return;
    myState.currentPage +=1;
    document.getElementById('current_page').value = myState.currentPage;
    render();

});


//current page function
document.getElementById('current_page').addEventListener('keypress', (e) => {
    if(myState.pdf == null) return;
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13){
        var desiredPage = document.getElementById('current_page').valueAsNumber;
        if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages){
            myState.currentPage = desiredPage;
            document.getElementById("current_page").value=desiredPage;
            render();

        }

    }

});


// zoom in & out function
document.getElementById('zoom_in').addEventListener( 'click',(e) => {
    if(myState.pdf == null) return;
    myState.zoom += 0.5;
    render();
});
document.getElementById('zoom_out').addEventListener( 'click',(e) => {
    if(myState.pdf == null) return;
    myState.zoom -= 0.5;
    render();
});


  // pdf file render function
 function render(){
    myState.pdf.getPage(myState.currentPage).then((page) => {
        var canvas = document.getElementById("pdf_renderer");
        var ctx = canvas.getContext('2d');
        var viewport = page.getViewport(myState.zoom);
        canvas.width = viewport.width;
        canvas.height = viewport.height;

        page.render({
            canvasContext:ctx,
            viewport:viewport
        });

    });

 }
</script>
 <div class="col-lg-3">
        
                    	      <div class="card card-outline card-primary">
		        <div class="card-header">
					<h5 style="text-align:center;"><b>COMMENT SECTION</b></h5>
				</div>
		        <div class="">
                    <div class="card">
		             <?php
                    date_default_timezone_set("Asia/colombo");
                    $logidz = $_SESSION['login_id'];
                    $date = date("Y-m-d");                   
                    $query="SELECT comment.id,comment.file_id,comment.comment,comment.date,comment.recuiter,users.recruiter FROM comment 
                            INNER JOIN documents ON ( `documents`.`id`=`comment`.`file_id`) INNER JOIN users ON ( `comment`.`recuiter`=`users`.`id`) WHERE comment.file_id='{$_GET['id']}'";
                    $result = mysqli_query($conn,$query);
                    while($row=$result->fetch_object()){ 
                     $recuitercom= $row->recuiter;
                     $file_id= $row->file_id;
                    ?>
                    
     
                    
					<div class="callout callout-info">
					   
					    <div class="card-header">
				    	<div class="card-tools">
					    
						<dl>
							<dt style="font-size:12px;"><i class="ri-calendar-fill"></i>&nbsp; : &nbsp;<?php echo $row->date; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="ri-map-pin-user-fill" ></i> &nbsp; : &nbsp;<?php echo $row->recruiter; ?> 
							        
					
		                        </dt>
							<dd><i class="ri-todo-fill" aria-hidden="true"></i> &nbsp; : &nbsp;<?php echo $row->comment;?></dd>
								 <?php if(($row->recuiter == $logidz)){ ?>
							      <dd> 
							      <div style="text-align:center;">
                                   <a onclick="return confirm('Are You Sure Want To Delete This Comment!'); " class="btn  btn-flat" href="comment_delete.php?d_id=<?php echo $row->id; ?>&file_id=<?php echo $row->file_id; ?>" ><i style="color:red;font-size:16px;" class="ri-delete-bin-5-fill"></i></a>
							     </div>
							    </dd>
		                        <?php } ?>
						</dl>
						</div>
						</div>
						
					</div>
				
					  <?php } ?>
					
				</div>
			
		        	<form action="" id="comment-upload">
		        	     <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		        	     
		        	     <div class="card-body">
		        	 <div class="callout callout-info">
						<dl>
							<dt>Add Comment</dt>
							<dd><textarea name="comment" id="comment" cols="6" required rows="4" class=" form-control">
							</textarea></dd>
							
						</dl>
						<div class="d-flex w-100 justify-content-center align-items-center">
                                        <button class="btn btn-primary  bg-gradient-primary mx-2" form="comment-upload">Save</button>
                                    </div>
						
					</div>
				
		        	     </div>
		        	 </form>
		   </div>
                    	</div>
    </div>
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

<script>
	$('#comment-upload').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=comment_upload',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Comment successfully saved',"success");
					setTimeout(function(){
						location.href = 'index2.php?page=view_documentz&id=<?php echo $id ?>'
					},2000)
				}
			}
		})
	})
</script>
</div>
<!-------------------------------------------------------------------------------end CV view------------------------------------------------------------------------->
<!-------------------------------------------------------------Roadmap---------------------------------------------------------------------------------------->

 <style>
 .main-timeline {
  font-family: tahoma;
  padding: 20px 0;
  position: relative;
}

.main-timeline::before,
.main-timeline::after {
  content: "";
  height: 40px;
  width: 40px;
  background-color: #e7e7e7;
  border-radius: 50%;
  border: 10px solid #303334;
  transform: translatex(-50%);
  position: absolute;
  left: 50%;
  top: -15px;
  z-index: 2;
}

.main-timeline::after {
  top: auto;
  bottom: 15px;
}

.main-timeline .timeline {
  padding: 28px 0;
  margin-top: -30px;
  position: relative;
  z-index: 1;
}

.main-timeline .timeline::before,
.main-timeline .timeline::after {
  content: "";
  height: 100%;
  width: 50%;
  border-radius: 110px 0 0 110px;
  border: 15px solid #46b2bc;
  border-right: none;
  position: absolute;
  left: 0;
  top: 0;
  z-index: -1;
}

.main-timeline .timeline::after {
  height: calc(100% - 30px);
  width: calc(50% - 12px);
  border-color: #65c7d0;
  left: 12px;
  top: 15px;
}

.main-timeline .timeline-content {
  display: inline-block;
}

.main-timeline .timeline-content:hover {
  text-decoration: none;
}

.main-timeline .timeline-year {
  color: #65c7d0;
  font-size: 20px;
  font-weight: 600;
  display: inline-block;
  transform: translatey(-50%);
  position: absolute;
  top: 50%;
  left: 10%;
}

.main-timeline .timeline-icon {
    color: #65c7d0;
    font-size: 70px;
    display: inline-block;
    transform: translateY(-50%);
    position: absolute;
    left: 34%;
    top: 50%;
}

.main-timeline .content {
  color: #909090;
  padding: 20px;
  display: inline-block;
  float: right;
}

.main-timeline .title {
  color: #65c7d0;
  font-size: 20px;
  font-weight: 600;
  text-transform: uppercase;
  margin: 0 0 5px 0;
}

.main-timeline .description {
  font-size: 16px;
  margin: 0;
}

.main-timeline .timeline:nth-child(even)::before {
  left: auto;
  right: 0;
  border-radius: 0 110px 110px 0;
  border: 15px solid red;
  border-left: none;
}

.main-timeline .timeline:nth-child(even)::after {
  left: auto;
  right: 12px;
  border-radius: 0 100px 100px 0;
  border: 15px solid green;
  border-left: none;
}

.main-timeline .timeline:nth-child(even) .content {
  float: left;
}

.main-timeline .timeline:nth-child(even) .timeline-year {
    left: auto;
    right: 10%;
}

.main-timeline .timeline:nth-child(even) .timeline-icon {
  left: auto;
  right: 32%;
}

.main-timeline .timeline:nth-child(5n+1)::before {
  border-color: #46b2bc;
}

.main-timeline .timeline:nth-child(5n+1)::after {
  border-color: #65c7d0;
}

.main-timeline .timeline:nth-child(5n+1) .timeline-icon {
  color: #65c7d0;
}

.main-timeline .timeline:nth-child(5n+1) .timeline-year {
  color: #65c7d0;
}

.main-timeline .timeline:nth-child(5n+1) .title {
  color: #65c7d0;
}

.main-timeline .timeline:nth-child(5n+2)::before {
  border-color: #ea3c14;
}

.main-timeline .timeline:nth-child(5n+2)::after {
  border-color: #EF5720;
}

.main-timeline .timeline:nth-child(5n+2) .timeline-icon {
  color: #EA3C14;
}

.main-timeline .timeline:nth-child(5n+2) .timeline-year {
  color: #EA3C14;
}

.main-timeline .timeline:nth-child(5n+2) .title {
  color: #EA3C14;
}

.main-timeline .timeline:nth-child(5n+3)::before {
  border-color: #8CC63E;
}

.main-timeline .timeline:nth-child(5n+3)::after {
  border-color: #6CAF29;
}

.main-timeline .timeline:nth-child(5n+3) .timeline-icon
{
  color: #8CC63E;
}

.main-timeline .timeline:nth-child(5n+3) .timeline-year {
  color: #8CC63E;
}

.main-timeline .timeline:nth-child(5n+3) .title {
  color: #8CC63E;
}

.main-timeline .timeline:nth-child(5n+4)::before {
  border-color: #F99324;
}

.main-timeline .timeline:nth-child(5n+4)::after {
  border-color: #FBB03B;
}

.main-timeline .timeline:nth-child(5n+4) .timeline-icon {
  color: #F99324;
}

.main-timeline .timeline:nth-child(5n+4) .timeline-year {
  color: #F99324;
}

.main-timeline .timeline:nth-child(5n+4) .title {
  color: #F99324;
}

.main-timeline .timeline:nth-child(5n+5)::before {
  border-color: #0071BD;
}

.main-timeline .timeline:nth-child(5n+5)::after {
  border-color: #0050A3;
}

.main-timeline .timeline:nth-child(5n+5) .timeline-icon {
  color: #0071BD;
}

.main-timeline .timeline:nth-child(5n+5) .timeline-year {
  color: #0071BD;
}

.main-timeline .timeline:nth-child(5n+5) .title {
  color: #0071BD;
}

@media screen and (max-width:1200px){
    .main-timeline .timeline:after{ border-radius: 88px 0 0 88px; }
    .main-timeline .timeline:nth-child(even):after{ border-radius: 0 88px 88px 0; }
}
@media screen and (max-width:767px){
    .main-timeline .timeline{ margin-top: -19px; }
    .main-timeline .timeline:before {
        border-radius: 50px 0 0 50px;
        border-width: 10px;
    }
    .main-timeline .timeline:after {
        height: calc(100% - 18px);
        width: calc(50% - 9px);
        border-radius: 43px 0 0 43px;
        border-width:10px;
        top: 9px;
        left: 9px;
    }
    .main-timeline .timeline:nth-child(even):before {
        border-radius: 0 50px 50px 0;
        border-width: 10px;
    }
    .main-timeline .timeline:nth-child(even):after {
        height: calc(100% - 18px);
        width: calc(50% - 9px);
        border-radius: 0 43px 43px 0;
        border-width: 10px;
        top: 9px;
        right: 9px;
    }
    .main-timeline .timeline-icon{ font-size: 60px; }
    .main-timeline .timeline-year{ font-size: 40px; }
}
@media screen and (max-width:479px){
    .main-timeline .timeline-icon{
        font-size: 50px;
        transform:translateY(0);
        top: 25%;
        left: 10%;
    }
    .main-timeline .timeline-year{
        font-size: 25px;
        transform:translateY(0);
        top: 65%;
        left: 9%;
    }
    .main-timeline .content{
        width: 68%;
        padding: 10px;
    }
    .main-timeline .title{ font-size: 18px; }
    .main-timeline .timeline:nth-child(even) .timeline-icon{
        right: 10%;
    }
    .main-timeline .timeline:nth-child(even) .timeline-year{
        right: 9%;
    }
}    
 </style>
<div class="col-lg-9">
    
                        <!---->
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php 
						        $candidateHis=" SELECT DISTINCT documents.recruiter,documents.title,documents.last_name,documents.ref_no,documents.accesby,documents.date as Ddate,status.status 
						                        FROM documents
                         INNER                  JOIN status ON (documents.status = status.status_id)
                         WHERE                  documents.id = '{$_GET['id']}' ";
                                        
                                    $candidate_His = mysqli_query($conn, $candidateHis);
                                    foreach($candidate_His as $rowz){
                                        $firstname = $rowz['title'];
                                        $lasttname = $rowz['last_name'];
                                    }
                                 ?>
                               
                                         <h4 align="center" class="panel-title">History Road Map of <?php echo $firstname ." ". $lasttname; ?> 
                                         <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">+</button>-->
                                         </h4><br><br>
                               
                         </div> 
                     </div> 
                        <!----------------------------------------------Current Data------------------------------------------>
              
				     <div class="container">
                        <div class="row">
    <div class="col">
      <div class="main-timeline">

  <?php 
          $candidateHis = "SELECT DISTINCT documents.id AS docid,documents.recruiter, documents.title, documents.last_name, documents.ref_no, documents.accesby, documents.status, documents.reject_resons, documents.date AS Ddate, users.recruiter AS acces,candidate_summery.feedback,candidate_summery.id AS can_id, candidate_summery.date AS summery_date, candidate_summery.recuiter AS summery_recuiter, clintmanege.clint_name
                          FROM documents
                          INNER JOIN users ON (documents.user_id = users.id)
                          LEFT JOIN candidate_summery ON (documents.id = candidate_summery.application_id)
                          LEFT JOIN clintmanege ON (candidate_summery.clint_id = clintmanege.clint_id)
                         
                          WHERE documents.id = '{$_GET['id']}' Order By candidate_summery.id DESC ";

          $candidate_His = mysqli_query($conn, $candidateHis);
          
          while ($rowz = mysqli_fetch_assoc($candidate_His)) {
        ?>         
          
      
        <div class="timeline">
          <a target='_blank' href="./index2.php?page=edite_candidate&id=<?php echo $rowz['can_id']; ?>&logid=<?php echo $rowz['docid']; ?>" class="timeline-content">
            <span class="timeline-year">
                <?php 
                $feed = $rowz['feedback'];
                $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $feed);
                echo $words; 
                ?>
                <span style="color: gray; font-size: 10px;margin-botton:10%;">
                <?php echo "Client : ". $rowz['clint_name']; ?> &nbsp;&nbsp;
               <?php echo "Date : ". $rowz['summery_date']; ?> &nbsp;&nbsp;
               <?php echo "By : ". $rowz['summery_recuiter']; ?>&nbsp;&nbsp;
               
               <!--<a href="deletecandidate.php?cand_id=<?php echo $rowz['can_id']; ?>&logid=<?php echo $_GET['id']; ?>" onclick="return confirm('Are You Sure Want To Delete This Record!'); " ><i class="bi bi-trash-fill"></i></a>-->
               
                </span>
            </span>
            <div class="timeline-icon">
              <i class="fa fa-rocket" aria-hidden="true"></i>
            </div>
            <div class="content">
              <h3 class="title"></h3>
              <p class="description">
              
              </p>
            </div>
          </a>
        </div>
 
     
     <?php } ?>
     <!----------------------------------------------Current Data------------------------------------------>
         <!----------------------------------------------History Data------------------------------------------>
              
				 

  <?php 
          $candidateHis = "SELECT documents.id AS docid,documents.recruiter, documents.title, documents.last_name, documents.ref_no, documents.accesby, documents.status, documents.reject_resons, documents.date AS Ddate, users.recruiter AS acces,candidate_summeryhistory.feedback,candidate_summeryhistory.id AS can_id, candidate_summeryhistory.date AS summery_date, candidate_summeryhistory.recuiter AS summery_recuiter, clintmanege.clint_name
                          FROM documents
                          INNER JOIN users ON (documents.user_id = users.id)
                          LEFT JOIN candidate_summeryhistory ON (documents.id = candidate_summeryhistory.application_id)
                          LEFT JOIN clintmanege ON (candidate_summeryhistory.clint_id = clintmanege.clint_id)
                         
                          WHERE documents.id = '{$_GET['id']}' Order By candidate_summeryhistory.date DESC ";

          $candidate_His = mysqli_query($conn, $candidateHis);
          
             while ($rowz = mysqli_fetch_assoc($candidate_His)) {
        if(isset($rowz['can_id'])) { // Check if 'can_id' is set
?>
            <div class="timeline">
                <a target='_blank' href="./index2.php?page=edite_candidate&id=<?php echo $rowz['can_id']; ?>&logid=<?php echo $rowz['docid']; ?>" class="timeline-content">
                    <span class="timeline-year">
                        <?php 
                            $feed = $rowz['feedback'];
                            $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $feed);
                            echo $words; 
                        ?>
                        <span style="color: gray; font-size: 10px;margin-botton:10%;">
                            <?php echo "Client : ". $rowz['clint_name']; ?> &nbsp;&nbsp;
                            <?php echo "Date : ". $rowz['summery_date']; ?> &nbsp;&nbsp;
                            <?php echo "By : ". $rowz['summery_recuiter']; ?>&nbsp;&nbsp;
                        </span>
                    </span>
                    <div class="timeline-icon">
                        <i class="fa fa-rocket" aria-hidden="true"></i>
                    </div>
                    <div class="content">
                        <h3 class="title"></h3>
                        <p class="description">
                        
                        </p>
                    </div>
                </a>
            </div>
<?php 
        } // End of if(isset($rowz['can_id']))
    } // End of while loop
?>
       <!----------------------------------------------History Data End------------------------------------------>
       <?php 
          $candidateHis = "SELECT documents.recruiter, documents.title, documents.last_name, documents.ref_no, documents.accesby, documents.status, documents.reject_resons, documents.date AS Ddate, users.recruiter AS acces ,concat(users.firstname, ' ',users.lastname) as name
                          FROM documents
                          INNER JOIN users ON (documents.accesby = users.id)
                          WHERE documents.id = '{$_GET['id']}'";

          $candidate_His = mysqli_query($conn, $candidateHis);
          
          while ($rowz = mysqli_fetch_assoc($candidate_His)) {
        ?>  
          
        <div class="timeline">
          <a href="#" class="timeline-content">
            <span class="timeline-year">
                <?php  
                  $st = $rowz['status']; 
                  if ($st == 1) {
                    echo '<span class="badge bg-success">APPROVED</span>';
                  } elseif ($st == 0) {
                    echo '<span class="badge bg-warning">PENDING</span>';
                  } elseif ($st == 2) {
                    echo '<span class="badge bg-danger">REJECTED</span>';
                  }
                ?>
                &nbsp;&nbsp;<span style="color: gray; font-size: 10px;"> By :</span> &nbsp;<span style="color: gray; font-size: 10px;"> <?php echo $rowz['name']; ?></span>
                  <p style="color: gray;font-size: 10px;"><?php echo $rowz['reject_resons']; ?></p>
            </span>
            <div class="timeline-icon">
              <i class="fa fa-rocket" aria-hidden="true"></i>
            </div>
            <div class="content">
              <h3 class="title"></h3>
              <p class="description">
               
              </p>
            </div>
          </a>
        </div>
  <?php } ?>
       
       
      </div>
    </div>
  </div>
                        </div>   
    
</div>
<!----------------------------------------------------------------------End Roadmaps---------------------------------------------------------------------------->
<!--------------------------------------------------------------------Candate---------------------------------------------------------------------------->
<div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Candidate Summary</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     
			            <form action="" id="upload_candidate">
                <input type="hidden" name="sesid" value="<?php echo $_SESSION['login_id']; ?> ">
             
                
                <div class="row ">
					<div class="col-md-10">
						<div class="form-group">
                              <label for="inputText" class="form-label"><span class="required">*</span> Client</label>
                            <select class="form-control form-control-sm "  required name="clints">
                            <option></option>
                            <?php 
                            $employees = $conn->query("SELECT * FROM clintmanege order by clint_id asc ");
                            while($row= $employees->fetch_assoc()){
                            ?>
                                
                             <option value="<?php echo $row['clint_id'] ?>" <?php echo isset($clints) && in_array($row['clint_id'],explode(',',$clints)) ? "selected" : '' ?>>
                            <?php echo ucwords($row['clint_name']) ?>
                              
                              </option>
                                
    
                            <?php } ?>
                          </select>
                            
						</div>
						
						
					</div>
				</div>
				<input type="hidden" value="<?php echo $_GET['id']; ?>" name="appli_ids" id="appli_ids">
                 <div class="row">
					<div class="col-md-12">
						<div class="form-group">
						    <label for="inputText" class="form-label"><span class="required">*</span> Feedback</label>
								<select name="feedback" id="feedback" required class="custom-select form-control custom-select-sm  feedback">
								<option value="<?php if(isset($_GET['feedback'])){echo $_GET['feedback'];}else{} ?>"></option>
							<option value="SentForClientReview" <?php echo isset($feedback) && $feedback == "SentForClientReview" ? 'selected' : '' ?>>Sent For Client Review</option>
                            <option value="PendingReview" <?php echo isset($feedback) && $feedback == "PendingReview" ? 'selected' : '' ?>>Pending Review</option>
                                    
                            <option value="CVRejected" <?php echo isset($feedback) && $feedback == "CVRejected" ? 'selected' : '' ?>>CV Rejected</option>
                                    
                             <option value="CandidateNotResponding" <?php echo isset($feedback) && $feedback == "CandidateNotResponding" ? 'selected' : '' ?>>Candidate Not Responding</option>
                             
                             <option value="CandidateDidNotParticipateForTheInterview" <?php echo isset($feedback) && $feedback == "CandidateDidNotParticipateForTheInterview" ? 'selected' : '' ?>>Candidate Did Not Participate For The Interview</option>
                                    
                             <option value="InterviewScheduled" <?php echo isset($feedback) && $feedback == "InterviewScheduled" ? 'selected' : '' ?>>Interview Scheduled</option>
                                    
                             <option value="ParticipatedForInterview " <?php echo isset($feedback) && $feedback == "ParticipatedForInterview" ? 'selected' : '' ?>>Participated For Interview</option>
                             
                             <option value="YettoSchedule" <?php echo isset($feedback) && $feedback == "YettoSchedule" ? 'selected' : '' ?>>Yet to Schedule</option>       
                                    
                             <option value="L1Rejected" <?php echo isset($feedback) && $feedback == "L1Rejected" ? 'selected' : '' ?>>L1 Rejected</option>
                                    
                                    
                             <option value="L2Rejected" <?php echo isset($feedback) && $feedback == "L2Rejected" ? 'selected' : '' ?>> L2 Rejected</option>
                                    
                                    
                             <option value="L3Rejected" <?php echo isset($feedback) && $feedback == "L3Rejected" ? 'selected' : '' ?>>L3 Rejected</option>
                             
                             
                              <option value="L1Selected" <?php echo isset($feedback) && $feedback == "L1Selected" ? 'selected' : '' ?>>L1 Selected</option>
                                    
                                    
                             <option value="L2Selected" <?php echo isset($feedback) && $feedback == "L2Selected" ? 'selected' : '' ?>> L2 Selected</option>
                             
                              <option value="PositionClosed/OnHold" <?php echo isset($feedback) && $feedback == "PositionClosed/OnHold" ? 'selected' : '' ?>>Position Closed / On Hold</option>
                                    
                                    
                             <option value="Selected" <?php echo isset($feedback) && $feedback == "Selected" ? 'selected' : '' ?>>Selected</option>
                                    
                                    
                             <option value="Offered" <?php echo isset($feedback) && $feedback == "Offered" ? 'selected' : '' ?>>Offered</option>
                                    
                                    
                             <option value="Hired" <?php echo isset($feedback) && $feedback == "Hired" ? 'selected' : '' ?>>Hired</option>
                                    
                                    
                             <option value="CandidateDeclindedOffer" <?php echo isset($feedback) && $feedback == "CandidateDeclindedOffer" ? 'selected' : '' ?>>Candidate Declinded Offer</option>
                              
                             <option value="CandidateAcceptedAnotherOffer" <?php echo isset($feedback) && $feedback == "CandidateAcceptedAnotherOffer" ? 'selected' : '' ?>>Candidate Accepted Another Offer</option>
                             
                             <option value="PositionOnHold&PositionClosed" <?php echo isset($feedback) && $feedback == "PositionOnHold&PositionClosed" ? 'selected' : '' ?>>Position on hold & Position Closed</option>
                                    
                                    
                             <option value="PendingFeedBack" <?php echo isset($feedback) && $feedback == "PendingFeedBack" ? 'selected' : '' ?>>Pending FeedBack</option>
                                    
                                    
                             <option value="OnHold" <?php echo isset($feedback) && $feedback == "OnHold" ? 'selected' : '' ?>>On Hold</option>
                                    
                                    
                                
                            <option value="Other"<?php echo isset($feedback) && $feedback == "Other" ? 'selected' : '' ?> >Other</option>>
                                </select>
						</div>
						<div id="othersec" class="hidden">
						    <label for="" class="control-label">Other Feedback(*optional)</label>
						<input type="text" class="form-control form-control-sm" name="other_feedback" value="<?php echo isset($other_feedback) ? $other_feedback : '' ?>">
						</div>
						
					</div>
				</div>
					<div class="row ">
                     <div class="col-md-12">
                        <div class="form-group">
                        <label for="inputText" class="form-label"><span class="required">*</span> Job RefNo <span style="font-size:11px;">(RefNo - Reference Name - Client - Type)</span></label>
                          <select class="form-control form-control-sm " required  name="job_refno">
                            <option></option>
                            <?php 
                            $employees = $conn->query("SELECT job_management.id, job_management.jb_ref, job_management.jb_title, job_management.jb_type, job_management.jb_workingtype,
                               job_management.status, job_management.user_id, job_management.deadline, CONCAT(users.firstname, ', ', users.middlename, ' ', users.lastname) AS name,
                               clintmanege.clint_name
                                    FROM job_management
                                    INNER JOIN users ON (job_management.jb_recuiters = users.id)
                                    INNER JOIN clintmanege ON (job_management.jb_client = clintmanege.clint_id)
                                    WHERE job_management.user_id = '{$_SESSION['login_id']}' AND job_management.status= 1 AND job_management.id IN (
                                        SELECT MAX(id)
                                        FROM job_management
                                        WHERE job_management.user_id = '{$_SESSION['login_id']}' AND job_management.status= 1 
                                        GROUP BY jb_ref
                                    )
                                    ORDER BY job_management.id DESC");
                            while($row= $employees->fetch_assoc()){
                                if($row["jb_type"]== "NW"){
                                   $jb_type='New';
                                  }elseif($row["jb_type"] == "RO"){
                                  $jb_type='Re-open';
                                  }elseif($row["jb_type"] == "Closed"){
                                  $jb_type='Closed';
                                    }
                            ?>
                            <option value="<?php echo $row['id'] ?>" <?php echo isset($job_refno) && in_array($row['id'],explode(',',$job_refno)) ? "selected" : '' ?>>
                            <?php echo ucwords($row['jb_ref']). "&nbsp&nbsp - &nbsp&nbsp " .$row['jb_title']. "&nbsp&nbsp - &nbsp&nbsp ".$row['clint_name']. "&nbsp&nbsp - &nbsp&nbsp ".$jb_type;
                            ?>
                              </option>
                             <?php } ?>
                          </select>
                          
                        </div>
                    </div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						    
						    <label for="inputText" class="form-label"><span class="required">*</span> Account Manager</label>
                            
                            <select class="form-control form-control-sm "  required name="recuiter">
                            <option></option>
                            <?php 
                            $employees = $conn->query("SELECT * FROM users order by id asc ");
                            while($row= $employees->fetch_assoc()){
                            ?>
                                
                             <option value="<?php echo $row['recruiter'] ?>" <?php echo isset($recuiter) && in_array($row['recruiter'],explode(',',$recuiter)) ? "selected" : '' ?>>
                            <?php echo ucwords($row['recruiter']) ?>
                              
                              </option>
                                
    
                            <?php } ?>
                          </select>
                            
						</div>
						
						
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						    
						    <label for="inputText" class="form-label"><span class="required">*</span> CV Source by</label>
                            
                            <select class="form-control form-control-sm " required  name="source_by">
                            <option></option>
                            <?php 
                            $employees = $conn->query("SELECT * FROM users WHERE type IN (1, 2, 3) AND active = 1 AND id NOT IN (5, 13, 19, 25,39) GROUP BY email order by id asc ");
                            while($row= $employees->fetch_assoc()){
                            ?>
                                
                             <option value="<?php echo $row['id'] ?>" <?php echo isset($recuiter) && in_array($row['recruiter'],explode(',',$recuiter)) ? "selected" : '' ?>>
                            <?php echo ucwords($row['recruiter']) ?>
                              
                              </option>
                                
    
                            <?php } ?>
                          </select>
                            
						</div>
						
						
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						    
						    <label for="inputText" class="form-label"><span class="required">*</span>Date</label>
					        <input type="date" name="candi_updatedate"  required class="form-control">
						</div>
					</div>
				</div>
                
              <div class="row">
					<div class="col-md-12">
						<div class="form-group">
						    
						    <label for="inputText" class="form-label"> Description (*optional)</label>
							<textarea name="description" id="" cols="10" rows="2" class=" form-control">
							</textarea>
						</div>
					</div>
				</div>
                
                <div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-primary  bg-gradient-primary mx-2" form="upload_candidate">Save</button>
    		</div>
    	</div>
               
            </form>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
</div>
<!------------------------------------- Sale POP UP--------------------------------------------->
<div class="container">
    				<div id="modalDialog" class="col-6 align-middle" style="background:#fff;padding:10px;position: fixed;margin-top:10%;top: 0;z-index: 100000000000000000050;display: none;width: 50%;height: 50%;overflow: hidden;outline: 0;">
                            <div class="modal-content animate-top align-middle card" style="padding:10px;">
                                <div class="modal-header">
                                    <h5 class="modal-title">Sale Revenue</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form  action="" id="contactFrm" method="post">
                                <div class="modal-body">
                                    <!-- Form submission status -->
                                    <div class="response"></div>
                                    
                                    <!-- Contact form -->
                                    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="appli_ids" id="appli_ids">
      
                                    <div class="form-group">
                                        <label>Amount:</label>
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Date Of Join:</label>
                                        <input type="date" name="join_date" id="join_date"  class="form-control">
                                    </div>
					
            						<div class="form-group">
            							<label for="" class="control-label">Account Manager</label>
                                        
                                        <select class="form-control"   required name="recuiter" id="recuiter">
                                        <option></option>
                                        <?php 
                                        $employees = $conn->query("SELECT * FROM users order by id asc ");
                                        while($row= $employees->fetch_assoc()){
                                        ?>
                                            
                                         <option style="10000000000000000000000000000000000000000000;" value="<?php echo $row['recruiter'] ?>" <?php echo isset($recuiter) && in_array($row['recruiter'],explode(',',$recuiter)) ? "selected" : '' ?>>
                                        <?php echo ucwords($row['recruiter']) ?>
                                          
                                          </option>
                                            
                
                                        <?php } ?>
                                      </select>
                                        
            						</div>
						
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['login_id']; ?>">
                                </div>
                                <br><br><br>
                                <div class="modal-footer" style="display: flex;align-items:center;">
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                            </div>
                    </div>
                    </div>
<!------------------------------------- END POP UP--------------------------------------------->




<script>
                    $(document).ready(function(){
                     jQuery('.timeline').timeline({
                    //   mode: 'horizontal',
                    //   visibleItems: 4
                      //Remove this comment for see Timeline in Horizontal Format otherwise it will display in Vertical Direction Timeline
                     });
                    });
</script>


<script>

	$('.file-item').hover(function(){
		$(this).addClass("active")
	})
	$('file-item').mouseout(function(){
		$(this).removeClass("active")
	})
	$('.file-item').click(function(e){
		e.preventDefault()
		_conf("Are you sure to download this file?","dl",['"'+$(this).attr('href')+'"'])
	})
	function dl($link){
		start_load()
		window.open($link,"_blank")
		end_load()
	}
	$('#share').click(function(){
		uni_modal("<i class='fa fa-share'></i> Share this document using the link.","modal_share_link.php?did=<?php echo md5($id) ?>")
	})
</script>
<script>
	$(document).ready(function(){
	$('.delete_comment').click(function(){
	_conf("Are you sure to delete this Comment?","delete_comment",[$(this).attr('data-id')])
	})
	})
	function delete_comment($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_comment',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast('Comment Deleted successfully',"success");
					setTimeout(function(){
						location.href = 'index2.php?page=view_documentz&id=<?php echo $id ?>'
					},2000)
				}
			}
		})
	}
</script>
<script>
/*
 * Modal popup
 */
// Get the modal
var modal = $('#modalDialog');

// Get the button that opens the modal
var btn = $("#mbtn");

// Get the  element that closes the modal
var span = $(".close");

$(document).ready(function(){
    // When the user clicks the button, open the modal 
    btn.on('click', function() {
        modal.show();
    });
    
    // When the user clicks on  (x), close the modal
    span.on('click', function() {
        modal.hide();
    });
});

// When the user clicks anywhere outside of the modal, close it
$('body').bind('click', function(e){
    if($(e.target).hasClass("modal")){
        modal.hide();
    }
});
</script>


				<!------------------------------------------Candiate Script / POP UP----------------------------------------------->
<script>
                    
                        $('.feedback').change(function(){
                        var modal = $('#modalDialog');
                        var responsceID = $(this).val();
                        var span = $(".close");
                        if(responsceID =="Hired"){
                            modal.show();
                        }else if(responsceID =="Selected"){
                          modal.show();  
                        }else if(responsceID =="Offered"){
                            modal.show();
                        }else{
                             modal.hide();
                        }
                        console.log(responsceID);
                    });
                                    /*
                     * Modal popup
                     */
                    // Get the modal
                    var modal = $('#modalDialog');
                    
                    // Get the button that opens the modal
                    var btn = $("#mbtn");
                    
                    // Get the  element that closes the modal
                    var span = $(".close");
                    
                    $(document).change(function(){
                        // When the user clicks the button, open the modal 
                        btn.on('click', function() {
                            modal.show();
                        });
                        
                        // When the user clicks on  (x), close the modal
                        span.on('click', function() {
                            modal.hide();
                        });
                    });
                    
                    // When the user clicks anywhere outside of the modal, close it
                    $('body').bind('click', function(e){
                        if($(e.target).hasClass("modal")){
                            modal.hide();
                        }
                    });
                    </script>
                    
<script>
                        $(document).ready(function(){
                            $('#contactFrm').submit(function(e){
                                e.preventDefault();
                                $('.modal-body').css('opacity', '0.5');
                                $('.btn').prop('disabled', true);
                                
                                $form = $(this);
                                $.ajax({
                                    type: "POST",
                                    url: 'popajax_submit.php',
                                    data: 'contact_submit=1&'+$form.serialize(),
                                    dataType: 'json',
                                    success: function(response){
                                        if(response.status == 1){
                                            $('#contactFrm')[0].reset();
                                            $('.response').html(''+response.message+'');
                                        }else{
                                            $('.response').html(''+response.message+'');
                                        }
                                        $('.modal-body').css('opacity', '');
                                        $('.btn').prop('disabled', false);
                                    }
                                });
                            });
                        });
                        </script>
				
				
<script>
$('#upload_candidate').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_candidate',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.href = 'index2.php?page=view_documentz&id=<?php echo $id ?>'
					},2000)
				}
			}
		})
	})
</script>

 <script>
    $('.feedback').change(function(){
        var responsceID = $(this).val();
        if(responsceID =="Other"){
            $('#othersec').removeClass("hidden");
             $('#othersec').addClass("show");
        }
        else{
              $('#othersec').removeClass("show");
             $('#othersec').addClass("hidden");
        }
        console.log(responsceID);
    });
     
 </script>

<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_tracker').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Tracker Details","view_trackerdet.php?id="+$(this).attr('data-id'))
	})
	$('.delete_candidate').click(function(){
	_conf("Are you sure to delete this data?","delete_candidate",[$(this).attr('data-id')])
	})
	})
    
	function delete_candidate($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_candidate',
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
<!------------------------------------------END Candiate Script / POP UP----------------------------------------------->



















<script>

	$('.file-item').hover(function(){
		$(this).addClass("active")
	})
	$('file-item').mouseout(function(){
		$(this).removeClass("active")
	})
	$('.file-item').click(function(e){
		e.preventDefault()
		_conf("Are you sure to download this file?","dl",['"'+$(this).attr('href')+'"'])
	})
	function dl($link){
		start_load()
		window.open($link,"_blank")
		end_load()
	}
	$('#share').click(function(){
		uni_modal("<i class='fa fa-share'></i> Share this document using the link.","modal_share_link.php?did=<?php echo md5($id) ?>")
	})
</script>
<script>
	$(document).ready(function(){
	$('.delete_comment').click(function(){
	_conf("Are you sure to delete this Comment?","delete_comment",[$(this).attr('data-id')])
	})
	})
	function delete_comment($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_comment',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast('Comment Deleted successfully',"success");
					setTimeout(function(){
						location.href = 'index2.php?page=view_documentz&id=<?php echo $id ?>'
					},2000)
				}
			}
		})
	}
</script>
<script>
/*
 * Modal popup
 */
// Get the modal
var modal = $('#modalDialog');

// Get the button that opens the modal
var btn = $("#mbtn");

// Get the  element that closes the modal
var span = $(".close");

$(document).ready(function(){
    // When the user clicks the button, open the modal 
    btn.on('click', function() {
        modal.show();
    });
    
    // When the user clicks on  (x), close the modal
    span.on('click', function() {
        modal.hide();
    });
});

// When the user clicks anywhere outside of the modal, close it
$('body').bind('click', function(e){
    if($(e.target).hasClass("modal")){
        modal.hide();
    }
});
</script>


				<!------------------------------------------Candiate Script / POP UP----------------------------------------------->
<script>
                    
                        $('.feedback').change(function(){
                        var modal = $('#modalDialog');
                        var responsceID = $(this).val();
                        var span = $(".close");
                        if(responsceID =="Hired"){
                            modal.show();
                        }else if(responsceID =="Selected"){
                          modal.show();  
                        }else if(responsceID =="Offered"){
                            modal.show();
                        }else{
                             modal.hide();
                        }
                        console.log(responsceID);
                    });
                                    /*
                     * Modal popup
                     */
                    // Get the modal
                    var modal = $('#modalDialog');
                    
                    // Get the button that opens the modal
                    var btn = $("#mbtn");
                    
                    // Get the  element that closes the modal
                    var span = $(".close");
                    
                    $(document).change(function(){
                        // When the user clicks the button, open the modal 
                        btn.on('click', function() {
                            modal.show();
                        });
                        
                        // When the user clicks on  (x), close the modal
                        span.on('click', function() {
                            modal.hide();
                        });
                    });
                    
                    // When the user clicks anywhere outside of the modal, close it
                    $('body').bind('click', function(e){
                        if($(e.target).hasClass("modal")){
                            modal.hide();
                        }
                    });
                    </script>
                    
<script>
                        $(document).ready(function(){
                            $('#contactFrm').submit(function(e){
                                e.preventDefault();
                                $('.modal-body').css('opacity', '0.5');
                                $('.btn').prop('disabled', true);
                                
                                $form = $(this);
                                $.ajax({
                                    type: "POST",
                                    url: 'popajax_submit.php',
                                    data: 'contact_submit=1&'+$form.serialize(),
                                    dataType: 'json',
                                    success: function(response){
                                        if(response.status == 1){
                                            $('#contactFrm')[0].reset();
                                            $('.response').html(''+response.message+'');
                                        }else{
                                            $('.response').html(''+response.message+'');
                                        }
                                        $('.modal-body').css('opacity', '');
                                        $('.btn').prop('disabled', false);
                                    }
                                });
                            });
                        });
                        </script>
				
				


 <script>
    $('.feedback').change(function(){
        var responsceID = $(this).val();
        if(responsceID =="Other"){
            $('#othersec').removeClass("hidden");
             $('#othersec').addClass("show");
        }
        else{
              $('#othersec').removeClass("show");
             $('#othersec').addClass("hidden");
        }
        console.log(responsceID);
    });
     
 </script>

<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_tracker').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Tracker Details","view_trackerdet.php?id="+$(this).attr('data-id'))
	})
	$('.delete_candidate').click(function(){
	_conf("Are you sure to delete this data?","delete_candidate",[$(this).attr('data-id')])
	})
	})
    
	function delete_candidate($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_candidate',
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
<!------------------------------------------END Candiate Script / POP UP----------------------------------------------->





<script>

	$('.file-item').hover(function(){
		$(this).addClass("active")
	})
	$('file-item').mouseout(function(){
		$(this).removeClass("active")
	})
	$('.file-item').click(function(e){
		e.preventDefault()
		_conf("Are you sure to download this file?","dl",['"'+$(this).attr('href')+'"'])
	})
	function dl($link){
		start_load()
		window.open($link,"_blank")
		end_load()
	}
	$('#share').click(function(){
		uni_modal("<i class='fa fa-share'></i> Share this document using the link.","modal_share_link.php?did=<?php echo md5($id) ?>")
	})
</script>
<script>
	$(document).ready(function(){
	$('.delete_comment').click(function(){
	_conf("Are you sure to delete this Comment?","delete_comment",[$(this).attr('data-id')])
	})
	})
	function delete_comment($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_comment',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast('Comment Deleted successfully',"success");
					setTimeout(function(){
						location.href = 'index2.php?page=view_documentz&id=<?php echo $id ?>'
					},2000)
				}
			}
		})
	}
</script>
<script>
/*
 * Modal popup
 */
// Get the modal
var modal = $('#modalDialog');

// Get the button that opens the modal
var btn = $("#mbtn");

// Get the  element that closes the modal
var span = $(".close");

$(document).ready(function(){
    // When the user clicks the button, open the modal 
    btn.on('click', function() {
        modal.show();
    });
    
    // When the user clicks on  (x), close the modal
    span.on('click', function() {
        modal.hide();
    });
});

// When the user clicks anywhere outside of the modal, close it
$('body').bind('click', function(e){
    if($(e.target).hasClass("modal")){
        modal.hide();
    }
});
</script>


				<!------------------------------------------Candiate Script / POP UP----------------------------------------------->
<script>
                    
                        $('.feedback').change(function(){
                        var modal = $('#modalDialog');
                        var responsceID = $(this).val();
                        var span = $(".close");
                        if(responsceID =="Hired"){
                            modal.show();
                        }else if(responsceID =="Selected"){
                          modal.show();  
                        }else if(responsceID =="Offered"){
                            modal.show();
                        }else{
                             modal.hide();
                        }
                        console.log(responsceID);
                    });
                                    /*
                     * Modal popup
                     */
                    // Get the modal
                    var modal = $('#modalDialog');
                    
                    // Get the button that opens the modal
                    var btn = $("#mbtn");
                    
                    // Get the  element that closes the modal
                    var span = $(".close");
                    
                    $(document).change(function(){
                        // When the user clicks the button, open the modal 
                        btn.on('click', function() {
                            modal.show();
                        });
                        
                        // When the user clicks on  (x), close the modal
                        span.on('click', function() {
                            modal.hide();
                        });
                    });
                    
                    // When the user clicks anywhere outside of the modal, close it
                    $('body').bind('click', function(e){
                        if($(e.target).hasClass("modal")){
                            modal.hide();
                        }
                    });
                    </script>
                    
<script>
                        $(document).ready(function(){
                            $('#contactFrm').submit(function(e){
                                e.preventDefault();
                                $('.modal-body').css('opacity', '0.5');
                                $('.btn').prop('disabled', true);
                                
                                $form = $(this);
                                $.ajax({
                                    type: "POST",
                                    url: 'popajax_submit.php',
                                    data: 'contact_submit=1&'+$form.serialize(),
                                    dataType: 'json',
                                    success: function(response){
                                        if(response.status == 1){
                                            $('#contactFrm')[0].reset();
                                            $('.response').html(''+response.message+'');
                                        }else{
                                            $('.response').html(''+response.message+'');
                                        }
                                        $('.modal-body').css('opacity', '');
                                        $('.btn').prop('disabled', false);
                                    }
                                });
                            });
                        });
                        </script>
				
				


 <script>
    $('.feedback').change(function(){
        var responsceID = $(this).val();
        if(responsceID =="Other"){
            $('#othersec').removeClass("hidden");
             $('#othersec').addClass("show");
        }
        else{
              $('#othersec').removeClass("show");
             $('#othersec').addClass("hidden");
        }
        console.log(responsceID);
    });
     
 </script>

<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_tracker').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Tracker Details","view_trackerdet.php?id="+$(this).attr('data-id'))
	})
	$('.delete_candidate').click(function(){
	_conf("Are you sure to delete this data?","delete_candidate",[$(this).attr('data-id')])
	})
	})
    
	function delete_candidate($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_candidate',
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
<!------------------------------------------END Candiate Script / POP UP----------------------------------------------->