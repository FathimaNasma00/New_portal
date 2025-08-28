<?php 
session_start();
include('./db_connect.php');
?>
<?php include('./header.php'); ?>
<?php
  include "./db_connect.php";
  if(isset($_SESSION["login_id"])){
    header("Location:./home.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <script src="assets/js/tailwindcss.js"></script>
</head>
    
<body class="bg-[#e0f7fa]">

  <div class="flex items-center justify-center min-h-screen p-4">
    <div class="flex flex-col md:flex-row w-full max-w-5xl bg-white shadow-xl rounded-2xl overflow-hidden">

      <div class="w-full md:w-1/2 bg-[#1e3a5f] text-white p-10 flex flex-col items-center justify-start relative overflow-hidden">
        <div class="absolute top-20 left-12">
          <img src="assets/img/lkcareers_portal_logo.png" alt="Logo" class="w-16 h-16 object-cover rounded-full border-4 border-white shadow-md transition-transform hover:scale-105" />
        </div>

        <div class="mt-48 text-left w-full px-4">
          <h1 class="text-3xl sm:text-5xl font-bold leading-tight">Hello,</h1>
          <h1 class="text-3xl sm:text-5xl font-bold leading-tight mb-6">Welcome to Portal!</h1>
          <p class="text-base text-gray-200">
           OnePlace Every Hunt in One Spot for Recruiters <br>
           Smart. Simple. Powerful Hiring.


          </p>
        </div>
      </div>

      <div class="w-full md:w-1/2 bg-[#e0f2f1] p-10 flex flex-col justify-center">
        <form id="login-form" class="bg-white p-8 rounded-lg shadow-md w-full">
          <h2 class="text-2xl font-semibold text-center mb-6 text-gray-700">Login</h2>

          <label class="block text-sm font-medium text-gray-600 mb-1">Username</label>
          <input type="text" id="email" name="email" placeholder="Enter your username" class="w-full p-3 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]" required />

          <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
          <input type="password"  id="password" name="password"  placeholder="********" class="w-full p-3 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]" required />

          <button type="submit" class="w-full bg-[#1e3a5f] hover:bg-blue-800 text-white font-semibold py-2 rounded-md transition">
            Login
          </button>
        </form>

        <div class="mt-6 text-center text-gray-600">
          <span class="mr-4 font-medium">FOLLOW</span>
          <div class="flex justify-center items-center gap-6 mt-3">
            <a href="https://www.linkedin.com/company/lkcareers-lk/" target="_blank" rel="noopener noreferrer" class="flex flex-col items-center text-blue-500 hover:text-blue-700"> 
              <svg class="text-2xl" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                <path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.5 8h4V24h-4V8zm7.5 0h3.857v2.206h.054c.537-1.017 1.847-2.086 3.805-2.086 4.07 0 4.812 2.68 4.812 6.166V24h-4V14.617c0-2.26-.04-5.165-3.15-5.165-3.15 0-3.63 2.46-3.63 5.007V24h-4V8z"/>
              </svg>
              <span class="text-xs mt-1">LinkedIn</span>
            </a>
            
            <a href="https://www.facebook.com/Lkcareers" target="_blank" rel="noopener noreferrer" class="flex flex-col items-center text-blue-600 hover:text-blue-800">
              <svg class="text-2xl" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                <path d="M22 2h-20c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h10v-7h-3v-3h3v-2.2c0-4 2.4-6.8 6.3-6.8 1.9 0 3.7.7 5 1.9v3.4h-3c-2.4 0-2.8 1.2-2.8 2.8v2.9h5.6l-1 3h-4.6v7h7c1.1 0 2-.9 2-2v-16c0-1.1-.9-2-2-2z" />
              </svg>
              <span class="text-xs mt-1">Facebook</span>
            </a>
            <a href="https://www.instagram.com/lkcareers/" target="_blank" rel="noopener noreferrer" class="flex flex-col items-center text-blue-500 hover:text-blue-800">

              <svg class="text-2xl" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                <path d="M7.75 2c-1.66 0-3 1.34-3 3v14c0 1.66 1.34 3 3 3h8.5c1.66 0 3-1.34 3-3v-14c0-1.66-1.34-3-3-3h-8.5zm1 2h6.5c.55 0 1 .45 1 1v11c0 .55-.45 1-1 1h-6.5c-.55 0-1-.45-1-1v-11c0-.55.45-1 1-1zm4.75 2c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zm0 4c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z" />
              </svg>
              <span class="text-xs mt-1">Instagram</span>
            </a>
            <a href="http://www.youtube.com/@LKcareer" target="_blank" rel="noopener noreferrer" class="flex flex-col items-center text-blue-500 hover:text-blue-800">
              <svg class="text-2xl" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                <path d="M23.498 6.186a2.993 2.993 0 0 0-2.108-2.116C19.663 3.5 12 3.5 12 3.5s-7.663 0-9.39.57a2.993 2.993 0 0 0-2.108 2.116A31.63 31.63 0 0 0 0 12a31.63 31.63 0 0 0 .502 5.814 2.993 2.993 0 0 0 2.108 2.116c1.727.57 9.39.57 9.39.57s7.663 0 9.39-.57a2.993 2.993 0 0 0 2.108-2.116A31.63 31.63 0 0 0 24 12a31.63 31.63 0 0 0-.502-5.814zM9.75 15.02V8.98l6.25 3.02-6.25 3.02z"/>
              </svg>
              <span class="text-xs mt-1">YouTube</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='checkrole.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
	$('.number').on('input',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9 \,]/, '');
        $(this).val(val)
    })
</script>	
</html>