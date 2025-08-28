
<ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index2.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
        <?php
        if($_SESSION['login_type']==1){
        ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=new_user">
              <i class="bi bi-circle"></i><span>Add New</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=user_list">
              <i class="bi bi-circle"></i><span>List of User</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->
    <li class="nav-item">
        <a class="nav-link " href="ocr/ocrsystem.php">
          <i class="bi bi-cpu"></i>
          <span>OCR</span> &nbsp; &nbsp;<span style="color: #899bbd; font-size:10px;text-align:right;">&nbsp;- &nbsp;Recommend</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Documents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <!--<a href="./index2.php?page=test_file">-->
            <a href="ocr/ocrsystem.php">
              <i class="bi bi-circle"></i><span>OCR Upload</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=test_file">
              <i class="bi bi-circle"></i><span>Manual Upload</span>
            </a>
          </li>
          
         <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#dd-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span> My Documents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="dd-nav" class="nav-content collapse " >
          <li>
            <a href="./index2.php?page=document_list">
              <i class="bi bi-circle"></i><span>My All Documents </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=mypending">
              <i class="bi bi-circle"></i><span>Pending Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=myapproved">
              <i class="bi bi-circle"></i><span>Approved Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=myreject">
              <i class="bi bi-circle"></i><span>Rejected Documents</span>
            </a>
          </li>
        </ul>
      </li><!-- End 1st dd list Nav -->
      
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#db2-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span> All Documents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="db2-nav" class="nav-content collapse ">
          <li>
            <a href="./index2.php?page=adminalldocs">
              <i class="bi bi-circle"></i><span>All Documents </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=adminpending">
              <i class="bi bi-circle"></i><span>All Pending Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=adminapproved">
              <i class="bi bi-circle"></i><span>All Approved Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=adminreject">
              <i class="bi bi-circle"></i><span>All Rejected Documents</span>
            </a>
          </li>
        </ul>
      </li><!-- End 2st dd list Nav -->
       
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Task Manager</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=task_list">
              <i class="bi bi-circle"></i><span>Add Task</span>
            </a>
          </li>
       
        </ul>
      </li><!-- End Tables Nav -->
      
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">-->
      <!--    <i class="bi bi-bar-chart"></i><span>Time Tracker</span><i class="bi bi-chevron-down ms-auto"></i>-->
      <!--  </a>-->
      <!--  <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=timetracker">-->
      <!--        <i class="bi bi-circle"></i><span>Add Tracker</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=viewtimetracker">-->
      <!--        <i class="bi bi-circle"></i><span>My Time Tracker</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=vieztimetracker">-->
      <!--        <i class="bi bi-circle"></i><span>All Employee Details</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--  </ul>-->
      <!--</li>-->
      <!-- End Charts Nav -->
    
     <li class="nav-item">
        <a class="nav-link collapsed" href="./index2.php?page=huntz">
          <i class="bi bi-card-list"></i>
          <span>Hunt</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Client</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=new_clint">
              <i class="bi bi-circle"></i><span>Add Client</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=clint">
              <i class="bi bi-circle"></i><span>Client List</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=clintsubaccount">
              <i class="bi bi-circle"></i><span>Sub Accounts</span>
            </a>
          </li>
          
          <li>
            <a href="./index2.php?page=poc">
              <i class="bi bi-circle"></i><span>POC</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->
      
      
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#project-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-folder-fill"></i><span>Job Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="project-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=jobmangement">
              <i class="bi bi-circle"></i><span>Add Data</span>
            </a>
          </li>
                     <li>
            <a href="./index2.php?page=jobmangement_mylist">
              <i class="bi bi-circle"></i><span>My Data</span>
            </a>
          </li>
           <li>
            <a href="./index2.php?page=jobmangement_list">
              <i class="bi bi-circle"></i><span>All Data</span>
            </a>
          </li>
          
          
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#job-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-circle-fill"></i><span>Job Status</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="job-nav" class="nav-content collapse ">
                  <li>
                    <a href="./index2.php?page=jobmangement_active">
                      <i class="bi bi-forward"></i><span>Active Jobs </span>
                    </a>
                  </li>
                             <li>
                    <a href="./index2.php?page=jobmangement_inactive">
                      <i class="bi bi-forward"></i><span>Inactive jobs</span>
                    </a>
                  </li>
               
                </ul>
             </li>
          
          
          
          
       
        </ul>
      </li><!-- End  Job Management Tables Nav -->
       
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#project-nav1" data-bs-toggle="collapse" href="#">
          <i class="bi bi-folder-fill"></i><span>Lkcareers Jobs</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="project-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=lk_generalsubmissions">
              <i class="bi bi-circle"></i><span>General Submissions</span>
            </a>
          </li>
                     <li>
            <a href="./index2.php?page=lk_jobundermysubmissions">
              <i class="bi bi-circle"></i><span>Submissions Under My job Ref/No</span>
            </a>
          </li>

          
        </ul>
      </li><!-- End  Job Management Tables Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#cd-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Candidate Summary</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="cd-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=candidateinput">
              <i class="bi bi-circle"></i><span>Add Summary</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=candidate">
              <i class="bi bi-circle"></i><span>Summary List</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=mycandidatesummery">
              <i class="bi bi-circle"></i><span>My Summary</span>
            </a>
          </li>
        </ul>
      </li>
      
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link collapsed" data-bs-target="#ex-nav" data-bs-toggle="collapse" href="#">-->
      <!--    <i class="bi bi-gem"></i><span>Excuse Form</span><i class="bi bi-chevron-down ms-auto"></i>-->
      <!--  </a>-->
      <!--  <ul id="ex-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=excuseform">-->
      <!--        <i class="bi bi-circle"></i><span>Form</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=myexcuses">-->
      <!--        <i class="bi bi-circle"></i><span>My Excuses</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=allexcuses">-->
      <!--        <i class="bi bi-circle"></i><span>All Employees excuse</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--  </ul>-->
      <!--</li>-->
      
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#sl-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Hiring Confirmation</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="sl-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="./index2.php?page=hireadd">
              <i class="bi bi-circle"></i><span>Add Hiring</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=listofsaletr">
              <i class="bi bi-circle"></i><span>All Hiring</span>
            </a>
          </li>

          <li>
            <a href="./index2.php?page=mysalerevue">
              <i class="bi bi-circle"></i><span>My Hiring</span>
            </a>
          </li>
          
          <li>
            <a href="./index2.php?page=payment_list">
              <i class="bi bi-circle"></i><span>Payment Status</span>
            </a>
          </li>
          
        </ul>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#calender-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-event"></i><span>Calender</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="calender-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=event_add">
              <i class="bi bi-circle"></i><span>Add Event</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=event_list">
              <i class="bi bi-circle"></i><span>My Events</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=event_alllist">
              <i class="bi bi-circle"></i><span>All Events</span>
            </a>
          </li>
          
           <li>
            <a href="./index2.php?page=event_myrescheduled">
              <i class="bi bi-circle"></i><span>My Rescheduled Events</span>
            </a>
          </li>
          
          <li>
            <a href="./index2.php?page=event_rescheduledall">
              <i class="bi bi-circle"></i><span>All Rescheduled Events</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Icons Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ticket-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-event"></i><span>Customer Support System</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ticket-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=cs_ticket_add">
              <i class="bi bi-circle"></i><span>Raise Your Ticket </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=cs_my_ticket">
              <i class="bi bi-circle"></i><span>All Tickets</span>
            </a>
          </li>
        
        </ul>
      </li>
      

      <li class="nav-heading">Reports</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="./index2.php?page=repempuploded">
          <i class="bi bi-person"></i>
          <span>Employee</span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#kip_reports" data-bs-toggle="collapse" href="#">
          <i class="bi bi-folder-fill"></i><span>KPI</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kip_reports" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=kpi_totalrevenu">
              <i class="bi bi-circle"></i><span>Total Revenue</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=kpi_totalcvsntfrm">
              <i class="bi bi-circle"></i><span>Total CV Sent </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=kpi_screeningratiofrom">
              <i class="bi bi-circle"></i><span>Screening Ratio</span>
            </a>
          </li>
            <li>
            <a href="./index2.php?page=datamatrix/datamatrix_selectefrm">
              <i class="bi bi-circle"></i><span>Matrix Data</span>
            </a>
          </li>
         
         
        </ul>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="./index2.php?page=educationhub_view">
         <i class="bi bi-windows"></i>
          <span>Knowledge Hub</span>
        </a>
      </li>
      
      <!----------------------------------------------------------- End Profile Page Nav ---------------------------------------------------------------------------->
      <?php }elseif($_SESSION['login_type'] == 2){ ?>
      
       <li class="nav-item">
        <a class="nav-link " href="ocr/ocrsystem.php">
          <i class="bi bi-cpu"></i>
          <span>OCR</span> &nbsp; &nbsp;<span style="color: #899bbd; font-size:10px;text-align:right;">&nbsp;- &nbsp;Recommend</span>
        </a>
      </li>
      
           <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Documents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
           <li>
            <!--<a href="./index2.php?page=test_file">-->
            <a href="ocr/ocrsystem.php">
              <i class="bi bi-circle"></i><span>OCR Upload</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=test_file">
              <i class="bi bi-circle"></i><span>Manual Upload</span>
            </a>
          </li>
          
         <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#dd-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span> My Documents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="dd-nav" class="nav-content collapse " >
          <li>
            <a href="./index2.php?page=document_list">
              <i class="bi bi-circle"></i><span>My All Documents </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=mypending">
              <i class="bi bi-circle"></i><span>Pending Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=myapproved">
              <i class="bi bi-circle"></i><span>Approved Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=myreject">
              <i class="bi bi-circle"></i><span>Rejected Documents</span>
            </a>
          </li>
        </ul>
      </li><!-- End 1st dd list Nav -->
      
       
        </ul>
      </li><!-- End Forms Nav -->
      
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#project-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-folder-fill"></i><span>Job Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="project-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=jobmangement">
              <i class="bi bi-circle"></i><span>Add Data</span>
            </a>
          </li>
                     <li>
            <a href="./index2.php?page=jobmangement_mylist">
              <i class="bi bi-circle"></i><span>My Data</span>
            </a>
          </li>
           <li>
            <a href="./index2.php?page=jobmangement_list">
              <i class="bi bi-circle"></i><span>All Data</span>
            </a>
          </li>
           <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#job-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-circle-fill"></i><span>Job Status</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="job-nav" class="nav-content collapse ">
                  <li>
                    <a href="./index2.php?page=jobmangement_active">
                      <i class="bi bi-forward"></i><span>Active Jobs </span>
                    </a>
                  </li>
                             <li>
                    <a href="./index2.php?page=jobmangement_inactive">
                      <i class="bi bi-forward"></i><span>Inactive jobs</span>
                    </a>
                  </li>
               
                </ul>
             </li>
       
        </ul>
      </li><!-- End  Job Management Tables Nav -->


      <!--<li class="nav-item">-->
      <!--  <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">-->
      <!--    <i class="bi bi-bar-chart"></i><span>Time Tracker</span><i class="bi bi-chevron-down ms-auto"></i>-->
      <!--  </a>-->
      <!--  <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=timetracker">-->
      <!--        <i class="bi bi-circle"></i><span>Add Tracker</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=viewtimetracker">-->
      <!--        <i class="bi bi-circle"></i><span>My Time Tracker</span>-->
      <!--      </a>-->
      <!--    </li>-->
   
      <!--  </ul>-->
      <!--</li>-->
      <!-- End Charts Nav -->
    
     <li class="nav-item">
        <a class="nav-link collapsed" href="./index2.php?page=huntz">
          <i class="bi bi-card-list"></i>
          <span>Hunt</span>
        </a>
      </li>
 
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#cd-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Candidate Summary</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="cd-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=candidateinput">
              <i class="bi bi-circle"></i><span>Add Summary</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=candidate">
              <i class="bi bi-circle"></i><span>Summary List</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=mycandidatesummery">
              <i class="bi bi-circle"></i><span>My Summary</span>
            </a>
          </li>
        </ul>
      </li>
      
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link collapsed" data-bs-target="#ex-nav" data-bs-toggle="collapse" href="#">-->
      <!--    <i class="bi bi-gem"></i><span>Excuse Form</span><i class="bi bi-chevron-down ms-auto"></i>-->
      <!--  </a>-->
      <!--  <ul id="ex-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=excuseform">-->
      <!--        <i class="bi bi-circle"></i><span>Form</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=myexcuses">-->
      <!--        <i class="bi bi-circle"></i><span>My Excuses</span>-->
      <!--      </a>-->
      <!--    </li>-->
   
      <!--  </ul>-->
      <!--</li>-->
      
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#sl-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Hiring Confirmation</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="sl-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
            <a href="./index2.php?page=hireadd">
              <i class="bi bi-circle"></i><span>Add Hiring</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=mysalerevue">
              <i class="bi bi-circle"></i><span>My Hiring</span>
            </a>
          </li>
        </ul>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#calender-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-event"></i><span>Calender</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="calender-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=event_add">
              <i class="bi bi-circle"></i><span>Add Event</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=event_list">
              <i class="bi bi-circle"></i><span>Event List</span>
            </a>
          </li>
           <li>
            <a href="./index2.php?page=event_myrescheduled">
              <i class="bi bi-circle"></i><span>My Rescheduled Events</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Icons Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ticket-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-event"></i><span>Customer Support System</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ticket-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=cs_ticket_add">
              <i class="bi bi-circle"></i><span>Raise Your Ticket </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=cs_my_ticket">
              <i class="bi bi-circle"></i><span>All Tickets</span>
            </a>
          </li>
        
        </ul>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="./index2.php?page=educationhub_view">
         <i class="bi bi-windows"></i>
          <span>Knowledge Hub</span>
        </a>
      </li>
      <!------------------------------------------------------------------------------------------------------------------------------------------------------>
      <?php }elseif($_SESSION['login_type'] == 3){ ?>
       <li class="nav-item">
        <a class="nav-link " href="ocr/ocrsystem.php">
          <i class="bi bi-cpu"></i>
          <span>OCR</span> &nbsp; &nbsp;<span style="color: #899bbd; font-size:10px;text-align:right;">&nbsp;- &nbsp;Recommend</span>
        </a>
      </li>
      
           <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Documents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <!--<a href="./index2.php?page=test_file">-->
            <a href="ocr/ocrsystem.php">
              <i class="bi bi-circle"></i><span>OCR Upload</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=test_file">
              <i class="bi bi-circle"></i><span>Manual Upload</span>
            </a>
          </li>
          
         <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#dd-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span> My Documents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="dd-nav" class="nav-content collapse " >
          <li>
            <a href="./index2.php?page=document_list">
              <i class="bi bi-circle"></i><span>My All Documents </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=mypending">
              <i class="bi bi-circle"></i><span>Pending Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=myapproved">
              <i class="bi bi-circle"></i><span>Approved Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=myreject">
              <i class="bi bi-circle"></i><span>Rejected Documents</span>
            </a>
          </li>
        </ul>
      </li><!-- End 1st dd list Nav -->
      
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#db2-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span> All Documents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="db2-nav" class="nav-content collapse ">
          <li>
            <a href="./index2.php?page=adminalldocs">
              <i class="bi bi-circle"></i><span>All Documents </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=adminpending">
              <i class="bi bi-circle"></i><span>All Pending Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=adminapproved">
              <i class="bi bi-circle"></i><span>All Approved Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=adminreject">
              <i class="bi bi-circle"></i><span>All Rejected Documents</span>
            </a>
          </li>
        </ul>
      </li><!-- End 2st dd list Nav -->
       
        </ul>
      </li><!-- End Forms Nav -->
      
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Client</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=new_clint">
              <i class="bi bi-circle"></i><span>Add Client</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=clint">
              <i class="bi bi-circle"></i><span>Client List</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=clintsubaccount">
              <i class="bi bi-circle"></i><span>Sub Accounts</span>
            </a>
          </li>
          
          <li>
            <a href="./index2.php?page=poc">
              <i class="bi bi-circle"></i><span>POC</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->
      
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#project-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-folder-fill"></i><span>Job Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="project-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=jobmangement">
              <i class="bi bi-circle"></i><span>Add Data</span>
            </a>
          </li>
                     <li>
            <a href="./index2.php?page=jobmangement_mylist">
              <i class="bi bi-circle"></i><span>My Data</span>
            </a>
          </li>
           <li>
            <a href="./index2.php?page=jobmangement_list">
              <i class="bi bi-circle"></i><span>All Data</span>
            </a>
          </li>
          
           <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#job-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-circle-fill"></i><span>Job Status</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="job-nav" class="nav-content collapse ">
                  <li>
                    <a href="./index2.php?page=jobmangement_active">
                      <i class="bi bi-forward"></i><span>Active Jobs </span>
                    </a>
                  </li>
                             <li>
                    <a href="./index2.php?page=jobmangement_inactive">
                      <i class="bi bi-forward"></i><span>Inactive jobs</span>
                    </a>
                  </li>
               
                </ul>
             </li>
       
        </ul>
      </li><!-- End  Job Management Tables Nav -->
      
<!-- End Tables Nav -->
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">-->
      <!--    <i class="bi bi-bar-chart"></i><span>Time Tracker</span><i class="bi bi-chevron-down ms-auto"></i>-->
      <!--  </a>-->
      <!--  <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=timetracker">-->
      <!--        <i class="bi bi-circle"></i><span>Add Tracker</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=viewtimetracker">-->
      <!--        <i class="bi bi-circle"></i><span>My Time Tracker</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=vieztimetracker">-->
      <!--        <i class="bi bi-circle"></i><span>All Employee Details</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--  </ul>-->
      <!--</li><!-- End Charts Nav -->
    
     <li class="nav-item">
        <a class="nav-link collapsed" href="./index2.php?page=huntz">
          <i class="bi bi-card-list"></i>
          <span>Hunt</span>
        </a>
      </li>
      
     <!-- End Icons Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#cd-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Candidate Summary</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="cd-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=candidateinput">
              <i class="bi bi-circle"></i><span>Add Summary</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=candidate">
              <i class="bi bi-circle"></i><span>Summary List</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=mycandidatesummery">
              <i class="bi bi-circle"></i><span>My Summary</span>
            </a>
          </li>
        </ul>
      </li>
      
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link collapsed" data-bs-target="#ex-nav" data-bs-toggle="collapse" href="#">-->
      <!--    <i class="bi bi-gem"></i><span>Excuse Form</span><i class="bi bi-chevron-down ms-auto"></i>-->
      <!--  </a>-->
      <!--  <ul id="ex-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=excuseform">-->
      <!--        <i class="bi bi-circle"></i><span>Form</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=myexcuses">-->
      <!--        <i class="bi bi-circle"></i><span>My Excuses</span>-->
      <!--      </a>-->
      <!--    </li>-->
       
      <!--  </ul>-->
      <!--</li>-->
      
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#sl-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Hiring Confirmation</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="sl-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
            <a href="./index2.php?page=hireadd">
              <i class="bi bi-circle"></i><span>Add Hiring</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=mysalerevue">
              <i class="bi bi-circle"></i><span>My Hiring</span>
            </a>
          </li>
        </ul>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#calender-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-event"></i><span>Calender</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="calender-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=event_add">
              <i class="bi bi-circle"></i><span>Add Event</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=event_list">
              <i class="bi bi-circle"></i><span>Event List</span>
            </a>
          </li>
          
          <li>
            <a href="./index2.php?page=event_alllist">
              <i class="bi bi-circle"></i><span>All Event List</span>
            </a>
          </li>
          
           <li>
            <a href="./index2.php?page=event_myrescheduled">
              <i class="bi bi-circle"></i><span>My Rescheduled Events</span>
            </a>
          </li>
          
          <li>
            <a href="./index2.php?page=event_rescheduledall">
              <i class="bi bi-circle"></i><span>All Rescheduled Events</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ticket-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-event"></i><span>Customer Support System</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ticket-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=cs_ticket_add">
              <i class="bi bi-circle"></i><span>Raise Your Ticket </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=cs_my_ticket">
              <i class="bi bi-circle"></i><span>All Tickets</span>
            </a>
          </li>
        
        </ul>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="./index2.php?page=educationhub_view">
         <i class="bi bi-windows"></i>
          <span>Knowledge Hub</span>
        </a>
      </li>
      
       <?php }elseif($_SESSION['login_type'] == 4){ ?>
       
        <li class="nav-item">
        <a class="nav-link " href="ocr/ocrsystem.php">
          <i class="bi bi-cpu"></i>
          <span>OCR</span> &nbsp; &nbsp;<span style="color: #899bbd; font-size:10px;text-align:right;">&nbsp;- &nbsp;Recommend</span>
        </a>
      </li>
           <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Documents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=fr_document">
              <i class="bi bi-circle"></i><span>Add New</span>
            </a>
          </li>
          
         <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#dd-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span> My Documents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="dd-nav" class="nav-content collapse " >
          <li>
            <a href="./index2.php?page=document_list">
              <i class="bi bi-circle"></i><span>My All Documents </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=mypending">
              <i class="bi bi-circle"></i><span>Pending Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=myapproved">
              <i class="bi bi-circle"></i><span>Approved Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=myreject">
              <i class="bi bi-circle"></i><span>Rejected Documents</span>
            </a>
          </li>
        </ul>
      </li><!-- End 1st dd list Nav -->
      <!-- End 1st dd list Nav -->
       
        </ul>
      </li><!-- End Forms Nav -->
      <!--     <li class="nav-item">-->
      <!--  <a class="nav-link collapsed" data-bs-target="#forms-nav1" data-bs-toggle="collapse" href="#">-->
      <!--    <i class="bi bi-journal-text"></i><span>Approve / Pendding Documents</span><i class="bi bi-chevron-down ms-auto"></i>-->
      <!--  </a>-->
        
      <!--  <ul id="forms-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">-->
      <!--  <li>-->
      <!--      <a href="./index2.php?page=f_pedding_data">-->
      <!--        <i class="bi bi-circle"></i><span>Pendding Documents</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=f_approved_data">-->
      <!--        <i class="bi bi-circle"></i><span>All Approved </span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=f_rejected_data">-->
      <!--        <i class="bi bi-circle"></i><span>All Rejected </span>-->
      <!--      </a>-->
      <!--    </li>-->
       
      <!--  </ul>-->
      <!--</li>-->
      <!-- End Forms Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Time Tracker</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=f_timetraker">
              <i class="bi bi-circle"></i><span>Add Tracker</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=viewtimetracker">
              <i class="bi bi-circle"></i><span>My Time Tracker</span>
            </a>
          </li>
        </ul>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ticket-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-event"></i><span>Customer Support System</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ticket-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=cs_ticket_add">
              <i class="bi bi-circle"></i><span>Raise Your Ticket </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=cs_my_ticket">
              <i class="bi bi-circle"></i><span>All Tickets</span>
            </a>
          </li>
        
        </ul>
      </li>
      
      
      
       <?php }elseif($_SESSION['login_type'] == 5){ ?>
        <li class="nav-item">
        <a class="nav-link " href="ocr/ocrsystem.php">
          <i class="bi bi-cpu"></i>
          <span>OCR</span> &nbsp; &nbsp;<span style="color: #899bbd; font-size:10px;text-align:right;">&nbsp;- &nbsp;Recommend</span>
        </a>
      </li>
       
           <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Documents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=tempnew_document">
              <i class="bi bi-circle"></i><span>Add New</span>
            </a>
          </li>
          
         <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#dd-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span> My Documents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="dd-nav" class="nav-content collapse " >
          <li>
            <a href="./index2.php?page=document_list">
              <i class="bi bi-circle"></i><span>My All Documents </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=mypending">
              <i class="bi bi-circle"></i><span>Pending Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=myapproved">
              <i class="bi bi-circle"></i><span>Approved Documents</span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=myreject">
              <i class="bi bi-circle"></i><span>Rejected Documents</span>
            </a>
          </li>
        </ul>
      </li><!-- End 1st dd list Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ticket-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-event"></i><span>Customer Support System</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ticket-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="./index2.php?page=cs_ticket_add">
              <i class="bi bi-circle"></i><span>Raise Your Ticket </span>
            </a>
          </li>
          <li>
            <a href="./index2.php?page=cs_my_ticket">
              <i class="bi bi-circle"></i><span>All Tickets</span>
            </a>
          </li>
        
        </ul>
      </li>
      
       
        </ul>
      </li><!-- End Forms Nav -->
      
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">-->
      <!--    <i class="bi bi-bar-chart"></i><span>Time Tracker</span><i class="bi bi-chevron-down ms-auto"></i>-->
      <!--  </a>-->
      <!--  <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=timetracker">-->
      <!--        <i class="bi bi-circle"></i><span>Add Tracker</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=viewtimetracker">-->
      <!--        <i class="bi bi-circle"></i><span>My Time Tracker</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=vieztimetracker">-->
      <!--        <i class="bi bi-circle"></i><span>All Employee Details</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--  </ul>-->
      <!--</li>-->
      <!-- End Charts Nav -->
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link collapsed" data-bs-target="#ex-nav" data-bs-toggle="collapse" href="#">-->
      <!--    <i class="bi bi-gem"></i><span>Excuse Form</span><i class="bi bi-chevron-down ms-auto"></i>-->
      <!--  </a>-->
      <!--  <ul id="ex-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=excuseform">-->
      <!--        <i class="bi bi-circle"></i><span>Form</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li>-->
      <!--      <a href="./index2.php?page=myexcuses">-->
      <!--        <i class="bi bi-circle"></i><span>My Excuses</span>-->
      <!--      </a>-->
      <!--    </li>-->
       
      <!--  </ul>-->
      <!--</li>-->
       
        <?php } ?>

    </ul>