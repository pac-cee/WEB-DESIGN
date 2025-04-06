<?php
require_once 'connection1.php';

try {
    // Prepare and execute SELECT query using mysqli
    $result = mysqli_query($con, "SELECT FirstName, LastName, Age FROM Persons ORDER BY FirstName");
    
    if (!$result) {
        throw new Exception(mysqli_error($con));
    }

    // Add CSS for table styling
    echo "
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f8f8f8;
        }
        .container {
            text-align: center;
            padding: 20px;
        }
        .back-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>";

    // Start table HTML
    echo "<div class='container'>";
    echo "<h2>Registered Persons</h2>";
    echo "<table>";
    echo "<tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
          </tr>";
    
    // Fetch and display each record
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
        echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Age']) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    // Add a back button
    echo "<button class='back-btn' onclick='window.location.href=\"lesson6.html\"'>Back to Form</button>";
    echo "</div>";

    // Free result set
    mysqli_free_result($result);
    
    // Close connection after we're done with it
    mysqli_close($con);

} catch(Exception $e) {
    // Close connection on error
    if (isset($con)) {
        mysqli_close($con);
    }
    die("Query failed: " . $e->getMessage());
}
?>
