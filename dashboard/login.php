<?php
session_start();

// Predefined admin credentials (for demonstration purposes)
$adminUsername = "admin";
$adminPassword = "admin1234*";

// Check if the user is already logged in
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: /dashboard/index.php"); // Redirect to dashboard if already logged in
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Check if the input credentials match the admin credentials
    if ($inputUsername === $adminUsername && $inputPassword === $adminPassword) {
        // Authentication successful
        $_SESSION['admin_logged_in'] = true;
        header("Location: /dashboard/index.php"); // Redirect to dashboard
        exit();
    } else {
        // Authentication failed
        $errorMessage = "Invalid username or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4 md:p-0 flex items-center justify-center h-screen">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-6">
        <img src="/pic/proton-logo.png" alt="proton Logo" class="w-48 mx-auto mb-10">
        <h1 class="text-2xl font-semibold text-center mb-4">Admin Login</h1>

        <?php
        if (isset($errorMessage)) {
            echo '<p style="color: red;">' . $errorMessage . '</p>';
        }
        ?>
        
        <form method="POST" action="">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Username:</label>
                <input type="text" id="username" name="username" required
                    class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                    placeholder="Enter your username">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" required
                    class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                    placeholder="Enter your password">
            </div>
            <button type="submit"
                class="block w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">Login</button>
        </form>
    </div>
</body>
</html>