<?php
include 'connection.php';

// Check if the add category button is clicked
if (isset($_POST['add_category'])) {
    // Perform the necessary actions to add a category (insert into the database, etc.)
    $name = $_POST['name'];
    $description = $_POST['description'];

    $insertSql = "INSERT INTO category (Name, Description) VALUES ('$name', '$description')";
    if ($conn->query($insertSql) === TRUE) {
        echo "<h2>New category added successfully!</h2>";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

// Fetch categories from the database
$sql = "SELECT * FROM category";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
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
        .modal textarea,
        .modal button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        /* Button to open the modal */
        .add-category-btn {
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

        <style>
    /* Your existing styles */

    table {
        width: 100%;
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

    /* Edit and delete icons */
    .action-icons {
        display: flex;
        justify-content: space-around;
    }

    .action-icons a {
        text-decoration: none;
        color: #333;
        margin: 0 5px;
    }

    .action-icons img {
        width: 24px;
        height: 24px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .action-icons img:hover {
        transform: scale(1.2);
    }
</style>

</head>
<body>

    <h1>Categories</h1>

    <!-- Button to open the modal -->
    <button class="add-category-btn" onclick="openModal()">Add Category</button>

    <!-- Modal for adding a new category -->
    <div id="addCategoryModal" class="modal">
        <span class="close-btn" onclick="closeModal()">&times;</span>

        <form method="post" action="category.php">
            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="description">Description:</label>
            <textarea name="description" required></textarea>

            <button type="submit" name="add_category">Add Category</button>
        </form>
    </div>

    <!-- Table to display categories -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['Id']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Description']; ?></td>
                    <td class="action-icons">
                        <!-- Edit button -->
                        <a href="edit.php?type=category&Id=<?php echo $row['Id']; ?>">
                            <img src="edit.png" alt="Edit">
                         </a>

                        
                        <!-- Delete button -->
                        <a href="delete.php?type=category&Id=<?php echo $row['Id']; ?>" onclick="return confirm('Are you sure?')">
                            <img src="delete.png" alt="Delete">
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        // Functions to open and close the modal
        function openModal() {
            document.getElementById('addCategoryModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('addCategoryModal').style.display = 'none';
        }
    </script>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
