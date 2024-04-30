<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Farm</title>
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
<header>

  <ul style="list-style-type: none; padding: 0;">
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

</header>

<body>
    <section>
    <h1>Farm Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="farmid">Farm ID:</label>
        <input type="number" id="farmid" name="farmid" required><br><br>
        <label for="Farmerid">Farmer ID:</label>
        <input type="number" id="Farmerid" name="Farmerid" required><br><br>
        <label for="Farmname">Farm Name:</label>
        <input type="text" id="Farmname" name="Farmname" required><br><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>
        <label for="sizeInAcres">Size in Acres:</label>
        <input type="text" id="sizeInAcres" name="sizeInAcres" required><br><br>
       
       <input type="submit" name="insert" value="Insert"><br><br>
       <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
     include('database_connection.php');

    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        // Insert section
        $ccf = $connection->prepare("INSERT INTO farm (farmid, Farmerid, Farmname, location, sizeInAcres) VALUES (?, ?, ?, ?, ?)");
        $ccf->bind_param("iisss", $farmid, $Farmerid, $Farmname, $location, $sizeInAcres);
        // Set parameters from POST and execute
        $farmid = $_POST['farmid'];
        $Farmerid = $_POST['Farmerid'];
        $Farmname = $_POST['Farmname'];
        $location = $_POST['location'];
        $sizeInAcres = $_POST['sizeInAcres'];

        if ($ccf->execute()) {
            echo "New record has been added successfully.<br><br>
             <a href='farm.html'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $ccf->error;
        }

        $ccf->close();
    }
    ?>

    <center><h2>Table of Farms</h2></center>
    <table>
        <tr>
            <th>Farm ID</th>
            <th>Farmer ID</th>
            <th>Farm Name</th>
            <th>Location</th>
            <th>Size in Acres</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
         include('database_connection.php');

        // SQL query to fetch data from the farm table
        $sql = "SELECT * FROM farm";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $farmid = $row["farmid"];
                echo "<tr>
                    <td>" . $row["farmid"] . "</td>
                    <td>" . $row["Farmerid"] . "</td>
                    <td>" . $row["Farmname"] . "</td> 
                    <td>" . $row["location"] . "</td>
                    <td>" . $row["sizeInAcres"] . "</td>
                    <td><a style='padding:4px' href='delete_farm.php?farmid=$farmid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_farm.php?farmid=$farmid'>Update</a></td> 
                  </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close connection
        $connection->close();
        ?>
    </table>
</section>

<footer>
  <center> 
    <b><h2><i>UR CBE BIT  prepared by:kanyemera<i></h2></b>
  </center>
</footer>
</body>
</html>
