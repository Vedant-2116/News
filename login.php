<?php
// Include the database connection file
include 'connection.php';

// Start the session
session_start();

// Check if the user is already logged in
// if (isset($_SESSION['user_id'])) {
//     // Redirect based on user role
//     if ($_SESSION['Role'] == 'admin') {
//         header('Location: admin.php');
//     } elseif ($_SESSION['Role'] == 'subadmin') {
//         header('Location: take.php');
//     } elseif ($_SESSION['Role'] == 'user') {
//         header('Location: user.php');
//     }
//     exit();
// }


// Initialize variables
$username = '';
$password = '';
$loginError = '';

// Handle login logic if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check if the username exists
    $sql = "SELECT * FROM user WHERE Name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if ($password == $row['Password']) {
            // Password is correct, set session
            session_start();
            $_SESSION['user_id'] = $row['Id'];
            $_SESSION['username'] = $row['Name'];
            $_SESSION['Role'] = $row['Role'];

            // Redirect based on user role
            if ($row['Role'] == 'admin') {
                header('Location: admin.php');
            } elseif ($row['Role'] == 'subadmin') {
                header('Location: user
                .php');
            }elseif ($row['Role'] == 'user') {
                header('Location: home.php');
            }
            exit();
        } else {
            $loginError = 'Invalid username or password';
        }
    } else {
        $loginError = 'No User Found';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-image: url('news.jpeg'); 
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            text-align: center;
            margin-right: -70px;
            margin-bottom: -300px;
        }

        input {
            margin-bottom: 20px;
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .error-message {
            color: red;
            margin-bottom: 20px;
        }

        /* Style for the signup link */
        .signup-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .signup-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required value="<?php echo htmlspecialchars($username); ?>">
        <br>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <button type="submit">Login</button>
        <div class="error-message"><?php echo $loginError; ?></div>
        <div class="text-center mt-3">
        Don't have an account? <a href="signup.php" class="signup-link">Sign Up Here</a>
        </div>
    </form>
    
    <!-- Signup link styled as a button -->
    <
</body>
</html>
