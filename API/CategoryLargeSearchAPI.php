<?php
require_once 'API/ParentAPI.php';

class CategoryLargeSearchAPI extends ParentAPI {

	const RESPONSE_KEY = 'category_l';

	public function __construct($lang) {
		$this->apiURL = 'https://api.gnavi.co.jp/master/CategoryLargeSearchAPI/v3/';
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

		$res = $res[self::RESPONSE_KEY];
		return $res;
	}
}
?>