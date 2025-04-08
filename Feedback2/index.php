<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Feedback</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Submit Feedback</h1>
        <form action="submit_feedback.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="rating">Rate your overall experienq:</label>
                <select id="rating" name="rating" required>
                    <option value="1">Poor</option>
                    <option value="2">Bad</option>
                    <option value="3">Good</option>
                    <option value="4">Very Good</option>
                    <option value="5">Excellent</option>
                </select>
            </div>

            <div class="form-group">
                <label for="comments">Comments:</label>
                <textarea id="comments" name="comments" rows="4" required></textarea>
            </div>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
