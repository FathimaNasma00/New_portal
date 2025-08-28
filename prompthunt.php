<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4>&nbsp;</h4>
                        <h4 class="text-center mb-4">Prompt AI Search</h4>
                        <form id="promptForm" action="promptoutput.php" method="POST">
                            <div class="mb-3">
                                <label for="userQuery" class="form-label">Enter your query or prompt:</label>
                                <textarea id="userQuery" name="userQuery" class="form-control" rows="5" placeholder="Type your query here..." required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100" style="background-color: #87CEEB; border-color: #87CEEB;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Processing Overlay -->
    <div id="processingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 9999;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #fff; text-align: center;">
            <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;"></div>
            <h4 class="mt-3">Processing...</h4>
        </div>
    </div>

    <!-- Bootstrap Spinner CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById("promptForm").addEventListener("submit", function() {
            // Show the processing overlay
            document.getElementById("processingOverlay").style.display = "block";
        });
    </script>
</body>
