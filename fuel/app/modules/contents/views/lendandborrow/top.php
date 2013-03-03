<div class="container-fluid main-contents">
    <div>
        <a href="<?php echo \Uri::base() . 'contents/top/';?>">TOPへ</a>　　
        <a href="<?php echo \Uri::base() . 'contents/lendandborrow/edit_data/' . $view_data['type'];?>">新しく登録する</a>
    </div>
    <header class="header">
        <h1 id="contents_title">
            <?php echo $view_data['user_profile']->user_name; ?>さんが，<?php echo ($view_data['type'] === \Config::get('TYPE_LEND'))?'貸しているリスト' : '借りているリスト';?>        
        </h1>        
     </header>

    <?php if (count($view_data['lend_and_borrow_list']) > 0): ?>
    <?php $status_list = \Config::get('status');?>    
     <section class="row-fluid">
        <?php foreach($view_data['lend_and_borrow_list'] as $lend_and_borrow_list): ?>
            <a class="list" href="<?php echo \Uri::base() . 'contents/lendandborrow/edit_data/' . $view_data['type'] . '/' . $lend_and_borrow_list->id;?>">
                    <div class="row">
                        <div class="span6">
                            <?php if ($view_data['type'] === \Config::get('TYPE_LEND')):?>
                                <?php echo $view_data['user_list'][$lend_and_borrow_list->to_user_id]['user_name'];?>さんへ
                            <?php else: ?>
                                <?php echo $view_data['user_list'][$lend_and_borrow_list->from_user_id]['user_name'];?>さんへ
                            <?php endif;?>                            
                        </div>
                        <div class="span6">
                            <?php echo date('Y年m月d', strtotime($lend_and_borrow_list->date));?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span6">
                            <?php echo number_format($lend_and_borrow_list->item);?>円
                        </div>
                        <div class="span6">
                            <div><?php echo $status_list[$view_data['type']][$lend_and_borrow_list->status];?></div>
                            <?php if ((int)$lend_and_borrow_list->limit !== 0): ?>
                                <div>期限：<?php echo $lend_and_borrow_list->limit;?></div>
                            <?php endif;?>
                        </div>
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
