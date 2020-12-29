<?php
class ParentAPI {

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
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_HTTPGET, 1);
		curl_setopt($curl, CURLOPT_URL, $url); // 取得するURLを指定
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // 実行結果を文字列で返す
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // サーバー証明書の検証を行わない

		$res = curl_exec($curl);

		curl_close($curl);

		$resArray = json_decode($res, true);
		return $resArray;
	}

	private function tmpConvertToEnglish() {
		$this->lang = 'en';
	}
}
?>