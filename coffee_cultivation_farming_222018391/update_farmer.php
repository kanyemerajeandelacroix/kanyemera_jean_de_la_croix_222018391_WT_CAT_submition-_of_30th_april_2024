<?php
 include('database_connection.php');
// Check if farmerid is set
if(isset($_REQUEST['farmerid'])) {
    $fid = $_REQUEST['farmerid'];
    
    $ccf  = $connection->prepare("SELECT * FROM farmer WHERE farmerid=?");
    $ccf ->bind_param("i", $fid);
    $ccf ->execute();
    $result = $ccf ->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['farmerid'];
        $y = $row['firstname'];
        $z = $row['lastname'];
        $w = $row['contactnumber'];
        $v = $row['address'];

    } else {
        echo "Farmer not found.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update farmer</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="gray"><center>
    <!-- Update farmer form -->
    <h2><u>Update Form of farmer</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="farmerid" value="<?php echo isset($x) ? $x : ''; ?>">
        
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="contactnumber">Contact Number:</label>
        <input type="number" name="contactnumber" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $contactnumber = $_POST['contactnumber'];
    $address = $_POST['address'];
    
    // Update the farmer in the database
    $ccf  = $connection->prepare("UPDATE farmer SET firstname=?, lastname=?, contactnumber=?, address=? WHERE farmerid=?");
    $ccf ->bind_param("ssdsi", $firstname, $lastname, $contactnumber, $address, $fid);
    $ccf ->execute();
    
    // Redirect to farmer.php
    header('Location: farmer.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
