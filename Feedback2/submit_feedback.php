<?php
include 'include/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $rating = (int)$_POST['rating'];
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);

    // Simple validation
    if (empty($name) || empty($email) || empty($rating) || empty($comments)) {
        die("All fields are required.");
    }

    // Insert feedback into the database
    $query = "INSERT INTO feedback (name, email, rating, comments) VALUES ('$name', '$email', '$rating', '$comments')";
    
    if (mysqli_query($conn, $query)) {
        echo "Feedback submitted successfully!";
        header("Location: admin.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
