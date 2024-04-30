<?php
include('database_connection.php');

// Check if farmid is set
if(isset($_REQUEST['farmid'])) {
    $farmid = $_REQUEST['farmid'];
    
    $ccf  = $connection->prepare("SELECT * FROM farm WHERE farmid = ?");
    $ccf ->bind_param("i", $farmid);
    $ccf ->execute();
    $result = $ccf ->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['farmid'];
        $y = $row['Farmerid'];
        $z = $row['Farmname'];
        $v = $row['location'];
        $w = $row['sizeInAcres'];
    } else {
        echo "Farm not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update farm</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="gray"><center>
    <!-- Update farm form -->
    <h2><u>Update Form of farm</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="farmid" value="<?php echo isset($x) ? $x : ''; ?>">
        
        <label for="Farmerid">Farmer ID:</label>
        <input type="text" name="Farmerid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Farmname">Farm Name:</label>
        <input type="text" name="Farmname" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="location">Location:</label>
        <input type="text" name="location" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <label for="sizeInAcres">Size in Acres:</label>
        <input type="text" name="sizeInAcres" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form   
    $farmid = $_POST['farmid'];
    $Farmerid = $_POST['Farmerid'];
    $Farmname = $_POST['Farmname'];
    $location = $_POST['location'];
    $sizeInAcres = $_POST['sizeInAcres'];
    
    // Update the farm in the database
    $ccf  = $connection->prepare("UPDATE farm SET Farmerid=?, Farmname=?, location=?, sizeInAcres=? WHERE farmid=?");
    $ccf ->bind_param("ssdsi", $Farmerid, $Farmname, $location, $sizeInAcres, $farmid);
    $ccf ->execute();
    
    // Redirect to farm.php
    header('Location: farm.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
