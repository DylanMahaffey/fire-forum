<?php
    // include 'include/database.php';
    include '../include/header.php';

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
        $order = $_POST["order"];
        $query = "SELECT * FROM fires ORDER BY $filter $order";
        $fires = mysqli_query($conn, $query);
        if(!$fires){
            die("database query failed.");
        }
    }
  ?>
    <form id="filter-form" action="fire-feed.php" method="post">
        <select class="" name="filter">
            <option value="date">date</option>
            <option value="spread">spread rate</option>
            <option value="acres">acres</option>
            <option value="structures">structures</option>
            <option value="containment">containment</option>
        </select>
        <input type="radio" name="order" class="order-radio" value="ASC" checked="checked">lowest
        <input type="radio" name="order" class="order-radio" value="DESC">highest
        <input type="submit" name="" value="submit">

    </form>
    <section>
        <?php while($fire = mysqli_fetch_assoc($fires)){
                $time = substr($fire["time"], 0, -3);
                $date = $fire["date"];
                $Y = substr($date, 0, -6);
                $m = substr($date, 5, -3);
                $d = substr($date, 8);
            ?>
            <a href="megacommentdestroyer.php?id=<?= $fire["id"] ?>"><div class="fire"> <p>Posted:</p>
                    <p><?=  "$m-$d-$Y"?> </p>    <p><?= $time ?></p> <br>
                    <div class="fire-name"><p><?= $fire["name"]  ?></p></div>  <br>
                <div class="detail-section ">
                    <p>Spread Rate:</p> <br>
                     <p><?php
                    if($fire["spread"] == "s" ){
                        echo "slow";
                    } elseif ($fire["spread"] == "m" ){
                        echo "medium";
                    } elseif ($fire["spread"] == "r" ) {
                        echo "rapid";
                    }

                    ?></p>
                </div>
                <div class="detail-section ">
                    <p>Acres Affected:</p> <br> <p><?= $fire["acres"]  ?></p>
                </div>
                <div class="detail-section ">
                    <p >Structures Threatened:</p> <br> <p><?= $fire["structures"]  ?></p>
                </div>
                <div class="detail-section ">
                    <p>Containment:    </p> <br> <p><?= $fire["containment"]."%"  ?></p>
                </div>
                <form class="" action="delete.php?id=<?= $fire["id"] ?>" method="post">
                    <button type="submit" name="delete">delete button of doom</button>
                </form>

            </div></a>
         <?php } ?>
    </section>

<?php
    mysqli_free_result($fires);
    include '../include/footer.php';
    mysqli_close($conn);
 ?>
