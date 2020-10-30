<?php
// fetches data, functions and header
include __DIR__ . "/data.php";
include __DIR__ . "/functions.php";
include __DIR__ . "/header.php";

session_start();


?> 
        <!-- Sets the logo as h1 with the alt tag set to FAKE NEWS -->
        <h1><img src="/Assets/icons/fake_news_medium.svg" alt="FAKE NEWS!"></h1>
        <p>
            <em>"Now I can't even read the news today, it remind me of yesterday..."</em>
            The Swedish artist Sanna Nilsen sang this words in her song "Empty Room", and I agree with her.
            Have you ever read the news and felt "Woho! All is awsome in the world!" I mean, the news are sad, boring and often unintresting.
            FAKE NEWS! The one site where you can read about fake news without needing to worry about if it's fact check, we already done that part,
            and we are pretty sure it's all bogus. That said, enjoy a more intresting read!
        </p>

        <h2>News Feed</h2>
        <?php

        if(isset($_SESSION['errors'])){
            ?><strong><?= $_SESSION['errors'];?></strong>
            <?php
        }

        // loads in articles
        include __DIR__ . "/articles.php";
        

        // adds our footer
        include __DIR__ . "/footer.php";
?>
