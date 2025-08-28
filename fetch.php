<?php

//fetch.php

$conn = new PDO("mysql:host=localhost;dbname=skillsac_filestore", "skillsac_skillacademy", "skill_academy234");

$output = '';

$query = '';

if(isset($_POST["query"]))
{
 $search = str_replace(",", "|", $_POST["query"]);
 $query = "
 SELECT * FROM documents JOIN status ON status.status_id = documents.status 
 WHERE tag LIKE '%".$search."%' 
 ";
}
else
{
 $query = "
 SELECT * FROM documents  JOIN status ON status.status_id = documents.status
 ";
}



$statement = $conn->prepare($query);
$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
 $data[] = $row;
}

echo json_encode($data);

?>