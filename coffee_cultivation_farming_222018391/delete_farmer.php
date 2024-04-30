<?php
include('database_connection.php');

// Check if farmerid is set
if(isset($_REQUEST['farmerid'])) {
    $fid = $_REQUEST['farmerid'];
    
    // Prepare and execute the DELETE statement
    $ccf  = $connection->prepare("DELETE FROM farmer WHERE farmerid = ?");
    $ccf ->bind_param("i", $fid);
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
        <input type="hidden" name="farmerid" value="<?php echo $fid; ?>">
        <input type="submit" value="Delete">
    </form>
<?php
    if ($ccf ->execute()) {
        echo "Record deleted successfully.<br><br><a href='farmer.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $ccf ->error;
    }
?>
</body>
</html>
<?php
    $ccf ->close();
} else {
    echo "farmerid is not set.";
}

$connection->close();
?>
