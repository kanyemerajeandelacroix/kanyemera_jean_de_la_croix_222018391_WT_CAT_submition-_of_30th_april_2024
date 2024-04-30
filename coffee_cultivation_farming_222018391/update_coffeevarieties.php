<?php
include('database_connection.php');

// Check if VarietyID is set
if(isset($_REQUEST['VarietyID'])) {
    $vaid = $_REQUEST['VarietyID'];
    
    $ccf  = $connection->prepare("SELECT * FROM coffeevarieties WHERE VarietyID=?");
    $ccf ->bind_param("i", $vaid);
    $ccf ->execute();
    $result = $ccf ->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['VarietyName'];
        $z = $row['Description'];
    } else {
        echo "coffeevarieties not found.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update coffeevarieties</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="gray"><center>
    <!-- Update coffeevarieties form -->
    <h2><u>Update Form of coffeevarieties</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="Variet">VarietyName:</label>
        <input type="text" name="Variet" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Descriptio">Description:</label>
        <input type="text" name="Descriptio" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $vaname = $_POST['Variet'];
    $des  = $_POST['Descriptio'];
    
    // Update the coffeevarieties in the database
    $ccf  = $connection->prepare("UPDATE coffeevarieties SET VarietyName=?, Description=? WHERE VarietyID=?");
    $ccf ->bind_param("ssd", $vaname, $des , $vaid);
    $ccf ->execute();
    
    // Redirect to coffeevarieties.php
    header('Location: coffeevarieties.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
