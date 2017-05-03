<?php
    include 'include/database.php';
    include 'include/header.php';

    $conn = mysqli_connect("localhost", "root", "qpalz,", "fire_forum");

    if(mysqli_connect_errno()){
        die("database connection failed: ". mysqli_connect_error().
        "(".mysqli_connect_errno().")");
    };
 ?>
 <?php
    $query = "SELECT * FROM fires";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("database query failed.");
    }
  ?>

    <section>
        <?php for($i = 0; $i<count($fires); $i++){ ?>
            <a href="forum.php?id=<?= $fires[$i]["id"] ?>"><div class="fire"> <p>Posted:</p>
                    <p><?= $fires[$i]["date"] ?> </p>    <p><?= $fires[$i]["time"]  ?></p> <br>
                    <div class="fire-name"><p><?= $fires[$i]["name"]  ?></p></div>  <br>
                <div class="detail-section ">
                    <p>Spread Rate:</p> <br> <p><?= $fires[$i]["spread-rate"]  ?></p>
                </div>
                <div class="detail-section ">
                    <p>Acres Affected:</p> <br> <p><?= $fires[$i]["acres"]  ?></p>
                </div>
                <div class="detail-section ">
                    <p >Structures Threatened:</p> <br> <p><?= $fires[$i]["structures"]  ?></p>
                </div>
                <div class="detail-section ">
                    <p>Containment:    </p> <br> <p><?= $fires[$i]["containment"]  ?></p>
                </div>
            </div></a>
         <?php } ?>
    </section>

    <footer>
        <button id="addFire">Add New Fire</button>
    </footer>

    <div id="modal">
        <div class="fire-form">
             <form class="" action="include/formProcessing.php" method="post">
                <h3>name:</h3>
                <input type="text" name="name">
                <h3>spread rate:</h3>
                <input class="spread-radio" type="radio" name="spread-rate" value="Slow">
                <p>Slow</p>
                <input class="spread-radio" type="radio" name="spread-rate" value="Medium">
                <p>Medium</p>
                <input class="spread-radio" type="radio" name="spread-rate" value="Rapid">
                <p>Rapid</p>
                <h3>acres:</h3>
                <input type="text" name="acres">
                <h3>structures:</h3>
                <input type="text" name="structures">
                <h3>containment:</h3>
                <input type="text" name="containment" placeholder="%">

                <input type="submit" name="submit" value="Submit" id="fireSubmit">
                <input type="reset" name="cancel" value="Cancel" id="fireCancel">
            </form>
        </div>
    </div>
    <script type="text/javascript">
        var add = document.getElementById("addFire"),
              cancel = document.getElementById("fireCancel"),
              submit = document.getElementById("fireSubmit"),
              modal = document.getElementById("modal");

              add.onclick = function(){
                  modal.style.display = "flex";
              }
              submit.onclick = function(){
                  modal.style.display = "none"
              }
              cancel.onclick = function(){
                  modal.style.display = "none"
              }
    </script>
<?php
    include 'include/footer.php';
    mysqli_close($conn);
 ?>
