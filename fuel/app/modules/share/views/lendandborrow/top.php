<div class="container-fluid main-contents">
    <div>
        <a href="<?php echo \Uri::base() . 'share/top/';?>">TOPへ</a>　　
        <a href="<?php echo \Uri::base() . 'share/lendandborrow/edit_data/' . $view_data['type'];?>">新しく登録する</a>
    </div>
    <header class="header">
        <h1 id="contents_title">
            <?php echo $view_data['user_profile']['user_name']; ?>さんが，<?php echo ($view_data['type'] === \Config::get('TYPE_LEND'))?'貸しているリスト' : '借りているリスト';?>
        </h1>        
    </header>
    <?php if (count($view_data['lend_and_borrow_list']) > 0): ?>
        <section class="row-fluid">
            <?php foreach($view_data['lend_and_borrow_list'] as $lend_and_borrow_list): ?>
                <a href="<?php echo \Uri::base() . 'share/lendandborrow/edit_data/'. $view_data['type'] . '/' . $lend_and_borrow_list['collection_id'];?>">
                    <div>
                        <?php var_dump($lend_and_borrow_list); ?>
                    </div>
                </a>
            <?php endforeach; ?>
        </section>
    <?php else: ?>
        <?php if ($view_data['type'] === \Config::get('TYPE_LEND')):?>
            <div>貸しているリストはありません</div>
        <?php else: ?>
            <div>借りているリストはありません</div>
        <?php endif;?>
    <?php endif;?>
</div>
