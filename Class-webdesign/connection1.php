<?php
$con = mysqli_connect("127.0.0.1", "root", "Euqificap12.", "webdesign");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Only process if it's a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['age'])) {
        // Validate and sanitize inputs
        $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
        $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);

        // Validate age
        if ($age === false || $age < 0) {
            die('Error: Invalid age value');
        }

        // Prepare the SQL statement
        $sql = "INSERT INTO Persons (FirstName, LastName, Age) VALUES (?, ?, ?)";

        // Create a prepared statement
        $stmt = mysqli_prepare($con, $sql);

        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ssi", $firstname, $lastname, $age);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "1 record added successfully";
                // Redirect back to form
                header("Location: lesson6.html");
                exit();
            } else {
                die('Error: ' . mysqli_stmt_error($stmt));
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            die('Error: ' . mysqli_error($con));
        }
    } else {
        die('Error: All fields are required');
    }

    // Close connection only after POST processing
    mysqli_close($con);
}
// Don't close connection here - it might be needed by other files
?>

