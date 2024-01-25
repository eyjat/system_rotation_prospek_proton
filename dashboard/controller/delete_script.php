<?php

include 'db.php';

// Check if the ID parameter and table name are provided
if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['table'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];

    // Delete the row from the database
    $sqlDelete = "DELETE FROM $table WHERE id = $id";

    if ($conn->query($sqlDelete) === true) {
        // Deletion successful
        $previousPage = $_SERVER['HTTP_REFERER'];
        header("Location: $previousPage"); // Redirect to the previous page after deletion
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
