<?php
$array = array("turkey", "peanuts", "asshole", "", "", "percimons");
$list= [];
for ($i = 0; $i <count($array);$i++){

    if (!empty($array[$i])){
        array_push($list, $array[$i]);
    }
    // echo $array["$i"]."<br/> <br/>";
}
echo "<br/><br/>". print_r($list) ;
