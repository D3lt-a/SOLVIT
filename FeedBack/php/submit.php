<?php
    $conn = mysqli_connect("localhost", "root", "", "FeedBacks");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $rating = filter_var($_POST['rating'], FILTER_VALIDATE_INT);
    $comments = filter_var($_POST['comments'], FILTER_SANITIZE_STRING);

    if (empty($name) || empty($email) || empty($rating)) {
        echo "Please fill in all required fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, comments) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $email, $rating, $comments);
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Feedback submitted successfully');</script>";
        // header("Location: form.html");
    } else {
        echo "Error submitting feedback: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}

?>
