        <header class="header">
            <div class="row-fluid">
                <div class="span4">
                    <a href="<?php echo \Uri::base() .'/share/top'; ?>">キャンセル</a>
                </div>
                <div class="span4">
                    <h1 id="contents_title">新規登録</h1>        
                </div>
                <div class="span4">
                    <button class="add_btn" type="button">登録</button>
                </div>
            </div>
        </header>

        <form>
            <div class="edit-area">
                <div class="row-fluid edit-type">
                    <div id="type-lend" class="span6 btn">
                        貸す
                    </div>
                    <div id="type-borrow" class="span6 btn">
                        借りる
                    </div>
                    <input type="hidden" class="regist" name="type" value="lend">
                    <input type="hidden" class="regist" name="status" value="0">
                </div>

                <div class="row-fluid edit-content">
                    <div class="span2">
                        いつ
                    </div>
                    <div class="span10">
                        <input type="text" class="regist lib_date" name="date" value="">                
                    </div>
                </div>
                
                <div class="row-fluid edit-content">
                    <div class="span2 ">
                        誰に
                        <input type="hidden" class="regist" name="my_user_id" value="<?php echo $view_data['user_profile']['user_id'];?>;?>">
                    </div>
                    <div class="span10">
                        <div>
                            <?php if (count($view_data['user_friends']) > 0) :?>
                                <select class="regist select" name="to_user_id">
                                <?php foreach ($view_data['user_friends'] as $user_friends) :?>
                                    <option value=<?php echo $user_friends['user_id'];?>><?php echo $user_friends['user_name'];?></option>
                                <?php endforeach;?>
                                </select>
                            <?php else:?>
                                現在友達は登録されていません
                            <?php endif;?>                            
                        </div>
                        <div class="text-right">
                            <a data-toggle="modal" href="#myModal" class="btn btn-primary">友達を探す</a>
                        </div>
                    </div>
                </div>
                
                
                <div class="row-fluid edit-content">
                    <div class="span2">
                        分類
                    </div>
                    <div class="span10">
                        <select class="regist select" name="category">
                            <option value="money">お金</option>
                        </select>                            
                    </div>
                </div>
                
                
                <div class="row-fluid edit-content">
                    <div class="span2">
                        金額
                    </div>
                    <div class="span10">
                        <input type="text" class="regist text-right" name="item" value="0">
                    </div>
                </div>
                
                <div class="row-fluid edit-content">
                    <div class="span2">
                        期限
                    </div>
                    <div class="span10">
                        <input class="regist lib_date" type="text" class="regist" name="limit" value="">
                    </div>                
                </div>
                
                <div class="row-fluid edit-content">
                    <div class="span2">
                        通知
                    </div>
                    <div class="span10">
                        <div>
                            リストから選ぶ
                        </div>
                        <div>
                            <a data-toggle="modal" href="#myModal" class="btn btn-primary">友達を探す</a>
                        </div>
                    </div>
                </div>
                
                <div class="row-fluid edit-content">
                    <div class="span2">
                        メモ
                    </div>
                    <div class="span10">
                        <textarea class="regist" name="memo" rows="4" cols="40"></textarea>  
                    </div>
                </div>
            </div>
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
    

<script>
$(function () {

    
    $('.add_btn').click(function() {

        //classからsendDataを取得する
        var sendData = getSendData();
        console.log(sendData);
        if (!confirm('登録しますか？')) return false;
        var sendUrl     = "<?php echo \Uri::base() . 'share/rest/lendandborrow/regist/'?>";
        var callBackUrl = "<?php echo \Uri::base() . 'share/top/'; ?>";
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


