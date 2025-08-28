<?php

require('pdf/fpdf/fpdf.php');
require "db_connect.php";
  $id=$_GET["id"];
  //customer and invoice details
  $info=[
    "customer"=>"",
    "address"=>"",
    "city"=>"",
    "invoice_no"=>"",
    "invoice_date"=>"",
    "total_amt"=>"",
  ];
  
    $sql="SELECT job_management.id,job_management.jb_ref,job_management.jb_title,job_management.jb_type,job_management.emp_type,job_management.jb_workingtype,
                   job_management.jb_descrption,job_management.currency,job_management.paid_details,job_management.min_sal,job_management.max_sal,
                   job_management.deadline, concat(users.firstname,', ',users.middlename,' ',users.lastname) as name,clintmanege.clint_name,clintmanege.location,job_management.created_date  FROM job_management
                   INNER JOIN users ON (job_management.jb_recuiters = users.id)
                   INNER JOIN clintmanege  ON (job_management.jb_client = clintmanege.clint_id)
                   WHERE job_management.id='$id'";
  $res=$conn->query($sql);
  if($res->num_rows>0){
	  $row=$res->fetch_assoc();
	  
  }

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(80, 5, '', 0, 0,"C");
$pdf->Cell(58, 5, 'JOB SHEET', 0, 0);
$pdf->Line(10, 20, 200, 20);

$pdf->Ln(15);
// $pdf->Cell(25, 5, 'Date', 0, 0);
// $pdf->Cell(52, 5, ': 2018-12-24 11:47:10 AM', 0, 1);

// $pdf->Cell(55, 5, 'Amount', 0, 0);
// $pdf->Cell(58, 5, ': 2674', 0, 0);
// $pdf->Cell(25, 5, 'Channel', 0, 0);
// $pdf->Cell(52, 5, ': WEB', 0, 1);

// $pdf->Cell(55, 5, 'Status', 0, 0);
// $pdf->Cell(58, 5, ': Complete', 0, 1);

$pdf->Cell(55, 5, 'Job Reference', 0, 0);
$pdf->Cell(58, 5, ': '.$row["jb_ref"], 0, 1);

$pdf->Cell(55, 5, 'Designation', 0, 0);
$pdf->Cell(58, 5, ': '.$row["jb_title"], 0, 1);

$pdf->Cell(55, 5, 'Work Type', 0, 0);
$pdf->Cell(58, 5, ': '.$row["jb_workingtype"], 0, 1);

$pdf->Cell(55, 5, 'Client Name', 0, 0);
$pdf->Cell(58, 5, ': '.$row["clint_name"], 0, 1);

$pdf->Cell(55, 5, 'Client Location', 0, 0);
$pdf->Cell(58, 5, ': '.$row["location"], 0, 1);

$pdf->Ln(10);
$pdf->Line(10, 60, 200, 60);

$pdf->Ln(5);//Line break
$pdf->Cell(55, 5, 'Recruitment Fee', 0, 0);
$pdf->Cell(58, 5, ': 100% of the selected Candidates Basic Salary. ', 0, 1);

//Line break
$pdf->Ln(8);
$pdf->Line(10, 75, 200, 75);
$pdf->Cell(55, 5, 'Key Requirements', 0, 0);
$pdf->Cell(58, 5, ' ', 0, 1);

$pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, ''.$row["jb_descrption"], 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Review and analyze business and user requirements.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Ensure the functionality, usability, performance, and support-ability of the requirements.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Develop detailed functional requirements leading in to system design.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Analyze required system integrations and provide API specifications to the technical team', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Assist in intepreting highly complex requirements on large mission - crtitical projects.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Develop business proposals for software solutions to meet requirements.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Review and critique technical solutions to ensure they meet the necessary requirements.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Lead Change Control activities. This includes drafting of change control records, technical imlementation plans, deviations, and updates to support documentation.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Develop business process workflow diagrams and systems level logical/physical architecture diagrams.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Conduct, provide and be accountable for the accuracy of project work estimates.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Work with tech lead to analyze and resolve technical deviations in requirements.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Formulate options and assess their relative merits and risks, and work with 
// respective stakeholders to determine the best solution.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Readily re-apply technical and business insights to new situations.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Analyse existing software systems and procedure that need evalution to identify deficiencies and make reccomendations. Knowledge, Experience and SKills .', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Strong business and technology acumen; solid understanding of software services, processes, measures and related capabilities. ', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Experience interfacing with Business Owners to gather requirements is required.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Understanding of database design principles and system analysis.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Ability to analyze complex business problems and evaluate solutions.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Ability to learn and adapt multiple domains.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Excellent analytical, problem solving, and troubleshooting skills.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Highly organized, results-oriented and attentive to details.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* 5+ years of business analysis experience in both technical and functional roles.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* BA/BS or MA/MS in Technology or Business equivalent.', 0, 1);

// $pdf->Cell(20, 5, ' ', 0, 0);
// $pdf->Cell(58, 5, '* Professional certifications such as CBAP.', 0, 1);


 




// $pdf->Line(155, 75, 195, 75);
// $pdf->Ln(5);//Line break
// $pdf->Cell(140, 5, '', 0, 0);
// $pdf->Cell(50, 5, ': Signature', 0, 1, 'C');

$pdf->Output();
?>