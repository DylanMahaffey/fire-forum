<?php
    include '../include/database.php';
    require '../include/header.php';
    $id = $_GET["id"];
    $conn = mysqli_connect("localhost", "root", "qpalz,", "fire_forum");

    if(mysqli_connect_errno()){
        die("database connection failed: ". mysqli_connect_error().
        "(".mysqli_connect_errno().")");
    };
    $fire_query = "SELECT * FROM fires WHERE id = $id";
    $comment_query = "SELECT * FROM comments WHERE fire_id = $id ORDER BY id DESC";
    $fires = mysqli_query($conn, $fire_query);
    $comments = mysqli_query($conn, $comment_query);

    if(!$fires || !$comments){
        die("database query failed.");
    }
    $fire = mysqli_fetch_assoc($fires);

    if($fire["spread"] == "s"){
        $spread = "Slow";
    } elseif($fire["spread"] == "m"){
        $spread = "Medium";
    } elseif ($fire["spread"] == "r") {
        $spread = "Rapid";
    };
    $acres = $fire["acres"];
    $structures = $fire["structures"];
    $containment = $fire["containment"];
 ?>

<div class="head-info">
    <div class="main-info"><h3>Spread Rate:</h3> <br>      <p><?= $spread ?></p>        </div>
    <div class="main-info"><h3>Acres:</h3>           <br>      <p><?= $acres ?></p>          </div>
    <div class="main-info"><h3>Structures:</h3>    <br>      <p><?= $structures?></p>   </div>
    <div class="main-info"><h3>Containment:</h3><br>     <p><?= $containment."%"?></p></div>
</div>

<section>
    <?php while($comment = mysqli_fetch_assoc($comments)){
            $time = substr($comment["time"], 0, -3);
            $date = $fire["date"];
            $text = $comment["comment"];
            $Y = substr($date, 0, -6);
            $m = substr($date, 5, -3);
            $d = substr($date, 8);
        ?>
    <div class="comment">
        <div class="comment-bar"><h3>Guest:</h3><p><?="$m-$d-$Y $time"?></p></div>
        <div class="comment-text"><p><?= $text?></p></div>
    </div>
    <form class="" action="comment-delete.php?id=<?= $comment["id"] ?>&fire_id=<?= $id?>" method="post">
        <button type="submit" name="delete">mega delete punch</button>
    </form>

    <?php
    };
        ?>
</section>
<?php
    include '../include/footer.php';
        mysqli_free_result($fires);
        mysqli_free_result($comments);
        mysqli_close($conn);
 ?>
