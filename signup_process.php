<?php
// Include the database connection file
include 'connection.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Set default role for new users
    $role = 'user';

    // Prepare and execute the SQL statement to insert the user data into the database
    $stmt = $conn->prepare("INSERT INTO `user` (Name, Password, EmailId, Role) VALUES (?, ?, ?, ?)");
    
    if ($stmt) {
        $stmt->bind_param("ssss", $username, $password, $email, $role);
        $result = $stmt->execute();

        if ($result) {
            // Signup successful
            header("Location: login.php"); // Redirect to login page
            exit();
        } else {
            // Signup failed
            echo "Error: " . $stmt->error;
        }
    } else {
        // Error preparing the statement
        echo "Error: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Form data not submitted
    echo "Form data not submitted.";
}

// Close the database connection
$conn->close();
?>
