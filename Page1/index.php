<?php  

require '../auth.php';

session_start();

include '../db.php';
 
 if (!isset($_SESSION['username'])){
	 
	 header("Location: ../index.php");
 }

 ?>  


 <!DOCTYPE html>  
 <html>  
      <head>  
        <title>Page 1</title>  
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="../css/bootstrap4.min.css">
          <link rel="stylesheet" href="../css/home.css">
          <link rel="stylesheet" href="../css/sortable.css">
          <link rel="stylesheet" href="../css/dropdown.css">
          <script src="../js/jquery.min.js"></script> 
          <script src="../js/import-popper.min.js"></script> 
          <script src="../js/bootstrap4.min.js"></script>
          <script src="../js/import-clock.js"></script>
          
          <script src="../js/sortable.js"></script>
      </head>  
      <body>  

	  <?php include '../nav.php'; 
            include 'content.php';
            
        ?>
	  
          
                </body>
</html>

