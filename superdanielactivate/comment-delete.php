<?php
$id = $_GET["id"];
$fire_id = $_GET["fire_id"];

$conn = mysqli_connect("localhost", "root", "qpalz,", "fire_forum");

if(mysqli_connect_errno()){
    die("database connection failed: ". mysqli_connect_error().
    "(".mysqli_connect_errno().")");
};
$query = "DELETE FROM comments WHERE id = $id";
$result = mysqli_query($conn, $query);
if($result){
    header("Location: megacommentdestroyer.php?id=$fire_id");
} else {
    die("database query failed. " . mysqli_error($conn));
}

mysqli_close($conn);
