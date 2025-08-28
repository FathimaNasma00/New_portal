<?php
require_once "db_connect.php";
$user_id= $_SESSION['login_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    if (isset($_FILES['video_file']) && $_FILES['video_file']['error'] == 0 &&
        isset($_FILES['thumbnail_file']) && $_FILES['thumbnail_file']['error'] == 0 &&
        isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == 0) {
        
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $user_id = $_SESSION['user_id'];

        // Upload video file
        $video_file = $_FILES['video_file']['name'];
        $video_target_path = 'EducationHub/videos/' . $video_file;
        move_uploaded_file($_FILES['video_file']['tmp_name'], $video_target_path);

        // Upload thumbnail file
        $thumbnail_file = $_FILES['thumbnail_file']['name'];
        $thumbnail_target_path = 'EducationHub/thumbnails/' . $thumbnail_file;
        move_uploaded_file($_FILES['thumbnail_file']['tmp_name'], $thumbnail_target_path);

        // Upload PDF file
        $pdf_file = $_FILES['pdf_file']['name'];
        $pdf_target_path = 'EducationHub/pdfs/' . $pdf_file;
        move_uploaded_file($_FILES['pdf_file']['tmp_name'], $pdf_target_path);

        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO education_videos (title, description, video_file, category, user_id, thumbnail, pdf_document) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $title, $description, $video_file, $category, $user_id, $thumbnail_file, $pdf_file);
        $stmt->execute();
        
         if ($stmt->affected_rows > 0) {
            // Success response
            $_SESSION['status'] = 'Video added successfully!';
            echo json_encode(['status' => 1, 'message' => 'Video added successfully']);
        } else {
            // Error response
            $_SESSION['status'] = 'Error adding video';
            echo json_encode(['status' => 0, 'message' => 'Error adding video']);
        }
    } else {
        // Missing files response
        $_SESSION['status'] = 'Please upload all required files';
        echo json_encode(['status' => 0, 'message' => 'Please upload all required files']);
    }
}
?>
<?php 
    if(isset($_SESSION['status']))
    {
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '<?php echo $_SESSION['status']; ?>',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Redirect to the educationhub_view page
                location.href = 'index2.php?page=educationhub_view';
            });
        </script>
        <?php 
        unset($_SESSION['status']);
    }
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<main>
    <div class="pagetitle">
      <h1>Knowledge Hub</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
          <li class="breadcrumb-item">Knowledge Hub</li>
          <li class="breadcrumb-item active">Add Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="col-md-12">
      <div class="row ">
        <div class="justify-content-center ">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Information</h5>
                
                <div class="row mb-3">
                        <form id="video_upload_form" method="POST" enctype="multipart/form-data">

    <!-- Title -->
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" required placeholder="Enter video title">
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="4" id="ed_descrption" required placeholder="Enter video description"></textarea>
    </div>

    <!-- Category -->
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <input type="text" class="form-control" name="category" required placeholder="Enter category">
    </div>

    <!-- Video File -->
    <div class="mb-3">
        <label for="video_file" class="form-label">Video File</label>
        <input type="file" class="form-control" name="video_file" accept="video/*" required>
    </div>

    <!-- Thumbnail File -->
    <div class="mb-3">
        <label for="thumbnail_file" class="form-label">Thumbnail Image</label>
        <input type="file" class="form-control" name="thumbnail_file" accept="image/*" required>
    </div>

    <!-- PDF Documentation File -->
    <div class="mb-3">
        <label for="pdf_file" class="form-label">PDF Documentation</label>
        <input type="file" class="form-control" name="pdf_file" accept="application/pdf" required>
    </div>

    <!-- Submit Button -->
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Upload Video</button>
    </div>

</form>
                </div>
            </div>
          </div>

        </div>
      </div>
      </div>
    </section>

</main>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#ed_descrption' ))
        .catch( error => {
            console.error( error );
        });
</script>