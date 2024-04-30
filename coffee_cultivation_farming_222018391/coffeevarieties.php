<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coffee Varieties</title>
    <style>
        body {
            background-color: grey;
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
        header {
            background-color: burlywood;
            padding: 20px;
        }
        section {
            padding: 71px;
            border-bottom: 1px solid #ddd;
            background-color: grey;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: burlywood;
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
    <form class="d-flex" role="search" action="search.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</header>
<section>
    <h1>Coffee Varieties Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="Varietyid">VarietyID :</label>
        <input type="number" id="Varietyid" name="Varietyid" required><br><br>
        <label for="Variet">VarietyName:</label>
        <input type="text" id="Variet" name="Variet" required><br><br>
        <label for="Descriptio">Description:</label>
        <input type="text" id="Descriptio" name="Descriptio" required><br><br>
        <label for="gender">Gender:</label>
        <select name="gender" id="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>
        <input type="submit" name="insert" value="Insert"><br><br>
    </form>
    <a href="./home.html">Go Back to Home</a>
    <!-- PHP Code to Insert Data -->
    <?php
    // Include the database connection file
    include('database_connection.php');

    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        // Prepare the insert statement
        $ccf = $connection->prepare("INSERT INTO coffeevarieties (VarietyID, VarietyName, Description) VALUES (?, ?, ?)");
        $ccf->bind_param("iss", $vaid, $vaname, $des);
        // Set parameters from POST and execute
        $vaid = $_POST['Varietyid'];
        $vaname = $_POST['Variet'];
        $des = $_POST['Descriptio'];
        if ($ccf->execute()) {
            echo "New record has been added successfully.<br><br>";
        } else {
            echo "Error inserting data: " . $ccf->error;
        }
        $ccf->close();
    }

    // Fetch data from the coffeevarieties table
    $sql = "SELECT * FROM coffeevarieties";
    $result = $connection->query($sql);
    ?>
    <!-- Displaying Table of Coffee Varieties -->
    <center><h2>Table of Coffee Varieties</h2></center>
    <table>
        <tr>
            <th>VarietyID</th>
            <th>VarietyName</th>
            <th>Description</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        include('database_connection.php');
        // Check if there are any results
        if ($result->num_rows > 0) { 
            // Loop through each row
            while ($row = $result->fetch_assoc()) {
                // Store the VarietyID in a variable
                $vaid = $row["VarietyID"];
                // Output the data in table row format
                echo "<tr>
                    <td>" . $row["VarietyID"] . "</td>
                    <td>" . $row["VarietyName"] . "</td>
                    <td>" . $row["Description"] . "</td> 
                    <td><a href='delete_coffeevarieties.php?VarietyID=$vaid'>Delete</a></td> 
                    <td><a href='update_coffeevarieties.php?VarietyID=$vaid'>Update</a></td> 
                </tr>";
            }
        } else {
            // If no data found, display a message
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</section>
<footer>
    <center> 
        <b><h2><i>UR CBE BIT  prepared by:kanyemera</i></h2></b>
    </center>
</footer>
</body>
</html>
