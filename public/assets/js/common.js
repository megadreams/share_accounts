/**
 * インジケーターを回す
 */
function ingicater_start() {
    $('#popup_white').show();
    $('#loading_gif').show();    
}

/**
 * インジケーターを止める
 */
function ingicater_end() {
    $('#popup_white').hide();
    $('#loading_gif').hide();    
}
/**
 * Ajaxで送信する内容をDOMからキーバリュの形で取得する
 */
function getSendData() {
    var sendData = {};
    $.each($('.regist'), function () {
        sendData[this.name] = this.value;
    });
    return sendData;
}

/**
 * Ajax処理
 */
function regist(sendUrl, sendType, sendData, successMsg, callBackUrl) {
    ingicater_start();
    $.ajax({
        dataType: 'json',
        url: sendUrl,
        type: sendType,
        data: sendData,
        success: function(data) {
            console.log(data);
            var returnData = false;
            
            if (data['error'] === false) {
                alert(successMsg);
                if (callBackUrl !== null) {
                    location.href = callBackUrl;                
                }
                returnData = true;
            } else {
                //エラー処理をいくつか
                if (data['error_code'] === 1) {
                    alert('必要な項目が入力されていません。');
                    returnData = data['data'];
                    
                } else {
                    alert('処理が成功しませんでした');
                }
                ingicater_end();
                return returnData;
            }
        },
        error: function(msg) {
            return error_ajax(msg);
        }
    });
}

/**
 * 
 * Ajaxによる通信エラーの際の処理
 */
function error_ajax(msg) {
    alert('申し訳ございません。サーバでエラーが発生しています。');
    console.log(msg);
    ingicater_end();
    return false;
}