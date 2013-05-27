
        <header class="header">
            <div class="row-fluid">
                <div class="span4">
                    <a href="<?php echo \Uri::base() .'/share/top'; ?>">キャンセル</a>
                </div>
                <div class="span4">
                    <h1 id="contents_title">編集</h1>
                </div>
            </div>
        </header>

        <div class="edit-area">
            <form>
                <div>
                    <?php echo $view_data['lend_and_borrow_data']['date'];?>
                </div>
                
                <div>
                    <?php //自分がlend(貸している)の場合，相手はborrow ?>
                    <?php echo $view_data['your_user_profile']['user_name']; ?>さんへ
                </div>

                <div class="row-fluid edit-content">
                    <div class="span2">
                        分類
                    </div>
                    <div class="span2">
                        <?php echo $view_data['lend_and_borrow_data']['category'];?>                
                    </div>
                    <div class="span8">
                        <?php echo $view_data['lend_and_borrow_data']['item'];?>                
                    </div>
                </div>
                
                <div class="row-fluid edit-content">
                    <div class="span2">
                        ステータス
                    </div>
                    
                    <div class="span10">
                        <select name="status" class="regist select">
                            <?php foreach ($view_data['status'][$view_data['type']] as $key => $status):?>
                                <?php if ((int)$view_data['lend_and_borrow_data']['status'] === $key):;?> 
                                    <option value="<?php echo $key; ?>" selected><?php echo $status;?></option>
                                <?php else:?>
                                    <option value="<?php echo $key; ?>"><?php echo $status;?></option>
                                <?php endif; ?>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="row-fluid edit-content">
                    <div class="span2">
                        期限
                    </div>
                    <div class="span10">
                        <?php echo $view_data['lend_and_borrow_data']['limit'];?>                
                        <input class="regist lib_date" type="text" class="regist" name="limit" value="">
                    </div>                
                </div>
                <div class="row-fluid edit-content">
                    <div class="span2">
                        通知
                    </div>
                    <div class="span10">
                        <div>
                            現在実装中です
                        </div>
                        <!--
                        <div>
                            リストから選ぶ
                        </div>
                        <div>
                            <a data-toggle="modal" href="#myModal" class="btn btn-primary">友達を探す</a>
                        </div>
                        -->
                    </div>
                </div>

                <div class="row-fluid edit-content">
                    <div class="span2">
                        メモ
                    </div>
                    <div class="span10">
                        <textarea class="regist" name="memo" rows="4" cols="40"><?php echo $view_data['lend_and_borrow_data']['memo'];?></textarea>  
                    </div>
                </div>
            </form>
                
                <div class="row-fluid">
                    <div class="span5">
                        <button class="update btn btn-primary">更新</button>
                        <input type="hidden" class="regist" name="type" value="<?php echo $view_data['type'];?>">
                        <input type="hidden" class="regist" name="collection_id" value="<?php echo $view_data['lend_and_borrow_data']['collection_id'];?>">
                    </div>
                    <div class="span5">
                        <button class="delete btn btn-danger" value="<?php echo $view_data['lend_and_borrow_data']['collection_id'];?>">削除</button>
                    </div>
                </div>
            </div>

<script>
$(function () {

    
    $('.update').click(function() {

        //classからsendDataを取得する
        var sendData = getSendData('.regist');
        
        console.log(sendData);
        
        if (!confirm('更新しますか？')) return false;
        var sendUrl     = "<?php echo \Uri::base() . 'share/rest/lendandborrow/regist/'?>";
        var callBackUrl = "<?php echo \Uri::base() . 'share/top/'; ?>";
        var result = regist(sendUrl, 'post', sendData, '登録しました', callBackUrl, null);
        
        if (result === true || result === false){
            //何もしない？
        } else {
            console.log(result);
        }
     });
     
    
    $('.delete').click(function() {

        //classからsendDataを取得する
        var sendData = {'collection_id' : this.value};
        console.log(sendData);

        if (!confirm('削除しますか？')) return false;
        var sendUrl     = "<?php echo \Uri::base() . 'share/rest/lendandborrow/delete/'?>";
        var callBackUrl = "<?php echo \Uri::base() . 'share/top/'; ?>";
        
        var result = regist(sendUrl, 'post', sendData, '削除しました', callBackUrl);

        if (result === true || result === false){
            //何もしない？
        } else {
            console.log(result);
        }
     });
     


    $('.lib_date').scroller({
        preset: 'date',
        theme: 'ios',
        display: 'modal',
        mode: 'scroller',
        setText:'OK',
        cancelText:'キャンセル',
        dateFormat:'yyyy/mm/dd',
        dateOrder:'yyyymmdd',
        endYear:2020,
        startYear:2000,
        monthText : '月',
        monthNames :[1,2,3,4,5,6,7,8,9,10,11,12],
        monthNamesShort :[1,2,3,4,5,6,7,8,9,10,11,12],
        yearText : '年',
        width: 85,
        dayText : '日'
    });    
    
    $('.select').mobiscroll().select({
        theme: 'ios',
        display: 'bubble',
        mode: 'mixed',
        inputClass: 'i-txt',
        width: 200
    });    
});

</script>


                                
                
