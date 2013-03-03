<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <title><?php // echo $title; ?></title>
    <?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('base.css'); ?>
    <?php //echo Asset::css('content.css'); ?>        
    <?php echo Asset::js('jquery.js'); ?>
</head>
<body>
    <?php echo $content; ?>
    <footer>
        <small>Copyright 2012- <?php echo date('Y');?> megadreams　All Rights Reserved.</small>
    </footer>
</body>
</html>
