<?php
?>
<h2>Sing up/in!</h2>
<p>
    Type in your user name and password below.
    If user name doesn't exist, it will create one for you
    with the password you typed in.
</p>
<form action="/updates/user-check.php" method="post">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="submit" value="Sign in">
</form>
<?php

if(isset($_SESSION['error'])):
    ?>
    <!-- in case of errors, it's printed below -->
    <strong id="errors"><?= $_SESSION['error'];?></strong>

    <?php
endif;