<?php
/**
 * Created by PhpStorm.
 * User: suren
 * Date: 24/02/2018
 * Time: 11:26
 */

if ($connection) {
    echo "is connected from functions.php";
} else {
    echo "not connected";
}



funtion redirect($location) {
    header("Location: $location");
}


function query($sql) {
    //if you want to use the connection inside the function make it global..
    global $connection;
    return mysqli_query($connection, $sql);
}