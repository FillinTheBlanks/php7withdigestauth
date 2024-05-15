<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="/Home/index.php">Sample PHP Project</a>
  <!-- Links -->
  <ul class="navbar-nav">

<?php


 if (!isset($_SESSION['username'])){
    
    header("Location: ../index.php");
	
 }
 else{	
    ?>
    <!-- Dropdown -->
    <li class="nav-item">
        <a class="nav-link" href="../Page1/index.php">Page 1</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../Page2/index.php">Page 2</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="../logout.php">Logout</a>
    </li>
 </nav>
    <?php
 }

 ?>