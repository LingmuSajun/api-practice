<?php
class GuruNaviUtil {
	const TEXT_KEYWORD = 0;
	const TEXT_ADDRESS = 1;
	// アクセスキーの利用期限 : 2021/03/26
	const API_KEY_ID = '';

	public $languageList = [
		'ja', // 日本語
		'en', // 英語
		'zh_cn', // 中国語 (簡体字)
		'ko', // 韓国語
		'vi', // ベトナム語
	];

	public $titleList = [
		'ja' => 'ぐるなびAPIを使って店舗検索',
		'en' => 'Searching for restaurants using the Gurunavi API',
		'zh_cn' => '使用Gurunavi API搜索餐厅',
		'ko' => 'Gurunavi API를 사용하여 레스토랑 검색',
		'vi' => 'Tìm kiếm nhà hàng bằng API Gurunavi',
	];

	public $validationErrorList = [
		'ja' => [
			1 => 'キーワードと住所を入力してください',
			2 => 'キーワードを入力してください',
			3 => '住所を入力してください',
		],
		'en' => [
			1 => 'Please enter keyword and your address.',
			2 => 'Please enter keyword.',
			3 => 'Please enter your address.',
		],
		'zh_cn' => [
			1 => '',
			2 => '',
			3 => '',
		],
		'ko' => [
			1 => '',
			2 => '',
			3 => '',
		],
		'vi' => [
			1 => '',
			2 => '',
			3 => '',
		],
	];

	public $formTextList = [
		'ja' => [
			self::TEXT_KEYWORD => 'キーワード',
			self::TEXT_ADDRESS => '住所',
		],
		'en' => [
			self::TEXT_KEYWORD => 'Keyword',
			self::TEXT_ADDRESS => 'Address',
		],
		'zh_cn' => [
			self::TEXT_KEYWORD => '关键词',
			self::TEXT_ADDRESS => '地址',
		],
		'ko' => [
			self::TEXT_KEYWORD => '예어',
			self::TEXT_ADDRESS => '주소',
		],
		'vi' => [
			self::TEXT_KEYWORD => 'từ khóa',
			self::TEXT_ADDRESS => 'Địa chỉ',
		],
	];

	public function __construct($lang) {
		$this->lang = $this->__getLanguage($lang);
	}

	public function getTitle() {
		return $this->titleList[$this->lang];
	}

	public function getFormText($textType) {
		return $this->formTextList[$this->lang][$textType];
	}

	public function getValidationErrorText($errorNo) {
		return $this->validationErrorList[$this->lang][$errorNo];
	}

	function validate($lang, $keyword, $address) {
		$paramArray = [];
		$paramArray['lang'] = $lang;

		$url = 'GuruNaviForm.php';
		if(empty($keyword) && empty($address)) {
			$paramArray['error'] = 1;
		} elseif(empty($keyword)) {
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