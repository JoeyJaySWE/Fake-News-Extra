<?php
require "../data.php";
require "../functions.php";
session_start();


// sends user back to main site incase they try to manually enter the page
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location: /index.php');
}


db();








/* --------------  Checking if Full Name was sent -------------------------------*/

// starts by checking if we got the full name request
// if so it will add it to database
if(isset($_POST['new_full_name'])){

    $_POST['new_full_name'] = filter_var($_POST['new_full_name'], FILTER_SANITIZE_STRING);
   
    try{
        
        $update_full_name = db()->prepare('UPDATE users 
                                            SET full_name = :new_full_name 
                                            WHERE username = :username');

            $update_full_name->execute([
                'new_full_name'=> $_POST['new_full_name'],
                'username'=>$_SESSION['user']]);
    }
    // if adding fails, it will return a error message, and go to the anchor poitn of the error message
    catch(PDOException $e){
        $_SESSION['error'] = handle_sql_errors($update_full_name, $e->getMessage());
        header("location: /index.php#errors");
    }
    $success = $update_full_name->fetchAll();
    
    // if we succed but get no hits in the db
    if(sizeof($success) === 0){
        $_SESSION['error'] = "Couldn't find user in Database";
       
        header("location: /index.php#errors");
    }
    $_SESSION['error'] = '';
    header("location: /../#users");
}









/*---------- Checks if we pressed any of the like/dislike buttons -----------------*/


// checks if we hit the like button of a post
if(isset($_POST['post_likes'])){

    addLike((int)$_POST['post_id'], $_POST['post_likes']);
    header("location: /index.php#article=".$_POST['post_id']);
}

// checks if we hit the dislike button fo a post
if(isset($_POST['dislike'])){
    $post_id = $_POST['post_id']; 
    addDislike($post_id, (int)$_POST['post_dislikes']);
    header("location: /index.php#article=".$post_id."");
    
  

}











/*------------ User Credential Checks ----------------------*/


if(isset($_POST['password'])){

    $_POST['password'] = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $_POST['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    // encrypts our password through salted md5 + reverse
    $tmp_password=md5($_POST['password']).'j47dl1';
    $tmp_password = strrev($tmp_password);
    $tmp_password = md5($tmp_password);
    $tmp_password = strrev($tmp_password);
    $username = trim($_POST['username']);
    
    
    
    
    // tries to find our user
    try{


        $find_user = db()->prepare('SELECT username FROM users WHERE username = :username');
        $find_user->execute(['username'=> $username]);
    }
    catch(PDOException $e){
        $_SESSION['error'] = handle_sql_errors($update_full_name, $e->getMessage());
        die(var_dump("User password failed"));
        header("location: /index.php#errors");
    }
    
    $row = $find_user->fetch(PDO::FETCH_ASSOC);
    
    
    
    
    //If match was found check password
    if($row){

        try{
            $password_check = db()->prepare('SELECT * FROM users WHERE password = :password');
            $password_check->execute(['password'=>$tmp_password]);
            // die(var_dump($tmp_password));
        }
        catch(PDOException $e){
            $_SESSION['error'] = handle_sql_errors($update_full_name, $e->getMessage());
            header("location: ../index.php#errors");
        }
        
        
   

        
        $match = $password_check->fetchAll();
        // if password matches, sign user in. Else print out error message
        if(sizeof($match) !== 0){
         
            session_start();
            $_SESSION['user'] = $username;
            $_SESSION['error'] = '';
            header('location: /../#users');
        }
        else
        {
      
            $_SESSION['error'] = "Password missmatch!";
            
            echo $_SESSION['error'];
            header('location: ../index.php#errors');
            die(var_dump("Unkown error, try refreshingt he page."));
        }
    } 
    
    
    
    
    // if user wasn't found, try adding it using the the enter username and password
    
    else{

        
        
        
        
        

        try{
            // var_dump($username);
            // die(var_dump(tmp_));
            $create_user = db()->prepare('INSERT INTO users (full_name, username, "password") VALUES
                                                        (:full_name, :username, :password)');
        $create_user->execute([
            'full_name'=> 'Link',
            'username'=> $username,
            'password'=> $tmp_password
            ]);
            header("location: /index.php#users");
        }

        catch(PDOException $e){
            $_SESSION['error'] = handle_sql_errors($update_full_name, $e->getMessage());
            header("location: /index.php#errors");
        }
        
    }
    $_SESSION['user'] = $username;
    $_SESSION['error'] = "";
}

/*-----------------------------------------------------------------------------------*/