<?php
include 'connection.php';

// Check if the add news button is clicked
if (isset($_POST['add_news'])) {
    // Perform the necessary actions to add a news article (insert into the database, etc.)
    $title = $_POST['title'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];

    $insertSql = "INSERT INTO news (title, category, subcategory, content, image_url) 
                  VALUES ('$title', '$category', '$subcategory', '$content', '$image_url')";
    
    if ($conn->query($insertSql) === TRUE) {
        echo "<h2>New news article added successfully!</h2>";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

// Fetch news articles from the database
$sql = "SELECT * FROM news";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
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
        .add-news-btn {
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
            width: 20px;
            height: 20px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .action-icons img:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>

    <h1>News</h1>

    <!-- Button to open the modal -->
    <button class="add-news-btn" onclick="openModal()">Add News</button>

    <!-- Modal for adding a new news article -->
    <div id="addNewsModal" class="modal">
        <span class="close-btn" onclick="closeModal()">&times;</span>

        <form method="post" action="news.php">
            <label for="title">Title:</label>
            <input type="text" name="title" required>

            <label for="category">Category:</label>
            <input type="text" name="category" required>

            <label for="subcategory">Subcategory:</label>
            <input type="text" name="subcategory">

            <label for="content">Content:</label>
            <textarea name="content" required></textarea>

            <label for="image_url">Image URL:</label>
            <input type="text" name="image_url">

            <button type="submit" name="add_news">Add News</button>
        </form>
    </div>

    <!-- Table to display news articles -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Content</th>
                <th>Image URL</th>
                <th>Date Posted</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['subcategory']; ?></td>
                    <td><?php echo $row['content']; ?></td>
                    <td><?php echo $row['image_url']; ?></td>
                    <td><?php echo $row['date_posted']; ?></td>
                    <td class="action-icons">
                        <!-- Edit button -->
                        <a href="edit.php?type=news&Id=<?php echo $row['id']; ?>">
                            <img src="edit.png" alt="Edit">
                        </a>
                        
                        <!-- Delete button -->
                        <a href="delete.php?type=news&Id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">
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
            document.getElementById('addNewsModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('addNewsModal').style.display = 'none';
        }

        // Function to handle edit action
        function editNews(newsId) {
            // Add your logic to handle the edit action (open another modal, redirect, etc.)
            alert('Edit News ID: ' + newsId);
        }

        // Function to handle delete action
        function deleteNews(newsId) {
            // Add your logic to handle the delete action (confirmation, AJAX request, etc.)
            if (confirm('Are you sure you want to delete this news article?')) {
                // You can use AJAX to delete the news article without refreshing the page
                alert('Delete News ID: ' + newsId);
            }
        }
    </script>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
