 
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
   <div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
		       
  <div id="user_dialog" title="Add Data">
   <div class="form-group">
    <label>Clint</label>
     <select class="form-control form-control-sm select2"  required name="clintname"  id="clintname">
                            <option></option>
                            <?php 
                            $employees = $conn->query("SELECT * FROM clintmanege order by clint_id asc ");
                            while($row= $employees->fetch_assoc()){
                            ?>
                                
                             <option value="<?php echo $row['clint_id'] ?>" <?php echo isset($clintname) && in_array($row['clint_id'],explode(',',$clintname)) ? "selected" : '' ?>>
                            <?php echo ucwords($row['clint_name']) ?>
                              
                              </option>
                                
    
                            <?php } ?>
      </select>
    <span id="error_clintname" class="text-danger"></span>
   </div>
   <div class="form-group">
    <label>Subaccount Name</label>
    <input type="text" name="subacount" id="subacount" class="form-control" />
    <span id="error_subacount" class="text-danger"></span>
   </div>
   <div class="form-group" align="center">
    <input type="hidden" name="row_id" id="hidden_row_id" />
    <button type="button" name="save" id="save" class="btn btn-info">Save</button>
   </div>
  </div>
    <div class="container">
   <div align="left" style="margin-bottom:5px;">
    <button type="button" name="add" id="add" class="btn btn-success ">Add</button>
   </div>
   
 <form method="post" id="user_form">
    <div class="table-responsive">
     <table class="table table-striped table-bordered" id="user_data">
      <tr>
       <th>Sub Account Name</th>
       <th>View/Edit</th>
       <th>Remove</th>
      </tr>
     </table>
    </div>
    <div align="center">
     <input type="submit" name="insert" id="insert" class="btn btn-primary" value="Insert" />
    </div>
    
   </form>
   
  </div>
  <div id="action_alert" title="Action">

  </div>
    </div>
    </div>
    </div>

<script>  
$(document).ready(function(){ 
    
 
 var count = 0;

 $('#user_dialog').dialog({
  autoOpen:false,
  width:400
 });

 $('#add').click(function(){
  $('#user_dialog').dialog('option', 'title', 'Add Data');
  $('#clintname').val('');
  $('#subacount').val('');
  $('#error_clintname').text('');
  $('#error_subacount').text('');
  $('#clintname').css('border-color', '');
  $('#subacount').css('border-color', '');
  $('#save').text('Save');
  $('#user_dialog').dialog('open');
 });

 $('#save').click(function(){
  var error_clintname = '';
  var error_subacount = '';
  var clintname = '';
  var subacount = '';
  if($('#clintname').val() == '')
  {
   error_clintname = 'Clint Name is required';
   $('#error_clintname').text(error_clintname);
   $('#clintname').css('border-color', '#cc0000');
   clintname = '';
  }
  else
  {
   error_clintname = '';
   $('#error_clintname').text(error_clintname);
   $('#clintname').css('border-color', '');
   clintname = $('#clintname').val();
  } 
  if($('#subacount').val() == '')
  {
   error_subacount = 'SubAccount Name is required';
   $('#error_subacount').text(error_subacount);
   $('#subacount').css('border-color', '#cc0000');
   subacount = '';
  }
  else
  {
   error_subacount = '';
   $('#error_subacount').text(error_subacount);
   $('#subacount').css('border-color', '');
   subacount = $('#subacount').val();
  }
  if(error_clintname != '' || error_subacount != '')
  {
   return false;
  }
  else
  {
   if($('#save').text() == 'Save')
   {
    count = count + 1;
    output = '<tr id="row_'+count+'">';
    output += '<td> <input type="hidden" name="hidden_clintname[]" id="clintname'+count+'" class="clintname" value="'+clintname+'" /></td>';
    output += '<td>'+subacount+' <input type="hidden" name="hidden_subacount[]" id="subacount'+count+'" value="'+subacount+'" /></td>';
    output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+count+'">View</button></td>';
    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Remove</button></td>';
    output += '</tr>';
    $('#user_data').append(output);
   }
   else
   {
    var row_id = $('#hidden_row_id').val();
    output = '<td>'+clintname+' <input type="hidden" name="hidden_clintname[]" id="clintname'+row_id+'" class="clintname" value="'+clintname+'" /></td>';
    output += '<td>'+subacount+' <input type="hidden" name="hidden_subacount[]" id="subacount'+row_id+'" value="'+subacount+'" /></td>';
    output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+row_id+'">View</button></td>';
    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+row_id+'">Remove</button></td>';
    $('#row_'+row_id+'').html(output);
   }

   $('#user_dialog').dialog('close');
  }
 });

 $(document).on('click', '.view_details', function(){
  var row_id = $(this).attr("id");
  var clintname = $('#clintname'+row_id+'').val();
  var subacount = $('#subacount'+row_id+'').val();
  $('#clintname').val(clintname);
  $('#subacount').val(subacount);
  $('#save').text('Edit');
  $('#hidden_row_id').val(row_id);
  $('#user_dialog').dialog('option', 'title', 'Edit Data');
  $('#user_dialog').dialog('open');
 });

 $(document).on('click', '.remove_details', function(){
  var row_id = $(this).attr("id");
  if(confirm("Are you sure you want to remove this row data?"))
  {
   $('#row_'+row_id+'').remove();
  }
  else
  {
   return false;
  }
 });

 $('#action_alert').dialog({
  autoOpen:false
 });

    
$('#user_form').on('submit', function(event){
  event.preventDefault();
  var count_data = 0;
  $('.clintname').each(function(){
   count_data = count_data + 1;
  });
  if(count_data > 0)
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"clintsubacinsert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#user_data').find("tr:gt(0)").remove();
     $('#action_alert').html('<p>Data Inserted Successfully</p>');
     $('#action_alert').dialog('open');
    }
   })
  }
  else
  {
   $('#action_alert').html('<p>Please Add atleast one data</p>');
   $('#action_alert').dialog('open');
  }
 });
 
});  
</script>

<?php 
 include "clintsubacview.php";
?>
