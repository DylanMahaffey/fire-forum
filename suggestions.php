<?php
require "include/header.php";
    ?>
<div class="container">
    <p>Have a suggestion that could make the app better?  Let us know!</p>
    <form class="suggestion-form" action="https://formspree.io/dylan.mahaffey@gmail.com" method="POST">
        <input type="text" name="name" placeholder="name">
        <input type="email" name="email" placeholder="email">
        <textarea name="text" placeholder="comment"></textarea>
        <input type="hidden" name="_next" value="fire-frenzy/suggestions-thanks.php" />
        <input type="submit" name="submit" value="send">
    </form>
</div>
<?php require "include/footer.php" ?>
