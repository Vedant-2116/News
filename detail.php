<?php
// Include the necessary files and establish a database connection
include 'connection.php';

// Retrieve the news details based on the provided ID
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM news WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Extract the necessary data fields
        $title = $row['title'];
        $category = $row['category'];
        $subcategory = $row['subcategory'];
        $datePosted = $row['date_posted'];
        $totalVisits = $row['views'];

        $content = $row['content'];
    } else {
        // News not found
        echo "News not found.";
        exit;
    }
} else {
    // ID not provided
    echo "ID not provided.";
    exit;
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Include your CSS files if you have separate CSS files -->
    <link rel="stylesheet" href="styles.css">
    <!-- Additional styles here if needed -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 5px;
        }

        h1 {
            color: #007BFF;
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            margin: 5px 0;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .content {
            margin-top: 20px;
            line-height: 1.6;
        }

        .comment-container {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        .comment-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .comment-form input[type="text"],
        .comment-form input[type="email"],
        .comment-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .comment-form textarea {
            resize: vertical;
        }

        .comment-form button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .news-image {
            display: block;
            margin: 20px auto;
            max-width: 100%;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .share-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .share-buttons button {
            flex: 1;
            margin-right: 10px;
        }
        .container .category-tag,
        .container .subcategory-tag {
            display: inline-block;
            padding: 5px 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #007BFF;
            color: #fff;
            font-size: 14px;
            margin-right: 5px;
        }

        .container .subcategory-tag {
            background-color: #28a745; 
        }
    </style>
</head>
<body>

    <div class="container">
        <h1><?php echo $title; ?></h1>
        <span class="category-tag"><?php echo $row['category']; ?></span>
        <span class="subcategory-tag"><?php echo $row['subcategory']; ?></span>
        <p>Date Posted: <?php echo $datePosted; ?></p>
        <p>Total Visits: <?php echo $totalVisits; ?></p>

        <!-- Share buttons -->
        <div class="share-buttons">
            <button id="twitterButton">Twitter</button>
            <button id="facebookButton">Facebook</button>
            <button id="instagramButton">Instagram</button>
            <button id="whatsappButton">WhatsApp</button>
        </div>

        <!-- Image from database -->
        <?php if(!empty($row['image_url'])): ?>
            <img class="news-image" src="<?php echo $row['image_url']; ?>" alt="News Image">
        <?php endif; ?>

        <!-- News content -->
        <div class="content">
            <?php echo $content; ?>
        </div>

        <!-- Comment form -->
        <div class="comment-container">
            <h2>Leave a Comment</h2>
            <form class="comment-form" method="post" action="comment.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" rows="4" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        // Share buttons functionality
        document.getElementById("twitterButton").addEventListener("click", function() {
            var articleUrl = window.location.href;
            var message = "Check out this news article: " + articleUrl;
            var twitterUrl = "https://twitter.com/intent/tweet?url=" + encodeURIComponent(articleUrl) + "&text=" + encodeURIComponent(message);
            window.open(twitterUrl, "_blank");
        });

        document.getElementById("facebookButton").addEventListener("click", function() {
            var articleUrl = window.location.href;
            var facebookUrl = "https://www.facebook.com/sharer.php?u=" + encodeURIComponent(articleUrl);
            window.open(facebookUrl, "_blank");
        });

        document.getElementById("instagramButton").addEventListener("click", function() {
            // Note: Instagram sharing is typically done through the app and has limited options for sharing via the web
            alert("Instagram sharing is limited and typically done through the app.");
        });

        document.getElementById("whatsappButton").addEventListener("click", function() {
            var articleUrl = window.location.href;
            var message = "Check out this news article: " + articleUrl;
            var whatsappUrl = "https://wa.me/?text=" + encodeURIComponent(message);
            window.open(whatsappUrl, "_blank");
        });
    </script>

</body>
</html>

