<?php

// database is connected
$link = mysqli_connect($server, $user, $password, $database);

// user's ID is written into the variable
$id = (int)$_SESSION['userID'];

// if $link variable is empty than output the message about failure during connecting to DB
if (!$link) {
    die("Connection to DB failed: " . mysqli_connect_error());
}

// function to get specific field CO2 footprint for the specific month of the specific year
function getMonthValue($chMonth, $chYear, $value)
{
    // making $link and $id accessible inside the function
    global $link, $id;

    // if $value = 1 than it is house, if =2 than it is secondary, if =3 it is transportation
    if ($value == 1) {
        $exportQuery = "SELECT SUM(house) FROM data WHERE users_ID = ? AND year = ? AND month = ?;";
    } elseif ($value == 2) {
        $exportQuery = "SELECT SUM(secondary) FROM data WHERE users_ID = ? AND year = ? AND month = ?;";
    } elseif ($value == 3) {
        $exportQuery = "SELECT SUM(transportation) FROM data WHERE users_ID = ? AND year = ? AND month = ?;";
    }

    // all the variables inside the query are interchanged with the values
    $query = mysqli_prepare($link, $exportQuery);
    mysqli_stmt_bind_param($query, "iis", $id, $chYear, $chMonth);

    // MySQL query is executed
    mysqli_stmt_execute($query);

    // the result of the query is binded to $i
    mysqli_stmt_bind_result($query, $i);
    mysqli_stmt_fetch($query);

    // function returns rounded $i
    return round($i / 1000, 2);
}

// function to get all time total or specific year total CO2 footprint
// all the explanation are the same as in getMonthValue() function
function getTotal($chYear = null)
{
    global $link, $id;
    // depending on whether the $chYear was given or not the output of the function will be different
    if ($chYear) {
        $exportQuery = "SELECT SUM(transportation)+SUM(house)+SUM(secondary) FROM data WHERE users_ID=? AND year = ?;";
        $query = mysqli_prepare($link, $exportQuery);
        mysqli_stmt_bind_param($query, "ii", $id, $chYear);
    } else {
        $exportQuery = "SELECT SUM(transportation)+SUM(house)+SUM(secondary) FROM data WHERE users_ID=?;";
        $query = mysqli_prepare($link, $exportQuery);
        mysqli_stmt_bind_param($query, "i", $id);
    }
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $i);
    mysqli_stmt_fetch($query);
    return round($i / 1000, 2);
}

// function to get number of distinct CO2 footprint records during the whole time or durinfg one specific year (later will be used in history.php to output all time average footprint)
// all the explanation are the same as in getMonthHouse() function
function getNumberOfRows($chYear = null)
{
    global $link, $id;
    // depending on whether the $chYear was given or not the output of the function will be different
    if ($chYear) {
        $exportQuery = "SELECT COUNT(DISTINCT year, month) FROM data WHERE users_ID = ? AND year = ?;";
        $result = mysqli_prepare($link, $exportQuery);
        mysqli_stmt_bind_param($result, "ii", $id, $chYear);
    } else {
        $exportQuery = "SELECT COUNT(DISTINCT year, month) FROM data WHERE users_ID = ?;";
        $result = mysqli_prepare($link, $exportQuery);
        mysqli_stmt_bind_param($result, "i", $id);
    }
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $n);
    mysqli_stmt_fetch($result);

    // if $n suddenly will be 0 than the function will return 1, because it is impossible to divide by 0
    if ($n == 0) {
        return 1;
    } else {
        return $n;
    }
}

?>