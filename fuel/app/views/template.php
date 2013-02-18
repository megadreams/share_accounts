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
    <style>
        body{
            background-image: url('/assets/img/contents/background2.png');
        }
        #contents_title {
            width:100%;
            height:20px;
            padding:10px 0px;
/*            
            background-image: url('assets/img/contents/contents_title.png');
            background-size:100% 90%;
            background-repeat   : no-repeat;
 */
            background:black;
            box-shadow:2px 2px 2px #000000;
            color:white;
            font-weight: normal;
            font-size:18px;
        }
        
        .category {
            position:relative;
        }
        .category_name {
            position:absolute;
            top: -6px;
            left: 17px;            
        }
        .category_pin {
            position:absolute;
            top: -55px;
            left: 42px;
            width: 20%;            
        }
        .category_fusen {
            width:70%;
        }
        
        .list {
            color:black;
            padding:5px;
            width:300px;
            height:60px;
            background-image: url('assets/img/contents/lendandborrow/fusen01.png');            
        }
        .list [class*="span"] {
            min-height: 0px;
        }
        
        .editdata {
/*
            background-image: url( 'assets/img/contents/fusen/big003.png');        
            background-size:100%;
*/
            padding:10px;
            width:250px;
            height:250px;
            background:rgba(200,200,200,0.7);
            border-radius:10px;
            box-shadow:2px 2px 2px #808080;
        }
        
    </style>
</head>
<body>
    <?php echo $content; ?>
    <footer>
        <div>
            <a href='contents/top'>TOPへ戻る</a>
        </div>
        <p>
            <small>Copyright 2012- <?php echo date('y');?> megadreams</small>
        </p>
    </footer>
</body>
</html>
