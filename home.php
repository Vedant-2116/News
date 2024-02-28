<?php
// Include the database connection file
include 'connection.php';

// Fetch news articles from the database
$sql = "SELECT * FROM news WHERE is_approved = 1 ORDER BY date_posted DESC";
$result = $conn->query($sql);

// Check for errors in the query execution
if (!$result) {
    die("Error: " . $conn->error);
}

// Fetch categories
$categorySql = "SELECT DISTINCT category FROM news";
$categories = $conn->query($categorySql);

// Check for errors in the query execution
if (!$categories) {
    die("Error: " . $conn->error);
}

// Fetch recent news
$recentNewsSql = "SELECT * FROM news WHERE is_approved = 1 ORDER BY date_posted DESC LIMIT 5";
$recentNews = $conn->query($recentNewsSql);

// Check for errors in the query execution
if (!$recentNews) {
    die("Error: " . $conn->error);
}

// Fetch popular news
$popularNewsSql = "SELECT * FROM news WHERE is_approved = 1 ORDER BY views DESC LIMIT 5";
$popularNews = $conn->query($popularNewsSql);

// Check for errors in the query execution
if (!$popularNews) {
    die("Error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <!-- Include your CSS files if you have separate CSS files -->
    <link rel="stylesheet" href="styles.css">
    <!-- Additional styles here if needed -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f2f2f2;
        }

        .main-content {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            flex: 1;
            box-sizing: border-box;
            padding: 20px;
        }
        .scroll {
            max-height:auto; /* Adjust the value as needed */
            overflow-y: auto;
        }

        .news-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 70%;
            box-sizing: border-box;
        }

        .news-item {
            width: calc(33.33% - 20px);
            margin: 10px;
            border: 1px solid #ddd;
            padding: 20px;
            cursor: pointer;
            background-color: white;
            border-radius: 10px;
            transition: background-color 0.3s, transform 0.2s;
            overflow: hidden;
        }

        .news-item:hover {
            background-color: #e0e0e0;
            transform: scale(1.02);
        }

        .news-item img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .news-item h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .news-item p {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .news-item a {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
        }

        .news-item a:hover {
            background-color: #0056b3;
        }

        .sidebar {
            width: 30%;
            box-sizing: border-box;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin: 20px 0;
        }

        .category-container,
        .recent-news-container,
        .popular-news-container {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        .category-container ul,
        .recent-news-container ul,
        .popular-news-container ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .category-container h2,
        .recent-news-container h2,
        .popular-news-container h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 15px;
        }

        .category-container a,
        .recent-news-container a,
        .popular-news-container a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            transition: color 0.3s;
            display: block;
            margin-bottom: 10px;
        }

        .category-container a:hover,
        .recent-news-container a:hover,
        .popular-news-container a:hover {
            color: #0056b3;
        }
        .news-item .category-tag,
        .news-item .subcategory-tag {
            display: inline-block;
            padding: 5px 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #007BFF;
            color: #fff;
            font-size: 14px;
            margin-right: 5px;
        }

        .news-item .subcategory-tag {
            background-color: #28a745; 
        }

    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <!-- left side of screen -->
    <div class="main-content">

        <div class="sidebar">
            <div class="category-container">
                <h2>Categories</h2>
                <ul>
                    <?php while ($category = $categories->fetch_assoc()) : ?>
                        <li><a href="filter.php?name=<?php echo urlencode($category['category']); ?>"><?php echo $category['category']; ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>


            <div class="recent-news-container">
                <h2>Recent News</h2>
                <ul>
                    <?php while ($recent = $recentNews->fetch_assoc()) : ?>
                        <li><a href="detail.php?id=<?php echo $recent['id']; ?>"><?php echo $recent['title']; ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>

            <div class="popular-news-container">
                <h2>Popular News</h2>
                <ul>
                    <?php while ($popular = $popularNews->fetch_assoc()) : ?>
                        <li><a href="detail.php?id=<?php echo $popular['id']; ?>"><?php echo $popular['title']; ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>

        
        <!-- Wrap the news container in a scrollable container -->
        <div class="scroll">
            <div class="news-container">
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <a href="detail.php?id=<?php echo $row['id']; ?>" class="news-item">
                        <img src="<?php echo $row['image_url']; ?>" alt="News Image">
                        <h3><?php echo $row['title']; ?></h3>
                        <span class="category-tag"><?php echo $row['category']; ?></span>
                        <span class="subcategory-tag"><?php echo $row['subcategory']; ?></span>
                    </a>
                <?php endwhile; ?>
        </div>
</div>


        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

