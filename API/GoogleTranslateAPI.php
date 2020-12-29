<?php
require_once 'API/ParentAPI.php';

class GoogleTranslateAPI extends ParentAPI {

	const RESPONSE_KEY = 'text';

	public function __construct($lang) {
		$this->apiURL = 'https://script.google.com/macros/s/AKfycbzDBhSN9m0EDoFaFgLKw5CPe84ggAXux1-tnjKTIsKlqnrupFvL/exec';
		parent::__construct($lang);
	}

	public function setRequestParams($text, $targetLang) {
		$this->text = $text;
		$this->targetLang = $targetLang;
	}

	public function getResponse() {
		$paramArray = [];
		$paramArray['text'] = $this->text;
		$paramArray['source'] = 'en';
		$paramArray['target'] = $this->targetLang;
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