<?php
include('database_connection.php');

// Check if HarvestID is set
if(isset($_REQUEST['HarvestID'])) {
    $hid = $_REQUEST['HarvestID'];
    
    // Prepare and execute the DELETE statement
    $ccf  = $connection->prepare("DELETE FROM harvest WHERE HarvestID = ?");
    $ccf ->bind_param("i", $hid);
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
        <input type="hidden" name="HarvestID" value="<?php echo $hid; ?>">
        <input type="submit" value="Delete">
    </form>
    <?php
    if ($ccf ->execute()) {
        echo "Record deleted successfully.<br><br><a href='harvest.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $ccf ->error;
    }
?>
</body>
</html>
<?php
    $ccf ->close();
} else {
    echo "HarvestID is not set.";
}

$connection->close();
?>
