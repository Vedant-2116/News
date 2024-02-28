<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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

        /* Contact form styles */
        .contact-form {
            width: 60%;
            margin-top: 30px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        .contact-form label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        .contact-form textarea {
            resize: vertical;
        }

        .contact-form button {
            background-color: #007BFF;
            color: white;
            padding: 15px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .contact-form button:hover {
            background-color: #0056b3;
        }

        h2 {
            margin-top: 20px;
            font-size: 24px;
            color: #28a745;
        }
    </style>
</head>
<body>

    <h1>Contact Us</h1>

    <div class="contact-form">
        <form method="post" action="contact.php">
            <label for="name">Your Name:</label>
            <input type="text" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" name="email" required>

            <label for="message">Your Message:</label>
            <textarea name="message" rows="4" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include 'connection.php';

        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Perform further actions here like sending an email or storing in the database

        echo "<h2>Thank you for reaching out! We'll get back to you soon.</h2>";

        // Close the database connection
        $conn->close();
    }
    ?>

</body>
</html>
