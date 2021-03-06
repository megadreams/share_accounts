<div class="container-fluid main-contents">
    <header class="header">
        <h1 id="contents_title">
            <?php echo $view_data['user_profile']['user_name']; ?>さんが，<?php echo ($view_data['type'] === \Config::get('TYPE_LEND'))?'貸しているリスト' : '借りているリスト';?>
        </h1>        
    </header>
    <div>
        <a href="<?php echo \Uri::base() . 'share/top/';?>">TOPへ</a>　　
        <a href="<?php echo \Uri::base() . 'share/lendandborrow/edit_data/' . $view_data['type'];?>">新しく登録する</a>
    </div>
    
    <div class="tabbable">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#1" data-toggle="tab">人</a>
            </li>
            <li>
                <a href="#2" data-toggle="tab">カテゴリ</a>
            </li>
        </ul>
    </div>
    
    <!-- 人別表示 -->
    <div class="tab-content">
        <section class="tab-pane active" id="1">
            <?php if (count($view_data['user_lend_and_borrows']) > 0):?>
                <?php foreach ($view_data['user_lend_and_borrows'] as $user_lend_and_borrows) :?>
                    <div>
                        <?php echo $user_lend_and_borrows;?>
                    </div>
                    <?php var_dump($user_lend_and_borrows); ?>
                <?php endforeach;?>
            <?php else:?>
                <p>データはありません</p>
            <?php endif;?>
        </section>
        <div class="tab-pane" id="2">
            <p>Howdy, I'm in Section 2.</p>
            </div>
        </div>
    </div>
    <?php exit(); if (count($view_data['lend_and_borrow_list']) > 0): ?>
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
