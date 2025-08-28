<div class="container mt-4">
    <h2>Customer Support Center</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="tickets.php">Ticket</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Ticket</li>
        </ol>
    </nav>
     <section class="section">
    <div class="col-md-12">
      <div class="row ">
        <div class="justify-content-center ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Raise your ticket</h5>

                <form id="save_csticket">
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="department_id">Department</label>
            <select name="department_id" id="department_id" class="custom-select custom-select-sm select2" required>
                <option value="">Select Department</option>
                <?php
                $department = $conn->query("SELECT * FROM customer_support_departments ORDER BY name ASC");
                while($row = $department->fetch_assoc()):
                ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control summernote" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit Ticket</button>
        <div id="responseMessage" class="mt-2"></div>
    </form>
    
            </div>
        </div>
        </div>
    </div>
    </div>
            
    </section>
    
    
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	$('#save_csticket').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_csticket',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=cs_my_ticket')
					},750)
				}
			}
		})
	})
</script>


