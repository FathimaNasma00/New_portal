<?php
session_start();
require_once "db_connect.php";

$order_by = 'created_at';
if (isset($_GET['sort']) && ($_GET['sort'] === 'name')) {
    $order_by = 'title';
}

$query = "SELECT * FROM education_videos ORDER BY $order_by DESC";
$result = $conn->query($query);
?>

<main>
    <style>
        .video-card { 
            background: #f9f9f9; 
            padding: 15px; 
            border-radius: 10px; 
            text-align: center; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            transition: transform 0.3s ease;
        }
        .video-card:hover {
            transform: translateY(-5px);
        }
        .video-card img { 
            width: 100%; 
            height: auto; 
            border-radius: 8px; 
            cursor: pointer;
        }
        .sorting {
            margin-bottom: 20px;
        }
    </style>

    <div class="pagetitle">
      <h1>Knowledge Hub</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Knowledge Hub</li>
          <li class="breadcrumb-item active">View Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Knowledge Hub - View All Videos</h5>
                        <div class="text-left my-3">
                            <h6> 
                                <a href="/index2.php?page=educationhub_add" class="btn btn-primary">Add New Video</a>
                            </h6>
                        </div>
                        
                        <div class="container mt-5">
                            <!-- Sorting Form -->
                            <div class="sorting mb-4">
                                <form method="get" action="">
                                    <div class="d-flex justify-content-center">
                                        <label for="sort" class="form-label me-2">Sort by:</label>
                                        <select name="sort" id="sort" class="form-select w-auto" onchange="this.form.submit()">
                                            <option value="date" <?php echo $order_by === 'created_at' ? 'selected' : ''; ?>>Date</option>
                                            <option value="name" <?php echo $order_by === 'title' ? 'selected' : ''; ?>>Name</option>
                                        </select>
                                    </div>
                                </form>
                            </div>

                            <!-- Videos Grid -->
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <div class="col">
                                        <div class="video-card">
                                            <a href="./index2.php?page=educationhub_viewdetails&id=<?php echo $row['id']; ?>" class="text-decoration-none">
                                                <img src="EducationHub/thumbnails/<?php echo $row['thumbnail']; ?>" alt="Thumbnail for <?php echo htmlspecialchars($row['title']); ?>" />
                                            </a>
                                            <h5 class="mt-3"><?php echo htmlspecialchars($row['title']); ?></h5>
                                            <small class="text-muted">Uploaded on <?php echo date("M d, Y", strtotime($row['created_at'])); ?></small>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
