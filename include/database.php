<?php
$fires = [
    array("id"=>"1", "date"=>"4/27/17", "time"=>"15:35","name"=>"colinga fire", "spread-rate"=>"med","acres"=>500, "structures"=>2,"containment"=>"30%"),
    array("id"=>"2", "date"=>"4/25/17", "time"=>"15:35","name"=>"fresno fire", "spread-rate"=>"slow","acres"=>100, "structures"=>20,"containment"=>"70%"),
    array("id"=>"3", "date"=>"4/23/17", "time"=>"15:35","name"=>"butthole fire", "spread-rate"=>"rapid","acres"=>800, "structures"=>3,"containment"=>"10%")
];

$forum = [
    array("fire-id"=>"1", "time"=>"4:20", "text"=>"the fire is lit breh. per IC 40 structures threatened.  two strike team limas on order."),
    array("fire-id"=>"1", "time"=>"4:20", "text"=>"im lit breh hahaha. per IC 48 structures threatened.  three strike team limas on order."),
    array("fire-id"=>"1", "time"=>"4:20", "text"=>"wut is fire. per IC 52 structures threatened.  two strike team limas on order."),
    array("fire-id"=>"2", "time"=>"4:20", "text"=>"wut is fire. per IC 52 structures threatened.  two strike team limas on order."),
];

$storyFeed = [
    array("img/cock-face.jpg", "Firefighter sets new record for dicks sucked"),
    array("img/pussy-shit.jpg", "BREAKING NEWS: fire is hot!"),
    array("img/real-firefighter.jpg", "stuff is happening, and its BIG!")
];

// MySQL

$conn = mysqli_connect("localhost", "root", "qpalz,", "fire_forum");

if(mysqli_connect_errno()){
    die("database connection failed: ". mysqli_connect_error().
    "(".mysqli_connect_errno().")");
};




mysqli_close($conn);
