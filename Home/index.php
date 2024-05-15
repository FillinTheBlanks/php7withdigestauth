<?php  

session_start();

include '../db.php';
 
 if (!isset($_SESSION['username'])){
	 
	 header("Location: ../index.php");
 }


 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Home Page</title>  
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="../css/bootstrap4.min.css">
          <link rel="stylesheet" href="../css/home.css">
          <script src="../js/jquery.min.js"></script> 
          <script src="../js/import-popper.min.js"></script> 
          <script src="../js/bootstrap4.min.js"></script>
          <script src="../js/import-clock.js"></script>
		
	
	
      </head>  
      <body>  

	  <?php include '../nav.php'; ?>
	  
          <div class="container" style="width:100%;padding-top:10px;"> 
				
						<div class="overlay"><div class="loader"></div></div> 
                                   <h1> Welcome to my Sample Project using PHP 7 and Digest Auth and with no framework. </h1>
                                   

                                   <?php include '../Page1/content.php'; ?>
                                   <p class="mt-5 mb-3 text-muted">Kevin Llupar Dev &copy; 2024</p>
                              </div>
          </div>
     </body>
</html>