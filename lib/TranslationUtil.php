<?php
require_once 'lib/GuruNaviUtil.php';

class TranslationUtil extends GuruNaviUtil {

	private $categoryList = [
		'vi' => [
			[
				"category_l_code" => "RSFST09000",
				"category_l_name" => "Izakaya (Quán rượu kiểu Nhật)",
			],
			[
				"category_l_code" => "RSFST02000",
				"category_l_name" => "Tiếng Nhật truyền thống",
			],
			[
				"category_l_code" => "RSFST03000",
				"category_l_name" => "Sushi / Hải sản",
			],
			[
				"category_l_code" => "RSFST04000",
				"category_l_name" => "Nabe (Lẩu)",
			],
			[
				"category_l_code" => "RSFST05000",
				"category_l_name" => "Yakiniku (BBQ) / Horumon (Nội tạng)",
			],
			[
				"category_l_code" => "RSFST06000",
				"category_l_name" => "Yakitori (Thịt xiên nướng và rau củ) / Món thịt",
			],
			[
				"category_l_code" => "RSFST01000",
				"category_l_name" => "Ẩm thực Nhật Bản hiện đại",
			],
			[
				"category_l_code" => "RSFST07000",
				"category_l_name" => "Okonomiyaki / Takoyaki / v.v.",
			],
			[
				"category_l_code" => "RSFST08000",
				"category_l_name" => "Mì (Ramen / Soba / Udon / v.v.)",
			],
			[
				"category_l_code" => "RSFST14000",
				"category_l_name" => "người Trung Quốc",
			],
			[
				"category_l_code" => "RSFST11000",
				"category_l_name" => "Ý / Pháp",
			],
			[
				"category_l_code" => "RSFST13000",
				"category_l_name" => "Tây / Âu",
			],
			[
				"category_l_code" => "RSFST12000",
				"category_l_name" => "Phương Tây / Nhiều loại",
			],
			[
				"category_l_code" => "RSFST16000",
				"category_l_name" => "Cà ri",
			],
			[
				"category_l_code" => "RSFST15000",
				"category_l_name" => "Đông Nam Á",
			],
			[
				"category_l_code" => "RSFST17000",
				"category_l_name" => "Hữu cơ / kết hợp",
			],
			[
				"category_l_code" => "RSFST10000",
				"category_l_name" => "Quán ăn / Quầy bar / Phòng uống bia",
			],
			[
				"category_l_code" => "RSFST21000",
				"category_l_name" => "Rượu",
			],
			[
				"category_l_code" => "RSFST18000",
				"category_l_name" => "Bánh mì / bánh ngọt / tráng miệng",
			],
			[
				"category_l_code" => "RSFST19000",
				"category_l_name" => "Phòng tiệc / Karaoke / Giải trí",
			],
			[
				"category_l_code" => "RSFST20000",
				"category_l_name" => "Ăn tối thông thường / Đồ ăn nhanh",
			],
			[
				"category_l_code" => "RSFST90000",
				"category_l_name" => "Ẩm thực khác",
			],
		],
	];

	public function getTranslatedText($text) {
		if(strval($text) === '') {
			return false;
		}
		require_once 'API/GoogleTranslateAPI.php';
		$gtAPIObj = new GoogleTranslateAPI($this->lang);
		$gtAPIObj->setRequestParams($text, $this->lang);
		$translatedText = $gtAPIObj->getResponse();
		return $translatedText;
	}

	public function getCategoryList() {
		if($this->lang === 'vi') {
			return $this->categoryList[$this->lang];
		}
		return parent::getCategoryList();
	}

}