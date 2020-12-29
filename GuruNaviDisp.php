<?php
$categoryCode = $_GET["category_l_code"];
$prefCode = $_GET["pref_code"];
$smallAreaCode = $_GET["areacode_s"];

require_once 'lib/TranslationUtil.php';
$util = new TranslationUtil($_GET["lang"]);
// タイトル
$title = $util->getTitle();
// カテゴリー
$textCategory = $util->getFormText($util::TEXT_CATEGORY);
$categoryName = $util->getCategoryNameByCode($categoryCode);
// 小エリア
$textSmallArea = $util->getFormText($util::TEXT_SMALL_AREA);
$smallAreaName = $util->getSmallAreaNameByCode($prefCode, $smallAreaCode);
// レストラン
$restList = $util->getRestaurantList($categoryCode, $smallAreaCode);
$textRestaurant = $util->getFormText($util::TEXT_RESTAURANT);
$textBusinessHour = $util->getFormText($util::TEXT_BUSINESS_HOUR);
$textHoliday = $util->getFormText($util::TEXT_HOLIDAY);
$textCategory = $util->getFormText($util::TEXT_CATEGORY);
$textTelNo = $util->getFormText($util::TEXT_TEL_NO);
$textAddress = $util->getFormText($util::TEXT_ADDRESS);
$textPR = $util->getFormText($util::TEXT_PR);
// 戻るボタン
$textBack = $util->getFormText($util::TEXT_RETURN);
$returnUrl = $util->getReturnUrl();
?>

<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title><?php print($title); ?></title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>
</header>

<main>
<h2><?php print($title); ?></h2>
<a href="https://api.gnavi.co.jp/api/scope/" target="_blank">
	<img src="https://api.gnavi.co.jp/api/img/credit/api_265_65.gif" width="265" height="65" border="0" alt="グルメ情報検索サイト　ぐるなび">
</a>
<a href="<?php print($util->getLanguageUrl('ja')); ?>">日本語</a>
<a href="<?php print($util->getLanguageUrl('en')); ?>">English</a>
<a href="<?php print($util->getLanguageUrl('zh_cn')); ?>">中文</a>
<a href="<?php print($util->getLanguageUrl('ko')); ?>">한국</a>
<a href="<?php print($util->getLanguageUrl('vi')); ?>">Tiếng Việt</a>
<pre>
<?php print($textCategory); ?> : <?php print($categoryName); ?><br/>
<?php print($textSmallArea); ?> : <?php print($smallAreaName); ?><br/>

<?php
	$count = 0;
	foreach($restList as $key => $data) {
		$count++;
		print('No. ' . $count . '<br/>');
		print($textRestaurant . ' : ' . $data['name'] . '<br/>');
		print($textBusinessHour . ' : ' . $data['business_hour'] . '<br/>');
		print($textHoliday . ' : ' . $data['holiday'] . '<br/>');
		print($textTelNo . ' : ' . $data['tel'] . '<br/>');
		print($textAddress . ' : ' . $data['address'] . '<br/>');
		print($textPR . ' : ' . $data['pr'] . '<br/>');
		print('
		<a href="' . $data['url'] . '">' .
			'<img src="' .$data['image_url_1'] . '"width="300" height="100" border="0" alt="ぐるなびレストラン">
		</a>
		');
		print('<br/>');
	}
?>

	<input type="button" onclick="location.href='<?php print($returnUrl); ?>'" value="<?php print($textBack); ?>" class="btn btn--pink">
</pre>
</main>
</body>
</html>