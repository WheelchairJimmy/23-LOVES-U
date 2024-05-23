<?php
// poll.php

// Function to sanitize user input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate prediction
    $prediction = $_POST["prediction"] ?? "";
    $prediction = sanitizeInput($prediction);

    // Check if prediction is valid
    if ($prediction !== "win" && $prediction !== "lose" && $prediction !== "draw") {
        // Handle invalid prediction
        echo "Invalid prediction!";
    } else {
        // Store prediction in a text file
        $file = 'predictions.txt'; // Path to text file
        $timestamp = date("Y-m-d H:i:s");
        $predictionData = "$timestamp - Prediction: $prediction\n";
        file_put_contents($file, $predictionData, FILE_APPEND | LOCK_EX);

        // Redirect back to schedule.view.php with a success message
        header("Location: schedule.view.php?prediction=success");
        exit();
    }
} else {
    // Handle direct access to the file
    echo "Access denied!";
}

