<div>
    <a href="<?php echo BASE_URL . '/contents/borrow/';?>">戻る</a>
</div>


<div>
    <?php echo $view_data['user_profile']->user_name; ?>さんが，借りているリスト
</div>

<div>
    <h1>新規登録</h1>
    <h1>編集</h1>
</div>

<form>
<table>
    <tbody>
        <tr>
            <th>日付</th>
            <td>
                <input type="text" class="regist" name="date" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? $view_data['lend_and_borrow_mst']->date:'';?>">
            </td>
        </tr>
        <tr>
            <th>借りている人</th>
            <td>
                <select class="regist" name="lend_user_id">
                    <?php foreach($view_data['user_list'] as $user_list): ?>
                        <?php if (isset($view_data['lend_and_borrow_mst']) && $view_data['lend_and_borrow_mst']->lend_user_id == $user_list->id):?>
                            <option value="<?php echo $user_list->id;?>" selected><?php echo $user_list->user_name;?></option>
                        <?php else: ?>
                            <option value="<?php echo $user_list->id;?>"><?php echo $user_list->user_name;?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <select>
                    <?php foreach($view_data['user_friend_list']->data as $user_friend_list): ?>
                        <option value="<?php echo $user_friend_list->id;?>"><?php echo $user_friend_list->name;?></option>
                    <?php endforeach; ?>                
                </select>
            </td>
        </tr>
        <tr>
            <th>金額</th>
            <td>
                <input type="text" class="regist" name="money" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? $view_data['lend_and_borrow_mst']->money:'';?>">
            </td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>
                <select class="regist" name="status">
                    <?php foreach(\Config::get('status')['borrow'] as $id =>$status):?>
                        <?php if (isset($view_data['lend_and_borrow_mst']) && $view_data['lend_and_borrow_mst']->status == $id): ?>
                            <option value="<?php echo $id;?>" selected><?php echo $status;?></option>
                        <?php else:?>
                            <option value="<?php echo $id;?>"><?php echo $status;?></option>
                        <?php endif;?>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>メモ</th>
            <td>
                <input type="text" class="regist" name="memo" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? $view_data['lend_and_borrow_mst']->memo:'';?>">
            </td>
        </tr>  
        <tr>
            <th>返却期限</th>
            <td>
                <input type="text" class="regist" name="limit" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? $view_data['lend_and_borrow_mst']->limit:'';?>">
            </td>
        </tr>            
        <tr>
            <td>
                <?php if (isset($view_data['lend_and_borrow_mst']) === true): ?>
                    <input class="regist" type="hidden" name="lend_and_borrow_mst_id" value="<?php echo $view_data['lend_and_borrow_mst']->id;?>">
                <?php endif; ?>
                <input class="regist" type="hidden" name="type" value="<?php echo $view_data['type']; ?>">
                <input class="regist" type="hidden" name="borrow_user_id" value="<?php echo $view_data['user_profiel']->id;?>">
                <input class="add_btn" type="button" value="登録">
            </td>
        </tr>
    </tbody>
</table>
</form>

<script>
function error_fnc(msg) {
    alert('サーバでエラーが起きています');
    console.log(msg);
    return ;
}
$(function (){
     //カテゴリIDを取得し、そのカテゴリに対するアイテムを取得する
    $('.add_btn').click(function() {
        
        var postData = {};
        $.each($('.regist'), function () {
            postData[this.name] = this.value;
        });
        console.log(postData);
        
        if (!confirm('登録しますか？')) return false;
        
        $.ajax({
            dataType: 'json',
            url: "<?php echo BASE_URL;?>contents/ajaxapi/lend_and_borrow_regist.json",
            type: "post",
            data: postData,
            success: function(data) {
                console.log(data['data']);
                if (data['error'] === false) {
                    alert('登録しました');
                } else {
                    alert('登録できませんでした');
                }
            },
            error: error_fnc

        });       
    });    
});

</script>
