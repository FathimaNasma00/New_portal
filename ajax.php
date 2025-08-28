<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'lchecklogogin'){
	$lchecklogogin = $crud->lchecklogogin();
	if($lchecklogogin)
		echo $lchecklogogin;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'update_user'){
	$save = $crud->update_user();
	if($save)
		echo $save;
}
if($action == 'upload_file'){
	$save = $crud->upload_file();
	if($save)
		echo $save;
	// var_dump($_FILES);
}
if($action == 'remove_file'){
	$delete = $crud->remove_file();
	if($delete)
		echo $delete;
}

if($action == 'save_timetracker'){
	$save = $crud->save_timetracker();
	if($save)
		echo $save;
}

if($action == 'delete_tracker'){
	$save = $crud->delete_tracker();
	if($save)
		echo $save;
}
if($action == 'reson_upload'){
	$save = $crud->reson_upload();
	if($save)
		echo $save;
}

if($action == 'save_upload'){
	$save = $crud->save_upload();
	if($save)
		echo $save;
} 



if($action == 'editsave_upload'){
	$save = $crud->editsave_upload();
	if($save)
		echo $save;
}

if($action == 'rejectssave_reupload'){
	$save = $crud->rejectssave_reupload();
	if($save)
		echo $save;
}

if($action == 'tempsave_upload'){
	$save = $crud->tempsave_upload();
	if($save)
		echo $save;
}

/*Clint Mange*/

if($action == 'save_clint'){
	$save = $crud->save_clint();
	if($save)
		echo $save;
}

if($action == 'delete_clint'){
	$save = $crud->delete_clint();
	if($save)
		echo $save;
}
/*Clint End Mange*/

/*POC Mange*/

if($action == 'manage_poc'){
	$save = $crud->manage_poc();
	if($save)
		echo $save;
}

/*Candidate Mange*/
if($action == 'save_candidate'){
	$save = $crud->save_candidate();
	if($save)
		echo $save;
}
if($action == 'update_candidate'){
	$save = $crud->update_candidate();
	if($save)
		echo $save;
}


if($action == 'delete_candidate'){
	$delete = $crud->delete_candidate();
	if($delete)
		echo $delete;
}

/*candidate End Mange*/

/*Excuse Form*/
if($action == 'save_excuse'){
	$save = $crud->save_excuse();
	if($save)
		echo $save;
}

if($action == 'delete_excuse'){
	$delete = $crud->delete_excuse();
	if($delete)
		echo $delete;
}

/*End Excuse Form*/


/*Sale Form*/
if($action == 'save_saleform'){
	$save = $crud->save_saleform();
	if($save)
		echo $save;
}

if($action == 'delete_saleform'){
	$delete = $crud->delete_saleform();
	if($delete)
		echo $delete;
}

/*End Sale Form*/

/* TASK FORM  */ 
if($action == 'save_task'){
	$save = $crud->save_task();
	if($save)
		echo $save;
}
/* END */ 

if($action == 'comment_upload'){
	$save = $crud->comment_upload();
	if($save)
		echo $save;
}
if($action == 'delete_comment'){
	$delete = $crud->delete_comment();
	if($delete)
		echo $delete;
}


if($action == 'delete_file'){
	$delete = $crud->delete_file();
	if($delete)
		echo $delete;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
/*-------Sale Form--------*/
if($action == 'job_management'){
	$save = $crud->job_management();
	if($save)
		echo $save;
}

if($action == 'jb_reject'){
	$save = $crud->jb_reject();
	if($save)
		echo $save;
}


/*------End Sale Form-----*/

/*-------Calender Form--------*/

if($action == 'calender'){
	$save = $crud->calender();
	if($save)
		echo $save;
}
/*-------Calender Form--------*/
/*-------Ticket Form--------*/

if($action == 'save_csticket'){
	$save = $crud->save_csticket();
	if($save)
		echo $save;
}

if($action == "delete_ticket"){
	$delsete = $crud->delete_ticket();
	if($delsete)
		echo $delsete;
}

if($action == "update_ticket"){
	$save = $crud->update_ticket();
	if($save)
		echo $save;
}
if($action == "save_tkcomment"){
	$save = $crud->save_tkcomment();
	if($save)
		echo $save;
}
if($action == "delete_tkcomment"){
	$delsete = $crud->delete_tkcomment();
	if($delsete)
		echo $delsete;
}
/*-------End Ticket Form--------*/


ob_end_flush();
?>
