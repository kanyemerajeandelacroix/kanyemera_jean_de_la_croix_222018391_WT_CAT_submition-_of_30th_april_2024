<?php
include('database_connection.php');

if(isset($_REQUEST['VarietyID'])) {
    $vaid = $_REQUEST['VarietyID'];
    
    $ccf = $connection->prepare("DELETE FROM coffeevarieties WHERE VarietyID = ?");
    $ccf ->bind_param("i", $vaid);
    
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
    <body bgcolor="grey">
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="VarietyID" value="<?php echo $vaid; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
        if ($ccf ->execute()) {
            echo "Record deleted successfully.<br><br><a href='coffeevarieties.php'>OK</a>";
        } else {
            echo "Error deleting data: " . $ccf ->error;
        }
    ?>
    </body>
    </html>
    <?php

    $ccf ->close();
} else {
    echo "VarietyID is not set.";
}

$connection->close();
?>