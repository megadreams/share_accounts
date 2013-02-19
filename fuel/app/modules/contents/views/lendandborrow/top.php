<div>
    <a href="<?php echo \Uri::base() . 'contents/top/';?>">TOPへ</a>　　
    <a href="<?php echo \Uri::base() . 'contents/lendandborrow/edit_data/' . $view_data['type'];?>">新しく登録する</a>
</div>

<div>
    <?php echo $view_data['user_profile']->user_name; ?>さんが，<?php echo ($view_data['type'] === \Config::get('TYPE_LEND'))?'貸しているリスト' : '借りているリスト';?>
</div>

<?php if (count($view_data['lend_and_borrow_list']) > 0): ?>
     <section class="row-fluid">
        <?php foreach($view_data['lend_and_borrow_list'] as $lend_and_borrow_list): ?>
            <a href="<?php echo \Uri::base() . 'contents/lendandborrow/edit_data/' . $view_data['type'] . '/' . $lend_and_borrow_list->id;?>">
                <div class="list">
                    <div class="row">
                        <div class="span6">
                            <?php if ($view_data['type'] === \Config::get('TYPE_LEND')):?>
                                <?php echo $view_data['user_list'][$lend_and_borrow_list->to_user_id]['user_name'];?>さんへ
                            <?php else: ?>
                                <?php echo $view_data['user_list'][$lend_and_borrow_list->from_user_id]['user_name'];?>さんへ
                            <?php endif;?>                            
                        </div>
                        <div class="span6">
                            <?php echo $lend_and_borrow_list->date;?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span6">
                            <?php echo $lend_and_borrow_list->item;?>円
                        </div>
                        <div class="span6">
                            <?php $status_list = \Config::get('status');?>
                            <div><?php echo $status_list[$view_data['type']][$lend_and_borrow_list->status];?></div>
                            <div>期限：<?php echo $lend_and_borrow_list->limit;?></div>
                        </div>
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

