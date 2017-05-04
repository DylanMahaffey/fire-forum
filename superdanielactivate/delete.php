<?php
$id = $_GET["id"];

$conn = mysqli_connect("localhost", "root", "qpalz,", "fire_forum");

if(mysqli_connect_errno()){
    die("database connection failed: ". mysqli_connect_error().
    "(".mysqli_connect_errno().")");
};
$query = "DELETE FROM fires WHERE id = $id";
$comment_query = "DELETE FROM comments WHERE fire_id = $id";

$result = mysqli_query($conn, $query);
$comment_result = mysqli_query($conn, $comment_query);
if($result && $comment_result){
    header('Location: specialdeleteattack.php');
} else {
    die("database query failed. " . mysqli_error($conn));
}


mysqli_close($conn);
