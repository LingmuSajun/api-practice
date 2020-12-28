<?php
require_once 'API/ParentAPI.php';

class ForeignRestSearchAPI extends ParentAPI {

	const RESPONSE_KEY = 'rest';

	public function __construct($lang) {
		$this->apiURL = 'https://api.gnavi.co.jp/ForeignRestSearchAPI/v3/';
		parent::__construct($lang);
	}

	public function setRequestParams($keyword, $address) {
		$this->keyword = $keyword;
		$this->address = $address;
	}

	public function getResponse() {
		$paramArray = [];
		$paramArray['keyid'] = $this->keyId;
		$paramArray['lang'] = $this->lang;
		$paramArray['freeword'] = $this->keyword;
		$paramArray['address'] = $this->address;
		$url = $this->getUrlWithParam($this->apiURL, $paramArray);

		$res = $this->callApi($url);
		if(!isset($res[self::RESPONSE_KEY]) || empty($res[self::RESPONSE_KEY])) {
			return false;
		}

		$res = $this->getRestaurantDataList($res[self::RESPONSE_KEY]);
		return $res;
	}

	private function getRestaurantDataList($list) {
		$count = 0;
		$res = [];
		foreach($list as $key => $data) {
			$res[$key]['name'] = $data['name']['name'];
			$res[$key]['category'] = $data['categories']['category_name_l'][0];
			$res[$key]['url'] = $data['url'];
			$res[$key]['image_url_1'] = $data['image_url']['thumbnail'];
			$res[$key]['address'] = $data['contacts']['address'];

			if($count === 10) {
				return $res;
			}
			$count++;
		}
		return $res;
	}
}
?>