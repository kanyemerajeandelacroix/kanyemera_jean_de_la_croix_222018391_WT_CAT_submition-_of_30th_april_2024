<?php
 include('database_connection.php');

// Check if SalesID is set
if(isset($_REQUEST['SalesID'])) {
    $sid = $_REQUEST['SalesID'];
    
    $ccf  = $connection->prepare("SELECT * FROM sales WHERE SalesID = ?");
    $ccf ->bind_param("i", $sid);
    $ccf ->execute();
    $result = $ccf ->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['SalesID'];
        $y = $row['SaleDate'];
        $z = $row['BuyerName'];
        $v = $row['Totalprice'];
        $w = $row['QuantitySold'];
        $harvestID = $row['harvestID'];
    } else {
        echo "Sales not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update sales</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="gray"><center>
    <!-- Update farmer form -->
    <h2><u>Update Form of sales</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="SaleDate">Sale Date:</label>
        <input type="text" name="SaleDate" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="BuyerName">Buyer Name:</label>
        <input type="text" name="BuyerName" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="QuantitySold">Quantity Sold:</label>
        <input type="number" name="QuantitySold" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        
        <label for="Totalprice">Total Price:</label>
        <input type="number" name="Totalprice" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        
        <label for="harvestID">Harvest ID:</label>
        <input type="number" name="harvestID" value="<?php echo isset($harvestID) ? $harvestID : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $SaleDate = $_POST['SaleDate'];
    $BuyerName = $_POST['BuyerName'];
    $QuantitySold = $_POST['QuantitySold'];
    $Totalprice = $_POST['Totalprice'];
    $harvestID = $_POST['harvestID'];
    
    // Update the product in the database
    $ccf  = $connection->prepare("UPDATE sales SET SaleDate=?, BuyerName=?, QuantitySold=?, Totalprice=?, harvestID=? WHERE SalesID=?");
    $ccf ->bind_param("sssdis", $SaleDate, $BuyerName, $QuantitySold, $Totalprice, $harvestID, $sid);
    $ccf ->execute();
    
    // Redirect to sales.php
    header('Location: sales.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
