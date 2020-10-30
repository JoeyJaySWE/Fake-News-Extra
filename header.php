<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- sets up social media cards -->
    <meta property="og:site_name" content="Vengeful Scars">
    <meta property="og:title" content="<?php echo $metaTitle;?>" />
    <meta property="og:description" content="<?php echo $metaDesc;?>" />
    <meta property="og:image" content="<?php echo $metaImg;?>"/>
    <meta name="twitter:image" content="<?php echo $metaImg;?>"/>
    <meta name="twitter:card" content="<?php echo $metaCard;?>"/>
    <meta name="twitter:image:alt" content="<?php echo $metImgAlt;?>">
    <!-- Styles -->
    <link rel="stylesheet" href="/Assets/defaults.css">
    <link rel="stylesheet" href="/Assets/articles.css">
    <!-- Favicon -->
    <link rel='icon' type='image/png' href='/Assets/icons/fake_news_icon.svg'>
    <title><?php echo $title;?></title>
</head>
<body>
    <div class="wrapper">
