<?php
// Include the necessary files and establish a database connection
include 'connection.php';

// Fetch statistics
$totalNewsSql = "SELECT COUNT(*) as totalNews FROM news";
$totalNewsResult = $conn->query($totalNewsSql);
$totalNews = $totalNewsResult->fetch_assoc()['totalNews'];

$approvedNewsSql = "SELECT COUNT(*) as approvedNews FROM news WHERE is_approved = 1";
$approvedNewsResult = $conn->query($approvedNewsSql);
$approvedNews = $approvedNewsResult->fetch_assoc()['approvedNews'];

$viewsSql = "SELECT SUM(views) as totalViews FROM news";
$viewsResult = $conn->query($viewsSql);
$totalViews = $viewsResult->fetch_assoc()['totalViews'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Include your CSS files if you have separate CSS files -->
    <link rel="stylesheet" href="styles.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width:1000px;
            height:1000px;
        }

        .welcome-message {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .statistics-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
        }

        .statistic-item {
            /* background-color: #007BFF; */
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 200px;
            text-align: center;
            color: blue;
        }

        .statistic-item h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .statistic-item p {
            font-size: 16px;
            color: black;
        }
    </style>
</head>
<body>

                <div class="welcome-message">
                    Welcome to the Dashboard, Admin!
                </div>

                <div class="statistics-container">
                    <div class="statistic-item">
                        <h3>Total News</h3>
                        <p><?php echo $totalNews; ?></p>
                    </div>

                    <div class="statistic-item">
                        <h3>Approved News</h3>
                        <p><?php echo $approvedNews; ?></p>
                    </div>

                    <div class="statistic-item">
                        <h3>Total Views</h3>
                        <p><?php echo $totalViews; ?></p>
                    </div>
            </div>


</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
