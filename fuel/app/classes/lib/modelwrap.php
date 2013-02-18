<?php

class Lib_Modelwrap{

	private $user_id;
        
	/*
	private $memcache_model_list;

	public function __construct($user_id){
		$this->user_id = $user_id;
		$this->memcache_model_list = Config::get('memcache_model_list');
	}
*/
	public function call($model_name, $function_name, $arg1=null, $arg2=null){
		/*
		$memcache_flg = false;
		if (in_array($model_name, $this->memcache_model_list)) {
			$mem_key = "";
			if ($arg1 !== null) { $mem_key.= "_".serialize($arg1); }
			if ($arg2 !== null) { $mem_key.= "_".serialize($arg2); }
			$mem_key = sha1($mem_key);

			$memcache_flg = true;
		}
		*/
		
		switch ($model_name) {
			case 'Model_User_Item':
			case 'Model_Present':
			case 'Model_Gacha_Log':
			case 'Model_Gacha_Panel_Log':
			case 'Model_User_Story_Log':
			case 'Model_Loginstamp_Log':
			case 'Model_Request_Service_Log':
			case 'Model_Item_Use_Log':
			case 'Model_User_Title':
			case 'Model_User_Friend':
			case 'Model_Social_Log':
			case 'Model_Social_Friend_Log':
			case 'Model_User_Letter':
			case 'Model_Minigame_Log':
			case 'Model_Word_Service_Count':
			case 'Model_Event_User_Friend':
			case 'Model_Event_Social_Friend_Log':
			case 'Model_Event_Minigame_Log':
			case 'Model_Event_User_Story_Log':
			case 'Model_Event_Word_Service_Count':
			case 'Model_Letterstamp_User_Sendletter':
			case 'Model_Letterstamp_User_Visit':
			case 'Model_Letterstamp_User_Change_Status':
			case 'Model_Letterstamp_User_Minigame':
			case 'Model_Letterstamp_User_Sendletter':
			case 'Model_Entry_Flash_Log':
			case 'Model_Collection_User_Getstory':
			case 'Model_Collection_User_Visit':
			case 'Model_Collection_User_Change_Status':
			case 'Model_Collection_User_Minigame':


				$model_name .= substr($this->user_id, mb_strlen($this->user_id) - 1);
				break;

			default:
				break;
		}

		try {
			/*
			// =============================
			// memcache読込
			// =============================
			if ($memcache_flg === true) {
				$mem_key = $model_name.'_'.$function_name.'_'.$mem_key;

				$mem_model = \Lib_LsCache::get($mem_key);
				if($mem_model){
					//\Log::debug("mem_read_".$mem_key);
					return unserialize($mem_model);
				}
			}
			*/
			
			if($model_name === 'DB'){
				$model_data = DB::query($arg1)->execute();
			}elseif($function_name === 'count'){
				if($arg1 === null){
					$model_data = $model_name::$function_name();
				}else{
					$model_data = $model_name::$function_name($arg1);
				}
			}else{
				if($arg2 === null){
					$model_data = $model_name::$function_name($arg1);
				}else{
					$model_data = $model_name::$function_name($arg1, $arg2);
				}
			}
			
			
			/*
			// =============================
			// memcache登録
			// =============================
			if ($memcache_flg === true) {
				//\Log::debug("mem_write_".$mem_key);
				\Lib_LsCache::set($mem_key, serialize($model_data));
			}
			*/
			return $model_data;

		} catch (Exception $e) {
			\Log::debug($e->getMessage());
                        /*
			if( ENVIRONMENT === ENVIRONMENT_TESTING || ENVIRONMENT === ENVIRONMENT_DEVELOPMENT) {
				var_dump($e->getMessage());
				exit;
			}
                         */
			//$msg = 1;
			//Response::redirect(Uri::base(false) . Config::get('system_name') . '/err/show_system_errpage');
		}
	}

	public function getModelInstance($model_name, $arg){

		switch ($model_name) {
			case 'Model_User_Item':
			case 'Model_Present':
			case 'Model_Gacha_Log':
			case 'Model_Gacha_Panel_Log':
			case 'Model_User_Story_Log':
			case 'Model_Loginstamp_Log':
			case 'Model_Request_Service_Log':
			case 'Model_Item_Use_Log':
			case 'Model_User_Title':
			case 'Model_User_Friend':
			case 'Model_Social_Log':
			case 'Model_Social_Friend_Log':
			case 'Model_User_Letter':
			case 'Model_Minigame_Log':
			case 'Model_Word_Service_Count':
			case 'Model_Event_User_Friend':
			case 'Model_Event_Social_Friend_Log':
			case 'Model_Event_Minigame_Log':
			case 'Model_Event_User_Story_Log':
			case 'Model_Event_Word_Service_Count':
			case 'Model_Letterstamp_User_Sendletter':
			case 'Model_Letterstamp_User_Visit':
			case 'Model_Letterstamp_User_Change_Status':
			case 'Model_Letterstamp_User_Minigame':
			case 'Model_Letterstamp_User_Sendletter':
			case 'Model_Entry_Flash_Log':
			case 'Model_Collection_User_Getstory':
			case 'Model_Collection_User_Visit':
			case 'Model_Collection_User_Change_Status':
			case 'Model_Collection_User_Minigame':

				$model_name .= substr($this->user_id, mb_strlen($this->user_id) - 1);
				break;

			default:

				break;
		}

		try {
			return new $model_name($arg);
		} catch (Exception $e) {
			// var_dump($e->getMessage());exit;
			Log::debug($e->getMessage());
			// $msg = $e->getMessage();//'DB接続エラー';
			// if($msg === ''){
				$msg = 1;
			// }
			//Response::redirect(Config::get('system_name').'/errpage/show_errpage/' . $msg);
		}
	}
}
