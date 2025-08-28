<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION["login_email"])) {
    header("Location: login.php");
    exit;
}
include "header.php";

$selectedEmails = $_SESSION['login_email'];
$emails = explode(',', $selectedEmails);
?>

<body class="min-h-screen flex items-center justify-center p-4" style="background-color: #e0f7fa;">
  <div class="max-w-6xl w-full flex flex-col items-center"> 
    <h1 class="text-4xl font-bold text-center mb-12" style="color: #1e3a5f;">Select Your Role</h1> 

    <div class="flex flex-wrap justify-center gap-8">
      <?php
      foreach ($emails as $email) {
          $email = trim($email);
          $query = "SELECT email, password, type FROM `users` WHERE `email` = '$email'";
          $result = mysqli_query($conn, $query);

          if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_array($result)) {
                  $role = 'Unknown';
                  $icon = '';
                  switch ($row['type']) {
                      case 1: $role = "Super Admin"; break;
                      case 2: $role = "User"; break;
                      case 3: $role = "Admin"; break;
                      case 4: $role = "Freelancer"; break;
                      case 5: $role = "Tempuser"; break;
                  }
      ?>
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow hover:scale-105 transition-transform h-full flex flex-col" style="width: 300px;">
        <form class="login-form p-10 flex flex-col items-center flex-grow w-full">
          <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
          <input type="hidden" name="password" value="<?php echo $row['password']; ?>">
          
          <div class="mb-6 p-4 bg-blue-50 rounded-full">
            <svg class="w-16 h-16" fill="none" stroke="#2563eb" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>

          <h2 class="text-2xl font-bold text-center mb-6" style="color: #1e3a5f;"><?php echo $role; ?></h2>
          
          <div class="mt-auto w-full">
            <button class="w-full bg-[#1e3a5f] hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg transition flex items-center justify-center text-lg" type="submit">
              Continue →
            </button>
          </div>
        </form>
      </div>
      <?php
              }
          } else {
              echo "<p class='col-span-3 text-center text-red-600'>No user found for email: $email</p>";
          }
      }
      ?>

      <!-- Sign Out Block -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow hover:scale-105 transition-transform h-full flex flex-col" style="width: 300px;">
        <div class="p-14 flex flex-col items-center flex-grow">
          <div class="mb-6 p-4 bg-blue-50 rounded-full">
            <svg class="w-16 h-16" fill="none" stroke="#2563eb" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
          </div>
          <br>
          <div class="mt-auto w-full">
            <a href="ajax.php?action=logout" class="block text-center w-full bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition text-lg">
              Sign Out
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
    $('.login-form').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        submitButton.attr('disabled', true).html('Logging in...');

        if (form.find('.alert-danger').length > 0) {
            form.find('.alert-danger').remove();
        }

        $.ajax({
            url: 'ajax.php?action=lchecklogogin',
            method: 'POST',
            data: form.serialize(),
            error: function (err) {
                console.log(err);
                submitButton.removeAttr('disabled').html('Continue →');
            },
            success: function (resp) {
                if (resp == 1) {
                    location.href = 'index2.php?page=home2';
                } else {
                    form.prepend('<div class="alert alert-danger text-red-600 mb-4">Username or password is incorrect.</div>');
                    submitButton.removeAttr('disabled').html('Continue →');
                }
            }
        });
    });
</script>

<?php include "footer.php"; ?>
