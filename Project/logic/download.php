<?php
session_start();
include_once("./connect.db.php");
$link = mysqli_connect($server, $user, $password, $database);
$id = (int)$_SESSION['userID'];

// if button export is pressed than this function will perform
if (isset($_POST['export'])) {
    $i;

    // SQL query to export data from the SQL database
    $exportQuery = "SELECT year, month, house, secondary, transportation FROM data WHERE users_ID = ?";

    // preparing query to execution and binding parameters
    $query = mysqli_prepare($link, $exportQuery);
    mysqli_stmt_bind_param($query, "i", $id);

    // execution and assigning result to $i
    mysqli_stmt_execute($query);
    $i = mysqli_stmt_get_result($query);

    // HTTP headers for the CSV file download
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="data.csv"');

    // open output stream
    $output = fopen('php://output', 'w');

    // write headers to the stream
    fputcsv($output, array('Year', 'Month', 'House', 'Secondary', 'Transportation'));

    // loop through every row of result and writing the row to CSV file
    while ($row = mysqli_fetch_assoc($i)) {
        fputcsv($output, $row);
    }
    
    fclose($output);
    mysqli_close($link);
}
?>