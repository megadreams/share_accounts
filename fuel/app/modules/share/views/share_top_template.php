<!DOCTYPE html>
<html>
<head>
<?php echo $header?>
<?php echo Asset::css('sp/top.css'); ?>
<?php echo Asset::js('top.js'); ?>
</head>
<body>
    <div class="main-view">
<?php echo $leftmenu; ?>
<?php echo $rightmenu; ?>
        <section class="container-fluid main-contents">
            <header class="header">
                <div class="row-fluid">
                    <div class="span3">
                        <div id="leftmenu-btn">◯</div>
                    </div>
                    <div class="span6">
                        <h1 id="contents_title">貸し借り管理</h1>        
                    </div>
                    <div id="rightmenu-btn" class="span3">
                        □
                    </div>
                </div>
            </header>
            <?php echo $content; ?>
            <footer>
                <small>Copyright 2012- <?php echo date('Y');?> megadreams　All Rights Reserved.</small>
            </footer>
        </section>        
    </div>
</body>
</html>
