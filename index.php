<?php  

require 'auth.php';
require 'db.php';


session_start();  

if (isset($_SESSION['username'])){ 
        header("Location:Home/index.php");
}

?> 


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/favicon.ico">

    <title>PHP 7 with Digest Auth Sample Project</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet">
	
	<link href="/css/buttons.css" rel="stylesheet">
	
	<script src="/js/jquery.min.js"></script>
	
	<script>
	
	$(document).ready(function() {
		  $('#loginform').submit(function(e) {
			e.preventDefault();
			$.ajax({
			   type: "POST",
			   url: 'verify_user.php',
			   data: $(this).serialize(),
			   success: function(data)
			   {
				  if (data === 'Login') {
					window.location = 'Home/index.php';
				  }
				  else {
					alert(data);
				  }
			   }
		   });
		 });
	});
	
	</script>
	
  </head>

  <body class="text-center">
    <form class="form-signin" id="loginform">
      <img class="mb-4" src="/img/favicon.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">PHP 7 with Digest Auth Project</h1>
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label class="sr-only">Username</label>
      <input type="text" id="username" name="username" class="form-control" placeholder="username" required autofocus>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">Kevin Llupar Dev &copy; 2024</p>
    </form>
  </body>
</html>