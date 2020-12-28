<?php
require_once 'API/ParentAPI.php';

class PrefSearchAPI extends ParentAPI {

	const RESPONSE_KEY = 'pref';

	public function __construct($lang) {
		$this->apiURL = 'https://api.gnavi.co.jp/master/PrefSearchAPI/v3/';
		parent::__construct($lang);
	}

	public function getResponse() {
		$paramArray = [];
		$paramArray['keyid'] = $this->keyId;
		$paramArray['lang'] = $this->lang;
		$url = $this->getUrlWithParam($this->apiURL, $paramArray);

		$res = $this->callApi($url);
		if(!isset($res[self::RESPONSE_KEY]) || empty($res[self::RESPONSE_KEY])) {
			return false;
		}

		$res = $this->getPrefList($res[self::RESPONSE_KEY]);
		return $res;
	}

	private function getPrefList($list) {
		$res = [];
		foreach($list as $key => $data) {
			$res[$key]['pref_name'] = $data['pref_name'];
		}
		return $res;
	}
}
?>