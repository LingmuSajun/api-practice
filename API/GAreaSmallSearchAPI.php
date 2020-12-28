<?php
require_once 'API/ParentAPI.php';

class GAreaSmallSearchAPI extends ParentAPI {

	const RESPONSE_KEY = 'garea_small';

	public function __construct($lang) {
		$this->apiURL = 'https://api.gnavi.co.jp/master/GAreaSmallSearchAPI/v3/';
		parent::__construct($lang);
	}

	public function setRequestParams($prefCode) {
		$this->prefCode = $prefCode;
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

		$res = $this->getSmallAreaList($res[self::RESPONSE_KEY]);
		return $res;
	}

	private function getSmallAreaList($list) {
		$res = [];
		$count = 0;
		foreach($list as $key => $data) {
			if($this->prefCode === $data['pref']['pref_code']) {
				$res[$count]['areacode_s'] = $data['areacode_s'];
				$res[$count]['areaname_s'] = $data['areaname_s'];
				$count++;
			}
		}
		return $res;
	}
}
?>