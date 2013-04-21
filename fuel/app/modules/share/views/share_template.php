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
        <script type="text/javascript">// <![CDATA[
            var leftmenuOpenFlg = false;
            var rightmenuOpenFlg = false;
            $(function(){
                $('#leftmenu-btn').click(function() {
                    if (leftmenuOpenFlg === true) {
                        $(".main-contents").animate({"left": "0%"},  { duration: 'fast', easing: 'swing'});
                        leftmenuOpenFlg = false;
                        
                    } else {
                        $('#rightmenu').css('z-index', 1);                        
                        $('#leftmenu').css('z-index', 10);
                        $(".main-contents").animate({"left": "80%"},  { duration: 'fast', easing: 'swing'});
                        leftmenuOpenFlg = true;
                    }
                });
                $('#rightmenu-btn').click(function() {
                    if (rightmenuOpenFlg === true) {
                        $(".main-contents").animate({"left": "0%"},  { duration: 'fast', easing: 'swing'});
                        rightmenuOpenFlg = false;
                        
                    } else {
                        $('#leftmenu').css('z-index', 1);
                        $('#rightmenu').css('z-index',10);                        
                        $(".main-contents").animate({"left": "-80%"},  { duration: 'fast', easing: 'swing'});
                        rightmenuOpenFlg = true;
                    }
                });                
            });
        // ]]>
        </script>
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
</html>
