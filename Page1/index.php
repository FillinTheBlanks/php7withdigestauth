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

<script>
    sortable(document.getElementById("main-table"));

function FilterCountry(str) {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;

  filter = str;
  table = document.getElementById("main-table");
  tr = table.getElementsByTagName("tr");

  if(str.length == 0) {
    sortable(document.getElementById("main-table"));
  }
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function FilterDateRange(str) {
  // Declare variables
  var input, filterDate,filterCountry, table, tr, td,td2, i, txtValue;

  filterDate = document.getElementById("searchField").value;
  filterCountry = document.getElementById("countries").value;
  table = document.getElementById("main-table");
  tr = table.getElementsByTagName("tr");

  if(filterDate.length == 0) {
    const d = new Date();
    
    let month = d.getMonth()+1;
    let year = d.getFullYear();
    filterDate = year.toString() + '-' + month.toString();
  }

  if(filterCountry.length == 0) {
    sortable(document.getElementById("main-table"));
  } 


  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td2 = tr[i].getElementsByTagName("td")[2];
    
    if (td2) {
      txtValue = td2.textContent || td2.innerText;
      if (txtValue.toUpperCase().indexOf(filterDate) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }

  
}

</script>