
    <div>
        <?php echo $view_data['user_profile']['user_name'];?>さんこんにちは　　
        <a href="<?php echo \Uri::base() . 'share/auth/logout/';?>">ログアウト</a>
    </div>
    <header class="header">
        <h1 id="contents_title">貸し借り管理</h1>        
     </header>
            
    <!-- メニューエリア-->
    <a class="category" href="<?php echo  \Uri::base() . "share/lendandborrow/top/lend";?>">
        <span class="category_name">貸している</span>
    </a>
    <a class="category" href="<?php echo  \Uri::base() . "share/lendandborrow/top/borrow";?>">
        <span class="category_name">借りている</span>
    </a>
    