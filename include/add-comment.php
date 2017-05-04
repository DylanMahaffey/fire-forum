<?php
if(isset($_POST["submit"])){

    if(isset($_POST["username"])){
        $username =  $_POST["username"];
    } else {
        $username = "Guest";
    };

$text = $_POST["comment"];
$fire_id = $_GET["id"];
$spread = $_POST["spread"];
$acres = $_POST["acres"];
$structures = $_POST["structures"];
$containment = $_POST["containment"];


$conn = mysqli_connect("localhost", "root", "qpalz,", "fire_forum");

if(mysqli_connect_errno()){
die("database connection failed: ". mysqli_connect_error().
"(".mysqli_connect_errno().")");
};

if(!empty($text)){
    $query = "INSERT INTO comments (fire_id, date, time, username, comment)
                     VALUES ('{$fire_id}', now(), now(), '{$username}', '{$text}')";
    $result = mysqli_query($conn, $query);
}

// updating fire data

$update_query = "UPDATE fires
                              SET spread = '{$spread}', acres = '{$acres}', structures = '{$structures}', containment = '{$containment}'
                              WHERE id=$fire_id";
$results = mysqli_query($conn, $update_query);
if( $results){
header("Location: ../forum.php?id=$fire_id");
} else {
die("database query failed. " . mysqli_error($conn));
}


mysqli_close($conn);
} else {
    header("Location: ../forum.php?id=$fire_id");
};
