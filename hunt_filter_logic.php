<?php
include'db_connect.php';
date_default_timezone_set("Asia/Colombo");
$i = 1;
$where = '';

// Check if a filter is applied
if (isset($_POST["filter"])) {
    $skills = $_POST["skills"] ? str_replace(",", "|", $_POST["skills"]) : '';
    $position = $_POST["position"] ? str_replace(",", "|", $_POST["position"]) : '';
    $industry = $_POST["industry"] ? str_replace(",", "|", $_POST["industry"]) : '';

    $where .= " 
        tag REGEXP '{$skills}' AND
        position REGEXP '{$position}' AND
        industry REGEXP '{$industry}'";
}

// Fetch the documents based on the constructed WHERE clause
$qry = $conn->query("SELECT * FROM documents $where ORDER BY unix_timestamp(date_created) DESC");

while ($row = $qry->fetch_assoc()) {
    $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
    unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
    $desc = strtr(html_entity_decode($row['description']), $trans);
    $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);

    if ($row['ref_no'] <= 99) {
        $recq = $row['recruiter'];
        $reqanswr = $recq . "00" . $row['ref_no'];
    } else {
        $recq = $row['recruiter'];
        $reqanswr = $recq . "0" . $row['ref_no'];
    }
    $string = str_replace(' ', '', $reqanswr);

    $status_badge = "";
    if ($row['status'] == 0) {
        $status_badge = '<span class="badge bg-warning">Pending</span>';
    } elseif ($row['status'] == 1) {
        $status_badge = '<span class="badge bg-success">Approved</span>';
    } elseif ($row['status'] == 2) {
        $status_badge = '<span class="badge bg-danger">Rejected</span>';
    }
?>
    <tr>
        <th class="text-center" style="font-size:12px;"><?php echo $i++; ?></th>
        <td><?php echo $status_badge; ?></td>
        <td><a href="./index2.php?page=view_documentz&id=<?php echo $row['id']; ?>" target="_blank"><b style="font-size:14px;"><?php echo $string; ?></b></a></td>
        <td><a href="./index2.php?page=view_documentz&id=<?php echo $row['id']; ?>" target="_blank"><b style="font-size:14px;"><?php echo ucwords($row['title']); ?> <?php echo ucwords($row['last_name']); ?></b></a></td>
        <td><b style="font-size:10px;"><?php echo ucwords($row['tag']); ?></b></td>
        <td><b style="font-size:10px;"><?php echo ucwords($row['position']); ?></b></td>
        <td><b style="font-size:10px;"><?php echo ucwords($row['industry']); ?></b></td>
        <td><b style="font-size:14px;"><?php echo ucwords($row['phonenumber']); ?></b></td>
        <td><b style="font-size:14px;"><?php echo ucwords($row['date']); ?> <?php echo ucwords($row['time']); ?></b></td>
    </tr>
<?php } ?>
