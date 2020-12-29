<?php
class ParentAPI {

	public $keyId = false;
	public $lang = false;
	public $tmpConvertedFlg = false;

	public function __construct($lang) {
		require_once 'lib/GuruNaviUtil.php';
		$this->keyId = GuruNaviUtil::API_KEY_ID;
		$this->lang = $lang;
		if($this->lang === 'vi') {
			$this->tmpConvertToEnglish();
		}
	}

	public function getResponse() {
		return false;
	}

	protected function getUrlWithParam($apiUrl, $paramArray) {
		$paramString = http_build_query($paramArray);
		$url = $apiUrl . '?' . $paramString;
		return $url;
	}

	protected function callApi($url) {
		//cURLを初期化して使用可能にする
		$curl = curl_init();
		//オプションにURLを設定する
		curl_setopt($curl, CURLOPT_URL, $url);
		//Locationをたどる
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		//最大何回リダイレクトをたどるか
		curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
		//リダイレクトの際にヘッダのRefererを自動的に追加させる
		curl_setopt($curl, CURLOPT_AUTOREFERER, true);
		//URLにアクセスし、結果を表示させる
		//文字列で結果を返させる
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($curl);
		//cURLのリソースを解放する
		curl_close($curl);

		// jsonをデコードする
		$resArray = json_decode($res, true);
		return $resArray;
	}

	private function tmpConvertToEnglish() {
		$this->lang = 'en';
		$this->tmpConvertedFlg = true;
	}
}
?>