<?php
declare(strict_types=1);


// makes our database connection into an esier managebale function
function db():PDO {

    // path to our db file
    $dir = 'sqlite:/'. __DIR__ .'/fake-news-db.sqlite3';
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dir, '', '',  $options); //tries to connect to our databse using $path, $username, $passowrd, $options 
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode()); //sends out an error message if it fails to connect.
    }

    return $pdo;
}

// gives us our error message with our query and erro code
function handle_sql_errors($query, $error_message):string {
    $message = "<pre>
                    <br>
                    $query
                    <br>
                </pre>
                <br>
                $error_message";
    return $message;
}

// adds like to our posts
function addLike(int $postId, int $postLikes){
    echo $postId;
    echo "<br>";
   

    $give_likes = db()->prepare('UPDATE posts 
                SET likes = :likes 
                WHERE post_id = :post_id ');
    $give_likes->execute([
                    'likes'=>++$postLikes,
                    'post_id'=>$postId
                ]);

      
}

// Adds dislikes to our posts (cause we like equality)
function addDislike(int $postId, int $postDislikes){

    $give_likes = db()->prepare('UPDATE posts 
                SET dislikes = :dislikes 
                WHERE post_id = :post_id ');
    $give_likes->execute([
                    'dislikes'=>++$postDislikes,
                    'post_id'=>$postId
                ]);

}

// signs us out by cleaning the $_SESSION array
//and destroys our session then redirect us back to main page
function signOut(){
    $_SESSION = [];
    session_destroy();
    echo $_SESSION['user'];
    header('location: ../index.php');
}


?>
