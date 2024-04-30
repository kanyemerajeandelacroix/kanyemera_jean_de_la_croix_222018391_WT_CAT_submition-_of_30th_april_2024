<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Farmer Form</title>
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
<body>
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
    <h1>Farmer Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="farmerid">Farmer ID:</label>
        <input type="number" id="farmerid" name="farmerid" required><br><br>
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required><br><br>
        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required><br><br>
        <label for="contactnumber">Contact Number:</label>
        <input type="text" id="contactnumber" name="contactnumber" required><br><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>
    
        <input type="submit" name="insert" value="Insert"><br><br>
    </form>
    <a href="./home.html">Go Back to Home</a>

    <!-- PHP Code to Insert Data -->
    <?php
     include('database_connection.php');

    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        // Insert section
        $ccf = $connection->prepare("INSERT INTO farmer (farmerid, firstname, lastname, contactnumber, address) VALUES (?, ?, ?, ?, ?)");
        $ccf->bind_param("issss", $fid, $fname, $lname, $cnubr, $adrs);

        // Set parameters from POST and execute
        $fid = $_POST['farmerid'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $cnubr = $_POST['contactnumber'];
        $adrs = $_POST['address'];

        if ($ccf->execute()) {
            echo "New record has been added successfully.<br><br>";
        } else {
            echo "Error inserting data: " . $ccf->error;
        }

        $ccf->close();
    }
    ?>

    <!-- Displaying Table of Farmers -->
    <center><h2>Table of Farmers</h2></center>
    <table>
        <tr>
            <th>Farmer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact Number</th>
            <th>Address</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
         include('database_connection.php');
        // SQL query to fetch data from the farmer table
        $sql = "SELECT * FROM farmer";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fid = $row["farmerid"]; // Added this line to fetch Farmer ID
                echo "<tr>
                    <td>" . $row["farmerid"] . "</td>
                    <td>" . $row["firstname"] . "</td>
                    <td>" . $row["lastname"] . "</td>
                    <td>" . $row["contactnumber"] . "</td>
                    <td>" . $row["address"] . "</td>
                    <td><a href='delete_farmer.php?farmerid=$fid'>Delete</a></td>
                    <td><a href='update_farmer.php?farmerid=$fid'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close connection
        $connection->close();
        ?>
    </table>
</body>
</body> 
</section>

<footer>
  <center> 
    <b><h2><i>UR CBE BIT  prepared by:kanyemera<i></h2></b>
  </center>
</footer>
</body>
</html>
