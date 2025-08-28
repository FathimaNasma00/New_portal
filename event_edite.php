<?php
include 'db_connect.php';

// Fetch the event data
if (isset($_GET["id"])) {
    $qry = $conn->query("SELECT *, events_calender.id AS eventid, events_calender.status, events_calender.title AS event_title, 
                                CONCAT(users.firstname, ', ', users.middlename, ' ', users.lastname) AS user_name,
                                documents.id AS candidate_id, CONCAT(documents.title, ' ', documents.last_name) AS candidate_name,
                                job_management.id AS job_id, job_management.jb_title, job_management.jb_ref,
                                clintmanege.clint_name
                         FROM events_calender 
                         INNER JOIN users ON events_calender.user_id = users.id
                         INNER JOIN documents ON events_calender.candidate_id = documents.id
                         INNER JOIN clintmanege ON events_calender.client_id = clintmanege.clint_id
                         INNER JOIN job_management ON events_calender.job_id = job_management.id
                         WHERE events_calender.id = {$_GET['id']}
                         ORDER BY events_calender.id DESC ")->fetch_array();
    foreach ($qry as $k => $v) {
        if ($k == 'title') $k = 'ftitle'; // Rename 'title' to avoid conflicts
        $event[$k] = $v;
    }
}
?>

<main>
    <div class="pagetitle">
        <h1>Event Calendar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
                <li class="breadcrumb-item">Calendar</li>
                <li class="breadcrumb-item active"><?= isset($_GET["id"]) ? "Edit Event" : "View Event" ?></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="col-md-12">
            <div class="row">
                <div class="justify-content-center">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= isset($_GET["id"]) ? "Edit Event" : "View Event" ?></h5>

                            <table class="table">
                                <tr>
                                    <th>Event Title</th>
                                    <td><?php echo $event["event_title"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Candidate</th>
                                    <td>
                                        <a target="_blank" href="./index2.php?page=view_documentz&id=<?php echo $event['candidate_id']; ?>">
                                            <?php echo $event["candidate_name"]; ?>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Client</th>
                                    <td><?php echo $event["clint_name"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Job RefNo</th>
                                    <td>
                                        <a target="_blank" href="./index2.php?page=jobmangement_view&id=<?php echo $event['job_id']; ?>">
                                            <?php echo $event["jb_ref"]; ?>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <select class="form-select status-dropdown" data-id="<?php echo $event['eventid']; ?>">
                                            <option value="1" <?php echo ($event['status'] == 1) ? 'selected' : ''; ?>>Completed</option>
                                            <option value="2" <?php echo ($event['status'] == 2) ? 'selected' : ''; ?>>Not Completed</option>
                                            <option value="3" <?php echo ($event['status'] == 3) ? 'selected' : ''; ?>>Rescheduled</option>
                                        </select>

                                        <!-- Date & Time Input (Hidden by Default) -->
                                        <input type="datetime-local" class="form-control reschedule-datetime mt-2" name="start_date" data-id="<?php echo $event['eventid']; ?>" style="display: none;" value="<?php echo $event['start_datetime']; ?>">

                                        <!-- Submit Button (Hidden by Default) -->
                                        <button class="btn btn-primary mt-2 save-reschedule" data-id="<?php echo $event['eventid']; ?>" style="display: none;">Save</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Event Date & Time</th>
                                    <td><?php echo $event["start_datetime"]; ?></td>
                                </tr>
                            </table>

                            <!-- Form for rescheduling (if needed) -->
                            <form id="calender"></form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


 <script>
                  $(document).ready(function () {
    // Handle status change
    $(document).on('change', '.status-dropdown', function () {
        var eventId = $(this).data('id');
        var newStatus = $(this).val();

        // Hide all reschedule inputs first
        $('.reschedule-datetime, .save-reschedule').hide();

        if (newStatus === "3") { // If "Rescheduled" is selected
            $('input.reschedule-datetime[data-id="' + eventId + '"]').show();
            $('button.save-reschedule[data-id="' + eventId + '"]').show();
        } else {
            // Update status immediately if NOT Rescheduled
            $.ajax({
                url: 'eventstaus_update.php',
                type: 'POST',
                data: { id: eventId, status: newStatus },
                success: function (response) {
                    console.log("Response from server:", response);
                    alert("Status updated successfully!");
                    location.reload(); // Refresh to reflect changes
                },
                error: function (xhr, status, error) {
                    console.log("AJAX Error:", status, error);
                    alert("Failed to update. Please try again.");
                }
            });
        }
    });

    // Handle "Save" button click for rescheduling
    $(document).on('click', '.save-reschedule', function () {
        var eventId = $(this).data('id');
        var newDate = $('input.reschedule-datetime[data-id="' + eventId + '"]').val().trim();

        if (newDate === '') {
            alert("Please select a new date and time.");
            return;
        }

        $.ajax({
            url: 'eventstaus_update.php',
            type: 'POST',
            data: { id: eventId, status: 3, new_date: newDate },
            success: function (response) {
                console.log("Response from server:", response);
                if (response.includes("Success")) {
                    alert("Event rescheduled successfully!");
                    location.reload();
                } else {
                    alert("Error: " + response); // Show actual error
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", status, error);
                alert("AJAX request failed: " + xhr.responseText);
            }
        });
    });
});

                  </script>
