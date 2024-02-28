<?php
include 'connection.php';
// Assuming you have already established a database connection

// Function to update the status of a comment
function updateCommentStatus($conn, $commentId, $status) {
    $updateSql = "UPDATE comment SET Status = $status WHERE Id = $commentId";
    return $conn->query($updateSql);
}



// Check if the approve button is clicked
if (isset($_POST['approve_comment'])) {
    $commentId = $_POST['comment_id'];
    updateCommentStatus($conn, $commentId, 1); // Set status to approved
}

// Check if the delete button is clicked
if (isset($_POST['delete_comment'])) {
    $commentId = $_POST['comment_id'];
    // You can add delete logic here if needed
}

// Fetch comments from the database
$sql = "SELECT * FROM comment";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Comments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
             body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 800px;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                text-align: center;
                margin-bottom: 20px;
                color: #333;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                padding: 16px;
                border-bottom: 1px solid #ddd;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
                color: #333;
                font-weight: bold;
                text-transform: uppercase;
            }

            .action-icons {
                display: flex;
                justify-content: center;
            }

            .action-icons button {
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                font-size: 14px;
            }

            .approve-btn {
                background-color: #4caf50;
                color: #fff;
            }

            .delete-btn {
                background-color: #f44336;
                color: #fff;
            }

            .action-icons button:hover {
                filter: brightness(90%);
            }

            .approve-btn:hover,
            .delete-btn:hover {
                filter: brightness(110%);
            }

    </style>
</head>
<body>

<div class="container">
    <h1>Comments</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['Id']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['Comment']; ?></td>
                <td><?php echo ($row['Status'] == 1) ? 'Approved' : 'Pending'; ?></td>
                <td class="action-icons">
                    <?php if ($row['Status'] != 1) : ?>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="comment_id" value="<?php echo $row['Id']; ?>">
                            <button type="submit" class="approve-btn" name="approve_comment">Approve</button>
                        </form>
                    <?php endif; ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="comment_id" value="<?php echo $row['Id']; ?>">
                        <button type="submit" class="delete-btn" name="delete_comment">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
