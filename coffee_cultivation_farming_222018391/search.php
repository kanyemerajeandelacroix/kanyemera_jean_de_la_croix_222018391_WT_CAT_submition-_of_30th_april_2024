<?php
include('database_connection.php');
// Check if the 'query' GET parameter is set
if (isset($_GET['query'])) {
     
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Perform the search query for coffeevarieties
    $sql = "SELECT * FROM coffeevarieties WHERE VarietyName LIKE '%$searchTerm%'";
    $result_coffeevarieties = $connection->query($sql);

    // Perform the search query for farm
    $sql = "SELECT * FROM farm WHERE Farmname LIKE '%$searchTerm%'";
    $result_farm = $connection->query($sql);

    // Perform the search query for farmer
    $sql = "SELECT * FROM farmer WHERE firstname LIKE '%$searchTerm%'";
    $result_farmer = $connection->query($sql);

    // Perform the search query for harvest
    $sql = "SELECT * FROM harvest WHERE HarvestDate LIKE '%$searchTerm%'";
    $result_harvest = $connection->query($sql);

    // Perform the search query for sales
    $sql = "SELECT * FROM sales WHERE BuyerName LIKE '%$searchTerm%'";
    $result_sales = $connection->query($sql);

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";
    echo "<h3>coffeevarieties:</h3>";
    if ($result_coffeevarieties->num_rows > 0) {
        while ($row = $result_coffeevarieties->fetch_assoc()) {
            echo "<p>" . $row['VarietyName'] . "</p>";
        }
    } else {
        echo "<p>No coffeevarieties found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>farm:</h3>";
    if ($result_farm->num_rows > 0) {
        while ($row = $result_farm->fetch_assoc()) {
            echo "<p>" . $row['Farmname'] . "</p>";
        }
    } else {
        echo "<p>No farm found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>farmer:</h3>";
    if ($result_farmer->num_rows > 0) {
        while ($row = $result_farmer->fetch_assoc()) {
            echo "<p>" . $row['firstname'] . "</p>";
        }
    } else {
        echo "<p>No farmer found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>harvest:</h3>";
    if ($result_harvest->num_rows > 0) {
        while ($row = $result_harvest->fetch_assoc()) {
            echo "<p>" . $row['HarvestDate'] . "</p>";
        }
    } else {
        echo "<p>No harvest found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>sales:</h3>";
    if ($result_sales->num_rows > 0) {
        while ($row = $result_sales->fetch_assoc()) {
            echo "<p>" . $row['BuyerName'] . "</p>";
        }
    } else {
        echo "<p>No sales found matching the search term: " . $searchTerm . "</p>";
    }
    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
