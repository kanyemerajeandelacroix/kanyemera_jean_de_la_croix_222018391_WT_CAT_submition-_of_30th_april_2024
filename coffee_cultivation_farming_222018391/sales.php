<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales</title>
    <style>
        body {
            background-color:grey;
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        header{
    background-color:burlywood;
    padding:20px;
    }
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    background-color: grey;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:burlywood;
  }
    </style>
     <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body><body>
    <header><ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;"><a href="./home.html" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./coffeevarieties.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">coffeevarieties</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./farm.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">farm</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./farmer.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">farmer</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./harvest.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">harvest</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./sales.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">sales</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>

  <!-- <div class="col-3 offset">-->
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  
</head>
</header>
   <body>
   <section>
    <h1>Sales Form</h1>
     <form method="post" onsubmit="return confirmInsert();">
        <label for="SalesID">SalesID:</label>
        <input type="number" id="SalesID" name="SalesID" required><br><br>

        <label for="SaleDate">SaleDate:</label>
        <input type="date" id="SaleDate" name="SaleDate" required><br><br>

        <label for="BuyerName">BuyerName:</label>
        <input type="text" id="BuyerName" name="BuyerName" required><br><br>

        <label for="QuantitySold">QuantitySold:</label>
        <input type="text" id="QuantitySold" name="QuantitySold" required><br><br>

        <label for="Totalprice">Totalprice:</label>
        <input type="number" id="Totalprice" name="Totalprice" required><br><br>

        <label for="harvestID">harvestID:</label>
        <input type="number" id="harvestID" name="harvestID" required><br><br>

        <input type="submit" name="insert" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    </form>
      <?php
     include('database_connection.php');

    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        // Insert section
        $ccf = $connection->prepare("INSERT INTO sales(SalesID,SaleDate, BuyerName,QuantitySold , Totalprice , harvestID) VALUES (?, ?, ?, ?, ?,?)");
        $ccf->bind_param("iissss", $sid, $sd, $byn,  $qs, $tp, $havid);
        // Set parameters from POST and execute
        $sid = $_POST['SalesID'];
        $sd = $_POST['SaleDate'];
        $byn = $_POST['BuyerName'];
        $qs = $_POST['QuantitySold'];
        $tp = $_POST['Totalprice'];
        $havid = $_POST['harvestID'];

        if ($ccf->execute()) {
            echo "New record has been added successfully.<br><br>
             <a href='sales.html'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $ccf->error;
        }

        $ccf->close();
    }
    ?>

    <h2>Table of Sales</h2>
    <table>
        <tr>
            <th>SalesID</th>
            <th>SaleDate</th>
            <th>BuyerName</th>
            <th>QuantitySold</th>
            <th>Totalprice</th>
            <th>harvestID</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
 include('database_connection.php');

        // SQL query to fetch data from the Sales table
        $sql = "SELECT * FROM sales";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sid = $row["SalesID"]; // Fetching SalesID
                echo "<tr>
                    <td>" . $row["SalesID"] . "</td>
                    <td>" . $row["SaleDate"] . "</td>
                    <td>" . $row["BuyerName"] . "</td>
                    <td>" . $row["QuantitySold"] . "</td>
                    <td>" . $row["Totalprice"] . "</td>
                    <td>" . $row["harvestID"] . "</td>
                    <td><a href='delete_sales.php?SalesID=$sid'>Delete</a></td>
                    <td><a href='update_sales.php?SalesID=$sid'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No data found</td></tr>";
        }

        // Close connection
        $connection->close();
        ?>
    </table>
</body>
</html>
<footer>
  <center> 
   
</section>

<footer>
  <center> 
    <b><h2><i>UR CBE BIT  prepared by:kanyemera<i></h2></b>
  </center>
</footer>
</body>
</html>
