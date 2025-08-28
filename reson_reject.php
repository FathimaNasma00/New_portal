<?php
include 'db_connect.php';
$id= $_GET['id'];
$status =$_GET['status'];

?>

<div class="container-fluid">
	<div class="card card-widget widget-user shadow">
        <h3 class="widget-user-username">REJECTION RESONS</h3>
      <div class="card-footer">
        <div class="container-fluid">
            <form action="" id="reson-upload">
                <input type="hidden" name="id" value="<?php echo $id; ?> ">
            <div class="callout callout-info">
						<dl>
							<dt>REJECTION RESONS</dt>
							<dd><textarea name="resons" id="" cols="30" rows="10" class="summernote form-control">
							</textarea></dd>
						</dl>
					</div>
					<div class="modal-footer display p-0 m-0">
    <button class="btn btn-primary mr-2">Save</button>
     <button onclick="history.go(-1);" class="btn btn-primary"> &nbsp; Close</button>
</div>
					</form>
        
        </div>
    </div>
	</div>
</div>
<script>
    	$('#reson-upload').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=reson_upload',
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
						location.href = 'index.php?page=adminpending'
					},2000)
				}
			}
		})
	})
</script>

<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>