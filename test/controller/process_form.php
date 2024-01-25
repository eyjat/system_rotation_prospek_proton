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

$tableName = "myviSA"; // set table name here
include 'db.php';

$prosName = $_POST["prosName"];
$prosNum = $_POST["prosNum"];
$prosLocation = $_POST["locationSA"];

// Get the current date and time in the desired format
$currentDate = date("Y-m-d");

// Function to rotate sales agents based on location
function rotateSalesAgent($location) {
    global $conn;

    // Query the location_rotation table to get the last assigned agent ID for this location
    $sql = "SELECT last_assigned_agent_id FROM location_rotation WHERE location = '$location'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastAssignedAgentId = $row['last_assigned_agent_id'];

        // Query the myviSA table to get the list of agents for this location
        $sql = "SELECT id, nameSA, phoneNum FROM myviSA WHERE locationSA = '$location'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $agents = array();
            while ($row = $result->fetch_assoc()) {
                $agents[] = $row;
            }

            // Find the next agent in rotation
            $nextAgentIndex = ($lastAssignedAgentId + 1) % count($agents);
            $assignedAgentData = $agents[$nextAgentIndex];

            // Update the location_rotation table with the new last_assigned_agent_id
            $sql = "UPDATE location_rotation SET last_assigned_agent_id = $nextAgentIndex WHERE location = '$location'";
            $conn->query($sql);

            return $assignedAgentData;
        }
    }

    // Handle the case when no sales agents are found for the location or other errors
    return null;
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

$sqlInsert = "INSERT INTO myviData (prosName, prosNum, prosLocation, curDate, saName) VALUES ('$prosName', '$prosNum', '$prosLocation', '$currentDate', '$assignedAgent')";
$conn->query($sqlInsert);

// WhatsApp API integration
$whatsappApiUrl = "https://api.whatsapp.com/send?phone=6$assignedPhone&text=Hai%20saya%20$prosName,%20berminat%20nak%20beli%20Myvi.";

// Redirect to WhatsApp API URL
header("Location: $whatsappApiUrl");

$conn->close();
?>
