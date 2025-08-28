<?php
include 'db_connect.php';
$columns = ['status', 'ref_no', 'title', 'tag', 'position', 'industry', 'phonenumber', 'date_created'];

// Paging
$limit = $_POST['length'];
$start = $_POST['start'];
$search = $_POST['search']['value'];

// Filter inputs
$byskills = $_POST['byskills'] ?? '';
$bypostion = $_POST['bypostion'] ?? '';
$byindistry = $_POST['byindistry'] ?? '';

// Build WHERE clause
$where = "1=1";
if (!empty($search)) {
    $where .= " AND (title LIKE '%$search%' OR tag LIKE '%$search%' OR position LIKE '%$search%' OR industry LIKE '%$search%')";
}
if ($byskills) {
    $tag = str_replace(",", "|", $byskills);
    $where .= " AND tag REGEXP '$tag'";
}
if ($bypostion) {
    $position = str_replace(",", "|", $bypostion);
    $where .= " AND position REGEXP '$position'";
}
if ($byindistry) {
    $industry = str_replace(",", "|", $byindistry);
    $where .= " AND industry REGEXP '$industry'";
}

// Total records
$totalData = $conn->query("SELECT COUNT(*) as count FROM documents")->fetch_assoc()['count'];
$totalFiltered = $conn->query("SELECT COUNT(*) as count FROM documents WHERE $where")->fetch_assoc()['count'];

// Get data
$sql = "SELECT * FROM documents WHERE $where ORDER BY date_created DESC LIMIT $start, $limit";
$query = $conn->query($sql);

$data = [];
$i = $start + 1;
while ($row = $query->fetch_assoc()) {
    $status = '<span class="badge bg-warning">Pending</span>';
    if ($row['status'] == 1) $status = '<span class="badge bg-success">Approved</span>';
    if ($row['status'] == 2) $status = '<span class="badge bg-danger">Rejected</span>';

    $ref = ($row['ref_no'] <= 99) ? $row['recruiter']."00".$row['ref_no'] : $row['recruiter']."0".$row['ref_no'];

    $data[] = [
        $i++,
        $status,
        "<a href='index2.php?page=view_documentz&id={$row['id']}' target='_blank'><b>{$ref}</b></a>",
        "<a href='index2.php?page=view_documentz&id={$row['id']}' target='_blank'><b>".ucwords($row['title']." ".$row['last_name'])."</b></a>",
        ucwords($row['tag']),
        ucwords($row['position']),
        ucwords($row['industry']),
        $row['phonenumber'],
        $row['date']." ".$row['time']
    ];
}

// Response
echo json_encode([
    "draw" => intval($_POST['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
]);
