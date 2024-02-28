<?php
include 'connection.php';

// Check if the comment form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perform the necessary actions to handle the comment submission
    $postId = $_POST['post_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $commentText = $_POST['comment_text'];

    // Insert the comment into the database
    $insertSql = "INSERT INTO comment (PostId, Name, Email, Comment, Status) VALUES ('$postId', '$name', '$email', '$commentText', 1)";
    if ($conn->query($insertSql) === TRUE) {
        echo "<h2>Your comment has been submitted!</h2>";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

// Fetch comments for a specific post (replace with your logic)
$postId = $_GET['post_id'];
$sql = "SELECT * FROM comment WHERE PostId = $postId AND Status = 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
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
        .comment-form {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            width: 80%;
        }

        .comment-form label,
        .comment-form textarea,
        .comment-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .comment-form button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .comments {
            width: 80%;
            margin-top: 20px;
        }

        .comment {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .comment h3 {
            color: #333;
        }

        .comment p {
            color: #555;
        }
    </style>
</head>
<body>

    <h1>Comments</h1>

    <!-- Comment form -->
    <div class="comment-form">
        <form method="post" action="comment.php">
            <input type="hidden" name="post_id" value="<?php echo $postId; ?>">

            <label for="name">Your Name:</label>
            <input type="text" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" name="email" required>

            <label for="comment_text">Your Comment:</label>
            <textarea name="comment_text" rows="4" required></textarea>

            <button type="submit">Submit Comment</button>
        </form>
    </div>

    <!-- Display comments -->
    <div class="comments">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="comment">
                <h3><?php echo $row['Name']; ?></h3>
                <p><?php echo $row['Comment']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>

