<!DOCTYPE html>
<html lang="ja">
<head>
    <script>
        const BASE_URL = "<?php echo \Uri::base();?>";
    </script>
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
                        <div id="func-btn" class="disp-none">
                            <button value="">返却</button>
                        </div>
                    </div>
                    <div class="span6">
                        <h1 id="contents_title">貸し借り管理</h1>        
                    </div>
                    <div class="span3">
                        <div id="rightmenu-btn">□</div>
                        <div id="cancel-btn" class="disp-none">
                            <button>キャンセル</button>
                        </div>
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
