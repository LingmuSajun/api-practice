<?php
class GuruNaviUtil {
	const TEXT_KEYWORD = 0;
	const TEXT_ADDRESS = 1;

	public $languageList = [
		'ja', // 日本語
		'en', // 英語
		'zh_cn', // 中国語 (簡体字)
		'zh_tw', // 中国語 (繁体字)
		'ko', // 韓国語
		'vi', // ベトナム語
	];

	public $validationErrorList = [
		'ja' => [
			1 => 'フリーワードと住所を入力してください',
			2 => 'フリーワードを入力してください',
			3 => '住所を入力してください',
		],
		'en' => [
			1 => 'Please enter keyword and your address.',
			2 => 'Please enter keyword.',
			3 => 'Please enter your address.',
		],
		'vi' => [
			1 => '',
			2 => '',
			3 => '',
		],
	];

	public $formTextList = [
		'ja' => [
			self::TEXT_KEYWORD => 'フリーワード',
			self::TEXT_ADDRESS => '住所',
		],
		'en' => [
			self::TEXT_KEYWORD => 'Keyword',
			self::TEXT_ADDRESS => 'Address',
		],
		'vi' => [
			self::TEXT_KEYWORD => 'aaa',
			self::TEXT_ADDRESS => 'bbb',
		],
	];

	public function __construct($lang) {
		$this->lang = $this->__getLanguage($lang);
	}

	public function getFormText($textType) {
		return $this->formTextList[$this->lang][$textType];
	}

	public function getValidationErrorText($errorNo) {
		return $this->validationErrorList[$this->lang][$errorNo];
	}

	function validate($lang, $freeword, $address) {
		$paramArray = [];
		$paramArray['lang'] = $lang;

		$url = 'GuruNaviForm.php';
		if(empty($freeword) && empty($address)) {
			$paramArray['error'] = 1;
		} elseif(empty($freeword)) {
			$paramArray['error'] = 2;
		} elseif(empty($address)) {
			$paramArray['error'] = 3;
		}

		if(isset($paramArray['error']) && $paramArray['error'] > 0) {
			$paramString = http_build_query($paramArray);
			$redirectUrl = $url . '?' . $paramString;
			header('Location: ' . $redirectUrl);
			exit;
		}
	}

	private function __getLanguage($lang) {
		if(!isset($lang) || empty($lang)) {
			return $this->languageList[0];
		}
		foreach($this->languageList as $language) {
			if($lang === $language) {
				return $lang;
			}
		}
		return $this->languageList[0];
	}
}
?>