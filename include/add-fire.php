<?php
if(isset($_POST["submit"])){
    $name = addslashes($_POST["name"]);

    if (empty($_POST["spread"])){
        $spread = "u";
    } else {
        $spread = $_POST["spread"];
    }
    if (empty($_POST["acres"])){
        $acres = 0;
    } else {
        $acres = $_POST["acres"];
    }
    if (empty($_POST["structures"])){
        $structures = 0;
    } else {
        $structures = $_POST["structures"];
    }
    if (empty($_POST["containment"])){
        $containment = 0;
    } else {
        $containment = $_POST["containment"];
    }

    $conn = mysqli_connect("localhost", "root", "qpalz,", "fire_forum");
    if(mysqli_connect_errno()){
        die("database connection failed: ". mysqli_connect_error().
        "(".mysqli_connect_errno().")");
    };
    $query = "INSERT INTO fires (date, time, name, spread, acres, structures, containment)
                     VALUES (now(), now(), '{$name}', '{$spread}', $acres, $structures, $containment)";
    $result = mysqli_query($conn, $query);
    if($result){
        header("Location: ../fire-feed.php");
    } else {
        die("database query failed. " . mysqli_error($conn));
    }


    mysqli_close($conn);
} else {
    header('Location: ../fire-feed.php');
};
