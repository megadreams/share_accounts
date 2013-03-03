

<div class="container-fluid main-contents">
    <div>
        <?php echo $view_data['user_profile']->user_name;?>さんこんにちは　　
        <a href="<?php echo BASE_URL . 'contents/auth/logout/';?>">ログアウト</a>
    </div>
    <header class="header">
        <h1 id="contents_title">貸し借り管理</h1>        
     </header>
            
    <!-- メニューエリア-->
    <section class="row-fluid">
        <div class="row">
            <div class="span6">
                <a class="category" href="<?php echo BASE_URL . "contents/lendandborrow/top/lend";?>">
                    <?php echo \Asset::img('contents/pin/003.png', array('class' => 'category_pin'));?>
                    <span class="category_name">貸している</span>
                </a>
            </div>
            <div class="span6">
                <a class="category" href="<?php echo BASE_URL . "contents/lendandborrow/top/borrow";?>">
                    <?php echo \Asset::img('contents/pin/003.png',array('class' => 'category_pin'));?>
                    <span class="category_name">借りている</span>
                </a>
            </div>
        </div>
    </section>
</div>
<script>
$('.lend').click(function(){
    location.href = '<?php echo BASE_URL;?>/lend';
});
</script>
    
    