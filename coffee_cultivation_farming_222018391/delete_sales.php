<?php
include('database_connection.php');

// Check if SalesID is set
if(isset($_REQUEST['SalesID'])) {
    $sid = $_REQUEST['SalesID'];
    
    // Prepare and execute the DELETE statement
    $ccf  = $connection->prepare("DELETE FROM sales WHERE SalesID = ?");
    $ccf ->bind_param("i", $sid);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body bgcolor="gray">
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="SalesID" value="<?php echo $sid; ?>">
        <input type="submit" value="Delete">
    </form>
    <?php
    if ($ccf ->execute()) {
        echo "Record deleted successfully.<br><br><a href='sales.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $ccf ->error;
    }
?>
</body>
</html>
<?php
    $ccf ->close();
} else {
    echo "SalesID is not set.";
}

$connection->close();
?>
