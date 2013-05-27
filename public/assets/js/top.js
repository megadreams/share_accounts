//読み込み後実行ファイル
$(function(){
    //左メニュークリック
    $('#leftmenu-btn').click(function() {
        leftmenu_toggle();
    });
    
    //右メニュークリック
    $('#rightmenu-btn').click(function() {
        rightmenu_toggle();
    });

    //キャンセルボタンが押された
    $('#cancel-btn').click(function() {
        cancel();
    });
    
    //ステータス変更ボタンが押された
    $('#change-status').click(function() {
        $('#func-btn button').val('chage-status');        
        $('#func-btn button').text('変更');        
        rightMenuEditBtn();
    });
    
    //ステータス変更ボタンが押された
    $('#data-delete').click(function() {
        $('#func-btn button').val('delete');        
        $('#func-btn button').text('削除');        
        rightMenuEditBtn();
    });
    
    //処理ボタンが押された
    $('#func-btn button').click(function() {
        var funcType = this.value;
        var msg;
        var tayp;
        
        //ステータスを「返済済み」に変更する
        if (funcType === 'chage-status') {
            msg = '変更';
            tayp = 'status';
        } else if (funcType === 'delete') {
            msg = '削除';
            tayp = 'delete';
        } else {
            return ;
        }
        
        //classからsendDataを取得する
        var checkbox=[];
        $('[name="lendcheck"]:checked').each(function(){
          checkbox.push($(this).val());
        }); 
        var sendData = {'checkbox': checkbox, 'type':tayp, 'status': 1};
        console.log(sendData);
        
        var sendUrl = BASE_URL + 'share/rest/lendandborrow/top/';
        var callbackUrl = BASE_URL + 'share/top';
        if (!confirm(msg + 'しますか？')) return false;
        
        var result  = regist(sendUrl, 'post', sendData, msg + 'しました', callbackUrl);
        
    });
});



//右メニューの編集欄が押された時の処理
function rightMenuEditBtn() {
    //チェックボックスを表示
    var flg = changeCheckBoxView('block');

    if (flg === false) {
        return ;
    }
    
    //メニューを戻す
    rightmenu_toggle();

    //右メニューがキャンセルボタンに変わる
    $('#leftmenu-btn').addClass('disp-none');
    $('#func-btn').removeClass('disp-none');

    //左メニューが削除
    $('#rightmenu-btn').addClass('disp-none');
    $('#cancel-btn').removeClass('disp-none');

    
}


//キャンセルボタンが押された時
function cancel() {
            
    //右メニューがキャンセルボタンに変わる
    $('#leftmenu-btn').removeClass('disp-none');
    $('#func-btn').addClass('disp-none');

    //左メニューが削除
    $('#rightmenu-btn').removeClass('disp-none');
    $('#cancel-btn').addClass('disp-none');

    //全てのチェックボックスを外す
    
    changeCheckBoxView('none');
    
}

//チェックボックスの表示切り替え
function changeCheckBoxView(type) {
    var count = 0;
    $.each($('.checkbox'), function() {
        this.style.display = type;
        count++;
    });    
    if (count > 0) {
        return true;    
    } else {
        return false;
    }
}
