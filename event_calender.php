<?php

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function () {
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: 'event_load.php',
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    var title = prompt("Enter Event Title");
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD hh:mm A");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD hh:mm A");
                        $.ajax({
                            url: "event_insert.php",
                            type: "POST",
                            data: {title: title, start: start, end: end},
                            success: function () {
                                calendar.fullCalendar('refetchEvents');
                                alert("Added Successfully");
                            }
                        });
                    }
                },
                editable: true,
                eventResize: function (event) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD hh:mm A");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD hh:mm A");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "event_update.php",
                        type: "POST",
                        data: {title: title, start: start, end: end, id: id},
                        success: function () {
                            calendar.fullCalendar('refetchEvents');
                            alert('Event Updated');
                        }
                    });
                },

                eventDrop: function (event) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD hh:mm A");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD hh:mm A");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "event_update.php",
                        type: "POST",
                        data: {title: title, start: start, end: end, id: id},
                        success: function () {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated");
                        }
                    });
                },

                eventRender: function (event, element) {
                if (event.evstatus == 1) { 
                    element.css({
                        'background-color': 'rgba(144, 238, 144, 0.6)', // Light Green Background
                        'border-color': 'rgba(144, 238, 144, 4)', // Strong Green Border
                        'color': 'darkblue' // Dark Blue Text
                    });
                } else if (event.evstatus == 2) {
                    element.css({
                        'background-color': 'rgba(255, 99, 71, 0.6)', // Light Red Background
                        'border-color': 'rgba(255, 99, 71, 4)', // Strong Red Border
                        'color': '#fff'
                    });
                } else if (event.evstatus == 3) {
                    element.css({
                      'background-color': 'rgba(92, 51, 145, 0.2)', // Light Purple Background
                      'border-color': 'rgba(92, 51, 145, 3)', // Strong Purple Border
                     'color': 'darkblue'
                    });
                } else {
                    element.css({
                        'background-color': 'rgba(31, 138, 173, 0.6)', // Light Red/Pink Default Background
                        'border-color': 'rgba(31, 138, 173, 4)', // Strong Pink Border
                        'color': '#000'
                    });
                }

                element.attr('href', 'javascript:void(0);');
                element.click(function () {
                    $('#eventId').val(event.id);
                    $('#evstatus').val(event.evstatus);
                    $('#eventTitle').html(event.Eventtitle);
                    $('#eventCandidate').html('<a href="index2.php?page=view_documentz&id=' + event.candidate_id + '" target="_blank">' + event.candidate + '</a>');
                    $('#eventClient').html(event.clint_name);
                    $('#eventJobTitle').html(event.jb_title);
                    $('#eventJobRef').html('<a href="index2.php?page=saledataview&id=' + event.jbref_id + '" target="_blank">' + event.jb_ref + '</a>');
                    $('#eventEditeView').html('<a href="./index2.php?page=event_edite&id=' + event.id + '" target="_blank">Rescheduled</a>');
                    $('#eventStart').html(moment(event.start).format('YYYY-MM-DD hh:mm A'));
                    $('#eventUploadBy').html(event.upby);
                    $('#userid').html(event.userid);
                    if (event.userid == '<?php echo $_SESSION["login_id"]; ?>') {
                        $('.eventpeo').show(); // Show the section for uploader
                    } else {
                        $('.eventpeo').hide(); // Hide the section for other users
                    }

        
                    if (event.evstatus == 1) {
                        $('#statusYes').prop('checked', true);
                    } else if (event.evstatus == 2) {
                        $('#statusNo').prop('checked', true);
                    } else {
                        // Neither Yes nor No, uncheck both radio buttons
                        $('input[name="eventStatus"]').prop('checked', false);
                    }
                    
                    if (event.evstatus == 1) {
                        $('#statusdetails').text("Completed");
                    } else if (event.evstatus == 2 || event.evstatus == 0) {
                        $('#statusdetails').text("Not completed");
                    } else {
                       $('#statusdetails').text("Not completed");
                    }
    
                    $('#eventDetails').modal('show');
                });
            },

            timeFormat: 'h:mmA'

            });
        });
    </script>
</head>
<body>
<div class="container">
    <div id="calendar"></div>
</div>
<style>
    /* Hide default radio button */
    input[type="radio"] {
        display: none;
    }

    /* Style the custom radio button */
    input[type="radio"] + label:before {
        content: "";
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 2px solid #ccc;
        border-radius: 50%;
        margin-right: 5px;
        vertical-align: middle;
        cursor: pointer;
    }

    /* Style the custom radio button when selected */
    input[type="radio"]:checked + label:before {
        background-color: #007bff; /* Change color when selected */
    }

    /* Style the label text */
    label {
        cursor: pointer;
    }
</style>
<!-- Event Details Modal -->
<div id="eventDetails" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Interview Details</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p><strong>Interview Type :</strong> <span id="eventTitle"></span></p>
                <p><strong>Candidate :</strong> <span id="eventCandidate"></span></p>
                <p><strong>Client  :</strong> <span id="eventClient"></span></p>
                <p><strong>Job RefNo / Title :</strong> <span id="eventJobRef"></span> - <span id="eventJobTitle"></span></p>
                <p><strong>Interview Date/Time:</strong> <span id="eventStart"></span></p>
                
                <p><strong>Upload By:</strong> <span id="eventUploadBy"></span></p>
                
                 <input type="hidden" id="eventId" value="">
                <div class="eventpeo">
                    <p><strong>"Did this Interview happen?</strong></p>
                    <input type="radio" id="statusYes" name="eventStatus" value="1">
                    <label for="statusYes">Yes</label> 
                    <input type="radio" id="statusNo" name="eventStatus" value="2">
                    <label for="statusNo">No</label>
                     &nbsp; OR &nbsp;
                    <span id="eventEditeView"></span>
                    <br>
                </div>
                <p><strong>Interview Status:</strong> <span id="statusdetails"></span></p>
            </div>
            <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
// Add event listener to radio buttons with the name 'eventStatus'
$('input[name="eventStatus"]').change(function() {
    var status = $(this).val(); // Get the value of the selected radio button
    var eventId = $('#eventId').val(); // Get the value of the hidden input field with the id 'eventId'

    // Send AJAX request to update event status
    $.ajax({
        url: "event_update_status.php", // URL for updating the event status
        type: "POST", // HTTP method
        data: { eventId: eventId, status: status }, // Data to be sent in the request
        success: function(response) { // Callback function on successful request
            // Handle success response if needed
            console.log("Event status updated successfully");
        },
        error: function(xhr, status, error) { // Callback function on error
            // Handle error response if needed
            console.error("Error updating event status:", error);
        }
    });
});

</script>
<style>
       
        .status-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .status-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px; /* Reduced font size */
            font-weight: bold;
            color: darkblue; /* Dark blue text */
        }

       
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            border: 2px solid transparent; 
        }

       .green { 
            background-color: rgba(144, 238, 144, 0.6); 
            border-color: rgba(144, 238, 144, 1); 
        }
        .red { 
            background-color: rgba(255, 99, 71, 0.6); 
            border-color: rgba(255, 99, 71, 1); 
        }
        .blue { 
            background-color: rgba(31, 138, 173, 0.6); 
            border-color: rgba(31, 138, 173, 1); 
        }
        .purple { 
            background-color: rgba(92, 51, 145, 0.6); 
            border-color: rgba(92, 51, 145, 1); 
        }

     
        @media (max-width: 600px) {
            .status-container {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
    <div class="status-container">
        <div class="status-item">
            <span class="status-dot green"></span> Interview Completed
        </div>
        <div class="status-item">
            <span class="status-dot blue"></span> Scheduled
        </div>
        <div class="status-item">
            <span class="status-dot red"></span> Not Completed
        </div>
        <div class="status-item">
            <span class="status-dot purple"></span> Rescheduled
        </div>
    </div>

</body>
</html>
