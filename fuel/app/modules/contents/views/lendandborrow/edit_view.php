<div class="container-fluid main-contents">
    <div>
        <a href="<?php echo \Uri::base() . 'contents/lendandborrow/top/' . $view_data['type'];?>">戻る</a>
    </div>
    <header class="header">
        <h1 id="contents_title">
            <?php echo $view_data['user_profile']->user_name; ?>さんが，借りているリスト
        </h1>        
    </header>
    <section>
    <form>
    <table class="edit_area">
        <tbody>
            <tr>
                <th>日付</th>
                <td>
                    <input type="text" class="regist" name="date" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? date('Ymd', strtotime($view_data['lend_and_borrow_mst']->date)):'';?>">
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo ($view_data['type'] === \Config::get('TYPE_LEND'))? '貸している人': '借りている人'?>
                </th>
                <td>
                    <div>
                        <div class="user_select">
                        <?php if (count($view_data['user_friend_list']) > 0):?>               
                            <?php $class_name = ($view_data['type'] === \Config::get('TYPE_LEND'))? 'to_user_id': 'from_user_id';?>
                            <select class="regist" name="<?php echo $class_name;?>">
                                <?php foreach($view_data['user_friend_list'] as $friend): ?>
                                    <?php if(isset($view_data['lend_and_borrow_mst']) === true && $view_data['lend_and_borrow_mst'][$class_name] ==  $friend['id']):?>
                                        <option value="<?php echo $friend['id'];?>" selected><?php echo $friend['user_name'];?></option>                            
                                    <?php else:?>
                                        <option value="<?php echo $friend['id'];?>"><?php echo $friend['user_name'];?></option>                            
                                    <?php endif;?>
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                            <p>現在友達はいません</p>
                        <?php endif;?>                  
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    
                </th>
                <td>
                    <div>
                        <div class="row-fluid">
                            <label class="span6">
                                <input class="get_app_friends" name="from_user" type="radio" checked>
                                <span>アプリ内友達</span>
                            </label>
                            <label class="span6">
                                <input class="get_fb_friends" name="from_user" type="radio">
                                <span>FaceBook友達</span>
                            </label>
                        </div>

                        <!--
                        <label>
                            <input class="get_line_friends" name="from_user" type="radio">LINEから友達リストを取得する
                        </label>
                        <label>
                            <input class="get_tw_friends"   name="from_user" type="radio">Twitterから友達リストを取得する
                        </label>
                        -->
                    </div>                    
                </td>
            </tr>
            <tr>
                <!-- カテゴリーによってここを変えたい -->
                <th>金額</th>
                <td>
                    <input type="text" class="regist" name="item" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? $view_data['lend_and_borrow_mst']->item:'';?>">
                </td>
            </tr>
            <tr>
                <th>ステータス</th>
                <td>
                    <select class="regist" name="status">
                        <?php $status_list = \Config::get('status'); ?>
                        <?php foreach($status_list[$view_data['type']] as $id =>$status):?>
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
            </tbody>
        </table>
        <?php if (isset($view_data['lend_and_borrow_mst']) === true): ?>
            <input class="regist" type="hidden" name="lend_and_borrow_mst_id" value="<?php echo $view_data['lend_and_borrow_mst']->id;?>">
        <?php endif; ?>

        <input class="regist" type="hidden" name="<?php echo ($view_data['type'] === \Config::get('TYPE_LEND'))? 'from_user_id': 'to_user_id'?>" value=<?php echo $view_data['user_profile']->id; ?>>
        <input class="regist" type="hidden" name="type" value="<?php echo $view_data['type']; ?>">
        <input class="add_btn" type="button" value="登録">
    </form>
</section>

<!-- 検索中のマーク -->
<div id="popup_white">
    <div id="loading_gif">
	<?php echo \Fuel\Core\Asset::img('load.gif');?>
    </div>
</div>
    
    
<script>
    
function error_fnc(msg) {
    alert('サーバでエラーが起きています');
    console.log(msg);
    ingicater_end();
    return ;
}

function ingicater_start() {
    $('#popup_white').show();
    $('#loading_gif').show();    
}
function ingicater_end() {
    $('#popup_white').hide();
    $('#loading_gif').hide();    
}

$(function () {
    //FBの友達リストを取得する
    $('.get_fb_friends').click(function() {
        if ($("select[name='facebook_friend_id'] option:selected").text() !== "") {
            console.log('既にデータ取得済み');
            return ;
        }
        ingicater_start();
        $.ajax({
            dataType: 'json',
            url: "<?php echo \Uri::base() . 'contents/rest/lendandborrow/facebook_friends.json';?>",
            success: function(data) {
                console.log(data['data']);
                var selectElem = document.createElement('select');
                selectElem.name      = 'facebook_friend_id';
                selectElem.className = 'regist';
                
                $.each(data['data'], function(i){
                    var optionElem = document.createElement('option');
                    optionElem.value = data['data'][i]['id'];
                    optionElem.text = data['data'][i]['name'];
                    selectElem.appendChild(optionElem); 
                });
                console.log(selectElem);
                $('.user_select').empty();
                $('.user_select').append(selectElem);
               ingicater_end();
            },
            error: error_fnc
        });        
    });
    
    //通常の友達リストを取得する
    $('.get_app_friends').click(function() {        
        if ($("select[name='get_app_friends'] option:selected").text() !== "") {
            console.log('既にデータ取得済み');
            return ;
        }
        ingicater_start();
        $.ajax({
            dataType: 'json',
            url: "<?php echo \Uri::base() . 'contents/rest/lendandborrow/app_friends/' . $view_data['user_profile']->id . '/get.json';?>",
            success: function(data) {
                console.log(data['data']);
                var selectElem = document.createElement('select');
                selectElem.name      = '<?php echo ($view_data['type'] === \Config::get('TYPE_LEND'))? 'to_user_id': 'from_user_id'?>';
                selectElem.className = 'regist';
                
                $.each(data['data'], function(i){
                    var optionElem = document.createElement('option');
                    optionElem.value = data['data'][i]['id'];
                    optionElem.text = data['data'][i]['user_name'];
                    selectElem.appendChild(optionElem); 
                });
                console.log(selectElem);
                $('.user_select').empty();
                $('.user_select').append(selectElem);
               ingicater_end();                
            },
            error: error_fnc
        });        
    });




    
     //カテゴリIDを取得し、そのカテゴリに対するアイテムを取得する
    $('.add_btn').click(function() {
        
        var postData = {};
        $.each($('.regist'), function () {
            postData[this.name] = this.value;
        });
        if (postData['facebook_friend_id']) {
            postData['facebook_friend_name'] = $("select[name='facebook_friend_id'] option:selected").text();
        }
        console.log(postData);
        if (!confirm('登録しますか？')) return false;
        
        $.ajax({
            dataType: 'json',
            url: "<?php echo \Uri::base() . 'contents/rest/lendandborrow/regist.json';?>",
            type: "post",
            data: postData,
            success: function(data) {
                console.log(data['data']);
                if (data['error'] === false) {
                    alert('登録しました');
                    location.href = "<?php echo \Uri::base() . 'contents/lendandborrow/top/' . $view_data['type']; ?>";
                } else {
                    alert('登録できませんでした');
                }
            },
            error: error_fnc

        });       
    });    
});

</script>
