<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php
        if( basename($_SERVER['PHP_SELF']) == "forum.php"){
            $headerCss = "css/header.css";
            $css = "css/forum.css";
        }elseif( basename($_SERVER['PHP_SELF']) == "fire-feed.php"){
            $headerCss = "css/header.css";
            $css = "css/fire-feed.css";
        }elseif( basename($_SERVER['PHP_SELF']) == "suggestions.php"){
            $headerCss = "css/header.css";
            $css = "css/suggestions.css";
        }elseif( basename($_SERVER['PHP_SELF']) == "suggestions-thanks.php"){
            $headerCss = "css/header.css";
            $css = "css/suggestions.css";
        }elseif( basename($_SERVER['PHP_SELF']) == "fire-store.php"){
            $headerCss = "css/header.css";
            $css = "css/fire-store.css";
        }elseif( basename($_SERVER['PHP_SELF']) == "specialdeleteattack.php"){
            $headerCss = "../css/header.css";
            $css = "../css/fire-feed.css";
        }
        elseif( basename($_SERVER['PHP_SELF']) == "megacommentdestroyer.php"){
            $headerCss = "../css/header.css";
            $css = "../css/forum.css";
        }
     ?>
     <link rel="stylesheet" href="<?= $headerCss ?>">
    <link rel="stylesheet" href=" <?= $css ?> ">

</head>
<body>
    <header>
        <nav>
            <a href="fire-news.php"><img src="img/fire.png" alt="ego"></a>
            <div id="menu-icon">
                <!-- three white lines -->
                <p></p> <p></p> <p></p>
            </div>
        </nav>
        <div id="nav-dropdown">
            <a href="fire-news.php"><div class="nav-option">News</div></a>
            <a href="fire-feed.php"><div class="nav-option">Dick Pics</div></a>
            <a href="fire-store.php"><div class="nav-option">Store</div></a>
            <a href="suggestions.php"><div class="nav-option">Suggestions</div></a>
        </div>
    </header>
