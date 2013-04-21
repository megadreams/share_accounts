<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
        <title><?php // echo $title; ?></title>
        <?php echo Asset::css('bootstrap.css'); ?>
        <?php echo Asset::css('sp/base.css'); ?>
        <?php echo Asset::css('mobiscroll.custom-2.5.0.min.css'); ?>        
        <?php echo Asset::js('jquery.js'); ?>
        <?php echo Asset::js('bootstrap.js'); ?>
        <?php echo Asset::js('mobiscroll.custom-2.5.0.min.js'); ?>
        <?php echo Asset::js('common.js'); ?>
    </head>
    <body>
        
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
    </body>
    <script type="text/javascript">// <![CDATA[

    // ]]>
    </script>
    
</html>
