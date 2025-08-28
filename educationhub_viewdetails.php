<?php
session_start();
require_once "db_connect.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid video ID.";
    exit();
}

$id = intval($_GET['id']);
$query = "SELECT * FROM education_videos WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Video not found.";
    exit();
}

$video = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($video['title']); ?> - Video Details</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f2f2f2; }
        .container { max-width: 100%; margin: auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        video { width: 100%; border-radius: 8px; }
        h1 { margin-top: 0; }
        .meta { color: #666; font-size: 14px; margin-bottom: 10px; }
        .description { margin-top: 20px; line-height: 1.6; }
    </style>
</head>
<body>
    <main>
    <div class="pagetitle">
      <h1>Knowledge Hub</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Knowledge Hub</li>
          <li class="breadcrumb-item active">View</li>
        </ol>
      </nav>
    </div>

    <section class="section">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="">
                    <div class="col-md-12">
                        
    <div class="container">
        <h1><?php echo htmlspecialchars($video['title']); ?></h1>
        <div class="meta">Uploaded on <?php echo date("F j, Y", strtotime($video['created_at'])); ?></div>
        <video controls>
            <source src="EducationHub/videos/<?php echo $video['video_file']; ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <br>
        <br>
        <style>
        .video-description p {
    font-size: 16px;
    line-height: 1.6;
    color: #333;
}

.video-description ul {
    margin-left: 20px;
    list-style-type: disc;
}

.video-description ul li {
    margin-bottom: 10px;
}

.video-description strong {
    font-weight: bold;
}
</style>
        
        <div class="video-description">
        <?php echo $video['description']; ?>
        </div>
         <!-- Check if the PDF exists and display the PDF link if available -->
        <?php if (!empty($video['pdf_document'])): ?>
            <div class="mt-3">
                <a href="EducationHub/pdfs/<?php echo $video['pdf_document']; ?>" target="_blank" class="btn btn-primary">View PDF</a>
            </div>
        <?php endif; ?>
        <br>
        <a href="/index2.php?page=educationhub_view">&larr; Back to Video List</a>
    </div>
                                      </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>
