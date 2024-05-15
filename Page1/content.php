

<div class="container" style="width:100%;padding-top:10px;"> 
          <div class="table-responsive m-t-10">
			<div class="overlay"><div class="loader"></div></div> 
            <h5>Histories Record by Country</h5>
                <label for='countries'>Countries:</label>
                    <select name='countries' id='countries' onchange='FilterCountry(this.value)'>
                        <option value=''>--Select Country--</option>
                    <?php
                        $selectUserSql = "SELECT DISTINCT country FROM Histories ORDER BY country";
                        $stmt = $mysqli->query($selectUserSql);
                        $rows = $stmt->fetch_all(MYSQLI_ASSOC);

                        foreach ($rows as $row) {
                            echo "<option value='{$row['country']}'>{$row['country']}";
                        }
                    ?>
                    </select>

                    
                    <form class="form-group" method='post' style="margin-bottom: -5px;">
                          Start Date <input class="form-group" type='date' class='dateFilter' name='dateFrom' value='<?php if(isset($_POST['dateFrom'])) echo $_POST['dateFrom']; ?>'>

                          End Date <input class="form-group" type='date' class='dateFilter' name='dateTo' value='<?php if(isset($_POST['dateTo'])) echo $_POST['dateTo']; ?>'>

                          <input type='submit' name='but_search' value='Search'>
                    </form> 
                    </div>
                    
                                                     
                <table class="blueTable center" id="main-table">
                <thead>
                <tr>
                <th style="cursor:pointer" onclick="sortTable(0)">Country</th>
                <th style="cursor:pointer" onclick="sortTable(1)">Total Active User's Amount</th>
                <th style="cursor:pointer" onclick="sortTable(2)">Last History Date Time</th>
                <th style="cursor:pointer" onclick="sortTable(3)">No. of Unique Users</th>
                </tr>
                </thead>
                <tbody>

                <?php
                    $dateFrom = date('Y-m-d', strtotime($_POST['dateFrom']));
                    $dateTo = date('Y-m-d', strtotime($_POST['dateTo']));
                    
                    if($dateFrom=='' && $dateTo =='') {
                        $dateFrom = date('Y-m-d',strtotime(time()));
                        $dateTo = date('Y-m-d',strtotime(time()));
                    }    
                   
                    $selectUserSql = "SELECT h.country as Country, SUM(h.amount) as ActiveUsersAmount, MAX(datetime) as LastHistoryDT, COUNT(DISTINCT u.user_id) as UniqueUsers
                                        FROM php7test_db.Histories h LEFT JOIN php7test_db.Users u ON h.user_id=u.user_id 
                                        WHERE u.active=1 and h.active=1 GROUP BY h.country";
                    $stmt = $mysqli->query($selectUserSql);
                    $rows = $stmt->fetch_all(MYSQLI_ASSOC);
                    
                    foreach ($rows as $row) {
                        $amount = number_format($row["ActiveUsersAmount"],2,',','.');
                        $lastdt = date('Y-m-d', strtotime($row['LastHistoryDT']));
                        if ($lastdt >= $dateFrom && $lastdt <= $dateTo) {

                            echo "<tr ><td id='Country'><a href='../Page2/index.php?country={$row['Country']}'>{$row["Country"]}</a></td>";
                            echo "<td id='ActiveUsersAmount'>{$amount}</td>";
                            echo "<td id='LastHistoryDT'>{$lastdt}</td>";
                            echo "<td id='UniqueUsers'>{$row["UniqueUsers"]}</td></tr>";
                        
                        }   
                    }
                    $stmt->close();
                ?>
                </tbody>
                </div>
            </div>
          </div>


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