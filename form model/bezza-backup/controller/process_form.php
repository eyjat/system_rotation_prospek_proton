<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize selectedLocation in the session if it's not set
if (!isset($_SESSION['selectedLocation'])) {
    $_SESSION['selectedLocation'] = '';
}

// Check if the user has selected a new location
if (isset($_POST['locationSA']) && $_SESSION['selectedLocation'] !== $_POST['locationSA']) {
    // Clear the session data related to the assigned salesperson
    unset($_SESSION['assignedSalesperson']);
}

// Store the selected location in the session
$_SESSION['selectedLocation'] = $_POST['locationSA'];

$tableName = "bezzaSA"; // set table name here
include 'db.php';

$prosName = $_POST["prosName"];
$prosNum = $_POST["prosNum"];
$prosLocation = $_POST["locationSA"];

// Get the current date and time in the desired format
$currentDate = date("Y-m-d");

// Function to rotate sales agents based on location
function rotateSalesAgent($location) {
    global $conn;

    $sql = "SELECT nameSA, phoneNum FROM bezzaSA WHERE locationSA = '$location'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $agents = array();
        while ($row = $result->fetch_assoc()) {
            $agents[] = $row;
        }

        $filename = "last_used_agent.txt";
        $lastAgentIndex = file_exists($filename) ? intval(file_get_contents($filename)) : 0;
        $nextAgentIndex = ($lastAgentIndex + 1) % count($agents);
        file_put_contents($filename, $nextAgentIndex);

        $assignedAgent = $agents[$nextAgentIndex]['nameSA'];
        $assignedPhone = $agents[$nextAgentIndex]['phoneNum'];

        return array('nameSA' => $assignedAgent, 'phoneNum' => $assignedPhone);
    } else {
        // Handle the case when no sales agents are found for the location
        return null;
    }
}

$location = $_POST["locationSA"];

// Check if the assignedSalesperson field is set in the session
if (isset($_SESSION['assignedSalesperson'])) {
    $assignedAgentData = $_SESSION['assignedSalesperson'];
    $assignedAgent = $assignedAgentData['nameSA'];
    $assignedPhone = $assignedAgentData['phoneNum'];
} else {
    // Your rotation logic as before
    $assignedAgentData = rotateSalesAgent($location);
    if ($assignedAgentData) {
        $assignedAgent = $assignedAgentData['nameSA'];
        $assignedPhone = $assignedAgentData['phoneNum'];

        // Store the assigned salesperson in the session
        $_SESSION['assignedSalesperson'] = $assignedAgentData;
    } else {
        // Fallback: Send WhatsApp to the provided fallback number
        $assignedAgent = "Admin Perodua.my";
        $assignedPhone = "01120965467";
    }
}

$sqlInsert = "INSERT INTO bezzaData (prosName, prosNum, prosLocation, curDate, saName) VALUES ('$prosName', '$prosNum', '$prosLocation', '$currentDate', '$assignedAgent')";
$conn->query($sqlInsert);

// WhatsApp API integration
$whatsappApiUrl = "https://api.whatsapp.com/send?phone=6$assignedPhone&text=Hai%20saya%20$prosName,%20berminat%20nak%20beli%20Bezza.";

// Redirect to WhatsApp API URL
header("Location: $whatsappApiUrl");

$conn->close();
?>
