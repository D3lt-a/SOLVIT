<?php
// Hardcoded admin login
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['username'] == 'admin' && $_POST['password'] == 'password') {
    $_SESSION['loggedin'] = true;
    header("Location: admin.php");
}

if (!isset($_SESSION['loggedin'])) {
    echo '<form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
          </form>';
    exit;
}

include 'include/db.php';

$query = "SELECT * FROM feedback ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

echo "<h1>Admin Feedback Dashboard</h1>";

echo "<table border='1'>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Rating</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    $ratingColor = ($row['rating'] >= 4) ? 'green' : (($row['rating'] <= 2) ? 'red' : 'yellow');
    echo "<tr style='background-color: $ratingColor'>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['rating']}</td>
            <td>{$row['comments']}</td>
            <td>{$row['created_at']}</td>
          </tr>";
}
echo "</table>";
?>
