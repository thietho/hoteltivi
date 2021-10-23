<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo IMAGES?>favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
    <?php echo $this->title?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="<?php echo $this->title?>">
    <meta name="keywords" content="<?php echo $this->keywords?>">
    <meta name="description" content="<?php echo $this->description?>">
    <meta name="author" content="<?php echo $this->author?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $this->url?>">
    <meta property="og:title" content="<?php echo $this->title?>">
    <meta property="og:description" content="<?php echo $this->description?>">
    <meta property="og:image" content="<?php echo $this->image?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo $this->url?>">
    <meta property="twitter:title" content="<?php echo $this->title?>">
    <meta property="twitter:description" content="<?php echo $this->description?>">
    <meta property="twitter:image" content="<?php echo $this->image?>">

    <link href="<?php echo CSS?>bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo CSS?>main.css" rel="stylesheet">
    <link href="<?php echo CSS?>hlstyle.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTPSERVER?>slick/slick.css"/>
</head>
<style>
    body {
        zoom: 50%;
    }
</style>
<body id="top">
<?php echo $this->body?>
<script src="<?php echo JS?>jquery.slim.min.js"></script>
<script src="<?php echo JS?>bootstrap.bundle.min.js"></script>
<script src="<?php echo JS?>main.js"></script>
<script src="<?php echo JS?>common.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>