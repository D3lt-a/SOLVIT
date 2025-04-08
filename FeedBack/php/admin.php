<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "FeedBacks");

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = 'admin';
        $password = 'password'; // Change this to a secure password

        if ($_POST['username'] === $username && $_POST['password'] === $password) {
            $_SESSION['logged_in'] = true;
        } else {
            echo "Invalid username or password.";
            exit;
        }
    } else {
        ?>
        <form action="admin.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>
            <button type="submit">Login</button>
        </form>
        <?php
        exit;
    }
}

$stmt = $conn->prepare("SELECT * FROM feedback ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../assets/css/admin-style.css">
</head>
<body>
    <div class="admin-container">
        <h2>Feedback Submissions</h2>
        <table id="feedback-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Rating</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <?php if ($row['rating'] >= 4) { ?>
                                <span class="positive-rating"><?php echo $row['rating']; ?></span>
                            <?php } elseif ($row['rating'] <= 2) { ?>
                                <span class="negative-rating"><?php echo $row['rating']; ?></span>
                            <?php } else { ?>
                                <span class="neutral-rating"><?php echo $row['rating']; ?></span>
                            <?php } ?>
                        </td>
                        <td><?php echo $row['comments']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
