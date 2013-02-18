<div class="container-fluid main-contents">
    <header class="header">
        <div>
            <a href="<?php echo BASE_URL . '/contents/lend/';?>">戻る</a>
        </div>
        <h1 id="contents_title">貸しているリスト</h1>        
        <p>
            <?php echo $view_data['user_profile']->user_name; ?>さんが貸しているリスト
        </p>
     </header>

     <section class="row-fluid">
        <form>
        <div class="editdata">
            <div>
                <select class="regist" name="status">
                     <?php foreach(\Config::get('status')['lend'] as $id =>$status):?>
                         <?php if (isset($view_data['lend_and_borrow_mst']) && $view_data['lend_and_borrow_mst']->status == $id): ?>
                             <option value="<?php echo $id;?>" selected><?php echo $status;?></option>
                         <?php else:?>
                             <option value="<?php echo $id;?>"><?php echo $status;?></option>
                         <?php endif;?>
                     <?php endforeach; ?>
                 </select>  
            </div>
            <div class="row">
                <div class="span3">日付</div>
                <div class="span3">
                    <input type="text" class="regist" name="date" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? $view_data['lend_and_borrow_mst']->date:'';?>">                    
                </div>
            </div>        
            <div class="row">
                <div class="span3">貸した人</div>
                <div class="span3">
                    <select class="regist" name="borrow_user_id">
                        <?php foreach($view_data['user_list'] as $user_list): ?>
                            <?php if (isset($view_data['lend_and_borrow_mst']) && $view_data['lend_and_borrow_mst']->borrow_user_id == $user_list->id):?>
                                <option value="<?php echo $user_list->id;?>" selected><?php echo $user_list->user_name;?></option>
                            <?php else: ?>
                                <option value="<?php echo $user_list->id;?>"><?php echo $user_list->user_name;?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>                    
                    </select>
<!--
                    <select>
                        <?php foreach($view_data['user_friend_list']->data as $user_friend_list): ?>
                            <option value="<?php echo $user_friend_list->id;?>"><?php echo $user_friend_list->name;?></option>
                        <?php endforeach; ?>                
                    </select>  
-->
                </div>
            </div>
            <div class="row">
                <div class="span3">金額</div>
                <div class="span3">
                    <input type="text" class="regist" name="money" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? $view_data['lend_and_borrow_mst']->money:'';?>">
                </div>
            </div>   
            <div class="row">
                <div class="span3">メモ</div>
                <div class="span3">
                    <input type="text" class="regist" name="memo" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? $view_data['lend_and_borrow_mst']->memo:'';?>">
                </div>
            </div>            
            <div class="row">
                <div class="span3">期限</div>
                <div class="span3">
                    <input type="text" class="regist" name="limit" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? $view_data['lend_and_borrow_mst']->limit:'';?>">
                </div>
            </div>    
            <div>
                <?php if (isset($view_data['lend_and_borrow_mst']) === true): ?>
                    <input class="regist" type="hidden" name="lend_and_borrow_mst_id" value="<?php echo $view_data['lend_and_borrow_mst']->id;?>">
                <?php endif; ?>
                <input class="regist" type="hidden" name="type" value="<?php echo $view_data['type']; ?>">
                <input class="regist" type="hidden" name="lend_user_id" value="<?php echo $view_data['user_profiel']->id;?>">
                <input class="add_btn" type="button" value="登録">                
            </div>
        </div>
        </form>
        
     </section>
</div>
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
