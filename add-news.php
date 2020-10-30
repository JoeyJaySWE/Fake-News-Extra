<?php
// checks if we have entered a full name to the db, if not it prints out a box for it.
$find_name = db()->prepare('SELECT full_name FROM users WHERE username=:username');
$find_name->execute(['username'=>$_SESSION['user']]);
$full_name = $find_name->fetch();
if( $full_name['full_name'] != "Link"):

    ?>
    <!-- Our user UI to add news -->
    <form class="add_news" action="/updates/upload.php" method="POST">
        <span>Welcome <?= $_SESSION['user'];?>!</span>
        <h2>Add an article!</h2>
    
        <input type="text" name="news_title" class="title" placeholder="My news Title...">
    
        <textarea name="news_story" placeholder="My news story..."></textarea>
    
        <input type="submit" name="submit">
    
    </form>
    
    <a href="/updates/sign-out.php">Sign out <?= $_SESSION['user'];?></a>
<?php
    else:


?>

        <!-- If we hadn't entered a full name yet, we do so here -->
    Enter your full name in order to add your articles
    <form action="/updates/user-check.php" method="POST">
        <input type="text" placeholder="Earl Stevenssen" name="new_full_name">
        <input type="submit" value="Continue">
    </form>
    <a href="/updates/sign-out.php">Sign out <?= $_SESSION['user'];?></a>
        
<?php

    endif;
    if(isset($_SESSION['error'])):
        ?>
        <strong><?= $_SESSION['error'];?></strong>
        <?php
        endif;
    
?>