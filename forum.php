<?php
    include 'include/database.php';
    require 'include/header.php';
    $id = $_GET["id"];
    for ($i = 0; $i<count($fires); $i++){
        if ($fires[$i]["id"]==$id){
            $spread = $fires[$i]["spread-rate"];
            $acres = $fires[$i]["acres"];
            $structures = $fires[$i]["structures"];
            $containment = $fires[$i]["containment"];
        }
    };


 ?>

<div class="head-info">
    <div class="main-info"><h3>Spread Rate:</h3> <br>      <p><?= $spread ?></p>        </div>
    <div class="main-info"><h3>Acres:</h3>           <br>      <p><?= $acres ?></p>          </div>
    <div class="main-info"><h3>Structures:</h3>    <br>      <p><?= $structures ?></p>   </div>
    <div class="main-info"><h3>Containment:</h3><br>     <p><?= $containment ?></p></div>
</div>

<section>
    <?php
    for ($i = 0; $i<count($forum); $i++){
        if($forum[$i]["fire-id"]==$id){
            $time = $forum[$i]["time"];
            $text = $forum[$i]["text"];
        ?>
    <div class="comment">
        <div class="comment-bar"><h3>Guest:</h3><p><?= $time?></p></div>
        <div class="comment-text"><p><?= $text?></p></div>
    </div>

    <?php
        }
    };
        ?>
</section>

<footer>
    <button id="addComment">Add Comment</button>
</footer>

<div id="modal">
    <div class="comment-contain">
        <form class="comment-form" method="post">
            Add a comment: <br>
            <textarea name="comment" ></textarea>
            <br>
            <p>only change the following to update:</p>
            <p class="input-title">Spread Rate:</p><br>
            <div class="spread-select">
                <input type="radio" name="spread" value="slow"><p class="space">slow</p>
                <input type="radio" name="spread" value="medium"><p class="space">medium</p>
                <input type="radio" name="spread" value="rapid"><p>rapid</p>
            </div>
            <br>
            <p class="input-title">Acres:</p> <br>
            <input type="number" name="acres" > <br>
            <p class="input-title">Structures Threatened</p> <br>
            <input type="number" name="structures" > <br>
            <p class="input-title">Containment:</p> <br>
            <input type="number" name="containment" placeholder="%"><br>

            <input id="submit" type="submit" name="submit" value="Submit">
            <input type="reset" id="cancel" value="Cancel">
        </form>
    </div>
</div>

<script type="text/javascript">
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
    include 'include/footer.php';
 ?>
