<?php
class GuruNaviApi {
	public function __construct($freeword, $address) {
		$this->url = "https://api.gnavi.co.jp/RestSearchAPI/v3/";
		// アクセスキーの利用期限 : 2021/03/26
		$this->keyId = '';
		$this->freeword = $freeword;
		$this->address = $address;
	}

	public function getResponse() {
		$params = [];
		$params['keyid'] = $this->keyId;
		$params['freeword'] = $this->freeword;
		$params['address'] = $this->address;
		$url = $this->getUrlWithParam($params);

		$res = $this->callApi($url);
		if(!isset($res['rest']) || empty($res['rest'])) {
			return false;
		}

		$dataList = $this->getRestaurantDataList($res['rest']);
		// var_dump($dataList);
		return $dataList;
	}

	private function getUrlWithParam($paramArray) {
		$paramString = http_build_query($paramArray);
		$url = $this->url . '?' . $paramString;
		return $url;
	}

	private function callApi($url = false) {
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

	private function getRestaurantDataList($list) {
		$count = 0;
		$res = [];
		foreach($list as $key => $data) {
			$res[$key]['name'] = $data['name'];
			$res[$key]['category'] = $data['category'];
			$res[$key]['url'] = $data['url'];
			$res[$key]['image_url_1'] = $data['image_url']['shop_image1'];
			$res[$key]['image_url_2'] = $data['image_url']['shop_image2'];
			$res[$key]['address'] = $data['address'];

			if($count === 10) {
				return $res;
			}
			$count++;
		}
		return $res;
	}
}
?>