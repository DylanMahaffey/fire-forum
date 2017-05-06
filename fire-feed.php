<?php
    include 'include/header.php';

    $conn = mysqli_connect("localhost", "root", "qpalz,", "fire_forum");

    if(mysqli_connect_errno()){
        die("database connection failed: ". mysqli_connect_error().
        "(".mysqli_connect_errno().")");
    };

    if (empty($_POST["filter"])){
        $query = "SELECT * FROM fires ORDER BY id DESC";
        $fires = mysqli_query($conn, $query);
        if(!$fires){
            die("database query failed.");
        }
    } else {
        $filter = $_POST["filter"];
        if(isset($_POST["order"])){
            $order = $_POST["order"];
        }else{
            $order = "DESC";
        }

        $query = "SELECT * FROM fires ORDER BY $filter $order";
        $fires = mysqli_query($conn, $query);
        if(!$fires){
            die("database query failed.");
        }
    }
  ?>
  <?php
  $d_option =  $sp_option =  $a_option =  $st_option =  $c_option = $de_check = $as_check = "";
if (isset($_POST["filter"])){
      switch ($_POST["filter"]) {
      case $_POST["filter"]=="id":
          $d_option = "selected='selected'";
          break;
      case $_POST["filter"]=="spread":
          $sp_option = "selected='selected'";
          break;
      case $_POST["filter"]=="acres":
          $a_option = "selected='selected'";
          break;
      case $_POST["filter"]=="structures":
          $st_option = "selected='selected'";
          break;
      case $_POST["filter"]=="containment":
          $c_option = "selected='selected'";
          break;
        default:
          $d_option =  $sp_option =  $a_option =  $st_option =  $c_option = "";
    }
    if($order == "ASC"){
        $as_check = "checked='checked'";
    }else{
        $de_check = "checked='checked'";
    }
}

   ?>
    <form id="filter-form" action="fire-feed.php" method="post">
        <select class="" name="filter">
            <option value="id" <?= $d_option ?>>date</option>
            <option value="spread" <?= $sp_option ?>>spread rate</option>
            <option value="acres" <?= $a_option ?>>acres</option>
            <option value="structures" <?= $st_option ?>>structures</option>
            <option value="containment" <?= $c_option ?>>containment</option>
        </select>
        <input type="radio" name="order" class="order-radio" value="ASC" <?= $as_check ?>>lowest
        <input type="radio" name="order" class="order-radio" value="DESC" <?= $de_check?>>highest
        <input type="submit" name="" value="submit">

    </form>
    <section>
        <?php
        while($fire = mysqli_fetch_assoc($fires)){
                $time = substr($fire["time"], 0, -3);
                $date = $fire["date"];
                $Y = substr($date, 0, -6);
                $m = substr($date, 5, -3);
                $d = substr($date, 8);
                $name = $fire["name"];
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
                    $containment = $fire["containment"]."%";
                };
            ?>
            <a href="forum.php?id=<?= $fire["id"] ?>"><div class="fire"> <p>Posted:</p>
                    <p><?=  "$m-$d-$Y"?> </p>    <p><?= $time ?></p> <br>
                    <div class="fire-name"><p><?= $name  ?></p></div>  <br>
                <div class="detail-section ">
                    <p>Spread Rate:</p> <br>
                     <p><?php
                    if($fire["spread"] == "a" ){
                        echo "slow";
                    } elseif ($fire["spread"] == "b" ){
                        echo "medium";
                    } elseif ($fire["spread"] == "c" ) {
                        echo "rapid";
                    }else{
                        echo "unknown";
                    };

                    ?></p>
                </div>
                <div class="detail-section ">
                    <p>Acres Affected:</p> <br> <p><?= $acres  ?></p>
                </div>
                <div class="detail-section ">
                    <p >Structures Threatened:</p> <br> <p><?= $structures  ?></p>
                </div>
                <div class="detail-section ">
                    <p>Containment:    </p> <br> <p><?= $containment  ?></p>
                </div>
            </div></a>
         <?php } ?>
    </section>

    <footer>
        <button id="add">Add New Fire</button>
    </footer>

    <?php
    if(empty($_GET["error"])){
        $error = "valid";
    }else{
        $error = $_GET["error"];
    }

     ?>

    <div id="modal">
        <div class="fire-form">
             <form id="add-form" action="include/add-fire.php" method="post">
                <h3>name:</h3>
                <input id="name" type="text" name="name" required>
                <h3>spread rate:</h3>
                <input class="spread-radio" type="radio" name="spread" value="a">
                <p>Slow</p>
                <input class="spread-radio" type="radio" name="spread" value="b">
                <p>Medium</p>
                <input class="spread-radio" type="radio" name="spread" value="c">
                <p>Rapid</p>
                <h3>acres:</h3>
                <input type="number" name="acres" >
                <h3>structures threatened:</h3>
                <input type="number" name="structures" >
                <h3>containment:</h3>
                <input type="number" name="containment" >% <br>

                <input type="submit" name="submit" value="Submit">
                <input type="reset" name="cancel" value="Cancel" id="cancel">
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
    include 'include/footer.php';
    mysqli_close($conn);
 ?>
