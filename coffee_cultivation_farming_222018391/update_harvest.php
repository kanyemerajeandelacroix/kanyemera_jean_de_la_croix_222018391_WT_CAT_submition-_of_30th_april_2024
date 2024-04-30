<?php 
include('database_connection.php');

// Check if HarvestID is set
if(isset($_REQUEST['HarvestID'])) {
    $hid = $_REQUEST['HarvestID'];
    
    $ccf  = $connection->prepare("SELECT * FROM harvest WHERE HarvestID=?");
    $ccf ->bind_param("i", $hid);
    $ccf ->execute();
    $result = $ccf ->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['HarvestID'];
        $y = $row['HarvestDate'];
        $z = $row['QuantityHarvestest'];
        $w = $row['VarietyID'];
        $v = $row['farmid'];
    } else {
        echo "Harvest not found.";
    }
}
?>

<html>
<body bgcolor="chocola"><center>
    <form method="POST">
        <input type="hidden" name="HarvestID" value="<?php echo isset($x) ? $x : ''; ?>">
        
        <label for="HarvestDate">Harvest Date:</label>
        <input type="text" name="HarvestDate" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="QuantityHarvestest"> QuantityHarvestest:</label>
        <input type="text" name="QuantityHarvestest" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="VarietyID">Variety ID:</label>
        <input type="number" name="VarietyID" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        
        <label for="farmid">Farm ID:</label>
        <input type="number" name="farmid" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $HarvestDate = $_POST['HarvestDate'];
    $QuantityHarvestest = $_POST['QuantityHarvestest'];
    $VarietyID = $_POST['VarietyID'];
    $farmid = $_POST['farmid'];
    
    // Update the harvest in the database
    $ccf  = $connection->prepare("UPDATE harvest SET HarvestDate=?,     QuantityHarvestest=?, VarietyID=?, farmid=? WHERE HarvestID=?");
    $ccf ->bind_param("ssdii", $HarvestDate, $QuantityHarvestest, $VarietyID, $farmid, $hid);
    $ccf ->execute();
    
    // Redirect to harvest.php
    header('Location: harvest.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
