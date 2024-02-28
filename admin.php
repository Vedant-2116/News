<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #333;
            color: white;
            padding-top: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar-header {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
            color: #61dafb;
        }

        .sidebar-menu {
            list-style-type: none;
            padding: 0;
        }

        .sidebar-menu li {
            padding: 10px;
        }

        .sidebar-menu a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 10px;
            transition: background-color 0.3s;
        }

        .sidebar-menu a:hover {
            background-color: #61dafb;
        }

        .user-dropdown {
            position: absolute;
            bottom: 100px;
            left: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .user-dropdown i {
            font-size: 24px;
            margin-right: 10px;
        }

        .dropdown-content {
            display: none;
            position: relative;
            background-color: white;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            color: black;
            top: -20px;
            right: 0;
        }

        .user-dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content p {
            padding: 10px;
            margin: 0;
            font-weight: bold;
        }

        .dropdown-content a {
            padding: 10px;
            text-decoration: none;
            color: black;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #61dafb;
        }

        .right-container {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            margin-left: 250px; /* Add margin to accommodate sidebar width */
            width: calc(100% - 250px); /* Adjust width accounting for sidebar width */
            height: 100%; /* Set height to 100% */
        }

        .content-container {
            flex: 1;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .footer {
            color: white;
            border-top: 1px solid #ddd;
            border-radius: 0 0 10px 10px;
            text-align: center;
            margin-top: auto; /* Push footer to the bottom */
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-laptop-code"></i> ADMIN
    </div>
    <ul class="sidebar-menu">
        <li><a href="#" class="sidebar-btn" data-page="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="#" class="sidebar-btn" data-page="user.php"><i class="fas fa-user-shield"></i> User</a></li>
        <li><a href="#" class="sidebar-btn" data-page="category.php"><i class="fas fa-folder"></i> Category</a></li>
        <li><a href="#" class="sidebar-btn" data-page="subcategory.php"><i class="fas fa-book"></i> Sub-Category</a></li>
        <li><a href="#" class="sidebar-btn" data-page="news.php"><i class="fas fa-newspaper"></i> News</a></li>
        <li><a href="#" class="sidebar-btn" data-page="contact.php"><i class="fas fa-file-alt"></i> Contact Us</a></li>
        <li><a href="#" class="sidebar-btn" data-page="approve.php"><i class="fas fa-comments"></i> Comments</a></li>
    </ul>
    <div class="user-dropdown" id="userDropdown">
        <i class="fas fa-user-cog"></i>
        <div class="dropdown-content">
            <p>Hello Admin</p>
            <a href="home.php">Home</a>
            <a href="manage.php">Change Password</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<div class="right-container">
    <div class="content-container" id="content-container">
        <!-- Content will be loaded dynamically here -->
    </div>
    <div class="footer">
        <?php include 'footer.php'; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        // Handle click events for sidebar buttons
        $('.sidebar-btn').click(function(e){
            e.preventDefault();
            var page = $(this).data('page'); // Get the URL of the page to load
            // Load the content into the content container
            $('#content-container').load(page, function() {
                // Adjust the size of the loaded content to fit the container
                var contentHeight = $('.content-container').prop('scrollHeight');
                var containerHeight = $('.right-container').height();
                if (contentHeight > containerHeight) {
                    $('.content-container').css('height', containerHeight - 40); // Subtract padding
                    $('.content-container').css('overflow-y', 'auto');
                } else {
                    $('.content-container').css('height', 'auto');
                    $('.content-container').css('overflow-y', 'hidden');
                }
            }); 
        });
    });
</script>

</body>
</html>
