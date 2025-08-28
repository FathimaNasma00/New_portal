  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
   	<a href="javascript:void(0)" class="brand-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <?php if(empty($_SESSION['login_avatar'])){ ?>
        <span class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 38px;height:50px"><?php echo strtoupper(substr($_SESSION['login_firstname'], 0,1).substr($_SESSION['login_lastname'], 0,1)) ?></span>
        <?php }else{ ?>
          <span class="image">
            <img src="assets/uploads/<?php echo $_SESSION['login_avatar'] ?>" style="width: 38px;height:38px" class="img-circle elevation-2" alt="User Image">
          </span>
        <?php } ?>
        <span class="brand-text font-weight-light"><?php echo ucwords($_SESSION['login_firstname'].' '.$_SESSION['login_lastname']) ?></span>

      </a>
      <div class="dropdown-menu" style="">
        <a class="dropdown-item manage_account" href="javascript:void(0)" data-id="<?php echo $_SESSION['login_id']; ?>">Manage Account</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="ajax.php?action=logout">Logout</a>
      </div>
    </div>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="index2.php" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>    
        <?php
        if($_SESSION['login_type']==1){
        ?>
        
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index2.php?page=new_user" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.php?page=user_list" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Documents
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index2.php?page=test_file" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                    <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
                    <i class="fas fa-angle-right nav-icon"></i>
                      <p>
                        My Documents
                      </p>
                    </a>
                     <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="./index2.php?page=document_list" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>My All Documents</p>
                            </a>
                          </li> 
                          <li class="nav-item">
                            <a href="./index.php?page=mypending" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Pending Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=myapproved" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Approved Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=myreject" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Rejected Documents</p>
                            </a>
                          </li>
                    </ul>
             </li>
             <li class="nav-item">
                    <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
                    <i class="fas fa-angle-right nav-icon"></i>
                      <p>
                        All Documents
                      </p>
                    </a>
                     <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="./index.php?page=adminalldocs" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>All Documents</p>
                            </a>
                          </li> 
                          <li class="nav-item">
                            <a href="./index.php?page=adminpending" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Pending Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=adminapproved" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Approved Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=adminreject" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Rejected Documents</p>
                            </a>
                          </li>
                    </ul>
             </li>
              
            </ul>
          </li>
  
          
            
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Task
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=task_list" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Task</p>
                </a>
              </li>
            </ul>
          </li>
          
          
            <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Tracker
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=timetracker" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Time Tracker</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=viewtimetracker" class="nav-link nav-document_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Time Tracker</p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="./index.php?page=vieztimetracker" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>All Employee Details</p>
                </a>
              </li>
              
            </ul>
          </li>
          
           <li class="nav-item">
            <a href="./index2.php?page=huntz" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Hunt
        
              </p>
            </a>
   
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Client
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_clint" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Client</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="./index.php?page=clint" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Client List</p>
                </a>
             </li>
              <li class="nav-item">
                <a href="./index.php?page=clintsubaccount" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Sub Accounts</p>
                </a>
             </li>
       
       
              
            </ul>
          </li> 
            
            
        <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Candidate Summary
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=candidateinput" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Summary</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="./index.php?page=candidate" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Summary List</p>
                </a>
             </li>
             
             <li class="nav-item">
                <a href="./index.php?page=mycandidatesummery" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Summary</p>
                </a>
             </li>
       
       
              
            </ul>
          </li> 
          
           <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon far fa-clipboard"></i>
              <p>
                Excuse Form
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=excuseform" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=myexcuses" class="nav-link nav-document_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Excuses</p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="./index.php?page=allexcuses" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>All Employees excuse</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fas fa-poll"></i>
              <p>
               Hiring Confirmation
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=listofsaletr" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>All Hiring</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="./index.php?page=mysalerevue" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Hiring</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=payment_list" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Payment Status</p>
                </a>
              </li>
              
              
            </ul>
          </li>
       
        <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=repempuploded" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Employee</p>
                </a>
              </li>
       
       
              
            </ul>
          </li>
       
        <?php }elseif($_SESSION['login_type'] == 2){ ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Documents
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index2.php?page=test_file" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                    <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
                    <i class="fas fa-angle-right nav-icon"></i>
                      <p>
                        My Documents
                      </p>
                    </a>
                     <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="./index2.php?page=document_list" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>My All Documents</p>
                            </a>
                          </li> 
                          <li class="nav-item">
                            <a href="./index.php?page=mypending" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Pending Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=myapproved" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Approved Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=myreject" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Rejected Documents</p>
                            </a>
                          </li>
                    </ul>
             </li>
            </ul>
          </li>
          
          
          <li class="nav-item">
            <a href="./index2.php?page=huntz" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Hunt
        
              </p>
            </a>
   
          </li>
            <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Tracker
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=timetracker" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Time Tracker</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="./index.php?page=viewtimetracker" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Time Tracker</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=activitytracker" class="nav-link nav-document_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Activity</p>
                </a>
              </li>
            </ul>
          </li>
          
        <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Candidate
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=candidateinput" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Summary</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="./index.php?page=candidate" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Summary List</p>
                </a>
             </li>
             
                 
             <li class="nav-item">
                <a href="./index.php?page=mycandidatesummery" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Summary</p>
                </a>
             </li>
       
       
              
            </ul>
          </li> 
          
           <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon far fa-clipboard"></i>
              <p>
                Excuse Form
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=excuseform" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=myexcuses" class="nav-link nav-document_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Excuses</p>
                </a>
              </li>
              
            </ul>
          </li>
           <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fas fa-poll"></i>
              <p>
               Hiring Confirmation
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=mysalerevue" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Hiring</p>
                </a>
              </li>
              
            </ul>
          </li>
            <?php }elseif($_SESSION['login_type'] == 3){ ?>
            
            <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Documents
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index2.php?page=test_file" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                    <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
                    <i class="fas fa-angle-right nav-icon"></i>
                      <p>
                        My Documents
                      </p>
                    </a>
                     <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="./index2.php?page=document_list" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>My All Documents</p>
                            </a>
                          </li> 
                          <li class="nav-item">
                            <a href="./index.php?page=mypending" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Pending Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=myapproved" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Approved Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=myreject" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Rejected Documents</p>
                            </a>
                          </li>
                    </ul>
             </li>
             <li class="nav-item">
                    <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
                    <i class="fas fa-angle-right nav-icon"></i>
                      <p>
                        All Documents
                      </p>
                    </a>
                     <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="./index.php?page=adminalldocs" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>All Documents</p>
                            </a>
                          </li> 
                          <li class="nav-item">
                            <a href="./index.php?page=adminpending" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Pending Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=adminapproved" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Approved Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=adminreject" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Rejected Documents</p>
                            </a>
                          </li>
                    </ul>
             </li>
              
            </ul>
          </li>
  
          
            <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Tracker
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=timetracker" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Time Tracker</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=viewtimetracker" class="nav-link nav-document_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Time Tracker</p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="./index.php?page=vieztimetracker" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>All Employee Details</p>
                </a>
              </li>
              
            </ul>
          </li>
           <li class="nav-item">
            <a href="./index2.php?page=huntz" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Hunt
        
              </p>
            </a>
   
          </li>
          
        <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Candidate
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=candidateinput" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Summary</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="./index.php?page=candidate" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Summary List</p>
                </a>
             </li>
             
             <li class="nav-item">
                <a href="./index.php?page=mycandidatesummery" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Summary</p>
                </a>
             </li>
       
              
            </ul>
          </li> 
          
           <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon far fa-clipboard"></i>
              <p>
                Excuse Form
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=excuseform" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=myexcuses" class="nav-link nav-document_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Excuses</p>
                </a>
              </li>
              
            </ul>
          </li>
          
           <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fas fa-poll"></i>
              <p>
               Hiring Confirmation
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=mysalerevue" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Hiring</p>
                </a>
              </li>
              
            </ul>
          </li>
             
        <?php }elseif($_SESSION['login_type'] == 4){ ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Documents
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index2.php?page=test_file" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
               <li class="nav-item">
                    <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
                    <i class="fas fa-angle-right nav-icon"></i>
                      <p>
                        My Documents
                      </p>
                    </a>
                     <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="./index2.php?page=document_list" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>My All Documents</p>
                            </a>
                          </li> 
                          <li class="nav-item">
                            <a href="./index.php?page=mypending" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Pending Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=myapproved" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Approved Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=myreject" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Rejected Documents</p>
                            </a>
                          </li>
                    </ul>
             </li>
            </ul>
          </li>
          
          
          <?php }elseif($_SESSION['login_type'] == 5){ ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Documents
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=tempnew_document" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                    <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
                    <i class="fas fa-angle-right nav-icon"></i>
                      <p>
                        My Documents
                      </p>
                    </a>
                     <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="./index2.php?page=document_list" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>My All Documents</p>
                            </a>
                          </li> 
                          <li class="nav-item">
                            <a href="./index.php?page=mypending" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Pending Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=myapproved" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Approved Documents</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="./index.php?page=myreject" class="nav-link nav-document_list tree-item">
                              <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                              <p>Rejected Documents</p>
                            </a>
                          </li>
                    </ul>
             </li>
            </ul>
          </li>
          
          
            <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Tracker
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=timetracker" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Time Tracker</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="./index.php?page=viewtimetracker" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Time Tracker</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=activitytracker" class="nav-link nav-document_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Activity</p>
                </a>
              </li>
            </ul>
          </li>
          
           <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon far fa-clipboard"></i>
              <p>
                Excuse Form
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=excuseform" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=myexcuses" class="nav-link nav-document_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>My Excuses</p>
                </a>
              </li>
              
            </ul>
          </li>
        <?php } ?>
        </ul>
      </nav>
    </div>
  </aside>
 <script>
//   	$(document).ready(function(){
//   		var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
//   		if($('.nav-link.nav-'+page).length > 0){
//   			$('.nav-link.nav-'+page).addClass('active')
//           console.log($('.nav-link.nav-'+page).hasClass('tree-item'))
//   			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
//           $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
//   				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
//   			}
//         if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
//           $('.nav-link.nav-'+page).parent().addClass('menu-open')
//         }

//   		}
//       $('.manage_account').click(function(){
//         uni_modal('Manage Account','manage_user.php?id='+$(this).attr('data-id'))
//       })
//   	})
$(document).ready(function(){
     $('.manage_account').click(function(){
        uni_modal('Manage Account','manage_user.php?id='+$(this).attr('data-id'))
      })
    
})
  </script>