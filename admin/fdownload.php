<?php
session_start();// Starting Session
require('../sql.php'); // Includes Login Script

// // Replace these with your database credentials
// $host = 'your_host';
// $username = 'your_username';
// $password = 'your_password';
// $database = 'your_database';

// // Create a connection
// $conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM farmerlogin";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // Output column headers (optional)
    // fputcsv($output, array('Column1', 'Column2', 'Column3'));
    // fwrite($output, "\n");

    // Fetch and output each row of data
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
        fwrite($output, "\n");
    }
    fwrite($output, "\n");
    // Close the file pointer 
    fclose($output);
} else {
    echo "No records found";
}

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$download");
readfile($download);

?>
