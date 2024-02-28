<?php
include 'connection.php';

// Check if the add user button is clicked
if (isset($_POST['add_user'])) {
    // Perform the necessary actions to add a user (insert into the database, etc.)
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];


    $insertSql = "INSERT INTO user (Name, Password, EmailId, Role) VALUES ('$name', '$password', '$email', '$role')";
    if ($conn->query($insertSql) === TRUE) {
        echo "<h2>New user added successfully!</h2>";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

// Fetch users from the database
$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background-color: #f2f2f2;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            margin-top: 20px;
            color: #333;
        }

        /* Stylish modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            z-index: 1;
            width: 300px;
        }

        .modal input,
        .modal button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        /* Button to open the modal */
        .add-user-btn {
            margin-top: 20px;
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Close button in the modal */
        .close-btn {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 10px;
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        td {
            background-color: #f8f8f8;
            color: #333;
        }
    </style>
</head>
<body>

    <h1>User Management</h1>

    <!-- Button to open the modal -->
    <button class="add-user-btn" onclick="openModal()">Add User</button>

    <!-- Modal for adding a new user -->
    <div id="addUserModal" class="modal">
        <span class="close-btn" onclick="closeModal()">&times;</span>

        <form method="post" action="user.php">
            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="role">Role:</label>
            <select name="role" required>
                <option value="admin">Admin</option>
                <option value="subadmin">Subadmin</option>
                <option value="user">User</option>
            </select>

            <button type="submit" name="add_user">Add User</button>
        </form>
    </div>

    <!-- Table to display users -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Password</th>
                <th>Email</th>
                <th>Role</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['Id']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td>*****</td><!-- Password hidden -->
                    <td><?php echo $row['EmailId']; ?></td>
                    <td><?php echo $row['Role']; ?></td>
                    <td><?php echo $row['Date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        // Functions to open and close the modal
        function openModal() {
            document.getElementById('addUserModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('addUserModal').style.display = 'none';
        }
    </script>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
