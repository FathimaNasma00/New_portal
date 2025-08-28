<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(firstname,', ',lastname,' ',middlename) as name, id FROM users where email = '".$email."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				 return 1;
			
		}else{
			return 3;
		}
	}
	 function lchecklogogin(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(firstname,', ',lastname,' ',middlename) as name, id FROM users where email = '".$email."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				 return 1;
			
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}

	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_FILES['img']['tmp_name'] != '')
			$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	
	function delete_comment(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM comment where id = ".$id);
		if($delete)
			return 1;
	}
	
	function upload_file(){
		extract($_FILES['file']);
		// var_dump($_FILES);
		if($tmp_name != ''){
				$fname = strtotime(date('y-m-d H:i')).'_'.$name;
				$move = move_uploaded_file($tmp_name,'assets/uploads/'. $fname);
		}
		if(isset($move) && $move){
			return json_encode(array("status"=>1,"fname"=>$fname));
		}
	}
	function remove_file(){
		extract($_POST);
		if(is_file('assets/uploads/'.$fname))
			unlink('assets/uploads/'.$fname);
		return 1;
	}
	function delete_file(){
		extract($_POST);
		$doc = $this->db->query("SELECT * FROM documents where id= $id")->fetch_array();
		$delete = $this->db->query("DELETE FROM documents where id = ".$id);
		if($delete){
			foreach(json_decode($doc['file_json']) as $k => $v){
				if(is_file('assets/uploads/'.$v))
				unlink('assets/uploads/'.$v);
			}
			return 1;
		}
	}
	function save_upload(){
        date_default_timezone_set("Asia/colombo");
        $date = date("Y-m-d");
        $time= date("h:i:sa");
        $datetime=date("Y-m-d h:i:sa");
		extract($_POST);
		$doc = $this->db->query("SELECT ref_no FROM `documents` WHERE `recruiter`='$recruiter'  ORDER BY `id` DESC LIMIT 1 ")->fetch_array();
		$docsz=$doc['ref_no']+1;
		// var_dump($_FILES);
		$data = " ref_no ='$docsz' ";
		$data .= ", title ='$title' ";
		$data .= ", last_name ='$lastname' ";
        $data .= ", phonenumber ='$phonenumber' ";
        $data .= ", email ='$email' ";
        $data .= ", tag ='$tag' ";
        $data .= ", position ='$position' ";
        $data .= ", industry ='$industry' ";
		$data .= ", description ='".htmlentities(str_replace("'","&#x2019;",$description))."' ";
		$data .= ", user_id ='{$_SESSION['login_id']}' ";
		$data .= ", file_json ='".json_encode($fname)."' ";
        $data .= ", status ='0' ";
        $data .= ", recruiter ='$recruiter' ";
        $data .= ", date ='$date' ";
        $data .= ", time ='$time' ";
        $data .= ", created_datetime ='$datetime' ";
        
		if(empty($id)){
			$save = $this->db->query("INSERT INTO documents set $data ");
		}else{
			$save = $this->db->query("UPDATE documents set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function editsave_upload(){
        date_default_timezone_set("Asia/colombo");
        $date = date("Y-m-d");
		extract($_POST);
		// var_dump($_FILES);
		$data = " ref_no ='$refno' ";
		$data .= ", title ='$title' ";
		$data .= ", last_name ='$lastname' ";
        $data .= ", gender ='$gender' ";
        $data .= ", phonenumber ='$phonenumber' ";
        $data .= ", email ='$email' ";
        $data  = ", home_address = '$home_address' ";
        $data .= ", home_town = '$home_town' ";
        $data .= ", years_of_experience = '$years_of_experience' ";
        $data .= ", experience = '$experience' ";
        $data .= ", education = '$education' ";
        $data .= ", linkedIn_link = '$linkedIn_link' ";
        $data .= ", tag ='$tag' ";
        $data .= ", position ='$position' ";
        $data .= ", industry ='$industry' ";
		$data .= ", description ='".htmlentities(str_replace("'","&#x2019;",$description))."' ";
		$data .= ", user_id ='$logid' ";
		$data .= ", file_json ='".json_encode($fname)."' ";
        $data .= ", status ='0' ";
        $data .= ", recruiter ='$recruiter' ";

		if(empty($id)){
			$save = $this->db->query("INSERT INTO documents set $data ");
		}else{
			$save = $this->db->query("UPDATE documents set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	
	function rejectssave_reupload(){
        date_default_timezone_set("Asia/colombo");
        $date = date("Y-m-d");
         $time= date("h:i:sa");
         $datetime=date("Y-m-d h:i:sa");
		extract($_POST);
		// var_dump($_FILES);
		$data = " ref_no ='$refno' ";
		$data .= ", title ='$title' ";
		$data .= ", last_name ='$lastname' ";
        $data .= ", phonenumber ='$phonenumber' ";
        $data .= ", email ='$email' ";
        $data .= ", tag ='$tag' ";
        $data .= ", position ='$position' ";
        $data .= ", industry ='$industry' ";
		$data .= ", description ='".htmlentities(str_replace("'","&#x2019;",$description))."' ";
		$data .= ", user_id ='$logid' ";
		$data .= ", file_json ='".json_encode($fname)."' ";
        $data .= ", status ='0' ";
        $data .= ", recruiter ='$recruiter' ";
        $data .= ", date ='$date' ";
        $data .= ", time ='$time' ";
        $data .= ", created_datetime ='$datetime' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO documents set $data ");
		}else{
			$save = $this->db->query("UPDATE documents set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	
	
		function tempsave_upload(){
        date_default_timezone_set("Asia/colombo");
        $date = date("Y-m-d");
         $time= date("h:i:sa");
		extract($_POST);
		$doc = $this->db->query("SELECT ref_no FROM `documents` WHERE `recruiter`='$recruiter'  ORDER BY `id` DESC LIMIT 1 ")->fetch_array();
		$docsz=$doc['ref_no']+1;
		// var_dump($_FILES);
        $data = " ref_no ='$docsz' ";
		$data .= ", title ='$title' ";
		$data .= ", last_name ='$lastname' ";
        $data .= ", phonenumber ='$phonenumber' ";
        $data .= ", email ='$email' ";
        $data .= ", tag ='$tag' ";
        $data .= ", position ='$position' ";
        $data .= ", industry ='$industry' ";
		$data .= ", description ='".htmlentities(str_replace("'","&#x2019;",$description))."' ";
		$data .= ", user_id ='{$_SESSION['login_id']}' ";
		$data .= ", file_json ='".json_encode($fname)."' ";
        $data .= ", status ='0' ";
        $data .= ", recruiter ='$recruiter' ";
        $data .= ", date ='$date' ";
        $data .= ", time ='$time' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO documents set $data ");
		}else{
			$save = $this->db->query("UPDATE documents set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	
	
	  /*POC*/
    function manage_poc(){
		extract($_POST);

	
        $data = "name ='$name' ";
        $data .= ", designation ='$designation' ";
        $data .= ", division ='$division' ";
        $data .= ", email ='$email' ";
        $data .= ", phonenumber ='$phonenumber' ";
		$data .= ", user_id ='{$_SESSION['login_id']}' ";
	
		if(empty($id)){
			$save = $this->db->query("INSERT INTO poc_mange set $data");
		}else{
			$save = $this->db->query("UPDATE poc_mange set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	  /*Clint*/
    function save_clint(){
		extract($_POST);

	
        $data = "clint_name ='$clintname' ";
        $data .= ", location ='$location' ";
        $data .= ", address ='$address' ";
        $data .= ", type ='$type' ";
        $data .= ", subacount ='$subacount' ";
		$data .= ", agstart ='$agstart' ";
		$data .= ", agend ='$agend' ";
	
		if(empty($id)){
			$save = $this->db->query("INSERT INTO clintmanege set $data");
		}else{
			$save = $this->db->query("UPDATE clintmanege set $data where clint_id = $id");
		}

		if($save){
			return 1;
		}
	}
    
    function delete_clint(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM clintmanege where clint_id = ".$id);
		if($delete)
			return 1;
	}
    /*Clint End*/
    
    /*Candidate mangement*/
    
    	function save_candidate() {
    date_default_timezone_set("Asia/colombo");
    $date = date("Y-m-d");
    extract($_POST);

    // Create data string
    $data = " clint_id ='$clints' ";
    $data .= ", application_id ='$appli_ids' ";
    $data .= ", feedback ='$feedback' ";
    $data .= ", other_feedback ='$other_feedback' ";
    $data .= ", recuiter ='$recuiter' ";
    $data .= ", log_id ='$sesid' ";
    $data .= ", job_refno ='$job_refno' ";
    $data .= ", source_by ='$source_by' ";
    $data .= ", candi_updatedate ='$candi_updatedate' ";
    $data .= ", description ='".htmlentities(str_replace("'","&#x2019;",$description))."' ";
    $data .= ", user_id ='{$_SESSION['login_id']}' ";
    $data .= ", date ='$date' ";

    if (empty($id)) {
        // Insert new record
        $save = $this->db->query("INSERT INTO candidate_summery SET $data");
        
        

        // If insertion successful, return 1
        if ($save) {
             $this->commentauto_upload($appli_ids, $feedback);
            return 1;
        }
    } else {
        // Fetch existing data
        $existing_data_query = $this->db->query("SELECT * FROM candidate_summery WHERE id = $id");
        $existing_data = $existing_data_query->fetch_assoc();

        // Move existing data to history table
        $insert_history = $this->db->query("INSERT INTO candidate_summeryhistory (id, clint_id, application_id, feedback, other_feedback, recuiter, log_id, job_refno, source_by, candi_updatedate, description, user_id, date) VALUES ('{$existing_data['id']}', '{$existing_data['clint_id']}', '{$existing_data['application_id']}', '{$existing_data['feedback']}', '{$existing_data['other_feedback']}', '{$existing_data['recuiter']}', '{$existing_data['log_id']}', '{$existing_data['job_refno']}', '{$existing_data['source_by']}', '{$existing_data['candi_updatedate']}', '{$existing_data['description']}', '{$existing_data['user_id']}', '{$existing_data['date']}')");

        // If insertion into history successful, update existing record
        if ($insert_history) {
            // Update existing record with new data
            $update = $this->db->query("UPDATE candidate_summery SET $data WHERE id = $id");
            
            
            // If update successful, return 1
            if ($update) {
                $this->commentauto_upload($appli_ids, $feedback);
                return 1;
            }
        }
    }

    // Return 0 if operation fails
    return 0;
}

// New function to handle comment upload
function commentauto_upload($file_id, $feedback) {
    date_default_timezone_set("Asia/Colombo");
    $date = date("Y-m-d");

    // Create comment data string
    $data = " file_id ='$file_id' ";
    $data .= ", comment ='$feedback' ";
    $data .= ", recuiter ='{$_SESSION['login_id']}' ";
    $data .= ", date ='$date' ";

    // Insert comment into the database
    $save = $this->db->query("INSERT INTO comment SET $data");

    return $save ? 1 : 0;
}


    	function update_candidate(){
        date_default_timezone_set("Asia/colombo");
        $date = date("Y-m-d");
		extract($_POST);
		// var_dump($_FILES);
    	if($feedback == $feedback){
        $data = " feedback ='$feedback' ";
        $data .= ", other_feedback ='$other_feedback' ";
		$data .= ", description ='".htmlentities(str_replace("'","&#x2019;",$description))."' ";
	
		    $save = $this->db->query("UPDATE candidate_summery set $data where id = $id");
    	}else{
    	 $data = " clint_id ='$clints' ";
        $data .= ", application_id ='$appli_ids' ";
        $data .= ", feedback ='$feedback' ";
        $data .= ", other_feedback ='$other_feedback' ";
        $data .= ", recuiter ='$recuiter' ";
        $data .= ", job_refno ='$job_refno' ";
        $data .= ", source_by ='$source_by' ";
        $data .= ", candi_updatedate ='$candi_updatedate' ";
        $data .= ", log_id ='$sesid' ";
		$data .= ", description ='".htmlentities(str_replace("'","&#x2019;",$description))."' ";
		$data .= ", user_id ='{$_SESSION['login_id']}' ";
        $data .= ", date ='$date' ";
        
    	    	$save = $this->db->query("INSERT INTO candidate_summery set $data ");
    	}
		if($save){
			return 1;
		}
	}
    
    function delete_candidate(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM candidate_summery where id = ".$id);
		if($delete)
			return 1;
	}
    /*Candidate mangement End*/
    
    
	function comment_upload(){
        date_default_timezone_set("Asia/colombo");
        $date = date("Y-m-d");
		extract($_POST);
		// var_dump($_FILES);
		$data = " file_id ='$id' ";
		$data .= ", comment ='$comment' ";
		$data .= ", recuiter ='{$_SESSION['login_id']}' ";
        $data .= ", date ='$date' ";
        
		$save = $this->db->query("INSERT INTO comment set $data ");
	
		if($save){
			return 1;
		}
	}
	

	
	function reson_upload(){
   
		extract($_POST);
		// var_dump($_FILES);

		$data = "reject_resons ='".htmlentities(str_replace("'","&#x2019;",$resons))."' ";
	
	
	    $save = $this->db->query("UPDATE documents set $data where id = $id");
		
		if($save){
			return 1;
		}
	}
	
	
	function save_excuse(){
        date_default_timezone_set("Asia/colombo");
        $date = date("Y-m-d");
		extract($_POST);
		// var_dump($_FILES);
		$data = " logid ='$sesid' ";
		$data .= ", recuiter ='$recruiter' ";
        $data .= ", mistake ='".htmlentities(str_replace("'","&#x2019;",$mistake))."' ";
        $data .= ", reason ='".htmlentities(str_replace("'","&#x2019;",$reason))."' ";
		$data .= ", user_id ='{$_SESSION['login_id']}' ";
        $data .= ", date ='$date' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO excuse_list set $data ");
		}else{
			$save = $this->db->query("UPDATE excuse_list set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	
	function delete_excuse(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM excuse_list where id = ".$id);
		if($delete)
			return 1;
	}
	
	function save_saleform(){
        date_default_timezone_set("Asia/colombo");
		extract($_POST);
		// var_dump($_FILES);
		$data = " candidate ='$appli_ids' ";
		$data .= ", amount ='$amount' ";
		$data .= ", client ='$clints' ";
		$data .= ", month ='".date("M",strtotime($join_date))."' ";
        $data .= ", join_date ='$join_date' ";
		$data .= ", user_id ='{$_SESSION['login_id']}' ";
		$data .= ", year ='".date("Y",strtotime($join_date))."' ";
		$data .= ", account_manger ='$recuiter' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO sale_target set $data");
		}else{
			$save = $this->db->query("UPDATE sale_target set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	
	function delete_saleform(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM sale_target where id = ".$id);
		if($delete)
			return 1;
	}
	
	
	
	function save_timetracker(){
        date_default_timezone_set("Asia/colombo");
        $date = date("Y-m-d");
		extract($_POST);
		// var_dump($_FILES);
		$data = " log_id ='$sesid' ";
		$data .= ", recruiter ='$recruiter' ";
        $data .= ", task ='$task' ";
        $data .= ", other_task ='$other_task' ";
        $data .= ", starttime ='$starttime' ";
        $data .= ", endtime ='$endtime' ";
        $data .= ", count ='$count' ";
        $data .= ", types ='$types' ";
		$data .= ", description ='".htmlentities(str_replace("'","&#x2019;",$description))."' ";
		$data .= ", user_id ='{$_SESSION['login_id']}' ";
        $data .= ", date ='$date' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO timetracker set $data ");
		}else{
			$save = $this->db->query("UPDATE timetracker set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	
	/* TASK MANAGERE*/
        function save_task(){
		extract($_POST);
			$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','user_ids')) && !is_numeric($k)){
				if($k == 'rolname')
					$v = htmlentities(str_replace("'","&#x2019;",$v));
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(isset($user_ids)){
			$data .= ", user_ids='".implode(',',$user_ids)."' ";
		}
		
		// echo $data;exit;
		if(empty($id)){
			$save = $this->db->query("INSERT INTO project_list set $data");
		}else{
			$save = $this->db->query("UPDATE project_list set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	
        /* END TASK*/ 
        
        /*--------------------------- Job Management ----------------------------------*/ 
        function job_management(){
        date_default_timezone_set("Asia/colombo");
        $date = date("Y-m-d");
        $time= date("h:i:sa");
		extract($_POST);
		// var_dump($_FILES);
		$data  = "jb_refco ='$jb_refcount' ";
		$data .= ",jb_ref ='$jb_ref' ";
		$data .= ", jb_title ='$jb_title' ";
		$data .= ", jb_type ='$jb_type' ";
        $data .= ", emp_type ='$emp_type' ";
        $data .= ", jb_client ='$jb_client' ";
        $data .= ", jb_workingtype ='$jb_workingtype' ";
		$data .= ", jb_descrption ='".htmlentities(str_replace("'","&#x2019;",$jb_descrption))."' ";
		$data .= ", jb_fiels ='".json_encode($jb_fiels)."' ";
        $data .= ", currency ='$currency' ";
        $data .= ", paid_details ='$paid_details' ";
        $data .= ", min_sal ='$min_sal' ";
        $data .= ", max_sal ='$max_sal' ";
        $data .= ", deadline ='$deadline' ";
        $data .= ", opencount ='$opencount' ";
        $data .= ", initialforecasted ='$initialforecasted' ";
        $data .= ", jb_recuiters='".implode(',',$jb_recuiters)."' ";
        $data .= ", user_id ='{$_SESSION['login_id']}' ";
        $data .= ", jb_date ='$date' ";
        
		if(empty($id)){
			$save = $this->db->query("INSERT INTO job_management set $data ");
		}elseif($jb_type== "RO"){
		    
		    $month = date("m");
            $year = date("y");
		   	$refrco = $this->db->query("SELECT jb_refco FROM `job_management` ORDER BY `id` DESC LIMIT 1 ")->fetch_array();
	    	$refjb=$refrco['jb_refco']+1;
            $jbref ="JB".'/'.$year.'/'.$month.'/'.$refjb;
            
            $data  = "jb_refco ='$jb_refcount' ";
            $data .= ",jb_ref ='$jb_ref' ";
            $data .= ", jb_title ='$jb_title' ";
    		$data .= ", jb_type ='$jb_type' ";
            $data .= ", emp_type ='$emp_type' ";
            $data .= ", jb_client ='$jb_client' ";
            $data .= ", jb_workingtype ='$jb_workingtype' ";
    		$data .= ", jb_descrption ='".htmlentities(str_replace("'","&#x2019;",$jb_descrption))."' ";
    		$data .= ", jb_fiels ='".json_encode($jb_fiels)."' ";
            $data .= ", currency ='$currency' ";
            $data .= ", paid_details ='$paid_details' ";
            $data .= ", min_sal ='$min_sal' ";
            $data .= ", max_sal ='$max_sal' ";
            $data .= ", deadline ='$deadline' ";
            $data .= ", opencount ='$opencount' "; 
            $data .= ", initialforecasted ='$initialforecasted' "; 
            $data .= ", jb_recuiters='".implode(',',$jb_recuiters)."' ";
            $data .= ", user_id ='{$_SESSION['login_id']}' ";
            $data .= ", status ='1' ";
            $data .= ", jb_date ='$date' ";
            
		   	$save = $this->db->query("INSERT INTO job_management set $data ");
		}elseif($jb_type== "Closed"){
		    
		    $month = date("m");
            $year = date("y");
		   	$refrco = $this->db->query("SELECT jb_refco FROM `job_management` ORDER BY `id` DESC LIMIT 1 ")->fetch_array();
	    	$refjb=$refrco['jb_refco']+1;
            $jbref ="JB".'/'.$year.'/'.$month.'/'.$refjb;
            
            $data  = "jb_refco ='$jb_refcount' ";
            $data .= ",jb_ref ='$jb_ref' ";
            $data .= ", jb_title ='$jb_title' ";
    		$data .= ", jb_type ='Closed' ";
            $data .= ", emp_type ='$emp_type' ";
            $data .= ", jb_client ='$jb_client' ";
            $data .= ", jb_workingtype ='$jb_workingtype' ";
    		$data .= ", jb_descrption ='".htmlentities(str_replace("'","&#x2019;",$jb_descrption))."' ";
    		$data .= ", jb_fiels ='".json_encode($jb_fiels)."' ";
            $data .= ", currency ='$currency' ";
            $data .= ", paid_details ='$paid_details' ";
            $data .= ", min_sal ='$min_sal' ";
            $data .= ", max_sal ='$max_sal' ";
            $data .= ", deadline ='$deadline' ";
            $data .= ", jb_recuiters='".implode(',',$jb_recuiters)."' ";
            $data .= ", opencount ='$opencount' ";
            $data .= ", initialforecasted ='$initialforecasted' ";
            $data .= ", user_id ='{$_SESSION['login_id']}' ";
            $data .= ", status ='0' ";
            $data .= ", jb_date ='$date' ";
            
		   	$save = $this->db->query("INSERT INTO job_management set $data ");
		}else{
		$dataz  = "jb_refco ='$jb_refcount' ";
		$dataz .= ",jb_ref ='$jb_ref' ";
		$dataz .= ", jb_title ='$jb_title' ";
		$dataz .= ", jb_type ='$jb_type' ";
        $dataz .= ", emp_type ='$emp_type' ";
        $dataz .= ", jb_client ='$jb_client' ";
        $dataz .= ", jb_workingtype ='$jb_workingtype' ";
		$dataz .= ", jb_descrption ='".htmlentities(str_replace("'","&#x2019;",$jb_descrption))."' ";
		$dataz .= ", jb_fiels ='".json_encode($jb_fiels)."' ";
        $dataz .= ", currency ='$currency' ";
        $dataz .= ", paid_details ='$paid_details' ";
        $dataz .= ", min_sal ='$min_sal' ";
        $dataz .= ", max_sal ='$max_sal' ";
        $dataz .= ", deadline ='$deadline' ";
        $dataz .= ", opencount ='$opencount' ";
        $dataz .= ", initialforecasted ='$initialforecasted' ";
        $dataz .= ", jb_recuiters='".implode(',',$jb_recuiters)."' ";
        $dataz .= ", user_id ='{$_SESSION['login_id']}' ";
			$save = $this->db->query("UPDATE job_management set $dataz where id = $id");
		}
		
		if($save){
			return 1;
		}
	}
	
	
		function jb_reject(){
            date_default_timezone_set("Asia/colombo");
            $date = date("Y-m-d");
            $time = date("h:i:sa");
		extract($_POST);
		// var_dump($_FILES);
		
		    $data  = "job_id ='$id' ";
            $data .= ",status ='$status' ";
            $data .= ",reasons ='".htmlentities(str_replace("'","&#x2019;",$jb_descrption))."' ";
            $data .= ",user_id ='$accby' ";
            $data .= ",date ='$date' ";
            $data .= ", time ='$time' ";


				$save = $this->db->query("INSERT INTO job_designation set $data ");

		if($save){
			return 1;
		}
	}
	

        
        /*------------------------------Job Managemnt End-------------------------------------------- */ 
        /*----------------------------------Calender--------------------------------*/ 
        function calender(){

		extract($_POST);
	
        $data = "title ='$title' ";
        $data .= ", candidate_id ='$candidate' ";
        $data .= ", client_id ='$clints' ";
        $data .= ", job_id ='$job_refno' ";
        $data .= ", start_datetime ='$start_date' ";
		$data .= ", user_id ='{$_SESSION['login_id']}' ";
	
		if(empty($id)){
			$save = $this->db->query("INSERT INTO events_calender set $data");
		}else{
			$save = $this->db->query("UPDATE events_calender set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	  /*----------------------------------End Calender--------------------------------*/ 
	   /*----------------------------------Ticket--------------------------------*/ 
  function save_csticket(){
    extract($_POST);

    $data = "subject ='$subject'";
    $data .= ", customer_id ='{$_SESSION['login_id']}'";
    $data .= ", department_id ='$department_id'";
    $data .= ", description ='$description'";
      
      if(empty($id)){
			$save = $this->db->query("INSERT INTO customer_support_tickets set $data");
		}else{
			$save = $this->db->query("UPDATE customer_support_tickets set $data where id = $id");
		}

		if($save){
			return 1;
		}
    }

	function update_ticket(){
		extract($_POST);
			$data = " status=$status ";
		if($_SESSION['login_type'] == 2)
			$data .= ", staff_id={$_SESSION['login_id']} ";
		$save = $this->db->query("UPDATE customer_support_tickets set $data where id = $id");
		if($save)
			return 1;
	}
	function delete_ticket(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM customer_support_tickets where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_tkcomment(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if($k == 'comment'){
					$v = htmlentities(str_replace("'","&#x2019;",$v));
				}
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
			$data .= ", user_type={$_SESSION['login_type']} ";
			$data .= ", user_id={$_SESSION['login_id']} ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO customer_support_comments set $data");
		}else{
			$save = $this->db->query("UPDATE customer_support_comments set $data where id = $id");
		}

		if($save)
			return 1;
	}
	function delete_tkcomment(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM customer_support_comments where id = ".$id);
		if($delete){
			return 1;
		}
	}
     /*----------------------------------End Ticket--------------------------------*/ 
	
}