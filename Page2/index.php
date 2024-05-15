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
        <title>Page 2</title>  
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

	  <?php include '../nav.php'; ?>
	  
          <div class="container" style="width:100%;padding-top:10px;"> 
          <div class="table-responsive m-t-10">
			<div class="overlay"><div class="loader"></div></div> 
            <h5>List of Users in <?php if(isset($_REQUEST['country'])) { echo $_REQUEST['country']; } else { echo 'All Countries';} ?></h5>
                <label for='countries'>Username:</label>
                    <input type='text' id='searchField' onkeyup='FilterUsername(this.value)' />

                    
                    <form class="form-group" method='post' style="margin-bottom: -5px;">
                    Start Date <input class="form-group" type='date' class='dateFilter' name='dateFrom' value='<?php if(isset($_POST['dateFrom'])) {echo $_POST['dateFrom']; }else{ echo date('Y-m-d',time());} ?>'>

                    End Date <input class="form-group" type='date' class='dateFilter' name='dateTo' value='<?php if(isset($_POST['dateTo'])) { echo $_POST['dateTo']; }else{ echo date('Y-m-d',time());} ?>'>
                          <input type='submit' name='but_search' value='Search'>
                    </form> 
                    </div>
                    
                                                     
                <table class="blueTable center" id="main-table">
                <thead>
                <tr>
                <th style="cursor:pointer" onclick="sortTable(0)">User ID</th>
                <th style="cursor:pointer" onclick="sortTable(1)">Username</th>
                <th style="cursor:pointer" onclick="sortTable(2)">Total User's Amount</th>
                <th style="cursor:pointer" onclick="sortTable(3)">Last History Date Time</th>
                </tr>
                </thead>
                <tbody>

                <?php
                    if($dateFrom=='' && $dateTo =='') {
                        $_POST['dateFrom'] = date('Y-m-d',time());
                        $_POST['dateTo'] = date('Y-m-d',time());
                    }  
                    $selectedCountry =  $_REQUEST['country'];
                    $dateFrom = date('Y-m-d', strtotime($_POST['dateFrom']));
                    $dateTo = date('Y-m-d', strtotime($_POST['dateTo']));
                    
                      
                   
                    $selectUserSql = "SELECT DISTINCT u.user_id as UserID, u.username as Username, SUM(h.amount) TotalAmount, MAX(h.datetime) as LastHistoryDT 
                                        FROM php7test_db.Users u LEFT JOIN php7test_db.Histories h ON u.user_id = h.user_id 
                                        WHERE u.active=1 and h.active=1 AND h.country LIKE '%" . $selectedCountry . "' GROUP BY u.user_id, u.username ORDER BY u.username";
                    $stmt = $mysqli->query($selectUserSql);
                    //$stmt->bind_param('s', $selectedCountry);
            
                    $rows = $stmt->fetch_all(MYSQLI_ASSOC);
                    
                    foreach ($rows as $row) {
                        $amount = number_format($row["TotalAmount"],2,',','.');
                        $lastdt = date('Y-m-d', strtotime($row['LastHistoryDT']));
                        if ($lastdt >= $dateFrom && $lastdt <= $dateTo) {

                            echo "<tr><td id='UserID'>{$row["UserID"]}</td>";
                            echo "<td id='Username'>{$row['Username']}</td>";
                            echo "<td id='UniqueUsers'>{$amount}</td>";
                            echo "<td id='LastHistoryDT'>{$lastdt}</td></tr>";
                            
                        
                        }   
                    }
                    $stmt->close();
                ?>
                </tbody>
                </div>
            </div>
          </div>
                </body>
</html>

<script>
    sortable(document.getElementById("main-table"));

function FilterUsername(str) {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;

  filter = document.getElementById("searchField").value;
  table = document.getElementById("main-table");
  tr = table.getElementsByTagName("tr");

  if(filter.length == 0) {
    sortable(document.getElementById("main-table"));
  }
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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

  table = document.getElementById("main-table");
  tr = table.getElementsByTagName("tr");

  if(filterDate.length == 0) {
    const d = new Date();
    
    let month = d.getMonth()+1;
    let year = d.getFullYear();
    filterDate = year.toString() + '-' + month.toString();
  }

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filterDate) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }

  
}

</script>