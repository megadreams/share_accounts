    <section>
    <form>
    <table class="edit_area">
        <tbody>
            <tr>
                <th>日付</th>
                <td>
                    <input type="text" class="regist lib_date" name="date" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? date('Ymd', strtotime($view_data['lend_and_borrow_mst']['date'])):'';?>">
                </td>
            </tr>
            <tr>
                <td>
                    <div>
                        <div class="user_select">
                            <?php /* ?>
                                <select class="regist select" name="<?php echo ($view_data['type'] === \Config::get('TYPE_LEND'))? 'borrow_user_id': 'lend_user_id'?>">
                                <?php foreach ($view_data['user_friends'] as $user_friends) :?>
                                    <option value=<?php echo $user_friends['user_id'];?>><?php echo $user_friends['user_name'];?></option>
                                <?php endforeach;?>
                                </select>
                            <?php else:?>
                                現在友達は登録されていません
                            <?php endif;?>
                            <?php
                             */
                            ?>
                        </div>
                        <div>
                            <a data-toggle="modal" href="#myModal" class="btn btn-primary">友達を探す</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
            <tr>
                <th>カテゴリ</th>
                <td>
                    <select class="regist select" name="category">
                        <option value="money">お金</option>
                    </select>
                </td>
            </tr>
            <tr>
                <!-- カテゴリーによってここを変えたい -->
                <th>金額</th>
                <td>
                    <input type="text" class="regist" name="item" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? $view_data['lend_and_borrow_mst']['item']:'';?>">
                </td>
            </tr>
            <tr>
                <th>ステータス</th>
                <td>
                    <?php /*
                    <select class="regist select" name="status">
                        <?php $status_list = \Config::get('status'); ?>
                        <?php foreach($status_list[$view_data['type']] as $id =>$status):?>
                            <?php if (isset($view_data['lend_and_borrow_mst']) && $view_data['lend_and_borrow_mst']['status'] == $id): ?>
                                <option value="<?php echo $id;?>" selected><?php echo $status;?></option>
                            <?php else:?>
                                <option value="<?php echo $id;?>"><?php echo $status;?></option>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </select>
                     * 
                     */?>
                </td>
            </tr>
            <tr>
                <th>メモ</th>
                <td>
                    <input type="text" class="regist" name="memo" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? $view_data['lend_and_borrow_mst']['memo']:'';?>">
                </td>
            </tr>  
            <tr>
                <th>返却期限</th>
                <td>
                    <input class="lib_date" type="text" class="regist" name="limit" value="<?php echo (isset($view_data['lend_and_borrow_mst']))? $view_data['lend_and_borrow_mst']['limit']:'';?>">
                </td>
            </tr>            
            </tbody>
        </table>
        <?php /*
        <input class="regist" type="hidden" name="<?php echo ($view_data['type'] === \Config::get('TYPE_LEND'))? 'lend_user_id': 'borrow_user_id'?>" value=<?php echo $view_data['user_profile']['user_id']; ?>>
        <input class="add_btn" type="button" value="登録">
        <?php if (isset($view_data['lend_and_borrow_mst']) === true): ?>
            <input class="regist" type="hidden" name="collection_id" value="<?php echo $view_data['lend_and_borrow_mst']['collection_id'];?>">
            <input class="delete_btn btn-danger" type="button" value="削除">
        <?php endif; ?>
*/?>
    </form>

        
<!-- モーダルビュー -->
 <!-- sample modal content -->
<div id="myModal" class="modal hide fade">
  <div class="modal-header">
    <a class="close" data-dismiss="modal" >&times;</a>
    <h3>他のアプリから友だちを探す</h3>
  </div>
  <div class="modal-body">
    <h4>Facebook</h4>
    <p>Facebookから友達リストを取得します</p>

    <h4>Twitter</h4>
    <p>Twitterから友達リストを取得します</p>

    <h4>LINE</h4>
    <p>LINEから友達リストを取得します</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" >閉じる</a>
  </div>
</div>

<!-- 検索中のマーク -->
<div id="popup_white">
    <div id="loading_gif">
	<?php echo \Fuel\Core\Asset::img('load.gif');?>
    </div>
</div>
    
<?php /*    
<script>
$(function () {
    $('.delete_btn').click(function() {
        var collectionId = $("input[name='collection_id']")[0].val;
        var sendData = {'collection_id': collectionId};
        console.log(sendData);
        if (!confirm('削除しますか？')) return false;        
        var sendUrl     = "<?php echo \Uri::base() . 'share/rest/lendandborrow/delete/'?>";
        var callBackUrl = "<?php echo \Uri::base() . 'share/lendandborrow/top/' . $view_data['type']?>";
        var result = regist(sendUrl, 'post', sendData, '削除しました', callBackUrl);
         
    });
    
    $('.add_btn').click(function() {

        //classからsendDataを取得する
        var sendData = getSendData();
        console.log(sendData);
        if (!confirm('登録しますか？')) return false;
        
        var sendUrl     = "<?php echo \Uri::base() . 'share/rest/lendandborrow/regist/'?>";
        var callBackUrl = "<?php echo \Uri::base() . 'share/lendandborrow/top/' . $view_data['type']?>";
        var result = regist(sendUrl, 'post', sendData, '登録しました', callBackUrl);
        
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
        width: 100,
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

*/?>

