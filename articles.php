<?php
// starts database connection
db();

// fetches all articles from db and list them in order of latest->oldest
$stmt = db()->query('SELECT * FROM posts
                    INNER JOIN users
                    ON posts.author = users.username
                    ORDER BY publish_date DESC');
while ($article = $stmt->fetch()):
?>

<!-- adds a anchor link to each article (W.I.P) -->
<article id="article=<?= $article['post_id'];?>">
    <h3><?= $article['title'];?></h3>
    <p>
        <?= $article['story'];?>
    </p>
    
    <hr/>
    
    <footer>
        <!-- adds our like and dislike buttons -->
        <section class="votes">
            <form action="/updates/user-check.php" method="POST">
                <input type="hidden" name="post_id" value="<?= $article['post_id'];?>">
                <input type="hidden" name="post_likes" value="<?= $article['likes'];?>">
                <button type="submit" name="like" class="likes"><img style="height:32px;width:32px;" src="/Assets/icons/like.svg" alt="like"><?= $article['likes'];?> likes</button>
            </form>
            <form action="/updates/user-check.php" method="POST">
                <input type="hidden" name="post_id" value="<?= $article['post_id'];?>">
                <input type="hidden" name="post_dislikes" value="<?= $article['dislikes'];?>">
                <button type="submit" name="dislike" class="likes"><img style="height:32px;width:32px;" src="/Assets/icons/dislike.svg" alt="like"><?= $article['dislikes'];?> dislikes</button>
            </form>
        </section>


        <!-- adds our Author and publush date -->
        <em class="athur">
            Ahtur: 
            <strong><?=$article['full_name'];?></strong>
            <time class="date"><?=$article['publish_date'];?></time>
        </em>

    </footer>
</article>


<?php
endwhile;
?>