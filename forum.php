<?php

    require 'include/header.php';
    $id = $_GET["id"];
// MySQL connection
    $conn = mysqli_connect("localhost", "root", "qpalz,", "fire_forum");
    if(mysqli_connect_errno()){
        die("database connection failed: ". mysqli_connect_error()
        ."(".mysqli_connect_errno().")");
    };
    $fire_query = "SELECT * FROM fires WHERE id = $id";
    $comment_query = "SELECT * FROM comments WHERE fire_id = $id ORDER BY id DESC";
    $fires = mysqli_query($conn, $fire_query);
    $comments = mysqli_query($conn, $comment_query);

    if(!$fires || !$comments){
        die("database query failed.");
    }

// Getting the results from the fires table for the main information
    $fire = mysqli_fetch_assoc($fires);
    if(!isset($fire["id"])){
        header("Location: fire-feed.php");
    };
    $name = $fire["name"];
    if($fire["spread"] == "a"){
        $spread = "Slow";
    } elseif($fire["spread"] == "b"){
        $spread = "Medium";
    } elseif ($fire["spread"] == "c") {
        $spread = "Rapid";
    } else{
        $spread = "Unknown";
    };
    if($fire["acres"] == 0){
        $acres = "unknown";
    }else{
        $acres = $fire["acres"];
    }
    if($fire["structures"] == 0){
        $structures = "unknown";
    }else{
        $structures = $fire["structures"];
    }
    if($fire["containment"] == 0){
        $containment = "unknown";
    }else{
        $containment = $fire["containment"];
    };
 ?>
 <a href="fire-feed.php"><div title="Back to Fire Feed" class="backArrow">
    &#10140;
  </div></a>
<div class="head-name"><h1><?= $name ?></h1></div>
<div class="head-info">
    <div class="main-info"><h3>Spread Rate:</h3> <br>      <p><?= $spread ?></p>        </div>
    <div class="main-info"><h3>Acres:</h3>           <br>      <p><?= $acres ?></p>          </div>
    <div class="main-info"><h3>Structures:</h3>    <br>      <p><?= $structures?></p>   </div>
    <div class="main-info"><h3>Containment:</h3><br>     <p><?= $containment?></p></div>
</div>

<section>
    <?php
    // loop to display each comment
    while($comment = mysqli_fetch_assoc($comments)){
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

    <?php
    };
        ?>
</section>

<footer>
    <button id="add">Add Comment</button>
</footer>
<!-- the form for adding a new comment -->
<div id="modal">
    <div class="comment-contain">
        <form class="comment-form" action="include/add-comment.php?<?= "id=$id" ?>" method="post">
            Add a comment: <br>
            <textarea name="comment"></textarea>
            <br>
            <p>only change the following to update:</p>
            <p class="input-title">Spread Rate:</p><br>
            <div class="spread-select">
                <?php
//  this if statement is to check the radio button of the existing condition

                    if($fire["spread"] == "a"){
                        $s_check = "checked='checked'";
                        $m_check = "";
                        $r_check = "";
                    }elseif($fire["spread"] == "b"){
                        $s_check = "";
                        $m_check = "checked='checked'";
                        $r_check = "";
                    }elseif($fire["spread"] == "c"){
                        $s_check = "";
                        $m_check = "";
                        $r_check = "checked='checked'";
                    }else{
                        $s_check = "";
                        $m_check = "";
                        $r_check = "'";
                    }
                 ?>
                <input type="radio" name="spread" value="a" <?= $s_check ?>><p class="space">slow</p>
                <input type="radio" name="spread" value="b" <?= $m_check ?>><p class="space">medium</p>
                <input type="radio" name="spread" value="c" <?= $r_check ?>><p>rapid</p>
            </div>
            <br>
            <p class="input-title">Acres:</p> <br>
            <input type="number" name="acres"  value="<?= $acres ?>"> <br>
            <p class="input-title">Structures Threatened</p> <br>
            <input type="number" name="structures" value="<?= $structures ?>"> <br>
            <p class="input-title">Containment: </p><br>
            <input type="number" name="containment" value="<?= $containment ?>"> %<br>

            <input type="submit" name="submit" value="Submit">
            <input type="reset" id="cancel" value="Cancel">
        </form>
    </div>
</div>

<script type="text/javascript">
    var add = document.getElementById("add"),
          cancel = document.getElementById("cancel"),
          modal = document.getElementById("modal");

          add.onclick = function(){
              modal.style.display = "flex";
          }
          cancel.onclick = function(){
              modal.style.display = "none";
          }
</script>

<?php
        mysqli_free_result($fires);
        mysqli_free_result($comments);
        mysqli_close($conn);
        include 'include/footer.php';
 ?>
