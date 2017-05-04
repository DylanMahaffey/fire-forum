<?php
if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $spread = $_POST["spread"];
    $acres = $_POST["acres"];
    $structures = $_POST["structures"];
    $containment = $_POST["containment"];

    // echo $name . $spread . $acres . $spread . $structures . $containment;

    $conn = mysqli_connect("localhost", "root", "qpalz,", "fire_forum");

    if(mysqli_connect_errno()){
        die("database connection failed: ". mysqli_connect_error().
        "(".mysqli_connect_errno().")");
    };
    $query = "INSERT INTO fires (date, time, name, spread, acres, structures, containment)
                     VALUES (now(), now(), '{$name}', '{$spread}', $acres, $structures, $containment)";
    $result = mysqli_query($conn, $query);
    if($result){
        header('Location: ../fire-feed.php');
    } else {
        die("database query failed. " . mysqli_error($conn));
    }


    mysqli_close($conn);
} else {
    header('Location: ../fire-feed.php');
};
