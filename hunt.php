<?php include 'db_connect.php'; ?>

    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="assets/css/style.css">

<body class="toggle-sidebar">
<main class="">
    <div class="pagetitle">
        <h1>HUNT</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div>

    <form id="filterForm" class="row mb-4">
        <div class="form-group col-sm-3">
            <label>Skills:</label>
            <input type="text" id="byskills" name="byskills" class="form-control" placeholder="Enter skills">
        </div>
        <div class="form-group col-sm-3">
            <label>Position:</label>
            <input type="text" id="bypostion" name="bypostion" class="form-control" placeholder="Enter position">
        </div>
        <div class="form-group col-sm-3">
            <label>Industry:</label>
            <input type="text" id="byindistry" name="byindistry" class="form-control" placeholder="Enter industry">
        </div>
        <div class="form-group col-sm-3">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-primary form-control">Filter</button>
        </div>
    </form>

    <table id="huntTable" class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Status</th>
            <th>Ref.No</th>
            <th>Name</th>
            <th>Skills</th>
            <th>Position</th>
            <th>Industry</th>
            <th>Phone No</th>
            <th>Uploaded Date / Time</th>
        </tr>
        </thead>
    </table>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="assets/js/custom.js"></script>
<script>
$(document).ready(function() {
    $('#huntTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "hunt_data_ajax.php",
            "type": "POST",
            "data": function(d) {
                d.byskills = $('#byskills').val();
                d.bypostion = $('#bypostion').val();
                d.byindistry = $('#byindistry').val();
            }
        },
        "pageLength": 10,
        "lengthMenu": [ [10, 25, 50, 100], [10, 25, 50, 100] ],
        "ordering": true, 
        "searching": true, 
        "info": true
    });

    // Reload on filter submit
    $('form').on('submit', function(e) {
        e.preventDefault();
        $('#huntTable').DataTable().ajax.reload();
    });
});
</script>


</body>
</html>
