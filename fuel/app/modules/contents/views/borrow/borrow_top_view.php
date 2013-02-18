<div>
    <a href="<?php echo BASE_URL . '/contents/borrow/edit_data';?>">新しく登録する</a>
</div>

<div>
    <?php echo $view_data['user_profile']->user_name; ?>さんが，借りているリスト
</div>
<table>
    <thead>
        <tr>
            <th>日付</th>
            <th>貸りている人</th>
            <th>金額</th>
            <th>ステータス</th>            
            <th>編集</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($view_data['lend_and_borrow_mst'] as $lend_and_borrow_mst): ?>
            <tr>
                <td><?php echo $lend_and_borrow_mst->date;?></td>
                <td><?php echo $view_data['user_list'][$lend_and_borrow_mst->lend_user_id]->user_name;?></td>
                <td><?php echo $lend_and_borrow_mst->money;?></td>
                <td><?php echo \Config::get('status')['borrow'][$lend_and_borrow_mst->status];?></td>                
                <td><a href="<?php echo BASE_URL . 'contents/borrow/edit_data/' . $lend_and_borrow_mst->id;?>">編集</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    
