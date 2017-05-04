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
    <button id="addComment">Add Comment</button>
</footer>
<!-- the form for adding a new comment -->
<div id="modal">
    <div class="comment-contain">
        <form class="comment-form" action="include/add-comment.php?<?= "id=$id" ?>" method="post">
            Add a comment: <br>
            <textarea name="comment" ></textarea>
            <br>
            <p>only change the following to update:</p>
            <p class="input-title">Spread Rate:</p><br>
            <div class="spread-select">
                <?php
//  this if statement is to check the radio button of the existing condition

                    if($fire["spread"] == "s"){
                        $s_check = "checked='checked'";
                        $m_check = "";
                        $r_check = "";
                    }elseif($fire["spread"] == "m"){
                        $s_check = "";
                        $m_check = "checked='checked'";
                        $r_check = "";
                    }elseif($fire["spread"] == "r"){
                        $s_check = "";
                        $m_check = "";
                        $r_check = "checked='checked'";
                    }
                 ?>
                <input type="radio" name="spread" value="s" <?= $s_check ?>><p class="space">slow</p>
                <input type="radio" name="spread" value="m" <?= $m_check ?>><p class="space">medium</p>
                <input type="radio" name="spread" value="r" <?= $r_check ?>><p>rapid</p>
            </div>
            <br>
            <p class="input-title">Acres:</p> <br>
            <input type="number" name="acres"  value="<?= $acres ?>"> <br>
            <p class="input-title">Structures Threatened</p> <br>
            <input type="number" name="structures" value="<?= $structures ?>"> <br>
            <p class="input-title">Containment: </p><br>
            <input type="number" name="containment" value="<?= $containment ?>"> %<br>

            <input id="submit" type="submit" name="submit" value="Submit">
            <input type="reset" id="cancel" value="Cancel">
        </form>
    </div>
</div>

<script type="text/javascript">
// javascript to work the modal
    var   add = document.getElementById("addComment"),
            modal = document.getElementById("modal"),
            cancel = document.getElementById("cancel"),
            submit = document.getElementById("submit");
    add.onclick = function() {
        modal.style.display = "flex"
    }
    submit.onclick = function() {
        modal.style.display = "none"
    }
    cancel.onclick = function() {
        modal.style.display = "none"
    }
</script>
<?php
        mysqli_free_result($fires);
        mysqli_close($conn);
        include 'include/footer.php';
 ?>
