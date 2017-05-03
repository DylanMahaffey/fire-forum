<?php
    include 'include/database.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fire News</title>
    <link rel="stylesheet" href="css/news.css">

</head>
<body>
    <header>
        <nav>
            <a href="fire-feed.php">FIRE</a>
            <img src="img/fire.png" alt="ego">
            <a href="fire-store.php">STORE</a>
        </nav>
    </header>
    <img src="img/weak.jpg" class="fire-pic">

    <section class="news-feed">
        <?php
            for($i = 0; $i<count($storyFeed); $i++){
          ?>
        <div class="story">
            <img src=" <?php echo $storyFeed[$i][0] ?>" alt="didnt work">
            <p> <?php echo  $storyFeed[$i][1]?> </p>
        </div>
        <?php
            }
         ?>
    </section>

</body>
</html>
