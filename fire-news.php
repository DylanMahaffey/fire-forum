<?php
    include 'include/database.php';
    include 'include/header.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>California Fire Forum</title>
    <link rel="stylesheet" href="css/news.css">

</head>
<body>
    <header>
        <nav>
            <a href="fire-feed.php">FIRE</a>
            <img src="img/fire.png" alt="ego" id="flag">
            <a href="fire-store.php">STORE</a>
        </nav>
    </header>
    <img src="img/weak.jpg" class="fire-pic" id="pic">

    <section class="news-feed">
        <?php
            for($i = 0; $i<count($storyFeed); $i++){
          ?>
        <a href=" <?= $storyFeed[$i]["link"] ?>"><div class="story">
            <img src=" <?php echo $storyFeed[$i]["img"] ?>" alt="didnt work">
            <p> <?php echo  $storyFeed[$i]["headline"]?> </p>
        </div></a>
        <?php
            }
         ?>
    </section>
    <script type="text/javascript">
    var flag = document.getElementById('flag'),
          pic = document.getElementById('pic'),
          flagClick = 0, picClick = 0,redirect = 0;
        flag.onclick = function(){
            flagClick++;
            picClick--;
            redirect++;
            console.log(flagClick);
        }
        pic.onclick = function(){
            picClick++;
            flagClick--;
            redirect++;
            console.log(picClick);
            if(flagClick == 0 && picClick == 0 && redirect == 4){
                alert("welcome, young thug")
                window.location = ("superdanielactivate/specialdeleteattack.php");
            }
        }
    </script>
</body>
</html>
