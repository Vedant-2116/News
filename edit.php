<?php
include 'connection.php';  //connecting to the database

// Check if the type and Id parameters are provided in the URL
if(isset($_GET['type']) && isset($_GET['Id'])) {
    $type = $_GET['type'];
    $id = $_GET['Id'];
    // Query the database to retrieve existing data based on the type and ID
    switch ($type) {
        case 'category':
            $tableName = 'category';
            break;
        case 'subcategory':
            $tableName = 'subcategory';
            break;
        case 'news':
            $tableName = 'news';
            break;
        default:
            echo "Invalid type.";
            exit;
    }

    $sql = "SELECT * FROM $tableName WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Data found, populate the form with existing data
        $data = $result->fetch_assoc();
        // Extract data fields as needed
        $columns = array_keys($data);
    } else {
        // Data not found
        echo "Data not found.";
    }

    // Check if the form is submitted for update
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Perform the update based on the provided data
        // Extract form data and perform update query
        // Remember to handle different types of data and tables accordingly

        // Example update query:
        // $updateSql = "UPDATE $tableName SET field1 = 'value1', field2 = 'value2' WHERE id = $id";
        // $conn->query($updateSql);
        // Check if update was successful and redirect to appropriate page
    }
} else {
    // Handle the case when type and Id parameters are not provided
    echo "Type and ID not provided.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?php echo ucfirst($type); ?></title>
    <!-- Include your CSS files if you have separate CSS files -->
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #333;
        }

        h1 {
            margin-top: 30px;
            font-size: 36px;
            color: #007BFF;
        }

        /* Form styles */
        form {
            width: 60%;
            margin-top: 30px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        form textarea {
            resize: vertical;
        }

        form button {
            background-color: #007BFF;
            color: white;
            padding: 15px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

    <h1>Edit <?php echo ucfirst($type); ?></h1>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php
        foreach ($columns as $column) {
            // Exclude the ID field from the form
            if ($column != 'id') {
                echo '<label for="' . $column . '">' . ucfirst($column) . ':</label>';
                echo '<input type="text" id="' . $column . '" name="' . $column . '" value="' . (isset($data[$column]) ? $data[$column] : '') . '" placeholder="Enter ' . $column . '" required>';
            }
        }
        ?>
        <button type="submit" name="update">Update <?php echo ucfirst($type); ?></button>
    </form>

</body>
</html>
