<?php
class GuruNaviUtil {

	// テキスト
	const TEXT_RESTAURANT = 1;
	const TEXT_BUSINESS_HOUR = 2;
	const TEXT_HOLIDAY = 3;
	const TEXT_CATEGORY = 4;
	const TEXT_TEL_NO = 5;
	const TEXT_ADDRESS = 6;
	const TEXT_PR = 7;
	const TEXT_PREFS = 8;
	const TEXT_SMALL_AREA = 9;
	const TEXT_NEXT = 10;
	const TEXT_SUBMIT = 11;
	const TEXT_RETURN = 12;

	// アクセスキーの利用期限 : 2021/03/26
	const API_KEY_ID = '';

	private $languageList = [
		'ja', // 日本語
		'en', // 英語
		'zh_cn', // 中国語 (簡体字)
		'ko', // 韓国語
		'vi', // ベトナム語
	];

	private $titleList = [
		'ja' => 'ぐるなびAPIを使って店舗検索',
		'en' => 'Searching for restaurants using the Gurunavi API',
		'zh_cn' => '使用Gurunavi API搜索餐厅',
		'ko' => 'Gurunavi API를 사용하여 레스토랑 검색',
		'vi' => 'Tìm kiếm nhà hàng bằng API Gurunavi',
	];

	private $formTextList = [
		'ja' => [
			self::TEXT_RESTAURANT => '店舗名',
			self::TEXT_BUSINESS_HOUR => '営業時間',
			self::TEXT_HOLIDAY => '休業日',
			self::TEXT_CATEGORY => 'カテゴリー',
			self::TEXT_TEL_NO => '電話番号',
			self::TEXT_ADDRESS => '住所',
			self::TEXT_PR => 'PR',
			self::TEXT_PREFS => '都道府県',
			self::TEXT_SMALL_AREA => '地名',
			self::TEXT_NEXT => '次へ',
			self::TEXT_SUBMIT => '送信',
			self::TEXT_RETURN => '戻る',
		],
		'en' => [
			self::TEXT_RESTAURANT => 'Store Name',
			self::TEXT_BUSINESS_HOUR => 'Business Hour',
			self::TEXT_HOLIDAY => 'Holiday',
			self::TEXT_CATEGORY => 'Category',
			self::TEXT_TEL_NO => 'Tel',
			self::TEXT_ADDRESS => 'Address',
			self::TEXT_PR => 'PR',
			self::TEXT_PREFS => 'Prefectures',
			self::TEXT_SMALL_AREA => 'Area',
			self::TEXT_NEXT => 'Next',
			self::TEXT_SUBMIT => 'Submit',
			self::TEXT_RETURN => 'Return',
		],
		'zh_cn' => [
			self::TEXT_RESTAURANT => '店铺名称',
			self::TEXT_BUSINESS_HOUR => '营业时间',
			self::TEXT_HOLIDAY => '假日',
			self::TEXT_CATEGORY => '类别',
			self::TEXT_TEL_NO => '电话号码',
			self::TEXT_ADDRESS => '街道地址',
			self::TEXT_PR => '公关',
			self::TEXT_PREFS => '地区',
			self::TEXT_SMALL_AREA => '区',
			self::TEXT_NEXT => '下一个',
			self::TEXT_SUBMIT => '发送',
			self::TEXT_RETURN => '返回',
		],
		'ko' => [
			self::TEXT_RESTAURANT => '가게 이름',
			self::TEXT_BUSINESS_HOUR => '영업 시간',
			self::TEXT_HOLIDAY => '휴업일',
			self::TEXT_CATEGORY => '범주',
			self::TEXT_TEL_NO => '전화 번호',
			self::TEXT_ADDRESS => '주소',
			self::TEXT_PR => 'PR',
			self::TEXT_PREFS => '도도부 현',
			self::TEXT_SMALL_AREA => '영역',
			self::TEXT_NEXT => '다음에',
			self::TEXT_SUBMIT => '전송',
			self::TEXT_RETURN => '돌아 가기',
		],
		'vi' => [
			self::TEXT_RESTAURANT => 'Tên cửa hàng',
			self::TEXT_BUSINESS_HOUR => 'giờ kinh doanh',
			self::TEXT_HOLIDAY => 'Ngày lễ',
			self::TEXT_CATEGORY => 'thể loại',
			self::TEXT_TEL_NO => 'số điện thoại',
			self::TEXT_ADDRESS => 'Địa chỉ đường phố',
			self::TEXT_PR => 'PR',
			self::TEXT_PREFS => 'Các tỉnh',
			self::TEXT_SMALL_AREA => 'khu vực',
			self::TEXT_NEXT => 'kế tiếp',
			self::TEXT_SUBMIT => 'Gửi',
			self::TEXT_RETURN => 'Trở về',
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

	public function getCategoryList() {
		session_start();
		$sessionKey = $this->__getSessionKey('categoryList');
		if (isset($_SESSION[$sessionKey]) && $_SESSION[$sessionKey] > 0) {
			return $_SESSION[$sessionKey];
		}
		require_once 'API/CategoryLargeSearchAPI.php';
		$clsAPIObj = new CategoryLargeSearchAPI($this->lang);
		$categoryList = $clsAPIObj->getResponse();
		$_SESSION[$sessionKey] = $categoryList;
		return $categoryList;
	}

	public function getCategoryNameByCode($categoryCode) {
		$categoryList = $this->getCategoryList();
		foreach ($categoryList as $key => $categoryData) {
			if($categoryCode === $categoryData['category_l_code']) {
				return $categoryData['category_l_name'];
			}
		}
		return false;
	}

	public function getPrefList() {
		session_start();
		$sessionKey = $this->__getSessionKey('prefList');
		if (isset($_SESSION[$sessionKey]) && $_SESSION[$sessionKey] > 0) {
			return $_SESSION[$sessionKey];
		}
		require_once 'API/PrefSearchAPI.php';
		$psAPIObj = new PrefSearchAPI($this->lang);
		$prefList = $psAPIObj->getResponse();
		$_SESSION[$sessionKey] = $prefList;
		return $prefList;
	}

	public function getPrefNameByCode($prefCode) {
		$prefList = $this->getPrefList();
		foreach ($prefList as $key => $prefData) {
			if($prefCode === $prefData['pref_code']) {
				return $prefData['pref_name'];
			}
		}
		return false;
	}

	public function getSmallAreaList($prefCode) {
		session_start();
		$sessionKey = $this->__getSessionKey('smallAreaList' . '_' . $prefCode);
		if (isset($_SESSION[$sessionKey]) && $_SESSION[$sessionKey] > 0) {
			return $_SESSION[$sessionKey];
		}
		require_once 'API/GAreaSmallSearchAPI.php';
		$gassAPIObj = new GAreaSmallSearchAPI($this->lang);
		$gassAPIObj->setRequestParams($prefCode);
		$smallAreaList = $gassAPIObj->getResponse();
		$_SESSION[$sessionKey] = $smallAreaList;
		return $smallAreaList;
	}

	public function getSmallAreaNameByCode($prefCode, $smallAreaCode) {
		$smallAreaList = $this->getSmallAreaList($prefCode);
		foreach ($smallAreaList as $key => $areaData) {
			if($smallAreaCode === $areaData['areacode_s']) {
				return $areaData['areaname_s'];
			}
		}
		return false;
	}

	public function getRestaurantList($categoryCode, $smallAreaCode) {
		require_once 'API/ForeignRestSearchAPI.php';
		$frsAPIObj = new ForeignRestSearchAPI($this->lang);
		$frsAPIObj->setRequestParams($categoryCode, $smallAreaCode);
		$restList = $frsAPIObj->getResponse();
		return $restList;
	}

	public function getLanguageUrl($lang) {
		$currentUrl = $_SERVER['SCRIPT_NAME'];
		$queryString = $_SERVER['QUERY_STRING'];
		parse_str($queryString, $paramArray);
		$paramArray['lang'] = $lang;
		$queryString = http_build_query($paramArray);
		$languageUrl = $currentUrl . '?' . $queryString;
		return $languageUrl;
	}

	public function getReturnUrl() {
		$paramArray = [];
		$paramArray['lang'] = $this->lang;
		$paramString = http_build_query($paramArray);
		$url = 'GuruNaviForm.php';
		$redirectUrl = $url . '?' . $paramString;
		return $redirectUrl;
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

	private function __getSessionKey($key) {
		return $key . $this->lang;
	}
}
?>