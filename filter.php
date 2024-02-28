<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered News</title>
    <style>
        /* CSS styles for news cards */
        .news-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .news-card {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            max-width: 400px;
            width: 100%;
        }

        .news-card h2 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }

        .news-card p {
            font-size: 16px;
            color: #666;
        }
    </style>
</head>
<body>

<?php
// Include the necessary files and establish a database connection
include 'connection.php';

// Retrieve the category name from the URL parameter
if(isset($_GET['name'])) {
    $category_name = $_GET['name'];

    // Query to select news based on the provided category name
    $sql = "SELECT * FROM news WHERE category = '$category_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output the filtered news
        echo '<div class="news-container">';
        while($row = $result->fetch_assoc()) {
            // Display the news articles with proper formatting
            echo '<div class="news-card">';
            echo '<h2>' . $row['title'] . '</h2>';
            echo '<p>' . $row['content'] . '</p>';
            // Add additional fields as needed (date, author, etc.)
            echo '</div>'; // Close news-card div
        }
        echo '</div>'; // Close news-container div
    } else {
        // No news found for the provided category
        echo "<p>No news found for the selected category.</p>";
    }
} else {
    // Category name not provided
    echo "<p>Category name not provided.</p>";
}

// Close the database connection
$conn->close();
?>

</body>
</html>
