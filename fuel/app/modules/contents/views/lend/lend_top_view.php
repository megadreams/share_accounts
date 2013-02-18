

<div class="container-fluid main-contents">
    <header class="header">
        <div>
            <a href="<?php echo \Config::get('BASE_URL');?>contents/top">戻る</a>
            <a href="<?php echo \Config::get('BASE_URL');?>contents/lend/edit_data">新しく登録する</a>
        </div>
        <h1 id="contents_title">貸しているリスト</h1>        
        <p>
            <?php echo $view_data['user_profile']->user_name; ?>さんが貸しているリスト
        </p>
     </header>
     <section class="row-fluid">
        <?php foreach($view_data['lend_and_borrow_mst'] as $lend_and_borrow_mst): ?>
            <a href="<?php echo \Config::get('BASE_URL');?>contents/lend/edit_data/<?php echo $lend_and_borrow_mst->id;?>">
                <div class="list">
                    <div class="row">
                        <div class="span6">
                            <?php echo $view_data['user_list'][$lend_and_borrow_mst->borrow_user_id]->user_name;?>さんへ
                        </div>
                        <div class="span6">
                            <?php echo $lend_and_borrow_mst->date;?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span6">
                            <?php echo $lend_and_borrow_mst->money;?>円
                        </div>
                        <div class="span6">
                            <div><?php echo \Config::get('status')['lend'][$lend_and_borrow_mst->status];?></div>
                            <div>期限：<?php echo $lend_and_borrow_mst->limit;?></div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </section>
</section>
