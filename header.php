<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWS</title>
    <!-- Add your CSS stylesheets or link to them here -->
    <style>
        /* Add your custom styles here */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            cursor: pointer;
            font-size: 24px;
        }

        .menu {
            display: flex;
            align-items: center;
        }

        .menu-item {
            margin: 0 15px;
            color: white;
            text-decoration: none;
            list-style: none;
            font-size: 16px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            margin-left: 15px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            padding: 10px;
            border-radius: 5px;
            top: 100%; /* Show below the button */
            right: 0; /* Align to the right */
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 5px 0;
        }

        .search-bar {
            /* Adjusted margin for better spacing */
            margin: 0 15px;
            background-color: #555;
            padding: 5px;
            border-radius: 5px;
        }

        .search-bar input {
            border: none;
            padding: 5px;
            border-radius: 3px;
        }

        /* Style for the user icon */
        .user-icon {
            font-size: 18px;
            cursor: pointer;
        }

        /* Style for the dropdown when hovered */
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">NEWS</div>
    <ul class="menu">
        <li class="menu-item"><a href="home.php">Home</a></li>
        <li class="menu-item"><a href="contact.php">Contact</a></li>
        <li class="search-bar">
            <!-- Add your search bar HTML code here -->
            <input type="text" placeholder="Search...">
        </li>
        <li class="menu-item">
            <!-- Use a user icon instead of text for the dropdown -->
            <div class="dropdown">
                <span class="user-icon" id="user-icon">&#128100;</span>
                <div class="dropdown-content">
                    <ul>
                        <li><a href="signup.php">Sign UP</a></li>
                        <li><a href="manage.php">Manage</a></li>
                        <li><a href="login.php">Admin</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</header>

<!-- Your website content goes here -->

<script>
    // Handle click event for user icon
    document.getElementById('user-icon').addEventListener('click', function(event) {
        // Prevent the dropdown from closing immediately
        event.stopPropagation();
        // Toggle the display of the dropdown content
        var dropdownContent = document.querySelector('.dropdown-content');
        dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
    });

    // Close dropdown when clicking outside of it
    document.addEventListener('click', function(event) {
        var dropdownContent = document.querySelector('.dropdown-content');
        if (dropdownContent.style.display === 'block' && event.target !== document.getElementById('user-icon')) {
            dropdownContent.style.display = 'none';
        }
    });
</script>

</body>
</html>
