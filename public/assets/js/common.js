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
function regist(sendUrl, sendType, sendData, successMsg, callBackUrl, successFunc) {
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
                ingicater_end();
                
                if (successMsg !== null) {
                    alert(successMsg);                
                }
                if (callBackUrl !== null) {
                    location.href = callBackUrl;                
                }
                
                if (successFunc !== null) {
                    successFunc(data['data']);
                }
                
            } else {
                //エラー処理をいくつか
                if (data['error_code'] === 1) {
                    alert('必要な項目が入力されていません。');
                    
                    //存在チェック
                    if ('data' in data) {
                        returnData = data['data'];
                    }
                    
                } else {
                    alert('処理が成功しませんでした');
                }
            }
            return returnData;
            
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


/**
 * 左メニューを押した時の処理
 */
var leftmenuOpenFlg = false;
function leftmenu_toggle() {
    if (leftmenuOpenFlg === true) {
        $(".main-contents").animate({"left": "0%"},  { duration: 'fast', easing: 'swing'});
        $("#leftmenu").animate({"left": "-80%"},  { duration: 'fast', easing: 'swing'});
        leftmenuOpenFlg = false;

    } else {
        $(".main-contents").animate({"left": "80%"},  { duration: 'fast', easing: 'swing'});
        $("#leftmenu").animate({"left": "0"},  { duration: 'fast', easing: 'swing'});
        leftmenuOpenFlg = true;
    }    
}

/**
 * 右メニューを押した時の処理
 */
var rightmenuOpenFlg = false;
function rightmenu_toggle() {
    if (rightmenuOpenFlg === true) {
          $(".main-contents").animate({"left": "0%"},  { duration: 'fast', easing: 'swing'});
          $("#rightmenu").animate({"left": "100%"},  { duration: 'fast', easing: 'swing'});
          rightmenuOpenFlg = false;

      } else {
          $(".main-contents").animate({"left": "-80%"},  { duration: 'fast', easing: 'swing'});
          $("#rightmenu").animate({"left": "20%"},  { duration: 'fast', easing: 'swing'});
          rightmenuOpenFlg = true;
      }  
}



//URLのバーを見えなくするため
$(function() {    
    window.addEventListener('load', function() {
        window.scrollTo(0, 1);
    },false);

    setTimeout("window.scrollTo(0,1)",500);
});








